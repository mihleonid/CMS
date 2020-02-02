<PRE>
cleanlog.pagelog
</PRE>
<HEADER>
Очистка лога
</HEADER>
<FORM>
|F|
До: <input type="number" style="width: 100px;" value="$PARAM$all$" max="$PARAM$all$" min="0" name="str" required> записей.
<br>
<input type="submit" value="Очистить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\PageLog::clear($_POST['str']);
?>
</ACTION>