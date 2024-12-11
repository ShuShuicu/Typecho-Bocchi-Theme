<?php
/**
 * ptions Functions
 * @author 鼠子Tomoriゞ
 * @link https://blog.miomoe.cn/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * ThemeUrl
 * 获取主题目录 用于设置页面配置
 */
define("THEME_URL", GetTheme::Url(false));
define("THEME_NAME", GetTheme::Name(false));
function themeConfig($form)
{
?>
    <!-- 自定义CSS样式 -->
    <style>
        body {
            font-weight:500;
            background: url(<?php GetTheme::AssetsUrl() ?>/images/background.webp)
            no-repeat 0 0;
            background-size: cover;
            background-attachment: fixed;
        }
        .clearfix, .row {
            background-color: #ffffffdb;
            border-radius: 8px;
        }
        .typecho-foot {
            padding: 1em 0 3em;
            background-color: #ffffffdb;
        }
        .typecho-head-nav .operate a {
            background-color: #202328;
        } 
        .typecho-option-tabs li {
            float: left;
            background-color: #fffbcc;
        } 
        .typecho-label h3 {
            color: #0900ff;
            font-size: 1.2em;
        } 
        .typecho-label {
            color: #000000;
            font-size: 1em;
        }
        .typecho-option .description {
            color: #000000;
            font-size: 1em;
        }
    </style>
    <link rel="stylesheet" href="<?php GetTheme::AssetsUrl() ?>/mdui/css/mdui.min.css">
    <script src="<?php GetTheme::AssetsUrl() ?>/mdui/js/mdui.min.js"></script>
    <!-- 设置信息 -->

    <div class="mdui-container">

        <div class="mdui-card mdui-color-indigo" style="border-radius: 8px;">
			<div class="mdui-card-content mdui-valign mdui-typo">
				<div class="mdui-m-r-2"><i class="mdui-icon material-icons">info</i></div>
				<div style="font-size: 1.3em;">欢迎使用Bocchi主题！<strong>基于TTDF框架v<?php Get::FrameworkVer(); ?>开发的多功能主题。</strong></div>
			</div>
		</div>

        <div class="mdui-card-primary-title mdui-m-y-2">
            <?php
            // 获取当前主题名称
            $themeName = Get::Options('theme');

            // 数据库连接
            $db = Typecho_Db::get();

            // 获取当前主题的设置
            $currentThemeOptions = $db->fetchRow($db->select()->from('table.options')->where('name = ?', 'theme:' . $themeName));

            // 定义备份设置的名称
            $backupName = 'theme:' . $themeName . 'bf';

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['type'])) {
                $action = $_POST['type'];

                if ($action === "备份模板设置数据") {
                    if ($currentThemeOptions) {
                        // 检查是否已经存在备份
                        $existingBackup = $db->fetchRow($db->select()->from('table.options')->where('name = ?', $backupName));
                        if ($existingBackup) {
                            // 更新现有备份
                            $update = $db->update('table.options')
                                ->rows(['value' => $currentThemeOptions['value']])
                                ->where('name = ?', $backupName);
                            $db->query($update);
                            $message = '备份已更新，请等待自动刷新！如果等不到请点击手动刷新。';
                            echo '<script>setTimeout(function(){ window.location.href = "options-theme.php"; }, 2500);</script>';
                        } else {
                            // 创建新的备份
                            $insert = $db->insert('table.options')
                                ->rows(['name' => $backupName, 'user' => '0', 'value' => $currentThemeOptions['value']]);
                            $db->query($insert);
                            $message = '备份完成，请等待自动刷新！如果等不到请手动刷新。';
                        }
                        // 显示消息并设置自动刷新
                        echo '<div class="tongzhi col-mb-12 home">' . $message . '</div>';
                        echo '<script>setTimeout(function(){ window.location.href = "options-theme.php"; }, 2500);</script>';
                    } else {
                        echo '<div class="tongzhi col-mb-12 home">当前主题没有设置数据可备份。</div>';
                    }
                } elseif ($action === "还原模板设置数据") {
                    // 还原备份
                    $backupOptions = $db->fetchRow($db->select()->from('table.options')->where('name = ?', $backupName));
                    if ($backupOptions) {
                        // 更新当前主题设置为备份内容
                        $update = $db->update('table.options')
                            ->rows(['value' => $backupOptions['value']])
                            ->where('name = ?', 'theme:' . $themeName);
                        $db->query($update);
                        $message = '检测到备份数据，恢复完成，请等待自动刷新！如果等不到请手动刷新。';
                        echo '<script>setTimeout(function(){ window.location.href = "options-theme.php"; }, 2500);</script>';
                        echo '<div class="tongzhi col-mb-12 home">' . $message . '</div>';
                    } else {
                        echo '<div class="tongzhi col-mb-12 home">没有备份数据，无法恢复！</div>';
                    }
                } elseif ($action === "删除备份数据") {
                    // 删除备份
                    $backupOptions = $db->fetchRow($db->select()->from('table.options')->where('name = ?', $backupName));
                    if ($backupOptions) {
                        $delete = $db->delete('table.options')->where('name = ?', $backupName);
                        $db->query($delete);
                        $message = '删除成功，请等待自动刷新，如果等不到请点击手动刷新。';
                        echo '<div class="tongzhi col-mb-12 home">' . $message . '</div>';
                    } else {
                        echo '<div class="tongzhi col-mb-12 home">备份不存在，无需删除！</div>';
                    }
                }
            }
            ?>
<form class="protected home col-mb-12 mdui-m-b-3" action="" method="post">
    <input type="submit" name="type" class="btn btn-s mdui-btn mdui-btn-raised mdui-ripple mdui-color-indigo" value="备份模板设置数据" />  
    <input type="submit" name="type" class="btn btn-s mdui-btn mdui-btn-raised mdui-ripple mdui-color-blue" value="还原模板设置数据" />  
    <input type="submit" name="type" class="btn btn-s mdui-btn mdui-btn-raised mdui-ripple mdui-color-pink" value="删除备份数据" />
</form>
</div>

<?php 
$OptionsFiles = [
    'Tomori', 
    'Page',
    'Other'
];
foreach ($OptionsFiles as $OptionsFile){
    require_once 'Options/' . $OptionsFile . '.php';
};
}
?>
