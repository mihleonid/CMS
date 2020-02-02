<PRE>
editus
</PRE>
<FORM>
<form autocomplete="off" action="action.php" method="POST" style="width: max-content;">
|Header|
<input type="hidden" name="stat" value="$PARAM$keym$">
<input type="text" placeholder="---title---" name="ops" style="width: 200px;" value="$PARAM$linem$" pattern="[a-zA-Z_\-=\+\*1-90а-яА-Я ]+" required><input type="submit" value="---apply---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Stats\Stats::editText(trim($_POST['stat']), trim($_POST['ops']));
?>
</ACTION>