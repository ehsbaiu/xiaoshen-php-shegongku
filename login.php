<?php
define('ROOT', dirname(__FILE__).'/');
require_once(ROOT.'includes/common.php');

if (iflogin(DBQZ,$userrow['cookie'])) {
    header("Location: user.php");
}

if(isset($_POST['from'])=='login'){
	$user=defense($_POST['user']);
	$pwd=defense($_POST['pwd']);
	$ip=real_ip();
	if(!$user or !$pwd){
		msg("账号密码不能为空",1);
	}else{
		$pwd=md5($pwd);
		if($row=$DB->get_row("SELECT uid,user FROM ".DBQZ."_user WHERE user='$user' and pwd='$pwd' limit 1")){
			$cookie=md5(uniqid().rand(1,1000));
			$time=date("Y-m-d H:i:s");
			$DB->query("update ".DBQZ."_user set cookie='$cookie',ip='$ip',time='$time' where uid='{$row[uid]}'");
			setcookie(DBQZ."_cookie",$cookie,time()+3600*24*14,'/');
			msg("{$row[user]}，欢迎回来! ","user.php");
		}else{
			msg("用户名或密码错误",1);
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
        <form method="post" action="?"><input type="hidden" name="from" value="login">
          <div class="form-group">
            <input class="form-control" name="user" placeholder="账号" type="text">
          </div>
          <div class="form-group">
            <input class="form-control" name="pwd" placeholder="密码" type="text"><input type="submit" value="&#xf054;">
          </div>
          <div class="form-options clearfix">
            <a class="pull-right" href="reg.php">没有账号？</a>
            <div class="text-left">
              <label class="checkbox"><input type="checkbox"><span>记住我！</span></label>
            </div>
          </div>
        </form>
        <div class="social-login clearfix">
          <a class="btn btn-primary pull-left facebook" href=""><i class="icon-facebook"></i>谷歌登录</a>
		  <a class="btn btn-primary pull-right twitter" href=""><i class="icon-gittip"></i>QQ 登录</a>
        </div>
        <p class="signup">
          因泛滥问题请您先登录后使用， <a href="reg.php">请谅解！！</a>
        </p>
      </div>
    </div>
    <!-- End Login Screen -->
  </body>

</html>