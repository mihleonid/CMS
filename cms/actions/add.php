<PRE>
editus
</PRE>
<FORM>
<?php
$logform=new Form();
$logform->html['AFORM']='<table>
<tr><th colspan="2">---add-user---</th></tr>
<tr><th>---username---</th><td><input type="text" name="user" required></td></tr>
<tr><th>---password---</th><td><input type="password" name="pass" required></td></tr>
<tr><th>---status---</th><td><select name="stat">
'. \LCMS\Core\Users\Stats::HTMLStatuses().'
</select></td></tr>
<tr><td colspan="2"><input style="width: 100%;" type="submit" value="---add---"></td></tr>
</table>';
$logform->display($ACTNAME$);
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Users::add($_POST['user'], $_POST['pass'], $_POST['stat']);
?>
</ACTION>