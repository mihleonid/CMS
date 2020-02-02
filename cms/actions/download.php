<PRE>
shop
</PRE>
<FORM>
$PARAM$all$
</FORM>
<ACTION>
<?php
return \LCMS\Core\IO\In::shopDownload($_POST['kuda'], $_POST['path']);
?>
</ACTION>