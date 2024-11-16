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

    // 按钮字段
    $buttonStyle = new Typecho_Widget_Helper_Form_Element_Textarea(
        'buttonStyle', 
        NULL, 
        NULL,  
        _t('按钮'), 
        _t('请填入按钮链接用于自定义文章底部按钮，格式为：[按钮名称](按钮链接)，多个按钮请分行填写。')
    );
    $buttonStyle->input->setAttribute('style', 'width: 100%;');
    $layout->addItem($buttonStyle);

}

Typecho_Plugin::factory('admin/write-post.php')->bottom = 'themeFields';
Typecho_Plugin::factory('admin/write-page.php')->bottom = 'themeFields';