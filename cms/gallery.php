<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Patterns\Pattern;
use \LCMS\Core\Users\Stats;
use \LCMS\MainModules\D_BASE;
Page::CMS("<link rel=\"stylesheet\" href=\"/cms/gallery.css\" type=\"text/css\"><link rel=\"stylesheet\" href=\"/cms/window.css\" type=\"text/css\">");
txt('<a href="upload.php"><img src="/cms/pic/upload.png" title="Подгрузка" />---back---</a>');
Action::e("uploadG", array("i"=>implode(",", \LCMS\Modules\File\WhiteImg::getTypes())));
if(Stats::can("gallery")){
echo('<div style="min-height: 100px; max-height: 480px; overflow: auto; padding: 15px;">');
$dir=dir("gallery/");
$htm="";
while(false!==($entry=$dir->read())){
	if(($entry!=".")and($entry!="..")){
		$htm.="
<div class=\"IMGDIV\">
<img width=\"180\" class=\"IMG\" onmousedown=\"Click(event, this)\" src=\"/cms/gallery/$entry\" height=\"120\" />
<img src=\"/cms/pic/check.png\" class=\"CHECKED\" alt=\"X\" />
</div>";
	}
}
if($htm==""){
	$htm='<h2 style="margin: 0; text-align: center; color: blue; font-size: 50pt;">Ничего нет</h2>';
}
echo($htm);
echo('</div>');
echo(new Action("deleteG"));
echo(new Action("downloadG"));
?>
<script src="window.js"></script>
<script>
var Pock=new LPocket();
</script>
<script>
document.getElementById('downf').addEventListener("submit", down, false);
document.getElementById('delf').addEventListener("submit", del, false);
function down(e){
	tos("down", e);
	window.setTimeout(function(){
		document.getElementById('dog').style.display="";
	}, 500);
}
function del(e){
	tos("del", e);
}
function tos(str, e){
	var el=document.getElementById(str);
	el.value="";
	var a=document.getElementsByClassName('CH');
	for(var i in a){
		if(a[i].src!=undefined){
			if(el.value==""){
				el.value=a[i].src;
			}else{
				el.value=el.value+"|"+a[i].src;
			}
		}
	}
	if(el.value==""){
		e.preventDefault();
	}
}
document.addEventListener('contextmenu', function(e) {
	if(!e.altKey){
		e.preventDefault();
	}
}, false);
function Click(e, o){
	e.preventDefault();
	if(e.button==0){
		if(o.className=="IMG"){
			o.className="IMG CH";
		}else{
			o.className="IMG";
		}
	}else{
		var Wind=new LWindow({html:"<img src=\""+o.src+"\"/>", caption:"Просмотр", pocket:Pock, src:o.src, exit:true, hide:true});
		Wind.Cshow();
	}
}
</script>
<?php
}
Page::footer();?>