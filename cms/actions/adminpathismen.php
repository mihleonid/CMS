<CACHE />
<PRE>
setcpath
</PRE>
<HEADER>
Путь справки
</HEADER>
<FORM>
<p><small>---if-you-know-what-are-you-doing---</small></p>
<form action="action.php" method="POST">
|Header|
<input type="url" name="path" value="$PARAM$new$" style="min-width: 100px; width: -webkit-fill-available;" placeholder="---path---" pattern="http:\/.+\..+/.+" required>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::setCreaterPath($_POST['path']);
?>
</ACTION>