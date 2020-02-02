<CACHE />
<CLEVER />
<PRE>
zchange
</PRE>
<HEADER>
---salt---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Степень безопасности: <input type="number" name="val" min="1" max="1000" value="$PARAM$new$" required>
<br>
<input type="submit" value="---change---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Security\Salt::change($_POST['val']);
?>
</ACTION>