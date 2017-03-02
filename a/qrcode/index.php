<?php
include "phpqrcode.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>二维码在线生成-中文二维码</title>
<meta name="keywords" content="中文二维码,二维码生成,二维码制作,手机二维码" />
<meta name="description" content="在线中文/英文二维码生成工具。" />
<link href="style.css" rel="stylesheet" type="text/css" /-->

<!-- Google fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>

<!-- font awesome -->
<link href="../../css/font-awesome.min.css" rel="stylesheet">

<!-- bootstrap -->
<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css" />

<!-- animate.css -->
<link rel="stylesheet" href="../../assets/animate/animate.css" />
<link rel="stylesheet" href="../../assets/animate/set.css" />

<!-- gallery -->
<link rel="stylesheet" href="../../assets/gallery/blueimp-gallery.min.css">

<!-- favicon -->
<link rel="shortcut icon" href="../../images/favicon.ico" type="image/x-icon">
<link rel="icon" href="../../images/favicon.ico" type="image/x-icon">


<link rel="stylesheet" href="../../assets/style.css">

<!-- jquery -->
<script src="../../assets/jquery.js"></script>
</head>

<!--
制作:阿里(Ali727)
博客：http://www.ali727.com/
演示：http://www.ali727.com/files/code/
版本：V1.1
-->




<body>
	<div id="all" class = "text-center wowload fadeInUp animated">
	   <div id="title" class="text-center  wowload fadeInUp"><h5>二维码在线生成</h5></div>
		<div id="left">
			<form id="iform" name="iform" method="post" action="">
			<textarea name="content" id="content" style ="line-height:2.0;"><?php echo ((isset($_POST['content']))?$_POST['content']:"请输入内容"); ?></textarea><br/>
				<div id="now">
					<p>
						<input class="btn btn-primary" name="go" type="submit" id="go" onclick="" value="马上生成" />
						<input name="done" type="hidden" value="done" />
					</p>
				</div>
			</form>
		</div>
		<div id="right">
			<div class="code">
				<?php 
					//if(isset($_POST['done'])){
					if (isset($_POST['done'])){
					   if($_POST['content']){
						$c = $_POST['content'];

						$len = strlen($c);
						   if ($len <= 360){
							$file = fopen("t.txt","r+");
							flock($file,LOCK_EX);
							  if($file) {
							   $get_file = fgetss($file);
							   $t = $get_file+1;
							   $file2 = fopen("t.txt","w+");
							   fwrite($file2,$t);	
							   }
							flock($file,LOCK_UN);
							fclose($file);
							fclose($file2);
						
						   QRcode::png($c, 'png/'.$t.'.png');	
						   $sc = urlencode($c);
						   echo '<img src="png/'.$t.'.png" /><br />'; 
						   }
						   else {
							 echo '<h4>亲！信息量过大。</h4>';
						   }	
						}
						else {
						 echo '<h4>亲！你没有输入内容。</h4>';
						}
					}	
					else {
					  echo '<h4>二维码将会出现在这里。</h4>';
					}
				?>
			</div>
		</div>
	</div><br /><br />
	  <div class="row wowload fadeInLeftBig">
		  <div  class="col-sm-6 col-sm-offset-3 col-xs-12">
			<span style="margin-top:70px;font-size:30px;"><a href = '../post'><i class="fa fa-reply"></i> 返回发布</a></span>  
		  </div>
	  </div>   
  </body>
</html>
