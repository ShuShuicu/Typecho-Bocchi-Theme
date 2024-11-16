<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

    // 侧边翻译功能是否开启
    $SidebarTranslateOpen = new Typecho_Widget_Helper_Form_Element_Radio(
        'SidebarTranslateOpen',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'open',
            _t('<h3>功能设置</h3>翻译功能'),
            _t('是否启用侧边全站实时翻译功能，默认为启用。')
        );
    $form->addInput($SidebarTranslateOpen);
    // 面包蟹导航
    $PostNav = new Typecho_Widget_Helper_Form_Element_Radio(
        'PostNav',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'open',
            _t('面包蟹导航'),
            _t('是否启用文章顶部面包蟹导航，默认为启用。')
        );
    $form->addInput($PostNav);
    // REST API 是否开启
    $RestApiOpen = new Typecho_Widget_Helper_Form_Element_Radio(
        'RestApiOpen',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'close',
            _t('REST API'),
            _t('是否启用 REST API，默认为关闭。<br>无需求关闭即可，与WordPress REST API类似，用于开发小程序、VUE等项目。<br><a href="https://gitee.com/ShuShuicu/typecho-theme-development-framework#rest-api-%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E" target="_blank">查看TTDF REST API文档</a>')
        );
    $form->addInput($RestApiOpen);
    // pixiv加速
    $PixivPicCdn = new Typecho_Widget_Helper_Form_Element_Select(
        'PixivPicCdn',
            array(
                'https://pixiv.re/' => 'PixivRe',
                'https://pixiv.cat/' => 'PixivCat(貌似被墙了',
                'https://i0.wp.com/pixiv.re/' => 'PixivRe(WPCdn节点',
                'https://api.zbtool.cn/api/imgcdn?url=https://pixiv.re/' => 'PixivRe(李初一节点',
                'https://api.zbtool.cn/api/imgcdn?url=https://i0.wp.com/pixiv.re/' => 'PixivRe(李初一+WPCdn',
            ),
            'PixivRe',
            _t('Pixiv加速'),
            _t('Pixiv图片加速节点，推荐使用WPCdn节点。WPCdn节点加载后缓存一段时间，李初一节点无缓存。')
        );
    $form->addInput($PixivPicCdn);
    