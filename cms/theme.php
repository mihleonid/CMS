<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\GUI\Themes;
use \LCMS\MainModules\D_BASE;
Page::CMS('<style>
.thumbs {
	display: inline-block;
  width: 250px;
  margin: 10px;
  opacity: 0.99;
  overflow: hidden;
  position: relative;
  border-radius: 3px;
  cursor: pointer;
  -webkit-box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
  -moz-box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
  box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
}
.thumbs:before {
  content: \'\';
  background: -webkit-linear-gradient(top, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
  background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
  width: 100%;
  height: 50%;
  opacity: 1;/*0*/
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 2;
  -webkit-transition-property: top, opacity;
  transition-property: top, opacity;
  -webkit-transition-duration: 1.2s;
  transition-duration: 1.2s;
}
.thumbs{
	border-radius: 80px;
	box-sizing: border-box;
}
.select{
	border: 5px solid red;
	border-radius: 20px;
	border-style: ridge;
}
.thumbs img {
	box-sizing: border-box;
  display: block;
  /*width: 100%; /* ширина картинки */
  /*height: auto; /* высота картинки */
  /*backface-visibility: hidden;*/
  /*-webkit-backface-visibility: hidden;*/
}
.thumbs .caption {
  width: 100%;
  padding-bottom: 20px;
  color: #fff;
  position: absolute;
  bottom: 0;
  left: 0;
  z-index: 3;
  text-align: center;
}
.thumbs .caption span {
  display: block;
  opacity: 1;/*0*/
  position: relative;
  top: 100px;
  -webkit-transition-property: top, opacity;
  transition-property: top, opacity;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-delay: 0s;
  transition-delay: 0s;
}
.thumbs .caption .title {
  line-height: 1;
  font-weight: normal;
  font-size: 18px;
}
.thumbs .caption .info {
  line-height: 1.2;
  margin-top: 5px;
  font-size: 12px;
}
.thumbs:focus:before,
.thumbs:focus span, .thumbs:hover:before,
.thumbs:hover span {
  opacity: 1;
}
.thumbs:focus:before, .thumbs:hover:before {
  top: 50%;
}
.thumbs:focus span, .thumbs:hover span {
  top: 0;
}
.thumbs:focus .title, .thumbs:hover .title {
  -webkit-transition-delay: 0.15s;
          transition-delay: 0.15s;
}
.thumbs:focus .info, .thumbs:hover .info {
  -webkit-transition-delay: 0.25s;
          transition-delay: 0.25s;
}
.fone{
	border: 5px solid blue;
	border-style: ridge;
}
.theme{
	border: 5px solid green;
	border-style: ridge;
}
.theme.select{
	border: 5px solid #ffff00;
	border-style: ridge;
}
.fone.select{
	border: 5px solid #ff00ff;
	border-style: ridge;
}
.theme.fone{
	border: 5px solid #00ffff;
	border-style: ridge;
}
.theme.fone.select{
	border: 5px solid ghostwhite;
	border-style: ridge;
}
#foto{
	height: 590px;
	overflow: -webkit-paged-x;
	-webkit-user-select: none;
}
</style>');
txt('<a href="shabl.php"><img src="/cms/pic/pattern.png" title="Шаблон" />---back---</a>');
$dir=dir("themes/");
$htm="<div id=\"foto\">";
$htmm="";
$i=0;
$selected=Themes::getTheme();
$fone=Themes::getFone();
$dbf=file("themes.db");
foreach($dbf as $str){
	$str=explode("|", $str);
	$db[trim($str[0])]=array(trim($str[1]), trim($str[2]));
}
$someselect=false;
$somefone=false;
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$selvar="";
		if($selected==$entry){
			$selvar.=" theme";
			$someselect=true;
		}
		if($fone==$entry){
			$selvar.=" fone";
			$somefone=true;
		}
		if($selected==$entry){
			$selvar.=" select";
		}
		if(isset($db[$entry])){
			$name=$db[$entry][0];
			$ops=$db[$entry][1];
		}else{
			$name="Без названия";
			$ops="Без описания";
		}
		$htmm.="<option value=\"$entry\"><big>$name</big> : $ops <sub>$entry</sub></option>";
		$htm.="<div id=\" url('/cms/themes/$entry')\" cli=\"on\" class=\"thumbs$selvar\"><img width=\"250px\" height=\"250px\" src=\"/cms/themes/$entry\" id=\"  url('/cms/themes/$entry')\" cli=\"on\"></img><div class=\"caption\" id=\"   url('/cms/themes/$entry')\" cli=\"on\"><span class=\"title\" id=\"    url('/cms/themes/$entry')\" cli=\"on\">$name</span><span class=\"info\" id=\"     url('/cms/themes/$entry')\" cli=\"on\">$ops <sub><small>$entry</small></sub></span></div></div>";
		$i++;
	}
}
if($someselect==false){
	$selected="none";
}
if($somefone==false){
	$fone="none";
}
$selvar="";
if($selected=="none"){
	$selvar.=" theme";
}
if($fone=="none"){
	$selvar.=" fone";
}
if($selected=="none"){
	$selvar.=" select";
}
$htm.="<div id=\" none\" cli=\"on\" class=\"thumbs$selvar\"><img style=\"background-color: rgba(204, 204, 204, 0.5);\" width=\"250px\" height=\"250px\"  id=\"  none\" cli=\"on\"></img><div class=\"caption\" id=\"   none\" cli=\"on\"><span class=\"title\" id=\"    none\" cli=\"on\">Нет</span><span class=\"info\" id=\"     none\" cli=\"on\">Отсутствие фона</span></div></div>";
$htm.="</div>";
echo(new Action("theme", array('htm'=>$htm, 'selected'=>$selected)));
echo(new Action("themedouble"));
echo(new Action("themel"));
echo(new Action("themep", array('i'=>$i, 'htmm'=>$htmm)));
$dir=dir("moduls/themes/");
$htm="<select name=\"part\" required>";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$htm.="<option value=\"$entry\">$entry</option>";
	}
}
$htm.="</select>";
Action::e("themei", array('htm'=>$htm));
Action::e("themed", array('htm'=>$htm));
Action::e("thememd", array('i'=>$i, 'htmm'=>$htmm));
Page::footer();
?>