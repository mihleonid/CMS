<CACHE />
<PRE>
version
</PRE>
<HEADER>
---version---
</HEADER>
<FORM>
<p><small>---if-you-know-what-are-you-doing---</small></p>
<form action="action.php" method="POST">
|Header|
<input type="text" name="path" value="$PARAM$new$" style="" placeholder="---version---" pattern=".+\..+\..+\..+" required>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::changeVersion($_POST['path']);
?>
</ACTION>