<DOWNLOAD />
<PRE>
gallery
</PRE>
<FORM>
<form action="action.php" method="POST" id="downf">
<input type="hidden" name="gallery" id="down" value="">
|Header|
<input type="submit" value="---download--- ZIP"><input type="button" style="display: none;" value="Нажмите, когда файл загрузится" id="dog" onclick="window.location.reload();">
</form>
</FORM>
<ACTION>
<?php
$file = $_SERVER['DOCUMENT_ROOT']."/cms/tmp/gallery".time().mt_rand()."e.zip"; 
$zip = new ZipArchive(); 
$zip->open($file, ZipArchive::CREATE);
$white= \LCMS\Modules\File\WhiteImg::get();
foreach(explode('|', $_POST['gallery']) as $name){
	$name=explode('/', $name);
	$name=$name[count($name)-1];
	$name=explode('.', $name);
	$ext=preg_replace("@[^a-zA-Z]@", "", $name[1]);
	if(isset($white[$ext])){
		$name=preg_replace("@[^a-zA-Z]@", "", $name[0]).".".$ext;
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/gallery/".$name)){
			$zip->addFile($_SERVER['DOCUMENT_ROOT']."/cms/gallery/".$name, $name);
		}
	}
	}
$zip->close(); 
header("Content-Type: application/zip"); 
header("Content-Length: " . filesize($file)); 
header("Content-Disposition: attachment; filename=\"gallery.zip\""); 
readfile($file); 
unlink($file);
?>
</ACTION>