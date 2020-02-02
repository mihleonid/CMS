<PRE>
pattedit
</PRE>
<HEADER>
Удалить шаблон
</HEADER>
<FORM>
<form action="action.php" method="POST">
|SHeader|
<input type="hidden" name="tsel" value="|ACTNAME|">
<input type="hidden" name="page" value="shabl.php">
---pattern---:<?php
$string=\LCMS\Core\Patterns\Pattern::getAll();
echo($string[1]);
?>
<br>
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::delete($_POST['s'], \LCMS\Core\Users\Stats::can($GLOBALS['AUTH'][2], "allpatt"));
?>
</ACTION>