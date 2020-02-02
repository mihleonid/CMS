<?php
header("Content-type: text/html");
include "../../../ini.php";
include "../../../tdbapi.php";
include "../../../creater.php";
if(!isset($_COOKIE['admin'])){
	echo("<meta http-equiv=\"Refresh\" content=\"0; url=/index.php\">");
	exit;
}
if(!preg_match("@.+-[a-zA-Z1-90]@u", $_COOKIE['admin'])){
	echo("<meta http-equiv=\"Refresh\" content=\"0; url=/index.php\">");
	exit;
}
//if(trim($_POST['ZZZ_OF'])!=trim(file_get_contents("location/z.loc"))){
//	die("<p style=\"font-size: 24pt; color: #ff3333; text-align: center;\"><b>Error of security!</b><img src=\"file/sec.png\"></img></p><p style=\"font-size: 14pt; text-align: center;\"><a href=\"/cms/".$_POST['page']."\">Back</a></p>");
//}
$admins=new D_BASE();
Creater($admins);
$c=explode("-", $_COOKIE['admin']);
$auf=false;
$login=trim($c[0]);
$pass=trim($c[1]);
if($admins->exists_name($login)){
	$user=$admins->get_line($login);
	if(trim($pass)==trim($user[0])){
		$auf[0]=$login;
		$auf[1]=$pass;
		$auf[2]=$user[1];
	}
}
if($auf==false){
	echo("<meta http-equiv=\"Refresh\" content=\"0; url=/index.php\">");
	exit;
}
readfile($_GET['path']);
?>