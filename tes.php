<?php  
	// if (!mkdir('tes/'.rand(1,10), 0777,true)) {
	// 	die('Failed to make folder');
	// }

	$temp = explode(".", "jsjsjs.jpeg");
	$newName = round(microtime(true)) . '.' .end($temp);

	echo $newName;
?>