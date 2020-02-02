<?php
$ext=$_INFO['extension'];
$_TYPE="text";
$eet=file("codec/extensioni.db");
foreach($eet as $lin){
	$lini=explode("|", trim($lin));
	if($lini[0]==$ext){
		$_TYPE=$lini[1];
	}
}
include "parts/$_TYPE.php";
?>