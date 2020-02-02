<DOWNLOAD />
<PRE>
down
</PRE>
<HEADER>
---download---
</HEADER>
<FORM>
<?php
function dirf($directory){
	$dir=dir($directory);
	$html="";
	$partes=array();
	while(false!==($entry=$dir->read())){
		if((($entry!=".")and($entry!=".."))and(!is_dir($directory.$entry))){
			$partes[]=$entry;
			$html.="<option value=\"$entry\">$entry</option>";
		}
	}
	return array($partes, $html);
}
?>
<form action="action.php" method="POST"><?php /* enctype="multipart/form-data"*/?>
|Header|
Что это:
<br>
<select name="type" id="type">
<option value="moduls/script/" selected>Скриптовой модуль</option>
<option value="moduls/plugins/">Плагин</option>
<option value="moduls/patpack/">Пакет шаблонов</option>
<option value="s/">Шаблон</option>
<option value="moduls/themes/">Пакет тем</option>
<option value="../archives/">Архив</option>
<option value="moduls/parts/">Пакет частей</option>
<option value="pic/users/upload/">Прочий подгруженный файл</option>
<option value="pic/users/">Прочий файл (от плагина)</option>
<option value="pic/">Прочий файл</option>
</select>
<br>
<select name="moduls/script/" id="moduls/script/" required>
<?php
$dirf=dirf("moduls/script/");
echo($dirf[1]);?>
</select>
<select name="moduls/plugins/" style="display: none;" id="moduls/plugins/">
<?php
$dirf=dirf("moduls/plugins/");
echo($dirf[1]);?>
</select>
<select name="moduls/patpack/" style="display: none;" id="moduls/patpack/">
<?php
$dirf=dirf("moduls/patpack/");
echo($dirf[1]);?>
</select>
<select name="s/" style="display: none;" id="s/">
<?php
$dirf=dirf("s/");
echo($dirf[1]);?>
</select>
<select name="moduls/themes/" style="display: none;" id="moduls/themes/">
<?php
$dirf=dirf("moduls/themes/");
echo($dirf[1]);?>
</select>
<select name="../archives/" style="display: none;" id="../archives/">
<?php
$dirf=dirf("../archives/");
echo($dirf[1]);?>
</select>
<select name="moduls/parts/" style="display: none;" id="moduls/parts/">
<?php
$dirf=dirf("moduls/parts/");
echo($dirf[1]);?>
</select>
<select name="pic/users/upload/" style="display: none;" id="pic/users/upload/">
<?php
$dirf=dirf("pic/users/upload/");
echo($dirf[1]);?>
</select>
<select name="pic/users/" style="display: none;" id="pic/users/">
<?php
$dirf=dirf("pic/users/");
echo($dirf[1]);?>
</select>
<select name="pic/" style="display: none;" id="pic/">
<?php
$dirf=dirf("pic/");
echo($dirf[1]);?>
</select>
<input type="submit" value="---delete---">
</form>
<br>
<!--<h3>Скачать из <i>файлтекста</i></h3>
<form action="downloadt.php" method="POST" enctype="multipart/form-data">
<input type="hidden" name="tsel" value="download">
<input type="hidden" name="page" value="download.php">
Файлтекст:
<br>
<textarea style="width: 500px; height: 400px;"></textarea>
<br>
<input type="submit" value="Скачать">
</form>-->
<script>
document.getElementById("type").addEventListener("input",function (evt){
	document.getElementById("pic/users/upload/").style.display="none";
	document.getElementById("../archives/").style.display="none";
	document.getElementById("moduls/parts/").style.display="none";
	document.getElementById("s/").style.display="none";
	document.getElementById("moduls/themes/").style.display="none";
	document.getElementById("moduls/patpack/").style.display="none";
	document.getElementById("moduls/plugins/").style.display="none";
	document.getElementById("moduls/script/").style.display="none";
	document.getElementById("pic/users/").style.display="none";
	document.getElementById("pic/").style.display="none";
	document.getElementById("pic/users/upload/").removeAttribute("required");
	document.getElementById("../archives/").removeAttribute("required");
	document.getElementById("moduls/parts/").removeAttribute("required");
	document.getElementById("s/").removeAttribute("required");
	document.getElementById("moduls/themes/").removeAttribute("required");
	document.getElementById("moduls/patpack/").removeAttribute("required");
	document.getElementById("moduls/plugins/").removeAttribute("required");
	document.getElementById("moduls/script/").removeAttribute("required");
	document.getElementById("pic/users/").removeAttribute("required");
	document.getElementById("pic/").removeAttribute("required");
	document.getElementById(document.getElementById("type").value).style.display="";
	document.getElementById(document.getElementById("type").value).setAttribute("required", "");
} , false);
</script>

</FORM>
<ACTION>
<?php
header("Content-type: application/octet-stream;");
header('Content-Disposition: attachment;filename="'.$_POST[str_replace('.', '_', $_POST['type'])].'"');
readfile($_POST['type'].$_POST[str_replace('.', '_', $_POST['type'])]);
?>
</ACTION>