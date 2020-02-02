<PRE>
defpatt
</PRE>
<HEADER>
Настроить шаблон по умолчанию (должен быть доступен всем)
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
---pattern---:<?php
$string= \LCMS\Core\Patterns\Pattern::getAll(false);
echo($string[1]);
?>
<br>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::setDefault($_POST['s']);
?>
</ACTION>