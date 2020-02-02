<?php
include "login.php";
clearstatcache();
function files($path, $class){
$dir=new DirectoryIterator($path);
foreach($dir as $file){
if(!$file->isDot()){
$namp=$file->getPathname();
if(strpos($namp, "\\\\")===0){
	$namp=substr($namp, 1);
}
$namefile=$file->getFilename();
$namefile=preg_replace("@[^a-zA-Z1-90 !\@#\$%\^&\(\)\-\+\.;`~,_=']@", "?", $namefile);
if(is_dir($namp)){
	$namefile="[$namefile]";
}
$size=filesize($namp);
$suf=1;
/* if($size>=8){
	$suf+=1;
	$size=round($size/8);
} */
if($size>=1024){
	$suf+=1;
	$size=round($size/1024);
}
if($size>=1024){
	$suf+=1;
	$size=round($size/1024);
}
if($size>=1024){
	$suf+=1;
	$size=round($size/1024);
}
if($size>=1024){
	$suf+=1;
	$size=round($size/1024);
}
if($size>=1024){
	$suf+=1;
	$size=round($size/1024);
}
/* switch($suf){
	case 1:
	$suf="Байт";
	break;
	case 2:
	$suf="Бит";
	break;
	case 3:
	$suf="КБ";
	break;
	case 4:
	$suf="МБ";
	break;
	case 5:
	$suf="ГБ";
	break;
	case 6:
	$suf="ТБ";
	break;
} */
switch($suf){
	case 1:
	$suf="Байт";
	break;
	case 2:
	$suf="КБ";
	break;
	case 3:
	$suf="МБ";
	break;
	case 4:
	$suf="ГБ";
	break;
	case 5:
	$suf="ТБ";
	break;
}
$size.=$suf;
if(is_dir($namp)){
	$size="[Папка]";
}
$time=filemtime($namp);
$date=date("d.m.Y в H:i:s", $time);
$len=mb_strlen($namefile);
$len=20-$len;
if($len<0){
	$len=0;
}
mb_internal_encoding('UTF-8');
$sp=str_repeat("&nbsp;", $len);
$len=mb_strlen($size);
$len=10-$len;
if($len<0){
	$len=0;
}
$sp1=str_repeat("&nbsp;", $len);
$ar1[]=$namefile;
$ar2[]="<option class=\"$class\" value=\"$namp\">".trim($namefile).$sp.trim($size)." ".$sp1.trim($date)."</option>";
}}
array_multisort($ar1, $ar2);
unset($ar1);
$html="";
foreach($ar2 as $opt){
	$html.=$opt;
}
return $html;
}?>