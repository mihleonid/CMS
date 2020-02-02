<PRE>
error
</PRE>
<FORM>
|F|
<input type="hidden" name="n" value="$PARAM$all$">
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Security\ELog::deleteLine($_POST['n']);
?>
</ACTION>