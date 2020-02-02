<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
Page::CMS();
function download($path){
	$path.="?tsel=down";
	file_put_contents($_SERVER['DOCUMENT_ROOT'].'/cms/tmp/help.zip', file_get_contents($path));
	$zip = new ZipArchive();
	$zip->open($_SERVER['DOCUMENT_ROOT'].'/cms/tmp/help.zip');
	$zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/cms/mane/');
	$zip->close();
	unlink($_SERVER['DOCUMENT_ROOT'].'/cms/tmp/help.zip');
}
if( \LCMS\Core\Users\Stats::can("enter")){
	$path= \LCMS\Core\Enviroment\Loc::get("adminpath");
	$h= @get_headers($path."?tsel=connected");
	if(strpos($h[0], '200')){
		if(file_exists($_SERVER['DOCUMENT_ROOT'].'/cms/mane/I.php')){
			if(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/cms/mane/vbn.int')<file_get_contents($path.="?tsel=version")){
				download($path);
			}else{
				$path="/cms/mane/I.php";
			}
		}else{
			download($path);
		}
		echo("<a href=\"feedback.php\" style=\"position: absolute;\">Назад</a><iframe width=\"1300\" id=\"i\" src=\"".htmlchars($path)."\"  height=\"700\"></iframe><script>document.getElementById('i').style.width=\"100%\";document.getElementById('i').style.border=\"0\";document.getElementById('i').style.height=\"calc(100% - 4px)\";document.getElementsByTagName('SECTION')[0].style.padding=\"0\";</script>");
	}else{
		echo('<a href="feedback.php">Назад</a><h2 style="color: red;">Ошибка получения данных</h2>');
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/mane/I.php")){
			echo("<iframe width=\"1300\" id=\"i\" src=\"".htmlchars("/cms/mane/I.php")."\"  height=\"700\"></iframe><script>document.getElementById('i').style.width=\"100%\";document.getElementById('i').style.border=\"0\";document.getElementById('i').style.height=\"calc(100% - 4px)\";document.getElementsByTagName('SECTION')[0].style.padding=\"0\";</script>");
		}
	}
}
Page::footer();?>