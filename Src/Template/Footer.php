<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div>
<div id="Footer">
    <footer style="margin-top: auto;">
        <div class="mdui-valign">
            <img class="mdui-center mdui-img-fluid" src="<?php echo GetBocchi::Assets(); ?>/images/end.png"></img>
        </div>
        <div class="mdui-card" style="border-radius: 0;">
            <div class="mdui-container">
                <div class="mdui-row mdui-p-y-4">
                    <div class="mdui-typo mdui-col-xs-4 mdui-col-md-3 mdui-col-offset-md-1">
                        <div class="mdui-float-left">
                            <div>Theme · <a :href="GitHubUrl" target="_blank">Bocchi</a></div>
                            <div>Powered by <a href="http://typecho.org" target="_blank">Typecho</a></div>
                        </div>
                    </div>
                    <div class="mdui-typo mdui-col-xs-4 mdui-col-md-4">
                        <div class="mdui-text-center">
                            <div>© <?php echo date("Y"); ?> Copyright <a :href="SiteUrl"><b><?php echo Get::Options("title"); ?></b></a> 版权所有</div>
                            <div><?php if (Get::Options('IcpCode')) { echo '<a :href="BeianUrl" target="_blank" rel="external nofollow noopener">' . Get::Options('IcpCode') . '</a>'; } else { echo '正在努力备案中...'; } ?></div>
                        </div>
                    </div>
                    <div class="mdui-col-xs-4 mdui-col-md-3">
                        <div class="mdui-float-right">
                            <div>页面加载时间 <?php GetFunctions::TimerStop(); ?></div>
                            <div class="mdui-typo">
                                <?php echo Get::Options('BottomLink'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script>
new Vue({
    el: '#Footer',
    data: {
        SiteUrl: '<?php Get::SiteUrl(); ?>',
        BeianUrl: 'https://beian.miit.gov.cn/',
        GitHubUrl: 'https://github.com/ShuShuicu/Typecho-Bocchi-Theme',
    }
})
</script>
    <!-- 
        Bocchi Theme
        前端基于MDUI框架
        后端基于TTDF框架 v<?php Get::FrameworkVer() ?> 
        Powered by Typecho v<?php Get::TypechoVer() ?> 
    -->
</div>
