<PRE>
category
</PRE>
<FORM>
|F|
Категория:<input type="text" name="kat" placeholder="Категория" pattern="[a-zA-Z1-90_]+" required>
Описание:<input type="text" name="ops" placeholder="Описание" pattern="[a-zA-Z1-90_а-яА-Яё ,\.]+" required>
<input type="submit" value="Создать">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Category::add($_POST['kat'], $_POST['ops']);
?>
</ACTION>