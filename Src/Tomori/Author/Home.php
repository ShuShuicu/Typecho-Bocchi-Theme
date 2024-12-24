<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
?>
<style>
.AuthorBackground {
    height: 300px; 
    background-position: center center !important;
    background-size: cover !important;
}

@media (max-width: 768px) { /* 手机端样式 */
    .AuthorBackground {
        height: 200px; 
    }
}
</style>
<div id="Author">
    <div class="mdui-card mdui-hoverable mdui-m-b-2">
        <div class="mdui-card-media">
            <div class="AuthorBackground" :style="{ background: 'url(' + BackgroundImg + ')' }"></div>
                <div class="mdui-grid-tile-actions">
                    <div class="mdui-grid-tile-text">
                        <div class="mdui-grid-tile-title">{{ UserName }}的空间</div>
                    </div>
                </div>
            </div>
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" :src="UserAvatar" />
                <div class="mdui-card-header-title">{{ UserName }}</div>
                <div class="mdui-card-header-subtitle">{{ UserMail }}</div>
            </div>
            <div class="mdui-card-primary">
                <div class="mdui-divider"></div>
                <div class="mdui-card-content mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-3 mdui-row-lg-4">
                    <?php GetBocchi::Tomori('Author/Comments'); ?>
                </div>
            </div>
    </div>
</div>
<script>
new Vue({
    el: '#Author',
    data: {
        UserName: '<?php $this->author() ?>',
        UserMail: '<?php $this->author('mail'); ?>',
        UserAvatar: '<?php echo \Typecho\Common::gravatarUrl($this->author->mail, 220, 'X', 'mm', $this->request->isSecure()); ?>',
        BackgroundImg: '<?php echo GetTheme::AssetsUrl(); ?>/images/user_t.jpg',
    }
})
</script>
