<PRE>
feedback
</PRE>
<HEADER>
Написать письмо разработчику
</HEADER>
<FORM>
<?php
$aform=new Form();
$aform->html['AFORM']='
<input type="text" name="them" placeholder="Тема письма">
<br>
<textarea name="text" placeholder="Текст письма"></textarea>
<br>
<input type="e-mail" name="mail" placeholder="Ваша почта для ответа">
<input type="submit" value="Отправить">';
$aform->display($ACTNAME$);
?>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::sendMessageToCreater($_POST['text'], $_POST['them']);
?>
</ACTION>