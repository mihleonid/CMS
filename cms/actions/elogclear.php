<PRE>
error
</PRE>
<HEADER>
Очистить весь лог
</HEADER>
<FORM>
|F|
<input type="submit" value="---clear--">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Security\Elog::clear();
?>
</ACTION>