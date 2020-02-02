<PRE>
pagedel
</PRE>
<HEADER>
Удалить файл
</HEADER>
<FORM>
|F|
---path---:<input type="text" name="path" placeholder="---path---" pattern="[a-zA-Z/]+" required>.php
<br>
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Page::delete($_POST['path']);
?>
</ACTION>