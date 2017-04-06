<?php
	require "Res/autoload.php";
	include_once("Public.php");
	use Qiniu\Auth;
	// 用于签名的公钥和私钥
	$accessKey = 'd-SztTGFAV7_BX-dKRtM8y1diABoXe1zxCgd-2yi';
	$secretKey = 'CWv29dzAFng2KZ15Cf21Pv6FoOoWtB3-nzh1zgJH';
	// 初始化签权对象
	$auth = new Auth($accessKey, $secretKey);    // 要上传的空间
    $bucket = 'antitired';
    // 生成上传 Token
    $token = $auth->uploadToken($bucket);
	var_dump(getDirs("../image"));
?>
