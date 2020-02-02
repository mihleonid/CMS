<?php
include_once "login.php";
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Управление файлами</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-ico">
<style>
#sss{
	font-family: monospace;
	padding: 2px;
	-webkit-user-modify: read-write-plaintext-only;
	margin-left: 4px;
	border: 2px outset #88aaff;
	overflow: auto;
}
</style>
</head>
<body>
<form id="v" action="fact.php" method="POST">
<header>
<input type="hidden" name="path" value="<?php
echo($_GET['path']);?>">
<input type="hidden" name="paths" value="<?php
echo($_GET['paths']);?>">
<input type="hidden" name="t" value="<?php
echo($_GET['t']);?>">
<?php
$z=file("z.php");
$z=$z[1];
$rand=md5(mt_rand(0, 1000));
$randz=md5($rand.md5($z));
if($_GET['t']=="j"){$patht="path";}else{$patht="paths";}
echo($_GET[$patht]);?><br>
<input type="hidden" value="<?php echo($rand);?>" name="z">
<input type="hidden" value="<?php echo($randz);?>" name="zz">
<input type="submit" value="Выйти" name="tsel">
<input type="submit" value="Изменить" name="tsel">
<input type="submit" value="Назад" name="tsel"><br>
<input type="checkbox" value="true" name="trim" checked>Очистить от пропусков в начале и в конце<br>
<?php if(file_get_contents("../location/autowid.loc")==" checked"){?>
<input type="checkbox" value="true" id="autohighlight">Авто выделение<span id="spano" style="display: none;"> (осталось <span id="spani"><?php echo(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/delay.loc"));?></span>мс)</span><br>
<?php }?>
<select name="codec">
<?php
$d=__DIR__;
foreach(new DirectoryIterator($d.DIRECTORY_SEPARATOR ."codec".DIRECTORY_SEPARATOR) as $f){
	if(!$f->isDot()){
		$info=pathinfo($f->getPathname());
		if($info['extension']=="file"){
			echo("<option value=\"".$info['basename']."\">".$info['basename']."</option>");
		}
	}
}?>
</select>
</header>
<section>
<?php if(file_exists($_GET[$patht])){?>
<div id="sss"><?php
$text=file_get_contents($_GET[$patht]);
$ext=pathinfo($_GET[$patht]);
if(($ext['extension']=="php") or ($ext['extension']=="PHP") or ($ext['extension']=="php5") or ($ext['extension']=="PHP5") or ($ext['extension']=="php4") or ($ext['extension']=="PHP4") or ($ext['extension']=="php3") or ($ext['extension']=="PHP3") or ($ext['extension']=="phps") or ($ext['extension']=="phpt") or ($ext['extension']=="phtml")){
	$OF_PHP=true;
	include_once $_SERVER['DOCUMENT_ROOT']."/cms/highlight.php";
	$text=highlight($text);
	$text=str_replace("\n", "", $text);
	$text=str_replace("\r", "", $text);
	$text=str_replace("<br />", "\r\n", $text);
	$text=str_replace("&nbsp;", " ", $text);
}else{
	$text=htmlentities($text, 0, 'utf-8');
}
echo $text;
?></div>
<textarea name="text" id="TEXTAREA" style="display: none;"></textarea>
<?php }else{?>
<div style="font-size: 24pt; color: red;">
Файл не существует
</div>
<?php exit; }?>
<span id="hid"></span>
</section>
</form>
<script>
var t=14;
var timer=<?php echo(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/delay.loc"));?>;
function coret(a) {
var root = document;
var start = root.getElementById('sss').firstChild;
if (root.createRange) {
var rng = root.createRange();
rng.setStart(start, a);
rng.setEnd(start, a);
window.getSelection().removeAllRanges();
window.getSelection().addRange(rng);
} else {
return 'Вероятно, у вас IE8-';
}
}
function GetSelectedText() {
if (document.getSelection) {
var sel = document.getSelection();
var span=document.createElement('span');
span.innerHTML="\t";
rng=sel.getRangeAt(0);
rng.deleteContents();
rng.insertNode(span);
rng.setStartAfter(span);
rng.setEndAfter(span);
window.getSelection().removeAllRanges();
window.getSelection().addRange(rng);
}else{
if (document.selection){
document.selection.createRange().pasteHTML("\t");
}
}
}
document.forms[0].addEventListener("submit", function(evt){
	document.getElementById("TEXTAREA").value=document.getElementById("sss").textContent;
}, false);
document.body.addEventListener("keydown", function(evt){
	// window.alert(document.getElementById("sss").innerHTML);
	// window.alert(document.getElementById("sss").textContent);
	// document.getElementById("sss").innerHTML=evt.keyCode;
	if(evt.altKey){
		if(evt.keyCode==107){
			t=t+1;
		}
		if(evt.keyCode==109){
			t=t-1;
		}
		if(evt.keyCode==96){
			t=14;
		}
		document.getElementById("sss").style.fontSize=t+"pt";
	}
	if(evt.ctrlKey && evt.keyCode==66){
		document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Назад\">";
		document.getElementById("v").submit();
	}
	if(evt.ctrlKey && evt.keyCode==69){
		document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Изменить\">";
		document.getElementById("v").submit();
	}
	if(evt.ctrlKey && evt.keyCode==81){
		document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Выйти\">";
		document.getElementById("v").submit();
	}
}, false);
document.addEventListener("DOMContentLoaded", function(){
	document.body.addEventListener("keydown", function(evt){
		if((evt.keyCode==9)&&(evt.target.id=="sss")){
			GetSelectedText();
			evt.preventDefault();
		}
	}, false);
}, false);
document.body.addEventListener("keydown", function(evt){
	if((evt.keyCode==13)&&(evt.ctrlKey==true)){
	var oAJAX=new XMLHttpRequest();
	oAJAX.open("POST", "/cms/highlight.php", true);
	oAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	oAJAX.send("str="+encodeURIComponent(document.getElementById("sss").textContent));
	oAJAX.onreadystatechange=function(){
		if(oAJAX.readyState == 4){
			if(oAJAX.status == 200){
				
				// window.alert(a);
				document.getElementById("sss").textContent=document.getElementById("sss").textContent;
				// window.alert(document.getElementById("sss").textContent);
				document.getElementById("sss").innerHTML=oAJAX.response.replace(/\&nbsp\;/gi, ' ');
				// coret(a);
				console.info("Выделение готово.");
			}else{
				console.error("Ошибка.");
			}
		}else{
			console.log("В процессе.");
		}
	};
	}
}, false);
document.body.addEventListener("keydown", function(evt){
	if((evt.keyCode==8)&&(evt.ctrlKey==true)&&(evt.altKey==true)){
		var sel = document.getSelection();
		rng=sel.getRangeAt(0);
		var a=rng.endOffset;
		document.getElementById("sss").textContent=document.getElementById("sss").textContent;
		coret(a);
	}
}, false);
window.setInterval(function(){
if(document.getElementById('autohighlight').checked==true){
	var oAJAX=new XMLHttpRequest();
	oAJAX.open("POST", "/cms/highlight.php", true);
	oAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	oAJAX.send("str="+encodeURIComponent(document.getElementById("sss").textContent));
	oAJAX.onreadystatechange=function(){
		if(oAJAX.readyState == 4){
			if(oAJAX.status == 200){
				
				// window.alert(a);
				document.getElementById("sss").textContent=document.getElementById("sss").textContent;
				// window.alert(document.getElementById("sss").textContent);
				document.getElementById("sss").innerHTML=oAJAX.response;/*Text*/
				// coret(a);
				console.info("Выделение готово.");
			}else{
				console.error("Ошибка.");
			}
		}else{
			console.log("В процессе.");
		}
	};
}
}, <?php echo(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/delay.loc"));?>);
window.setInterval(function(){
	timer--;
	if(timer==0){
		timer=<?php echo(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/delay.loc"));?>;
	}
	if(document.getElementById('autohighlight').checked==true){
		document.getElementById('spano').style.display="";
		document.getElementById('spani').innerHTML=timer;
	}else{
		document.getElementById('spano').style.display="none";
	}
}, 1);
</script>
</body>
</html>