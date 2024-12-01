<?php
/**
 * 这里是前端输出中的Header内容。
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
?>
<!doctype html>
<html lang="zh-CN">
<!--
    /$$$$$$$                                /$$       /$$       /$$$$$$$$ /$$                                        
    | $$__  $$                              | $$      |__/      |__  $$__/| $$                                        
    | $$  \ $$  /$$$$$$   /$$$$$$$  /$$$$$$$| $$$$$$$  /$$         | $$   | $$$$$$$   /$$$$$$  /$$$$$$/$$$$   /$$$$$$ 
    | $$$$$$$  /$$__  $$ /$$_____/ /$$_____/| $$__  $$| $$         | $$   | $$__  $$ /$$__  $$| $$_  $$_  $$ /$$__  $$
    | $$__  $$| $$  \ $$| $$      | $$      | $$  \ $$| $$         | $$   | $$  \ $$| $$$$$$$$| $$ \ $$ \ $$| $$$$$$$$
    | $$  \ $$| $$  | $$| $$      | $$      | $$  | $$| $$         | $$   | $$  | $$| $$_____/| $$ | $$ | $$| $$_____/
    | $$$$$$$/|  $$$$$$/|  $$$$$$$|  $$$$$$$| $$  | $$| $$         | $$   | $$  | $$|  $$$$$$$| $$ | $$ | $$|  $$$$$$$
    |_______/  \______/  \_______/ \_______/|__/  |__/|__/         |__/   |__/  |__/ \_______/|__/ |__/ |__/ \_______/                                                                                                  
    前端基于MDUI框架
    后端基于TTDF框架 v<?php Get::FrameworkVer() ?> 
    Powered by Typecho v<?php Get::TypechoVer() ?> 
-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
    <meta name="renderer" content="webkit" />
    <link href="<?php echo Get::Options('FaviconUrl') ? Get::Options('FaviconUrl') : GetTheme::AssetsUrl() . "/images/favicon.svg"; ?>" rel="icon" />
    <?php 
        $cssFiles = [
            'style',
            'code/BlackMac',
            'mdui/css/mdui.min',
            'nprogress/nprogress.min',
        ];
        foreach ($cssFiles as $css):
    ?>
    <link rel="stylesheet" href="<?php echo GetTheme::AssetsUrl() . "/" . $css , '.css'; ?>?ver=<?php GetTheme::Ver(); ?>">
    <?php endforeach; ?>
    <script src="<?php echo GetTheme::AssetsUrl() . "/vue.min.js"; ?>?ver=<?php GetTheme::Ver(); ?>"></script>
    <title><?php $archiveTitle = GetPost::ArchiveTitle(
            [
                "category" => _t("%s 分类"),
                "search" => _t("搜索结果"),
                "tag" => _t("%s 标签"),
                "author" => _t("%s的空间"),
            ],""," - "
        );
        echo $archiveTitle;
        if (Get::Is("index") && !empty(Get::Options("SubTitle")) && Get::CurrentPage() > 1) {
            echo "「第" . Get::CurrentPage() . "页」 - ";
        }
        $title = Get::Options("title");
        echo $title;
        if (Get::Is("index") && !empty(Get::Options("SubTitle"))) {
            echo " - ";
            $subTitle = Get::Options("SubTitle");
            echo $subTitle;
        }
        ?></title>
    <?php Get::Header() ?>
</head>
<?php GetBocchi::Template('Header') ?>
