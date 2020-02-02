<DOWNLOAD />
<PRE>
archive
</PRE>
<HEADER>
---create-archive---
</HEADER>
<FORM>
<form action="action.php" method="POST">
|SHeader|
<input type="hidden" name="tsel" value="archive">
<input type="hidden" name="page" value="/cms/archive.php?<?php echo(((isset($_SERVER['argv'][0]))?($_SERVER['argv'][0]):(""))); ?>">
<div><input type="checkbox" name="download" value="1" style="vertical-align: middle;" /><span style="vertical-align: middle;">---download---</span></div>
---name---:<input type="text" name="name" placeholder="---name---" pattern="[a-zA-Z1-90\.]+">
<?php
include('cmsTree.php');
?>
<input type="submit" value="---create---">
<div>
<?php
$globtext=file_get_contents("cmsTree.php");
function html_my_folderc($udir){
	$udir=rtrim(str_replace("\\", "/", $udir));
	if(is_file($udir)){
		return(array($udir));
	}elseif(is_dir($udir)){
		$text=array($udir);
		$dir=dir($udir);
		while(false!==($entry=$dir->read())){
			if(($entry!=".")and($entry!="..")){
				$text=array_merge(html_my_folderc($udir."/".$entry), $text);
			}
		}
		return $text;
	}
}
$return='';
foreach(html_my_folderc((isset($FOLDER_TO_TREE))?($FOLDER_TO_TREE):('..')) as $r){
	if((strpos($globtext, $r)===false)and(strpos($r, 'cms/')!==false)and(strpos($r, 'cms/localization')===false)and(strpos($r, 'cms/bg')===false)and(strpos($r, 'cms/gallery')===false)and(strpos($r, 'cms/s')===false)and(strpos($r, 'cms/actions')===false)and(strpos($r, 'cms/pic')===false)and(strpos($r, 'cms/pluginrepos')===false)and(strpos($r, 'cms/pluginscripts')===false)and(strpos($r, 'cms/themes')===false)and(strpos($r, 'cms/mane')===false)and(strpos($r, 'cms/tmp')===false)and(strpos($r, 'cms/moduls/themes')===false)and(strpos($r, 'cms/moduls/plugins')===false)and(strpos($r, 'cms/parts')===false)and(strpos($r, 'cms/moduls/parts')===false)and(strpos($r, 'cms/moduls/script')===false)and(strpos($r, 'cms/moduls/patterns')===false)and(strpos($r, 'cms/moduls/patpack')===false)){
		$return.=('<br><big style="color: red;">'.$r."</big>");
	}
}
preg_match_all("@value\=\"(\.\.\/.*?)\"@", $globtext, $m);
$first=true;
$qwas=false;
foreach($m[1] as $mq){
	if((strpos($mq, '$entry')===false)and(strpos($mq, '$name')===false)){
		if(!file_exists($mq)){
			if($first){
				if($return!=""){
					$return=substr($return, 4);
					$first=false;
					$qwas=true;
					$return='<br><div style="display:inline-block; min-width: 33%;vertical-align:top;">'.$return.'</div><div style="display:inline-block; min-width: 33%;vertical-align:top;">';
				}else{
					$return.='<br>';
				}
			}else{
				$return.='<br>';
			}
			$return.=('<big style="color: blue;">'.$mq."</big>");
		}
	}
}
if($qwas){
	$return.="</div>";
}
if($return!=""){
	l('etlfirst');
	echo($return);
	echo('<br><a href="etl.php">');
	l('etlsecond');
	echo('</a>');
}
?>
</div>
</form>
</FORM>
<ACTION>
<?php
function filess($path){
	$objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);
	$r=array();
	foreach($objects as $name => $object){
		$r[]=trim(trim(str_replace("\\", "/", $name)), '/');
	}
	return $r;
}
$file = $_SERVER['DOCUMENT_ROOT']."/cms/tmp/archive".time().mt_rand()."e.zip";
$zip = new ZipArchive();
$zip->open($file, ZipArchive::CREATE);
//$zip->addFile($_SERVER['DOCUMENT_ROOT'].'/.htaccess', '.htaccess');
if(isset($_POST['filesi'])){
	foreach($_POST['filesi'] as $name){
		if($name==".."){
			continue;
		}
		$name=substr($name, 2);
		if(is_file($_SERVER['DOCUMENT_ROOT'].$name)){
			$zip->addFile($_SERVER['DOCUMENT_ROOT'].$name, substr($name, 1));
		}
	}
}
if(isset($_POST['add']['SITE'])){
	foreach(filess('..') as $r){
		if((strpos($r, '../cms')===false)and(strpos($r, '../archives')===false)){
			if($r==".."){
				continue;
			}
			$r=substr($r, 2);
			if(is_file($_SERVER['DOCUMENT_ROOT'].'/'.$r)){
				$zip->addFile($_SERVER['DOCUMENT_ROOT'].'/'.$r, $r);
			}
		}
	}
}
$zip->close();
$_POST['name']=preg_replace('@[^a-zA-Z1-90_]@', '', $_POST['name']);
if(isset($_POST['download'])){
	header("Content-Type: application/zip");
	header("Content-Length: ".filesize($file));
	header("Content-Disposition: attachment; filename=\"".$_POST['name'].".zip\"");
	readfile($file);
	unlink($file);
	return new Result();
}else{
	rename($file, $_SERVER['DOCUMENT_ROOT']."/archives/".$_POST['name'].".zip");
	$r=new Result();
	$r->canceldownload=true;
	return $r;
}
?>
</ACTION>