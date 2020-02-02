<PRE>
status
</PRE>
<HEADER>
---add-permission-group---
</HEADER>
<FORM>
<form action="action.php" method="POST" autocomplete="off">
|Header|
<table>
<tr>
<td>---group---:</td>
<td><input type="text" placeholder="---title---" name="stat" style="width: 100%;" pattern="[a-zA-Z1-90]+" required></td>
</tr>
<tr>
<td>---localized-name---</td>
<td><input type="text" placeholder="---title---" name="ops" style="width: 100%;min-width: 200px;" pattern="[a-zA-Z_\-=\+\*1-90а-яА-ЯЁёЩшШшЬьЪъ ]+" required></td>
</tr>
<tr>
<td colspan="2"><input type="submit" style="width: 100%;" value="---add---"></td>
</tr>
</table>
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Pravs::addGroup($_POST['stat'], $_POST['ops']);
?>
</ACTION>