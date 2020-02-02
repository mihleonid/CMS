<?php
include_once($_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php");
use \LCMS\Core\Security\AntiXSS;
use \LCMS\Core\Security\Salt;
use \LCMS\Core\Security\Counter;
use \LCMS\Core\Security\Locker;
use \LCMS\Core\GUI\Web;
use \LCMS\Core\Enviroment\CMSEnv;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Actions\Result;
use \LCMS\Core\Actions\ALog;
AntiXSS::H();
AntiXSS::R();
Web::headerEncode();
if($GLOBALS['AUTH']==false){
	header("Location: http://".$_SERVER['HTTP_HOST']."/index.php");
	exit;
}
ALog::add("[secure methods]");
$obuffer=CMSEnv::getBuffering();
if($obuffer){
	ob_start();
}else{
	echo("<progress id=\"pr\" style=\"width: 70%;\"></progress>");
	flush();
}
if($GLOBALS['AUTH'][2]=="globaladmin"){
	Salt::SetA(!isset($_POST['salt']));
	Locker::SetA(!isset($_POST['locker']));
	Counter::SetA(!isset($_POST['counter']));
}
if($obuffer){
	ob_end_clean();
	header("Location: http://".$_SERVER['HTTP_HOST']."".$_POST['page']);
	exit;
}else{
	echo "<script>document.getElementById('pr').remove();</script>";
	echo("<p style=\"font-size: 24pt; font-family: monospace; color: #33ff33; text-align: center;\"><b>Успешно</b></p>");
	flush();
}
exit;
?>