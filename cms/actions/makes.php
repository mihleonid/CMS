<PRE>
pattedit
</PRE>
<HEADER>
Изменить шаблон <code>$PARAM$s$</code>
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="hidden" name="s" value="$PARAM$s$">
<?php
$Patt=&PARAM&get&;
?>
<div<?php echo(((\LCMS\Core\Users\Users::isClever())?(""):(' style="dispplay: none;"'))); ?>>
Текст шаблона:<br>
<textarea name="sod" style="width: calc(100% - 100px); height: 450px;">
<?php echo( \LCMS\Core\htmlchars($Patt['patt']));?>
</textarea>
<br><br>
Текст стиля:<br>
<textarea name="sodcss" style="width: calc(100% - 100px); height: 450px;">
<?php echo( \LCMS\Core\htmlchars($Patt['css']));?>
</textarea>
<br><br>
Текст таблицы изменений стиля:<br>
<textarea name="sodcsstab" style="width: calc(100% - 100px); height: 450px;">
<?php echo( \LCMS\Core\htmlchars($Patt['csstab']));?>
</textarea><br>
Текст таблицы настройки страниц:<br>
<textarea name="sodtab" style="width: calc(100% - 100px); height: 450px;">
<?php echo( \LCMS\Core\htmlchars($Patt['patttab']));?>
</textarea><br>
</div>
<input type="checkbox" style="width: 18px; height: 18px; margin-top: 0px;" name="all" value="true"$PARAM$ch$><span style="vertical-align: top;">Разрешить использование всем пользователям</span><br>
<input type="submit" value="Изменить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Pattern::set($_POST['s'], (isset($_POST['all'])?(true):(false)), \LCMS\Core\Users\Stats::can($GLOBALS['AUTH'][2], "allpatt"));
?>
</ACTION>