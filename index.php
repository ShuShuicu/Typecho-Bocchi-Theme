<?php 
/**
 * Typecho Bocchi主题。
 * 如有任何不懂的问题欢迎联系作者<a href="https://space.bilibili.com/435502585"> · B站 · </a>提供帮助。
 * @package Bocchi
 * @author 鼠子Tomoriゞ
 * @version 1.1.3
 * @link https://blog.miomoe.cn/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 引入header
Get::Need('header.php');
// 引入首页
GetBocchi::Template((Get::Options('IndexStyle')));
// 引入footer
Get::Need('footer.php');
?>