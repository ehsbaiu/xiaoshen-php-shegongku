<?php
include_once ('head.php');

if($row['administration']!=1){
	msg('无权访问！','user.php');
}

$my=isset($_GET['my'])?$_GET['my']:null;
if($my=='fhcl'){
$uid=intval($_GET['uid']);
	if($DB->query("UPDATE  `". DBQZ ."_user` SET  `state` =  '0' WHERE `uid` ={$uid}")){
		msg('封号成功！','admin-user.php');
	}else{
		msg('封号失败！','admin-user.php');
	}
}elseif($my=='del'){
$uid=intval($_GET['uid']);
	$row_del=$DB->get_row("SELECT *  FROM  `". DBQZ ."_user` where `uid` = {$uid}");
	if(!$row_del['uid']){
		msg('此用户不存在！','admin-user.php');
	}elseif($DB->query("DELETE FROM `". DBQZ ."_user` where `uid` = {$row_del['uid']}")){
		msg('删除成功！','admin-user.php');
	}else{
		msg('删除失败！','admin-user.php');
	}
}elseif($my=='jcfh'){
$uid=intval($_GET['uid']);
	if($DB->query("UPDATE  `". DBQZ ."_user` SET  `state` =  '1' WHERE `uid` ={$uid}")){
		msg('解除成功！','admin-user.php');
	}else{
		msg('解除失败！','admin-user.php');
	}
}
?>
<div class="container-fluid main-content"><div class="page-title">
  <h1> <?=$conf['name']?>- 用户管理</h1>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-user"></i>用户列表
      </div>
      <div class="widget-content padded">
        <table class="table">
                  <thead>
                    <tr><th>
                      uid
                    </th>
                    <th>
                      用户名
                    </th>
                    <th>
                      QQ账号
                    </th>
                    <th class="hidden-xs">
                      注册时间
                    </th>
                    <th class="hidden-xs">
                      最近登录IP
                    </th>
					<th class="hidden-xs">
                      状态
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
	$pages = ceil($DB->count("select count(uid) as count from " . DBQZ . "_user where 1=1") / $pagesize);
	$sql_user = $DB->query("select * from " . DBQZ . "_user order by uid desc limit $start,$pagesize");
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
                        <?=$row_user['uid']?>
                      </td>
                      <td>
                        <?=$row_user['user']?>
                      </td>
                      <td>
                        <?=$row_user['qq']?>
                      </td>
                      <td class="hidden-xs">
                        <?=$row_user['date']?>
                      </td>
					  <td class="hidden-xs">
                        <?=$row_user['ip']?>
                      </td>
					  <td class="hidden-xs">
                        <?php
						if($row_user['state']==1){
							echo '<span class="label label-success">正常状态</span>';
						}else{
							echo '<span class="label label-danger">封号状态</span>';
						}
						?>
                      </td>
                      <td class="hidden-xs">
                        <div class="btn-group">
						  <button class="btn btn-xs btn-primary dropdown-toggle" data-toggle="dropdown">其它选项<span class="caret"></span></button>
						  <ul class="dropdown-menu">
							<li>
							<?php
							if($row_user['state']==1){
								echo '<a href="?my=fhcl&uid='.$row_user['uid'].'" onClick="if(!confirm("封号后此账号将无法登陆！")){return false;}"><i class="icon-plus-sign"></i>封号处理</a>';
							}else{
								echo '<a href="?my=jcfh&uid='.$row_user['uid'].'"><i class="icon-plus-sign"></i>解除封号</a>';
							}
							?>
							  
							</li>
							<li>
							  <a href="#"><i class="icon-edit"></i>修改资料</a>
							</li>
							<li>
							  <a href="?my=del&uid=<?=$row_user['uid']?>"><i class="icon-remove"></i>删除</a>
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