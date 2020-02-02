<PRE>
status
</PRE>
<FORM>
|F|
<table style="margin-top: 4px;">
<tr><th colspan="2">---add-status---</th></tr>
<tr>
<td>---status---:</td>
<td><input type="text" placeholder="---title---" name="stat" pattern="[a-zA-Z_\-=\+\*1-90]+" required></td>
</tr>
<tr>
<td>---localized-name---</td>
<td><input type="text" placeholder="---title---" name="ops" style="width: 200px;" pattern="[a-zA-Z_\-=\+\*1-90а-яА-Я ]+" required></td>
</tr>
<tr>
<td colspan="2"><input type="submit" value="---add---" style="width: 100%;" ></td>
</tr>
</table>
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Stats::add($_POST['stat'], $_POST['ops']);
?>
</ACTION>