<?php

	include_once("Keychain.php");
	if(!KeyChain()){
		echo '验证失败!';
		exit;
	}
/*	header("Content-Type: text/html;charset=utf-8"); 
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
	}*/
	/*foreach($arr as $key=>$value){
		echo $key.'=>'.$value.'</br>';
		$files = getFiles('../images/demos/'.$value);
		if(isset($files['json'])){
			echo '&nbsp'.$files['json'];
		}else{
			echo '&nbspno config file!</br>';
		}
	}*/
	include_once("Public.php");
	$arr = getDirs('../images/demos');
//	var_dump($arr);
	
	
	$start = $_POST['s'];
	$count = $_POST['c'];
	$lastReal = $_POST['r'];
//	echo ($_POST['d']);
	$index = 1;//$start;
	$total = count($arr); 
	$real = 0;
	foreach($arr as $key=>$value){
		if($index < $start){
			$index++;
			continue;
		}
		if($index>($start+$count-1) || $index >$total){
			break;
		}
		$files = getFiles('../images/demos/'.$value);
		$C = null;
		if(isset($files['json'])){
			$config = file_get_contents('../'.$files['json']);// this line need to be change
			$C = json_decode($config,TRUE);
			$real++;
			//var_dump($C);  
			//echo $de_json->title;
			//echo $config;
		}else{
			continue;
		}
		if(isset($C['secret']) && $C['secret']){
			continue;
		}
		$title = $C['title'];
		$intro = $C['content'];
		$videos = $C['videos'];
		$galleryName = 'data-gallery';
		?>
<figure class="effect-oscar  wowload <?php echo ((($_POST['d']=='false'))?"fadeTransLeft":"fadeTransRight");?>">
        <img src="<?php echo (($index%2==0)?'http://oo17i9uqp.bkt.clouddn.com/':'http://olbe549rf.bkt.clouddn.com/').$files[0];?>" alt="img01"/>
        <figcaption>
            <h2><?php echo $title;?></h2>
            <p><?php echo $intro;?><br>
            <a onclick = "alert('还未完成加载');" href = "<?php echo '../../';?>" shref="<?php echo (($index%2==0)?'http://oo17i9uqp.bkt.clouddn.com/':'http://olbe549rf.bkt.clouddn.com/').$files[0];?>" gallery="<?php $itemIndex =(($index<10)?'0':'').$index; echo $itemIndex;?>" title="<?php
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
			<a href="<?php echo (($index%2==0)?'http://oo17i9uqp.bkt.clouddn.com/':'http://olbe549rf.bkt.clouddn.com/').$value;?>" style="visibility:hidden" title="<?php $vv = GetVideo($value,$videos); echo $IndexContent.(($vv != '')?'[预览]':'');?>" <?php echo $vv?> <?php echo $galleryName.$itemIndex;?>></a>
			<?php 
					$detialsIndex++;
				}
			?>
        </figcaption>
</figure>
<?php 
	$index++;
}


$lastStart = $start-$count;
$nextStart = $start+$count;
$subAddson = ($count - $lastReal);
$addon = ($count%2==0)?(/*$lastReal+*/0):(/*$lastReal +*/1);
$onborder = "none";
if($lastStart<0){
	$lastStart = $start;// += ($total+$addon);
	/*if($lastStart == 0){
		$lastStart = 1;
	}*/
	$onborder = 'left';
}


if($nextStart>$total){
	$nextStart  = $start; //-= ($total+$addon);//(floor($total/$count)*($count));
	/*if($nextStart == 0){
		$nextStart = 1;
	}*/
	$onborder = 'right';
}


?>
<meta id="galleryData" border = "<?php echo $onborder;?>" total = "<?php echo $total;?>" real = "<?php echo $real;?>" current = "<?php echo $start;?>" lastStart = "<?php echo $lastStart;//(($start-$count-1)<0)?1:($start-$count);?>" nextStart = "<?php echo $nextStart;//echo (($start+$count-1)>=$total)?$total:($start+$count);?>">