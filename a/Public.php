<?php
	header("Content-Type: text/html;charset=utf-8"); 
	function getDirs($dir) {
		//echo $dir;
		$dirArray[]=NULL;
		if (false != ($handle = opendir ( $dir ))) {
			$i=0;
			while ( false !== ($file = readdir ( $handle )) ) {
				//去掉"“.”、“..”以及带“.xxx”后缀的文件
				if ($file != "." && $file != ".."&&!strpos($file,".")) {
					$dirArray[$i]=$file;
					$i++;
				}
			}
			//关闭句柄
			closedir ( $handle );
		}
		return $dirArray;
	}
	
	function getFiles($dir) {
		//echo $dir;
		$file=scandir($dir);
		$filePaths = [];
		$index = 0;
		foreach($file as $key=>$value){
			if($value == '.' || $value == '..'){
				continue;
			}
			$result = str_replace('../','',$dir.'/'.$value);
			
		//	echo '&nbsp'.$key.' => '.$result.'</br>';
			if($value=='config.json'){
				$filePaths['json'] = $result;
		//		echo '&nbspIs config file</br>';
			}else{
				$filePaths[$index++] = $result;
			}
		}
		return $filePaths;
		//print_r($file);
	}
	
	function getTeamFiles($dir) {
		$file=scandir($dir);
		$filePaths = [];
		$index = 0;
		foreach($file as $key=>$value){
			if($value == '.' || $value == '..'){
				continue;
			}
			$result = str_replace('../','',$dir.'/'.$value);
			
			if($value=='config.json'){
				$filePaths['json'] = $result;
			}else if($value=='qrcode.jpg' || $value=='qrcode.png'){
				$filePaths['qrcode'] = $result;
			}else if($value=='head.jpg' || $value=='head.png'){
				$filePaths['head'] = $result;
			}else{
				$filePaths[$index++] = $result;
			}
		}
		return $filePaths;
	}
	
	function endWith($haystack, $needle) {   

      $length = strlen($needle);  
      if($length == 0)
      {    
          return true;  
      }  
      return (substr($haystack, -$length) === $needle);
	}
	
	function GetVideo($img,$videoList){
		if(isset($videoList[$img])){
			return 'v="'.$videoList[$img]['video'].'"';
		}else{
			return "";
		}
	}
?>