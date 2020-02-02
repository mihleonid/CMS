<?php
if(!isset($_GET['tsel'])){
	header("Content-Type: text/html; charset=utf-8");
	readfile("help_CMS/HELP_NEW.html");
}else{
	if($GET['tsel']=='down'){
		readfile("help.zip");
	}else{
		readfile('vbn.int');
	}
}
?>