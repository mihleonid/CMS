<PRE>
obnov
</PRE>
<FORM>
<form action="action.php" style="display: inline-block;" method="POST">
|SHeader|
<input type="hidden" name="url" value="$PARAM$url$">
<input type="hidden" name="version" value="$PARAM$version$">
<input type="hidden" name="tsel" value="jobnov">
<input type="hidden" name="page" value="about.php">
<input type="submit" value="Обновить">
</form>
</FORM>
<ACTION>
<?php
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
?>
</ACTION>