<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
Page::CMS('<style>
.fileimgclose{
	display: none;
}
.fileul{
	margin: 1px 0px;
	padding-left: 26px;
	list-style-type: none;
	display: none;
}
.check{
	vertical-align: middle;
}
</style>');
txt('<a href="page.php"><img src="/cms/pic/page.png" title="Страницы" />---back---</a><br>');
if(Users::isClever()){
	txt('---debug---:<a href="alltag.php">Все теги и атрибуты</a><br>');
}
Action::e("tagset");
Page::footer();?>