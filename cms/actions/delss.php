<PRE>
packpatt
</PRE>
<HEADER>
Удалить инсталлятор пакета шаблонов
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя инсталлятора:$PARAM$htm$<br>
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::deletePack($_POST['part']);
?>
</ACTION>