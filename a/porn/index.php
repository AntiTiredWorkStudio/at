<?php 
	header("Content-Type: text/html;charset=utf-8"); 
	include_once("../Keychain.php");
	if(!KeyChain('../') && !isset($_GET['i'])){
		echo '验证失败!';
		exit;
	}
	if(isset($_POST['a'])){
		//var_dump($_GET);
		$arr=json_decode(file_get_contents('config.json'),TRUE); 
		$arr['article'][count($arr['article'])]['title'] = $_POST["at_title"];
		$arr['article'][count($arr['article'])-1]['url'] = $_POST["at_url"];
		file_put_contents('config.json',json_encode($arr));
		echo 'success';
		exit;
	}
	
	if(isset($_GET['d'])){
		//var_dump($_GET);
		$arr=json_decode(file_get_contents('config.json'),TRUE); 
		//$arr['article'][$_GET['i']] = $_GET["at_title"];
		array_splice($arr['article'], $_GET['i'], 1);
		//$arr['article'][count($arr['article'])-1]['url'] = $_GET["at_url"];
		file_put_contents('config.json',json_encode($arr));
		echo '删除成功!'.'<script type="text/javascript">window.location.href = "../post";alert("删除成功!");</script>';
		exit;
	}
	
	$arr=json_decode(file_get_contents('config.json'),TRUE); 
	$limSize = 9;
	
	$total = count($arr['article']);
	
	
	if(isset($_GET['s'])){
		
		foreach($arr['article'] as $key=>$value){
		?>
		<li class = "li-list"><span><?php echo $value['title'];?>   &nbsp&nbsp&nbsp&nbsp </span><span style="float:right;"><a href="<?php echo '../porn/?d&i='.$key;?>">删除</a></span></li>					
		<?php
		}
		exit;
	}


	//$rarr = $arr['article'];
	//array_reverse($arr['article']);
	$rarr = array();
	foreach($arr['article'] as $key=>$value){
		if($total>$limSize){
			$total--;
			continue;
		}
		$rarr[$key] = $value;
		$total--;
		//echo $key.' => '.$value['title'].'</br>';
	}
	
	$rarr = array_reverse($rarr);
	
	foreach($rarr as $key=>$value){
		?>
		<li class = "li-list"><a href="<?php echo $value['url'];?>"><?php echo ((strlen($value['title'])>15)?mb_substr($value['title'],0,15).'...':$value['title']);?></a></li>					
		<?php
	}
?>