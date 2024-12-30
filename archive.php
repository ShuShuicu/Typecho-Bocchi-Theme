<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
Get::Need('header.php');
GetBocchi::Template((Get::Options('ArchiveStyle')));
Get::Need('footer.php');