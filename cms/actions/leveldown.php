<PRE>
editus
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->add("id", array('type'=>'hidden', 'value'=>$PARAM$name$, 'required'=>true));
$aform->submit("---down---");
$aform->display($ACTNAME$, null, "display: inline-block;");
?>
</FORM>
<ACTION>
<?php
return $res=\LCMS\Core\Users\Users::levelDown($_POST['id']);
?>
</ACTION>