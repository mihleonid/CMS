<PRE>
editus
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->add("id", array('type'=>'hidden', 'value'=>$PARAM$name$, 'required'=>true));
$aform->submit("---delete---", null, "width: 100%;");
$aform->display($ACTNAME$, null, "width: 100%;");
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Users::delete($_POST['id']);
?>
</ACTION>