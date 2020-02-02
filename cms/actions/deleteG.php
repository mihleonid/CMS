<PRE>
gallery
</PRE>
<FORM>
<form action="action.php" method="POST" id="delf">
|Header|
<input type="hidden" name="gallery" id="del" value="">
<input type="submit" value="---delete---">
</form>
</FORM>
<ACTION>
<?php
$white= \LCMS\Modules\File\WhiteImg::get();
foreach(explode('|', $_POST['gallery']) as $name){
	$name=explode('/', $name);
	$name=$name[count($name)-1];
	$name=explode('.', $name);
	$ext=preg_replace("@[^a-zA-Z]@", "", $name[1]);
	if(isset($white[$ext])){
		$name=preg_replace("@[^a-zA-Z]@", "", $name[0]).".".$ext;
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/gallery/".$name)){
			unlink($_SERVER['DOCUMENT_ROOT']."/cms/gallery/".$name);
		}
	}
}
?>
</ACTION>