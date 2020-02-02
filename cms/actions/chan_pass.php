<PRE>
editus
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->add("id", array('type'=>'hidden', 'value'=>$PARAM$name$, 'required'=>true));
$aform->add("pass", array('type'=>'password', 'style'=>'width: 100px;', 'required'=>true));
$aform->submit("---set---");
$aform->display("chan_pass", null, "display: inline-block;");
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Users::changePassword($_POST['id'], $_POST['pass'], $GLOBALS['AUTH'][0]);
?>
</ACTION>