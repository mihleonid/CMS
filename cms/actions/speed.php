<PRE>
speed
</PRE>
<HEADER>Управление буферизацией</HEADER>
<FORM>
<?php
$aform=new Form();
$aform->add('buffered', array('value'=>'ON', 'style'=>'vertical-align: middle;', **!notitle**'postlabel'=>'<span style="height: 100%; vertical-align: middle; display: inline-block;">Ускорение действий буферезацией</span>',*****notitle**'postlabel'=>'<span style="height: 100%; vertical-align: middle; display: inline-block;">Ускорить</span>',*** 'onclick'=>'this.parentElement.submit();', 'type'=>'checkbox', 'checked'=>( \LCMS\Core\Enviroment\CMSEnv::getBuffering() )));
$aform->display($ACTNAME$);
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::setBuffering((isset($_POST['buffered'])?"ON":""));
?>
</ACTION>