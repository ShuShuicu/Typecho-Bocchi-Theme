<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require 'Config.php';
?>
<div id="Page">
    <div class="mdui-card mdui-m-b-2">
        <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">{{ Title }}</div>
            <div class="mdui-divider"></div>
            <div class="mdui-card-content" id="PostContent">
                <ul class="mdui-list">
                    <?php
                    if ($relativeDir !== '') {
                        // 提供返回上一级的链接
                        $parentDir = dirname($relativeDir);
                        // 将反斜杠替换为正斜杠
                        $parentDir = str_replace('\\', '/', $parentDir); ?>
                        <a href="?dir=<?php echo htmlspecialchars(urlencode($parentDir === '.' ? '' : $parentDir), ENT_QUOTES, 'UTF-8') ?>">
                            <li class="mdui-list-item mdui-ripple">
                                <div class="mdui-list-item-content">返回上一级</div>
                            </li>
                        </a>
                    <?php } 

                    // 显示文件夹
                    foreach ($directories as $directory) {
                        $itemPath = $relativeDir . '/' . $directory;
                        // 将反斜杠替换为正斜杠
                        $itemPath = str_replace('\\', '/', $itemPath);
                        ?>
                        <a href="?dir=<?php echo htmlspecialchars(urlencode($itemPath), ENT_QUOTES, 'UTF-8') ?>">
                            <li class="mdui-list-item mdui-ripple">
                                <i class="mdui-list-item-icon mdui-icon material-icons">folder</i>
                                <div class="mdui-list-item-content"><?php echo htmlspecialchars($directory, ENT_QUOTES, 'UTF-8') ?></div>
                            </li>
                        </a>
                    <?php } ?>
                    <div class="mdui-divider"></div>
                    <?php
                    // 显示文件
                    foreach ($files as $file) { 
                        $itemPath = $relativeDir . '/' . $file;
                        // 将反斜杠替换为正斜杠
                        $itemPath = str_replace('\\', '/', $itemPath);
                        ?>
                        <a href="?file=<?php echo htmlspecialchars(urlencode($itemPath) . '&token=' . urlencode($token), ENT_QUOTES, 'UTF-8') ?>">
                            <li class="mdui-list-item mdui-ripple">
                                <i class="mdui-list-item-icon mdui-icon material-icons">file_download</i>
                                <div class="mdui-list-item-content"><?php echo htmlspecialchars($file, ENT_QUOTES, 'UTF-8') ?></div>
                            </li>
                        </a>
                    <?php 
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
new Vue({
    el: '#Page',
    data: {
        Title: '<?php echo htmlspecialchars(GetPost::Title(), ENT_QUOTES, 'UTF-8'); ?>',
    }
})
</script>