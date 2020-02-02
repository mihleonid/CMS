<?php
include_once($_SERVER['DOCUMENT_ROOT']."/cms/fix.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cms/exception.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cms/core/include.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cms/mainmodules/include.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cms/file/include.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cms/ini.php");
\LCMS\Core\Enviroment\Timezone::date();
$GLOBALS['AUTH']= \LCMS\Core\Users\Users::auth();
if(($GLOBALS['AUTH']!=false)and isset($_COOKIE['sudo'])){
	if(isset($_GET['i'])){
		setcookie('sudo', '', 1);
	}else{
		if( \LCMS\Core\Users\Stats::can('users')){
			$sudo=explode('-', $_COOKIE['sudo']);
			for($i=0;$i<2;$i++){
				if(!isset($sudo[$i])){
					goto start;
				}
			}
			if(isset($sudo[3])){
				goto start;
			}
			$GLOBALS['AUTH']=$sudo;
			\LCMS\Core\Pages\Page::sudo();
		}
	}
}
start:;
?>