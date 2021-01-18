<?php
include_once ('head.php');

if($row['administration']!=1){
	msg('无权访问！','user.php');
}

$my=isset($_POST['my'])?$_POST['my']:null;
if($my=='web'){
$name=defense($_POST['name']);
$reg=intval($_POST['reg']);
$chat=intval($_POST['chat']);
	saveSetting('name',$name);
	saveSetting('reg',$reg);
	saveSetting('chat',$chat);
	msg('修改完成！','admin.php');
}elseif($my=='gg'){
$gg = $_POST['gg'];
	saveSetting('gg',$gg);
	msg('修改完成！','admin.php');
}elseif($my=='cnzz'){
$cnzz=$_POST['cnzz'];
	saveSetting('cnzz',$cnzz);
	msg('修改完成！','admin.php');
}elseif($my=='pltj'){
$qq=$_POST['string'];
	$string = str_replace(array("\r\n", "\r", "\n"), "[br]", $qq);
	$match=explode("[br]",$string);

	foreach($match as $val)
	{
		$iofg=explode('----',$val);
		$qq=trim($iofg[0]);
		$pwd=trim($iofg[1]);
		if($qq==''||$pwd=='')continue;
		//$id=md5($qq.$pwd);
		$sql=$DB->query("insert into `". DBQZ ."_qq` (`qq`,`pwd`,`date`) values ('".$qq."','".$pwd."','".$date."')");
		if($sql)
			$cg = ($cg + $cg + 1);
		else
			$sb = ($sb + $sb + 1);
	}
	msg('添加成功！成功：'.$cg.'个，失败：'.$sb.'个！','admin.php');
}elseif($my=='yqlj'){
$name=defense($_POST['name']);
$url=$_POST['url'];
	if($DB->query("insert into `". DBQZ ."_qq` (`qq`,`pwd`,`date`) values ('".$qq."','".$pwd."','".$date."')")){
		msg('添加成功！','admin.php');
	}else{
		msg('添加失败！','admin.php');
	}
}if($my=='pbqq'){
$qq=$_POST['qq'];
	saveSetting('pbqq',$qq);
	msg('修改完成！','admin.php');
}
?>
<div class="container-fluid main-content"><div class="page-title">
  <h1> <?=$conf['name']?>- 后台管理</h1>
</div>
<div class="row">
  <div class="col-lg-6">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-reorder"></i>系统配置
      </div>
      <div class="widget-content padded">
        <form method="post" action="?"><input type="hidden" name="my" value="web">
          
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">网站名称</span><input class="form-control" name="name" placeholder="" value="<?=$conf['name']?>" type="text">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">注册状态</span>
				<select name="reg" class="form-control">
					<option value="<?=$conf['reg']?>"><?=$conf['reg']?></option>
					<option value="1">开启_1</option>
					<option value="0">关闭_0</option>
				</select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">聊天室状态</span>
				<select name="chat" class="form-control">
					<option value="<?=$conf['chat']?>"><?=$conf['chat']?></option>
					<option value="1">开启_1</option>
					<option value="0">关闭_0</option>
				</select>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" type="submit">确定修改</button>
            </div>
          </div>
        </form>
		
		<form method="post" action="?my=web"><input type="hidden" name="my" value="cnzz">
          
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">站长统计</span><input class="form-control" name="cnzz" placeholder="" value="<?=$conf['cnzz']?>" type="text">
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" type="submit">设置</button>
            </div>
          </div>
        </form>
		
		<form method="post" action="?my=web"><input type="hidden" name="my" value="gg">
          
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">发布公告</span><textarea name="gg" class="form-control" rows="3"><?=$conf['gg']?></textarea>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" type="submit">发布</button>
            </div>
          </div>
        </form>
		
      </div>
    </div>
  </div>
  
  <div class="col-lg-6">
    <div class="widget-container fluid-height clearfix">
      <div class="heading">
        <i class="icon-reorder"></i>增加QQ（本地）
      </div>
      <div class="widget-content padded">
		<form method="post" class="form-horizontal" action="?my=web"><input type="hidden" name="my" value="pltj">
		<div class="alert alert-success">
          <button class="close" data-dismiss="alert" type="button">×</button><i class="icon-exclamation-sign"></i>
		  请按格式输入否则可能无法解析！格式：账号----密码 回车
        </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">资料</span><textarea class="form-control" name="string"></textarea>
              </div>
            </div>
          </div>
		  
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" type="submit">批量添加</button>
            </div>
          </div>
        </form>
		<form method="post" class="form-horizontal" action="?my=web"><input type="hidden" name="my" value="pbqq">
		<div class="alert alert-success">
          <button class="close" data-dismiss="alert" type="button">×</button><i class="icon-exclamation-sign"></i>
		  这里可以自定义屏蔽不想被查询的QQ账号！多个用 | 隔开！
        </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">QQ账号</span><textarea class="form-control" name="qq"><?=$conf['pbqq']?></textarea>
              </div>
            </div>
          </div>
		  
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" type="submit">确认修改</button>
            </div>
          </div>
        </form>
		
		<div class="alert alert-success">
          <button class="close" data-dismiss="alert" type="button">×</button><i class="icon-exclamation-sign"></i>
		  增加友情链接
        </div>
		<form method="post" class="form-horizontal" action="?my=web"><input type="hidden" name="my" value="yqlj">
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">网站名称：</span><input class="form-control" name="name" placeholder="" value="" type="text">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon">链接地址：</span><textarea class="form-control" name="url"></textarea>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-md-12">
              <button class="btn btn-primary btn-block" type="submit">确定添加</button>
            </div>
          </div>
        </form>
		
      </div>
    </div>
  </div>
</div>
  <div class="row">
	  <div class="col-lg-6">
			<div class="widget-container fluid-height clearfix">
			  <div class="heading">
				<i class="icon-reorder"></i>其它操作
			  </div>
				<div class="panel-body">
					<div class="roll-title"><i class="icon-bullhorn"></i>
					管理入口
					</div>
					<br>
					<a class="btn btn-primary btn-block" href="admin-user.php">用户管理</a>
					<a class="btn btn-primary btn-block" href="admin-music.php">播放器设置</a>
					<a class="btn btn-primary btn-block" href="admin-uin.php">QQ账号管理</a>
					<a class="btn btn-primary btn-block" href="Administration.php">管理员列表</a>
					
					<div class="roll-title"><i class="icon-bullhorn"></i>
					聊天室管理
					</div>
					<br>
					<div class="col-md-6">
						<button class="btn btn-success btn-block">清除部分信息</button>
					</div>
					<div class="col-md-6">
						<button class="btn btn-success btn-block">清空信息</button>
					</div>
				</div>
			</div>
	  </div>
	  
	  <div class="col-lg-6">
			<div class="widget-container fluid-height clearfix">
			  <div class="heading">
				<i class="icon-reorder"></i>程序信息
			  </div>
				<div class="panel-body">
					<label class="btn btn-block btn-info-outline active"><i class="icon-stethoscope"></i>程序信息
					<input id="option1" name="options" type="checkbox"></label>
					<label class="btn btn-block btn-success-outline"><i class="icon-coffee"></i>程序版本：v1.0
					<input id="option2" name="options" type="checkbox"></label>
					<label class="btn btn-block btn-warning-outline"><i class="icon-gamepad"></i>php环境：=>5.3<input id="option3" name="options" type="checkbox"></label>
					<label class="btn btn-block btn-danger-outline"><i class="icon-gift"></i>作者；小照 Qq：2453162656
					<input id="option4" name="options" type="checkbox"></label>
					<label class="btn btn-block btn-magenta-outline"><i class="icon-trophy"></i>Fitness
					<input id="option5" name="options" type="checkbox">小照程序交流群 (内部) 522829995</label>
				</div>
			</div>
	  </div>
  
  </div>

</div>
</body>
</html>