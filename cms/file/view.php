<?php
include "login.php";
if((!isset($_GET['type']))or(empty($_GET['type']))){
	$info=pathinfo($_GET['path']);
	$ext=$info['extension'];
	$type="text/html";
	$eet=file("codec/extension.db");
	foreach($eet as $lin){
		$lini=explode("|", trim($lin));
		if($lini[0]==$ext){
			$type=$lini[1];
		}
	}
}else{
	$type=$_GET['type'];
}
header("Content-type: $type;");
readfile($_GET['path']);
?>