<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="IndexList">
<?php
while(Get::Next()){ 
    PostCard($this);
}; 
?>

<div class="mdui-m-y-1 mdui-valign mdui-card mdui-hoverable mdui-card-content">
    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon mdui-color-theme"><i class="material-icons mdui-icon">chevron_left</i></div>'); ?>
    <span class="mdui-typo-body-1-opacity mdui-text-center" style="flex-grow:1">第 {{ CurrentPage }} 页 / 共 {{ PageSize }} 页</span>
    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon mdui-color-theme"><i class="material-icons mdui-icon">chevron_right</i></div>','next'); ?>
</div>

</div>

<script>
new Vue({
    el: '#IndexList',
    data: {
        CurrentPage: '<?php echo Get::CurrentPage() > 1 ? Get::CurrentPage() : 1; ?>',
        PageSize: '<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?>',
    },
    mounted() {
        console.log('CurrentPage:', this.CurrentPage);
        console.log('PageSize:', this.PageSize);
    }
})
</script>

<?php
function PostCard($post) {
    $thumbnailUrl = '';
    if (Get::Options('IndexStyleThumbnail') == 'open') {
        $thumbnailStyle = Get::Fields('thumbnailStyle');
        $thumbnailUrl = $thumbnailStyle ?: get_ArticleThumbnail($post);
    }
    ?>
    <div class="mdui-col-xs-12 mdui-m-b-2">
        <a href="<?php 
            if (Get::Fields('PostStyleGoUrl') === 'open') {
                echo Get::Fields('goUrlStyle');
            } else {
                GetPost::Permalink();
            }
        ?>">
            <div class="mdui-card mdui-hoverable">
                <?php if ($thumbnailUrl){ ?>
                <div class="mdui-card-media">
                    <div class="thumbnail" style="background:url(<?php echo htmlspecialchars($thumbnailUrl); ?>);"></div>
                </div>
                <?php }; ?>
                <div class="mdui-card-primary">
                    <div class="mdui-card-primary-title"><?php GetPost::Title(); ?></div>
                    <div class="mdui-card-primary-subtitle"><?php GetPost::Date(); ?> · <?php GetPost::Category() ?> · <?php GetPost::Tags() ?></div>
                    <?php if (Get::Options('IndexStyleExcerpt') === 'open'){ ?>
                    <div class="mdui-divider"></div>
                    <div class="mdui-card-content"><?php GetPost::Excerpt(100); ?> ...</div>
                    <?php }; ?>
                </div>
            </div>
        </a>
    </div>
<?php
}