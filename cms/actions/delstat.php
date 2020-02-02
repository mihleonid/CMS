<PRE>
status
</PRE>
<FORM>
|F|
<input type="hidden" name="ststu" value="$PARAM$all$">
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \CMS\Core\Users\Status::delete($_POST['ststu']);
?>
</ACTION>