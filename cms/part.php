<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\MainModules\D_BASE;
Page::CMS();
$dir=dir("parts/");
$htm="";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$partes[]=$entry;
		if(@file("parts/$entry.part")){
			$soda=file("parts/$entry.part");
			$soda=implode("", $soda);
			$soda=trim($soda);
			$soda=htmlentities($soda, ENT_QUOTES, 'utf-8');
			$htm.="<div id=\"fileopen__$entry\"><img src=\"/cms/pic/flagbottom.png\" onclick=\"document.getElementById('fileopen__$entry').style.display='none'; document.getElementById('file__$entry').style.display='block';\"></img><span style=\"height: 27px; vertical-align: text-bottom; display:inline-block;\">$entry</span></div><div id=\"file__$entry\" style=\"display: none;\"><p style=\"margin-top: 0;\"><img src=\"/cms/pic/flagtop.png\" onclick=\"document.getElementById('fileopen__$entry').style.display='block'; document.getElementById('file__$entry').style.display='none';\"></img><span style=\"height: 27px; vertical-align: text-bottom; display:inline-block; font-weight: bold;\">$entry</span></p><textarea name=\"E_$entry\">$soda</textarea></div>";
		}
	}
}
$partes=implode("|", $partes);
echo(new Action("parts", array('htm'=>$htm, 'partes'=>$partes)));
$dir=dir("parts/");
$htmmul="<select name=\"part[]\" size=\"6\" style=\"min-width: 120px;\" required multiple>";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$htmmul.="<option value=\"$entry\">$entry</option>";
	}
}
$htmmul.="</select>";
$htm="<select name=\"part\" required>";
$dir=dir("parts/");
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$htm.="<option value=\"$entry\">$entry</option>";
	}
}
$htm.="</select>";
echo(new Action("delp", array('htm'=>$htmmul)));
$dir=dir("parts/");
$htmcpy="";
$htma="<select name=\"part\"><option value=\"<AUTO>\">&lt;AUTO&gt;</option>";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$htma.="<option value=\"$entry\">$entry</option>";
		$htmcpy.="<option value=\"$entry\">$entry</option>";
	}
}
$htma.="</select>";
echo(new Action("navpart", array('htm'=>$htm, 'nav'=>\LCMS\Core\Patterns\Part::getNav())));
echo(new Action("panpart", array('htma'=>$htma, 'panel'=>\LCMS\Core\htmlchars( \LCMS\Core\Patterns\Part::getPanel()))));
echo(new Action("partcopy", array('htmcpy'=>$htmcpy)));
echo(new Action("partadd"));
$dir=dir("moduls/parts/");
$htm="<select name=\"part\" required>";
$xwashtm=false;
$htmcpy="";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$xwashtm=true;
		$entry=substr($entry, 0, strlen($entry)-5);
		$htm.="<option value=\"$entry\">$entry</option>";
		$htmcpy.="<option value=\"$entry\">$entry</option>";
	}
}
$htm.="</select>";
if($xwashtm){
echo(new Action("packpartadd", array('htm'=>$htm)));
}
$htmm="<select name=\"part\" required>";
$hhh=file_get_contents("moduls/logs/part.log");
$hhh=unserialize($hhh);
$xwas=false;
foreach($hhh as $key=>$line){
	$xwas=true;
	$htmm.="<option value=\"$key\">$key</option>";
}
$htmm.="</select>";
if($xwas){
echo(new Action("packpartdel", array('htmm'=>$htmm)));
}
if($xwashtm){
echo(new Action("partpackcopy", array('htmcpy'=>$htmcpy)));
}
if($xwashtm){
echo(new Action("packpartdelp", array('htm'=>$htm)));
}
echo(new Action("packpartcraut", array('htmmul'=>$htmmul)));
PAGE::footer();
?>