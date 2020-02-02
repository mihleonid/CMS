<PRE>
part
</PRE>
<HEADER>
Деинсталлировать пакет частей
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя пакета:$PARAM$htmm$<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::uninstallPacket($_POST['part']);
?>
</ACTION>