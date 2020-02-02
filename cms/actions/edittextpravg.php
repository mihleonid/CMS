<PRE>
status
</PRE>
<FORM>
<form autocomplete="off" action="action.php" method="POST" style="width: max-content;">
|Header|
<input type="hidden" name="stat" value="$PARAM$keym$">
<input type="text" placeholder="Название" name="ops" style="width: 200px;" value="$PARAM$linem$" pattern="[a-zA-Z_\-=\+\*1-90а-яА-ЯЁёЩшШшЬьЪъ ]+" required><input type="submit" value="---apply---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Pravs::editTextGroup($_POST['stat'], $_POST['ops']);
?>
</ACTION>