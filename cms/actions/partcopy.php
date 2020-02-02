<PRE>
part
</PRE>
<HEADER>
Копирование/перемещение
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<div><input type="checkbox" name="move" value="ok" style="vertical-align: middle;"><span>Переместить</span></div>
Часть:
<select name="s" required>$PARAM$htmcpy$</select><br>
Новое имя:<input type="text" name="news" placeholder="Название части" pattern="[a-zA-Z_1-90]+" required><br>
<input type="submit" value="Выполнить операцию">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::copy($_POST['s'], $_POST['news'], ((isset($_POST['move']))?(true):(false)));
?>
</ACTION>