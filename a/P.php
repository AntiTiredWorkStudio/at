<?php
	header("Content-Type: text/html;charset=utf-8"); 
	function getDirs($dir) {
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
	
	
	/*foreach($arr as $key=>$value){
		echo $key.'=>'.$value.'</br>';
		$files = getFiles('../images/demos/'.$value);
		if(isset($files['json'])){
			echo '&nbsp'.$files['json'];
		}else{
			echo '&nbspno config file!</br>';
		}
	}*/
	$arr = getDirs('../images/demos');
//	var_dump($arr);
	$index = 1;
	foreach($arr as $key=>$value){
		$files = getFiles('../images/demos/'.$value);
		$C = null;
		if(isset($files['json'])){
			$config = file_get_contents('../'.$files['json']);// this line need to be change
			$C = json_decode($config,TRUE);
			//var_dump($C);  
			//echo $de_json->title;
			//echo $config;
		}else{
			continue;
		}
		$title = $C['title'];
		$intro = $C['content'];
		$videos = $C['videos'];
		$galleryName = 'data-gallery';
		?>
<figure class="effect-oscar  wowload fadeIn">
        <img src="<?php echo $files[0];?>" alt="img01"/>
        <figcaption>
            <h2><?php echo $title;?></h2>
            <p><?php echo $intro;?><br>
            <a href="<?php echo $files[0];?>" gallery="<?php $itemIndex =(($index<10)?'0':'').$index; echo $itemIndex;?>" title="<?php
				$v = GetVideo($files[0],$videos);
				echo '01'.(($v != '')?'[预览]':'');
			?>" 
			<?php echo $v; 
				  echo $galleryName.$itemIndex;?>>更多</a></p>  
			<br/>       
			<?php 
				$detialsIndex = 2;
				foreach($files as $key=>$value){
					if($key == '0' || $key == 'json'){
						continue;
					}
					$IndexContent =(($detialsIndex<10)?'0':'').$detialsIndex;
			?>   
			<a href="<?php echo $value;?>" style="visibility:hidden" title="<?php $vv = GetVideo($value,$videos); echo $IndexContent.(($vv != '')?'[预览]':'');?>" <?php echo $vv?> <?php echo $galleryName.$itemIndex;?>></a>
			<?php 
					$detialsIndex++;
				}
			?>
        </figcaption>
</figure>
<?php 
	$index++;
}?>