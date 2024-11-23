<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
        <div class="mdui-drawer mdui-card" id="drawer" style="border-radius: 0;">

        <?php if (Get::Options('SidebarDisplay') === 'Author'){ ?>

            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" src="<?php echo Get::Options('SidebarAuthorAvatar') ? Get::Options('SidebarAuthorAvatar') : GetTheme::AssetsUrl() . "/images/favicon.svg"; ?>">
                <div class="mdui-card-header-title"><?php echo Get::Options('SidebarAuthor') ? Get::Options('SidebarAuthor') : Get::Options('title'); ?></div>
                <div class="mdui-card-header-subtitle"><?php echo Get::Options('SidebarAuthorInfo') ? Get::Options('SidebarAuthorInfo') : Get::Options('description'); ?></div>
            </div>
        <?php } if (Get::Options('SidebarDisplay') === 'Logo') { ?>
            <img class="mdui-img-fluid" src="<?php echo Get::Options('SidebarLogo') ?>"/>
        <?php } ?>
            <div class="mdui-divider"></div>

            <ul class="mdui-list">
                <!-- 主导航项 -->
                <a href="<?php echo Get::Options("siteUrl"); ?>">
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
                <li class="mdui-subheader">分类统计</li>
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
        