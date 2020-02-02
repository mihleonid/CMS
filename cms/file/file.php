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
@media(max-width: 470px){
	.data{
		display: none;
	}
}
@media(max-width: 360px){
	.ras{
		display: none;
	}
}
.ob{
	display: inline-block;
}
.small{
	display: inline-block;
	padding: 0;
	margin-left: 2px;
	margin-bottom: 4px;
}
.small *{
	padding: 1px;
	margin-left: 1px;
}
</style>
</head>
<body>
<form action="fact.php" method="POST" id="v" enctype="multipart/form-data">
<header>
<?php
$root=$_SERVER['DOCUMENT_ROOT'];
$disk=explode(DIRECTORY_SEPARATOR, $root);
$disk=$disk[0];
$z=file("z.php");
$z=$z[1];
$rand=md5(mt_rand(0, 1000));
$randz=md5($rand.md5($z));
include_once "files.php";
if(!isset($_GET['path'])){
	$_GET['path']=$root;
}
if(!isset($_GET['paths'])){
	$_GET['paths']=$root;
}
if($_GET['paths']==""){
	$_GET['paths']=$disk.DIRECTORY_SEPARATOR;
}
if($_GET['path']==""){
	$_GET['path']=$disk.DIRECTORY_SEPARATOR;
}
$_GET['path']=str_replace("/", DIRECTORY_SEPARATOR, $_GET['path']);
$_GET['path']=str_replace("\\", DIRECTORY_SEPARATOR, $_GET['path']);
$_GET['paths']=str_replace("/", DIRECTORY_SEPARATOR, $_GET['paths']);
$_GET['paths']=str_replace("\\", DIRECTORY_SEPARATOR, $_GET['paths']);
if(strpos($_GET['paths'], DIRECTORY_SEPARATOR)===0){
	$_GET['paths']=$disk.$_GET['paths'];
}
if(strpos($_GET['path'], DIRECTORY_SEPARATOR)===0){
	$_GET['path']=$disk.$_GET['path'];
}
if(!is_dir($_GET['path'])){
	switch($_GET['prin']){
		default:
		$info=pathinfo($_GET['path']);
		$ext=$info['extension'];
		$eet=file("codec/extensiond.db");
		foreach($eet as $lin){
			$lini=explode("|", trim($lin));
			if($lini[0]==$ext){
				$typeext=$lini[1];
			}
		}
		switch($typeext){
			case 0:
			echo("<meta http-equiv=\"Refresh\" content=\"0; url=edit.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=j\">");
			exit;
			break;
			case 1:
			echo("<meta http-equiv=\"Refresh\" content=\"0; url=editpic.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=j\">");
			exit;
			break;
			case 2:
			$ppp="view.php?path=".str_replace("\\", "\\\\", $_GET['path'])."&type=";
			echo('<script>window.open("'.$ppp.'", "_blank");</script>');
			$_GET['path']=dirname($_GET['path']);
			break;
			case 3:
			$ppp="vvv.php?path=".str_replace("\\", "\\\\", $_GET['path'])."&type=auto";
			echo('<script>window.open("'.$ppp.'", "_blank");</script>');
			$_GET['path']=dirname($_GET['path']);
			break;
			default:
			$ppp="view.php?path=".str_replace("\\", "\\\\", $_GET['path']);
			echo('<script>window.open("'.$ppp.'", "_blank");</script>');
			$_GET['path']=dirname($_GET['path']);
			break;
		}
		break;
		case "text":
		echo("<meta http-equiv=\"Refresh\" content=\"0; url=edit.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=j&type=".$_GET['type']."\">");
		exit;
		break;
		case "pic":
		echo("<meta http-equiv=\"Refresh\" content=\"0; url=editpic.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=j\">");
		exit;
		break;
		case "br":
		$ppp="view.php?path=".str_replace("\\", "\\\\", $_GET['path'])."&type=".$_GET['type'];
		echo('<script>window.open("'.$ppp.'", "_blank");</script>');
		$_GET['path']=dirname($_GET['path']);
		break;
		case "vvv":
		$ppp="vvv.php?path=".str_replace("\\", "\\\\", $_GET['path'])."&type=".$_GET['typ'];
		echo('<script>window.open("'.$ppp.'", "_blank");</script>');
		$_GET['path']=dirname($_GET['path']);
		break;
	}
}
if(!is_dir($_GET['paths'])){
	switch($_GET['prin']){
		default:
		$info=pathinfo($_GET['paths']);
		$ext=$info['extension'];
		$eet=file("codec/extensiond.db");
		foreach($eet as $lin){
			$lini=explode("|", trim($lin));
			if($lini[0]==$ext){
				$typeext=$lini[1];
			}
		}
		switch($typeext){
			case 0:
			echo("<meta http-equiv=\"Refresh\" content=\"0; url=edit.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=s\">");
			exit;
			break;
			case 1:
			echo("<meta http-equiv=\"Refresh\" content=\"0; url=editpic.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=s\">");
			exit;
			break;
			case 2:
			$ppp="view.php?path=".str_replace("\\", "\\\\", $_GET['paths'])."&type=";
			echo('<script>window.open("'.$ppp.'", "_blank");</script>');
			$_GET['paths']=dirname($_GET['paths']);
			break;
			case 3:
			$ppp="vvv.php?path=".str_replace("\\", "\\\\", $_GET['paths'])."&type=auto";
			echo('<script>window.open("'.$ppp.'", "_blank");</script>');
			$_GET['paths']=dirname($_GET['paths']);
			break;
			default:
			$ppp="view.php?path=".str_replace("\\", "\\\\", $_GET['paths']);
			echo('<script>window.open("'.$ppp.'", "_blank");</script>');
			$_GET['paths']=dirname($_GET['paths']);
			break;
		}
		break;
		case "text":
		echo("<meta http-equiv=\"Refresh\" content=\"0; url=edit.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=s&type=".$_GET['type']."\">");
		exit;
		break;
		case "pic":
		echo("<meta http-equiv=\"Refresh\" content=\"0; url=editpic.php?path=".$_GET['path']."&paths=".$_GET['paths']."&t=s\">");
		exit;
		break;
		case "br":
		$ppp="view.php?path=".str_replace("\\", "\\\\", $_GET['paths'])."&type=".$_GET['type'];
		echo('<script>window.open("'.$ppp.'", "_blank");</script>');
		$_GET['paths']=dirname($_GET['paths']);
		break;
		case "vvv":
		$ppp="vvv.php?path=".str_replace("\\", "\\\\", $_GET['paths'])."&type=".$_GET['typ'];
		echo('<script>window.open("'.$ppp.'", "_blank");</script>');
		$_GET['paths']=dirname($_GET['paths']);
		break;
	}
}?>
1. <?php
echo($_GET['path']);?><br>
2. <?php
echo($_GET['paths']);?><br>
<span id="hid"></span>
<input type="hidden" value="<?php echo($rand);?>" name="z">
<input type="hidden" value="<?php echo($randz);?>" name="zz">
<span class="ob small"><input type="submit" value="Выйти" name="tsel"><input type="submit" value="Вверх1" name="tsel"><input type="submit" value="Вверх2" name="tsel"><input type="submit" value="Папка1" name="tsel"><input type="submit" value="Папка2" name="tsel"><input type="submit" value="Копировать1" name="tsel"><input type="submit" value="Копировать2" name="tsel"><input type="submit" value="Удалить1" name="tsel"><input type="submit" value="Удалить2" name="tsel"><input type="submit" value="Переместить1" name="tsel"><input type="submit" value="Переместить2" name="tsel"><input type="submit" value="Новый1" name="tsel"><input type="submit" value="Новый2" name="tsel"><input type="submit" value="Загрузить1" name="tsel"><input type="submit" value="Загрузить2" name="tsel"><input type="submit" value="Скачать1" name="tsel"><input type="submit" value="Скачать2" name="tsel"><input type="submit" value="Сменить затравку безопасности" name="tsel"></span>
<input type="hidden" value="<?php
echo($_GET['path']);?>" name="path" id="path">
<input type="hidden" value="<?php
echo($_GET['paths']);?>" name="paths" id="paths">
<br>
<input type="text" placeholder="Имя файла" name="name" id="name">&nbsp;&nbsp;&nbsp;Кодировка<select name="codec">
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
&nbsp;&nbsp;&nbsp;Файл: <input type="file" name="document">
<span class="ob">
&nbsp;&nbsp;&nbsp;Открыть принудительно:
<select id="prin" class="thin">
<option value="">Авто</option>
<option value="pic">Картинка</option>
<option value="text">Текст</option>
<option value="br">Браузер</option>
<option value="vvv">Просмотр</option>
</select>
<span id="stypes" style="display: none;">&nbsp;&nbsp;MIME-тип:
<input type="text" placeholder="Авто" value="" class="thin" id="type" style="width: 100px;" name="type">
</span>
<span id="stypss" style="display: none;">&nbsp;&nbsp;Тип:
<select id="typ" class="thin">
<?php include_once "parts/typ.html";?>
</select>
</span>
</span>
</header>
<section>
<div class="q" id="qs">Имя&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="ras">Размер</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="data">Дата изменения</span></div>
<div class="q" id="q">Имя&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="ras">Размер</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class="data">Дата изменения</span></div>
<select name="file[]" id="sel" class="sel" multiple autofocus>
<?php
echo(files($_GET['path'], "self"));?>
</select>
<select name="files[]" id="sell" class="sel" multiple>
<?php
echo(files($_GET['paths'], "sels"));?>
</select>
</section>
<script>
var s=false;
var index1=0;
var index2=0;
var el1=document.getElementById("sel").options;
var el2=document.getElementById("sell").options;
if(el1[0]!=undefined){
el1[index1].style.border="2px blue solid";
}
if(el2[0]!=undefined){
el2[index2].style.border="2px blue solid";
}
// if(window.opener==null){window.open(window.location.href, "mi", "menubar=no,status=no,width=300,height=300,left=0,top=0");}
// window.close();
document.body.addEventListener("click", function(evt){
	var a=evt.target.tagName=="OPTION";
	var b=evt.detail=="2";
	var c=a && b;
	// document.getElementById("q").innerHTML=evt.target.className;
	if(c && evt.target.className=="self"){
		window.location.assign("file.php?path="+evt.target.getAttribute("value")+"&paths=<?php
echo(str_replace("\\", "\\\\", $_GET['paths']));?>&prin="+document.getElementById("prin").value+"&type="+document.getElementById("type").value+"&typ="+document.getElementById("typ").value);
	}
	if(c && evt.target.className=="sels"){
		window.location.assign("file.php?path=<?php
echo(str_replace("\\", "\\\\", $_GET['path']));?>&paths="+evt.target.getAttribute("value")+"&prin="+document.getElementById("prin").value+"&type="+document.getElementById("type").value+"&typ="+document.getElementById("typ").value);
		// document.getElementById("q").innerHTML="file.php?path=<?php
echo(str_replace("\\", "\\\\", $_GET['path']));?>&paths="+evt.target.getAttribute("value");
	}
}, false);
document.body.addEventListener("contextmenu", function(evt){
	evt.preventDefault();
}, false);
document.body.addEventListener("keydown", function(evt){
	// document.getElementById("qs").innerHTML=evt.target.tagName;
	// document.getElementById("qs").innerHTML=evt.target.tagName;
	// document.getElementById("qs").innerHTML=evt.keyCode;
	if(evt.keyCode==187){
		if(s){
			var ppath=document.getElementById("paths").value;
		}else{
			var ppath=document.getElementById("path").value;
		}
		if(window.confirm("Вы уверены что хотите создать изображение в "+ppath+"?")){
			var collor=window.prompt("Введите фоновый цвет изображения", "прозрачный");
			var size=window.prompt("Введите размеры изображения", "600 * 600");
			if(document.getElementById("name").value==""){
				document.getElementById("name").value="new_img.png";
				var nname="new_img.png";
			}else{
				var nname=document.getElementById("name").value;
			}
			ppath=ppath+"<?php echo str_replace("\\", "\\\\", DIRECTORY_SEPARATOR);?>"+nname;
			if(collor && size && window.confirm("Создаю изображение "+ppath+" с фоном:"+collor+" и размерами:"+size+".Потом, через 3 секунды, перезагружаю страницу.")){
				window.open("createimg.php?c="+collor+"&size="+size+"&p="+ppath, "_blank");
				window.setTimeout(refresh, 3000);
			}
		}
	}
	if(evt.keyCode == 192){
		if(!s){
			var ddd=1;
		}else{
			var ddd=2;
		}
		var cd=window.prompt("Сменить диск "+ddd+". Новый диск:");
		if(cd){
			if(window.confirm("Сменить диск на: "+cd+":<?php echo str_replace("\\", "\\\\", DIRECTORY_SEPARATOR);?>")){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"disk"+ddd+"\"><input type=\"hidden\" name=\"disk\" value=\""+cd+"\">";
			document.getElementById("v").submit();
			}
		}
		return;
	}
	if(evt.keyCode == 39){
		if(!s){
			var ddd=1;
		}else{
			var ddd=2;
		}
		var cd=window.prompt("Сменить путь "+ddd+". Новый путь:");
		if(cd){
			if(window.confirm("Сменить путь на: "+cd)){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"dir"+ddd+"\"><input type=\"hidden\" name=\"disk\" value=\""+cd+"\">";
			document.getElementById("v").submit();
			}
		}
		return;
	}
	if(evt.keyCode==116){
		if(evt.ctrlKey){
			window.location.reload(true);
		}else{
			refresh();
		}
	}
	if(evt.keyCode==13){
		if(!s){
			window.location.assign("file.php?path="+el1[index1].getAttribute("value")+"&paths=<?php
echo(str_replace("\\", "\\\\", $_GET['paths']));?>&prin="+document.getElementById("prin").value+"&type="+document.getElementById("type").value+"&typ="+document.getElementById("typ").value);
		}else{
			window.location.assign("file.php?path=<?php
echo(str_replace("\\", "\\\\", $_GET['path']));?>&paths="+el2[index2].getAttribute("value")+"&prin="+document.getElementById("prin").value+"&type="+document.getElementById("type").value+"&typ="+document.getElementById("typ").value);
		}
	}
	if(evt.keyCode==65 && evt.ctrlKey){
		if(s){
			var id="sell";
		}else{
			var id="sel";
		}
		var opts=document.getElementById(id).options;
		for(opt in opts){
			opts[opt].selected=true;
		}
	}
	if(evt.keyCode==65 && evt.altKey){
		if(s){
			var id="sell";
		}else{
			var id="sel";
		}
		var opts=document.getElementById(id).options;
		for(opt in opts){
			opts[opt].selected=false;
			// document.getElementById("qs").innerHTML+=opts[opt].selected;
		}
	}
	if(evt.keyCode==111 && evt.altKey){
		if(s){
			var id="sell";
		}else{
			var id="sel";
		}
		var opts=document.getElementById(id).options;
		for(opt in opts){
			opts[opt].selected=!opts[opt].selected;
		}
	}
	if(evt.keyCode==38 && evt.ctrlKey){
		if(!s){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Вверх1\">";
		}else{
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Вверх2\">";
		}
		document.getElementById("v").submit();
	}
	if(evt.keyCode==67 && evt.ctrlKey && evt.altKey){
		if(!s){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Копировать1\">";
		}else{
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Копировать2\">";
		}
		document.getElementById("v").submit();
	}
	// window.alert(evt.keyCode);
	if(evt.keyCode==88 && evt.ctrlKey && evt.altKey){
		if(!s){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Переместить1\">";
		}else{
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Переместить2\">";
		}
		document.getElementById("v").submit();
	}
	if(evt.keyCode==46 && evt.ctrlKey){
		if(!s){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Удалить1\">";
		}else{
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Удалить2\">";
		}
		document.getElementById("v").submit();
		return;
	}
	if(evt.keyCode==78 && evt.altKey && evt.shiftKey){
		if(!s){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Папка1\">";
		}else{
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Папка2\">";
		}
		document.getElementById("v").submit();
		return;
	}
	if(evt.keyCode==78 && evt.altKey){
		if(!s){
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Новый1\">";
		}else{
			document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Новый2\">";
		}
		document.getElementById("v").submit();
		return;
	}
	if(evt.keyCode==38){
		if(s){
			if(el2[0]!=undefined){
			index2-=1;
			if(index2<0){
				index2=el2.length-1;
			}
			if(index2!=el2.length-1){
				el2[index2+1].style.border="";
			}else{
				el2[0].style.border="";
			}
			el2[index2].style.border="2px blue solid";
			el2[index2].scrollIntoViewIfNeeded();
			}
		}else{
			if(el1[0]!=undefined){
			index1-=1;
			if(index1<0){
				index1=el1.length-1;
			}
			if(index1!=el1.length-1){
				el1[index1+1].style.border="";
			}else{
				el1[0].style.border="";
			}
			el1[index1].style.border="2px blue solid";
			el1[index1].scrollIntoViewIfNeeded();
			}
		}
	}
	if(evt.keyCode==40){
		if(s){
			if(el2[0]!=undefined){
			index2+=1;
			if(index2>el2.length-1){
				index2=0;
			}
			if(index2!=0){
				el2[index2-1].style.border="";
			}else{
				el2[el2.length-1].style.border="";
			}
			el2[index2].style.border="2px blue solid";
			el2[index2].scrollIntoViewIfNeeded();
			}
		}else{
			if(el1[0]!=undefined){
			index1+=1;
			if(index1>el1.length-1){
				index1=0;
			}
			if(index1!=0){
				el1[index1-1].style.border="";
			}else{
				el1[el1.length-1].style.border="";
			}
			el1[index1].style.border="2px blue solid";
			el1[index1].scrollIntoViewIfNeeded();
			}
		}
	}
	if(evt.keyCode==9){
		if(s){
			document.getElementById("sel").focus();
		}else{
			document.getElementById("sell").focus();
		}
		s=!s;
	}
	if(evt.shiftKey){//evt.keyCode==16
		if(s){
			el2[index2].selected=!el2[index2].selected;
		}else{
			el1[index1].selected=!el1[index1].selected;
		}
	}
	if(evt.ctrlKey && evt.keyCode==81){
		document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Выйти\">";
		document.getElementById("v").submit();
	}
	if(evt.keyCode==36){
		if(s){
			if(el2[0]!=undefined){
				el2[index2].style.border="";
				index2=0;
				el2[0].style.border="2px blue solid";
				el2[0].scrollIntoViewIfNeeded();
			}
		}else{
			if(el1[0]!=undefined){
				el1[index1].style.border="";
				index1=0;
				el1[0].style.border="2px blue solid";
				el1[0].scrollIntoViewIfNeeded();
			}
		}
	}
	if(evt.keyCode==35){
		if(s){
			if(el2[0]!=undefined){
				el2[index2].style.border="";
				index2=el2.length-1;
				el2[index2].style.border="2px blue solid";
				el2[index2].scrollIntoViewIfNeeded();
			}
		}else{
			if(el1[0]!=undefined){
				el1[index1].style.border="";
				index1=el1.length-1;
				el1[index1].style.border="2px blue solid";
				el1[index1].scrollIntoViewIfNeeded();
			}
		}
	}
	// window.alert(evt.keyCode);
	// if((evt.target.getAttribute("type")!="text") || (evt.keyCode==9) || (evt.ctrKey) || (evt.altKey) || (evt.keyCode=13) || (evt.keyCode=40) || (evt.keyCode=38) || (evt.keyCode=16) || (evt.shiftKey)){
	// evt.preventDefault();
	// }
	if((evt.target.getAttribute("type")!="text") || (evt.keyCode==9) || (evt.ctrlKey==true) || (evt.keyCode==13) || (evt.keyCode==116)){
	evt.preventDefault();
	}
}, false);
document.getElementById("sel").addEventListener("click", listclick, false);
document.getElementById("sell").addEventListener("click", listclick, false);
function listclick(evt){
	if(evt.currentTarget.id=="sel"){
		s=false;
		evt.currentTarget.focus();
	}
	if(evt.currentTarget.id=="sell"){
		s=true;
		evt.currentTarget.focus();
	}
}
document.getElementById("prin").addEventListener("input", function(evt){
	document.getElementById("stypes").style.display="none";
	document.getElementById("stypss").style.display="none";
	if(document.getElementById("prin").value=="br"){
		document.getElementById("stypes").style.display="";
	}
	if(document.getElementById("prin").value=="vvv"){
		document.getElementById("stypss").style.display="";
	}
}, false);
function refresh(){
	window.location.replace(window.location.pathname+"?paths=<?php echo(str_replace("\\", "\\\\", $_GET['paths']));?>&path=<?php echo(str_replace("\\", "\\\\", $_GET['path']));?>")
}
</script>
</form>
</body>
</html>