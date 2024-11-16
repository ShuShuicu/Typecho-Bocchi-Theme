<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>

    <div class="mdui-card mdui-m-b-2">
        <div class="mdui-card-primary">
            <div class="mdui-card-primary-title"><?php GetPost::Title(); ?></div>
            <div class="mdui-card-primary-subtitle">
            <?php GetPost::Date(); ?>
            </div>
            <div class="mdui-divider"></div>
            <div class="mdui-card-content mdui-typo" id="PostContent"><?php GetPost::Content(); ?></div>
        </div>
    </div>
