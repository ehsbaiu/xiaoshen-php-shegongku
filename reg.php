<?php
define('ROOT', dirname(__FILE__).'/');
require_once(ROOT.'includes/common.php');

if (iflogin(DBQZ,$userrow['cookie'])) {
    header("Location: user.php");
}elseif($conf['reg']!=1){
	msg('注册功能已关闭','login.php');
}

if(isset($_POST['from'])=='reg'){
	$user=defense($_POST['user']);
	$pwd1=defense($_POST['pwd']);
	$qq=defense($_POST['qq']);
	$code=defense($_POST['code']);
	$ip=real_ip();
	if(!$user or !$pwd1 or !$qq){
		msg("选项不能留空!",1);
	}elseif($DB->get_row("SELECT *  FROM  `". DBQZ ."_user`  WHERE  `user` =  '$user' LIMIT 1")){
		msg('此用户名已存在，请重新注册！',1);
	}elseif($DB->get_row("SELECT *  FROM  `". DBQZ ."_user`  WHERE  `qq` =  '$qq' LIMIT 1")){
		msg('此QQ账号已存在，请绑定其它QQ账号！',1);
	}else/*if(!$code || strtolower($_SESSION[DBQZ.'_code'])!=strtolower($code)){
		msg("验证码错误",1);
	}else*/{
		$pwd=md5($pwd1);
		if($DB->query("INSERT INTO  `". DBQZ ."_user` (`user` , `pwd` , `qq` , `ip` , `cookie` , `time` , `date` , `administration` , `value` , `state` ) VALUES (  '$user',  '$pwd',  '$qq',  '$ip',  '',  '$date',  '$date',  '0',  '0',  '1' )")){
			msg('注册成功！快去登录吧！','../login.php');
		}else{
			msg("注册失败！",1);
		}
	}
}
?>
<!DOCTYPE html>
<html>  
<head>
    <title>
      登录- <?=$conf['name']?>
    </title>
    <!--<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />-->
	<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" /><link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
	<script src="javascripts/jquery.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery-ui.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap.min.js" type="text/javascript"></script><script src="javascripts/raphael.min.js" type="text/javascript"></script><script src="javascripts/jquery.mousewheel.js" type="text/javascript"></script><script src="javascripts/jquery.vmap.min.js" type="text/javascript"></script><script src="javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script><script src="javascripts/jquery.vmap.world.js" type="text/javascript"></script><script src="javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script><script src="javascripts/fullcalendar.min.js" type="text/javascript"></script><script src="javascripts/gcal.js" type="text/javascript"></script><script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script><script src="javascripts/datatable-editable.js" type="text/javascript"></script><script src="javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script><script src="javascripts/excanvas.min.js" type="text/javascript"></script><script src="javascripts/jquery.isotope.min.js" type="text/javascript"></script><script src="javascripts/masonry.min.js" type="text/javascript"></script><script src="javascripts/modernizr.custom.js" type="text/javascript"></script><script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script><script src="javascripts/select2.js" type="text/javascript"></script><script src="javascripts/styleswitcher.js" type="text/javascript"></script><script src="javascripts/wysiwyg.js" type="text/javascript"></script><script src="javascripts/jquery.inputmask.min.js" type="text/javascript"></script><script src="javascripts/jquery.validate.js" type="text/javascript"></script><script src="javascripts/bootstrap-fileupload.js" type="text/javascript"></script><script src="javascripts/bootstrap-datepicker.js" type="text/javascript"></script><script src="javascripts/bootstrap-timepicker.js" type="text/javascript"></script><script src="javascripts/bootstrap-colorpicker.js" type="text/javascript"></script><script src="javascripts/bootstrap-switch.min.js" type="text/javascript"></script><script src="javascripts/daterange-picker.js" type="text/javascript"></script><script src="javascripts/date.js" type="text/javascript"></script><script src="javascripts/morris.min.js" type="text/javascript"></script><script src="javascripts/skycons.js" type="text/javascript"></script><script src="javascripts/jquery.sparkline.min.js" type="text/javascript"></script><script src="javascripts/fitvids.js" type="text/javascript"></script><script src="javascripts/main.js" type="text/javascript"></script><script src="javascripts/respond.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
  </head>
  <body class="login1">
    <!-- Login Screen -->
    <div class="login-wrapper">
      <div class="login-container">
        <a href="index.html"><img width="100" height="30" src="images/logo-login%402x.png" /></a>
        <form method="post" action="?"><input type="hidden" name="from" value="reg">
          <div class="form-group">
            <input class="form-control" name="user" placeholder="账号" type="text">
          </div>
          <div class="form-group">
            <input class="form-control" name="pwd" placeholder="密码" type="text"><input type="submit" value="&#xf054;">
          </div>
		  <div class="form-group">
            <input class="form-control" name="qq" placeholder="QQ账号" type="text">
          </div>
          <div class="form-options clearfix">
            <a class="pull-right" href="reg.php">我有账号！</a>
          </div>
        </form>
      </div>
    </div>
    <!-- End Login Screen -->
  </body>

</html>