<?php 
// 首页列表模板
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="IndexCard">
<?php
$count = 0;
while(Get::Next()){ 
    if ($count % 2 == 0 && $count > 0) {
        echo '</div>'; // 关闭上一个行
    }
    if ($count % 2 == 0) {
        echo '<div class="mdui-col-xs-12">'; // 开始一个新的行
    }
    PostCard($this);
    $count++;
}; 
if ($count > 0) {
    echo '</div>'; 
}
?>

<div class="mdui-m-y-1 mdui-valign mdui-card mdui-hoverable mdui-card-content">
    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon mdui-color-theme"><i class="material-icons mdui-icon">chevron_left</i></div>'); ?>
    <span class="mdui-typo-body-1-opacity mdui-text-center" style="flex-grow:1">第 {{ CurrentPage }} 页 / 共 {{ PageSize }} 页</span>
    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon mdui-color-theme"><i class="material-icons mdui-icon">chevron_right</i></div>','next'); ?>
</div>

</div>

<script>
new Vue({
    el: '#IndexCard',
    data: {
        CurrentPage: '<?php echo Get::CurrentPage() > 1 ? Get::CurrentPage() : 1; ?>',
        PageSize: '<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?>',
    }
})
</script>

<?php
function PostCard($post) {
    $thumbnailUrl = '';
    if (Get::Options('CardThumbnail') == 'open') {
        $thumbnailStyle = Get::Fields('thumbnailStyle');
        $thumbnailUrl = $thumbnailStyle ?: get_ArticleThumbnail($post);
    }
    ?>
    <div class="mdui-col-xl-6 mdui-col-lg-6 mdui-col-md-6 mdui-col-sm-12 mdui-m-b-2">
    <a href="<?php
        if (Get::Fields('PostStyleGoUrl') === 'open') {
            echo Get::Fields('goUrlStyle');
        } else {
            GetPost::Permalink();
        }
        ?>">
            <div class="mdui-card">
                <?php if ($thumbnailUrl) { ?>
                    <div class="mdui-card-media">
                        <div class="thumbnail" style="background:url(<?php echo htmlspecialchars($thumbnailUrl); ?>);"></div>
                    </div>
                <?php }
                ; ?>
                <div class="mdui-card-content">
                    <div class="mdui-card-primary-title">
                        <?php GetPost::Title(); ?>
                    </div>
                    <div class="mdui-card-primary-subtitle">
                        <?php GetPost::Date(); ?> · <?php GetPost::Category() ?> · <?php GetPost::Tags() ?>
                    </div>
                    <?php if (Get::Options('IndexStyleExcerpt') === 'open') { ?>
                        <div class="mdui-card-actions mdui-card-primary-subtitle">
                            <?php GetPost::Excerpt(100); ?> ...
                        </div>
                    <?php } ?>
                </div>
            </div>
        </a>
    </div>
<?php
}