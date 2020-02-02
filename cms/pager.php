<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Patterns\Part;
use \LCMS\Core\Enviroment\Loc;
Page::CMS("<link rel=\"stylesheet\" href=\"/cms/window.css\" type=\"text/css\">");
?>
<div class="closer"></div>
<div class="window" style="display: inline-block;"><div class="panel"><div class="exit" onclick="window.history.back();">X</div></div><div class="caption">Проверьте данные и заполните поля шаблона</div>
<div class="container">
<form action="action.php" style="text-align: left; display: inline-block;" method="POST" enctype="multipart/form-data" >
<?php
echo Form::SHeader();
?>
<input type="hidden" name="tsel" value="pageaddedit">
<input type="hidden" name="page" value="<?php echo($_POST['page']);?>">
<input type="hidden" name="text" value="<?php echo(htmlchars($_POST['text']));?>">
<?php
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Путь: <input type="text" name="namep" pattern="[a-zA-Z/]+" value="<?php echo(htmlchars(Page::clearPath($_POST['namep'])));?>" required disabled readonly>
<br>
<?php
//var_dump($_POST);
if(isset($_POST['DATA'])){
	$DATA=Page::strtodata($_POST['DATA']);
}else{
	$DATA=array();
}
$tmps=$_POST['s'];
if($tmps=="<default>"){
	$tmps="<Шаблон по умолчанию>";
}
if($tmps=="<noPattern>"){
	$tmps="Без шаблона";
}
?>
Шаблон: <input type="text" name="s" value="<?php echo(htmlchars($tmps));?>" required disabled readonly>
<br>
<?php
$nameinlist=preg_replace("@[^а-яА-Яёa-zA-Z1-90 ,\.\?]@u", "", $_POST['nameinlist']);
if($nameinlist==""){
	$nameinlist="Нет имени";
}
?>
Имя в списке: <input type="text" name="nameinlist" value="<?php echo(htmlchars($nameinlist)); ?>" required disabled readonly>
<br>
<?php
$kat=$_POST['kat'];
if(!( \LCMS\Core\Pages\Category::exists($kat))){
	$kat="_no";
}
?>
Категория: <input type="text" name="kat" value="<?php echo(htmlchars((($kat=="_no")?("<Без категории>"):($kat))));?>" required disabled readonly>
<input type="hidden" name="kat" value="<?php echo(htmlchars($kat));?>">
<input type="hidden" name="nameinlist" value="<?php echo(htmlchars($nameinlist));?>">
<?php
$_POST['namep']=Page::clearPath($_POST['namep']);
?>
<input type="hidden" name="namep" value="<?php echo(htmlchars($_POST['namep']));?>">
<input type="hidden" name="s" value="<?php echo(htmlchars($_POST['s']));?>">
<br>
<?php
$s=( \LCMS\Core\Patterns\Pattern::getReal($_POST['s']));
$s=$s['patttab'];
$s=explode("\n", $s);
foreach($s as $k=>$line){
	$line=trim($line);
	if(empty($line)){
		continue;
	}
	$linet=strtolower($line);
	if(($linet=='end') or ($linet=='exit') or ($linet=='конец')){
		break;
	}
	$line=explode("|", $line);
	if(!isset($line[1])){
		continue;
	}
	if(!isset($line[2])){
		$line[2]="Свойство №".$k;
	}
	if(!isset($line[3])){
		$line[3]="";
	}
	if(!isset($line[4])){
		$line[4]="";
	}
	if(!isset($line[5])){
		$line[5]="";
	}
	if(isset($DATA[$line[1]])){
		$val=$DATA[$line[1]];
	}else{
		$val=$line[4];
	}
	$val=CMS::htmlchars($val);
	switch(strtolower($line[0])){
		default:
		case "text":
			echo('<div style="display: inline-block;">'.CMS::htmlchars($line[2]).':<input type="text" name="data['.str_replace("[", "", str_replace("]", "", htmlchars($line[1]))).']" placeholder="'.CMS::htmlchars($line[3]).'" value="'.$val.'"'.((strtolower($line[5])=="on")?('required'):('')).'></div><br>');
		break;
	}
}
?>
<?php
$path=Page::clearPath($_POST['namep']);
if((file_exists($_SERVER['DOCUMENT_ROOT'].$path) and \LCMS\Core\Users\Stats::can("pageedit"))or((!(file_exists($_SERVER['DOCUMENT_ROOT'].$path))) and Stats::can("pageadd"))){
?>
<input type="submit" style="padding: 10px;" value="<?php echo($_POST['submit']);?>">
<?php }else{ ?>
<h1 style="text-align: center; color: red;">У вас нет прав на выполнение этого действия</h1>
<?php } ?>
</form>
</div></div>
<?php
Page::footer();?>