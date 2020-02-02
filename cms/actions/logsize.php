<PRE>
error
</PRE>
<HEADER>
---elog-max-size---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<?php
foreach(unserialize(+++elog-statuses+++) as $l=>$la){
	echo('<input type="radio" name="mode" value="'.$l.'"'.((&PARAM&all&==$l)?(" checked"):("")).'>'.$la.'<br>');
}
?>
<input type="submit" value="---apply---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Security\Elog::setSize($_POST['mode']);
?>
</ACTION>