<PRE>
pattedit.packpatt
</PRE>
<HEADER>
Удалить изменения пакета шаблонов
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя пакета:$PARAM$htmm$<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::uninstallPattern($_POST['part'], \LCMS\Core\Users\Stats::can($auf[2], "allpatt"));
?>
</ACTION>