<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Patterns\Part;
use \LCMS\Core\Enviroment\Loc;
Page::CMS();
txt('<a href="page.php"><img src="/cms/pic/page.png" title="Страницы" />---back---</a>');
if(Stats::can("category")){?>
<table>
<tr><th>Категория</th><th>Описание</th><th>Сменить описание</th><th>Удалить</th></tr>
<tr><td><code>&lt;Нет&gt;</code></td><td>&lt;Без категории&gt;</td><td colspan="2">Недоступно</td></tr>
<?php
$a= \LCMS\Core\Pages\Category::getAll();
foreach($a as $k=>$v){
	$edit=new Action('category_edit', array('k'=>$k, 'v'=>$v));
	$del=new Action('category_del', $k);
	echo("<tr><td>$k</td><td>$v</td><td>$edit</td><td>$del</td></tr>");
}
?>
<tr><td>Новая</td>
<td colspan="3">
<?php
Action::e('category_add');
?>
</td>
</tr>
</table>
<?php }?>
<?php
Page::footer();?>