<PRE>
delthemes
</PRE>
<HEADER>
Массово удалить темы
</HEADER>
<FORM>
<form action="action.php" method="POST" enctype="multipart/form-data">
|Header|
Имя тем:
<br>
<select name="themes[]" size="<?php echo min($PARAM$i$, 7);?>" multiple required>
$PARAM$htmm$
</select>
<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::deleteThemes($_POST['themes']);
?>
</ACTION>