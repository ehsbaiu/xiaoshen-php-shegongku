<?php
include_once ('head.php');

if($row['administration']!=1){
	msg('无权访问！','user.php');
}

$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='del'){
$id=intval($_GET['id']);
	if($row['uid']!=1){
		msg('此操作只有超级管理员可操作！','admin-uin.php');
	}
	$row_del=$DB->get_row("SELECT *  FROM  `". DBQZ ."_qq` where `id` = {$id}");
	if(!$row_del['id']){
		msg('此QQ账号不存在！','admin-uin.php');
	}elseif($DB->query("DELETE FROM `". DBQZ ."_qq` where `id` = {$row_del['id']}")){
		msg('删除成功！','admin-uin.php');
	}else{
		msg('删除失败！','admin-uin.php');
	}
}
?>
<div class="container-fluid main-content"><div class="page-title">
  <h1> <?=$conf['name']?>- QQ账号</h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-user"></i>QQ账号列表
      </div>
      <div class="widget-content padded">
        <table class="table">
                  <thead>
                    <tr><th>
                      #id
                    </th>
                    <th>
                      QQ账号
                    </th>
					<th>
                      QQ密码
                    </th>
                    <th class="hidden-xs">
                      入库时间
                    </th>
					<th class="hidden-xs">
                      操作
                    </th>
                  </tr></thead>
<?php
$page = is_numeric($_GET['page']) ? $_GET['page'] : '1';
$pagein = $page + 8;
$pagesize = 30;
$start = ($page - 1) * $pagesize;
	$pages = ceil($DB->count("select count(id) as count from " . DBQZ . "_qq where 1=1") / $pagesize);
	$sql_user = $DB->query("select * from " . DBQZ . "_qq order by id desc limit $start,$pagesize");
if ($pagein > $pages) $pagein = $pages;
if ($page == 1) {
    $prev = 1;
} else {
    $prev = $page - 1;
}
if ($page == $pages) {
    $next = $page;
} else {
    $next = $page + 1;
}
while ($row_user= $DB->fetch($sql_user)) {
?>
                    <tr>
                      <td>
                        <?=$row_user['id']?>
                      </td>
                      <td>
                        <?=$row_user['qq']?>
                      </td>
                      <td>
                        <?=$row_user['pwd']?>
                      </td>
                      <td class="hidden-xs">
                        <?=$row_user['date']?>
                      </td>
                      <td class="hidden-xs">
                        <div class="btn-group">
						  <button class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">其它选项<span class="caret"></span></button>
						  <ul class="dropdown-menu">
							<li>
							  <a href="?my=del&id=<?=$row_user['id']?>"><i class="icon-remove"></i>删除</a>
							</li>
						  </ul>
						</div>
                      </td>
                    </tr>
<?php } ?>
                  </tbody>
                </table>
<?php
if ($pagedo != 'seach') { ?>
			<div class="row" style="text-align:center;">
				<div class="pagination">
					<li <?php
    if ($page == 1) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=1">首页</a></li>
					<li <?php
    if ($prev == $page) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $prev ?>">&laquo;</a></li>
					<?php
    for ($i = $page; $i <= $pagein; $i++) { ?>
					<li <?php
        if ($i == $page) {
            echo 'class="active"';
        } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $i ?>"><?php echo $i ?></a></li>
					<?php
    } ?>
					<li <?php
    if ($next == $page) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $next ?>">&raquo;</a></li>
					<li <?php
    if ($page == $pages) {
        echo 'class="disabled"';
    } ?>><a class="btn btn-sm btn-alt" href="?page=<?php echo $pages ?>">末页</a></li>
				</div>
			</div>
<?php } ?>
      </div>
    </div>
  </div>
  
  </div>

</div>
</body>
</html>