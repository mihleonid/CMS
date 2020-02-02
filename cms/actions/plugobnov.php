<CLEVER />
<PRE>
plug
</PRE>
<HEADER>Обновить плагин</HEADER>
<FORM>
<form action="action.php" method="POST" enctype="multipart/form-data">
|Header|
Файл обновления<br><input type="file" name="new"><br><input type="submit" value="Обновить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\Plugins::obnov(file_get_contents($_FILES['new']['tmp_name']));
?>
</ACTION>