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
if(!isset($_GET['EL'])){
	$_GET['EL']="OFF";
}
txt('<a href="ini_set.php"><img src="/cms/pic/ini.png" title="Конфигурация" />---back---</a>');
if(Stats::can("error")){
	Action::e("protector");
?>
<h3><?php Locale::e('disable-secure-methods'); ?></h3>
<form action="protcl.php" method="POST">
<input type="hidden" name="page" value="/cms/error.php">
<p><input type="checkbox" name="salt" value="1"<?php if(!Salt::getA()){echo(" checked");} ?>><?php Locale::e('salt'); ?></p>
<p><input type="checkbox" name="locker" value="1"<?php if(!Locker::getA()){echo(" checked");} ?>><?php Locale::e('locker'); ?></p>
<p><input type="checkbox" name="counter" value="1"<?php if(!Counter::getA()){echo(" checked");} ?>><?php Locale::e('counter'); ?></p>
<input type="submit" value="<?php Locale::e("apply"); ?>">
</form>
<?php
$statusloga=Loc::get('error');
$statusloga=explode(':', $statusloga);
$statusloga[1]=$statusloga[1]/1024;
$statusloga[1]=round($statusloga[1]);
$ar=unserialize(Locale::get("elog-statuses"));
$statusloga[0]=$ar[$statusloga[0]];
$statusloga=$statusloga[0].". ".Locale::get('size').": ".$statusloga[1]."КБ.";
$mode=Loc::get("elogmaxsize");
if($mode==null){
	$mode="empty";
}
?>
<h2 style="margin-top: 0;"><?php Locale::e("status-loga"); ?>: <?php echo($statusloga);?></h2>
<?php
Action::e("logsize", $mode);
if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/error_log.php")){
Action::e("elogclear");
?>
<h3>Просмотреть лог</h3>
<form action="?" method="GET">
<?php if((isset($_GET['EL']))and($_GET['EL']!="ON")){ ?>
<input type="hidden" name="EL" value="ON">
<input type="checkbox" name="kras" value="ON" checked><?php Locale::e('easy-read-style'); ?>
<br>
<input type="submit" value="Показать">
<?php }else{ ?>
<input type="hidden" name="EL" value="OFF">
<input type="submit" value="Скрыть">
<?php } ?>
</form>
<?php } ?>
<?php
if((isset($_GET['EL']))and($_GET['EL']=="ON")and(file_exists("error_log.php"))){
	$log=file("error_log.php");
	$htm='<table>';
	$htm.="<tr><th>№</th><th>Тип</th><th>Описание</th><th>Действия</th></tr>";
	foreach($log as $n=>$line){
		$line=trim($line);
		$line=explode("]", $line);
		$type=substr($line[0], 1);
		unset($line[0]);
		$line=implode("[", $line);
		$line=preg_replace('@  +@', ' ', trim($line));
		if(isset($_GET['kras'])and($_GET['kras']=="ON")){
			switch($type){
				case "HACKER ATTACK":
				$type='<big style="color: red;"><big>Хакерская атака</big></big>';
				$line=preg_replace("@from: ?(.*), ?to: ?(.*), ?in: ?(.*)@ui", 'От:&nbsp;"\\1"<br>К:&nbsp;"\\2"<br>В(Ч:М:С&nbsp;Д:М:Г):&nbsp;\\3', $line);
				break;
				case "USER ATTACK":
				$type='<big style="color: red;"><big>Предательство</big></big>';
				$line=preg_replace("@action: ?(.*), ?name: ?(.*), ?in: ?(.*)@ui", 'Действие:&nbsp;"\\1"<br>Имя:&nbsp;"\\2"<br>В(Ч:М:С&nbsp;Д:М:Г):&nbsp;\\3', $line);
				break;
				case "DATA_BASE_ERROR":
				$type='<big style="color: red;"><big>Ошибка баз данных</big></big>';
				$line=preg_replace("@base: ?(.*); ?name: ?(.*), ?in: ?(.*)@ui", 'База:&nbsp;"\\1"<br>Параметры:&nbsp;[\\2]<br>В(Ч:М:С&nbsp;Д:М:Г):&nbsp;\\3', $line);
				break;
				case "PHP ERROR":
				$type='<big style="color: red;"><big>PHP Ошибка</big></big>';
				$line=preg_replace("@code: ?(.*), ?msg: ?(.*), ?in: ?(.*)@ui", 'Код:&nbsp;"\\1"<br>Сообщение:&nbsp;"\\2"<br>В(Ч:М:С&nbsp;Д:М:Г):&nbsp;\\3', $line);
				break;
				default:
				$type='<big style="color: red;"><big>Неизвестная ошибка</big></big>';
				break;
			}
		}
		$form=new Action("elogdeln", $n);
		$htm.="<tr><td>$n</td><td style=\"white-space: pre;\">$type</td><td style=\"white-space: pre;\">$line</td><td>$form</td></tr>";
	}
	$htm.="</table>";
	echo($htm);
}
}
Page::footer();
?>
