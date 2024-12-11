<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
    <div id="Sidebar">
        <div class="mdui-drawer mdui-card" id="drawer" style="border-radius: 0;">

        <?php 
            if (Get::Options('SidebarDisplay') === 'Author'){ 
                if ($this->user->hasLogin()) {
        ?>
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" :src="UserAvatar">
                <div class="mdui-card-header-title">{{ UserName }}</div>
                <div class="mdui-card-header-subtitle">{{ UserMail }}</div>
            </div>
        <?php
            } else {
        ?>
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" :src="Favicon">
                <div class="mdui-card-header-title">{{ Title }}</div>
                <div class="mdui-card-header-subtitle">{{ Description }}</div>
            </div>
        <?php } ?>
        <?php } if (Get::Options('SidebarDisplay') === 'Logo') { ?>
            <img class="mdui-img-fluid" :src="SidebarLogo"/>
        <?php } ?>
            <div class="mdui-divider"></div>

            <ul class="mdui-list">
                <!-- 主导航项 -->
                <a :href="SiteUrl">
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">home</i>
                        <div class="mdui-list-item-content">首页</div>
                    </li>
                </a>
                <?php echo Get::Options("SidebarCustom"); ?>
                <li class="mdui-subheader">页面</li>
                <?php 
                    $pages = \Widget\Contents\Page\Rows::alloc(); 
                    $blocked_cids = [Get::Options('SidebarPageCid')]; 
                    while ($pages->next()): 
                        if (in_array($pages->cid, $blocked_cids)) continue; // 如果当前页面的 cid 在屏蔽列表中，则跳过
                ?>
                <a href="<?php echo $pages->permalink; ?>">
                    <li class="mdui-list-item mdui-ripple">
                        <i class="mdui-list-item-icon mdui-icon material-icons">pages</i>
                        <div class="mdui-list-item-content"><?php echo $pages->title; ?></div>
                    </li>
                </a>
                <?php endwhile; ?>
                <!-- 分类菜单 -->
                <li class="mdui-subheader">分类</li>
                <div class="mdui-collapse" mdui-collapse>
                    <!-- 文章分类 -->
                    <div class="mdui-collapse-item mdui-collapse-item-<?php echo Get::Options("SidebarNavCategory"); ?>">
                        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
                            <i class="mdui-list-item-icon mdui-icon material-icons">folder</i>
                            <div class="mdui-list-item-content">文章分类</div>
                            <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                        </div>
                        <div class="mdui-collapse-item-body mdui-list">
                            <?php 
                            $categories = \Widget\Metas\Category\Rows::alloc();
                            while ($categories->next()): 
                        ?>
                            <a href="<?php echo $categories->permalink; ?>" class="mdui-list-item mdui-ripple">
                                <div class="mdui-list-item-content"><?php echo $categories->name; ?></div>
                                <div class="drawer-item"><?php echo $categories->count; ?></div>
                            </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <li class="mdui-subheader">其他</li>
                    <!-- 翻译 -->
                    <?php if (Get::Options("SidebarTranslate") === 'open'){ ?> 
                    <div class="mdui-collapse-item mdui-collapse-item-<?php echo Get::Options("SidebarTranslateOpen"); ?>">
                        <div class="mdui-collapse-item-header mdui-list-item mdui-ripple" role="button" aria-expanded="false">
                            <i class="mdui-list-item-icon mdui-icon material-icons" aria-hidden="true">language</i>
                            <div class="mdui-list-item-content">页面翻译</div>
                            <i class="mdui-collapse-item-arrow mdui-icon material-icons" aria-hidden="true">keyboard_arrow_down</i>
                        </div>
                        <div class="ignore-translate mdui-collapse-item-body mdui-list" role="menu">
                            <?php Get::Need('Src/Tomori/Translate.php'); ?>
                        </div>
                    </div>
                    <?php }; ?>
            </ul>
        </div>
    </div>
<script>
new Vue({
    el: '#Sidebar',
    data: {
        SiteUrl: '<?php Get::SiteUrl(); ?>',
        Title: '<?php echo Get::Options('title'); ?>',
        Description: '<?php echo Get::Options('description'); ?>',
        Favicon: '<?php echo Get::Options('FaviconUrl') ? Get::Options('FaviconUrl') : GetTheme::AssetsUrl() . "/images/favicon.svg"; ?>',
        UserName: '<?php echo $this->user->screenName; ?>',
        UserMail: '<?php echo $this->user->mail; ?>',
        UserAvatar: '<?php echo \Typecho\Common::gravatarUrl($this->user->mail, 220, 'X', 'mm', $this->request->isSecure()); ?>',
        SidebarLogo: '<?php echo Get::Options('SidebarLogo') ?>',
    }
})
</script>