<PRE>
exti
</PRE>
<HEADER>
База данных расширений (Типы)
</HEADER>
<FORM>
|F|
<table>
<tr>
<th>---extension---</th>
<th>---type---</th>
</tr>
<?php
$fi=file("file/codec/extensioni.db");
foreach($fi as $ff){
	$echo["text"]="";
	$echo["pic"]="";
	$echo["vid"]="";
	$echo["audio"]="";
	$ff=trim($ff);
	$ff=explode("|", $ff);
	$echo[$ff[1]]="selected";
	echo("<tr><td>".$ff[0]."</td><td><select name=\"ext[".$ff[0]."]\"><option value=\"text\" ".$echo["text"].">Текст</option><option value=\"pic\" ".$echo["pic"].">Изображение</option><option value=\"vid\" ".$echo["vid"].">Видео</option><option value=\"audio\" ".$echo["audio"].">Аудио</option><option value=\"del\">Удалить</option></select></td></tr>");
}
?>
</table>
.<input type="text" name="exten" placeholder="---extension---" style="width: 100px;">
<select name="exti">
<option value="text">Текст</option>
<option value="pic">Изображение</option>
<option value="vid">Видео</option>
<option value="audio">Аудио</option>
</select>
<input type="submit" name="sub" value="---new---">
<br>
<br>
<input type="submit" name="sub" value="---new---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Modules\File\Set::universalExt("i", $_POST['sub'], $_POST['ext'], $_POST['exten'], $_POST['exti']);
?>
</ACTION>