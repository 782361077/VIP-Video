<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<title>云屋解析站后台</title> 
<link rel="shortcut icon" href="images/tb.png">
<link rel="stylesheet" type="text/css" href="style.css" data-for="result">
</head>
<body>
<?php
error_reporting(0);include './pass.php';
function qxg($str){
	$str=stripslashes($str);
	$str=str_replace('\'','\\'.'\'',$str);
	return $str;}
$namess=end(explode('/',$_SERVER['PHP_SELF']));
if($_COOKIE['x_Cookie'] == $用户名 and $_COOKIE['y_Cookie'] == $密码){
}else{
    if(!empty($_POST['adminname'])){
        if($_POST['password'] == $密码 & $_POST['adminname'] == $用户名){
             setcookie("y_Cookie", $密码);
             setcookie("x_Cookie", $用户名);
        }
        else{
            echo"<script>alert('用户名或密码错误!!!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
            exit;
        }
    }else{?>
 <div class="login">
 <div class="login-l">
	<div class="login-title">云屋解析站后台</div>
		<form action="./<?php echo $namess;?>"   method="POST" autocomplete="off">
        <div class="login-line">
		<input  type="text" name="adminname" class="inputtxt" autocomplete="on" placeholder="账号">
		</div>
		<div class="login-line">
           <input  type="password" name="password" class="inputtxt" placeholder="密码">
		</div>   
           <input  type="submit" value="登录" class="buttontxt">     
           </form>
          </div>
         </div>

 </body>
 </html>
<?php exit;}}?>

<?php if(empty($_GET['sort'])){$_GET['sort']='index';}?>
<div class="index">
<div class="index-h">
</div>
<div class="index-c">
<div class="index-nav">
	<ul>
		<li><a href="?">基本设置</a></li>
		<li><a href="?sort=admin">修改密码</a></li>
		<li><a href="../index.php" target="_blank" >网站前台</a></li>
		<li><a href="https://www.yunwuo.com/cart?fid=4&gid=9" target="_blank" >5元主机</a></li>
	</ul>
</div>
<?php if($_GET['sort']=='index')
	{include '../config/config.php';
$strm=
array(array('网站名称','name','你网站的名子'),
array('标题','biaoti','主页最上面的那个'),
array('关键字','keywords','用于百度搜索，你想搜哪些关键词能在百度搜索出来'),
array('网站简介','miaoshu','简单介绍一下你的网站吧！'),
array('背景图片','beijing','图片的地址，外部地址记得加http://'),
array('网站图标','tubiao','图标的地址，外部地址记得加http://'),
array('网站logo','logo','logo地址，外部地址记得加http://'),
array('右上角链接','link','按格式填写'),
array('视频接口','jiekou','按格式填写'),
array('滚动公告','gonggao1','播放窗口上方一直在动的那个'),
array('接口广告','guad','接口下面的广告位，用li标签'),
array('自定义提示','tishilogg','多个视频网站logo上方的提示，比如版权什么的'),
array('网站底部','footer','网站底部信息，按格式填写，可加统计代码'),
array('放啥都行','guad1','底部的接口，可以放一些JS代码类，比如联盟对联广告等。'));?>	
	 <?php 
	 if($_GET['mod']=='save'){
		$strss='<?php ';
	    for($i=0;$i<count($strm);$i++){
			$guodus=explode('-',$strm[$i][1]);
			if(count($guodus)==1){
				$strss.='$config[\''.$guodus[0].'\']=\''.qxg($_POST[$strm[$i][1]]).'\';';
				}elseif(count($guodus)==2){
					$strss.='$config[\''.$guodus[0].'\'][\''.$guodus[1].'\']=\''.qxg($_POST[$strm[$i][1]]).'\';';
					}elseif(count($guodus)==3){
						$strss.='$config[\''.$guodus[0].'\'][\''.$guodus[1].'\'][\''.$guodus[2].'\']=\''.qxg($_POST[$strm[$i][1]]).'\';';}}
	    $strss.=' ?>';
		file_put_contents('../config/config.php',$strss);
		echo"<script>alert('设置保存成功!!!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";
	 ?>	
	 <?php exit;}?>
<form action="?sort=index&mod=save" method="POST">
<table width="100%" border="1" class="table_striped table_hover">
<?php for($i=0;$i<count($strm);$i++){?>
<tr>
    <td width="150"><?php echo $strm[$i][0];?></td>
    <td><?php if($i<7){?><input type="text" name="<?php echo $strm[$i][1];?>"  autocomplete="off"  value="<?php echo $config[$strm[$i][1]];?>">
	<?php }else{?>
	<textarea rows="6" cols="130%" name='<?php echo $strm[$i][1];?>'><?php echo $config[$strm[$i][1]];?></textarea>
	<?php }?>
	</td>
	<td width="200"><?php echo $strm[$i][2];?></td>
  </tr>
	<?php }?>
	</table>
<input  type="submit" value="保存修改" class="buttontxt" >
</form>
<?php }elseif($_GET['sort']=='admin'){?>   
	<?php if($_GET['mod']=='save'){if(!empty($_POST['name']) and !empty($_POST['pass'])){$strss='<?php $用户名=\''.$_POST['name'].'\'; $密码=\''.$_POST['pass'].'\';?>';file_put_contents('./pass.php',$strss);}else{$zt='n';}?>	
	 <br>
	 <?php if($zt=='n'){echo "<script>alert('用户名或密码不能为空!!!');location.href='".$_SERVER["HTTP_REFERER"]."';</script>";}else{echo "<script>alert('用户名密码修改成功!!!');location.href='?sort=index';</script>";}?><?php exit;}?>
<form action="?sort=admin&mod=save" method="POST">
<table width="100%" border="0" cellspacing="2">
	<tr>
	<td width="150">修改用户名</td>
	<td><input type="text" name="name"  autocomplete="off" placeholder="输入修改后的用户名" style="width:91%"></td>
	<td>请设置复杂一点的用户名</td>
	</tr>
  <tr>
    <td width="150">修改密码</td>
    <td><input type="text" name="pass"  autocomplete="off" placeholder="输入修改后的密码" style="width:91%"></td>
	<td>请设置复杂一点的密码</td>	
  </tr>
</table>    
<input  type="submit" value="保存修改" class="buttontxt">
</form>
 <?php }?>
 <div class="index-f">
	<p>Copyright © 2017 <a href="https://www.wenytao.com/" target="_blank"  >IT屋博客</a>  版权所有. 丨 <a href="https://www.wenytao.com/">云屋VIP解析V2.3版本</a></p>
</div>
</div>
</div>
 </body></html>