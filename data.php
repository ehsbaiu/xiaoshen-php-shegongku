<?php
include_once ('head.php');

$my=isset($_POST['my'])?$_POST['my']:null;
if($my=='pwd'){
$pass=defense($_POST['pwd']);
if(!$pass){//如果密码等于空就使用旧密码修改！
	$pwd=$row['pwd'];
}else{
	$pwd=md5($pass);
}
	if($DB->query("UPDATE `". DBQZ ."_user` SET  `cookie` =  '$pwd' WHERE  `uid` ={$row['uid']}")){
		msg('修改成功，新密码：'.$pass,'data.php');
	}else{
		msg('修改失败！','data.php');
	}
}
?>
<div class="container-fluid main-content"><div class="page-title">
  <h1>账号：<?=$row['user']?> - 资料修改</h1>
</div>
<div class="row">
  <div class="col-lg-4">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-user"></i>密码修改
      </div>
      <div class="widget-content padded">.
		<form method="post" action="?"><input type="hidden" name="my" value="pwd">
			<div class="form-group">
				<div class="col-md-12">
				  <div class="input-group">
					<span class="input-group-addon">密码 </span><input class="form-control" name="pwd" placeholder="请输入新密码" type="text">
				  </div>
				</div>
			</div>
			
			<div class="form-group">
				<button class="btn btn-primary btn-block" type="submit">确认修改</button>
			</div>
		</form>
      </div>
    </div>
  </div>
  
  </div>

</div>
</body>
</html>