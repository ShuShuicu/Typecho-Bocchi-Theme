<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeFields($layout) 
{

    // 是否缩略图
    $PostStyleThumbnail = new Typecho_Widget_Helper_Form_Element_Radio(
        'PostStyleThumbnail',
        array(
            'close' => '关闭',
            'open' => '打开'
        ),
        'close',
        _t('顶图'),
        _t('文章顶部将显示图片')
    );
    $layout->addItem($PostStyleThumbnail);

    // 缩略图字段
    $thumbnailStyle = new Typecho_Widget_Helper_Form_Element_Text(
        'thumbnailStyle', 
        NULL, 
        NULL,  
        _t
        ('缩略图'), 
        _t('请填入图片链接用于自定义文章缩略图 / 顶图，不填写取文章第一张图。')
    );
    $thumbnailStyle->input->setAttribute(
        'style', 'width: 100%;'
    );
    $layout->addItem($thumbnailStyle);

    // 是否文章跳转
    $PostStyleGoUrl = new Typecho_Widget_Helper_Form_Element_Radio(
        'PostStyleGoUrl',
        array(
            'close' => '关闭',
            'open' => '打开'
        ),
        'close',
        _t('跳转'),
        _t('在文章列表点击文章标题将跳转到指定链接。')
    );
    $layout->addItem($PostStyleGoUrl);
    $goUrlStyle = new Typecho_Widget_Helper_Form_Element_Text(
        'goUrlStyle', 
        NULL, 
        NULL,  
        _t
        ('跳转链接'), 
        _t('请输入文章跳转链接。')
    );
    $goUrlStyle->input->setAttribute(
        'style', 'width: 100%;'
    );
    $layout->addItem($goUrlStyle);

    // 是否按钮
    $PostStyleButton = new Typecho_Widget_Helper_Form_Element_Radio(
        'PostStyleButton',
        array(
            'close' => '关闭',
            'open' => '打开'
        ),
        'close',
        _t('按钮'),
        _t('文章顶部将显示按钮')
    );
    $layout->addItem($PostStyleButton);

    // 按钮字段
    $buttonStyle = new Typecho_Widget_Helper_Form_Element_Textarea(
        'buttonStyle', 
        NULL, 
        NULL,  
        _t('按钮内容'), 
        _t('请填入按钮链接用于自定义文章底部按钮<hr>格式：<br>短按钮：[按钮名称](按钮链接)<br>长按钮：名称|介绍|图片|超链<br>如果图片链接为空则自动识别<hr>')
    );
    $buttonStyle->input->setAttribute('style', 'width: 100%;height: 100px;');
    $layout->addItem($buttonStyle);

}

Typecho_Plugin::factory('admin/write-post.php')->bottom = 'themeFields';
Typecho_Plugin::factory('admin/write-page.php')->bottom = 'themeFields';
