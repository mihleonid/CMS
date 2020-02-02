<PRE>
plug
</PRE>
<HEADER>Удалить плагин</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Плагин:$PARAM$htm$<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\Plugins::delete($_POST['pack']);
?>
</ACTION>