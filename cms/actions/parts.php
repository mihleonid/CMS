<PRE>
part
</PRE>
<HEADER>
Изменить части шаблонов
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
$PARAM$htm$
<input type="hidden" name="parts" value="$PARAM$partes$">
<input type="submit" value="Изменить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::setAll();
?>
</ACTION>