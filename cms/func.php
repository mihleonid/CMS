<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
use \LCMS\Core\Enviroment\Locale;
use \LCMS\Core\Security\Hash;
Page::CMS('<style>
ul{
	padding: 2px;
}
ul>li{
	display: inline-block;
	border: 1px solid #aaaadd;
	padding: 1px;
	margin: 1px 2px;
	font-family: monospace;
	min-width: calc(25% + 100px);
	font-size: 14pt;
	text-align: center;
	background-color: rgba(244, 255, 244, 0.6);
}
</style>');
txt('<a href="env.php"><img src="/cms/pic/var.png" title="Переменные окружения" />---back---</a>');
if(Stats::can("env")){?>
<table style="width: 100%; font-size: 17pt;">
<tr>
<th colspan="2" style="font-family: monospace;">
<h3 style="margin: 0;">В общем:</h3>
</th>
</tr>

<tr>
<td style="font-family: monospace;"><?php Locale::e('hashing-speed'); ?></td>
<td style="font-family: monospace;">
<?php
$size=Hash::getMethod();
if($size==Hash::HMD){
	echo('<span style="color: green;">Высокая</span>');
}elseif($size==Hash::MD){
	echo('<span style="color: red;">Низкая</span>');
}elseif($size==Hash::PLAIN){
	echo('<span style="color: green;">Очень высокая</span>');
}elseif($size==Hash::PASS){
	echo('<span style="color: green;">Высокая</span>');
}
?>
</td>
</tr>

<tr>
<td style="font-family: monospace;"><?php Locale::e('hashing-cost'); ?></td>
<td style="font-family: monospace;">
<?php
$str='<span style="color: darkred;">Очень плохая</span>';
if(($size==Hash::HMD)or($size==Hash::MD)){
	$str='<span style="color: red;">Плохая</span>';
}elseif($size==Hash::PASS){
	$str='<span style="color: darkgreen;">Очень хорошая</span>';
}
echo($str);
?>
</td>
</tr>

<tr>
<td style="font-family: monospace;"><?php Locale::e('actions-speed'); ?></td>
<td style="font-family: monospace;">
<?php
if( \LCMS\Core\Enviroment\CMSEnv::getBuffering()){
	echo('<span style="color: green;">Высокая</span>');
}else{
	echo('<span style="color: red;">Низкая</span>'.(new Action("speed", array("noheader"=>true, "notitle"=>true))));
}
?>
</td>
</tr>

<tr>
<td style="font-family: monospace;"><?php Locale::e('max-memory'); ?></td>
<td style="font-family: monospace;">
<?php
$size=ini_get("memory_limit");
if($size==("-1")){
	echo('<span style="color: darkgreen; font-family: monospace;"><big><big><b>&#8734;</b></big></big></span>');
}else{
	$size=substr($size, 0, strlen($size-1));
	$size=intval($size);
	$size=intval($size*1024);
	$str='<span style="color: darkred;">Очень мало</span>';
	$color='darkred';
	if($size>1000){
		$str='<span style="color: red;">Мало</span>';
		$color='red';
	}if($size>1500){
		$str='<span style="color: yellow;">Достаточно</span>';
		$color='yellow';
	}
	if($size>2000){
		$str='<span style="color: green;">Много</span>';
		$color='green';
	}
	if($size>2500){
		$str='<span style="color: darkgreen;">Очень много</span>';
		$color='darkgreen';
	}
	echo('<span style="color: '.$color.';">'.$size."КБ - </span>".$str);
}
?>
</td>
</tr>

<tr>
<td style="font-family: monospace;">Постепенный вывод</td>
<td style="font-family: monospace;">
<?php
if(ini_get("output_buffering")){
	echo('<span style="color: green;">');
	Locale::e('datatype.value.false');
	echo('</span>');
}else{
	echo('<span style="color: yellow;">');
	Locale::e('datatype.value.true');
	echo('</span>');
}
?>
</td>
</tr>

</table>
<h3 style="margin-bottom: 0px;"><?php Locale::e("get-all-declared"); ?>:</h3>
<form action="?" method="get">
<div style="display: inline-block;">
<input type="checkbox" name="f" value="O" style="vertical-align: middle;"<?php if(isset($_GET['f'])){echo(" checked");}?>><?php Locale::e("functions"); ?>
</div>
<div style="display: inline-block;">
<input type="checkbox" name="c" value="O" style="vertical-align: middle;"<?php if(isset($_GET['c'])){echo(" checked");}?>><?php Locale::e("classes"); ?>
</div>
<div style="display: inline-block;">
<input type="checkbox" name="const" value="O" style="vertical-align: middle;"<?php if(isset($_GET['const'])){echo(" checked");}?>><?php Locale::e("constants"); ?>
</div>
<div style="display: inline-block;">
<input type="checkbox" name="e" value="O" style="vertical-align: middle;"<?php if(isset($_GET['e'])){echo(" checked");}?>><?php Locale::e("extensions"); ?>
</div>
<input type="submit" value="<?php Locale::e("display"); ?>">
</form>
<?php
if(isset($_GET['f'])or isset($_GET['c'])or isset($_GET['e'])or isset($_GET['const'])){
?>
<ul>
<?php
if(isset($_GET['f'])){
$a=get_defined_functions();
$a=$a['internal'];
sort($a);
foreach($a as $l){
	echo("<li><b>".$l."</b><i>()</i></li>");
}
}
if(isset($_GET['c'])){
$a=get_declared_classes();
sort($a);
foreach($a as $l){
	echo("<li><i>class</i> <b>".$l."</b></li>");
}
}
if(isset($_GET['const'])){
$a=get_defined_constants();
asort($a);
foreach($a as $k=>$l){
	echo("<li><i>const</i> <b>".$k." = ".data($l)."</b></li>");
}
}
if(isset($_GET['e'])){
$a=get_loaded_extensions();
sort($a);
foreach($a as $l){
	echo("<li><i>EXTENSION</i> <b>".$l."</b></li>");
}
}
?>
</ul>
<?php } ?>
<?php
}
Page::footer();
?>
