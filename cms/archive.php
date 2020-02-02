<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
Page::CMS();
txt('<a href="ini_set.php"><img src="/cms/pic/ini.png" style="vertical-align: middle;" />---back---</a>');
if(Stats::can("archive")){
	if(Stats::can("obnov") and (isset($_GET['obnovlenie'])) and ($_GET['obnovlenie']=='ON')){
		echo('<p>Инструкция по обновлению:<ol><li>Желательно заархивировать текущею версию CMS Leonid для возможности дальнейшего отката</li><li>Запустить обновление');
		Action::e('jobnov', array('url'=>$_GET['url'], 'version'=>$_GET['version']));
		echo('</li></ol></p>');
	}
	Action::e('archive');
	Action::e('archiveN');
	Action::e("delarchive");
}
Action::e('unarchive');
Page::footer();?>