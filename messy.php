<?php
	$fp = fopen('input.txt', 'r');
	while(!feof($fp)){
		$temp = fgets($fp);
		$temp = explode(" ", $temp);
		for($i = 0; $i < sizeof($temp); $i++){
			echo $temp[$i];
			echo "</br>";
		}
	}
	$count = 1;
	echo "第"."$count"."条书目已存在！<br>";
	
?>