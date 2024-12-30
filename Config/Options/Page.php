<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
    // 首页模板
    $IndexStyle = new Typecho_Widget_Helper_Form_Element_Select(
        'IndexStyle',
            array(
                'Card' => '卡片',
                'List' => '列表',
                'Panel' => '面板',
            ),  // 添加选项数组
            'Card',
            _t('<h3>页面设置</h3>首页模板'),
            _t('请选择首页文章列表的显示方式，默认为列表，面板模式适用于文档站。')
        );
        $form->addInput($IndexStyle);
    // 分类列表
    $ArchiveStyle = new Typecho_Widget_Helper_Form_Element_Select(
        'ArchiveStyle',
            array(
                'Card' => '卡片',
                'List' => '列表',
                'Panel' => '面板',
            ),  // 添加选项数组
            'List',
            _t('分类模板'),
            _t('请选择分类标签文章列表的显示方式，默认为列表。')
        );
        $form->addInput($ArchiveStyle);
    // 首页缩略图
    $IndexStyleThumbnail = new Typecho_Widget_Helper_Form_Element_Radio(
        'IndexStyleThumbnail',
            array(
                'open' => '打开',
                'close' => '关闭',
            ),
            'close',
            _t('首页缩略图'),
            _t('是否在文章列表中显示缩略图，注：面板模式不生效。')
        );
        $form->addInput($IndexStyleThumbnail);
    // 首页介绍
    $IndexStyleExcerpt = new Typecho_Widget_Helper_Form_Element_Radio(
        'IndexStyleExcerpt',
            array(
                'open' => '打开',
                'close' => '关闭',
            ),
            'close',
            _t('首页文章简介'),
            _t('是否在文章列表中显示文章简介，注：面板模式不生效。')
        );
        $form->addInput($IndexStyleExcerpt);
    // 侧边显示设置
    $SidebarDisplay = new Typecho_Widget_Helper_Form_Element_Radio(
        'SidebarDisplay',
            array(
                'Author' => '作者',
                'Logo' => 'Logo',
                'close' => '关闭',
            ),
            'Author',
            _t('Author&Logo'),
            _t('侧边顶部显示为作者介绍或Logo设置。')
        );
        $form->addInput($SidebarDisplay);
    // 侧边顶部Logo
    $SidebarLogo = new Typecho_Widget_Helper_Form_Element_Text(
        'SidebarLogo',
        NULL,
        '' . THEME_URL . '/Assets/images/logo.png',
        _t('Logo地址'),
        _t('请填入Logo地址，没有则显示网站标题。')
    );
    $form->addInput($SidebarLogo);

    // 侧边导航分类
    $SidebarNavCategory = new Typecho_Widget_Helper_Form_Element_Radio(
        'SidebarNavCategory',
            array(
                'open' => '展开',
                'close' => '折叠',
            ),
            'open',
            _t('侧边分类'),
            _t('是否在侧边导航中默认展开显示分类列表')
        );
        $form->addInput($SidebarNavCategory);
    // 侧边翻译
    $SidebarTranslateOpen = new Typecho_Widget_Helper_Form_Element_Radio(
        'SidebarTranslateOpen',
            array(
                'open' => '展开',
                'close' => '折叠',
            ),
            'close',
            _t('侧边翻译'),
            _t('是否在侧边导航中默认展开显示翻译列表')
        );
        $form->addInput($SidebarTranslateOpen);
    // 侧边屏蔽页面Cid
    $SidebarPageCid = new Typecho_Widget_Helper_Form_Element_Text(
        'SidebarPageCid',
            NULL,
            NULL,
            _t('侧边屏蔽页面'),
            _t('请填入需要屏蔽的页面Cid，多个Cid请用英文逗号隔开，留空不屏蔽。')
        );
    $form->addInput($SidebarPageCid);
    // 侧边自定义
    $SidebarCustom = new Typecho_Widget_Helper_Form_Element_Textarea(
        'SidebarCustom',
            NULL,
            '<a href="' . Get::Options("feedUrl") . '">
                <li class="mdui-list-item mdui-ripple">
                    <i class="mdui-list-item-icon mdui-icon material-icons">rss_feed</i>
                    <div class="mdui-list-item-content">订阅</div>
                </li>
            </a>',
            _t('侧边自定义'),
            _t('请填入侧边自定义内容，留空不显示。推荐使用MDUI列表组件 <a href="https://www.mdui.org/docs/list" target="_blank">查看文档</a>')
        );
        $form->addInput($SidebarCustom);

    // 底部自定义链接
    $BottomLink = new Typecho_Widget_Helper_Form_Element_Textarea(
    'BottomLink',
        NULL,
        '哔哩哔哩<a href="https://space.bilibili.com/435502585" target="_blank">@Tomori</a>',
        _t('底部自定义链接'),
        _t('请填入底部自定义链接，留空不显示。<hr>')
    );
    $form->addInput($BottomLink);
