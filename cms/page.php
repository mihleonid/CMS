<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Patterns\Part;
use \LCMS\Core\Enviroment\Loc;
Page::CMS('
<style>
#pross{
	padding: 10px;
	display: inline-block;
	width: auto;
	border: 3px double red;
	border-radius: 10px;
}
.obt{
	display: none;
}
</style>');
?>
<iframe src="textedit.php" id="FRAME" border="0" frameborder="0" style="border: 0; width: 100vw; height: 100vh; display: none;"></iframe>
<script>
var frame=document.getElementById('FRAME');
frame.frameBorder="";
frame.remove();
document.body.appendChild(frame);
function fileGet(){}
function SETTEXT(str){
	unedit();
	document.getElementById('text').value=str;
}
function edit(){
	document.getElementsByTagName("HEADER")[0].style.display="none";
	document.getElementsByTagName("NAV")[0].style.display="none";
	document.getElementsByTagName("SECTION")[0].style.display="none";
	document.getElementsByTagName("FOOTER")[0].style.display="none";
	frame.style.display="";
	htl();
}
function unedit(){
	document.getElementsByTagName("HEADER")[0].style.display="";
	document.getElementsByTagName("NAV")[0].style.display="";
	document.getElementsByTagName("SECTION")[0].style.display="";
	document.getElementsByTagName("FOOTER")[0].style.display="";
	frame.style.display="none";
}
var isH=false;
function htmle(){
	isH=true;
	document.getElementById("HTMLE").style.display="";
}
function uhtmle(){
	isH=false;
	document.getElementById("HTMLE").style.display="none";
}
function htmlpere(){
	if(isH){
		uhtmle();
	}else{
		htmle();
	}
}
function htl(){
	frame.contentWindow.frameBody.innerHTML=document.getElementById("text").value;
}
</script>
<a href="category.php"><img src="/cms/pic/category.png" title="Управление категориями" />Управление категориями</a>
<br>
<a href="tag.php"><img src="/cms/pic/tag.png" title="Управление тегами" />Управление тегами</a>
<br>
<a href="page_log.php"><img src="/cms/pic/list.png" title="Просмотреть лог" />Просмотреть лог</a>
<br>
<?php
if(isset($_GET['edit'])){
	$_GET['edit']= \LCMS\Core\Pages\Page::clearPath($_GET['edit']);
	$_GET['edit']=substr($_GET['edit'], 0, strlen($_GET['edit'])-4);
}
if(isset($_GET['kat'])and(empty($_GET['kat']))){
	unset($_GET['kat']);
}
?>
<div style="margin-bottom: 12px;">
<h3 style="margin-bottom: 0px;">Быстрый доступ к страницам.
<form action="?" style="display: inline-block;">
<?php
if(isset($_GET['edit'])){
	echo('<input type="hidden" name="edit" value="'.htmlchars($_GET['edit']).'">');
}
?>
Категория:
<select name="kat">
<option value=""><code>&lt;Закрыть&gt;</code></option>
<option value="_no"<?php echo(((isset($_GET['kat'])and($_GET['kat']=="_no"))?(' selected'):(''))); ?>><code>&lt;Без категории&gt;</code></option>
<?php
$all=\LCMS\Core\Pages\Category::getAll();
foreach($all as $val=>$vval){
	echo('<option value="'.$val.'"'.((isset($_GET['kat'])and($_GET['kat']==$val))?(' selected'):('')).'>'.$vval.'</option>');
}
?>
</select>
<input type="submit" value="Просмотреть">
</form>
</h3>
<?php
$tableflush="";
//file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/pages.db", serialize(array("/index.php" => array("Главная", "admin"))));
$db=unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/pages.db"));
$globalname="";
$dbn=array();
foreach($db as $name=>$line){
	if(!file_exists($_SERVER['DOCUMENT_ROOT'].$name)){
		continue;
	}
	$dbn[$name]=$line;
	if(isset($_GET['edit']) and ($name==($_GET['edit'].".php"))){
		if($globalname==""){
			$globalname=$line[0];
		}
	}
	if(!isset($line[2])){
		$line[2]="_no";
	}
	if(!isset($_GET['kat'])){
		continue;
	}
	if($line[2]!=$_GET['kat']){
		continue;
	}
	if( \LCMS\Core\Users\Users::exists($line[1])){
		$line[1]="<a href=\"admin.php#".$line[1]."\">".$line[1]."</a>";
	}
	$tableflush.=("<tr><td>".$line[0]."</td><td><a href=\"".$name."\">".$name."</a></td><td>".$line[1]."</td>");
	if($name==\LCMS\Core\Pages\Page::clearPath($name)){
		$del=new Action('pagedel', $name);
	$edit='
<form action="?" method="GET">
<input type="hidden" name="edit" value="'.$name.'">
<input type="submit" value="Редактировать">
</form>';
		$tableflush.=('<td>'.$del.'</td><td>'.$edit.'</td>');
	}else{
		$tableflush.=('<td colspan="2" style="color: red;">Недоступно</td>');
	}
	$tableflush.=("</tr>");
}
file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/pages.db", serialize($dbn));
if(isset($_GET['kat'])){
?>
<table style="background-color: rgba(200, 255, 200, 0.4);">
<tr><th rowspan="2">Название</th><th rowspan="2">Путь</th><th rowspan="2">Создатель</th><th colspan="2">действие</th></tr>
<tr><th><?php l('delete'); ?></th><th>Изменить</th></tr>
<?php echo($tableflush); ?>
</table>
<?php } ?>
</div>
<div style="margin-bottom: 12px;">
<h3 style="margin-bottom: 0px;">Сменить режим редактирования/создания</h3>
<?php if(isset($_GET['edit'])){ ?>
<form action="?" method="GET">
<?php
if(isset($_GET['kat'])){
	echo('<input type="hidden" name="kat" value="'.htmlchars($_GET['kat']).'">');
}
?>
<input type="submit" value="Создать">
</form>
<?php }else{ ?>
<form action="?" method="GET">
<?php
if(isset($_GET['kat'])){
	echo('<input type="hidden" name="kat" value="'.htmlchars($_GET['kat']).'">');
}
?>
<input type="text" name="edit" placeholder="<?php l('delete'); ?>">.php
<br>
<input type="submit" value="Редактировать">
</form>
<?php } ?>
</div>
<div style="margin-bottom: 12px;">
<h3 style="margin-bottom: 0px;"><?php echo((isset($_GET['edit']))?"Изменить":"Создать"); ?></h3>
<form action="pager.php" method="POST">
<input type="hidden" name="page" value="/cms/<?php echo(htmlchars((isset($_GET['edit']))?("page.php?edit=".urlencode($_GET['edit'])):("page.php")));?>">
<input type="text" name="namep"<?php echo((isset($_GET['edit']))?(" value=\"".htmlchars($_GET['edit'])."\" disabled readonly"):(" placeholder=\"Имя\"")); ?> pattern="[a-zA-Z/]+" required>.php
<?php
if(isset($_GET['edit'])){
	echo('<input type="hidden" name="namep" value="'.$_GET['edit'].'" pattttern="[a-zA-Z/]+" required>');
}
?>
<br><?php
$content="";
if(isset($_GET['edit'])){
$file=$_SERVER['DOCUMENT_ROOT']. \LCMS\Core\Pages\Page::clearPath($_GET['edit']);
if(file_exists($file)){
	$content=file($file);
	$con=false;
	$shokdata=false;
	$shokpatt=false;
	$DATA="";
	$PATT="";
	$contentn="";
	foreach($content as $line){
		$line=trim($line);
		if($con){
			$contentn.=$line."\r\n";
		}else{
			if($line=="/*DATASET*/"){
				$shokdata=true;
				continue;
			}
			if($shokdata){
				$shokdata=false;
				$DATA=substr($line, 7);//5:"$DATA" + 1:"=" + 1:\"
				$DATA=substr($DATA, 0, strlen($DATA)-2);//0 - 1:";" - 1:\"
				$DATA=str_replace("\\\"", "\"", $DATA);
				continue;
			}
			if($line=="/*PATTERN*/"){
				$shokpatt=true;
				continue;
			}
			if($shokpatt){
				$shokpatt=false;
				$PATT=substr($line, 4);//2:"$s" + 1:"=" + 1:\"
				$PATT=substr($PATT, 0, strlen($PATT)-2);//0 - 1:";" - 1:\"
				$PATT=str_replace("\\\"", "\"", $PATT);
				continue;
			}
			if($line=="/*START_CONTENTS*/ ?>"){
				$con=true;
			}
		}
	}
	$content=htmlchars($contentn);
	unset($contentn);
}
}?>
Шаблон:<?php
$string= \LCMS\Core\Patterns\Pattern::getall(null, false, ((isset($PATT))?($PATT):("<default>")), true, true, true, "gsht");
echo($string[1]);
?>
<br>
Имя в списке: <input type="text" name="nameinlist" pattern="[а-яА-Яёa-zA-Z1-90 ,\.\?]+" value="<?php echo($globalname); ?>" placeholder="Название" required>
<br>
Категория:
<select name="kat">
<option value="_no"<?php echo(((isset($_GET['kat'])and($_GET['kat']=="_no"))?(' selected'):(''))); ?>><code>&lt;Без категории&gt;</code></option>
<?php
$all= \LCMS\Core\Pages\Category::getAll();
foreach($all as $val=>$vval){
	echo('<option value="'.$val.'"'.((isset($_GET['kat'])and($_GET['kat']==$val))?(' selected'):('')).'>'.$vval.'</option>');
}
?>
</select>
<div id="HTMLE" style="display: none;">
<div id="panel" style="display: inline-block; border: 1px solid red;">
<?php
$part=Part::getPanel();
getpanel:;
if($part!="<AUTO>"){
	$partt=Part::get($part);
	if($partt==null){
		$part="<AUTO>";
		goto getpanel;
	}else{
		echo($partt);
	}
}else{
	$arr=Loc::get("tag");
	if($arr==null){
		echo('<big style="color: red;">Список тегов потерян</big>');
	}else{
		foreach($arr as $tag=>$tmp){
			echo "<input type=\"button\" value=\"$tag\"><span class=\"obt\">$tag</span>";
		}
	}
}?>
</div>
<br>
<textarea name="text" onchange="htl();" id="text"<?php echo(((isset($_GET['edit']))and(!file_exists($file)))?"style=\"font-size: 19pt; color: red;\" disabled":' style="background-color: #ccddff; color: #000060; font-size: 17pt; width: 700px; height: 300px;"'); ?> required><?php echo(((isset($_GET['edit']))and(!file_exists($file)))?"Страницы несуществует!":$content); ?></textarea>
</div>
<?php if(((isset($_GET['edit']))and(file_exists($file)))or(!isset($_GET['edit']))){ ?>
<div>
<h5 style="margin-bottom: 0px;">Редактируйте страницу</h5>
<input type="button" value="Редактировать визуально" onclick="edit();">
<input type="button" value="Редактировать HTML" onclick="htmlpere();">
</div>
<input type="button" value="Просмотр" id="pros">
<br>
<div style="display: none;" id="pross"></div>
<br>
<?php if(isset($_GET['edit'])){ ?>
<input type="hidden" name="DATA" value="<?php plain($DATA); ?>">
<?php } ?>
<input type="submit" style="padding: 10px;" name="submit" value="<?php echo ((isset($_GET['edit']))?"Изменить":"Создать");?>">
<?php }else{ ?>
<div>
<h3 style="color: red;">Страницы не существует</h3>
</div>
<?php } ?>
</form>
</div>
<?php if(Stats::can("pagedel")){?>
<h3 style="vertical-align: middle;"><div style="display: inline-block; padding: 6px 15px 7px 0px;" onclick="dela()"><img src="/cms/pic/flagsbottom.png" id="dela" style="vertical-align: middle;"><?php l('delete'); ?></div></h3>
<div id="del" style="display: none;">
<div style="margin-bottom: 12px;">
<?php
Action::e('simplefdel');
?>
</div>
<div style="margin-bottom: 12px;">
<?php
Action::e('papdel');
?>
</div>
<div style="margin-bottom: 12px;">
<?php
Action::e('papdelall');
?>
</div>
</div>
</div>
<?php }?>
<script>
var delaw=false;
function dela(){
	if(delaw){
		document.getElementById('dela').src="/cms/pic/flagsbottom.png";
		document.getElementById('del').style.display="none";
	}else{
		document.getElementById('dela').src="/cms/pic/flagstop.png";
		document.getElementById('del').style.display="block";
	}
	delaw=!delaw;
};
var text=document.getElementById("text");
document.getElementById("panel").addEventListener("click", function(evt){
	if(evt.target.value!=undefined){
		var s=text.value.substring(0, text.selectionStart);
		if(text.selectionStart!=text.selectionEnd){
			var s=s+"<"+evt.target.value+">";
			var s=s+text.value.substring(text.selectionStart, text.selectionEnd);
			var s=s+"</"+evt.target.value+">";
		}else{
			var s=s+"<"+evt.target.value+"></"+evt.target.value+">";
		}
		var s=s+text.value.substring(text.selectionEnd, text.value.lengh);
		text.value=s;
	}
}, false);
document.getElementById("pros").addEventListener("click", function(evt){
	if(document.getElementById("pross").innerHTML!=text.value){
		var mytext=text.value;
		mytext=mytext.replace(/</g, "&lt;");
		mytext=mytext.replace(/>/g, "&gt;");
		var collect=document.getElementsByClassName('obt');
		for(col in collect){
			if(collect[col].innerHTML!=undefined){
			var reg=new RegExp("&lt;(/?"+collect[col].innerHTML+".*?)&gt;", "g");
			mytext=mytext.replace(reg, "<$1>");
			}
		}
		document.getElementById("pross").innerHTML=mytext;
	}else{
		document.getElementById("pross").innerHTML="";
	}
	if(document.getElementById("pross").innerHTML.trim()==""){
		document.getElementById("pross").style.display="none";
	}else{
		document.getElementById("pross").style.display="";
	}
}, false);
function chPatt(){
	frame.contentWindow.patternCheangeTwo();
}
document.getElementById('gsht').addEventListener("change", chPatt, false);
window.setTimeout(chPatt, 2000);
</script>
<?php
Page::footer();?>