<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
Page::CMS();
txt('<a href="page.php"><img src="/cms/pic/page.png" title="Страницы" />---back---</a>');
if(Stats::can('pagelog')){
echo('<h3>Лог</h3><table><tr><th>Полный путь</th><th>Имя</th><th>Действие</th><th>Успешно</th></tr>');
$cont=0;
$fi=file("page_log.db");
foreach($fi as $f){
	echo"<tr>";
	$ex=explode("|", trim($f));
	$i=0;
	foreach($ex as $e){
		if($i==0){
			echo"<td><a href=\"$e\">$e</a></td>";
		}elseif($i==1){
			echo"<td><a href=\"admin.php#$e\">$e</a></td>";
		}else{
			echo"<td>$e</td>";
		}
		$i++;
	}
	echo"</tr>";
	$cont++;
}
echo('</table>');
Action::e('clean_log', $cont);
}
Page::footer();?>