<PRE>
editus
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->add("id", array('type'=>'hidden', 'value'=>$PARAM$name$, 'required'=>true));
$aform->submit("---up---");
$aform->display($ACTNAME$, null, "display: inline-block;");
?>
</FORM>
<ACTION>
<?php
return $res=\LCMS\Core\Users\Users::levelUp($_POST['id']);
?>
</ACTION>