<?php
$version=$_GET['version'];
$version=str_replace('.', '', $version);
if(!file_exists('versions/'.$version.'.ver')){
	echo(serialize(array(0=>'', 1=>'$_POST["error"]="Версии '.$version[3].'.'.$version[2].'.'.$version[1].'.'.$version[0].' несуществует.";')));
}else{
	readfile('versions/'.$version.'.ver');
}
?>