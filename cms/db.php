<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
use \LCMS\MainModules\D_BASE;
Page::CMS();
txt('<a href="ini_set.php"><img src="/cms/pic/ini.png" title="Конфигурация" />---back---</a>');
Action::e("dbt");
if( \LCMS\Core\Modules\Plugins::isInstalled("file")){
	Action::e("dbp");
}
Action::e("dbm");
Action::e("obnp", array('new'=>Loc::get("new")));
Action::e("magazp", array('new'=>Loc::get("magaz")));
Action::e("adminpathismen", array('new'=>Loc::get("adminpath")));
Action::e("vers", array('new'=>Loc::get("version")));
Action::e("time", array('new'=>Loc::get("timezone")));
Action::e("acclear");
Action::e("zzz", array('new'=>Loc::get("step")));
Page::footer();
?>