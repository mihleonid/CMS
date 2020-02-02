<CACHE />
<PRE>
upload
</PRE>
<HEADER>
---upload---
</HEADER>
<FORM>
<form action="action.php" method="POST" enctype="multipart/form-data">
|Header|
<input type="text" name="name" placeholder="---name---" pattern="[a-zA-Z]*">.<input type="text" name="ext" placeholder="---extension---" pattern="[a-zA-Z]*">
<br>
Файл:
<input type="file" name="doc" required>
<br>
Что это:
<br>
<select name="type">
<option value="moduls/script/">Скриптовой модуль</option>
<option value="moduls/plugins/">Плагин</option>
<option value="moduls/patpack/">Пакет шаблонов</option>
<option value="s/">Шаблон</option>
<option value="moduls/themes/">Пакет тем</option>
<option value="../archives/">Архив</option>
<option value="moduls/parts/">Пакет частей</option>
<option value="pic/users/upload/">Прочий файл</option>
</select>
<br>
<input type="submit" value="---upload---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\IO\In::uploadFile();
?>
</ACTION>