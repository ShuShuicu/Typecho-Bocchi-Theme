<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="Page">
    <div class="mdui-card mdui-m-b-2">
        <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">{{ Ttile }}</div>
            <div class="mdui-card-primary-subtitle">
                {{ Date }}
            </div>
            <div class="mdui-divider"></div>
            <div class="mdui-card-content mdui-typo" id="PostContent" v-html="Content"></div>
        </div>
    </div>
</div>
<script>
new Vue({
    el: '#Page',
    data: {
        Title: '<?php GetPost::Title(); ?>',
        Date: '<?php GetPost::Date(); ?>',
        Content: '<?php GetPost::Content(); ?>',
    }
})
</script>
