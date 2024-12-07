<?php 
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div id="Post">
<?php
// 判断面包蟹导航
if (Get::Options('PostNav') === 'open') {
?>
    <div class="mdui-card mdui-card-content mdui-m-b-2">
        <div class="mdui-center"><a :href="SiteUrl">首页</a> / <a v-html="Category"></a> / {{ Title }}</div>
    </div>
<?php 
}
?>
    <div class="mdui-card mdui-m-b-2">
        <?php
            // 判断是否显示缩略图
            if (Get::Fields('PostStyleThumbnail') == 'open'){
                $thumbnailStyle = Get::Fields('thumbnailStyle');
                $thumbnailUrl = $thumbnailStyle ? $thumbnailStyle : get_ArticleThumbnail($this);  
            if ($thumbnailUrl){
        ?>
        <div class="mdui-card-media">
            <div class="thumbnail-post" style="background:url(<?php echo htmlspecialchars($thumbnailUrl); ?>);"></div>
        </div>
        <?php 
                    };
                }   
            ?>
        <div class="mdui-card-primary">
            <div class="mdui-card-primary-title">{{ Title }}</div>
            <div class="mdui-divider"></div>
            <div class="mdui-card-actions mdui-card-primary-subtitle">
                作者：<a :href="AuthorUrl">{{ Author }}</a>丨<a v-html="Category"></a> · <a v-html="Tag"></a>丨字数：{{ ZiShu }} · {{ Date }}
            </div>
            <div class="mdui-divider"></div>
            <div class="mdui-card-content">
                <div class="mdui-typo" id="PostContent">
                    <?php GetPost::Content(); ?>
                </div>
            </div>
        </div>
    </div>

    <?php if (Get::Fields('PostStyleButton') === 'open') { ?>

    <div class="mdui-card mdui-card-content mdui-m-b-2">

<?php 
    // 获取文章的 buttonStyle 字段内容
    $buttons = Get::Fields('buttonStyle');

    // 如果字段不为空
    if (!empty($buttons)) {
        // 分行解析
        $buttonLines = explode("\n", $buttons);
        foreach ($buttonLines as $button) {
            // 正则解析 [按钮名称](按钮链接)
            if (preg_match('/\[(.*?)\]\((.*?)\)/', trim($button), $matches)) {
                $buttonText = $matches[1]; // 按钮名称
                $buttonLink = $matches[2]; // 按钮链接
    ?>
        <a target="_blank" href="<?php echo htmlspecialchars($buttonLink); ?>">
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" style="border-radius: 8px">
                <b><?php echo htmlspecialchars($buttonText); ?></b>
            </button>
        </a>
        <?php
            }
        }
    }
    ?>

        <?php 
    // 获取文章的 buttonStyle 字段内容
    $buttons = Get::Fields('buttonStyle');

    // 如果字段不为空
    if (!empty($buttons)) {
        // 分行解析
        $buttonLines = explode("\n", $buttons);
        foreach ($buttonLines as $button) {
            // 正则解析 名称|介绍|链接|超链
            if (preg_match('/^(.*?)\|(.*?)\|(.*?)\|(.*?)$/', trim($button), $matches)) {
                $buttonText = $matches[1]; // 按钮名称
                $buttonIntro = $matches[2]; // 按钮介绍
                $buttonImg = $matches[3]; // 图片链接
                $buttonLink = $matches[4]; // 按钮超链
    ?>
        <div class="mdui-card mdui-m-y-1 mdui-hoverable">
            <a href="<?php echo htmlspecialchars($buttonLink); ?>" target="_blank" rel="external nofollow">
                <div class="mdui-card-header">
                    <img class="mdui-card-header-avatar" src="<?php echo htmlspecialchars($buttonImg); ?>" alt="<?php echo htmlspecialchars($buttonLink); ?>">
                    <div class="mdui-card-header-title"><?php echo htmlspecialchars($buttonText); ?></div>
                    <div class="mdui-card-header-subtitle"><?php echo htmlspecialchars($buttonIntro); ?></div>
                </div>
            </a>
        </div>
        <?php
            }
        }
    }
    ?>
    </div>
    <?php }; ?>

    <div class="mdui-card mdui-m-b-2 mdui-card-primary">
        <fieldset style="border: 1px dashed #008cff;padding: 10px;border-radius: 5px;line-height: 2em;color: #6d6d6d;">
            <legend align="center" style="width: 30%;text-align: center;background-color: #008cff;border-radius: 5px;background-image: linear-gradient(to right, #FFCC99, #FF99CC); text-align:center;">
                文章版权声明
            </legend>
            本网站名称：<span style=" color: #3333ff"><span style="color: #FF6666; font-size: 18px"><strong>{{ SiteTitle }}</strong></span></span><br />
            本站永久网址：<font color="#FF6666">{{ SiteUrl }}</font><br />
            <?php echo Get::Options('PostCopyright'); ?>
        </fieldset>
    </div>

</div>
<script>
    new Vue({
        el: '#Post',
        data: {
            SiteUrl: '<?php Get::SiteUrl(); ?>',
            SiteTitle: '<?php echo Get::Options('title'); ?>',
            Title: '<?php GetPost::Title(); ?>',
            Date: '<?php GetPost::Date(); ?>',
            Tag: '<?php GetPost::Tags(); ?>',
            Author: '<?php GetPost::Author(); ?>',
            AuthorUrl: '<?php $this->author->permalink(); ?>',
            Category: '<?php GetPost::Category(',', true); ?>',
            ZiShu: '<?php $zishu=mb_strlen($this->content); echo $zishu; ?>',
        }
    })
</script>
