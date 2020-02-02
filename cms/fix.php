<?php
//if(!file_exists($_SERVER['DOCUMENT_ROOT']."/cms/core/include.php")){
//	file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/core/include.php", Restore());
//}
//if(!file_exists($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/part.log")){
//	file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/part.log", serialize(array()));
//}
//$fh = fopen("example.phb", "w");
//bcompiler_write_header($fh);
//bcompiler_write_file($fh, "cms.php");
//bcompiler_write_footer($fh);
//fclose($fh);
//SetR("a", "b");
//echo(Restore("a"));
function Restore($pro){
	$file=file($_SERVER['SCRIPT_FILENAME']);
	$s=false;
	$restore="";
	foreach($file as $line){
		$line=trim($line);
		if($s){
			if(($line[0]=='/')and($line[1]=='/')){
				break;
			}else{
				$line=substr($line, 2);
				$line=substr($line, 0, strlen($line)-2);
				$restore.=$line."\r\n";
			}
		}else{
			if($line=="//**RESTORE:".$pro){
				$s=true;
			}
		}
	}
	return trim($restore);
}
function SetR($pro, $text){
	$file=file($_SERVER['SCRIPT_FILENAME']);
	file_put_contents($_SERVER['SCRIPT_FILENAME'], "");
	$fh=fopen($_SERVER['SCRIPT_FILENAME'], "ab+");
	$text=explode("\n", $text);
	$current=-1;
	for($k=0;$k<count($file);$k++){
		$line=rtrim($file[$k]);
		if(($line=="")and($current<count($text))){
			if($current==-1){
				$line="//**RESTORE:".$pro;
			}else{
				$line="/*".rtrim($text[$current])."*/";
			}
			$current++;
			if(trim($file[$i+1])!=""){
				$file[count($file)-2]="";
				$file[count($file)-1]="";
				$file[]="end:";
				$file[]="?>";
			}
		}
		$line.="\r\n";
		fwrite($fh, $line);
	}
	fclose($fh);
	unset($file);
	unset($text);
	file_put_contents($_SERVER['SCRIPT_FILENAME'], preg_replace("@\r\n(\r\n)+@", "\r\n\r\n", trim(file_get_contents($_SERVER['SCRIPT_FILENAME']))));
}
goto end;
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/
//**RESTORE:a
/*b*/

end:
?>