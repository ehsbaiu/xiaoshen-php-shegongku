<?php
include_once ('state.php');
$row = $DB->get_row("select * FROM " . DBQZ . "_user where uid='$userrow[uid]' limit 1");
?>
<!DOCTYPE html>
<html>  
<head>
    <title>
    用户中心- <?=$conf['name']?>
    </title>
    <!--<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700" media="all" rel="stylesheet" type="text/css" />-->
	<link href="stylesheets/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/font-awesome.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/se7en-font.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/isotope.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/jquery.fancybox.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/fullcalendar.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/select2.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/morris.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/datatables.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/datepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/timepicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/colorpicker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/bootstrap-switch.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/daterange-picker.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/typeahead.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/summernote.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/pygments.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/style.css" media="all" rel="stylesheet" type="text/css" />
	<link href="stylesheets/color/green.css" media="all" rel="alternate stylesheet" title="green-theme" type="text/css" />
	<link href="stylesheets/color/orange.css" media="all" rel="alternate stylesheet" title="orange-theme" type="text/css" />
	<link href="stylesheets/color/magenta.css" media="all" rel="alternate stylesheet" title="magenta-theme" type="text/css" />
	<link href="stylesheets/color/gray.css" media="all" rel="alternate stylesheet" title="gray-theme" type="text/css" />
	<script src="javascripts/jquery.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery-ui.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap.min.js" type="text/javascript"></script>
	<script src="javascripts/raphael.min.js" type="text/javascript"></script>
	<script src="javascripts/selectivizr-min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.mousewheel.js" type="text/javascript"></script>
	<script src="javascripts/jquery.vmap.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.vmap.sampledata.js" type="text/javascript"></script>
	<script src="javascripts/jquery.vmap.world.js" type="text/javascript"></script>
	<script src="javascripts/jquery.bootstrap.wizard.js" type="text/javascript"></script>
	<script src="javascripts/fullcalendar.min.js" type="text/javascript"></script>
	<script src="javascripts/gcal.js" type="text/javascript"></script>
	<script src="javascripts/jquery.dataTables.min.js" type="text/javascript"></script>
	<script src="javascripts/datatable-editable.js" type="text/javascript"></script>
	<script src="javascripts/jquery.easy-pie-chart.js" type="text/javascript"></script>
	<script src="javascripts/excanvas.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.isotope.min.js" type="text/javascript"></script>
	<script src="javascripts/isotope_extras.js" type="text/javascript"></script>
	<script src="javascripts/modernizr.custom.js" type="text/javascript"></script>
	<script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
	<script src="javascripts/select2.js" type="text/javascript"></script>
	<script src="javascripts/styleswitcher.js" type="text/javascript"></script>
	<script src="javascripts/wysiwyg.js" type="text/javascript"></script>
	<script src="javascripts/summernote.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.inputmask.min.js" type="text/javascript"></script>
	<script src="javascripts/jquery.validate.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap-fileupload.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap-timepicker.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap-colorpicker.js" type="text/javascript"></script>
	<script src="javascripts/bootstrap-switch.min.js" type="text/javascript"></script>
	<script src="javascripts/typeahead.js" type="text/javascript"></script>
	<script src="javascripts/daterange-picker.js" type="text/javascript"></script>
	<script src="javascripts/date.js" type="text/javascript"></script>
	<script src="javascripts/morris.min.js" type="text/javascript"></script>
	<script src="javascripts/skycons.js" type="text/javascript"></script>
	<script src="javascripts/fitvids.js" type="text/javascript"></script>
	<script src="javascripts/jquery.sparkline.min.js" type="text/javascript"></script>
	<script src="javascripts/main.js" type="text/javascript"></script>
	<script src="javascripts/respond.js" type="text/javascript"></script>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
	
<style>
img.qqlogo {
border: 1px solid #FFF;
-moz-box-shadow: 0 0 3px #AAA;
-webkit-box-shadow: 0 0 3px #AAA;
border-radius: 50%;
box-shadow: 0 0 3px #AAA;
padding: 3px;
margin-right: 3px;
margin-left: 6px;
}
</style>
  </head>
  <body>
    <div class="modal-shiftfix">
      <!-- Navigation -->
      <div class="navbar navbar-fixed-top scroll-hide">
        <div class="container-fluid top-bar">
          <div class="pull-right">
            <ul class="nav navbar-nav pull-right">
              <li class="dropdown notifications hidden-xs">
                <a class="dropdown-toggle fancybox" href="#fancybox-example"><span aria-hidden="true" class="icon-bullhorn"></span>
                  <div class="sr-only">
                    最新公告
                  </div>
                </a>
				<div id="fancybox-example" style="display: none">
				  <h2><i class="icon-bullhorn"></i>
					最新公告
				  </h2>
				  <p>
					<?=$conf['gg']?>
				  </p>
				</div>
              </li>
              <li class="dropdown messages hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="icon-music"></span>
                  <div class="sr-only">
                    音乐播放器
                  </div>
                </a>
                <ul class="dropdown-menu messages" style="max-width: 350px;">
				<?php
				if(!$conf['music']){
					echo '<li>播放器已关闭！</li>';
				}else{
					echo $conf['music'];
				}
				?>
                </ul>
              </li>
              <li class="dropdown settings hidden-xs">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span aria-hidden="true" class="se7en-gear"></span>
                  <div class="sr-only">
                    Settings
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a class="settings-link blue" href="javascript:chooseStyle('none', 30)"><span></span>Blue</a>
                  </li>
                  <li>
                    <a class="settings-link green" href="javascript:chooseStyle('green-theme', 30)"><span></span>Green</a>
                  </li>
                  <li>
                    <a class="settings-link orange" href="javascript:chooseStyle('orange-theme', 30)"><span></span>Orange</a>
                  </li>
                  <li>
                    <a class="settings-link magenta" href="javascript:chooseStyle('magenta-theme', 30)"><span></span>Magenta</a>
                  </li>
                  <li>
                    <a class="settings-link gray" href="javascript:chooseStyle('gray-theme', 30)"><span></span>Gray</a>
                  </li>
                </ul>
              </li>
              <li class="dropdown user hidden-xs"><a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img width="34" height="34" src="http://q1.qlogo.cn/g?b=qq&nk=<?=$row['qq']?>&s=100" /><?=$row['user']?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="data.php">
                    <i class="icon-user"></i>资料修改</a>
                  </li>
                  <li><a href="#">
                    <i class="icon-gear"></i>选项设置</a>
                  </li>
                  <li><a href="logout.php">
                    <i class="icon-signout"></i>安全退出</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <button class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="logo" href="index-2.html">Query</a>
          <form class="navbar-form form-inline col-lg-2 hidden-xs" method="post" action="user.php"><input type="hidden" name="my" value="query">
            <input class="form-control" placeholder="Miami" type="text">
          </form>
        </div>
        <div class="container-fluid main-nav clearfix">
          <div class="nav-collapse">
            <ul class="nav">
              <li>
                <a class="current" href="../"><span aria-hidden="true" class="se7en-home"></span>首页</a>
              </li>
              <li><a href="user.php">
                <span aria-hidden="true" class="se7en-feed"></span>用户中心</a>
              </li>
              <li><a href="user.php">
                <span aria-hidden="true" class="se7en-gallery"></span>密码查询</a>
              </li>
			  <?php
			  if($row['administration']!=1){
			  ?>
              <li><a href="Applyapi.php">
                <span aria-hidden="true" class="se7en-star"></span>申请APi</a>
              </li>
              <?php }else{ ?>
			   <li><a href="admin.php">
                <span aria-hidden="true" class="se7en-star"></span>后台管理</a>
              </li>
			  <?php } ?>
              <li><a href="logout.php">
                <span aria-hidden="true" class="se7en-charts"></span>安全退出</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    <!-- End Navigation -->