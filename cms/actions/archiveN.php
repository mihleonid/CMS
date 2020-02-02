<DOWNLOAD />
<CLEVER />
<PRE>
archive
</PRE>
<HEADER>
---create-archiveN---
</HEADER>
<FORM>
<form action="action.php" method="POST" autocomplete="off">
|SHeader|
<input type="hidden" name="tsel" value="archiveN">
<input type="hidden" name="page" value="/cms/archive.php?<?php echo(((isset($_SERVER['argv'][0]))?($_SERVER['argv'][0]):(""))); ?>">
<div><input type="checkbox" name="download" value="1" style="vertical-align: middle;" /><span style="vertical-align: middle;">---download---</span></div>
---name---:<input type="text" name="name" placeholder="---name---" pattern="[a-zA-Z1-90_]+">
<?php
$PHP_SCRIPT=true;
include('TreeFolderSelector.php');
?>
<input type="submit" value="---create---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Archiver\Archiver::archiveN($_POST['filesi'], $_POST['name'], isset($_POST['download']));
?>
</ACTION>