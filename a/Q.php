<?php
	require "Res/autoload.php";
	//include_once("Keychain.php");
	include_once("Public.php");
	use Qiniu\Auth;
    use Qiniu\Storage\UploadManager;
	/*if(!KeyChain()){
		echo 'auth failed!';
		exit;
	}*/
	// 用于签名的公钥和私钥
	$accessKey = 'd-SztTGFAV7_BX-dKRtM8y1diABoXe1zxCgd-2yi';
	$secretKey = 'CWv29dzAFng2KZ15Cf21Pv6FoOoWtB3-nzh1zgJH';
	// 初始化签权对象
    $bucket = 'antitired';
    
	
	$targetDir = "../images/demos";
	
	
	if(isset($_POST['list'])){
		echo FilePath($_POST['td']);
		exit;
	}
	
	
	if(isset($_POST['ak'])){
		$accessKey = $_POST['ak'];
		$secretKey = $_POST['sk'];
		$bucket = $_POST['bk'];
		$targetDir = $_POST['td'];
		//echo "normal";
		$auth = new Auth($accessKey, $secretKey);    // 要上传的空间
		PutFile($auth,$accessKey,$secretKey,$bucket,$targetDir);
	}else{
		echo "没接到请求的空间和id";
		exit;
	}
	
	function PutFile($auth,$accessKey,$secretKey,$bucket,$targetDir){
		if(!file_exists($targetDir)){
			echo "文件路径不存在!";
			exit;
		}
		$token = $auth->uploadToken($bucket);
	
		$uploadMgr = new UploadManager();
		
		set_time_limit(300);
		
		foreach(getDirs($targetDir) as $key=>$value){
			$subDir = $targetDir.(($value=='')?'':'/').$value;
			foreach(getFiles($subDir) as $key=>$value){
				$file = '../'.$value;//."</br>";
				list($ret, $err) = $uploadMgr->putFile($token, $value, $file);
				echo "上传成功:".$file;
			}
		}
		
		set_time_limit(30);
	}
	
	function FilePath($targetDir){		
		if(!file_exists($targetDir)){
			echo "文件路径不存在!";
			exit;
		}

		$result = "";
		$fromate = '<li class = "li-list">'.
			'<a href="'.''.'">'.''.'</a>'.
			'<span style="float:right;">'.
				'<a href="'.''.'">删除</a>'.
			'</span>'.
			'</li>'	;
		foreach(getDirs($targetDir) as $key=>$value){
			$subDir = $targetDir.(($value=='')?'':'/').$value;
			foreach(getFiles($subDir) as $key=>$value){
				$file = '../'.$value;
				
				$result = $result.('<li class = "li-list">'.
					'<a href="'.'../'.$file.'">'.$file.'</a>'.
					'<span style="float:right;">'.
						'<a href="'.'#'.'">删除</a>'.
					'</span>'.
					'</li>')	;
			}
		}
		
		return $result;
	}
	
?>
