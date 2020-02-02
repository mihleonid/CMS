<PRE>
mime
</PRE>
<HEADER>
База данных расширений (MIME)
</HEADER>
<FORM>
<p>По умолчанию: <code><?php echo(ini_get("default_mimetype"));?></code><small>(Можно изменить на странице конфигурации: <code>ini default_mimetype=*/*</code>)</small></p>
<p>Для удаления нанишите в поле MIME-типа набор символов <code>&lt;del&gt;</code></p>
|F|
<table>
<tr>
<th>---extension---</th>
<th>MIME-Тип</th>
</tr>
<?php
$fi=file("file/codec/extension.db");
$mimesa=array();
foreach($fi as $ff){
	$ff=trim($ff);
	$ff=explode("|", $ff);
	$mimesa[]="<option value=\"".$ff[1]."\"></option>";
	echo("<tr><td>".$ff[0]."</td><td><input type=\"text\" name=\"ext[".$ff[0]."]\" value=\"".$ff[1]."\"placeholder=\"MIME\" list=\"mime\"></td></tr>");
}
$mimesa=array_unique($mimesa);
$mimes=implode("", $mimesa);
?>
</table>
.<input type="text" name="exten" placeholder="---extension---" style="width: 100px;">
<input type="text" name="exti" placeholder="MIME" list="mimea">
<input type="submit" name="sub" value="---new---">
<br>
<datalist id="mime">
<option value="<del>"></option>
<?php echo $mimes;?>
</datalist>
<datalist id="mimea">
<?php echo $mimes;?>
</datalist>
<br>
<input type="submit" name="sub" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Modules\File\Set::universalExt("", $_POST['sub'], $_POST['ext'], $_POST['exten'], $_POST['exti']);
?>
</ACTION>