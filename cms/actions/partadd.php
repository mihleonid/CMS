<PRE>
partadd
</PRE>
<HEADER>
Добавить часть
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя части:<input type="text" name="part"><br>
Содержимое:<br>
<textarea name="sod"></textarea><br>
<input type="submit" value="Добавить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::add($_POST['part'], $_POST['sod']);
?>
</ACTION>