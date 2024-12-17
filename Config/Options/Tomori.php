<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
    // 评论头像
    $AvatarCdn = new Typecho_Widget_Helper_Form_Element_Select(
        'AvatarCdn',
        array(
            'https://weavatar.com/avatar/'=> _t('WeAvatar'),
            'https://cravatar.cn/avatar/' => _t('CrAvatar'),
            'https://cn.gravatar.com/avatar/'=> _t('GrAvatar'),
            'https://i0.wp.com/cn.gravatar.com/avatar/'=> _t('GrAvatar(WP源'),
            'https://api.x-x.work/get/Avatar?Gravatar='=> _t('GrAvatar(鼠子源'),
        ),
        'https://weavatar.com/avatar/',
        _t('<h3>全局设置</h3>Avatar'),
        _t('请选择Avatar源，用于评论头像展示。')
    );
    $form->addInput($AvatarCdn);

    // 副标题
    $SubTitle = new Typecho_Widget_Helper_Form_Element_Text(
        'SubTitle',
        NULL,
        '由Bocchi主题强力驱动',
        _t('副标题'),
        _t('输入一段描述，将会显示在网站首页 title 后方，留空不显示。')
    );
    $form->addInput($SubTitle);
    
    // favicon
    $FaviconUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'FaviconUrl',
        NULL,
        '' . THEME_URL . '/Assets/images/favicon.svg',
        _t('网站图标'),
        _t('请填入网站图标，没有则显示主题默认图标。')
    );
    $form->addInput($FaviconUrl);
    
    // icpCode
    $IcpCode = new Typecho_Widget_Helper_Form_Element_Text(
        'IcpCode',
        NULL,
        NULL,
        _t('ICP备案号'),
        _t('请填入ICP备案号，留空不显示。请前往<a href="https://beian.miit.gov.cn/" target="_blank">工信部</a>申请备案。')
    );
    $form->addInput($IcpCode);

    // AssetsCDN 加速
    $AssetsCdn = new Typecho_Widget_Helper_Form_Element_Radio(
        'AssetsCdn',
            array(
                'default' => '本地',
                'PoppinParty' => '自定义',
                'https://ss.bscstorage.com/wpteam/assets/themes/Bocchi/' => '白山云',
                'https://cdn.jsdelivr.net/gh/ShuShuicu/Typecho-Bocchi-Theme@master/Assets/' => 'jsDelivr',
                'https://cdn.jsdmirror.com/gh/ShuShuicu/Typecho-Bocchi-Theme@master/Assets/' => 'jsDMirror',
            ),
            'default',
            _t('静态资源加速'),
            _t('主题目录下的Assets目录CDN静态资源加速。')
        );
    $form->addInput($AssetsCdn);
    // 自定义资源地址
    $AssetsCdnUrl = new Typecho_Widget_Helper_Form_Element_Text(
        'AssetsCdnUrl',
        NULL,
        NULL,
        _t('自定义资源地址'),
        _t('自定义资源地址，请以http / s开头 / 结尾。<hr>')
    );
    $form->addInput($AssetsCdnUrl);
