<?php
include_once("cmsinclude.php");
use \LCMS\Core\Security\AntiXSS;
use \LCMS\Core\Users\Users;
AntiXSS::H();
AntiXSS::R();
$login=trim($_POST['alogin']);
$pass=md5($_POST['apass']);
Users::login($login, $pass);
header("Location: http://".$_SERVER['HTTP_HOST']."/cms/admin.php");
exit;
?>