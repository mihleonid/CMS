<?php
include_once("cms.php");
CMS::antiXSS_H();
CMS::antiXSS_R();
if($_GET['sub']=="code"){
	setcookie("admin", "", 1);
}
header("Location: http://".$_SERVER['HTTP_HOST']."/cms/admin.php");
exit;
?>