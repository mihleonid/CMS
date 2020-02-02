<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
Page::CMS();
txt('<a href="tag.php"><img src="/cms/pic/tag.png" title="Управление тегами" />---back---</a>');
if(true/*CANSTAT*/){
$html=Loc::get("html");
echo('<h2>HTML</h2>');
if($html==null){
	$html=array();
}
echo('<div class="FormGroupe">');
Action::e('tag');
if(isset($_GET['last'])){
	$last=$_GET['last'];
}else{
	$last="";
}
$flush="";
$i=0;
foreach($html as $tag=>$tmp){
	$i++;
	$flush.=("<option value=\"$tag\"".(($last==$tag)?(" selected"):("")).">$tag</option>");
}
echo('</div><div class="FormGroupe">');
Action::e('taga', $flush);
echo('</div><div class="FormGroupe">');
if($html!=array()){
	Action::e('tagd', array('all'=>$html));
}
echo('</div>');
}
Page::footer();
?>