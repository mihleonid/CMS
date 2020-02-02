<CLEVER />
<CACHE />
<PRE>
delay
</PRE>
<HEADER>
Настроить преодичность автовыделения
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="number" name="num" min="1" value="$PARAM$val$" required>мс<br>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Highlight::delay($_POST['num']);
?>
</ACTION>