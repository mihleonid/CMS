<CACHE />
<PRE>
timezone
</PRE>
<HEADER>
---timezone---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="text" name="path" value="$PARAM$new$" style="" placeholder="---timezone---" pattern=".+/.+" required>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\Timezone::set($_POST['path']);
?>
</ACTION>