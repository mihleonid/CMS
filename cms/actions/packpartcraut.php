<PRE>
part
</PRE>
<HEADER>
Создать пакет частей
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имена частей:<br>$PARAM$htmmul$<br>
Имя пакета:<input type="text" name="new" required><br>
Действие при одинаковом имени:<br><input type="radio" name="zamena" value="true" checked>Заменить<br><input type="radio" name="zamena" value="false">Переименовать<br>
<input type="submit" value="Создать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::createPacket($_POST['part'], $_POST['new'], (($_POST['zamena']=="true")?(true):(false)));
?>
</ACTION>