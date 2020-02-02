<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
use \LCMS\Core\Security\Salt;
use \LCMS\Core\Security\Counter;
use \LCMS\Core\Security\Locker;
use \LCMS\Core\Enviroment\Locale;
Page::CMS();
txt('<a href="env.php"><img src="/cms/pic/var.png" title="Переменные окружения" />---back---</a>');
Loc::echoall();
Page::footer();
?>