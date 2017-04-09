<?php
	header("Content-Type: text/html;charset=utf-8"); 
	if(isset($_REQUEST['gk'])){
		ini_set('date.timezone','Asia/Shanghai');
		$timeDelta = time() - filemtime ('key/config.json');
		if($timeDelta > 30){
			$arr=json_decode(file_get_contents('key/config.json'),TRUE); 
			$arr['kt'] = date("Y-m-d H:i:s",time());
			$arr['t'] = time();
			$arr['r'] = rand('100000','999999');
			$arr['kv'] = sha1($arr['t'].$arr['r']);
			file_put_contents('key/config.json',json_encode($arr));
			
			//echo $arr["kt"];
			//var_dump($arr);
			//$arr['article'][count($arr['article'])]['title'] = $_GET["at_title"];
			//$arr['article'][count($arr['article'])-1]['url'] = $_GET["at_url"];
			//file_put_contents('config.json',json_encode($arr));
			//$arr=json_decode(file_get_contents('key/config.json'),TRUE); 
			$res = [
				't'=>$arr['t'],
				'r'=>$arr['r']
			];
			echo json_encode($res);
		}else{
			$arr=json_decode(file_get_contents('key/config.json'),TRUE); 
			$res = [
				't'=>$arr['t'],
				'r'=>$arr['r']
			];
			echo json_encode($res);
		}
	}
	function KeyChain($prefix=''){
		if(isset($_REQUEST['key'])){
			$arr=json_decode(file_get_contents($prefix.'key/config.json'),TRUE); 
			if($arr['kv'] == $_REQUEST['key']){
				//echo 'success';
				return true;
			}else{
				//echo 'failed';
				return false;
			}
		}
		return false;
	}
?>