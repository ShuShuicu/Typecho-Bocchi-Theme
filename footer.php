<?php 
/**
 * 这里是前端输出中的Footer内容。
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
    GetBocchi::Template('Footer');
        $jsFiles = [
            'ttdf',
            'translate.min',
            'view-image.min',
            'code/prism.full',
            'mdui/js/mdui.min',
            'jquery/jquery.min',
            'jquery/jquery.pjax.min',
            'nprogress/nprogress.min',
            'pjax',
        ];
        foreach ($jsFiles as $js): ?>
    <script src="<?php echo GetTheme::AssetsUrl() . "/" . $js . '.js'; ?>?ver=<?php GetTheme::Ver(); ?>"></script>
    <?php endforeach; ?>
    <?php Get::Footer() ?>
</body>
</html>