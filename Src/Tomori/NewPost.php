<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
    // 获取数据库对象
    $db = Typecho_Db::get();
    $user = Typecho_Widget::widget('Widget_User');
    
    // 检查用户是否登录
    if (!$user->hasLogin()) {
        die('<script>alert("标题或内容不能为空！！！");</script>');
    }

    // 获取表单数据
    $title = isset($_POST['title']) ? strip_tags(trim($_POST['title'])) : '';
    $content = isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '';

    // 检查表单数据是否有效
    if (empty($title) || empty($content)) {
        die('<script>alert("标题或内容不能为空！！！");</script>');
    }

    // 插入数据
    $insertData = array(
        'title'     => $title,
        'text'      => $content,
        'authorId'  => $user->uid,
        'created'   => time(),
        'type'      => 'post',
        'status'    => 'hidden', // 默认隐藏状态
        // 'slug'      =>  $title, // 自动生成别名
    );

    try {
        $postId = $db->query($db->insert('table.contents')->rows($insertData));
        if ($postId) {
            echo '<script>alert("投稿成功！请等待管理员审核。");</script>';
        }
    } catch (Exception $e) {
        echo '数据库错误：' . $e->getMessage();
    }
}
?>
