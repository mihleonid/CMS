<PRE>
pagedel
</PRE>
<HEADER>
---delete-directory---
</HEADER>
<FORM>
|F|
---directory---:<input type="text" name="path" placeholder="---path---" pattern="[a-zA-Z/]+">/
<br>
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Page::deleteDir($_POST['path']);
?>
</ACTION>