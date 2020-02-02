<PRE>
themepack
</PRE>
<HEADER>
Запаковать темы
</HEADER>
<FORM>
<form action="action.php" method="POST" enctype="multipart/form-data">
|Header|
<input type="text" name="name" placeholder="Имя пакета" pattern="[1-90a-zA-Z_-]+" required>
<br>
<select name="themes[]" size="<?php echo min($PARAM$i$, 7);?>" multiple required>
$PARAM$htmm$
</select>
<br>
<input type="checkbox" name="delis" value="on">Удалить исходные темы.
<br>
Действие при одинаковом имени:<br>
<input type="radio" name="zamena" value="true" checked>---replace---<br>
<input type="radio" name="zamena" value="false">Переименовать
<br>
<input type="submit" value="Запаковать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::packThemes($_POST['name'], $_POST['themes'], $_POST['zamena']);
?>
</ACTION>