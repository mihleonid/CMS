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
$dir=dir("moduls/script/");
$htm="<select name=\"pack\">";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entry=substr($entry, 0, strlen($entry)-5);
		$htm.="<option value=\"$entry\">$entry</option>";
	}
}
$htm.="</select>";
echo(new Action("scriptadd", array('htm'=>$htm)));
echo(new Action("scriptcrau"));
echo(new Action("scriptdel", array('js'=> \LCMS\Core\Modules\ScriptModules::getHTML('js'), 'css'=> \LCMS\Core\Modules\ScriptModules::getHTML('css'), 'php'=> \LCMS\Core\Modules\ScriptModules::getHTML('php'))));
if(\LCMS\Core\Users\Stats::can($GLOBALS['AUTH'][2], "script")){ ?>
<h3>Редактировать скрипты</h3>
<?php
if(isset($_GET['pack'])){
$file=file_get_contents('moduls/script/'.$_GET['pack'].'.pack');
$unser=unserialize($file);
$phpt=((isset($unser['php']))?($unser['php']):(""));
$csst=((isset($unser['css']))?($unser['css']):(""));
$jst=((isset($unser['js']))?($unser['js']):(""));
?>
<form action="mod.php" method="GET">
<input type="submit" value="Закрыть">
</form>
<?php
echo(new Action("scriptset", array('pack'=>$_GET['pack'], 'php'=> \LCMS\Core\htmlchars($phpt), 'css'=> \LCMS\Core\htmlchars($csst), 'js'=> \LCMS\Core\htmlchars($jst))));
?>
<?php }else{ ?>
<form action="mod.php" method="GET">
Имя:
<?php echo($htm);?>
<input type="submit" value="Открыть">
</form>
<?php } ?>
<?php
echo(new Action("scriptrename", array('htm'=>$htm)));
echo(new Action("scriptdell", array('htm'=>$htm)));
?>

<script>
document.getElementById("script").addEventListener("input", function(evt){
	var val=document.getElementById("script").value;
	document.getElementById("js").style.display="none";
	document.getElementById("php").style.display="none";
	document.getElementById("css").style.display="none";
	document.getElementById(val).style.display="";
}, false);
</script>
<?php
}
Page::footer();
?>