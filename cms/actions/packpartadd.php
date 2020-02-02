<PRE>
packpartadd
</PRE>
<HEADER>
Установить пакет частей
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя пакета:$PARAM$htm$<br>
Действие при одинаковом имени части:<br>
<input type="radio" name="apass" value="1" checked>Заменить<br>
<input type="radio" name="apass" value="2">Переименовать
<br>
<input type="submit" value="Добавить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::installPacket($_POST['part'], ($_POST['apass']=="2")?(false):(true));
?>
</ACTION>