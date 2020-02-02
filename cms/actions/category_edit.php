<PRE>
category
</PRE>
<FORM>
|F|
<input type="hidden" name="kat" value="$PARAM$k$">
<input type="text" name="ops" placeholder="Описание" value="$PARAM$v$" pattern="[a-zA-Z1-90_а-яА-Яё ,\.]+" required>
<input type="submit" value="---apply---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Category::set($_POST['kat'], $_POST['ops']);
?>
</ACTION>