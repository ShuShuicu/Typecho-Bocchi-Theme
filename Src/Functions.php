<?php 
/**
 * 这里是主题函数 / 功能文件。
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$ThemeVer = GetTheme::Ver(false);
define('BocchiVer', $ThemeVer);
$avatarCdn = Get::Options('AvatarCdn');
define('__TYPECHO_GRAVATAR_PREFIX__', $avatarCdn);

// 判断REST API是否启用
if (Get::Options('RestApi') === 'open') {
    GetJsonData::Tomori();
}

// 跳转
if (Get::Options('GoLinkUrl') === 'open' && isset($_GET['GoLink']) && isset($_GET['Url'])) {
    Get::Need('Src/Tomori/GoLink.php');
    exit;
}

// 外链转内链
function convertLinks($content, $widget, $lastResult = null)
{
    $content = $lastResult ?? $content;
    $siteUrl = Get::Options('siteUrl');
    $goLinkUrlBase64 = Get::Options('GoLinkUrlBase64') === 'open';

    // 缓存选项以避免重复调用
    $options = [
        'siteUrl' => $siteUrl,
        'goLinkUrlBase64' => $goLinkUrlBase64
    ];

    return preg_replace_callback(
        '/<a\s+(.*?)href="([^"]+)"(.*?)>/i',
        function ($matches) use ($options) {
            $url = $matches[2];

            if (strpos($url, $options['siteUrl']) === false) {
                $encodedUrl = $options['goLinkUrlBase64'] ? base64_encode($url) : $url;
                return "<a {$matches[1]} target='_blank' href=\"{$options['siteUrl']}?GoLink&Url={$encodedUrl}\"{$matches[3]}>"; 
            }

            return "<a {$matches[1]}href=\"{$url}\"{$matches[3]}>"; 
        },
        $content
    );
}

// 主题初始化
function themeInit($archive)
{
    // 公共部分
    Helper::options()->commentsPageDisplay = 'first';
    Helper::options()->commentsOrder = 'DESC';
    Helper::options()->commentsMaxNestingLevels = 999;

    if (Get::Options('GoLinkUrl') === 'open') {
        // 在文章内容输出前调用 convertLinks
        $archive->content = convertLinks($archive->content, $archive);
    }

}

// 获取评论@函数
function get_comment_at($coid)
{
    $db = Typecho_Db::get();
    $prow = $db->fetchRow($db->select('parent')->from('table.comments')->where('coid = ?', $coid));
    $parent = $prow['parent'];
    if (!empty($parent)) {
        $arow = $db->fetchRow($db->select('author')->from('table.comments')->where('coid = ? AND status = ?', $parent, 'approved'));
        return !empty($arow['author']) ? '<a href="#comment-' . $parent . '">@' . $arow['author'] . '</a> ' : '';
    }
    return '';
}

// 获取随机缩略图
function get_RandomThumbnail($base_url, $maxImages = 10)
{
    if ($maxImages < 1) {
        $maxImages = 1;
    }
    $rand = mt_rand(1, $maxImages);
    return $base_url . $rand . '.jpg';
}

// 获取文章缩略图
function get_ArticleThumbnail($widget)
{
    // 检查自定义缩略图
    if (!empty($widget->fields->thumb)) {
        return $widget->fields->thumb;
    }

    // 提取文章第一张图片
    $pattern = '/<img[^>]*src=[\'"]([^\'"]+)[\'"][^>]*>/i';
    if (preg_match($pattern, $widget->content, $matches) && !empty($matches[1])) {
        return $matches[1];
    }

    // 检查文章附件
    $attach = $widget->attachments(1)->attachment;
    if ($attach && $attach->isImage) {
        return $attach->url;
    }

    // 生成随机缩略图
    $base_url = !empty(Helper::options()->articleImgSpeed)
        ? rtrim(Helper::options()->articleImgSpeed, '/') . '/'
        : Helper::options()->themeUrl . '/Assets/images/thumb/';

    return get_RandomThumbnail($base_url);
}

// 注册插件
Typecho_Plugin::factory('admin/write-post.php')->bottom = array('myyodu', 'one');
Typecho_Plugin::factory('admin/write-page.php')->bottom = array('myyodu', 'one');

class myyodu {
    public static function one()
    {
    ?>
    <style>
    .field.is-grouped{display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start;  -ms-flex-wrap: wrap;flex-wrap: wrap;}.field.is-grouped>.control{-ms-flex-negative:0;flex-shrink:0}.field.is-grouped>.control:not(:last-child){margin-bottom:.5rem;margin-right:.75rem}.field.is-grouped>.control.is-expanded{-webkit-box-flex:1;-ms-flex-positive:1;flex-grow:1;-ms-flex-negative:1;flex-shrink:1}.field.is-grouped.is-grouped-centered{-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center}.field.is-grouped.is-grouped-right{-webkit-box-pack:end;-ms-flex-pack:end;justify-content:flex-end}.field.is-grouped.is-grouped-multiline{-ms-flex-wrap:wrap;flex-wrap:wrap}.field.is-grouped.is-grouped-multiline>.control:last-child,.field.is-grouped.is-grouped-multiline>.control:not(:last-child){margin-bottom:.75rem}.field.is-grouped.is-grouped-multiline:last-child{margin-bottom:-.75rem}.field.is-grouped.is-grouped-multiline:not(:last-child){margin-bottom:0}.tags{-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.tags .tag{margin-bottom:.5rem}.tags .tag:not(:last-child){margin-right:.5rem}.tags:last-child{margin-bottom:-.5rem}.tags:not(:last-child){margin-bottom:1rem}.tags.has-addons .tag{margin-right:0}.tags.has-addons .tag:not(:first-child){border-bottom-left-radius:0;border-top-left-radius:0}.tags.has-addons .tag:not(:last-child){border-bottom-right-radius:0;border-top-right-radius:0}.tag{-webkit-box-align:center;-ms-flex-align:center;align-items:center;background-color:#f5f5f5;border-radius:3px;color:#4a4a4a;display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;font-size:.75rem;height:2em;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;line-height:1.5;padding-left:.75em;padding-right:.75em;white-space:nowrap}.tag .delete{margin-left:.25em;margin-right:-.375em}.tag.is-white{background-color:#fff;color:#0a0a0a}.tag.is-black{background-color:#0a0a0a;color:#fff}.tag.is-light{background-color:#fff;color:#363636}.tag.is-dark{background-color:#363636;color:#f5f5f5}.tag.is-primary{background-color:#00d1b2;color:#fff}.tag.is-info{background-color:#3273dc;color:#fff}.tag.is-success{background-color:#23d160;color:#fff}.tag.is-warning{background-color:#ffdd57;color:rgba(0,0,0,.7)}.tag.is-danger{background-color:#ff3860;color:#fff}.tag.is-large{font-size:1.25rem}.tag.is-delete{margin-left:1px;padding:0;position:relative;width:2em}.tag.is-delete:after,.tag.is-delete:before{background-color:currentColor;content:"";display:block;left:50%;position:absolute;top:50%;-webkit-transform:translateX(-50%) translateY(-50%) rotate(45deg);transform:translateX(-50%) translateY(-50%) rotate(45deg);-webkit-transform-origin:center center;transform-origin:center center}.tag.is-delete:before{height:1px;width:50%}.tag.is-delete:after{height:50%;width:1px}.tag.is-delete:focus,.tag.is-delete:hover{background-color:#e8e8e8}.tag.is-delete:active{background-color:#dbdbdb}.tag.is-rounded{border-radius:290486px}
    </style>
    <script language="javascript">
        var EventUtil = function() {};
        EventUtil.addEventHandler = function(obj, EventType, Handler) {
            if (obj.addEventListener) {
                obj.addEventListener(EventType, Handler, false);
            } else if (obj.attachEvent) {
                obj.attachEvent('on' + EventType, Handler);
            } else {
                obj['on' + EventType] = Handler;
            }
        }

        function showit(Word) {
            alert(Word);
        }

        function CountChineseCharacters() {
            const text = document.getElementById('text').value;
            let iTotal = 0, sTotal = 0, eTotal = 0, inum = 0, znum = 0, gl = 0, paichu = 0;

            for (let i = 0; i < text.length; i++) {
                const c = text.charAt(i);
                if (c.match(/[\u4e00-\u9fa5\u0800-\u4e00\uac00-\ud7ff]/)) {
                    iTotal++;
                }
                if (c.match(/[^\x00-\xff]/)) {
                    sTotal++;
                } else {
                    eTotal++;
                }
                if (c.match(/[0-9]/)) {
                    inum++;
                }
                if (c.match(/[a-zA-Z]/)) {
                    znum++;
                }
                if (c.match(/[\s]/)) {
                    gl++;
                }
                if (c.match(/[\u0000-\u001f\u007f-\u009f\u2000-\u206f\u3000-\u303f\uff00-\uffef]/)) {
                    paichu++;
                }
            }

            document.getElementById('hanzi').innerText = iTotal - paichu;
            document.getElementById('zishu').innerText = inum + iTotal - paichu;
            document.getElementById('biaodian').innerText = sTotal - iTotal + eTotal - inum - znum - gl + paichu;
            document.getElementById('zimu').innerText = znum;
            document.getElementById('shuzi').innerText = inum;
            document.getElementById("zifu").innerHTML = iTotal * 2 + (sTotal - iTotal) * 2 + eTotal;
        }

        $(document).ready(function(){
            $("#wmd-editarea").append('<div class="field is-grouped"><span class="tag">共计：</span><div class="control"><div class="tags has-addons"><span class="tag is-dark" id="zishu">0</span> <span class="tag is-primary">个字数</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-dark" id="zifu">0</span> <span class="tag is-primary">个字符</span></div></div><span class="tag">包含：</span><div class="control"><div class="tags has-addons"><span class="tag is-light" id="hanzi">0</span> <span class="tag is-danger">个文字</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="biaodian">0</span> <span class="tag is-info">个符号</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="zimu">0</span> <span class="tag is-success">个字母</span></div></div><div class="control"><div class="tags has-addons"><span class="tag is-light" id="shuzi">0</span> <span class="tag is-warning">个数字</span></div></div></div>');
            if (document.getElementById("text")) {
                EventUtil.addEventHandler(document.getElementById('text'), 'propertychange', CountChineseCharacters);
                EventUtil.addEventHandler(document.getElementById('text'), 'input', CountChineseCharacters);
            }
            CountChineseCharacters();
        });
    </script>
    <?php
    }
}

class GetBocchi {
    public static function Template($File) {
        Get::Need('Src/Template/' . $File . '.php');
    }

    public static function Tomori($File) {
        Get::Need('Src/Tomori/' . $File . '.php');
    }

    public static function Assets($directOutput = false) {
        $CdnUrl = Get::Options('AssetsCdn');
        if ($CdnUrl == 'default') {
            $CdnUrl = GetTheme::AssetsUrl() . '/';
        } elseif ($CdnUrl == 'PoppinParty') {
            $CdnUrl = Get::Options('AssetsCdnUrl');
        }
    
        if ($directOutput) {
            echo $CdnUrl;
        } else {
            return $CdnUrl;
        }
    }
}

$Files = [
    'Fields', 
    'ShortCode'];
foreach ($Files as $file) {
    require_once $file . '.php';
};