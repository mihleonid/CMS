<CLEVER />
<PRE>
navpart
</PRE>
<HEADER>
Назначить часть панелью навигации CMS (для плагинов)
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Сейчас: <b>$PARAM$nav$</b>
<br>
Часть:$PARAM$htm$
<br><input type="submit" value="Назначить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::setNav($_POST['part']);
?>
</ACTION>