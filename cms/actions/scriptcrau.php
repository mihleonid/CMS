<PRE>
script
</PRE>
<HEADER>
Создать скриптовой модуль
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Модуль:
<input type="text" name="name" style="width: 100px;" pattern="[a-zA-Z_1-90]+">
<p>
<div style="display: inline-block;">
<big>JavaScript</big>
<br>
<textarea name="text[js]"></textarea>
</div>
<div style="display: inline-block;">
<big>PHP</big>
<br>
<textarea name="text[php]"></textarea>
</div>
<div style="display: inline-block;">
<big>CSS</big>
<br>
<textarea name="text[css]"></textarea>
</div>
</p>
Действие при одинаковом имени:
<br>
<span style="font-size: LARGER;">
<input type="radio" name="zam" value="true" checked>Заменить
<br>
<input type="radio" name="zam" value="false">Переименовать
</span>
<br>
<input type="submit" value="Создать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\ScriptModules::create($_POST['text'], $_POST['name'], $_POST['zam'], $auf[0]);
?>
</ACTION>