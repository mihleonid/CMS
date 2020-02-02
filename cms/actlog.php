<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Users\Users;
Page::CMS();
txt('<a href="admin.php"><img src="/cms/pic/main.png" title="Главная" />---back---</a>');
if(Stats::can($GLOBALS['AUTH'][2], "actlog")){?>
<h2>Лог действий</h2>
<table>
<tr><th>Дата и время</th><th>Пользователь</th><th>Действие</th></tr>
<?php
foreach(file("actions.log") as $l){
	$l=trim($l);
	if($l==""){
		continue;
	}
	$l=explode('|', $l);
	$l[0]=htmlchars($l[0]);
	$l[1]=htmlchars($l[1]);
	$l[2]=htmlchars($l[2]);
	echo("<tr><td>".$l[0]."</td><td>".((Users::exists($l[1]))?('<a href="admin.php#'.$l[1].'">'.$l[1].'</a>'):($l[1]))."</td><td>".$l[2]."</td></tr>");
}
?>
</table>
<?php } ?>
<?php
echo(new Action("clactlog"));
?>
<?php
Page::footer();?>