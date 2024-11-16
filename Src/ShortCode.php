<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 短代码
 */
// 短代码解析函数

function parse_button_shortcode($content) {
    $pattern = '/\[b\s*url=\"(.*?)\"\](.*?)\[\/b\]/i';
    $callback = function ($matches) {
        $buttonLink = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
        $buttonName = htmlspecialchars($matches[2], ENT_QUOTES, 'UTF-8');
        return '<a target="_blank" href="' . $buttonLink . '"><button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent"><b>' . $buttonName . '</b></button></a>';
    };
    return preg_replace_callback($pattern, $callback, $content);
}

function add_shortcode_support($content) {
    $content = htmlspecialchars_decode($content); // 先解码HTML实体
    $content = parse_button_shortcode($content);
    return $content;
}

// 为文章内容和摘要添加过滤器
Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = 'add_shortcode_support';
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = 'add_shortcode_support';
