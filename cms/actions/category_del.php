<PRE>
category
</PRE>
<FORM>
|F|
<input type="hidden" name="kat" value="$PARAM$all$">
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Category::delete($_POST['kat']);
?>
</ACTION>