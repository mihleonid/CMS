<PRE>
cache
</PRE>
<HEADER>Управление кэшированием</HEADER>
<FORM>
<?php
$mode= \LCMS\Core\Enviroment\CMSEnv::getCacheMode();
$logform=new Form();
$logform->html['AFORM']='
<input type="radio" name="mode" value="Auto"'.(($mode=="Auto")?(" checked"):("")).'>Не управлять<br>
<input type="radio" name="mode" value="Cache"'.(($mode=="Cache")?(" checked"):("")).'>Полное кэширование<br>
<input type="radio" name="mode" value="NO"'.(($mode=="NO")?(" checked"):("")).'>Не кэшировать<br>
<input type="radio" name="mode" value="Private"'.(($mode=="Private")?(" checked"):("")).'>Кэшировать в браузере<br>
<input type="radio" name="mode" value="Public"'.(($mode=="Public")?(" checked"):("")).'>Кэшировать на прокси<br>
<input type="submit" value="---apply---">';
$logform->display($ACTNAME$);
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::setCacheMode($_POST['mode']);
?>
</ACTION>