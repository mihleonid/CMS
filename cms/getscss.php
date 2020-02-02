<?php
include_once("cmsinclude.php");
use \LCMS\Core\GUI\Web;
use \LCMS\Core\Security\AntiXSS;
use \LCMS\Core\Patterns\Pattern;
Web::headerCache();
AntiXSS::H();
Web::headerEncode('text/css');
$css=Pattern::get($_GET['css']);
if(is_array($css)){
	$css=$css['css'];
	echo($css);
}else{
	\LCMS\Core\Security\ELog::hacker();
}
?>