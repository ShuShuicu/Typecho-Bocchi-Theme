<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
    // 处理注册请求
    if (isset($_POST['doRegister'])) {
        $db = Typecho_Db::get();
        $prefix = $db->getPrefix();
        
        // 获取输入数据
        $name = htmlspecialchars(trim($_POST['name']));
        $mail = htmlspecialchars(trim($_POST['mail']));
        $password = htmlspecialchars(trim($_POST['password']));

        // 检查数据有效性
        if (empty($name) || empty($mail) || empty($password)) {
            echo '<p style="color: red;">请填写所有必填项。</p>';
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo '<p style="color: red;">请输入有效的邮箱地址。</p>';
        } else {
            // 检查用户名是否已存在
            $exists = $db->fetchRow($db->select()->from($prefix . 'users')->where('name = ?', $name)->limit(1));
            if ($exists) {
                echo '<p style="color: red;">用户名已存在。</p>';
            } else {
                // 创建新用户
                $hashedPassword = Typecho_Common::hash($password);
                $db->query($db->insert($prefix . 'users')->rows([
                    'name' => $name,
                    'mail' => $mail,
                    'screenName' => $name,
                    'password' => $hashedPassword,
                    'created' => time(),
                    'group' => 'subscriber', // 默认注册用户组
                    'authCode' => Typecho_Common::randString(32)
                ]));
                echo '<p style="color: green;">注册成功！您现在可以登录。</p>';
            }
        }
    }
?>

<form action="" method="post" name="register" role="form">
    <div class="mdui-textfield">
        <i class="mdui-icon material-icons">account_circle</i>
        <input class="mdui-textfield-input" type="text" name="name" placeholder="用户名（必填）" required />
    </div>
    <div class="mdui-textfield">
        <i class="mdui-icon material-icons">mail</i>
        <input class="mdui-textfield-input" type="email" name="mail" placeholder="邮箱地址（必填）" required />
    </div>
    <div class="mdui-textfield">
        <i class="mdui-icon material-icons">vpn_key</i>
        <input class="mdui-textfield-input" type="password" name="password" placeholder="密码（必填）" required />
    </div>
    <button type="submit"  name="doRegister" class="mdui-float-right mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent submit" style="border-radius: 8px;">注册</button>
</form>
