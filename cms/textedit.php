<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Security\AntiXSS;
use \LCMS\Core\GUI\Web;
use \LCMS\Core\Enviroment\Loc;
AntiXSS::S();
AntiXSS::R();
Web::headerEncode();
if($GLOBALS['AUTH']!==false){
	$tag= \LCMS\Core\Pages\HTag::getAllowedTags();
	if( \LCMS\Core\Users\Stats::can("noecran")){
		$tag=2;
	}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Визуальный HTML редактор</title>
<link rel="icon" href="favicon.ico" type="image/x-ico">
<link rel="stylesheet" href="/cms/textedit.css" type="text/css">
<link rel="stylesheet" href="/cms/window.css" type="text/css">
<script src="ICookie.js"></script>
<script src="window.js"></script>
<script>
var HTML=false;
function setDocMode(htmlEdit) {
	if(htmlEdit){
		frameBody.style.fontFamily="monospace";
		frameBody.style.fontSize="12pt";
		frameBody.textContent=frameBody.innerHTML;
		document.getElementById('panel').style.display="none";
		document.getElementById('v').style.display="none";
<?php
if(($tag===2)or(isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
		document.getElementById('cn').style.display="none";
		document.getElementById('ranged').style.display="none";
<?php } ?>
		document.getElementById('htmlB').style.backgroundImage="linear-gradient(to bottom, gray, white)";
		HTML=true;
	}else{
		frameBody.style.fontFamily="";
		frameBody.style.fontSize="";
		frameBody.innerHTML=frameBody.textContent;
		document.getElementById('panel').style.display="inline-block";
		document.getElementById('v').style.display="inline-block";
<?php
if(($tag===2)or(isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
		document.getElementById('ranged').style.display="";
		document.getElementById('cn').style.display="";
<?php } ?>
		document.getElementById('htmlB').style.backgroundImage="";
		HTML=false;
		state();
	}
}
function setDocModeM(){
	setDocMode(!HTML);
}
</script>
<?php
//if(isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style'])){
?>
<script>
function pol(){
	document.getElementById("r").value=document.getElementById("polr").value;
	document.getElementById("g").value=document.getElementById("polg").value;
	document.getElementById("b").value=document.getElementById("polb").value;
	document.getElementById("a").value=document.getElementById("pola").value;
	costr();
}
function costr(){
	try{
	var ccn=document.getElementById("cn").getContext("2d");
	ccn.fillStyle="#bbbbcc";
	ccn.fillRect(0, 0, 50, 50);
	ccn.fillStyle="darkred";
	ccn.textAlign="center";
	ccn.textBaseline="middle";
	try{
		ccn.font="normal 29pt Arial";
	}catch(Exception){
		ccn.font="29px Arial";
	}
	ccn.fillText("ALFA", 25, 25, 50);
	ccn.fillStyle="rgba("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+", "+((127 - document.getElementById("a").value) / 127)+")";
	ccn.fillRect(0, 0, 50, 50);
	/*if((document.getElementById("r").value=="0") && (document.getElementById("g").value=="0") && (document.getElementById("b").value=="0") && (document.getElementById("a").value=="127")){
		ccn.fillStyle=alfa;
		ccn.fillRect(0, 0, 50, 50);
	}*/
	}catch(Exception){
		
	}
}
function ruc(){
	document.getElementById("r").value=parseInt(document.getElementById("r").value);
	if(document.getElementById("r").value>255){
		document.getElementById("r").value=255;
	}
	if(document.getElementById("r").value<0){
		document.getElementById("r").value=0;
	}
	document.getElementById("g").value=parseInt(document.getElementById("g").value);
	if(document.getElementById("g").value>255){
		document.getElementById("g").value=255;
	}
	if(document.getElementById("g").value<0){
		document.getElementById("g").value=0;
	}
	document.getElementById("b").value=parseInt(document.getElementById("b").value);
	if(document.getElementById("b").value>255){
		document.getElementById("b").value=255;
	}
	if(document.getElementById("b").value<0){
		document.getElementById("b").value=0;
	}
	document.getElementById("a").value=parseInt(document.getElementById("a").value);
	if(document.getElementById("a").value>127){
		document.getElementById("a").value=127;
	}
	if(document.getElementById("a").value<0){
		document.getElementById("a").value=0;
	}
	if(document.getElementById("r").value=="NaN"){
		document.getElementById("r").value=0;
	}
	if(document.getElementById("g").value=="NaN"){
		document.getElementById("g").value=0;
	}
	if(document.getElementById("b").value=="NaN"){
		document.getElementById("b").value=0;
	}
	if(document.getElementById("a").value=="NaN"){
		document.getElementById("a").value=0;
	}
	document.getElementById("polr").value=document.getElementById("r").value;
	document.getElementById("polg").value=document.getElementById("g").value;
	document.getElementById("polb").value=document.getElementById("b").value;
	document.getElementById("pola").value=document.getElementById("a").value;
	costr();
}
function getColor(){
	var a=((127 - document.getElementById("a").value) / 127);
	var r=document.getElementById("r").value;
	var g=document.getElementById("g").value;
	var b=document.getElementById("b").value;
	var str="rgba("+r+", "+g+", "+b+", "+a+")";
	return str;
}
function getColorf(){
	var r=document.getElementById("r").value;
	var g=document.getElementById("g").value;
	var b=document.getElementById("b").value;
	var str="rgb("+r+", "+g+", "+b+")";
	return str;
}
</script>
<?php 
//}
?>
</head>
<body>
<header>
<form style="z-index: 9999; position: fixed; right: 0; top: 59px; display: none;" id="v" action="" method="GET">
<!--textarea name="text" id="TEXTAREA" style="display: none;"></textarea-->
<input type="submit" value="OK" title="Завершить визуальное редактирование">
</form>
<?php
if(($tag===2)or(isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
<div id="ranged" style="display: none;">
<input type="range" value="100" min="0" max="255" class="pol" id="polr" oninput="pol();">
<input type="range" value="100" min="0" max="255" class="pol" id="polg" oninput="pol();">
<br>
<input type="range" value="100" min="0" max="255" class="pol" id="polb" oninput="pol();">
<input type="range" value="0" min="0" max="127" class="pol" id="pola" oninput="pol();">
<br>
<span id="rucs">
R: <input type="text" oninput="ruc();" style="color: #ff0000;" value="100" id="r">
G: <input type="text" oninput="ruc();" style="color: #00ff00;" value="100" id="g">
B: <input type="text" oninput="ruc();" style="color: #0000ff;" value="100" id="b">
A: <input type="text" oninput="ruc();" style="background-color: rgba(255, 255, 255, 0.35);" value="0" id="a">
</span>
</div>
<?php } ?>
<script>
<?php
if(($tag===2)or isset($tag['img']['alt'])){
	$testzam='<input type="text" placeholder="Текст замены" id="THEALT">';
}else{
	$testzam='';
}
if(($tag===2)or (isset($tag['img']['width']) and isset($tag['img']['height']))){
	$testvisota='<br><input type="text" placeholder="Ширина" id="THEW">px x <input type="text" placeholder="Высота" id="THEH">px<br>';
}else{
	$testvisota='';
}
$dir=dir("gallery/");
$imgs='';
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$imgs.='
<div class="IMGDIV">
<img width="180" class="IMG" src="/cms/gallery/'.$entry.'" height="120" />
<img src="/cms/pic/check.png" class="CHECKED" alt="X" />
</div>';
	}
}
if($imgs==''){
	$imgs='<h2 style="margin: 0; text-align: center; color: blue; font-size: 50pt;">Ничего нет</h2>';
}
$str='<table style="width: 100%; height: 100%; vertical-align: middle;">
<tr>
<td style="text-align: center;">
<div>
'.$imgs.'
</div>
'.$testzam.$testvisota.'
<div style="display: none; font-size: 15pt;" class="PseudoButton" id="PasteButton" onclick="PASTE();">Вставить</div>
</td>
</tr>
</table>';
$str=str_replace("\\", "\\\\", $str);
$str=str_replace("\r", " ", $str);
$str=str_replace("\n", " ", $str);
$str=str_replace('"', '\\"', $str);
$str=str_replace("'", "\\'", $str);
$str=str_replace("<", "\\<", $str);
$str=str_replace(">", "\\>", $str);
?>
var Wind=new LWindow({caption:"<b>Вставить на страницу</b>", exit:true, hide:true, html:"<?php echo($str); ?>"});
Wind.root.id="pasteSMT";
</script>
<?php
if(($tag===2)or(isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
<canvas id="cn" style="display: none;" width="50" height="50"></canvas>
<?php } ?>
<div style="vertical-align: middle;">
<div id="htmlB" style="display: none;" onclick="setDocModeM()"><table style="height: 100%;"><tr><td>HTML</td></tr></table></div>
<div id="status" style="position: fixed; top: 0; left: 0; opacity: 0.3; background-color: white;">Загрузка...</div>
<div id="panel" style="display: none; vertical-align: middle;">
<img class="Undo" src="/cms/pic/undo.png"></img>
<img class="Redo" src="/cms/pic/redo.png"></img>
<?php
if(($tag===2)or isset($tag['li'])){
if(($tag===2)or isset($tag['ol'])){
?>
<img class="List" src="/cms/pic/numberedlist.png"></img>
<?php
}
if(($tag===2)or isset($tag['ul'])){
?>
<img class="UList" src="/cms/pic/dottedlist.png"></img>
<?php
}}
?>
<?php
if(($tag===2)or (isset($tag['blockquote']['style']) and isset($tag['div']['style']))){
?>
<img class="indent" src="/cms/pic/indent.png"></img>
<img class="outdent" src="/cms/pic/outdent.png"></img>
<?php } ?>
<img class="Clear" src="/cms/pic/clean.png"></img>
<?php
if(($tag===2)or (isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
<img class="FONTCOLOR" src="/cms/pic/fontcolor.png"></img>
<img class="BGCOLOR" src="/cms/pic/bgcolor.png"></img>
<?php } ?>
<?php
if(($tag===2)or (isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['size']))){
?>
<span><input type="number" placeholder="Размер" style="width: 33px;" value="12" id="numf" min="1" max="99" step="1">pt</span>
<img class="FS" src="/cms/pic/sizef.png"></img>
<?php } ?>
<?php 
if(($tag===2)or isset($tag['a']['href'])){
?>
<span>URL:<input type="url" id="url" style="width: 140px;" placeholder="Адрес"></span>
<?php } ?>
<?php
if(($tag===2)or (isset($tag['font']['face']) and isset($tag['span']['style']) and isset($tag['font']['style']))){
?>
<span>Шрифт:<input type="text" id="font" style="width: 140px;" list="flist" placeholder="Шрифт"></span>
<datalist id="flist" style="display: none;">
<option value="Arial">Arial</option>
<option value="Arial Black">Arial Black</option>
<option value="Courier New">Courier New</option>
<option value="Times New Roman">Times New Roman</option>
</datalist>
<?php
}
?>
<?php
if(($tag===2)or (isset($tag['img']['src']) and isset($tag['img']['style']))){
?>
<img class="img" src="/cms/pic/with.png"></img>
<?php } ?>
<img class="RePa" src="/cms/pic/repaint.png"></img>
<img class="BAK" src="/cms/pic/backup.png"></img>
<br>
<?php
if(($tag===2)or (isset($tag['b']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
<img class="B" src="/cms/pic/bold.png"></img>
<?php }
if(($tag===2)or (isset($tag['i']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
<img class="I" src="/cms/pic/italic.png"></img>
<?php }
if(($tag===2)or (isset($tag['u']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
<img class="U" src="/cms/pic/underline.png"></img>
<?php }
if(($tag===2)or (isset($tag['s']) and isset($tag['strike']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
<img class="LT" src="/cms/pic/line-throught.png"></img>
<?php }
if(($tag===2)or (isset($tag['sup']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
<img class="Sup" src="/cms/pic/sup.png"></img>
<?php }
if(($tag===2)or (isset($tag['sub']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
<img class="Sub" src="/cms/pic/sub.png"></img>
<?php } ?>
<?php if(($tag===2)or isset($tag['div']['style'])){ ?>
<img class="LEFT" src="/cms/pic/justifyleft.png"></img>
<img class="CENTER" src="/cms/pic/justifycenter.png"></img>
<img class="RIGHT" src="/cms/pic/justifyright.png"></img>
<img class="FULL" src="/cms/pic/justifyfull.png"></img>
<?php } ?>
<img class="Cut" src="/cms/pic/cut.png"></img>
<img class="Copy" src="/cms/pic/copy.png"></img>
<img class="Paste" src="/cms/pic/paste.png"></img>
<?php 
if(($tag===2)or isset($tag['a']['href'])){
?>
<img class="Link" src="/cms/pic/hyperlink.png"></img>
<?php
}
?>
<img class="Unlink" src="/cms/pic/unhyperlink.png"></img>
<?php
if(($tag===2)or isset($tag['h1']['style']) or isset($tag['h2']['style']) or isset($tag['h3']['style']) or isset($tag['h4']['style']) or isset($tag['h5']['style']) or isset($tag['h6']['style']) or isset($tag['p']['style']) or isset($tag['pre'])){
?>
<select id="form">
<?php
if(($tag===2)or isset($tag['h1']['style'])){
?>
<option value="h1">Главный заголовок</option>
<?php } ?>
<?php
if(($tag===2)or isset($tag['h2']['style'])){
?>
<option value="h2">Важный заголовок</option>
<?php }
if(($tag===2)or isset($tag['h3']['style'])){
?>
<option value="h3">Надзаголовок</option>
<?php }
if(($tag===2)or isset($tag['h4']['style'])){
?>
<option value="h4">Заголовок</option>
<?php }
if(($tag===2)or isset($tag['h5']['style'])){
?>
<option value="h5">Подзаголовок</option>
<?php }
if(($tag===2)or isset($tag['h6']['style'])){
?>
<option value="h6">Микрозаголовок</option>
<?php }
if(($tag===2)or isset($tag['p']['style'])){
?>
<option value="p">Параграф</option>
<?php }
if(($tag===2)or isset($tag['pre']['style'])){
?>
<option value="pre">Как есть</option>
<?php } ?>
</select>
<img class="form" src="/cms/pic/format.png"></img>
<?php }
if(($tag===2)or (isset($tag['font']['face']) and isset($tag['span']['style']) and isset($tag['font']['style']))){
?>
<img class="fff" src="/cms/pic/fff.png"></img>
<?php } ?>
<form method="POST" action="?" id="patternForm" style="display: inline-block;">
<?php
if(isset($_POST['s'])){
	$s=$_POST['s'];
}else{
	$s="<default>";
}
$string= \LCMS\Core\Patterns\Pattern::getAll(null, false, $s, true, true, true, "gsht");
echo($string[1]);
?>
<textarea id="textareat" name="text" style="display: none;"></textarea>
<img class="SPP" src="/cms/pic/chp.png"></img>
</form>
<img class="COOK" src="/cms/pic/temp_blue.png" id="Icook"></img>
<img class="DCOOK" src="/cms/pic/opentext.png" id="cookI"></img>
</div>
</div>
</header>
<section>
<iframe id="OO" srcdoc="
<?php
if(!isset($_POST['text'])){
	$text='<p>Ваш текст.<ol><li>Список</li></ol></p>';
}else{
	$text=($_POST['text']);
}

//$s="<default>";
//$s="<noPattern>";
include("getshablu.php");
//$p=htmlentities($pattern, 0, 'utf8');
//echo $p;
if($s!="<noPattern>"){
	$csS="<link rel=\"stylesheet\" href=\"/cms/getscss.php?css=$s\" type=\"text/css\">";
}else{
	$csS="";
}
$text=str_replace("<section class=\"IUNSET\">", "", $text);
$text=str_replace("</section>", "", $text);
$text="<!doctype html><html class=\"IUNSET\"><head><link rel=\"stylesheet\" href=\"/cms/script.php?type=css\" type=\"text/css\">".$csS."</head><body class=\"IUNSET\"><section class=\"IUNSET\">".$text."</section></body></head></html>";
$text=htmlentities($text, 3, 'utf-8');
$text=str_replace('<!--TEXT-->', '<iframe id="sss" style="box-sizing: border-box;width: 100%;min-height: calc(100% - 35px);height: auto;padding: 0px;margin: 0px;" srcdoc="'.$text.'"></iframe>
<script>
var frame = document.getElementById("sss");
var frameWin = frame.contentWindow;
var frameDoc = frameWin.document;
var frameBody;
document.body.addEventListener("click", function(evt){evt.preventDefault();frame.focus();frameWin.focus();frameBody.focus();}, true);
window.addEventListener("load", function(){
window.setTimeout(function(){
frameDoc.designMode = "on";
frame.focus();
window.parent.tryTO(frame);
frameBody=frameDoc.body;
frameBody.setAttribute("contentEditAble", "true");
}, 200);
}, false);
</script>
', $pattern);
$text=htmlentities($text, 3, 'utf-8');
echo $text;
?>" ></iframe>
</section>
<script>
var rng;
var Oframe = document.getElementById('OO');
var OframeWin = Oframe.contentWindow;
var OframeDoc = OframeWin.document;
var OframeBody;
var frame;
var frameWin;
var frameDoc;
var frameBody;
<?php
if(($tag===2)or (isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
costr();
<?php } ?>
function tryTO(sss){
try{
OframeBody=OframeDoc.body;
//frame=OframeDoc.getElementById('sss');
frame=sss;
frameWin=frame.contentWindow;
frameDoc=frameWin.document;
frameBody=frameDoc.body;
if(!frameDoc.queryCommandEnabled('Paste')){
	document.getElementsByClassName('Paste')[0].remove();
}
document.forms[0].addEventListener("submit", function(evt){
	//document.getElementById("TEXTAREA").value=frameBody.innerHTML;
	top.SETTEXT(frameBody.innerHTML);
	evt.preventDefault();
}, false);
document.getElementById('patternForm').addEventListener("submit", function(evt){
	document.getElementById("textareat").value=frameBody.innerHTML;
}, false);
document.getElementById("panel").addEventListener("click", function(evt){
	// window.alert(evt.target.className);
	if((evt.target.className!="")&&(evt.target.className!=undefined)){
		if(frameDoc.execCommand == undefined){
			var span=document.createElement('span');
			switch(evt.target.className){
				case "B":
					span.style.fontWeight="bold";
				break;
				case "I":
					span.style.fontStyle="italic";
				break;
				case "U":
					span.style.textDecoration="underline";
				break;
				case "LT":
					span.style.textDecoration="line-through";
				break;
			}
			frameDoc.getSelection().getRangeAt(0).surroundContents(span);
		}else{
			switch(evt.target.className){
				case "B":
					frameDoc.execCommand("Bold", false, '');
				break;
				case "FS":
				if((document.getElementById('numf').value=="")||(!document.getElementById('numf').checkValidity())){
						window.alert("Введите корректные данные в поле размера шрифта.");
					}else{
						if(window.navigator.vendor=="Google Inc."){
							frameDoc.execCommand("FontSize", false, '1');
							var a=frameDoc.querySelectorAll("font");
							for(i in a){
								if((a[i].style!=undefined)){
									if(a[i].style.fontSize==""){
										a[i].style.fontSize=document.getElementById('numf').value+"pt";
									}
								}
							}
						}else{
							frameDoc.execCommand("FontSize", false, '2');
							var a=frameDoc.querySelectorAll("font");
							for(i in a){
								if((a[i].style!=undefined)){
									if(a[i].getAttribute('size')!="1"){
										a[i].style.fontSize=document.getElementById('numf').value+"pt";
									}
								}
							}
							frameDoc.execCommand("FontSize", false, '1');
						}
					}
				break;
				case "indent":
					frameDoc.execCommand("Indent", false, '');
				break;
				case "outdent":
					frameDoc.execCommand("Outdent", false, '');
				break;
				case "Sup":
					frameDoc.execCommand("SuperScript", false, '');
				break;
				case "Sub":
					frameDoc.execCommand("SubScript", false, '');
				break;
				case "I":
					frameDoc.execCommand("Italic", false, '');
				break;
				case "DCOOK":
					var on=true;
					if(frameBody.textContent.trim()!=""){
						if(Cget("page")!=frameBody.innerHTML){
							on=window.confirm("Вы потеряете последние изменения, если продолжите. Вы хотите открыть последний сохранённый файл?");
						}
					}
					if(on){
						CGET();
					}
				break;
				case "COOK":
					CSET();
				break;
				case "U":
					frameDoc.execCommand("Underline", false, '');
				break;
				case "form":
					var tform=document.getElementById('form');
					frameDoc.execCommand('Formatblock', false, tform[tform.selectedIndex].value);
				break;
				case "LEFT":
					frameDoc.execCommand("JustifyLeft", false, '');
				break;
				case "img":
					var ex=Wind.exited;
					Wind.Cshow();
					if(ex){
						InitPaste();
					}
				break;
				case "RePa":
					RePaint();
				break;
				case "BAK":
					var on=true;
					if(frameBody.textContent.trim()!=""){
						if(Cget("BAK")!=frameBody.innerHTML){
							on=window.confirm("Вы потеряете последние изменения, если продолжите. Вы хотите открыть последний сохранённый файл?");
						}
					}
					if(on){
						frameBody.innerHTML=Cget("BAK");
					}
					state();
				break;
				case "fff":
					frameDoc.execCommand("FontName", false, "'"+document.getElementById('font').value+"'");
				break;
				case "RIGHT":
					frameDoc.execCommand("JustifyRight", false, '');
				break;
				case "CENTER":
					frameDoc.execCommand("JustifyCenter", false, '');
				break;
				case "FULL":
					frameDoc.execCommand("JustifyFull", false, '');
				break;
				case "List":
					frameDoc.execCommand("InsertOrderedList", false, '');
				break;
				case "UList":
					frameDoc.execCommand("InsertUnorderedList", false, '');
				break;
				case "Cut":
					frameDoc.execCommand("Cut", false, '');
				break;
				case "Copy":
					frameDoc.execCommand("Copy", false, '');
				break;
				case "Paste":
					frameDoc.execCommand("Paste", false, '');
				break;
				case "Clear":
					frameDoc.execCommand("RemoveFormat", false, '');
				break;
				case "Undo":
					frameDoc.execCommand("Undo", false, '');
				break;
				case "Redo":
					frameDoc.execCommand("Redo", false, '');
				break;
				case "FONTCOLOR":
					frameDoc.execCommand("ForeColor", false, getColorf());
				break;
				case "SPP":
					patternCheange();
				break;
				case "BGCOLOR":
					frameDoc.execCommand("BackColor", false, getColor());
				break;
				case "Link":
					if((document.getElementById('url').value.length)<5){
						window.alert("Введите корректные данные в поле адреса.");
					}else{
						frameDoc.execCommand("CreateLink", false, document.getElementById('url').value);
					}
				break;
				case "Unlink":
					frameDoc.execCommand("Unlink", false, '');
				break;
				case "LT":
					frameDoc.execCommand("Strikethrough", false, '');
				break;
				default:
					window.alert("Нет функции "+evt.target.className+"! Обновите CMS.");
				break;
			}
		}
		Oframe.focus();
		OframeBody.focus();
		frame.focus();
		frameWin.focus();
		frameBody.focus();
		state();
	}
}, false);
document.getElementById('panel').style.display="inline-block";
document.getElementById('htmlB').style.display="inline-block";
document.getElementById('v').style.display="inline-block";
<?php
if(($tag===2)or (isset($tag['span']['style']) and isset($tag['font']['style']) and isset($tag['font']['color']) and isset($tag['div']['style']))){
?>
document.getElementById('ranged').style.display="";
document.getElementById('cn').style.display="";
<?php } ?>
frameBody.addEventListener("mousemove", state, false);
frameBody.addEventListener("mousedown", state, false);
frameBody.addEventListener("mouseup", state, false);
frameBody.addEventListener("click", state, false);
frameBody.addEventListener("keydown", state, false);
frameBody.addEventListener("keyup", state, false);
state();
document.getElementById('status').innerHTML="Готово, настройка";
window.setTimeout(function(){
	document.getElementById('status').innerHTML="Готово";
	frameBody.setAttribute("contentEditAble", "true");
	frameBody.setAttribute("contenteditable", "true");
	frameDoc.designMode = "on";
	window.setTimeout(function(){document.getElementById('status').remove();}, 2000);
}, 5000);
window.setInterval(function(){Cset("BAK", frameBody.innerHTML);}, 63000);
}catch(Exception){
	window.alert("____RETRY____-SYSTEM_ERROR");
	window.location.reload();
}
}
function state(){
<?php
if(($tag===2)or (isset($tag['b']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
	if(frameDoc.queryCommandValue('Bold')=="true"){
		document.getElementsByClassName('B')[0].alt="ACT";
	}else{
		document.getElementsByClassName('B')[0].alt="";
	}
<?php }
if(($tag===2)or (isset($tag['i']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
	if(frameDoc.queryCommandValue('Italic')=="true"){
		document.getElementsByClassName('I')[0].alt="ACT";
	}else{
		document.getElementsByClassName('I')[0].alt="";
	}
<?php }
if(($tag===2)or (isset($tag['u']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
	if(frameDoc.queryCommandValue('Underline')=="true"){
		document.getElementsByClassName('U')[0].alt="ACT";
	}else{
		document.getElementsByClassName('U')[0].alt="";
	}
<?php }
if(($tag===2)or (isset($tag['s']) and isset($tag['strike']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
	if(frameDoc.queryCommandValue('Strikethrough')=="true"){
		document.getElementsByClassName('LT')[0].alt="ACT";
	}else{
		document.getElementsByClassName('LT')[0].alt="";
	}
<?php }
if(($tag===2)or (isset($tag['sup']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
	if(frameDoc.queryCommandValue('SuperScript')=="true"){
		document.getElementsByClassName('Sup')[0].alt="ACT";
	}else{
		document.getElementsByClassName('Sup')[0].alt="";
	}
<?php }
if(($tag===2)or (isset($tag['sub']) and isset($tag['font']['style']) and isset($tag['span']['style']))){
?>
	if(frameDoc.queryCommandValue('SubScript')=="true"){
		document.getElementsByClassName('Sub')[0].alt="ACT";
	}else{
		document.getElementsByClassName('Sub')[0].alt="";
	}
<?php } 
if(($tag===2)or (isset($tag['div']['style']))){ ?>
	if(frameDoc.queryCommandValue('JustifyLeft')=="true"){
		document.getElementsByClassName('LEFT')[0].alt="ACT";
	}else{
		document.getElementsByClassName('LEFT')[0].alt="";
	}
	if(frameDoc.queryCommandValue('JustifyRight')=="true"){
		document.getElementsByClassName('RIGHT')[0].alt="ACT";
	}else{
		document.getElementsByClassName('RIGHT')[0].alt="";
	}
	if(frameDoc.queryCommandValue('JustifyCenter')=="true"){
		document.getElementsByClassName('CENTER')[0].alt="ACT";
	}else{
		document.getElementsByClassName('CENTER')[0].alt="";
	}
	if(frameDoc.queryCommandValue('JustifyFull')=="true"){
		document.getElementsByClassName('FULL')[0].alt="ACT";
	}else{
		document.getElementsByClassName('FULL')[0].alt="";
	}
<?php } ?>
	if((Cget("page")==frameBody.innerHTML)||(frameBody.innerHTML=="")){
		document.getElementById('Icook').src="/cms/pic/temp_blue.png";
	}else{
		document.getElementById('Icook').src="/cms/pic/temp_red.png";
	}
}
function RePaint(){
	var htmltmp=frameBody.innerHTML.replace(/<section class=\"IUNSET\">/g, "");
	htmltmp=htmltmp.replace(/<\/section>/g, "");
	htmltmp="<section class=\"IUNSET\">"+htmltmp+"<\/section>";
	frameBody.innerHTML=htmltmp;
}
/*
function ches(){
	var form = document.createElement("form");
    form.setAttribute("method", 'post');
    form.setAttribute("action", "?");

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", 's');
    input.setAttribute("value", document.getElementsByName('s')[0].value);
	var input2 = document.createElement("input");
    input2.setAttribute("type", "hidden");
    input2.setAttribute("name", 'text');
    input2.setAttribute("value", frameBody.innerHTML);

    form.appendChild(input);
    form.appendChild(input2);
    form.submit();
	/*
	var oAJAX=new XMLHttpRequest();
	oAJAX.open("POST", "textedit.php", true);
	oAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	oAJAX.send("s="+document.getElementsByName('s')[0].value);
	oAJAX.onreadystatechange=function(){
		if(oAJAX.readyState == 4){
			if(oAJAX.status == 200){
				document.clear();
				document.write(oAJAX.responseText);
				//window.alert(/*document.getElementById("d").innerHTML=*//*oAJAX.responseText);
		/*	}else{
				//document.getElementById("d").innerHTML="Не сохранено, ошибка";
			}
		}else{
			//document.getElementById("d").innerHTML="сохранение..";
		}
	};*/
	//window.location.search=("?s="+document.getElementsByName('s')[0].value+"&text="+encodeURIComponent(frameBody.innerHTML));
/*}*/
function PASTE(){
	var newNode = frameDoc.createElement("img");
	if(document.getElementById('THEIMG')==null){
		return;
	}
	newNode.src = document.getElementById('THEIMG').src;
<?php if(($tag===2)or (isset($tag['img']['alt']))){ ?>
	if(document.getElementById('THEALT').value!=""){
		newNode.alt = document.getElementById('THEALT').value;
	}
<?php }
if(($tag===2)or (isset($tag['img']['width']) and isset($tag['img']['height']))){ ?>
	if((document.getElementById('THEW').value!="")&&(document.getElementById('THEH').value!="")){
		newNode.width = document.getElementById('THEW').value;
		newNode.height = document.getElementById('THEH').value;
	}
<?php } ?>
	var r=frameDoc.getSelection().getRangeAt(0);
	r.deleteContents();
	r.insertNode(newNode);
	PASTECLEAR();
}
/*function PASTECLEAR(){
<?php if(isset($tag['img']['alt'])){ ?>
	document.getElementById('THEALT').value = "";
<?php }
if(isset($tag['img']['width']) and isset($tag['img']['height'])){ ?>
	document.getElementById('THEW').value = "";
	document.getElementById('THEH').value = "";
<?php } ?>
	var timg=document.getElementById('THEIMG');
	if((timg!=undefined)&&(timg!=null)){
		timg.id="";
	}
	document.getElementById('PasteButton').style.display="none";
	document.getElementById('pasteSMT').style.display=''; 
}*/
function PASTECLEAR(){
	Wind.Cexit();
}
function InitPaste(){
	var imgs=document.getElementsByClassName('IMG');
	for(var k in imgs){
		if(imgs[k].src!=undefined){
			imgs[k].addEventListener("click", function(evt){
				var timg=document.getElementById('THEIMG');
				if((timg!=undefined)&&(timg!=null)){
					timg.id="";
				}
				evt.currentTarget.id="THEIMG";
				document.getElementById('PasteButton').style.display="inline-block";
			}, false);
		}
	}
}
window.addEventListener("load", InitPaste, false);
</script>
<script>
function patternCheange(){
	top.document.getElementById('gsht').value=document.getElementById('gsht').value;
	document.getElementById("textareat").value=frameBody.innerHTML;
	document.getElementById('patternForm').submit();
}
function patternCheangeTwo(){
	document.getElementById('gsht').value=top.document.getElementById('gsht').value;
	document.getElementById("textareat").value=frameBody.innerHTML;
	document.getElementById('patternForm').submit();
}
function fileSend(evt){
	top.fileGet(evt.target.files);
}
function CSET(){
	Cset("page", frameBody.innerHTML, {});
	document.getElementById('Icook').src="/cms/pic/temp_blue.png";
}
function CGET(){
	frameBody.innerHTML=Cget("page");
	document.getElementById('Icook').src="/cms/pic/temp_blue.png";
}
</script>
</body>
</html>
<?php }?>