<PRE>
loadtheme
</PRE>
<HEADER>Подгрузить тему</HEADER>
<FORM>
<form action="action.php" method="POST" enctype="multipart/form-data">
|Header|
<div id="page"></div>
<br>
<input type="button" id="new_page" value="Новый">
<br>
<input type="submit" value="Подгрузить">
</form>
<script>
var p=0;
document.getElementById("new_page").addEventListener("click", function(evt){
	var inp=document.createElement("input");
	var inp2=document.createElement("input");
	var inp3=document.createElement("input");
	var button=document.createElement("input");
	var div=document.createElement("div");
	button.setAttribute("type", "button");
	button.setAttribute("value", "Удалить тему");
	button.setAttribute("npage", p);
	div.setAttribute("id", "page_"+p);
	inp3.setAttribute("name", "pages[texts][]");
	inp3.setAttribute("type", "file");
	inp.setAttribute("type", "text");
	inp.setAttribute("name", "pages[names][]");
	inp.setAttribute("placeholder", "Название");
	inp.setAttribute("pattern", "[a-zA-Z1-90а-яА-ЯЁёЩшШшЬьЪъ_\- ]*");
	inp2.setAttribute("type", "text");
	inp2.setAttribute("name", "pages[ops][]");
	inp2.setAttribute("placeholder", "Описание");
	inp2.setAttribute("pattern", "[a-zA-Z1-90а-яА-ЯЁёЩшШшЬьЪъ_\- ]*");
	p=p+1;
	div.appendChild(document.createElement("br"));
	div.appendChild(inp);
	div.appendChild(document.createTextNode(":"));
	div.appendChild(inp2);
	div.appendChild(document.createTextNode("."));
	div.appendChild(document.createElement("br"));
	div.appendChild(inp3);
	div.appendChild(document.createElement("br"));
	div.appendChild(button);
	div.appendChild(document.createElement("br"));
	document.getElementById("page").appendChild(div);
	button.addEventListener("click", function(evti){
		document.getElementById("page").removeChild(document.getElementById("page_"+this.getAttribute("npage")));
	}, false);
}, false);
</script>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Themes::loadThemes();
?>
</ACTION>