<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
Page::CMS();
txt('<a href="archive.php">---back---</a>');
?>
<h3>Список файлов, которые отсутствуют в списке всех файлов и папок не пуст</h3>
<p>Выполните любое следующее действие (или несколько)</p>
<ul>
<?php if(Stats::can('feedback')){ ?>
<li><a href="feedback.php">Написать разработчику</a></li>
<?php }if(Stats::can('obnov')){ ?>
<li><a href="about.php">Обновить CMS</a></li>
<?php }if(Stats::can('unarchive')){ ?>
<li><a href="archive.php">Вернутся к какому-то архиву</a></li>
<?php }if($GLOBALS['AUTH'][2]!='globaladmin'){ ?>
<li>Обратиться к суперадминистратору CMS</li>
<?php } ?>
</ul>
<?php Page::footer(); ?>