<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
Page::CMS();
if(Stats::can("phpinfo")){
// echo'<style>a{text-decoration: none !important;}</style><big><a href="env.php" style="font-size: 34pt;">Назад</a></big>';
// echo"<big><big>";
txt('<a style="position: fixed;" href="env.php"><img src="/cms/pic/var.png" title="Переменные окружения" />---back---</a>');
//ob_end_flush();
ob_start();
phpinfo();
$a=ob_get_contents();
ob_end_clean();
$a=str_replace('background-color: #ffffff;', 'background-color: transparent;', $a);
$a=addcslashes($a, "\r\n\"'\\");
// echo($a);
echo("<iframe id=\"i\" width=\"1300\" height=\"700\"></iframe><script>document.getElementById('i').srcdoc=\"$a\";window.setTimeout(function(){document.getElementById('i').contentDocument.body.style.backgroundColor=\"transparent\";}, 2584);window.setTimeout(function(){document.getElementById('i').contentDocument.body.style.backgroundColor=\"transparent\";}, 500);document.getElementById('i').style.width=\"100%\";document.getElementById('i').style.border=\"0\";document.getElementById('i').style.height=\"calc(100% - 4px)\";document.getElementsByTagName('SECTION')[0].style.padding=\"0\";</script>");
// echo"</big></big>";
// echo"<style>img{float: none;} a:link{color: #7766ee;} a, header{font-family: serif;}</style>";
}
Page::footer();
?>