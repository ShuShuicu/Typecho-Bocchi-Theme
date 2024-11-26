<?php 
// 首页列表模板
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="IndexPanel">
<div class="mdui-card mdui-m-b-2">

<div class="mdui-panel" mdui-panel>
<?php while (Get::Next()): ?>
  <div class="mdui-panel-item">
    <div class="mdui-panel-item-header">
      <div class="mdui-panel-item-title"><?php GetPost::Title(); ?></div>
      <div class="mdui-panel-item-summary"><?php GetPost::Category(',', true); ?> · <?php GetPost::Tags(',', true); ?> · <?php GetPost::Date(); ?></div>
      <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
        <div class="mdui-divider"></div>
    <div class="mdui-panel-item-body">
        <?php GetPost::Content(); ?>
    </div>
  </div>
  <?php endwhile; ?>
</div>

</div>

<div class="mdui-m-y-1 mdui-valign mdui-card mdui-hoverable mdui-card-content">
    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon mdui-color-theme"><i class="material-icons mdui-icon">chevron_left</i></div>'); ?>
        <span class="mdui-typo-body-1-opacity mdui-text-center" style="flex-grow:1">第 {{ CurrentPage }} 页 / 共 {{ PageSize }} 页</span>
    <?php Get::PageLink('<div class="mdui-ripple mdui-btn mdui-btn-icon mdui-color-theme"><i class="material-icons mdui-icon">chevron_right</i></div>','next'); ?>
</div>

</div>
<script>
new Vue({
    el: '#IndexPanel',
    data: {
        CurrentPage: '<?php echo Get::CurrentPage() > 1 ? Get::CurrentPage() : 1; ?>',
        PageSize: '<?php echo ceil($this->getTotal() / $this->parameter->pageSize); ?>',
    }
})
</script>
