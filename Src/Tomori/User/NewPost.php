<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 

if (Get::Options('NewPost') === 'open') {

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
        'slug'      =>  $title . '-' . time(), // 防止slug重复使用title+time方法
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
    <form action="" method="post">
        <div class="mdui-textfield">
            <input class="mdui-textfield-input" type="text" name="title" placeholder="请输入标题" required>
        </div>
        <div class="mdui-textfield">
            <textarea class="mdui-textfield-input" rows="15" cols="50" type="textarea" name="content" placeholder="请使用Markdown格式输入文章内容。"></textarea>
        </div>
        <button type="submit" name="submit_post" class="mdui-float-right mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent submit" style="border-radius: 8px;">提交文章</button>
    </form>
<?php } else {
    echo '投稿已关闭！';
}
