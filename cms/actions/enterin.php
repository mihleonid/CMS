<DOWNLOAD />
<PRE>
editus
</PRE>
<FORM>
<?php
$aform=new Form();
$aform->add("id", array('type'=>'hidden', 'value'=>$PARAM$name$, 'required'=>true));
$aform->submit("Войти как");
$aform->display($ACTNAME$, null, "display: inline-block;");
?>
</FORM>
<ACTION>
<?php
$r= \LCMS\Core\Users\Users::enterIn($_POST['id']);
$r->canceldownload=true;
return $r;
?>
</ACTION>