<PRE>
script
</PRE>
<HEADER>
Деинсталировать скриптовой модуль
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Скрипт:
<select name="script" id="script">
<option value="js">JavaScript</option>
<option value="php">PHP</option>
<option value="css">CSS</option>
</select>
<div id="js">
Имя модуля:$PARAM$js$
</div>
<div id="php" style="display: none;">
Имя модуля:$PARAM$php$
</div>
<div id="css" style="display: none;">
Имя модуля:$PARAM$css$
</div>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\ScriptModules::uninstall($_POST['namm'][trim($_POST['script'])], $_POST['script']);
?>
</ACTION>