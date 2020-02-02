<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
Page::CMS();
txt('<a href="about.php"><img src="/cms/pic/cmslmini.png" title="Главная" />---back---</a>');
Action::e("feed");
if(Stats::can("enter")){?>
<h3>Получить статическую справку</h3>
<form action="help.php" method="GET">
<input type="submit" value="Получить справку">
</form>
<?php
}
Page::footer();
?>