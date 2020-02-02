<PRE>
gallery
</PRE>
<HEADER>
---upload-image---
</HEADER>
<FORM>
<form action="action.php" method="POST" enctype="multipart/form-data">
|Header|
*CLEVER*
<input type="text" name="name" placeholder="---name---" pattern="[a-zA-Z]*">.<input type="text" name="ext" placeholder="---extension---" pattern="[a-zA-Z]*">
<br>
***
<input type="file" name="doc[]" accept="$PARAM$i$" required multiple>
<br>
<input type="submit" value="---upload---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Gallery::upload();
?>
</ACTION>