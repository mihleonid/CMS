<PRE>
packpatt
</PRE>
<HEADER>
Копирование/перемещение пакета шаблонов
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<div><input type="checkbox" name="move" value="ok" style="vertical-align: middle;"><span>Переместить</span></div>
Пакет шаблонов:$PARAM$htm$
<br>
Новое имя:<input type="text" name="news" placeholder="Название пакета" pattern="[a-zA-Z_1-90]+" required><br>
<input type="submit" value="Выполнить операцию">
</form>
</FORM>
<?php
return \LCMS\Core\Patterns\Pattern::copyPastePacket($_POST['part'], $_POST['news'], ((isset($_POST['move']))?(true):(false)));
?>