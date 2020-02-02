<PRE>
packthemedelete
</PRE>
<HEADER>
Удалить пакет тем
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя пакета:
<br>$PARAM$htm$<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::deleteThemePack($_POST['part']);
?>
</ACTION>