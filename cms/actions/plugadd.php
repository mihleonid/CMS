<CLEVER />
<PRE>
plug
</PRE>
<HEADER>Создать плагин</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя плагина: <input type="text" name="name" id="name" style="width: 100px;" placeholder="Название" pattern="[a-zA-Z1-90]+" required>
<br>
<div style="display: inline-block;">
Установка:
<br>
<textarea name="ins"></textarea>
</div>
<div style="display: inline-block;">
Деинсталляция (полная):
<br>
<textarea name="un"></textarea>
</div>
<div style="display: inline-block;">
Деинсталляция (частичная):
<br>
<textarea name="unp"></textarea>
</div>
<br>
<input type="submit" value="Создать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\Plugins::create($_POST['name'], $_POST['ins'], $_POST['un'], $_POST['unp']);
?>
</ACTION>