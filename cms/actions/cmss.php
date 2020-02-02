<CLEVER />
<PRE>
cmspatt
</PRE>
<HEADER>
---set-cms-pattern---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
---pattern---:<?php
$string=\LCMS\Core\Patterns\Pattern::getAll();
echo($string[1]);
?>
<br>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::setCMS($_POST['s']);
?>
</ACTION>