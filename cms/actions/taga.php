<PRE>
addtag
</PRE>
<HEADER>
Новый атрибут
</HEADER>
<FORM>
|F|
<span style="font-family: monospace;">&lt;<select type="text" style="font-family: monospace;" name="tag" placeholder="Тег" required>$PARAM$all$</select> <input type="text" style="width: 9em; font-family: monospace;" name="attr" placeholder="Атрибут" required> ...&gt;</span>
<br>
<input type="submit" value="Новый">
</form>
</FORM>
<ACTION>
<?php
$_POST['page'].="?last=".$_POST['tag'];
return \LCMS\Core\Pages\HTag::addAttr($_POST['tag'], $_POST['attr']);
?>
</ACTION>