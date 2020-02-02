<?php
include "login.php";
ini_set("memory_limit", "999999M");
$_TYPE=trim($_GET['type']);
$_PATH=trim($_GET['path']);
$_INFO=pathinfo($_PATH);
$_CONTENTS=file_get_contents($_PATH);
$_HEAD=file_get_contents("parts/head.html");
include "parts/$_TYPE.php";
?>