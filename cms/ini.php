<?php
$file= __DIR__ . DIRECTORY_SEPARATOR ."php.ini";
$file=file($file);
foreach($file as $line){
	$line=preg_replace("@;.*$@", "", $line);
	$line=trim($line);
	if(strpos($line, "=")){
		$par=explode("=", $line);
		$par[0]=trim($par[0]);
		$par[1]=trim($par[1]);
		ini_set($par[0], $par[1]);
	}
}
?>