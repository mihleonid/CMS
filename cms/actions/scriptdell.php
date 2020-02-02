<PRE>
script
</PRE>
<HEADER>
Удалить скриптовой модуль
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Модуль:
$PARAM$htm$
<br>
Виды скриптов:
<br>
<select name="scripts[]" size="3" multiple>
<option value="js">JavaScript</option>
<option value="php">PHP</option>
<option value="css">CSS</option>
</select>
<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\ScriptModules::scriptDelete($_POST['scripts'], $_POST['pack']);
?>
</ACTION>