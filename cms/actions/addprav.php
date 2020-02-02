<PRE>
status
</PRE>
<HEADER>
---add-permission---
</HEADER>
<FORM>
<form action="action.php" method="POST" autocomplete="off">
|Header|
<table>
<tr>
<td>---permission---:</td>
<td><input type="text" placeholder="---title---" name="stat" style="width: 100%;" pattern="[a-zA-Z_\-=\+\*1-90]+" required></td>
</tr>
<tr>
<td>---group---:</td>
<td><?php echo($PARAM$alltext$); ?></td>
</tr>
<tr>
<td>---localized-name---:</td>
<td><input type="text" placeholder="---title---" name="ops" style="width: 100%;min-widh: 200px;" pattern="[a-zA-Z_\-=\+\*1-90а-яЁёЩшШшЬьЪъА-Я ]+" required></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="---add---" style="width: 100%;"></td>
</tr>
</table>
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Pravs::add($_POST['stat'], $_POST['group'], $_POST['ops']);
?>
</ACTION>