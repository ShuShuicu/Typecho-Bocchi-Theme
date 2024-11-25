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
        <a class="mdui-float-right" href="<?php echo Get::Options('logoutUrl'); ?>" title="Logout">退出登录</a>
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
            <img class="mdui-card-header-avatar" src="<?php echo \Typecho\Common::gravatarUrl($this->user->mail, 220, 'X', 'mm', $this->request->isSecure()); ?>" />
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
        <?php GetBocchi::Tomori('User/NewPost'); ?>
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
<?php GetBocchi::Tomori('User/Login'); ?>
</div>
    <div id="注册">
        <?php GetBocchi::Tomori('User/Register'); ?>
    </div>
</div>
<?php 
}
