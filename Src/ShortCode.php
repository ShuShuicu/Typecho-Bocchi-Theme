<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * 短代码解析
 */
class ShortCodeParser {
    public function __construct() {
        // 为文章内容和摘要添加过滤器
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array($this, 'add_shortcode_support');
        Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array($this, 'add_shortcode_support');
    }

    /**
     * 解码HTML实体并解析短代码
     *
     * @param string $content
     * @return string
     */
    public function add_shortcode_support($content) {
        if(!empty($content)){
        $content = htmlspecialchars_decode($content); // 先解码HTML实体
        $content = $this->parse_button_shortcode($content);
        }
        return $content;
    }

    /**
     * 解析按钮短代码
     *
     * @param string $content
     * @return string
     */
    private function parse_button_shortcode($content) {
        // 按钮
        $pattern = '/\[b\s*url="(.*?)"\](.*?)\[\/b\]/i';
        $callback = function ($matches) {
            $buttonLink = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
            $buttonName = htmlspecialchars($matches[2], ENT_QUOTES, 'UTF-8');
            return '<a target="_blank" rel="external nofollow" href="' . $buttonLink . '">
                <button class="mdui-btn mdui-btn-raised mzei-ripple mdui-color-theme-accent"><b>' . $buttonName . '</b></button></a>';
        };
        $content = preg_replace_callback($pattern, $callback, $content);

        // 纸片短代码
        $pattern_c = '/\[c url="(.*?)" img="(.*?)"\](.*?)\[\/c\]/i';
        $callback_c = function ($matches) {
            $link = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
            $image = htmlspecialchars($matches[2], ENT_QUOTES, 'UTF-8');
            $text = htmlspecialchars($matches[3], ENT_QUOTES, 'UTF-8');
            return '
                <div class="mdui-chip">
                    <img class="mdui-chip-icon" src="' . $image . '" alt="Chip Icon" />
                        <span class="mdui-chip-title">
                        <a target="_blank" rel="external nofollow" href="' . $link . '">' . $text . '</a>
                    </span>
                </div>
            ';
        };
        $content = preg_replace_callback($pattern_c, $callback_c, $content);

        // 提示短代码
        $pattern_t = '/\[t\](.*?)\[\/t\]/i';
        $callback_t = function ($matches) {
            $text = htmlspecialchars($matches[1], ENT_QUOTES, 'UTF-8');
            return '
            <div class="mdui-card mdui-color-indigo">
			<div class="mdui-card-content mdui-valign">
				<div class="mdui-m-r-2"><i class="mdui-icon material-icons">info</i></div>
				<div style="font-size: 1.3em;">' . $text . '</strong></div>
			</div>
		</div>
            ';
        };
        $content = preg_replace_callback($pattern_t, $callback_t, $content);

        return $content;

    }
}

// 初始化短代码解析器
$shortCodeParser = new ShortCodeParser();