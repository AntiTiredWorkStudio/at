<style type="text/css">
          .effect-chico{position: relative;}
          .btt{border: 1px solid #fff; margin-top: 1em; color: #fff; padding: 0 2em;background: none}
          .dis_fig{width:100%;height: 100%; position: absolute;left: 0;top: 0;z-index: 1;display: none;box-shadow:5 5 5px #aaa;opacity: 1.0;background: #101010  }
          .dis_fig .pic{width: 70%;height: 70%;/*margin: 0 auto;margin-top:15%;*/position: absolute;left: 15%;top:5%;}
          .dis_fig .pic img{ width: 100%;height: 100% }
          .dis_fig .pic p{margin-top:5%;white-space:nowrap;}
        </style>
<?php
	
	include_once("Public.php");
	
	$arr = getDirs('../images/team');
//	var_dump($arr);
	
	foreach($arr as $key=>$value){
		
		$files = getTeamFiles('../images/team/'.$value);
		$C = null;
		if(isset($files['json'])){
			$config = file_get_contents('../'.$files['json']);// this line need to be change
			$C = json_decode($config,TRUE);
		//	var_dump($C);  
			//echo $de_json->title;
			//echo $config;
		}else{
			continue;
		}
		if(!isset($files['qrcode']) || !isset($files['head'])){
			continue;
		}
		if(isset($C['secret']) && $C['secret']){
			continue;
		}
		$name = $C['name'];
		$tel = $C['tel'];
		$mail = $C['mail'];
		$intro = $C['intro'];
?>
<div class="col-sm-3 col-xs-6">
	<figure class="effect-chico">
        <img src="<?php echo $files['head'];?>" alt="img01" class="img-responsive" />
        <figcaption>
            <p><?php echo $name;?></p>    
            <p><?php echo $intro;?></p>  
            <p><input type="button" name="" value="联系我" class="btt"></p>
            <div class="dis_fig">
             <div class="pic">
                 <img src="<?php echo $files['qrcode'];?>" >
                 <p><span>手机：</span><span><?php echo $tel;?></span></p>
                 <p><span>邮箱：</span><span><?php echo $mail;?></span></p>
             </div>
            </div>
		</figcaption>
    </figure>
</div>
<?php 	

		}?>