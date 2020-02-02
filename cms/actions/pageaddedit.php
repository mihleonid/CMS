<PRE>
pageadd,pageedit
</PRE>
<ACTION>
<?php
use \LCMS\MainModules\TagStripper;
$path= \LCMS\Core\Pages\Page::clearPath($_POST['namep']);
if((file_exists($_SERVER['DOCUMENT_ROOT'].$path) and \LCMS\Core\Users\Stats::can("pageedit"))or((!(file_exists($_SERVER['DOCUMENT_ROOT'].$path))) and \LCMS\Core\Users\Stats::can("pageadd"))){
	$nameinlist=trim(preg_replace("@[^а-яА-Яёa-zA-Z1-90 ,\.\?]@u", "", $_POST['nameinlist']), ' ');
	if($nameinlist==""){
		$nameinlist="Нет имени";
	}
	$kat=$_POST['kat'];
	if(!( \LCMS\Core\Pages\Category::exists($kat))){
		$kat="_no";
	}
	$s=$_POST['s'];
	$s=preg_replace('@[^a-zA-Z\<\>]@', '', $s);
	$DATA='';
	if(isset($_POST['data'])){
		$DATA=\LCMS\Core\Pages\Page::datatostr($_POST['data']);
	}
	$HTML=str_replace("</section>", "", $_POST['text']);
	$HTML=str_replace('<section class="IUNSET">', "", $HTML);
	if(!\LCMS\Core\Users\Stats::can("noecran")){
		$ts=new TagStripper(!(\LCMS\Core\Users\Stats::can("pagephp")), null, \LCMS\Core\Users\Stats::can("alltag"));
		$HTML=$ts->strip($HTML);
	}
	$HTML='<'.'?php
/*PATTERN*/
$s="'.$s.'";
/*DATASET*/
$DATA="'.$DATA.'";
$USER="'.$GLOBALS['AUTH'][0].'";
include_once $_SERVER[\'DOCUMENT_ROOT\']."/cms/cmsinclude.php";
\LCMS\Core\Pages\Page::Site($s, $USER, $DATA);
/*START_CONTENTS*/ ?'.'>
'.$HTML;
	if(file_exists($_SERVER['DOCUMENT_ROOT'].$path)){
		if( \LCMS\Core\Users\Stats::can("pageedit")){
			\LCMS\Core\Pages\PageLog::action($path, $GLOBALS['AUTH'][0], \LCMS\Core\Pages\PageLog::EDIT);
			\LCMS\Core\Pages\DB::addPageToList($path, $nameinlist, $GLOBALS['AUTH'][0], $kat);
			file_put_contents($_SERVER['DOCUMENT_ROOT'].$path, $HTML);
			return new Result();
		}else{
			\LCMS\Core\Pages\PageLog::action($path, $auf[0], \LCMS\Core\Pages\PageLog::EDIT, false);
			return new Result("У вас нет прав изменения страницы");
		}
	}else{
		if(\LCMS\Core\Users\Stats::can("pageadd")){
			\LCMS\Core\Pages\PageLog::action($path, $GLOBALS['AUTH'][0], \LCMS\Core\Pages\PageLog::ADD);
			\LCMS\Core\Pages\DB::addPageToList($path, $nameinlist, $GLOBALS['AUTH'][0], $kat);
			write_file($_SERVER['DOCUMENT_ROOT'].$path, $HTML);
			return new Result();
		}else{
			\LCMS\Core\Pages\PageLog::action($path, $GLOBALS['AUTH'][0], \LCMS\Core\Pages\PageLog::ADD, false);
			return new Result("У вас нет прав создания страницы");
		}
	}
}else{
	return new Result("У вас нет прав ни на изменение страницы ни на её создание");
}
?>
</ACTION>