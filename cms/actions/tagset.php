<PRE>
settag
</PRE>
<HEADER>
Разрешённые теги
</HEADER>
<FORM>
<div>
<input type="button" value="Выбрать все" onclick="toggle(true);" />
<br>
<input type="button" value="Развернить все" onclick="openall();" />
<br>
<input type="button" value="Очистить выбор" onclick="toggle(false);" />
<br>
<input type="button" value="Инвертировать выбор" onclick="retoggle();" />
</div>
|F|
<div>
<?php
$html= \LCMS\Core\Enviroment\Loc::get("html");
$Alltag= \LCMS\Core\Enviroment\Loc::get("tag");
if($html==null){
	echo("Ошибка");
}else{
	foreach($html as $tag=>$attr){
		$flush="";
		if(isset($Alltag[$tag])){
			$checked=" checked";
		}else{
			$checked="";
		}
		foreach($attr as $entry=>$tmp){
			$checkedtmp="";
			if(isset($Alltag[$tag][$entry])){
				if($Alltag[$tag][$entry]==true){
					$checkedtmp=" checked";
				}
			}
			$flush.=('<li class="fileli"><input class="filecheck check" type="checkbox" name="filesi['.$tag.'][]" value="'.$entry.'"'.$checkedtmp.' />'.$entry.'</li>');
		}
		echo("<div class=\"filediv FormGroupe\"><img class=\"fileimg check\" src=\"/cms/pic/flagsbottom.png\" /><img class=\"fileimgclose check\" src=\"/cms/pic/flagstop.png\" /><input class=\"foldercheck check\" type=\"checkbox\" name=\"filesi[$tag]\" value=\"ON\"$checked/>$tag<ul class=\"fileul\">$flush</ul></div>");
	}
}
?>
</div>
<input type="submit" value="Настроить">
</form>
<script>
function openall(){
	var a=document.querySelectorAll('.fileimg');
	for(var i in a){
		if(a[i].src != undefined){
			a[i].parentElement.children[3].style.display="block";
			a[i].parentElement.children[1].style.display="inline-block";
			a[i].parentElement.children[0].style.display="none";
		}
	}
}
var LOCK=false;
function toggle(propogande){
	LOCK=true;
	var a=document.querySelectorAll('.filecheck,.foldercheck');
	for(var i in a){
		if(a[i].checked != undefined){
			a[i].identerminate=false;
			a[i].checked=propogande;
		}
	}
	LOCK=false;
}
function checkproverka(node){
	if(LOCK){
		return;
	}
	var ar=new Array();
	var ch=node.children[3].children;
	for(i in ch){
		if(ch[i].innerHTML != undefined){
			if(ch[i].className=="filediv FormGroupe"){
				ar[ar.length]=checkproverka(ch[i]);
			}else{
				if(ch[i].children[0].indeterminate==true){
					ar[ar.length]='i';
				}else if(ch[i].children[0].checked==true){
					ar[ar.length]='c';
				}else if(ch[i].children[0].checked==false){
					ar[ar.length]='u';
				}
			}
		}
	}
	var box=node.children[2];
	var status;
	if((ar.indexOf( 'i' ) == -1)&&(ar.indexOf( 'u' ) == -1)&&(ar.indexOf( 'c' ) != -1)){
		status='c';
	}else
	if((ar.indexOf( 'c' ) == -1)&&(ar.indexOf( 'i' ) == -1)&&(ar.indexOf( 'c' ) != -1)){
		status='u';
	}else
	if((ar.indexOf( 'c' ) == -1)&&(ar.indexOf( 'i' ) == -1)&&(ar.indexOf( 'c' ) == -1)){
		if(box.checked==false){
			status='u';
		}else{
			status='c';
		}
	}else{
		status='i';
	}
	box.indeterminate=false;
	box.checked=false;
	switch(status){
		case 'i':
		box.checked=true;
		break;
		case 'c':
		box.checked=true;
		break;
		case 'u':
		box.checked=false;
		break;
	}
	return status;
}
function retoggle(){
	LOCK=true;
	var a=document.querySelectorAll('.filecheck,.foldercheck');
	for(var i in a){
		if(a[i].checked != undefined){
			a[i].identerminate=false;
			a[i].checked=!a[i].checked;
		}
	}
	LOCK=false;
	var a=document.querySelectorAll('.foldercheck');
	for(var i in a){
		if(a[i].checked != undefined){
			checkproverka(a[i].parentNode);
		}
	}
}
window.onload=function(){
var a=document.querySelectorAll('.fileimg');
for(var i in a){
	if(a[i].src != undefined){
		a[i].addEventListener('click', function(evt){
			evt.currentTarget.parentElement.children[3].style.display="block";
			evt.currentTarget.parentElement.children[1].style.display="inline-block";
			evt.currentTarget.parentElement.children[0].style.display="none";
		}, false);
	}
}
var a=document.querySelectorAll('.fileimgclose');
for(var i in a){
	if(a[i].src != undefined){
		a[i].addEventListener('click', function(evt){
			evt.currentTarget.parentElement.children[3].style.display="";
			evt.currentTarget.parentElement.children[1].style.display="";
			evt.currentTarget.parentElement.children[0].style.display="";
		}, false);
	}
}
var a=document.querySelectorAll('.filecheck, .foldercheck');
for(var i in a){
	if(a[i].innerHTML != undefined){
		a[i].addEventListener('change', function(evt){
			if(LOCK){
				return;
			}
			if(evt.currentTarget.parentElement.className=="filediv FormGroupe"){
				checkfolder(evt.currentTarget.parentElement);
			}
			document.querySelectorAll('div.filediv').forEach(checkproverka);
		}, false);
	}
}
document.querySelectorAll('div.filediv').forEach(checkproverka);
function checkfolder(node){
	if(LOCK){
		return;
	}
	var ar=new Array();
	var box=node.children[2];
	var propogande=box.checked;
	if(propogande==true){
		return;
	}
	var ch=node.children[3].children;
	for(i in ch){
		if(ch[i].innerHTML != undefined){
			if(ch[i].className=="filediv FormGroupe"){
				ch[i].children[2].checked=propogande;
				checkfolder(ch[i])
			}else{
				ch[i].children[0].checked=propogande;
			}
		}
	}
}};
</script>
</FORM>
<ACTION>
<?php
return \LCMS\Core\Pages\HTag::setAllowedTags($_POST['filesi']);
?>
</ACTION>