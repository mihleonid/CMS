<PRE>
deltag
</PRE>
<HEADER>
Удалить
</HEADER>
<FORM>
|F|
<?php
$flush="";
$i=0;
foreach(&PARAM&all& as $tag=>$tmp){
	$i++;
	$flush.=("<option style=\"min-width: 150px;\" value=\"$tag\">$tag</option>");
	foreach($tmp as $atr=>$tmp2){
		$i++;
		$flush.=("<option style=\"min-width: 150px;\" value=\"$tag/$atr\">$tag/$atr</option>");
	}
}
$i=min($i, 20);
echo('<select name="tag[]" size="'.$i.'" multiple required>'.$flush.'</select>');
?>
<br>
<input type="submit" value="Удалить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\Htag::deleteH($_POST['tag']);
?>
</ACTION>