<CLEVER />
<CACHE />
<PRE>
wid
</PRE>
<HEADER>
---set-able---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<input type="hidden" name="allow" value="$PARAM$val$">
<img onclick="this.parentNode.submit();" style="cursor: pointer;" class="kachat" src="/cms/pic/$PARAM$yn$.png" ></img>
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Highlight::auto($_POST['allow']);
?>
</ACTION>