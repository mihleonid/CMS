<PRE>
unarchive
</PRE>
<HEADER>
---unarchive-and-apply---
</HEADER>
<FORM>
|F|
---name---:
<select name="pack" required>
<?php
$htm="";
$dir=dir("../archives/");
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-4);
		$htm.="<option value=\"$entry\">$entry</option>";
	}
}
echo($htm);?>
</select>
<div>
---action-if-name-exists---:
<div>
<input type="radio" name="replace" value="up" checked>---replace---
<input type="radio" name="replace" value="down">---skip---
</div>
</div>
<input type="submit" value="---unarchive---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Archiver\Archiver::unarchive($_POST['pack'], isset($_POST['replace'])and($_POST['replace']=='up'));
?>
</ACTION>