<PRE>
script
</PRE>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="hidden" name="name" value="$PARAM$pack$">
<big><big>PHP:</big></big><br>
<textarea name="php" style="width: calc(100% - 450px); min-width: 500px; min-height: 270px;">$PARAM$php$</textarea>
<br>
<br>
<big><big>JavaScript:</big></big><br>
<textarea name="js" style="width: calc(100% - 450px); min-width: 500px; min-height: 270px;">$PARAM$js$</textarea>
<br>
<br>
<big><big>CSS:</big></big><br>
<textarea name="css" style="width: calc(100% - 450px); min-width: 500px; min-height: 270px;">$PARAM$css$</textarea>
<br>
<br>
<input type="submit" value="Изменить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Modules\ScriptModules::edit($_POST['name'], $_POST['php'], $_POST['css'], $_POST['js']);
?>
</ACTION>