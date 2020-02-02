<CLASS>
\LCMS\MainModules\Protector
</CLASS>
<PRE>
protector
</PRE>
<FORM>
<form action="action.php" method="POST" style="float: right;">
|Header|
<img src="/cms/pic/protector<?php echo(((\LCMS\MainModules\Protector::mode())?(""):("_off")));?>.png" onclick="this.parentNode.submit();" style="box-shadow: <?php echo(((\LCMS\MainModules\Protector::mode())?(""):("inset")));?> 0px 0px 145px -40px black; cursor: pointer; border-radius: 88px;"></img>
</form>
</FORM>
<ACTION>
<?php
return \LCMS\MainModules\Protector::reset();
?>
</ACTION>