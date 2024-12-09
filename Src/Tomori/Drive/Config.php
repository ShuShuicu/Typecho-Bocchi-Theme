<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 

// 获取基础目录
$driveDir = Get::Options('MioDriveDir') ? Get::Options('MioDriveDir') : 'Files';

session_start();

// 设置 token，通常在用户登录或访问页面时生成并存储
if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(16)); // 生成一个随机 token
}
$token = $_SESSION['token']; // 从会话中获取 token

$baseDir = __DIR__ . '/' . $driveDir; // 使用绝对路径，确保路径正确
$relativeDir = isset($_GET['dir']) ? $_GET['dir'] : '';
$path = $baseDir . '/' . $relativeDir;

// 如果存在文件下载请求
if (isset($_GET['file']) && isset($_GET['token'])) {
    $file = basename($_GET['file']); // 仅获取文件名，避免路径注入
    $relativePath = dirname($_GET['file']); // 获取相对路径（如果存在）
    $downloadPath = $baseDir . '/' . $relativePath . '/' . $file;

    // 验证文件是否存在
    if (!is_file($downloadPath)) {
        die("文件不存在。");
    }

    // 验证 token 是否正确
    if ($_GET['token'] !== $token) {
        die("无效的 token。");
    }

    // 清空输出缓冲区，避免页面内容输出到下载文件中
    if (ob_get_length()) {
        ob_end_clean();
    }

    // 处理文件下载
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($downloadPath) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($downloadPath));
    
    // 输出文件内容
    readfile($downloadPath);
    exit;
}

// 目录浏览逻辑
if (!is_dir($path)) {
    die("指定的目录不存在。");
}

$items = scandir($path);

// 将文件夹和文件分开处理，并按文件的修改时间排序
$directories = [];
$files = [];

foreach ($items as $item) {
    if ($item === '.' || $item === '..') {
        continue;
    }

    $itemPath = $path . '/' . $item;
    if (is_dir($itemPath)) {
        $directories[] = $item;
    } else {
        $files[] = $item;
    }
}

// 文件夹按名称排序，文件按修改时间降序排序
sort($directories);
usort($files, function($a, $b) use ($path) {
    return filemtime($path . '/' . $b) - filemtime($path . '/' . $a);
});
