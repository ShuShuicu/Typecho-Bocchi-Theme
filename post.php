<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
// 引入header
Get::Need('header.php');
GetBocchi::Template('Post');
Get::Need('comments.php');
// 引入footer
Get::Need('footer.php'); 
?>