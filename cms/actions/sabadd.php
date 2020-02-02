<CLEVER />
<PRE>
createPattern
</PRE>
<HEADER>
Добавить шаблон
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Имя шаблона:<input type="text" name="part" placeholder="Название шаблона" pattern="[a-zA-Z_1-90]+" required><br>
<div>
<div>
<div style="display: inline-block;">
Содержимое шаблона:<br>
<textarea name="sod" required></textarea>
</div>
<div style="display: inline-block;">
Содержимое стилей:<br>
<textarea name="sodcss"></textarea>
</div>
</div>
<div>
<div style="display: inline-block;">
Содержимое таблицы стилей:<br>
<textarea name="sodcsstab"></textarea>
</div>
<div style="display: inline-block;">
Содержимое таблицы настроцки страниц:<br>
<textarea name="sodtab"></textarea>
</div>
</div>
</div>
<input type="checkbox" style="width: 18px; height: 18px; margin-top: 0px;" name="all" value="true"><span style="vertical-align: top;">Разрешить использование всем пользователям</span><br>
<input type="submit" value="Добавить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::create($_POST['part'], $_POST['sod'], $_POST['sodcss'], $_POST['sodcsstab'], $_POST['sodtab'], $_POST['all']);
?>
</ACTION>