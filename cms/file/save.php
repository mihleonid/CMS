<?php
include "login.php";
// print_r($_POST);
// $img=ImageCreateTrueColor(600, 600);
if(@ImageCreateFromPNG("img.png")){
$img=ImageCreateFromPNG("img.png");
}else{
	echo("Не png, ошибка");
	exit;
}
ImageColorTransparent($img, ImageColorAllocateAlpha($img, 0, 0, 0, 127));
ImageAlphaBlending($img, false);
ImageSaveAlpha($img, true);
// ImageFilledRectangle($img, 0, 0, 599, 599, 0xFFFFFF);
// header('Content-type: image/png');
// ImagePng($img, "l.png");
$str=$_POST['str'];
$ar=explode("--", $str);
unset($ar[0]);
// echo(1);
foreach($ar as $aar){
	$rr=explode("-", $aar);
	if($rr[0]=="el"){
		$color=ImageColorAllocateAlpha($img, $rr[1], $rr[2], $rr[3], $rr[7]);
		$rad=$rr[4]*2;
		ImageFilledEllipse($img, $rr[5], $rr[6], $rad, $rad, $color);
	}elseif($rr[0]=="text"){
		// print_r($rr);
		$color=ImageColorAllocateAlpha($img, $rr[1], $rr[2], $rr[3], $rr[7]);
		// echo($rr[1]."!".$rr[2]."!".$rr[3]."!".$rr[7]."|".$color);
		$rad=$rr[8];
		ImageFTText($img, $rad, 0, $rr[5], $rr[6], $color, 'codec/arial.ttf', $rr[4]);
		// ImageString($img, $rad, $rr[5], $rr[6], $rr[4], $color);
		// ImageFTText($img, 100, 0, 100, 100, $color, 'codec/arial.ttf', $rr[4]);
	}
}
if($_POST['path']==""){
	$_POST['path']="img.png";
}
// $_POST['path']="img.png";
// ImageColortransparent($img, ImageColorAllocateAlpha($img, 153, 153, 255, 127));
ImagePNG($img, $_POST['path']);
ImagePNG($img, "img.png");
// ImagePNG($img);
echo("Сохранено");
ImageDestroy($img);
?>