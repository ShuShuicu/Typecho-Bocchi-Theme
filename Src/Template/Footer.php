<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
    </div>

    <footer style="margin-top: auto;">
        <div class="mdui-valign">
            <img class="mdui-center mdui-img-fluid" src="<?php GetTheme::AssetsUrl(); ?>/images/end.png"></img>
        </div>
        <div class="mdui-card" style="border-radius: 0;">
            <div class="mdui-container">
                <div class="mdui-row mdui-p-y-4">
                    <div class="mdui-typo mdui-col-xs-4 mdui-col-md-3 mdui-col-offset-md-1">
                        <div class="mdui-float-left">
                            <div>Theme · <a href="https://blog.miomoe.cn/" target="_blank">Bocchi</a></div>
                            <div>Powered by <a href="http://typecho.org" target="_blank">Typecho</a></div>
                        </div>
                    </div>
                    <div class="mdui-typo mdui-col-xs-4 mdui-col-md-4">
                        <div class="mdui-text-center">
                            <div>© <?php echo date("Y"); ?> Copyright <a href="<?php Get::SiteUrl(); ?>"><b><?php echo Get::Options("title"); ?></b></a> 版权所有</div>
                            <div><?php if (Get::Options('IcpCode')) { echo '<a href="https://beian.miit.gov.cn/" target="_blank" rel="external nofollow noopener">' . Get::Options('IcpCode') . '</a>'; } else { echo '正在努力备案中...'; } ?></div>
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
    <!-- 
        Bocchi Theme
        前端基于MDUI框架
        后端基于TTDF框架 v<?php Get::FrameworkVer() ?> 
        Powered by Typecho v<?php Get::TypechoVer() ?> 
    -->
