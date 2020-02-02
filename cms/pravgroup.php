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
if(Stats::can("stats")){
echo('<a href="prav.php">Назад</a>
<h3>Управление группами прав</h3>
<table>
<tr><th>Группа</th><th>Русское название группы</th><th>Изменение</th><th>Удаление</th></tr>');
$mydb=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablegroup.tdb");
$myall=$mydb->get_all();
foreach($myall as $keym=>$linem){
	$ism=(new Action("edittextpravg", array('keym'=>$keym, 'linem'=>$linem[1]))).'</td><td>'.(new Action("delpravg", array('keym'=>$keym)));
	echo("<tr><td>$keym</td><td>".$linem[1]."</td><td style=\"width: max-content;\">$ism</td></tr>");
}
echo("</table>");
echo(new Action("addpravg"));
}
Page::footer();
?>