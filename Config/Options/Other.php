<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

    // Drive目录
    $MioDriveDir = new Typecho_Widget_Helper_Form_Element_Text(
        'MioDriveDir',
            NULL,
            'Files',
            _t('<h3>功能设置</h3>Drive目录'),
            _t('请填入Drive功能的目录，默认为' . THEME_URL . ' /Src/Tomori/Drive 下的 Files 目录。')
        );
    $form->addInput($MioDriveDir);
    // 前台投稿
    $NewPost = new Typecho_Widget_Helper_Form_Element_Radio(
        'NewPost',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'close',
            _t('前台投稿'),
            _t('是否启用前台投稿，默认为关闭。')
        );
    $form->addInput($NewPost);
    // 是否文章评论
    $PostComments = new Typecho_Widget_Helper_Form_Element_Radio(
        'PostComments',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'open',
            _t('文章评论'),
            _t('是否启用文章评论，应付管局用，默认为开启。')
        );
    $form->addInput($PostComments);
    // 外链转内链
    $GoLinkUrl = new Typecho_Widget_Helper_Form_Element_Radio(
        'GoLinkUrl',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'open',
            _t('外转内链'),
            _t('是否启用文章外链转内链跳转，默认为启用。')
        );
    $form->addInput($GoLinkUrl);
    // 是否禁止明文跳转
    $GoLinkUrlBase64 = new Typecho_Widget_Helper_Form_Element_Radio(
        'GoLinkUrlBase64',
            array(
                'open' => '允许',
                'close' => '禁止',
            ),
            'open',
            _t('Base64跳转'),
            _t('文章链接跳转是否为Base64，建议开启防止网站被刷。')
        );
    $form->addInput($GoLinkUrlBase64);

    // 侧边翻译功能是否开启
    $SidebarTranslate = new Typecho_Widget_Helper_Form_Element_Radio(
        'SidebarTranslate',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'open',
            _t('翻译功能'),
            _t('是否启用侧边全站实时翻译功能，默认为启用。')
        );
    $form->addInput($SidebarTranslate);
    // 面包蟹导航
    $PostNav = new Typecho_Widget_Helper_Form_Element_Radio(
        'PostNav',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'close',
            _t('面包蟹导航'),
            _t('是否启用文章顶部面包蟹导航，默认为关闭。')
        );
    $form->addInput($PostNav);
    // REST API 是否开启
    $RestApi = new Typecho_Widget_Helper_Form_Element_Radio(
        'RestApi',
            array(
                'open' => '启用',
                'close' => '关闭',
            ),
            'close',
            _t('REST API'),
            _t('是否启用 REST API，默认为关闭。<br>无需求关闭即可，与WordPress REST API类似，用于开发小程序、VUE等项目。<br><a href="https://gitee.com/ShuShuicu/typecho-theme-development-framework#rest-api-%E4%BD%BF%E7%94%A8%E8%AF%B4%E6%98%8E" target="_blank">查看TTDF REST API文档</a>')
        );
    $form->addInput($RestApi);
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
    // 文章版权自定义
    $PostCopyright = new Typecho_Widget_Helper_Form_Element_Textarea(
        'PostCopyright',
            NULL,
            '如有侵权，请联系站长进行删除处理。<br />
            本站文章大部分为原创，用于个人学习记录，可能对您有所帮助，仅供参考！',
            _t('文章版权'),
            _t('文章版权自定义，支持HTML。')
        );
    $form->addInput($PostCopyright);
    // 自定义代码
    $HeaderStyleCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'HeaderStyleCode',
            NULL,
            NULL,
            _t('顶部自定义代码'),
            _t('一般为自定义css或统计代码。需要填写自定义HTML标签。')
        );
    $form->addInput($HeaderStyleCode);
    $FooterStyleCode = new Typecho_Widget_Helper_Form_Element_Textarea(
        'FooterStyleCode',
            NULL,
            NULL,
            _t('底部自定义代码'),
            _t('一般为自定义JavaScript代码，需要填写自定义HTML标签。')
        );
    $form->addInput($FooterStyleCode);