<?php
namespace LCMS\Core\Patterns{
	use \LCMS\Core\Enviroment\Loc;
	use \LCMS\Core\Actions\Result;
	use \LCMS\Core\Users\Stats;
	class Pattern{
		const Type=4;
		#region Packets
		public static function installPacket($packet, $all, $zamena){
			$packet=preg_replace('@[^a-zA-Z_1-90]@', '', $packet);
			$ulog=unserialize(file_get_contents("moduls/logs/patt.log"));
			$array=unserialize(file_get_contents("s/db/so.db"));
			$packsetr=unserialize(file_get_contents("moduls/patpack/$packet.pack"));
			foreach($packsetr as $pack=>$packf){
				if(!$zamena){
					while(file_exists("s/$pack.seria")){
						$pack.="d";
					}
				}
				$ulog[$packet][$pack]=true;
				file_put_contents("s/$pack.seria", serialize($packf));
				if($all==true){
					$array[$pack]=1;
				}
			}
			file_put_contents("s/db/so.db", serialize($array));
			file_put_contents("moduls/logs/patt.log", serialize($ulog));
			return new Result();
		}
		public static function deletePacket($pack){
			$pack=str_replace('..', '', $pack);
			if(file_exists("moduls/patpack/".$pack.".pack")){
				unlink("moduls/patpack/".$pack.".pack");
			}else{
				return new Result("Файла не существует");
			}
			return new Result();
		}
		public static function newPacket($packet, $patterns, $zamena){
			$error=new Result();
			$packet=preg_replace('@[^a-zA-Z_1-90]@', '', $packet);
			$ee=array();
			foreach($patterns as $emm){
				$ee[$emm]=unserialize(file_get_contents("s/".$emm.".seria"));
			}
			$text=serialize($ee);
			$copy=false;
			if(!$zamena){
				while(file_exists("moduls/patpack/$packet.pack")){
					if(!$zamena){
						$copy=$packet;
					}
					$zamena=true;
					$packet.="d";
				}
			}
			file_put_contents("moduls/patpack/$packet.pack", $text);
			if($copy){
				$error="Переименованно из ".$copy." в ".$packet;
			}
			return $error;
		}
		public static function copyPacket($part, $new, $delete){
			$part=str_replace(".", "", $part);
			$new=preg_replace('@[^a-zA-Z_1-90]@', '', $new);
			if($new==""){
				return new Result("Имя пакета шаблонов не может быть пустым");
			}
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/moduls/patpack/$part.pack")){
				copy($_SERVER['DOCUMENT_ROOT']."/cms/moduls/patpack/$part.pack", $_SERVER['DOCUMENT_ROOT']."/cms/moduls/patpack/$new.pack");
				if($delete){
					unlink($_SERVER['DOCUMENT_ROOT']."/cms/moduls/patpack/$part.pack");
				}
			}else{
				return new Result("Пакета шаблонов не существует");
			}
			return new Result();
		}
		public static function uninstallPacket($packet, $all){
			$error=new Result();
			$ulog=unserialize(file_get_contents("moduls/logs/patt.log"));
			if(!isset($ulog[$packet])){
				return new Result("Пакет шаблонов не установлен");
			}
			foreach($ulog[$packet] as $k=>$otrue){
				$tmperror=Pattern::delete($k, $all);
				if(! $tmperror->getOK()){
					if($error->getOK){
						$error=$k.": ".$tmperror;
					}else{
						$error="<br>".$k.": ".$tmperror;
					}
				}else{
					unset($ulog[$packet][$k]);
				}
			}
			if($ulog[$packet]==array()){
				unset($ulog[$packet]);
			}
			file_put_contents("moduls/logs/patt.log", serialize($ulog));
			return $error;
		}
		#endregion
		#region Default
		public static function isDefault($sab){
			if(Pattern::getDefault()==trim($sab)){
				return true;
			}else{
				return false;
			}
		}
		public static function getDefault(){
			$a=Loc::get("shab");
			if($a=="<noPattern>"){
				return null;
			}
			return $a;
		}
		public static function setDefault($patt){
			Loc::set("shab", preg_replace('@[^a-zA-Z_1-90]@', '', $patt));
			return new Result();
		}
		#endregion
		#region CMS
		public static function setCMS($patt){
			return Loc::set("mys", preg_replace('@[^a-zA-Z_1-90]@', '', $patt));
		}
		public static function getCMS(){
			return Loc::get("mys");
		}
		public static function isCMS($patt){
			if(Pattern::getCMS()==trim($patt)){
				return true;
			}else{
				return false;
			}
		}
		#endregion
		public static function getReal($patt){
			if(strtolower($patt)=="<default>"){
				return Pattern::getDefault();
			}
			if(strtolower($patt)=="<noPattern>"){
				return null;
			}
			return $patt;
		}
		public static function exists($name){
			return file_exists(Pattern::path($name));
		}
		private static function path($name){
			$name=str_replace('..', '', $name);
			$name=$_SERVER['DOCUMENT_ROOT']."/cms/s/$name.seria";
			return $name;
		}
		public static function getall($allpaterns=null, $multiple=false, $tec=null, $required=true, $NULL=false, $DEFAULT=false, $id=""){
			if($allpaterns===null){
				$allpaterns=Stats::can($GLOBALS['AUTH'][2], 'allpatt');
			}
	if($allpaterns){
		$dir=dir("s/");
		while(false!==($entry=$dir->read())){
			if(($entry!=".")and($entry!="..")){
				if(is_file("s/".$entry)){
					$info=pathinfo($entry);
					if($info['extension']=="seria"){
						$db[$info['filename']]=1;
					}
				}
			}
		}
	}else{
		$db=unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/s/db/so.db"));
	}
	if(($tec==null)and($tec!=="")){
		$tec= static::getDefault();
	}
	if($NULL){
		$db["<noPattern>"]=1;
	}
	if($DEFAULT){
		$db["<default>"]=1;
	}
	$string="<select name=\"s";
	if($multiple){
		$string.="[]\" multiple";
	}else{
		$string.="\"";
	}
	if($id!=""){
		$string.=" id=\"$id\"";
	}
	if($required){
		$string.=" required";
	}
	$string.=">";
	foreach($db as $shablon=>$one){
		if(trim($shablon)!=""){
			if($shablon=="<default>"){
				$shablons[]="<default>";
				if($tec=="<default>"){
					$sel=" selected";
				}else{
					$sel="";
				}
				$string.="<option value=\"<default>\"$sel>&lt;Шаблон по умолчанию&gt;</option>";
			}elseif($shablon=="<noPattern>"){
				$shablons[]="<noPattern>";
				if($tec=="<noPattern>"){
					$sel=" selected";
				}else{
					$sel="";
				}
				$string.="<option value=\"<noPattern>\"$sel>&lt;Без шаблона&gt;</option>";
			}elseif(file_exists("s/".$shablon.".seria")){
				$shablon=trim($shablon);
				$shablons[]=$shablon;
				if($tec==$shablon){
					$sel=" selected";
				}else{
					$sel="";
				}
				$string.="<option value=\"$shablon\"$sel>$shablon</option>";
			}else{
				CMS::Logged("[DATA_BASE_ERROR] base: so.db PATTERN_TO_USE_BASE,  in:".date("H:i:s").'&nbsp;'.date("d.m.Y"));
			}
		}
	}
	$string.="</select>";
	return array($shablons, $string);
}
public static function styletable($style, $head=""){
	$htm="<table>$head";
	$db= static::get($style);
	if(is_null($db)){
		return array("Error", "Error", "Error");
	}
	$stfile=$db['css'];
	$db=$db['csstab'];
	$db=explode("\r\n", $db);
	$stfile=explode("\r\n", $stfile);
	$st=array();
	foreach($db as $stru){
		$htm.="<tr>";
		$stru=trim($stru);
		if($stru==""){
			continue;
		}
		$stu=explode("|", $stru);
		$ru=trim($stu[0]);
		$en=trim($stu[1]);
		$encom="/*CSS: $en*/";
		$type=trim($stu[2]);
		$def=trim($stu[3]);
		$wid=trim($stu[4]);
		$key=array_search($encom, $stfile);
		$key+=1;
		$css=explode(":", $stfile[$key]);
		$cssstr=trim($css[1]);
		$cssstr=substr($cssstr, 0, strlen($cssstr)-1);
		$cssstr=trim($cssstr);
		$stu=array_merge($stu, array($cssstr));
		$st[]=$stu;
		$names[]=$en;
		switch($type){
			default:
			case "text":
			$htm.="<td><input type=\"hidden\" name=\"i_$en\" value=\"text|$def\">$ru</td><td colspan=\"4\" style=\"text-align: start;\"><input style=\"width: ".$wid."px; background-color: #ffaaff;\" type=\"text\" value=\"$cssstr\" name=\"$en\"></td>";
			break;
			case "rgb":
			$cssstr=substr($cssstr, 4, strlen($cssstr)-1);
			$cssstr=str_replace(" ", "", $cssstr);
			$rgb=explode(",", $cssstr);
			$r=$rgb[0];
			$g=$rgb[1];
			$b=$rgb[2];
			$b=str_replace(")", "", $b);
			$htm.="<td><input type=\"hidden\" name=\"i_$en\" value=\"rgb|$def\">$ru</td><td><input style=\"width: ".$wid."px; background-color: #ffaaaa;\" type=\"text\" value=\"$r\" name=\"".$en."_r\"></td><td><input style=\"width: ".$wid."px; background-color: #aaffaa;\" type=\"text\" value=\"$g\" name=\"".$en."_g\"></td><td colspan=\"2\" style=\"text-align: start;\"><input style=\"width: ".$wid."px; background-color: #aaaaff;\" type=\"text\" value=\"$b\" name=\"".$en."_b\"></td>";
			break;
			case "rgba":
			$cssstr=substr($cssstr, 5, strlen($cssstr)-1);
			$cssstr=str_replace(" ", "", $cssstr);
			$rgb=explode(",", $cssstr);
			$r=$rgb[0];
			$g=$rgb[1];
			$b=$rgb[2];
			$al=$rgb[3];
			$al=str_replace(")", "", $al);
			$htm.="<td><input type=\"hidden\" name=\"i_$en\" value=\"rgba|$def\">$ru</td><td><input style=\"width: ".$wid."px; background-color: #ffaaaa;\" type=\"text\" value=\"$r\" name=\"".$en."_r\"></td><td><input style=\"width: ".$wid."px; background-color: #aaffaa;\" type=\"text\" value=\"$g\" name=\"".$en."_g\"></td><td><input style=\"width: ".$wid."px; background-color: #aaaaff;\" type=\"text\" value=\"$b\" name=\"".$en."_b\"></td><td><input style=\"width: ".$wid."px; background-color: rgba(170, 170, 170, 0.35);\" type=\"text\" value=\"$al\" name=\"".$en."_a\"></td>";
			break;
		}
		$htm.="</tr>";
	}
	$htm.="</table>";
	return array($st, $htm, $names);
}
		public static function get($css){
			$css=Pattern::getReal($css);
			$css=Pattern::path($css);
			if(file_exists($css)){
				$css=unserialize(file_get_contents($css));
				return($css);
			}else{
				return array('patt'=>"", 'patttab'=>"", 'css'=>"", 'csstab'=>"");
			}
		}
		public static function set($sab, $all, $can){
			$sab=preg_replace('@[^a-zA-Z_1-90]@', '', $sab);
			if($sab==""){
				return new Result("Имя шаблона не может быть пустым.");
			}
			$db=unserialize(file_get_contents("s/db/so.db"));
			if($can or isset($db[$sab])){
				if($all){
					$db[$sab]=1;
				}elseif(isset($db[$sab])){
					unset($db[$sab]);
				}
				if(Pattern::isDefault($sab)){
					$db[$sab]=1;
				}
				file_put_contents("s/db/so.db", serialize($db));
				file_put_contents(Pattern::path($sab), serialize(array('patt'=>$_POST['sod'], 'css'=>$_POST['sodcss'], 'csstab'=>$_POST['sodcsstab'], 'patttab'=>$_POST['sodtab'])));
				return new Result();
			}else{
				return new Result("У вас нет таких прав.");
			}
		}
		public static function create($part, $patt, $css, $csstab, $tab, $all){
			$error=new Result();
			$part=preg_replace('@[^a-zA-Z_1-90]@', '', $part);
			start:
			if(!Pattern::exists($part)){
				file_put_contents(Pattern::path($part), array('patt'=>trim($patt), 'css'=>trim($css), 'csstab'=>trim($csstab), 'patttab'=>trim($tab)));
				if($all==true){
					$abccopy=unserialize(file_get_contents("s/db/so.db"));
					$abccopy[$part]=1;
					file_put_contents("s/db/so.db", serialize($abccopy));
				}
			}else{
				$error="Имя шаблона занято! Переименованно.";
				$part.="d";
				goto start;
			}
			return $error;
		}
		public static function delete($sablon, $all){
			$con=unserialize(file_get_contents("s/db/so.db"));
			$sablon=preg_replace('@[^a-zA-Z_1-90]@', '', $sablon);
			if($all or isset($con[$sablon])){
				if(!Pattern::exists($sablon)){
					return new Result("Шаблоона несуществует");
				}
				unset($con[$sablon]);
				file_put_contents("s/db/so.db", serialize($con));
				unlink(Pattern::path($sablon));
			}else{
				return new Result("У Вас нет прав на удаление шаблона");
			}
			return new Result();
		}
		public static function copy($patt, $new, $delete, $can){
			$patt=preg_replace('@[^a-zA-Z_1-90]@', '', $patt);
			$new=preg_replace('@[^a-zA-Z_1-90]@', '', $new);
			$db=unserialize(file_get_contents("s/db/so.db"));
			if($can or isset($db[$patt])){
				if(!file_exists($_SERVER['DOCUMENT_ROOT']."/cms/s/$patt.seria")){
					return new Result("Шаблона несуществует");
				}
				copy(Pattern::path($patt), Pattern::path($new));
				if(isset($db[$patt])){
					$db[$new]=true;
				}
				if($delete){
					if(isset($db[$patt])){
						unset($db[$patt]);
					}
					unlink(Pattern::path($patt));
				}
			}
			file_put_contents("s/db/so.db", serialize($db));
			return new Result();
		}
		public static function inSoBase($patt){
			$arr=unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/s/so.db"));
			if(isset($arr[$patt])){
				return true;
			}
			return false;
		}
		public static function canUs($status, $patt){
			if(Stats::can($status, "allpatt")){
				return true;
			}
			if(Pattern::inSoBase($patt)){
				return true;
			}
			return false;
		}
	}
	class Part{
		const Type=8;
		#region PartsPacket
		public static function copyPacket($part, $new, $delete){
			$part=str_replace(".", "", $part);
			$new=preg_replace('@[^a-zA-Z_1-90]@', '', $new);
			if($new==""){
				return new Result("Имя пакета частей не может быть пустым");
			}
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/moduls/parts/$part.pack")){
				copy($_SERVER['DOCUMENT_ROOT']."/cms/moduls/parts/$part.pack", $_SERVER['DOCUMENT_ROOT']."/cms/moduls/parts/$new.pack");
				if($delete){
					unlink($_SERVER['DOCUMENT_ROOT']."/cms/moduls/parts/$part.pack");
				}
			}else{
				return new Result("Пакета частей несуществует");
			}
			return new Result();
		}
		public static function deletePacket($part){
			$part=preg_replace('@[^a-zA-Z_1-90]@', '', $part);
			unlink("moduls/parts/$part.pack");
			return new Result();
		}
		public static function uninstallPacket($pack){
			$pack=preg_replace('@[^a-zA-Z_1-90]@', '', $pack);
			$error=new Result();
			$text=unserialize(file_get_contents("moduls/logs/part.log"));
			$lin=$text[$pack];
			unset($text[$pack]);
			file_put_contents("moduls/logs/part.log", serialize($text));
			unset($text);
			foreach($lin as $val=>$otrue){
				if(file_exists("parts/$val.part")){
					unlink("parts/$val.part");
				}else{
					$error->add("Несуществует файл parts/<b>$val</b>.part.<br>");
				}
			}
			return $error;
		}
		public static function createPacket($partess, $new, $zamena){
			$new=preg_replace('@[^a-zA-Z_1-90]@', '', $new);
			if($new==""){
				return new Result("Имя пакета частей не может быть пустым");
			}
			if(!is_array($partess)){
				$partess=array($partess);
			}
			$error= new Result();
			$str=array();
			foreach($partess as $a){
				$b=file_get_contents("parts/$a.part");
				$str[$a]=$b;
			}
			$str=serialize($str);
			$c=$new;
			while(file_exists("moduls/parts/$c.pack") and (!$zamena)){
				$c.="d";
				$error="Имя пакета ".$new." занято. Переименованно в $c";
			}
			$path="moduls/parts/$c.pack";
			file_put_contents($path, $str);
			return $error;
		}
		public static function installPacket($pack, $and){
			$error=new Result();
			$pack=trim(str_replace(".", "", $pack));
			if(!file_exists("moduls/parts/$pack.pack")){
				return("Пакета частей несуществует");
			}
			$text=unserialize(file_get_contents("moduls/parts/$pack.pack"));
			$log=unserialize(file_get_contents("moduls/logs/part.log"));
			$keycount=array();
			foreach($text as $key=>$val){
				$keyi=$key;
				while((file_exists("parts/$key.part"))and(!$and)){
					$key.="d";
				}
				if($keyi!=$key){
					$error->add("Переименованно из $keyi в $key.<br>");
				}
				$keycount[$key]=true;
				file_put_contents("parts/$key.part", $val);
			}
			if(isset($log[$pack])){
				$log[$pack]=array_merge($log[$pack], $keycount);
			}else{
				$log[$pack]=$keycount;
			}
			file_put_contents("moduls/logs/part.log", serialize($log));
			return $error;
		}
		#endregion
		public static function copy($part, $new, $delete){
			$part=str_replace(".", "", $part);
			$new=preg_replace('@[^a-zA-Z_1-90]@', '', $new);
			if($new==""){
				return new Result("Имя части не может быть пустым");
			}
			if(Part::exists($part)){
				copy(Part::path($part), Part::path($new));
				if($delete){
					unlink(Part::path($part));
				}
			}else{
				return new Result("Части несуществует");
			}
			return new Result();
		}
		public static function delete($parts){
			if(!is_array($parts)){
				$parts=array($parts);
			}
			foreach($parts as $part){
				unlink(Part::path($part));
			}
			return new Result();
		}
		public static function add($part, $sod){
			$part=preg_replace('@[^a-zA-Z_1-90]@', '', $part);
			if($part==""){
				return new Result("Имя части не может быть пустым");
			}
			if(!Part::exists($part)){
				file_put_contents(Part::path($part), trim(str_replace("<?", "&lt;?", $sod)));
				return new Result();
			}else{
				return new Result("Имя части занято");
			}
		}
		private static function path($part){
			$part=preg_replace('@[^a-zA-Z_1-90]@', '', $part);
			return $_SERVER['DOCUMENT_ROOT']."/cms/parts/".$part.".part";
		}
		public static function exists($part){
			return file_exists(Part::path($part));
		}
		public static function set($part, $text){
			$part=preg_replace('@[^a-zA-Z_1-90]@', '', $part);
			if(Part::exists($part)){
				$text=str_replace("<?", "&lt;?", $text);
				$text=str_replace("<%", "&lt;%", $text);
				file_put_contents(Part::path($part), $text);
			}
			return new Result();
		}
		public static function get($part){
			$path=static::path($part);
			if(file_exists($path)){
				return(file_get_contents($path));
			}
			return(null);
		}
		#region Panel
		public static function setPanel($part){
			return Loc::set("panel", preg_replace('@[^a-zA-Z_1-90<>]@', '', $part));
		}
		public static function getPanel(){
			return Loc::get("panel");
		}
		#endregion
		#region Nav
		public static function setNav($part){
			return Loc::set("nav", preg_replace('@[^a-zA-Z_1-90<>]@', '', $part));
		}
		public static function getNav(){
			return Loc::get("nav");
		}
		#endregion
		#region GLOBAL
		public static function setAll(){
			$r=explode("|", $_POST['parts']);
			foreach($r as $part){
				Part::set($part, trim($_POST["E_".$part]));
			}
			return new Result();
		}
		#endregion
	}
}
?>