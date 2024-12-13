<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if (Get::Fields('PostStyleButton') === 'open') { 
?>

<div class="mdui-card mdui-card-content mdui-m-b-2">

<?php 
// 获取文章的 buttonStyle 字段内容
$buttons = Get::Fields('buttonStyle');

// 如果字段不为空
if (!empty($buttons)) {
    // 分行解析
    $buttonLines = explode("\n", $buttons);
    foreach ($buttonLines as $button) {
        // 正则解析 [按钮名称](按钮链接)
        if (preg_match('/\[(.*?)\]\((.*?)\)/', trim($button), $matches)) {
            $buttonText = $matches[1]; // 按钮名称
            $buttonLink = $matches[2]; // 按钮链接
?>
    <a target="_blank" href="<?php echo htmlspecialchars($buttonLink); ?>">
        <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" style="border-radius: 8px">
            <b><?php echo htmlspecialchars($buttonText); ?></b>
        </button>
    </a>
    <?php
        }
    }
}

// 获取文章的 buttonStyle 字段内容
$buttons = Get::Fields('buttonStyle');

// 如果字段不为空
if (!empty($buttons)) {
    // 分行解析
    $buttonLines = explode("\n", $buttons);
    foreach ($buttonLines as $button) {
        // 正则解析 名称|介绍|链接|超链
        if (preg_match('/^(.*?)\|(.*?)\|(.*?)\|(.*?)$/', trim($button), $matches)) {
            $buttonText = $matches[1]; // 按钮名称
            $buttonIntro = $matches[2]; // 按钮介绍
            $buttonImg = $matches[3]; // 图片链接
            $buttonLink = $matches[4]; // 按钮超链

            // 判断图片链接为空，输出自动识别图标
            if (empty($buttonImg)) {
                $domainIcons = [
                    // 互联网
                    'bt\.cn' => 'Bt.svg',
                    'qq\.com' => 'qq.svg',
                    'baidu\.com' => 'Baidu.svg',
                    'weibo\.com' => 'Weibo.svg',
                    'gitee\.com' => 'Gitee.svg',
                    'github\.com' => 'Github.svg',
                    'aliyun\.com' => 'AliCloud.svg',
                    'qcloud\.com' => 'QCloud.svg',
                    'tencent\.com' => 'QCloud.svg',
                    // 云盘类
                    'uc\.CN' => 'uc.svg',
                    'quark\.CN' => 'Quark.svg',
                    '123pan\.com' => '123Pan.svg',
                    '123684\.com' => '123Pan.svg',
                    'alipan\.com' => 'AliPan.svg',
                    'aliyundrive\.com' => 'AliPan.svg',
                ];

                foreach ($domainIcons as $domain => $icon) {
                    if (preg_match('/^https?:\/\/[^\/]+\.' . $domain . '\/?$/', $buttonLink)) {
                        $buttonImg = GetTheme::Url(false) . '/Assets/images/icon/' . $icon;
                        break;
                    }
                }
            }
?>
    <div class="mdui-card mdui-m-y-1 mdui-hoverable">
        <a href="<?php echo htmlspecialchars($buttonLink); ?>" target="_blank" rel="external nofollow">
            <div class="mdui-card-header">
                <img class="mdui-card-header-avatar" src="<?php echo htmlspecialchars($buttonImg); ?>" alt="<?php echo htmlspecialchars($buttonLink); ?>">
                <div class="mdui-card-header-title"><?php echo htmlspecialchars($buttonText); ?></div>
                <div class="mdui-card-header-subtitle"><?php echo htmlspecialchars($buttonIntro); ?></div>
            </div>
        </a>
    </div>
    <?php
        }
    }
}
?>
</div>
<?php }; ?>