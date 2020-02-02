<PRE>
packpatt
</PRE>
<HEADER>
Создать пакет шаблонов
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="text" name="nname" value="" placeholder="Имя пакета" pattern="[a-zA-Z_1-90]+" required>
<br>
Шаблоны:
<br>
$PARAM$O$
<br>
<br>Действие при одинаковом имени:<br>
<input type="radio" name="zamena" value="true" checked>Заменить<br>
<input type="radio" name="zamena" value="false" required>Переименовать
<br>
<input type="submit" value="Создать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::newPacket($_POST['nname'], $_POST['s'], (($_POST['zamena']=="false")?(false):(true)));
?>
</ACTION>