<PRE>
editus
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->add("id", array('type'=>'hidden', 'value'=>$PARAM$name$, 'required'=>true));
$aform->add('cl', array('value'=>'ok', 'style'=>'vertical-align: middle;', 'onclick'=>'this.parentElement.submit();', 'type'=>'checkbox', 'checked'=>(\LCMS\Core\Users\Users::isClever($PARAM$name$))));
$aform->display($ACTNAME$, null, "display: inline-block;");
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Users\Users::setClever($_POST['id'], ((isset($_POST['cl']))?(true):(false)));
?>
</ACTION>