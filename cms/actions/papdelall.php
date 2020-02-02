<PRE>
pagedel
</PRE>
<HEADER>
---delete-empty-directories---
</HEADER>
<FORM>
|F|
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
function isEmptyDir($i){
	$i=trim(str_replace('\\', '/', $i), '/');
	$dir=dir($i);
	while(false!==($entry=$dir->read())) {
		$entry=trim(str_replace('\\', '/', $entry), '/');
		if(($entry!=".")and($entry!="..")){
			$c=$i.'/'.$entry;
			if(file_exists($c)){
				return false;
			}
		}
	}
	return true;
}
function EEmpty($i){
	if(stripos($i, 'cms')){
		return;
	}
	if(stripos($i, 'archives')){
		return;
	}
	$i=trim(str_replace('\\', '/', $i), '/');
	$dir=dir($i);
	while(false!==($entry=$dir->read())) {
		$entry=trim(str_replace('\\', '/', $entry), '/');
		if(($entry!=".")and($entry!="..")){
			$c=$i.'/'.$entry;
			if(file_exists($c)and is_dir($c)){
				EEmpty($c);
			}
		}
	}
	if(isEmptyDir($i)){
		rmdir($i);
	}
}
EEmpty($_SERVER['DOCUMENT_ROOT']);
return new Result();
?>
</ACTION>