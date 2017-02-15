<html>
	<head>
		<title>留言板</title>
	</head>
	<body>
	<?php 
		$file = '../../../msg.txt';
		if(!file_exists($file)){
			file_put_contents($file,"");
		}
		$content = file_get_contents($file);
		$content = str_replace('[','</p><p>[',$content);
		echo $content;
	?>
		<p>
			<button onclick="window.location.href = '../../index.html';">主页</button>
		</p>
	</body>
</html>