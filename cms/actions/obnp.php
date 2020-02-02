<CACHE />
<PRE>
obnovpath
</PRE>
<HEADER>
Путь обновлений
</HEADER>
<FORM>
<p><small>Без повода изменять не рекомендуется.</small></p>
<form action="action.php" method="POST">
|Header|
<input type="url" name="path" value="$PARAM$new$" style="min-width: 100px; width: -webkit-fill-available;" placeholder="Путь" pattern="http:\/.+\..+/.+" required>
<input type="submit" value="Настроить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::setObnovPath($_POST['path']);
?>
</ACTION>