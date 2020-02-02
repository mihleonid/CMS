<PRE>
plug
</PRE>
<HEADER>Установить плагин</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Плагин:$PARAM$htm$<br>
<input type="submit" value="Установить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\Plugins::install($_POST['pack']);
?>
</ACTION>