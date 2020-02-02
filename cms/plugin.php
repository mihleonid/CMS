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
$dir=dir($_SERVER['DOCUMENT_ROOT']."/cms/moduls/plugins/");
$htm="<select name=\"pack\" required>";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$entryi=pathinfo($entry);
		$entryi=$entryi['filename'];
		$htm.="<option value=\"$entryi\">$entryi</option>";
	}
}
$htm.="</select>";
echo(new Action("plugins", array('htm'=>$htm)));
echo(new Action("plugdel", array('htm'=>$htm)));
echo(new Action("plugadd"));
echo(new Action("plugun", array('htm'=> \LCMS\Core\Modules\Plugins::getInstalledHTML())));
echo(new Action("plugobnov"));
Page::footer();
?>