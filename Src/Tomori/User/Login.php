<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
?>
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
