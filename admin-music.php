<?php
include_once ('head.php');

if($row['administration']!=1){
	msg('无权访问！','user.php');
}

$my=isset($_POST['my'])?$_POST['my']:null;
if($my=='music'){
$music=$_POST['music'];
	saveSetting('music',$music);
	msg('修改完成！','admin-music.php');
}
?>
<div class="container-fluid main-content"><div class="page-title">
  <h1> <?=$conf['name']?>- 播放器</h1>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-user"></i>播放器设置（关闭留空）
      </div>
      <div class="widget-content padded">.
		<form method="post" action="?my=web"><input type="hidden" name="my" value="music">
			<div class="form-group">
				<div class="col-md-12">
				  <div class="input-group">
					<span class="input-group-addon">播放器(网易)</span><textarea class="form-control" name="music"><?=$conf['music']?></textarea>
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