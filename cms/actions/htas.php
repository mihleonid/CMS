<PRE>
htaccess
</PRE>
<HEADER>
Настройка HTACCESS (CMS)
</HEADER>
<FORM>
|F|
<textarea name="text" wrap="off"><?php echo htmlentities(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/.htaccess"), 0, "utf-8");?></textarea>
<br>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\Config::setHtaccessCMS($_POST['text']);
?>
</ACTION>