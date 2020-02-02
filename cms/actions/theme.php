<PRE>
theme
</PRE>
<HEADER>
Темы
</HEADER>
<FORM>
<form action="action.php" method="POST">
$PARAM$htm$
<br>
|Header|
<input type="submit" name="sub" value="Настроить как тему CMS">
<input type="submit" name="sub" value="Настроить как фон сайта">
<span style="float: right;"><input type="submit" style="color: #990000;" name="sub" value="Удалить">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<input type="hidden" name="fulname" value="url('/cms/themes/$PARAM$selected$')" id="fulname">
</form>
<script>
document.getElementById('foto').addEventListener("click", function(evt){
	if(evt.target.hasAttribute('cli')){
		document.body.style.backgroundImage=evt.target.id.trim();
		if(evt.detail==2){
			var thu=document.getElementsByClassName("select")[0];
			// window.alert(thu.className);
			if(thu.className=="thumbs select"){
				thu.className="thumbs";
			}
			if(thu.className=="thumbs fone select"){
				thu.className="thumbs fone";
			}
			if(thu.className=="thumbs theme select"){
				thu.className="thumbs theme";
			}
			if(thu.className=="thumbs theme fone select"){
				thu.className="thumbs theme fone";
			}
			var thu=document.getElementById(' '+evt.target.id.trim());
			if(thu.className=="thumbs"){
				thu.className="thumbs select";
			}
			if(thu.className=="thumbs fone"){
				thu.className="thumbs fone select";
			}
			if(thu.className=="thumbs theme"){
				thu.className="thumbs theme select";
			}
			if(thu.className=="thumbs theme fone"){
				thu.className="thumbs theme fone select";
			}
			document.getElementById('fulname').value=evt.target.id.trim();
		}
		if(evt.detail==3){
			if(evt.target.id.trim()!="none"){
				window.location.assign("downtheme.php?theme="+evt.target.id.trim());
			}
		}
	}
}, false);
var st="none"
document.body.addEventListener("keydown", function(evt){
	if(evt.keyCode==13){
		document.getElementsByTagName("NAV")[0].style.display=st;
		document.getElementsByTagName("HEADER")[0].style.display=st;
		document.getElementsByTagName("SECTION")[0].style.display=st;
		document.getElementsByTagName("FOOTER")[0].style.display=st;
		if(st=="none"){
			st="";
		}else{
			st="none";
		}
		evt.preventDefault();
	}
}, false);
</script>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::universalTheme($_POST['sub'], $_POST['fulname']);
?>
</ACTION>