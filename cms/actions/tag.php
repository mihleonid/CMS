<PRE>
addtag
</PRE>
<HEADER>
Новый тег
</HEADER>
<FORM>
|F|
<span style="font-family: monospace;">&lt;<input type="text" style="width: 7em; font-family: monospace;" name="tag" placeholder="Тег" required>&gt;</span>
<br>
<input type="submit" value="Новый">
</form>
</FORM>
<ACTION>
<?php
$_POST['page'].="?last=".$_POST['tag'];
return \LCMS\Core\Pages\HTag::add($_POST['tag']);
?>
</ACTION>