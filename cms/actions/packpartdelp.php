<PRE>
packpartdelp
</PRE>
<HEADER>
Удалить пакет частей
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя пакета:$PARAM$htm$<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::deletePacket($_POST['part']);
?>
</ACTION>