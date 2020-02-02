<?php
include_once("cmsinclude.php");
use \LCMS\Core\GUI\Web;
if(!isset($patT)){
if(isset($_SCRIPT_TYPE_FOR_INClude_in_GETSHABL___PHP)){
	$type="php";
}else{
	$type=trim($_GET['type']);
	if($type=="php"){
		die("Varibles allocation warning");
	}
}
if(($type=="js")or($type=="css")or($type=="php")){
	$file=file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/scripts/$type.seria");
	$text=unserialize($file);
	if(($type=="js")or($type=="css")){
		Web::headerEncode($type);
		Web::headerCache();
		echo(implode("\n", $text));
	}else{
		foreach($text as $scr){
			try{
				@eval($scr);
			}catch(Exception $e){}
		}
	}
}
}
?>