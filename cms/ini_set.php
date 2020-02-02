<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Enviroment\Loc;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\MainModules\D_BASE;
Page::CMS();
?>
<?php if((Users::isClever()) and Stats::can(array("zchange", "accclear", "timezone", "version", "setcpath", "setmagazp", "obnovpath", "mime", "extd", "exti"))){?>
<a href="db.php"><img src="/cms/pic/set.png" style="vertical-align: middle;"></img>Настройки баз данных и путей</a>
<br>
<?php } if(Stats::can(array("archive", "unarchive"))){ ?>
<a href="archive.php"><img src="/cms/pic/re.png" style="vertical-align: middle;"></img>Архивация и восстановление</a>
<br>
<?php } if(Stats::can("env")){?>
<a href="env.php"><img src="/cms/pic/var.png" title="Переменные окружения" />Переменные окружения</a>
<br>
<?php } ?>
<?php if(Stats::can("error")){ ?>
<a href="error.php"><img src="/cms/pic/error.png" style="vertical-align: middle;"></img>Управление ошибками и безопасность</a>
<?php } ?>
<?php echo(new Action("replaceclever", array('ne'=>((Users::isClever())?("не"):("")), 'd'=>((Users::isClever())?("down"):("up"))))); ?>
<?php if(Users::isClever()){?>
<?php if(Stats::can("ini")){ ?>
<h3>Текущее значение INI</h3>
<input type="button" value="<?php l('display'); ?>" style="display: none;" id="poc" onclick="window.location.assign('?show');">
<input type="button" value="<?php l('hide'); ?>" style="display: none;" id="poci" onclick="window.location.assign('?');">
<table id="tab" style="display: none; background-color: rgba(255, 255, 255, 0.85); border-radius: 10px;">
<?php
if(isset($_SERVER['argv'][0])and($_SERVER['argv'][0]=="show")){
	echo('<tr><th>');
	l('name');
	echo("</th><th>Глобальное значение</th><th>Локальное значение</th><th>Уровень доступа</th><th>Изменено</th></tr>");
	$ini=ini_get_all();
	foreach($ini as $key=>$i){
		echo"<tr><td>$key</td>";
		switch($i['access']){
			case 1:
			$i['access']="<span style=\"color: #aaffaa;\">скрипт</span>";
			break;
			case 2:
			$i['access']="<span style=\"color: #bbee99;\">htaccess</span>";
			break;
			case 3:
			$i['access']="<span style=\"color: #ccff88;\">htaccess и скрипт</span>";
			break;
			case 4:
			$i['access']="<span style=\"color: #ff6666;\">система</span>";
			break;
			case 5:
			$i['access']="<span style=\"color: #77ff77;\">система и скрипт</span>";
			break;
			case 6:
			$i['access']="<span style=\"color: #7777ee;\">система и htaccess</span>";
			break;
			case 7:
			$i['access']="<span style=\"color: #00ff00;\">полный</span>";
			break;
			default:
			$i['access']="<span style=\"color: #ff0000;\">другой</span>";
			break;
		}
		foreach($i as $ooo){
			echo"<td>$ooo</td>";
		}
		echo("<td>");
		if($i['global_value']==$i['local_value']){
			echo("<span style=\"color: #55bb55;\">");
			l('datatype.value.false');
			echo("</span>");
		}else{
			echo("<span style=\"color: #bb5555;\">");
			l('datatype.value.true');
			echo("</span>");
		}
		echo("</td></tr>");
	}
} ?>
</table>
<script>
if(window.location.search=="?show"){
	document.getElementById("tab").style.display="";
	document.getElementById("poci").style.display="";
}else{
	document.getElementById("poc").style.display="";
}
</script>
<?php } ?>
<?php
echo(new Action("inis"));
echo(new Action("htas"));
echo(new Action("htass"));
}
Page::footer();?>