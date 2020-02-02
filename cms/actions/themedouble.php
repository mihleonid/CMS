<PRE>
deltthemes
</PRE>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="submit" value="Удалить дубли">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::deleteThemeDoubles();
?>
</ACTION>