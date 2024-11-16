<?php
/**
 * MioPixiv
 * @package custom
 * @author 鼠子(ShuShuicu)
 * @link https://blog.miomoe.cn/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
?>
<div class="mdui-card mdui-hoverable mdui-m-b-2" id="PostContent">
    <div class="mdui-card-media">
        <div class="mdui-card-content mdui-valign">
            <div class="mdui-card-primary-title mdui-center"><i class="mdui-icon material-icons" style="font-size: 30px;">favorite</i><?php $this->title() ?></div>
        </div>
        <div class="mdui-divider"></div>
        <div class="mdui-card-actions">
            在框内输入作品ID（如82775556）再按“查询”按钮即可查看对应作品<br>
            对于一个ID有多张图片的，请用pid+图片序号的格式输入（例：78286152-2：id为78286152的作品的第2张图）<br>
            （图片为动态产生，准确档案类型会以Content-Type header发送）
            <div style="padding-left:2%;">
            <div class="mdui-textfield">
                <i class="mdui-icon material-icons">search</i>
                <input class="mdui-textfield-input" type="text" class="i" size="10" autofocus id="inputer" placeholder="输入pid" required="required"/>
            </div>

            <form>

                <label class="mdui-radio">
                    <input type="radio" name="tp" id="type_pic" value="png" checked="checked" checked/>
                    <i class="mdui-radio-icon"></i>
                    PNG
                </label>

                <label class="mdui-radio">
                    <input type="radio" name="tp" id="type_pic" value="jpg"/>
                    <i class="mdui-radio-icon"></i>
                    JPG
                </label>

                <label class="mdui-radio">
                    <input type="radio" name="tp" id="type_pic" value="gif"/>
                    <i class="mdui-radio-icon"></i>
                    GIF
                </label>
                <div class="mdui-float-right">
                    <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-theme-accent" type="button" class="btn" onclick="checkInput()">查询</button>
                </div>
            </form>
            </div>
        </div>
        <div class="mdui-divider"></div>
    </div>
    <div class="mdui-typo mdui-card-content post-container mdui-valign">
        <img class="mdui-center" id="image" src="<?php GetTheme::Url() ?>/screenshot.png" width="500" alt="图片不存在或无法查看图片（确定pid存在且图片格式正确）"/>
    </div>
</div>

<script>
function checkInput() {
    text = document.getElementById("inputer").value;
    type_pic = document.getElementsByName("tp");
    for(var i=0; i<3; i++) {
        if(type_pic[i].checked) {
            type = type_pic[i].value;
        }
    }
    image_e = document.getElementById('image');
    image_e.src = "<?php echo Get::Options('PixivPicCdn') ?>" + text + "." + type;
}
</script>