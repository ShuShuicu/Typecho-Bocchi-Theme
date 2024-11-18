<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
    $languages = [
        'chinese_simplified' => '简体中文',
        'chinese_traditional' => '繁体中文',
        'english' => 'English',
        'japanese' => '日本語',
        'korean' => '한국어'
    ];
    foreach ($languages as $code => $name){ ?>
        <a href="javascript:translate.changeLanguage('<?php echo $code; ?>');" class="mdui-list-item mdui-ripple" role="menuitem">
            <div class="mdui-list-item-content"><?php echo $name; ?></div>
        </a>
<?php }; ?>