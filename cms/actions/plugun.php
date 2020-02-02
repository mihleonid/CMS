<PRE>
plug
</PRE>
<HEADER>Деинсталлировать плагин</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя модуля:<select name="pack" required>$PARAM$htm$</select>
<br>
<input type="checkbox" name="check" value="ON">Оставить данные
<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\Plugins::uninstall($_POST['pack'], isset($_POST['check']));
?>
</ACTION>