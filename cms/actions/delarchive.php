<PRE>
archive
</PRE>
<HEADER>
---delete-archive---
</HEADER>
<FORM>
<form action="action.php" method="POST" autocomplete="off">
|SHeader|
<input type="hidden" name="tsel" value="delarchive">
<input type="hidden" name="page" value="/cms/archive.php?<?php echo(((isset($_SERVER['argv'][0]))?($_SERVER['argv'][0]):(""))); ?>">
---name---:
<select name="pack" required>
<?php
$dir=dir("../archives/");
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-4);
		echo("<option value=\"$entry\">$entry</option>");//fixed last echo
	}
}
?>
</select>
<br>
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Archiver\Archiver::delete($_POST['pack']);
?>
</ACTION>