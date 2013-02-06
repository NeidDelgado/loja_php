<?php
	var_dump($_SERVER);
	
	echo "<br><br><hr><br><br>";
	$url = "http://". $_SERVER['HTTP_HOST'];
	
	var_dump($url);
?>