<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\MainModules\D_BASE;
Page::CMS();
txt('<a href="table.php">---back---</a>');
if(trim($GLOBALS['AUTH'][2])=="globaladmin"){ #todo do?>
<h3><?php l('permission-management'); ?></h3>
<table style="width: -webkit-fill-available;">
<tr><th><?php l('permission'); ?></th><th><?php l('localized-name'); ?></th><th><?php l('change'); ?></th><th><?php l('delete'); ?></th></tr>
<?php
$mydb=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablesi.tdb");
$dbt=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablegroup.tdb");
$myall=$mydb->get_all();
$allt=$dbt->get_all();
$alltext="<select name=\"group\">";
$alltext.='<option value="_NOGROUP">&lt;'.l('no-category', true).'&gt;</option>';
foreach($allt as $laal){
	$alltext.="<option value=\"".$laal[0]."\">".$laal[1]."</option>";
}
$alltext.="</select>";
function alltext($r, $allt){
	$aalltext="<select name=\"group\">";
	$aalltext.="<option value=\"_NOGROUP\">&lt;Без категории&gt;</option>";
	foreach($allt as $laal){
		$aalltext.="<option value=\"".$laal[0]."\"".(($r[1]==$laal[0])?(' selected'):('')).">".$laal[1]."</option>";
	}
	$aalltext.="</select>";
	return $aalltext;
}
foreach($myall as $keym=>$linem){
$at=alltext($linem, $allt);
$ism=new Action("edittextprav", array('at'=>$at, 'keym'=>$keym, 'linem0'=>$linem[0])).'
</td><td style="padding-right: 40px;">
'. new Action("delprav", array('keym'=>$keym));
	echo("<tr><td>$keym</td><td>".$linem[0]."</td><td style=\"width: max-content;\">$ism</td></tr>");
}
?>
</table>
<a href="pravgroup.php">Изменение групп</a>
<?php
Action::e('addprav', array('alltext'=>'"'.addslashes($alltext).'"'));
}
Page::footer();
?>