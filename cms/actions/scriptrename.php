<PRE>
script
</PRE>
<HEADER>
Переименовать скриптовой модуль
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<div style="width: fit-content;">
Модуль:$PARAM$htm$
<br>
<input style="width: 100%;" type="text" name="newname" placeholder="Новое имя">
</div>
<input type="submit" value="Переименовать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\ScriptModules::rename($_POST['pack'], $_POST['newname']);
?>
</ACTION>