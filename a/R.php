<?php
	header("Content-Type: text/html;charset=utf-8"); 
	/*$str = "";
	foreach($_POST as $name=>$value){
		$str+=($name+','+$value);
	}
	file_put_contents("log.txt",$str);*/
	if(
		isset($_POST["at_client"])
	){
		date_default_timezone_set('Asia/Shanghai');
		$cont =  
			"[时间]".date("Y/m/d - H:i:s", time())."\r\n".
			"[留言人]".$_POST['at_client']."\r\n".
			"[公司]".$_POST['at_company']."\r\n" .
			"[内容]".$_POST['at_content']."\r\n\r\n";
		//$cont = utf8_encode($cont);
		file_put_contents('../../msg.txt',$cont,FILE_APPEND);
	}
	if(isset($_GET['g'])){
		$copyright = '<p class="wowload flipInX">
		<a href="#"><i class="fa fa-facebook fa-2x"></i></a> 
		<a href="#"><i class="fa fa-instagram fa-2x"></i></a> 
		<a href="#"><i class="fa fa-twitter fa-2x"></i></a> 
		<a href="#"><i class="fa fa-flickr fa-2x"></i></a></p>';
		echo $copyright;
	}
?>