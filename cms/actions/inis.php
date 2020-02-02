<PRE>
htaccess
</PRE>
<HEADER>
Настройка INI
</HEADER>
<FORM>
|F|
<textarea name="text" wrap="off"><?php echo htmlentities(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/php.ini"), 0, "utf-8");?></textarea>
<br>
<input type="submit" value="---set---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Enviroment\Config::setIniCMS($_POST['text']);
?>
</ACTION>