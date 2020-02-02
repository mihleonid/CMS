<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Enviroment\CMSEnv;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Users\Statst;
Page::CMS();
txt('<a href="admin.php"><img src="/cms/pic/main.png" title="Главная" />---back---</a>');
?>
<br>
<?php if(Stats::can(array("feedback", "enter"))){ ?>
<a href="feedback.php">Связь с разработчиком</a>
<br>
<?php } ?>
<div style="font-size: 20pt;">
<?php if(Stats::can("logo")){ ?>
<!--[if IE]>Внимание! При просмотре страниц CMS в старых браузерах, таких как InternetExplorer могут возникать ошибки отображения. <!--[if IE]>Внимание! ваш браузер очень стар!<br /><![endif]--><!--[endif]-->
<div id="OLDbrowser" style="display: none;">
<span style="color: red;"><big><big><big>Ваш браузер устарел!</big></big></big></span>
</div>
<script>
if(window.navigator.appName!="Netscape"){
	document.getElementById("OLDbrowser").style.display="block";
}
</script>
Версия CMS: <b><?php echo CMSEnv::getVersion();?></b>
<br>
<img src="/cms/pic/CMS-Leonid.png"></img>
<br>
<?php }
Action::e('obnov');
echo('</div>');
Action::e("speed");
Action::e("cache");
Page::footer();?>