<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Enviroment\Loc;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\MainModules\D_BASE;
Page::CMS();
txt('<a href="shabl.php"><img src="/cms/pic/pattern.png" title="Шаблон" />---back---</a>');
Action::e("light", array('srr'=>Loc::get('highlight')));
Action::e("autowid", array('val'=>(((Loc::get("autowid")==" checked")?(""):("allow"))), 'yn'=>(((Loc::get("autowid")==" checked")?("yes"):("no")))));
if(Loc::get("autowid")==" checked"){
	echo(new Action("delay", array('val'=>Loc::get("delay"))));
}
Page::footer();?>