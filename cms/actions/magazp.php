<CACHE />
<PRE>
setmagazp
</PRE>
<HEADER>
Путь магазина
</HEADER>
<FORM>
<p><small>Без повода изменять не рекомендуется.</small></p>
<form action="action.php" method="POST">
|Header|
<input type="url" name="path" value="$PARAM$new$" style="min-width: 100px; width: -webkit-fill-available;" placeholder="Путь" pattern="http:\/.+\..+/.+" required>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\CMSEnv::setShopPath($_POST['path']);
?>
</ACTION>