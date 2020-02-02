<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cms.php";
CMS::antiXSS_H();
CMS::antiXSS_R();
CMS::headerEncode();
include_once ($_SERVER['DOCUMENT_ROOT']."/cms/tdbapi.php");
include_once ($_SERVER['DOCUMENT_ROOT']."/cms/creater.php");
if(!isset($_COOKIE['admin'])){
	$t="none";
}else{
	$admins=new D_BASE();
	Creater($admins);
	$c=explode("-", $_COOKIE['admin']);
	$t=false;
	$login=trim($c[0]);
	$pass=trim($c[1]);
	if($admins->exists_name($login)){
		$user=$admins->get_line($login);
		if(trim($pass)==trim($user[0])){
			$t[1]=$login;
			$t[2]=$pass;
			$t[3]=$user[1];
		}
	}
}
if($t=="none"){
	$t=false;
}
if($t==false){
	die("<h1 style=\"color: red; text-align: center;\">Error of security!<img src=\"sec.png\"/></h1><a href=\"/cms/admin.php\" style=\"text-align: center; display: block;\">Back</a>");
}
if($t[3]!="globaladmin"){
	die("<h1 style=\"color: red; text-align: center;\">Error of security!<img src=\"sec.png\"/></h1><a href=\"/cms/admin.php\" style=\"text-align: center; display: block;\">Back</a>");
}
?>