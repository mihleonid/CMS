<PRE>
status
</PRE>
<HEADER>
---set-permissions---
</HEADER>
<FORM>
<?php
use \LCMS\MainModules\D_BASE;
$aform=new Form();
$db0=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablegroup.tdb");
$all0=$db0->get_all();
$db=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
$all=$db->get_all();
$db2=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablesi.tdb");
$all2=$db2->get_all();
$head="";
foreach($all2 as $value){
	$head.="<th class=\"togrouphgroup_$value[1]\" style=\"display: none; min-width: 250px; height: 35px;\">$value[0]</th>";
}
$groups="<th style=\"min-width: 250px; height: 35px;\"><span style=\"font-family: monospace;\">&lt;</span>".l('no-category', true)."<span style=\"font-family: monospace;\">&gt;</span><input type=\"checkbox\" class=\"groupflag\" id=\"group__NOGROUP\"/></th>";
foreach($all0 as $value){
	$groups.="<th style=\"min-width: 250px; height: 35px;\">$value[1]<input type=\"checkbox\" class=\"groupflag\" id=\"group_$value[0]\"/></th>";
}
$echo=("<table><tr><th rowspan=\"2\">---status---<big><big><big style=\"font-family: monospace;\">\\</big></big></big>---permission---</th>$groups</tr><tr>$head</tr>");
$counted=$db->counted();
$inc=1;
foreach($all as $name=>$line){
	$tmph="";
	foreach($line as $key=>$value){
		$valueee=$all2[$key][1];
		$tmph.="<td style=\"padding: 0; display: none;\" class=\"togroupgroup_$valueee\"><input type=\"checkbox\" style=\"width: 19px; height: 19px; margin: 0; padding: 0;\" value=\"ON\" name=\"$name.$key\"".(($value=="ON")?(" checked"):(""))." /></td>";
	}
	$del='<input style="font-family: monospace;" type="button" onclick="document.getElementById(\'hido\').value=\''.$name.'\';document.getElementById(\'hidoa\').value=\'upstat\';document.getElementById(\'hid\').submit();" value="---up---">';
	$delq='<input style="font-family: monospace; height: 30px;" type="button" onclick="document.getElementById(\'hido\').value=\''.$name.'\';document.getElementById(\'hidoa\').value=\'delstat\';document.getElementById(\'hid\').submit();" value="---delete---">';
	$delr='<input style="font-family: monospace;" type="button" onclick="document.getElementById(\'hido\').value=\''.$name.'\';document.getElementById(\'hidoa\').value=\'downstat\';document.getElementById(\'hid\').submit();" value="---down---">';
	$echo.=("<tr><th><table class=\"unsett\" style=\"width: 100%;\"><tr>".((($name!="globaladmin")and($inc!="2"))?("<td style=\"text-align: left;\"><form>$del</form></td>"):(""))."<td rowspan=\"2\" style=\"text-align: left;\">$name</td>".((($name!="globaladmin")and($name!="admin")and($name!="bloger"))?("<td rowspan=\"2\" style=\"text-align: left;\">$delq</td>"):(""))."</tr><tr>".((($name!="globaladmin")and($inc!=$counted))?("<td style=\"text-align: left;\">$delr</td>"):(""))."</tr></table></th>$tmph</tr>");
	$inc++;
}
$echo.=('</table><script>
var a;
var b;
var c;
function dis(e){
	e.style.display="";
}
function udis(e){
	e.style.display="none";
}
window.onload=function(){
a=document.querySelectorAll(\'.groupflag\');
for(var i in a){
	if(a[i].checked != undefined){
		a[i].addEventListener(\'click\', function(evt){
			if(evt.currentTarget.checked==true){
				//evt.currentTarget.src=\'/cms/pic/flagsleft.png\';
				b=document.querySelectorAll(\'.togrouph\'+evt.currentTarget.id);
				c=document.querySelectorAll(\'.togroup\'+evt.currentTarget.id);
				//evt.currentTarget.parentElement.setAttribute(\'colspan\', b.length);
				b.forEach(dis);
				c.forEach(dis);
				//window.alert(b);
			}else{
				b=document.querySelectorAll(\'.togrouph\'+evt.currentTarget.id);
				c=document.querySelectorAll(\'.togroup\'+evt.currentTarget.id);
				//evt.currentTarget.parentElement.setAttribute(\'colspan\', b.length);
				b.forEach(udis);
				c.forEach(udis);
			}
		}, false);
	}
}};
/*var a=document.querySelectorAll(\'.fileimgclose\');
for(var i in a){
	if(a[i].src != undefined){
		a[i].addEventListener(\'click\', function(evt){
			evt.currentTarget.parentElement.children[3].style.display="";
			evt.currentTarget.parentElement.children[1].style.display="";
			evt.currentTarget.parentElement.children[0].style.display="";
		}, false);
	}
}
var a=document.querySelectorAll(\'.filecheck, .foldercheck\');
for(var i in a){
	if(a[i].innerHTML != undefined){
		a[i].addEventListener(\'change\', function(evt){
			if(evt.currentTarget.parentElement.className=="filediv"){
				checkfolder(evt.currentTarget.parentElement);
			}
			checkproverka(document.querySelector(\'div.filediv\'));
		}, false);
	}
}
};
document.getElementById(\'group_g\').parentElement.setAttribute(\'colspan\', 3);
*/
</script>');
$echo.='</div>';
$aform->html['AFORM']=$echo;
$aform->submit("---set---");
$aform->display($ACTNAME$);
?>
</FORM>
<ACTION>
<?php
\LCMS\Core\Users\Stats::setPravs();
?>
</ACTION>