<?php
include_once $_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php";
use \LCMS\Core\Pages\Page;
use \LCMS\Core\Actions\Form;
use \LCMS\Core\Actions\Action;
use \LCMS\Core\Users\Users;
use \LCMS\Core\Users\Stats;
use \LCMS\Core\Enviroment\Loc;
Page::CMS('<style>
.thumbs {
	display: inline-block;
  width: 250px;
  margin: 10px;
  opacity: .99;
  overflow: hidden;
  position: relative;
  border-radius: 3px;
  cursor: pointer;
  -webkit-box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
  -moz-box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
  box-shadow: 0 12px 15px 0 rgba(0, 0, 0, 0.24), 0 17px 50px 0 rgba(0, 0, 0, 0.19);
}
.thumbs:before {
  content: \'\';
  background: -webkit-linear-gradient(top, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
  background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
  width: 100%;
  height: 50%;
  opacity: 0;
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 2;
  -webkit-transition-property: top, opacity;
  transition-property: top, opacity;
  -webkit-transition-duration: 1.2s;
  transition-duration: 1.2s;
}
.thumbs{
	display: inline-block;
	border-radius: 80px;
	box-sizing: border-box;
}
.select{
	border: 5px solid red;
	border-radius: 20px;
	border-style: ridge;
}
.thumbs img {
	box-sizing: border-box;
  display: block;
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
}
.thumbs .caption {
  width: 100%;
  padding-bottom: 20px;
  color: #fff;
  position: absolute;
  bottom: 0;
  left: 0;
  z-index: 3;
  text-align: center;
}
.thumbs .caption span {
  display: block;
  opacity: 0;
  position: relative;
  top: 100px;
  -webkit-transition-property: top, opacity;
  transition-property: top, opacity;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-delay: 0s;
  transition-delay: 0s;
}
.thumbs .caption .title {
  line-height: 1;
  font-weight: normal;
  font-size: 18px;
}
.thumbs .caption .info {
  line-height: 1.2;
  margin-top: 5px;
  font-size: 12px;
}
.thumbs:focus:before,
.thumbs:focus span, .thumbs:hover:before,
.thumbs:hover span {
  opacity: 1;
}
.thumbs:focus:before, .thumbs:hover:before {
  top: 50%;
}
.thumbs:focus span, .thumbs:hover span {
  top: 0;
}
.thumbs:focus .title, .thumbs:hover .title {
  -webkit-transition-delay: 0.15s;
          transition-delay: 0.15s;
}
.thumbs:focus .info, .thumbs:hover .info {
  -webkit-transition-delay: 0.25s;
          transition-delay: 0.25s;
}
#foto form{
	display: inline-block;
}
#foto{
	height: auto;
	width: 100%;
}
</style>');
if(Stats::can("shop")){?>

<a href="admin.php">Назад</a>
<?php
$mag=Loc::get('magaz');
$head=@get_headers($mag, 1);
if(strpos($head[0], "200") and (@file_get_contents($mag))){
$text=file_get_contents($mag.((isset($_GET['list']))?("?list=".$_GET['list']):('')));
$text=unserialize($text);
$htm="<div id=\"foto\">";
foreach($text as $entry){
if($entry['type']=='just'){
$htm.="<div class=\"thumbs\"><img onclick=\"window.location.assign('".$entry['a']."');\" width=\"".$entry['width']."\" src=\"".$entry['src']."\" alt=\"".$entry['alt']."\" height=\"".$entry['height']."\"></img><div class=\"caption\" onclick=\"window.location.assign('".$entry['a']."');\"><span class=\"title\">".$entry['name']."</span><span class=\"info\">".$entry['ops']."<sub><small>".$entry['small']."</small></sub></span></div></div>";
}else{
$htm.=new Action("download", "
<form action=\"action.php\" method=\"POST\" id=\"plug_".$entry['id']."\">
|SHeader|
<input type=\"hidden\" name=\"tsel\" value=\"download\">
<input type=\"hidden\" name=\"kuda\" value=\"".$entry['kuda']."\">
<input type=\"hidden\" name=\"path\" value=\"".$entry['a']."\">
<input type=\"hidden\" name=\"page\" value=\"shop.php?list=".$_GET['list']."\">
<input type=\"submit\" style=\"display: none;\" value=\"Настроить\">
<div class=\"thumbs\" ".((file_exists($entry['file']))?("style=\"height: ".$entry['height']."; border-radius: 0; color: green;\""):("")).">".((file_exists($entry['file']))?("&nbsp;&nbsp;&nbsp;&nbsp;Скачено."):(""))."<img". ((file_exists('pic/tool.png'))?(" onerror=\"this.onerror='';document.getElementById('img_".$entry['id']."').src='pic/tool.png';\""):(' style="color: darkred;"'))." id=\"img_".$entry['id']."\" onclick=\"document.getElementById('plug_".$entry['id']."').submit();\" width=\"".$entry['width']."\" src=\"".$entry['src']."\" alt=\"".$entry['alt']."\" height=\"".$entry['height']."\"></img><div class=\"caption\" onclick=\"document.getElementById('plug_".$entry['id']."').submit();\"><span class=\"title\">".$entry['name']."</span><span class=\"info\">".$entry['ops']."<sub><small>".$entry['small']."</small></sub></span></div></div>
</form>
");
}
}
$htm.="</div>";
echo($htm);
?>
<?php }else{ ?>
<h1 style="color: darkred;">Невозможно получить доступ к магазину (<code><?php echo($mag); ?></code>).</h1>
<?php } ?>
<?php }
Page::footer();
?>