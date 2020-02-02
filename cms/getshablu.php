<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
if($GLOBALS['AUTH']!==false){
	if($s=="<default>"){
		$s= \LCMS\Core\Patterns\Pattern::getDefault();
	}
	if($s!="<noPattern>"){
		$_path=$_SERVER['DOCUMENT_ROOT']."/cms/s/$s.seria";
		$_path=file_get_contents($_path);
		$_path=unserialize($_path);
		$_path=smartHTML($_path['patt']);
		$_path=str_replace("<!--STYLE-->", "<link rel=\"stylesheet\" href=\"/cms/getscss.php?css=$s\" type=\"text/css\">", $_path);
		$_path=str_replace("<!--STYLES-->", "<link rel=\"stylesheet\" href=\"/cms/script.php?type=css\" type=\"text/css\">", $_path);
	}else{
		$_path="<!doctype html><html><head></head><body><section><!--TEXT--></section><footer></body></html>";
	}
	$pattern=$_path;
}
//not_PROTECTED
/*$patT=1;
if(!isset($s)){
	$s=$_GET['s'];
	$NOECHOPATTERN=false;
}else{
	$NOECHOPATTERN=true;
}
$__pattern="";
$NO_ECHO=true;
include_once $_SERVER['DOCUMENT_ROOT']."/cms/auf.php";
if($t!==false){
include_once $_SERVER['DOCUMENT_ROOT']."/cms/getshabl.php";
if($NOECHOPATTERN){
	$__pattern.="<!--TEXT-->";
}else{
	echo("<!--TEXT-->");
}
if($NOECHOPATTERN){
	$__pattern.=$__FOOTER;
}else{
	echo($__FOOTER);
}
}
$pattern=$__pattern;
*/?>