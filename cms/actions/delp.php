<PRE>
part
</PRE>
<HEADER>
Удалить часть
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Часть:
<br>
$PARAM$htm$
<br><input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::delete($_POST['part']);
?>
</ACTION>