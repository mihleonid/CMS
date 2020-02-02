<CLEVER />
<PRE>
panpart
</PRE>
<HEADER>
Назначить часть панелью инструментов CMS (для создания страниц в HTML режиме)
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
Сейчас: <b>$PARAM$panel$</b>
<br>
Часть:$PARAM$htma$
<br><input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Patterns\Part::setPanel($_POST['part']);
?>
</ACTION>