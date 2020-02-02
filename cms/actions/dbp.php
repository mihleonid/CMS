<PRE>
extd
</PRE>
<HEADER>
База данных расширений (Открытие принудительно)
</HEADER>
<FORM>
|F|
<table>
<tr>
<th>---extension---</th>
<th>Способ</th>
</tr>
<?php
$fi=file("file/codec/extensiond.db");
foreach($fi as $ff){
	$echo["0"]="";
	$echo["1"]="";
	$echo["2"]="";
	$echo["3"]="";
	$ff=trim($ff);
	$ff=explode("|", $ff);
	$echo[$ff[1]]="selected";
	echo("<tr><td>".$ff[0]."</td><td><select name=\"ext[".$ff[0]."]\"><option value=\"0\" ".$echo["0"].">Редактор текста</option><option value=\"1\" ".$echo["1"].">Редактор изображения</option><option value=\"2\" ".$echo["2"].">Браузер</option><option value=\"3\" ".$echo["3"].">Просмотр</option><option value=\"del\">Удалить</option></select></td></tr>");
}
?>
</table>
.<input type="text" name="exten" placeholder="---extension---" style="width: 100px;">
<select name="exti">
<option value="0">Редактор текста</option>
<option value="1">Редактор изображения</option>
<option value="2">Браузер</option>
<option value="3">Просмотр</option>
</select>
<input type="submit" name="sub" value="---new---">
<br>
<br>
<input type="submit" name="sub" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Modules\File\Set::universalExt("d", $_POST['sub'], $_POST['ext'], $_POST['exten'], $_POST['exti']);
?>
</ACTION>