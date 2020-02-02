<PRE>
obnov
</PRE>
<FORM>
<?php
use \LCMS\Core\Enviroment\CMSEnv;
use \LCMS\Core\Enviroment\Locale;
$file=CMSEnv::getObnovPath().Locale::current();
$vers=CMSEnv::getVersion();
if(@file($file)){
	$iter=file($file);
	$was=false;
	$url=$iter[0];
	$url=trim($url);
	unset($iter[0]);
	foreach($iter as $er){
		$line=explode("|", $er);
		if(version_compare($vers, $line[0], '<')){
			$line[1]=trim($line[1]);
			$was=true;
			$ops=$line[2];
			break;
		}
	}
	if($was){
		echo('<p style="margin-bottom: 0;"><b>Есть обновление!</b></p><form action="action.php" method="POST">');
		if($line[1]=="new"){
			echo('<p style="margin-bottom: 0;">Обновление настолько большое, что лучше создать резервную копию cms. Желаете сделать это?<br><input type="checkbox" name="per" value="ON">Да</p>');
		}
		echo("$ops<br>");
?>
|Header|
<?php
	echo('<input type="hidden" name="type" value="'.$line[1].'"><input type="hidden" name="url" value="'.$url.'"><input type="hidden" name="version" value="'.$line[0].'"><input type="submit" value="Обновить"></form>');
	}else{
		echo('<big style="color: green;"><b>Вы используете последнюю версию CMS Leonid.</b></big>');
	}
}else{
	echo('<big style=\"color: red;\"><b>Нет подключения к базе данных обновлений.</b></big>');
}
?>
</FORM>
<ACTION>
<?php
if(!isset($_POST['per'])){
	$_POST['per']="OFF";
}
if($_POST['per']!="ON"){
	$_POST['type']="update"; 
}
if($_POST['type']=="update"){
	if(@file_get_contents($_POST['url'].$_POST['version'])){
		$text=file_get_contents($_POST['url'].$_POST['version']);
		$tte=unserialize($text);
		$GLOBALS['DATA']=$tte[0];
		$res=eval($tte[1]);
		if(($res==null)or($res===false)or($res===true)or(!($res->getOK()))){
			return $res;
		}else{
			\LCMS\Core\Enviroment\Loc::set("version", $_POST['version']);
			return $res;
		}
	}else{
		return new \LCMS\Core\Actions\Result("Нет файла обновлений");
	}
}else{
	$_POST['page']="/cms/archive.php?obnovlenie=ON&url=".urlencode($_POST['url'])."&version=".urlencode($_POST['version']);
}
?>
</ACTION>