<PRE>
pattedit
</PRE>
<HEADER>
Копирование/перемещение
</HEADER>
<FORM>
<form action="action.php" method="POST">
|HEADER|
<div><input type="checkbox" name="move" value="ok" style="vertical-align: middle;"><span>Переместить</span></div>
Шаблон:<?php
$string= \LCMS\Core\Patterns\Pattern::getAll();
echo($string[1]);
?>
<br>
Новое имя:<input type="text" name="news" placeholder="Название шаблона" pattern="[a-zA-Z_1-90]+" required><br>
<input type="submit" value="Выполнить операцию">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::copyPaste($_POST['s'], $_POST['news'], ((isset($_POST['move']))?(true):(false)), \LCMS\Core\Users\Stats::can($auf[2], "allpatt"));
?>
</ACTION>