<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="IndexList">
<div class="mdui-row-xs-1 mdui-row-sm-2 mdui-row-md-2 mdui-row-lg-4 mdui-row-xl-4 mdui-m-b-2">
<?php
while(Get::Next()){ 
    PostCard($this);
}; 
?>
</div>
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

<style>
@media (max-width: 1024px) {
    .thumbnail {
        height: 200px;
    }
}

.mdui-col .mdui-card-header-title,
.mdui-col .mdui-card-header-subtitle {
    margin-left: 5px;
}
</style>

<?php
function Posts() {
    
}

function PostCard($post) {
    $thumbnailUrl = '';
    if (Get::Options('CardThumbnail') == 'open') {
        $thumbnailStyle = Get::Fields('thumbnailStyle');
        $thumbnailUrl = $thumbnailStyle ?: get_ArticleThumbnail($post);
    }
    ?>
    <div class="mdui-col">
        <a href="<?php 
            if (Get::Fields('PostStyleGoUrl') === 'open') {
                echo Get::Fields('goUrlStyle');
            } else {
                GetPost::Permalink();
            }
        ?>">
            <div class="mdui-card mdui-m-b-2 mdui-hoverable">
                <?php if ($thumbnailUrl){ ?>
                    <div class="mdui-card-media">
                        <div class="thumbnail" style="background:url(<?php echo htmlspecialchars($thumbnailUrl); ?>);"></div>
                    </div>
                <?php }; ?>
                <div class="mdui-card-header">
                    <div class="mdui-card-header-title"><?php GetPost::Title(); ?></div>
                    <div class="mdui-card-header-subtitle"><?php GetPost::Date(); ?> · <?php GetPost::Category() ?> · <?php GetPost::Tags() ?></div>
                </div>
            </div>
        </a>
    </div>
<?php
}
