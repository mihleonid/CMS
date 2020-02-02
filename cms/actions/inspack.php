<PRE>
packpatt
</PRE>
<HEADER>
Установить пакет шаблонов
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Пакет:
$PARAM$htm$
<br>
<input type="checkbox" style="width: 18px; height: 18px; margin-top: 0px;" name="all" value="true"><span style="vertical-align: top;">Разрешить использование всем пользователям</span>
<br>Действие при одинаковом имени:<br>
<input type="radio" name="zamena" value="true" checked>---replace---<br>
<input type="radio" name="zamena" value="false">Переименовать
<br>
<input type="submit" value="Установить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::installPacket($_POST['part'], (isset($_POST['all'])?($_POST['all']):("")), (($_POST['zamena']=="false")?(false):(true)));
?>
</ACTION>