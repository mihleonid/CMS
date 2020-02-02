<PRE>
pagedel
</PRE>
<FORM>
|F|
<input type="hidden" name="path" value="$PARAM$all$" required>
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Page::delete($_POST['path']);
?>
</ACTION>