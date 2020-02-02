<?php
include_once "login.php";
$path=trim($_GET['p']);
if(!preg_match("@^(?:r|R):? ?(\d{1,3}),? ?(?:g|G):? ?(\d{1,3}),? ?(?:b|B):? ?(\d{1,3})(?:,? ?(?:a|A):? ?(\d{1,3}))?.?$@", trim($_GET['c']), $r)){
$r=array("", 0, 0, 0, 127);
$eet=file("codec/color.db");
foreach($eet as $lin){
	$lini=explode("|", trim($lin));
	if($lini[0]==trim($_GET['c'])){
		$r=$lini;
	}
}
}
if(!preg_match("@^([1-9]\d*)(?:x|X|\*|на|\+|/)([1-9]\d*)$@u", trim(str_replace(" ", "",$_GET['size'])), $siz)){
	$siz=array("", 600, 600);
}
$img=ImageCreateTrueColor($siz[1], $siz[2]);
$color=ImageColorAllocateAlpha($img, $r[1], $r[2], $r[3], $r[4]);
ImageColorTransparent($img, ImageColorAllocateAlpha($img, 0, 0, 0, 127));
ImageAlphaBlending($img, false);
ImageSaveAlpha($img, true);
ImageFilledRectangle($img, 0, 0, $siz[1]-1, $siz[2]-1, $color);
header('Content-type: image/png');
ImagePNG($img, $path);
ImagePNG($img);
ImageDestroy($img);
?>