<PRE>
themedepack
</PRE>
<HEADER>
Установить пакет тем
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя пакета:
<br>$PARAM$htm$<br>
<input type="submit" value="Установить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::depackTheme($_POST['part']);
?>
</ACTION>