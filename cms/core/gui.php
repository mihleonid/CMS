<?php
namespace LCMS\Core\GUI{
	use \LCMS\Core\Actions\Result;
	use \LCMS\Core\Enviroment\Loc;
	use \LCMS\Core\IO\File;
	class Web{
		public static function headerCache($step=null){
			if($step==null){
				$step=Loc::get("cache");
			}
			$step=strtolower($step);
			if($step=="no"){
				@header("Expires: 0", true);
				@header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT", true);
				@header("Cache-Control: no-store, no-cache, must-revalidate, max-age=1, s-maxage=1, proxy-revalidate", true);
				@header("Cache-Control: post-check", false);
				@header("Pragma: no-cache", true);
			}elseif($step=="public"){
				@header("Cache-Control: public, max-age=2592000", true);
			}elseif($step=="private"){
				@header("Cache-Control: private, max-age=2592000", true);
			}elseif($step=="cache"){
				@header("Cache-Control: private, public, max-age=2592000", true);
			}
			return new Result();
		}
		public static function getMime($mime){
			switch(strtolower($mime)){
				case "html":
				case "htm":
				case "php":
					return "text/html";
				case "css":
					return "text/css";
				case "txt":
					return "text/plain";
				case "js":
				case "javascript":
					return "text/javascript";
				case "ico":
					return "image/x-icon";
				case "png":
					return "image/png";
				case "gif":
					return "image/gif";
				case "jpeg":
				case "jpg":
					return "image/jpeg";
				case "wav":
					return "audio/wav";
				case "mp4":
					return "video/mp4";
				case "avi":
					return "video/avi";
				case "file":
					return "application/octet-stream";
				case "pdf":
					return "application/pdf";
				default:
					return $mime;
			}
		}
		public static function headerEncode($mime="html", $encode="utf-8"){
			$mime=Web::getMime($mime);
			@header('Content-Type: '.$mime.'; charset='.$encode, true);
			return new Result;
		}
		public static function HTTPCode($code){
			switch($code){
				case 100:
					@header("HTTP/1.1 100 Continue");
					break;
				case 101:
					@header("HTTP/1.1 101 Swithing Protocols");
					break;
				case 200:
					@header("HTTP/1.1 200 OK");
					break;
				case 201:
					@header("HTTP/1.1 201 Created");
					break;
				case 202:
					@header("HTTP/1.1 202 Accepted");
					break;
				case 203:
					@header("HTTP/1.1 203 Non-Authorirative Information");
					break;
				case 204:
					@header("HTTP/1.1 204 No Content");
					break;
				case 205:
					@header("HTTP/1.1 205 Reset Content");
					break;
				case 206:
					@header("HTTP/1.1 206 Partial Content");
					break;
				case 207:
					@header("HTTP/1.1 207 Multi-Status");
					break;
				case 208:
					@header("HTTP/1.1 208 Already Reported");
					break;
				case 226:
					@header("HTTP/1.1 226 IM Used");
					break;
				case 300:
					@header("HTTP/1.1 300 Multiple Choises");
					break;
				case 301:
					@header("HTTP/1.1 301 Move Permanently");
					break;
				case 302:
					@header("HTTP/1.1 302 Move Temporarily");
					break;
				case 304:
					@header("HTTP/1.1 302 Not Modified");
					break;
				case 400:
					@header("HTTP/1.1 400 Http Error");
					break;
				case 403:
					@header("HTTP/1.1 403 Forbidden");
					break;
				case 404:
					@header("HTTP/1.1 404 Not Found");
					break;
				case 407:
					@header("HTTP/1.1 407 Proxy Error");
					break;
				case 410:
					@header("HTTP/1.1 410 Deleted");
					break;
				case 500:
					@header("HTTP/1.1 500 Internal Server Error");
					break;
				default:
					@header("HTTP/1.1 ".$code);
					break;
			}
			return new Result();
		}
	}
	class Themes{
		#region GLOBAL
		public static function loadThemes(){
			$error= new Result();
			foreach($_FILES['pages']['name']['texts'] as $i=>$k){
				if($_FILES['pages']['error']['texts'][$i]==0){
					$ext=pathinfo($k);
					$ext=$ext['extension'];
					$int=1;
					while(file_exists("themes/".$int.".".$ext)){
						$int+=1;
					}
					$filename="themes/".$int.".".$ext;
					if(move_uploaded_file($_FILES['pages']['tmp_name']['texts'][$i], $filename)){
						if((trim($_POST['pages']['names'][$i])!="")and(trim($_POST['pages']['ops'][$i])!="")){
							file_put_contents("themes.db", trim(file_get_contents("themes.db")."\r\n".$int.".".$ext."|".trim($_POST['pages']['names'][$i])."|".trim($_POST['pages']['ops'][$i])));
						}
					}else{
						$error->addError(" Невозможно переместить $k ");
					}
				}else{
					$error->addError(" Ошибка подгрузки $k #".$_FILES['pages']['error']['texts'][$i]);
				}
			}
			return $error;
		}
		#endregion
		public static function packThemes($namep, $themes, $zamena="true"){
			$error= new Result();
			$namep=trim($namep);
			$dbf=file("themes.db");
			$db=array();
			foreach($dbf as $str){
				$str=explode("|", $str);
				$db[trim($str[0])]=array(trim($str[1]), trim($str[2]));
			}
			$arr=array();
			foreach($themes as $entry){
				if(isset($db[$entry])){
					$name=$db[$entry][0];
					$ops=$db[$entry][1];
				}else{
					$name="Без названия";
					$ops="Без описания";
				}
				$content=file_get_contents("themes/$entry");
				$ext=pathinfo($entry);
				$ext=$ext['extension'];
				$arr[]=array($content, $name, $ops, $ext);
				if($_POST['delis']=="on"){
					deltheme($entry);
				}
			}
			if($zamena=="false"){
				$namei=$namep;
				while(file_exists("moduls/themes/".$namep.".pack")){
					$namep.="d";
					$error->addError("Переименованно из ".$namei." в $namep .");
				}
			}
			$filename="moduls/themes/".$namep.".pack";
			$text=serialize($arr);
			file_put_contents($filename, gzdeflate($text, 9));
			return $error;
		}
		public static function deleteThemes($themes){
			$selected=trim(file_get_contents("location/fult.loc"));
			$fone=trim(file_get_contents("location/fuls.loc"));
			foreach($themes as $name){
				unlink("themes/$name");
				$db=file("themes.db");
				foreach($db as $dbc=>$dbv){
					$dbv=explode("|", $dbv);
					$dbv=trim($dbv[0]);
					if($dbv==$name){
						unset($db[$dbc]);
					}
				}
				$db=implode("", $db);
				file_put_contents("themes.db", trim($db));
				if($name==$selected){
					file_put_contents("bg/theme.part", "none");
					file_put_contents("location/fult.loc", "none");
				}
				if($name==$fone){
					file_put_contents("bg/fone.part", "none");
					file_put_contents("location/fuls.loc", "none");
				}
			}
			return new Result();
		}
		public static function delete($name){
			$name=str_replace('..', '', $name);
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/themes/$name")){
				$selected=trim(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/fult.loc"));
				$fone=trim(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/fuls.loc"));
				unlink($_SERVER['DOCUMENT_ROOT']."/cms/themes/$name");
				$db=file($_SERVER['DOCUMENT_ROOT']."/cms/themes.db");
				foreach($db as $dbc=>$dbv){
					$dbv=explode("|", $dbv);
					$dbv=trim($dbv[0]);
					if($dbv==$name){
						unset($db[$dbc]);
					}
				}
				$db=implode("", $db);
				file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/themes.db", trim($db));
				if($name==$selected){
					file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/bg/theme.part", "none");
					file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/fult.loc", "none");
				}
				if($name==$fone){
					file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/bg/fone.part", "none");
					file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/fuls.loc", "none");
				}
				return new Result();
			}else{
				return new Result("Тема уже удалена");
			}
		}
		public static function depackTheme($filename){
			$filename="moduls/themes/".trim($filename).".pack";
			$text=file_get_contents($filename);
			$arr=unserialize(gzinflate($text));
			foreach($arr as $ar){
				$ext=trim($ar[3]);
				$int=1;
				while(file_exists("themes/".$int.".".$ext)){
					$int+=1;
				}
				if((trim($ar[1])!="")and(trim($ar[2])!="")){
					file_put_contents("themes.db", trim(file_get_contents("themes.db")."\r\n".$int.".".$ext."|".trim($ar[1])."|".trim($ar[2])));
				}
				file_put_contents("themes/".$int.".".$ext, $ar[0]);
			}
			return new Result();
		}
		public static function deleteThemeDoubles(){
			$dir=dir("themes/");
			$arr=array();
			while(false!==($entry=$dir->read())){
				if(($entry!=".")and($entry!="..")){
					$content=file_get_contents("themes/$entry");
					if(in_array($content, $arr)){
						deltheme($entry);
					}else{
						$arr[]=$content;
					}
				}
			}
			return new Result();
		}
		public static function deleteThemePack($pack){
			unlink("moduls/themes/".trim($pack).".pack");
			return new Result();
		}
		public static function universalTheme($tsel, $name){
			$name=trim($name);
			$css=$name;
			if($name!="none"){
				$name=substr($name, 17, -2);
			}
			$selected= static::getTheme();
			$fone= static::getFone();
			$tsel=trim($tsel);
			if($tsel=="Удалить"){
				if($name!="none"){
					unlink("themes/$name");
					$db=file("themes.db");
					foreach($db as $dbc=>$dbv){
						$dbv=explode("|", $dbv);
						$dbv=trim($dbv[0]);
						if($dbv==$name){
							unset($db[$dbc]);
						}
					}
					$db=implode("", $db);
					file_put_contents("themes.db", trim($db));
					if($name==$selected){
						file_put_contents("bg/theme.part", "none");
						static::setTheme("none");
					}
					if($name==$fone){
						file_put_contents("bg/fone.part", "none");
						static::setFone("fuls", "none");
					}
				}else{
					return new Result("Невозможно удалить факт отсутствие темы!");
				}
			}elseif($tsel=="Настроить как тему CMS"){
				file_put_contents("bg/theme.part", "$css");
				return static::setTheme($name);
			}elseif($tsel=="Настроить как фон сайта"){
				file_put_contents("bg/fone.part", "$css");
				return static::setFone($name);
			}
			return new Result();
		}
		public static function getTheme(){
			return Loc::get("fult");
		}
		public static function getFone(){
			return Loc::get("fuls");
		}
		public static function setTheme($val){
			return Loc::set("fult", $val);
		}
		public static function setFone($val){
			return Loc::set("fuls", $val);
		}
	}
	class Highlight{
		public static function auto($allow="allow"){
			if($allow=="allow"){
				Loc::set("autowid", true);
			}else{
				Loc::set("autowid", false);
			}
			return new Result();
		}
		public static function delay($num){
			Loc::set("delay", intval(trim($num)));
			return new Result();
		}
		public static function str($str){
			return highlight_string($str);
		}
		public static function file($file){
			return highlight_file($file);
		}
		#region GLOBAL
		public static function set(){
			$arr=array();
			foreach(array("com", "def", "htm", "key", "str", "var") as $i){
				$str="rgba(";
				$str.=$_POST[$i.'_r'];
				$str.=", ";
				$str.=$_POST[$i.'_g'];
				$str.=", ";
				$str.=$_POST[$i.'_b'];
				$str.=", ";
				$str.=str_replace(",", ".", $_POST[$i.'_a']);
				$str.=")";
				if(isset($_POST[$i.'_bo'])){
					$str.="; font-weight: bold";
				}
				if(isset($_POST[$i.'_i'])){
					$str.="; font-style: italic";
				}
				if(isset($_POST[$i.'_u'])){
					$str.="; text-decoration: underline";
				}
				if(isset($_POST[$i.'_t']) and(!isset($_POST[$i.'_u']))){
					$str.="; text-decoration: line-through";
				}elseif(isset($_POST[$i.'_t'])){
					$str.=" line-through";
				}
				if(isset($_POST[$i.'_o']) and(!isset($_POST[$i.'_u'])) and(!isset($_POST[$i.'_t']))){
					$str.="; text-decoration: overline";
				}elseif(isset($_POST[$i.'_o'])){
					$str.=" overline";
				}
				$arr[$i]=$str;
			}
			$_POST['page']="highl.php";
			Loc::set("highlight", $arr);
			return new Result();
		}
		#endregion
	}
	class Gallery{
		public static function upload(){
			$result=new Result();
			foreach($_FILES['doc']['error'] as $numer=>$errorw){
				if($errorw!=0){
					$result->add("Ошибка: ".$_FILES['doc']['name'][$numer].". ");
					continue;
				}
				$white= \LCMS\Modules\File\WhiteImg::get();
				if(isset($_POST['name']) and ($_POST['name']!="") and isset($_POST['ext']) and ($_POST['ext']!="")){
					$ext=preg_replace("@[^a-zA-Z]@", "", strtolower($_POST['ext']));
					if(isset($white[$ext])){
						$name=preg_replace("@[^a-zA-Z]@", "", $_POST['name']).".".$ext;
					}else{
						$result->add("Неверное расширение: ".$_FILES['doc']['name'][$numer].". ");
						continue;
					}
				}else{
					$name=strtolower($_FILES['doc']['name'][$numer]);
					$name=explode('.', $name);
					$ext=preg_replace("@[^a-zA-Z]@", "", $name[1]);
					if(isset($white[$ext])){
						$name=preg_replace("@[^a-zA-Z]@", "", $name[0]).".".$ext;
					}else{
						$result->add("Неверное расширение: ".$_FILES['doc']['name'][$numer].". ");
						continue;
					}
				}
				move_uploaded_file($_FILES['doc']['tmp_name'][$numer], File::unique_path($_SERVER['DOCUMENT_ROOT']."/cms/gallery/".$name));
			}
			return $result;
		}
	}
}
?>