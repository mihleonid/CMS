<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
Page::CMS();
txt('<a href="admin.php"><img src="/cms/pic/main.png" title="---home---" />---back---</a>');
if(Stats::can('status')){
Action::e("stat");
?>
<form action="action.php" style="display: none;" id="hid" method="POST">
<?php
echo(Form::Sheader());
?>
<input type="hidden" name="tsel" id="hidoa" value="stat">
<input type="hidden" name="ststu" id="hido" value="">
<input type="hidden" name="page" value="table.php">
</form>
<table style="margin-top: 4px;">
<tr><th colspan="4"><?php l('status-management'); ?></th></tr>
<tr><th><?php l('status'); ?></th><th><?php l('localized-name'); ?></th><th><?php l('change'); ?></th><th><?php l('delete'); ?></th></tr>
<?php
$mydb=new \LCMS\MainModules\D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablei.tdb");
$myall=$mydb->get_all();
foreach($myall as $keym=>$linem){
	$ism=new Action("edittextstat", array('keym'=>($keym), 'linem'=>($linem)));
	echo("<tr><td>$keym</td><td>$linem</td><td style=\"width: max-content;\">$ism</td><td>");
	Action::e("delstat", $keym);
	echo("</td></tr>");
}
?>
</table>
<?php
Action::e("addstat");
if((Users::isClever())){
	txt('---debug---: <a href="prav.php">---permission-management---</a>');
}
}
Page::footer();?>