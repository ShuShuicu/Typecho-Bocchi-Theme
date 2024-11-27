<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
class Widget_Post_AuthorComment extends Widget_Abstract_Comments
{
    public function execute()
    {
        global $AuthorCommentId;//全局作者id
        $select  = $this->select()->limit($this->parameter->pageSize)
        ->where('table.comments.status = ?', 'approved')
        ->where('table.comments.authorId = ?', $AuthorCommentId)//获取作者id
        ->where('table.comments.type = ?', 'comment')
        ->order('table.comments.coid', Typecho_Db::SORT_DESC);//根据coid排序
        $this->db->fetchAll($select, array($this, 'push'));
    }
}
global $AuthorCommentId;//全局作者id
$AuthorCommentId=$this->authorId;//获取作者id
?>
<?php $this->widget('Widget_Post_AuthorComment@index','pageSize=15')->to($AuthorComment); ?>

<?php if (!$AuthorComment->have()) {  ?>
    <div>这个人很懒，还没有在本站评论过。</div>
<?php } else { ?>
    <?php while($AuthorComment->next()){ ?>
    <div class="mdui-col mdui-list">
        <a href="<?php $AuthorComment->permalink() ?>" class="mdui-list-item mdui-ripple"><?php $AuthorComment->excerpt(50, '...'); ?></a>
    </div>
    <?php }; ?>
<?php }  ?>
