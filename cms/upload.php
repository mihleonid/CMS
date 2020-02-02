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
if(Stats::can("gallery")){
	txt('<a href="gallery.php"><img src="/cms/pic/gallery.png" title="---gallery---" />---gallery---</a>');
}
echo(new Action("upload"));
Page::footer();
?>