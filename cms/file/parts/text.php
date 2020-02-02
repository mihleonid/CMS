<!doctype html>
<html>
<head>
<?php
echo $_HEAD;
?>
<style>
pre{
	margin-left: 1.4cm;
}
</style>
</head>
<body>
<pre style="font-size: 13pt;" id="pre">
<?php
$text=$_CONTENTS;
$ext=pathinfo($_PATH);
if(($ext['extension']=="php") or ($ext['extension']=="PHP") or ($ext['extension']=="php5") or ($ext['extension']=="PHP5") or ($ext['extension']=="php4") or ($ext['extension']=="PHP4") or ($ext['extension']=="php3") or ($ext['extension']=="PHP3") or ($ext['extension']=="phps") or ($ext['extension']=="phpt") or ($ext['extension']=="phtml")){
	$OF_PHP=true;
	include $_SERVER['DOCUMENT_ROOT']."/cms/highlight.php";
	$text=highlight($text);
	$text=str_replace("\n", "", $text);
	$text=str_replace("\r", "", $text);
	$text=str_replace("<br />", "\r\n", $text);
	$text=str_replace("&nbsp;", " ", $text);
}else{
	$text=htmlentities($text, 0, 'utf-8');
}
echo $text;
?>
</pre>
<script>
document.body.addEventListener("keydown", function(evt){
	if((evt.keyCode==67)&&(evt.shiftKey==true)){
		window.close();
	}
	if((evt.keyCode==69)&&(evt.shiftKey==true)){
		window.location.assign("edit.php?t=j&path=<?php echo str_replace("\\", "\\\\", $_GET['path']);?>");
	}
	if(evt.keyCode==107){
		document.getElementById("pre").style.fontSize=parseFloat(document.getElementById("pre").style.fontSize)+0.5+"pt";
	}
	if(evt.keyCode==109){
		document.getElementById("pre").style.fontSize=parseFloat(document.getElementById("pre").style.fontSize)-0.5+"pt";
	}
	if(evt.keyCode==111){
		document.getElementById("pre").style.fontSize="13pt";
	}
}, false);

document.body.addEventListener("keydown", function(evt){
	if((evt.keyCode==13)&&(evt.ctrlKey==true)){
	var oAJAX=new XMLHttpRequest();
	oAJAX.open("POST", "/cms/highlight.php", true);
	oAJAX.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	oAJAX.send("str="+encodeURIComponent(document.getElementById("pre").textContent));
	oAJAX.onreadystatechange=function(){
		if(oAJAX.readyState == 4){
			if(oAJAX.status == 200){
				
				// window.alert(a);
				document.getElementById("pre").textContent=document.getElementById("pre").textContent;
				// window.alert(document.getElementById("sss").textContent);
				document.getElementById("pre").innerHTML=oAJAX.response;/*Text*/
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
		document.getElementById("pre").textContent=document.getElementById("pre").textContent;
	}
}, false);
</script>
</body>
</html>