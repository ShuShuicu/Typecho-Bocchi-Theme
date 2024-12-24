<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Widget_Post_AuthorComment extends Widget_Abstract_Comments
{
    public function execute()
    {
        global $AuthorCommentId; // 全局作者id
        $select = $this->select()->limit($this->parameter->pageSize)
            ->where('table.comments.status = ?', 'approved')
            ->where('table.comments.ownerId = ?', $AuthorCommentId) // 获取作者id
            ->where('table.comments.type = ?', 'comment')
            ->order('table.comments.coid', Typecho_Db::SORT_DESC); // 根据coid排序
        $this->db->fetchAll($select, array($this, 'push'));
    }
}

global $AuthorCommentId; // 全局作者id
$AuthorCommentId = $this->authorId; // 获取作者id

// 实例化小部件并执行
$this->widget('Widget_Post_AuthorComment@index', 'pageSize=15')->to($AuthorComment);

// 准备评论数据
$commentsData = [];
while ($AuthorComment->next()) {
    $commentsData[] = [
        'coid' => $AuthorComment->coid,
        'permalink' => $AuthorComment->permalink,
        'text' => $AuthorComment->text, // 获取评论的完整内容
        'excerpt' => mb_substr(strip_tags($AuthorComment->text), 0, 100) // 截取前100个字符作为摘要
    ];
}
?>

<div id="AuthorComment">
    <div v-if="!hasComments" class="mdui-valign">
        <img class="mdui-center" :src="nullImg" />
    </div>
    <div v-else>
        <div class="mdui-col mdui-list" v-for="comment in comments" :key="comment.coid">
            <a :href="comment.permalink" class="mdui-list-item mdui-ripple mdui-text-truncate">
                {{ comment.excerpt }}
            </a>
        </div>
    </div>
</div>

<script>
    var commentsData = <?php echo json_encode($commentsData); ?>;
    new Vue({
        el: '#AuthorComment',
        data: {
            nullImg: '<?php GetBocchi::Assets(); ?>/images/null.png',
            comments: commentsData
        },
        computed: {
            hasComments: function () {
                return this.comments.length > 0;
            }
        }
    });
</script>