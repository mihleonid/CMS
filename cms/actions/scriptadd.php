<PRE>
script
</PRE>
<HEADER>
Установить скриптовой модуль
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Модуль:$PARAM$htm$
<br>
Виды скриптов:
<br>
<select name="scripts[]" size="3" multiple>
<option value="js" selected>JavaScript</option>
<option value="php" selected>PHP</option>
<option value="css" selected>CSS</option>
</select>
<br>
<input type="submit" value="Установить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\ScriptModules::install($_POST['scripts'], $_POST['pack']);
?>
</ACTION>