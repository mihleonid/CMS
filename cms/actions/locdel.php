<PRE>
env
</PRE>
<FORM>
|F|
<input type="hidden" name="k" value="$PARAM$all$">
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\Loc::delete($_POST['k']);
?>
</ACTION>