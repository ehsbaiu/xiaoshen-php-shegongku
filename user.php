<?php
include_once ('head.php');

$my=isset($_POST['my'])?$_POST['my']:null;

if($my=='chat'){
$content=defense($_POST['content']);
	if($conf['chat']!=1){
		msg('聊天室已关闭！','user.php');
	}elseif(!$content){
		msg('发送内容不能留空！','user.php');
	}elseif($DB->get_row("select * from ". DBQZ ."_data where `uid` = '{$row['uid']}', `content` = '{$content}' limit 1")){
		msg('不要发重复内容哦！','user.php');
	}
	$row_time=$DB->get_row("select * from ". DBQZ ."_data where `uid` = '{$row['uid']}' order by id desc limit 1");
	if($row_time['time'] >= date("H:i:s")){
		msg('你的发言速度太快了，请休息一下稍后重试。','user.php');
	}elseif($DB->query("INSERT INTO  `". DBQZ ."_data` ( `uid` , `content` , `date` , `time`) VALUES ( '{$userrow['uid']}',  '$content',  '{$date}' , '".date("H:i:s")."')")){
		msg('发送成功！','user.php');
	}else{
		msg('发送失败！','user.php');
	}
}
?>
      <div class="container-fluid main-content">
        <!-- Statistics -->
        <div class="row">
          <div class="col-lg-12">
            <div class="widget-container stats-container">
              <div class="col-md-3">
                <div class="number">
                  <div class="icon globe"></div>
                  <?=$DB->count("select count(id) as count from " . DBQZ . "_qq where 1=1");?>
                </div>
                <div class="text">
                  系统数据
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon visitors"></div>
                  <?=$DB->count("select count(uid) as count from " . DBQZ . "_user where 1=1");?>
                </div>
                <div class="text">
                  用户数量
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon money"></div>
                  <small>$</small><?=intval($row['value'])?>
                </div>
                <div class="text">
                  账户余额
                </div>
              </div>
              <div class="col-md-3">
                <div class="number">
                  <div class="icon chat-bubbles"></div>
                  <?=date("H:i:s")?>
                </div>
                <div class="text">
                  当前时间
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Statistics -->
        <div class="row">
          <!-- Weather -->
          <div class="col-md-3">
            <div class="widget-container small">
              <div class="heading">
                <i class="icon-signal"></i>Miami 查询<i class="icon-refresh pull-right"></i>
              </div>
              <div class="widget-content padded">
				<form method="post" action="?"><input type="hidden" name="my" value="query">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon">QQ账号</span><input class="form-control" id="qq" name="qq" placeholder="请输入账号" type="text">
						</div>
					</div>
					<div class="form-group">
						<button class="btn btn-primary btn-block">确认查询</button>
					</div>
				</form>
              </div>
            </div>
          </div>
<?php
if(isset($_POST['my'])=='query'){
?>
		<div class="col-md-5">
            <div class="widget-container fluid-height">
              <div class="heading">
                <i class="icon-signal"></i>query 结果<i class="icon-refresh pull-right"></i>
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
                      QQ老密
                    </th>
                    <th class="hidden-xs">
                      入库时间
                    </th>
                    <th class="hidden-xs">
                      操作
                    </th>
                  </tr></thead>
                  <tbody>
<?php
$qq=intval($_POST['qq']);
$pbfg=explode('|',$conf['pbqq']);
foreach($pbfg as $val){
	if($val==$qq){
		$msg=1;
		continue;
	}else{
		$msg=0;
	}
}
$qq=intval($_POST['qq']);
$sql_qq =$DB->query("select * from ". DBQZ ."_qq where `qq` = '{$qq}'");
while($row_qq=$DB->fetch($sql_qq)){
	if($msg==1)
		$pwd = '此账号已被屏蔽！';
	else
		$pwd = $row_qq['pwd'];
	echo '
	<tr>
      <td>
        '.$row_qq['id'].'
      </td>
      <td>
        '.$row_qq['qq'].'
      </td>
      <td>
        '.$pwd.'
      </td>
      <td class="hidden-xs">
        '.$row_qq['date'].'
      </td>
      <td class="hidden-xs">
        <span class="label label-success">Apply</span>
      </td>
    </tr>
	';
}
?>
                    
                  </tbody>
                </table>
				<div class="roll-title"><i class="icon-cloud"></i> 其它云数据 (暂停使用)</div>
				<table class="table">
                  <tbody>
<?php
//$url = 'http://www.topug.com/Passquery_to_api_matter.php?qqnumber='.intval($_POST['qq']);
$getcont=file_get_contents($url);
$getjson=json_decode($getcont,true);
$match=explode("|",$getjson['pwd']);
if($getjson['ret']=='1003'){
	$match="";
}
foreach($match as $val){
	if($getjson['pwd']){//如果密码存在就把云数据存入数据库 ，机制的小照！^_~ 
		if(!$DB->get_row("SELECT *  FROM  `". DBQZ ."_qq`  WHERE  `qq` =  '".defense($getjson['uin'])."' AND  `pwd` =  '".defense(trim($val))."'")){//防止重复存入
			$sql=$DB->query("insert into `". DBQZ ."_qq` (`qq`,`pwd`,`date`) values ('".defense($getjson['uin'])."','".defense(trim($val))."','".$date."')");//加defense是为了防止api注入木马
		}
	}
	$i = $i + 1;
	echo '
	<tr>
      <td>
        '.$i.'
      </td>
      <td>
        '.defense($getjson['uin']).'
      </td>
      <td>
        '.defense(trim($val)).'
      </td>
      <td class="hidden-xs">
        '.$date.'
      </td>
      <td class="hidden-xs">
        <span class="label label-success">Apply</span>
      </td>
    </tr>
	';
}
?>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
<?php
}else{
?>
		<div class="col-md-5">
            <div class="widget-container small">
              <div class="heading">
                <i class="icon-signal"></i>query sys<i class="icon-refresh pull-right"></i>
              </div>
              <div class="widget-content padded">
				<div class="form-group">
					<label class="control-label col-md-10">大数据资料</label>
					<div class="holder">
						<input checked="checked" class="check-ios" type="checkbox" value="None"><label for="check"></label><span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-10">本地资料①</label>
					<div class="holder">
						<input checked="checked" class="check-ios" type="checkbox" value="None"><label for="check"></label><span></span>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-10">备份服务器②</label>
					<div class="holder">
						<input checked="checked" class="check-ios" type="checkbox" value="None"><label for="check"></label><span></span>
					</div>
				</div>
				
              </div>
            </div>
          </div>
<?php } ?>
          <!-- end Weather --><!-- Bar Graph -->
          <div class="col-md-4">
            <div class="widget-container small">
              <div class="heading">
                <i class="icon-signal"></i>最新入库<i class="icon-list pull-right"></i><i class="icon-refresh pull-right"></i>
              </div>
              <div class="widget-content padded">
                <div class="bar-chart-widget">
                  <div class="chart-graph">
						<?php
						$sql_qq=$DB->query("select * from ". DBQZ ."_qq order by id desc limit 8");
						while($row_qq = $DB->fetch($sql_qq)){
							echo '
							<img src="http://q1.qlogo.cn/g?b=qq&nk='.$row_qq['qq'].'&s=100" class="qqlogo" style="width: 64px;"/>
							';
						}
						?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Bar Graph -->
        </div>
        <div class="row">
          <!-- Area Charts:Morris -->
          <div class="col-lg-6">
            <div class="widget-container scrollable list rollodex">
              <div class="heading">
                <i class="icon-globe"></i>友情链接<i class="icon-plus pull-right"></i><i class="icon-search pull-right"></i><i class="icon-refresh pull-right"></i>
              </div>
              <div class="widget-content">
                <div class="roll-title"><i class="icon-bullhorn"></i>
                  欢迎各类网站程序和本站友链，IP=>50 联系小照。
                </div>
                <ul>
<?php
$sql_url = $DB->query("select * from ". DBQZ ."_yqlj limit 30");
while ($row_url = $DB->fetch($sql_url)) { 
?>
                  <li>
                    <img width="30" height="30" src="images/avatar-female.png"><a href="<?=$row_url['url']?>"><?=$row_url['name']?></a>
                  </li>
<?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <!-- Area Charts:Morris --><!-- Chat -->
          <div class="col-md-6">
            <div class="widget-container scrollable chat" style="height: 427px;">
              <div class="heading">
                <i class="icon-comments"></i>聊天室 Beta 30t<i class="icon-smile pull-right"></i>
              </div>
              <div class="widget-content padded">
                <ul>
<?php 
if(isset($_GET['do'])=='del'){
$id=intval($_GET['id']);
	if($row['administration']!=1){
		msg('无权操作！','user.php');
	}elseif($DB->query("DELETE FROM `". DBQZ ."_data` WHERE `id` = {$id}")){
		msg('删除成功！','user.php');
	}else{
		msg('删除失败！','user.php');
	}
}

$sql_data = $DB->query("select * from ". DBQZ ."_data limit 30");
while ($row_data = $DB->fetch($sql_data)) { 
$row_user=$DB->get_row("SELECT *  FROM  `". DBQZ ."_user`  WHERE  `uid` ={$row_data['uid']} LIMIT 1");
?>
                  <li <?php
				  if($row_data['uid']==$row['uid']){
					  echo 'class="current-user"';
				  }
				  ?>>
                    <img width="30" height="30" src="http://q1.qlogo.cn/g?b=qq&nk=<?=$row_user['qq']?>&s=100" />
                    <div class="bubble">
                      <a class="user-name" href="#"><i class="icon-user"></i> <?=$row_user['user']?> 说：</a>
					  <?php if($row['administration']==1){ ?>
					  <a href="?do=del&id=<?=$row_data['id']?>"><i class="icon-trash"></i></a>
					  <?php } ?>
                      <p class="message">
                        <?=$row_data['content']?>
                      </p>
                      <p class="time"><i class="icon-time"></i>
                        <strong>发布于：</strong><?=mdate($row_data['date']); ?>
                      </p>
                    </div>
                  </li>
<?php
}
?>
                </ul>
              </div>
              <div class="post-message">
				<form method="post" action="?"><input type="hidden" name="my" value="chat">
					<?php  
					if($conf['chat']==1){
						echo '<input class="form-control" name="content" placeholder="骚年，来一发吧..." type="text"><input type="submit" value="发送">';
					}else{
						echo '<input class="form-control" disabled placeholder="聊天室已关闭！" type="text"><input type="submit" style="color: #bbbbbb;" value="发送">';
					}
					?>
					
				</form>
              </div>
            </div>
          </div>
          <!-- End Chat -->
			<div class="col-md-6">
				<div class="widget-container fluid-height">
					<div class="heading">
						<i class="icon-signal"></i> 站长统计<i class="icon-refresh pull-right"></i>
					</div>
				</div>
				<div class="widget-content padded" style="text-align:center;"><!--中心字体-->
					<?=$conf['cnzz']?>
				</div>
			</div>
			
        </div>

      </div>
    </div>
  </body>

</html>