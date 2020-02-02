<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
if(isset($GLOBALS['AUTH'][0])){
	\LCMS\Core\Security\AntiXSS::H();
	\LCMS\Core\Security\AntiXSS::R();
	$_GET['theme']=substr($_GET['theme'], 17, -2);
	$_GET['theme']=preg_replace("@[^a-zA-Z1-90_\-\.]@", '', $_GET['theme']);
	$_GET['theme']=preg_replace("@\.\.+@", '', $_GET['theme']);
	$_GET['theme']=explode(".", $_GET['theme']);
	$_GET['theme']=$_GET['theme'][0].".".$_GET['theme'][1];
	header("Content-type: application/octet-stream;");
	header('Content-Disposition: attachment;filename="'.$_GET['theme'].'"');
	readfile("themes/".$_GET['theme']);
}
?>