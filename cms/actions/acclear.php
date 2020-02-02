<CACHE />
<PRE>
accclear
</PRE>
<HEADER>
---clear-armoring-counter---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="submit" value="---change---">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Security\Counter::clear();
?>
</ACTION>