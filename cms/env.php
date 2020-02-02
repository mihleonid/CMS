<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
Page::CMS();
txt('<a href="ini_set.php"><img src="/cms/pic/ini.png" title="Конфигурация" />---back---</a>');
if(Users::isClever()){
	txt('<br><a href="phpinfo.php"><img src="/cms/pic/phpinfo.png" title="Информация о PHP" />Информация о PHP</a>');
}
txt('<br><a href="func.php"><img src="/cms/pic/func.png" title="Сканер функциональности PHP" />Сканер функциональности PHP</a>
<br><a href="sloc.php"><img src="/cms/pic/loc.png" title="Переменные CMS" />Переменные CMS</a>');
if(Stats::can("env")){?>
<h3>Разделитель путей (<code>DIRECTORY_SEPARATOR</code>): <code><?php echo(DIRECTORY_SEPARATOR);?></code></h3>
<h3>Папка CMS (<code>__DIR__</code>): <code><?php echo(__DIR__);?></code></h3>
<h3>Версия (<code>PHP_VERSION</code>): <code><?php echo(PHP_VERSION);?></code></h3>
<h3>Операционная система (<code>PHP_OS</code>): <code><?php echo(PHP_OS);?></code></h3>
<h3>Переменные сервера (<code>$_SERVER</code>)</h3>
<table>
<tr>
<th>Параметр</th>
<th>Значение</th>
</tr>
<?php
foreach($_SERVER as $par=>$val){
	$par=data($par);
	$val=data($val);
	echo ("<tr><td>$par</td><td>$val</td></tr>");
}
?>
</table>
<?php if((isset($_ENV))and(is_array($_ENV))and(!(empty($_ENV)))){?>
<h3>Переменные окружения (<code>$_ENV</code>)</h3>
<table>
<tr>
<th>Параметр</th>
<th>Значение</th>
</tr>
<?php
foreach($_ENV as $par=>$val){
	$par=data($par);
	$val=data($val);
	echo ("<tr><td>$par</td><td>$val</td></tr>");
}
?>
</table>
<?php }?>
<?php
}
Page::footer();
?>