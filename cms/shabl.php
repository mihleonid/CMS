<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\MainModules\D_BASE;
Page::CMS();?>
<?php
if(isset($_GET['tsel'])){?>
<form action="shabl.php" method="GET">
<input type="submit" value="Закрыть">
</form>
<?php
}else{
	$_GET['tsel']="";
}?>
<?php
if(Stats::can($GLOBALS['AUTH'][2], array("themepack", "delthemes", "loadtheme", "themedepack", "packthemedelete", "theme"))){?>
<a href="theme.php"><img src="/cms/pic/theme.png" title="Настройка темы" />Настройка темы</a>
<br>
<?php }?>
<?php if(Users::isClever() and Stats::can($GLOBALS['AUTH'][2], array("light", "wid", "delay"))){?>
<a href="highl.php"><img src="/cms/pic/highlight.png" title="Настройка выделение цветом" />Настройка выделение цветом</a>
<?php } ?>
<?php if(Stats::can($GLOBALS['AUTH'][2], "stylestable")){?>
<h3>Открыть стиль</h3>
<form action="shabl.php" method="GET">
<input type="hidden" name="tsel" value="openst">
Шаблон:<?php
$string=Pattern::getAll();
echo($string[1]);
?>
<br>
<input type="submit" value="Открыть">
</form>
<?php
if($_GET['tsel']=="openst"){?>
<br>
<h3>Изменить стиль: <code><?php echo($_GET['s']);?></code></h3>
<?php
echo(new Action("makest"));
?>
<?php } ?>
<?php
}
if(\LCMS\Core\Users\Stats::can($GLOBALS['AUTH'][2], "pattedit")){?>
<h3>Открыть шаблон</h3>
<form action="shabl.php" method="GET">
<input type="hidden" name="tsel" value="opens">
Шаблон:<?php
$string=Pattern::getAll();
echo($string[1]);
?>
<br>
<input type="submit" value="Открыть">
</form>
<?php
if($_GET['tsel']=="opens"){
	$tmpdb=unserialize(file_get_contents("s/db/so.db"));
	$style=trim($_GET['s']);
	$ch="";
	if(isset($tmpdb[$style])){
		$ch=" checked";
	}
	echo(new Action("makes", array('s'=>$_GET['s'], 'get'=>Pattern::get($_GET['s']), 'ch'=>$ch)));
}
?>
<?php } ?>
<?php
echo(new Action("cmss"));
echo(new Action("defs"));
echo(new Action("dels"));
echo(new Action("sabadd"));
echo(new Action("pattcopy"));
echo('<div style="margin: 5px; font-size: 111%;">Доступные всем шаблоны:<ul>');
$string= \LCMS\Core\Patterns\Pattern::getAll(false);
foreach($string[0] as $val){
	echo("<li>$val</li>");
}
echo("</ul></div>");
$dir=dir("moduls/patpack/");
$htm="<select name=\"part\">";
$was=false;
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$htm.="<option value=\"$entry\">$entry</option>";
		$was=true;
	}
}
$htm.="</select>";
echo(new Action("inspack", array('htm'=>$htm)));
$htmm="<select name=\"part\" required>";
if(file_exists("moduls/logs/patt.log")){
	$hhh=file_get_contents("moduls/logs/patt.log");
	$hhh=unserialize($hhh);
	$xwas=false;
	foreach($hhh as $key=>$line){
		$xwas=true;
		$htmm.="<option value=\"$key\">$key</option>";
	}
}else{
	file_put_contents("moduls/logs/patt.log", serialize(array()));
	$xwas=false;
}
$htmm.="</select>";
if($xwas){
	echo(new Action("packpattunins", array('htmm'=>$htmm)));
}
$hgyt= \LCMS\Core\Patterns\Pattern::getAll(null, true, "", true);
echo(new Action("newpattpack", array('O'=>$hgyt[1])));
if($was){
echo(new Action("pattpackcopy", array('htm'=>$htm)));
echo(new Action("delss", array('htm'=>$htm)));
}
Page::footer();
?>