<?php
if(file_exists("saveeror.txt")and(trim(file_get_contents("saveeror.txt"))=="1")){
	file_put_contents($_POST['file'], str_replace("\r\r", "\r", str_replace("\n", "\r\n", base64_decode($_POST['text']))));
}else{
	if(!file_exists("saveeror.log")){
		file_put_contents("saveeror.log", "UNSECURE: ".date("H:i:s")." on ".date("d.m.Y"));
	}else{
		file_put_contents("saveeror.log", file_get_contents("saveeror.log")."\r\nUNSECURE: ".date("H:i:s")." on ".date("d.m.Y"));
	}
}
?>
