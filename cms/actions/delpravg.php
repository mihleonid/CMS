<PRE>
status
</PRE>
<FORM>
<form action="action.php" method="POST" style="width: max-content;">
|Header|
<input type="hidden" name="stat" value="$PARAM$keym$">
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Pravs::deleteGroup($_POST['stat']);
?>
</ACTION>