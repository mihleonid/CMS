<?php
include_once "login.php";
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Управление файлами</title>
<link rel="stylesheet" href="style.css" type="text/css">
<link rel="stylesheet" href="pic.css" type="text/css">
<link rel="icon" href="favicon.ico" type="image/x-ico">
<script>
// function colt(){
	// var col=document.getElementById("col").value;
	// var r=Math.floor(col/65535);
	// var g=Math.floor((col%65536)/256);
	// var b=col%256;
	// hex=parseInt(col + '', 10 | 0).toString(16 | 0);
	// document.getElementById("r").value=r;
	// document.getElementById("g").value=g;
	// document.getElementById("b").value=b;
	// document.getElementById("b").value=hex;
	// costr();
// }
function costr(){
	var ccn=document.getElementById("cn").getContext("2d");
	ccn.fillStyle="#bbbbcc";
	ccn.fillRect(0, 0, 50, 50);
	ccn.fillStyle="darkred";
	ccn.textAlign="center";
	ccn.textBaseline="middle";
	ccn.font="normal 29pt Areal";
	ccn.fillText("ALFA", 25, 25, 50);
	ccn.fillStyle="rgba("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+", "+((127 - document.getElementById("a").value) / 127)+")";
	ccn.fillRect(0, 0, 50, 50);
	if((document.getElementById("r").value=="0") && (document.getElementById("g").value=="0") && (document.getElementById("b").value=="0") && (document.getElementById("a").value=="127")){
		ccn.fillStyle=alfa;
		ccn.fillRect(0, 0, 50, 50);
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
function pol(){
	document.getElementById("r").value=document.getElementById("polr").value;
	document.getElementById("g").value=document.getElementById("polg").value;
	document.getElementById("b").value=document.getElementById("polb").value;
	document.getElementById("a").value=document.getElementById("pola").value;
	costr();
}
</script>
</head>
<body>
<form id="v" action="fact.php" method="POST">
<header>
<?php
if($_GET['t']=="j"){$patht="path";}else{$patht="paths";}?>
Статус сохранения: <span id="d">Не сохранено</span>. Путь: <span id="path"><?php
echo($_GET[$patht]);?></span>
<?php
if(@copy($_GET[$patht], "img.png")){
	copy($_GET[$patht], "img.png");
}else{
	die("<big><big><big style=\"color: red;\">Не открыть.</big></big></big>");
}
?>
<input type="hidden" name="path" value="<?php
echo($_GET['path']);?>">
<input type="hidden" name="paths" value="<?php
echo($_GET['paths']);?>">
<input type="hidden" name="t" value="<?php
echo($_GET['t']);?>"><br>
<canvas id="cn" width="50" height="50"></canvas>
<div id="ranged">
<input type="range" value="100" min="0" max="255" class="pol" id="polr" oninput="pol()">
<input type="range" value="100" min="0" max="255" class="pol" id="polg" oninput="pol()">
<br>
<input type="range" value="100" min="0" max="255" class="pol" id="polb" oninput="pol()">
<input type="range" value="0" min="0" max="127" class="pol" id="pola" oninput="pol()">
</div>
<?php
$z=file("z.php");
$z=$z[1];
$rand=md5(mt_rand(0, 1000));
$randz=md5($rand.md5($z));
?>
<input type="hidden" value="<?php echo($rand);?>" name="z">
<input type="hidden" value="<?php echo($randz);?>" name="zz">
R: <input type="text" class="wid" oninput="ruc();" style="color: #ff0000;" value="100" id="r">
 G: <input type="text" class="wid" oninput="ruc();" style="color: #00ff00;" value="100" id="g">
 B: <input type="text" class="wid" oninput="ruc();" style="color: #0000ff;" value="100" id="b">
 A: <input type="text" class="wid" oninput="ruc();" style="background-color: rgba(255, 255, 255, 0.35);" value="0" id="a">
<br>Радиус: <input type="number" autocomplete="off" class="wid" value="10" id="rad">
<input type="button" value="Очистить" onclick="cl()">
<span id="brr"><br></span>
<input type="submit" value="Назад" name="tsel">
<input type="text" placeholder="Текст" id="text" style="display: none;">
<br>
<input type="button" value="Сохранить" onclick="save()">
<select id="tool">
<option value="el">Кисть</option>
<option value="text">Текст</option>
</select>
<strong id="warning">Возможно, что у вас неисправность в браузере, и в поле рисования выводится клетчатый квадрат. Тогда перезагрузите страницу.</strong>
<br><!--<input type="range" value="6579300" min="0" max="16711679" style="width: calc(100% - 30px);" id="col" onmouseup="colt()" onmousemove="colt()">-->
</header>
<section id="sect">
<?php
if(@getimagesize("img.png")){
	$exif=getimagesize("img.png");
}else{
	die("<big><big><big style=\"color: red;\">Не является изображением</big></big></big>");
}
if($exif[0]<130 or $exif[1]<130){
	$widi[0]=10;
	$widi[1]=5;
}else{
	$widi[0]=20;
	$widi[1]=10;
}
?>
<canvas id="ssss" width="600" height="600" style="background-color: #ffffff;">
</canvas>
<img id="img" src="img.png" />
<canvas id="alf" width="<?php echo($widi[0]);?>" height="<?php echo($widi[0]);?>"></canvas>
<span id="hid"></span>
</section>
</form>
<script>
var h=600;
var w=600;
var ow=<?php
echo($exif[0]);?>;
var oh=<?php
echo($exif[1]);?>;
var cnvs=document.getElementById("ssss");
if(ow!=0){
	cnvs.width=ow;
	w=ow;
}
if(oh!=0){
	cnvs.height=oh;
	h=oh;
}
var cnv=cnvs.getContext("2d");
var k=false;
var str;
var img2=document.getElementById("alf").getContext("2d");
img2.fillStyle="#ffffff";
img2.fillRect(0, 0, <?php echo($widi[0]);?>, <?php echo($widi[0]);?>);
img2.fillStyle="#aaaaaa";
img2.fillRect(0, 0, <?php echo($widi[1]);?>, <?php echo($widi[1]);?>);
img2.fillRect(<?php echo($widi[1]);?>, <?php echo($widi[1]);?>, <?php echo($widi[0]);?>, <?php echo($widi[0]);?>);
var alfa=cnv.createPattern(document.getElementById("alf"), "repeat");
cnv.fillStyle=alfa;
cnv.strokeStyle=alfa;
cnv.fillRect(0, 0, w, h);
document.getElementById("alf").remove();
var img=document.getElementById("img");
document.getElementById("d").innerHTML="Открытие";
window.setTimeout(function (){
		cnv.fillStyle=cnv.createPattern(img, "no-repeat");
		cnv.strokeStyle=cnv.createPattern(img, "no-repeat");
		cnv.fillRect(0, 0, w, h);
		document.getElementById("d").innerHTML="Открыто, не сохранено";
		}, 100);
img.remove();
var tool="el";
document.getElementById("tool").addEventListener("input", function(evt){
	if(document.getElementById("tool").value=="el"){
		document.getElementById("text").style.display="none";
	}else{
		document.getElementById("text").style.display="";
	}
	tool=document.getElementById("tool").value;
}, false);
cnvs.addEventListener("mousemove", function(evt){
	// document.body.innerHTML="rgb("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+")";
	if(k){
	if(tool=="el"){
	document.getElementById("d").innerHTML="Не сохранено";
	cnv.strokeStyle="rgba("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+", "+((127 - document.getElementById("a").value) / 127)+")";
	cnv.fillStyle="rgba("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+", "+((127 - document.getElementById("a").value) / 127)+")";
	if((document.getElementById("r").value=="0") && (document.getElementById("g").value=="0") && (document.getElementById("b").value=="0") && (document.getElementById("a").value=="127")){
		cnv.fillStyle=alfa;
		cnv.strokeStyle=alfa;
	}
	var rad=document.getElementById("rad").value;
	var x=evt.pageX + document.getElementById("sect").scrollLeft;
	var y=evt.pageY - 100 + document.getElementById("sect").scrollTop;
	cnv.beginPath();
	cnv.arc(x, y, rad, 0, 7, false);
	cnv.fill();
	str+="--el-"+document.getElementById("r").value+"-"+document.getElementById("g").value+"-"+document.getElementById("b").value+"-"+rad+"-"+x+"-"+y+"-"+document.getElementById("a").value;
	}
	}
}, false);
cnvs.addEventListener("mousedown", function(evt){
	k=true;
	if(tool=="text"){
		document.getElementById("d").innerHTML="Не сохранено";
		cnv.strokeStyle="rgba("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+", "+((127 - document.getElementById("a").value) / 127)+")";
		cnv.fillStyle="rgba("+document.getElementById("r").value+", "+document.getElementById("g").value+", "+document.getElementById("b").value+", "+((127 - document.getElementById("a").value) / 127)+")";
		if((document.getElementById("r").value=="0") && (document.getElementById("g").value=="0") && (document.getElementById("b").value=="0") && (document.getElementById("a").value=="127")){
			cnv.fillStyle=alfa;
			cnv.strokeStyle=alfa;
		}
		var rad=document.getElementById("rad").value;
		var x=evt.pageX + document.getElementById("sect").scrollLeft;
		var y=evt.pageY - 100 + document.getElementById("sect").scrollTop;
		text=document.getElementById("text").value;
		cnv.textAlign="left";
		cnv.textBaseline="bottom";
		cnv.font="normal "+rad+"px Arial";
		cnv.fillText(text, x, y);
		str+="--text-"+document.getElementById("r").value+"-"+document.getElementById("g").value+"-"+document.getElementById("b").value+"-"+text+"-"+x+"-"+y+"-"+document.getElementById("a").value+"-"+rad;
	}
}, false);
cnvs.addEventListener("mouseup", function(evt){
	k=false;
}, false);
cnvs.addEventListener("mouseout", function(evt){
	k=false;
}, false);
document.body.addEventListener("keydown", function(evt){
	// document.getElementById("r").value=evt.keyCode;
	if(evt.ctrlKey && evt.keyCode==66){
		document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Назад\">";
		document.getElementById("v").submit();
	}
	if(evt.ctrlKey && evt.keyCode==81){
		document.getElementById("hid").innerHTML="<input type=\"hidden\" name=\"tsel\" value=\"Выйти\">";
		document.getElementById("v").submit();
	}
}, false);
function save(){
	document.getElementById("d").innerHTML="сохранение..";
	s="str="+str+"&path="+document.getElementById("path").innerHTML;
	var oAJAX=new XMLHttpRequest();
	oAJAX.open("POST", "save.php", true);
	oAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	oAJAX.send(s);
	oAJAX.onreadystatechange=function(){
		if(oAJAX.readyState == 4){
			if(oAJAX.status == 200){
				document.getElementById("d").innerHTML=oAJAX.responseText;
				str="";
			}else{
				document.getElementById("d").innerHTML="Не сохранено, ошибка";
			}
		}else{
			document.getElementById("d").innerHTML="сохранение..";
		}
	};
	// window.location.assign("save.php?str="+str);
}
function cl(){
	cnv.fillStyle=alfa;
	cnv.strokeStyle=alfa;
	cnv.fillRect(0, 0, w, h);
	str="";
	document.getElementById("d").innerHTML="Не сохранено";
	var img= new Image();
	img.src="img.png";
	img.src="img.png";
	img.src="img.png";
	img.src="img.png";
	document.getElementById("d").innerHTML="Очистка..";
	window.setTimeout(function (){
		document.getElementById("d").innerHTML="Очищено, не сохранено";
		cnv.fillStyle=cnv.createPattern(img, "no-repeat");
		cnv.strokeStyle=cnv.createPattern(img, "no-repeat");
		cnv.fillRect(0, 0, w, h);
		window.location.reload(true);
		}, 100);
}
document.getElementById("rad").addEventListener("input", function(evt){
	if(parseInt(document.getElementById("rad").value)<1){
		document.getElementById("rad").value=1;
	}
	var inti=parseInt(document.getElementById("rad").value) + (parseInt(document.getElementById("rad").value)%2)+6;
	cnvs.style.cursor="url('cursors/"+inti+".cur'), url('cursors/"+inti+".png'), crosshair";
}, false)
cnvs.style.cursor="url('cursors/"+10+".cur'), url('cursors/"+10+".png'), crosshair";
// colt();
costr();
</script>
</body>
</html>