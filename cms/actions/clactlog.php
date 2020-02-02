<PRE>
actlog
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->submit("Очистить лог");
echo $aform->get($ACTNAME$, null, "width: 100%;", false);
?>
</FORM>
<ACTION>
<?php
file_put_contents("actions.log", "");
return new Result();
?>
</ACTION>