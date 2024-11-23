<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
if ($this->user->hasLogin()) {
?>
<link rel="stylesheet" href="<?php echo GetTheme::AssetsUrl(); ?>/UserStyle.css?ver=<?php GetTheme::Ver(); ?>">
<div class="mdui-card mdui-card-content mdui-m-b-2">
    <div class="mdui-center"><?php echo $this->user->screenName; ?>，您好！
        <?php
            if ($this->user->logged > 0) {
                $logged = new \Typecho\Date($user->logged);
                _e('最后登录： %s', $logged->word());
            }
        ?>
        <a class="mdui-float-right" href="<?php echo Get::Options('logoutUrl') ?>">退出登录</a>
    </div>
</div>
<div class="mdui-m-y-1 mdui-card mdui-card-content">
    <div class="mdui-tab mdui-tab-full-width" mdui-tab>
        <a href="#个人资料" class="mdui-ripple">个人资料</a>
        <a href="#撰写设置" class="mdui-ripple">撰写设置</a>
        <a href="#发布文章" class="mdui-ripple">发布文章</a>
    </div>

    <div class="mdui-divider"></div>
    <div id="个人资料" class="mdui-card-content">
        <div class="mdui-card-header">
            <img class="mdui-card-header-avatar" src="<?php echo \Typecho\Common::gravatarUrl($this->user->mail, 220, 'X', 'mm', $this->request->isSecure()) ?>" />
            <div class="mdui-card-header-title"><?php echo $this->user->screenName; ?></div>
            <div class="mdui-card-header-subtitle"><?php echo $this->user->mail; ?></div>
        </div>
        <h3>资料设置</h3>
            头像服务由 <a href="<?php echo Get::Options('AvatarCdn') ?>"><?php echo Get::Options('AvatarCdn') ?></a> 提供
        <?php \Widget\Users\Profile::alloc()->profileForm()->render(); ?>
    </div>
    <div id="撰写设置" class="mdui-card-content">
        <?php \Widget\Users\Profile::alloc()->optionsForm()->render(); ?>
    </div>
    <div id="发布文章" class="mdui-card-content">
    <?php
        GetBocchi::Tomori('NewPost');
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
    </div>
</div>

<?php
} else {
?>
<div class="mdui-m-y-1 mdui-card mdui-card-content">
    <div class="mdui-tab mdui-tab-full-width" mdui-tab>
        <a href="#登录" class="mdui-ripple">登录</a>
        <a href="#注册" class="mdui-ripple">注册</a>
    </div>
<div id="登录">
<form action="<?php $this->options->loginAction()?>" method="post" name="login" rold="form">
    <input type="hidden" name="referer" value="<?php Get::SiteUrl(); ?>">
    <div class="mdui-textfield">
        <i class="mdui-icon material-icons">account_circle</i>
        <input class="mdui-textfield-input" type="text" name="name" autocomplete="username" placeholder="请输入用户名" required/>
    </div>
    <div class="mdui-textfield">
        <i class="mdui-icon material-icons">vpn_key</i>
        <input class="mdui-textfield-input" type="password" name="password" autocomplete="current-password" placeholder="请输入密码" required/>
    </div>
    <button type="submit" class="mdui-float-right mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent submit" style="border-radius: 8px;">登录</button>
</form>
</div>
<div id="注册">
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
</div>
</div>
<?php
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
}
?>
