<PRE>
status
</PRE>
<FORM>
<form action="action.php" method="POST" style="width: 100%;">
|Header|
<input type="hidden" name="stat" value="$PARAM$keym$">
<input type="submit" style="width: 100%;" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Pravs::delete($_POST['stat']);
?>
</ACTION>