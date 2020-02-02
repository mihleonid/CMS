<?php
if(!isset($PHP_SCRIPT)){
	header('Content-type: text/html; charset=utf-8');
	die('<h1><big style="color: red;">Возможно подключить <span style="text-decoration: underline;">только</span> из скрипта</big><big> </big><big style="color: green;">PHP</big><big style="color: red;">.</big></h1>');
}
?>
<style>
.fileimgclose{
	display: none;
}
.fileul{
	margin: 1px 0px;
	padding-left: 26px;
	list-style-type: none;
	display: none;
}
</style>
<?php
function html_my_folder($udir, $level=0){
	$udir=rtrim(str_replace("\\", "/", $udir));
	if(is_file($udir)){
		return('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="'.$udir.'" />'.((is_link($udir))?('<'.$udir.'>'):($udir)).'</li>'."\r\n");
	}elseif(is_dir($udir)){
		$text="\r\n".'<'.(($level==0)?('div'):('li')).' class="filediv">'."\r\n".'
<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="'.$udir.'" />['.$udir."]\r\n".'
<ul class="fileul">'."\r\n";
		$dir=dir($udir);
		while(false!==($entry=$dir->read())){
			if(($entry!=".")and($entry!="..")){
				$text.=html_my_folder($udir."/".$entry, 1);
			}
		}
		$text.='</ul>'."\r\n".'
</'.(($level==0)?('div'):('li')).'>'."\r\n";
		return $text;
	}
}
echo(html_my_folder((isset($FOLDER_TO_TREE))?($FOLDER_TO_TREE):('..')));
?>
<!--script>
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
			if(evt.currentTarget.parentElement.className=="filediv"){
				checkfolder(evt.currentTarget.parentElement);
			}
			checkproverka(document.querySelector('div.filediv'));
		}, false);
	}
}
function checkproverka(node){
	var ar=new Array();
	var ch=node.children[3].children;
	for(i in ch){
		if(ch[i].innerHTML != undefined){
			if(ch[i].className=="filediv"){
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
		box.indeterminate=true;
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
function checkfolder(node){
	var ar=new Array();
	var box=node.children[2];
	var propogande=box.checked;
	var ch=node.children[3].children;
	for(i in ch){
		if(ch[i].innerHTML != undefined){
			if(ch[i].className=="filediv"){
				ch[i].children[2].checked=propogande;
				checkfolder(ch[i])
			}else{
				ch[i].children[0].checked=propogande;
			}
		}
	}
}
</script-->