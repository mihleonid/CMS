<?php
namespace LCMS\Core\Modules{
	use \LCMS\Core\Actions\Result;
	use \LCMS\Core\Enviroment\Loc;
	use \LCMS\Core\Security\ELog;
	use \LCMS\Core\Patterns\Pattern;
	use \LCMS\Core\Patterns\Part;
	class ScriptModules{
		const Type=2;
		const PHP=1;
		const CSS=2;
		const JS=4;
		public static function isInstalled($name, $lang=null){
			$name=trim($name);
			if($lang==null){
				$lang=ScriptModules::PHP|ScriptModules::JS|ScriptModules::CSS;
			}
			$php=ScriptModules::get(ScriptModules::PHP);
			$css=ScriptModules::get(ScriptModules::CSS);
			$js=ScriptModules::get(ScriptModules::JS);
			if(($lang&ScriptModules::PHP)>0){
				if(!isset($php[$name])){
					return false;
				}
			}
			if(($lang&ScriptModules::CSS)>0){
				if(!isset($css[$name])){
					return false;
				}
			}
			if(($lang&ScriptModules::JS)>0){
				if(!isset($js[$name])){
					return false;
				}
			}
			return true;
		}
		public static function edit($name, $php, $css, $js){
			$text=array();
			$php=trim($php);
			$css=trim($css);
			$js=trim($js);
			if($php!=""){
				$text['php']=$php;
			}
			if($css!=""){
				$text['css']=$css;
			}
			if($js!=""){
				$text['js']=$js;
			}
			if($text==array()){
				unlink("moduls/script/$name.pack");
			}else{
				$text=serialize($text);
				file_put_contents("moduls/script/$name.pack", $text);
			}
			return new Result();
		}
		public static function rename($pack, $name){
			$pack=preg_replace('@[^a-zA-Z_1-90]@', '', $pack);
			$name=preg_replace('@[^a-zA-Z_1-90]@', '', $name);
			if(!empty($name)){
				rename("moduls/script/$pack.pack", "moduls/script/$name.pack");
				return new Result();
			}else{
				return new Result("Невозможно переименовать в безымянный");
			}
		}
		public static function delete($scripts, $name){
			$name=preg_replace('@[^a-zA-Z_1-90]@', '', $name);
			if(!empty($scripts)){
				$text=unserialize(file_get_contents("moduls/script/$name.pack"));
				if(!is_array($scripts)){
					$scripts=array($scripts);
				}
				foreach($scripts as $script){
					$script=preg_replace('@[^a-zA-Z_1-90]@', '', $script);
					if(isset($text[$script])){
						unset($text[$script]);
					}
				}
				if(!empty($text)){
					file_put_contents("moduls/script/$name.pack", serialize($text));
				}else{
					unlink("moduls/script/$name.pack");
				}
			}
			return new Result();
		}
		public static function uninstall($name, $script){
			$script=preg_replace('@[^a-zA-Z_1-90]@', '', $script);
			$name=preg_replace('@[^a-zA-Z_1-90]@', '', $name);
			$text=file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/scripts/".$script.".seria");
			$text=unserialize($text);
			unset($text[$name]);
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/scripts/".$script.".seria", serialize($text));
			return new Result();
		}
		public static function create($texta,  $name, $zamena="false", $UN){
			if(!is_array($texta)){
				Elog::Logged("[USER ATTACK] action: newScript, name:".$UN.", in:".date("H:i:s").'&nbsp;'.date("d.m.Y"));
				return new Result("Ошибка");
			}
			$name=preg_replace('@[^a-zA-Z_1-90]@', '', $name);
			$error= new Result();
			foreach($texta as $linel=>$linela){
				if(trim($linela)==""){
					continue;
				}
				if(($linel=="js")or($linel=="php")or($linel=="css")){
					$scriptsArray[]=$linel;
				}
			}
			if(!empty($scriptsArray)){
				if($zamena=="false"){
					$namet="!";
					while(file_exists("moduls/script/$name.pack")){
						if($namet=="!"){
							$namet=$name;
						}
						$name.="d";
						$error->addError("Переименованно из ".$namet." в ".$name);
					}
				}
				$text=array();
				foreach($scriptsArray as $script){
					$text[$script]=$texta[$script];
				}
				$text=serialize($text);
				file_put_contents("moduls/script/$name.pack", $text);
			}
			return $error;
		}
		public static function install($scriptsArray, $name){
			if(!empty($scriptsArray)){
				$name=preg_replace('@[^a-zA-Z_1-90]@', '', $name);
				$text=unserialize(file_get_contents("moduls/script/$name.pack"));
				if(!is_array($scriptsArray)){
					$scriptsArray=array($scriptsArray);
				}
				foreach($scriptsArray as $script){
					$script=preg_replace('@[^a-zA-Z_1-90]@', '', $script);
					if(isset($text[$script])){
						$scripts=$text[$script];
						$fh=file_get_contents("scripts/$script.seria");
						$texti=unserialize($fh);
						$texti[$name]=$scripts;
						file_put_contents("scripts/$script.seria", serialize($texti));
					}
				}
			}
			return new Result();
		}
		private static function path($type){
			if(is_string($type)){
				$type=strtolower($type);
				switch($type){
					case "js":
						$type=ScriptModules::JS;
					break;
					case "css":
						$type=ScriptModules::CSS;
					break;
					case "php":
						$type=ScriptModules::PHP;
					break;
				}
			}
			if($type==ScriptModules::PHP){
				return $_SERVER['DOCUMENT_ROOT']."/cms/scripts/php.seria";
			}
			if($type==ScriptModules::CSS){
				return $_SERVER['DOCUMENT_ROOT']."/cms/scripts/css.seria";
			}
			if($type==ScriptModules::JS){
				return $_SERVER['DOCUMENT_ROOT']."/cms/scripts/js.seria";
			}
			throw new \Exception("Unknown type");
		}
		public static function get($type){
			return unserialize(file_get_contents(ScriptModules::path($type)));
		}
		public static function getHTML($type, $params=null){
			$html="";
			if($params===null){
				$html='<select name="namm['.$type.']">';
			}else{
				$html="<select $params>";
			}
			foreach(static::get($type) as $match=>$val){
				$html.="<option value=\"$match\">$match</option>";
			}
			return $html."</select>";
		}
	}
	class Plugins{
		const Type=1;
		private static function log($paph, $fulluninstall, $halfuninstall){
			$log=array();
			$r=new Result();
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/plug.log")){
				$log=unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/plug.log"));
			}else{
				$r=new Result("Структура лога повреждена. Попытка исправить закончилась успешно.");
			}
			$log[$paph][0]=$fulluninstall;
			$log[$paph][1]=$halfuninstall;
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/plug.log", serialize($log));
			return $r;
		}
		public static function install($plug){
			$paph=str_replace('.', '', $plug);
			$path="moduls/plugins/$paph.pack";
			if(file_exists($path)){
				$plug=unserialize(file_get_contents($path));
				$r=static::log($paph, $plug[1], $plug[2]);
				eval($plug[0]);
				return $r;
			}else{
				return new Result("Инсталлятор отсутствует");
			}
		}
		public static function obnov($text){
			$_SERIA=unserialize($text);
			$_DATA=$_SERIA['data'];
			$_CODE=$_SERIA['code'];
			eval($_CODE);
		}
		public static function uninstall($paph, $save=false){
			$log=unserialize(file_get_contents("moduls/logs/plug.log"));
			$r=null;
			if(isset($log[$paph])){
				if($save){
					eval($log[$paph][1]);
					$r=new Result();
				}else{
					eval($log[$paph][0]);
					if(class_exists("\\LCMS\\MainModules\\Uninstaller")){
						\LCMS\MainModules\Uninstaller::uninstall($paph);
						$r=new Result();
					}else{
						$r=new Result("Удаление могло быть не завершино. Рекомендуется использовать модуль <code>Uninstaller</code>.");
					}
				}
				unset($log[$paph]);
				file_put_contents("moduls/logs/plug.log", serialize($log));
			}
			return $r;
		}
		public static function getInstalled(){
			$arr=array();
			$file=unserialize(file_get_contents("moduls/logs/plug.log"));
			foreach($file as $lin=>$k){
				$arr[]=$lin;
			}
			return $arr;
		}
		public static function getInstalledHTML(){
			$arr="";
			$file=unserialize(file_get_contents("moduls/logs/plug.log"));
			foreach($file as $lin=>$k){
				$arr.="<option value=\"$lin\">$lin</option>";
			}
			return $arr;
		}
		public static function isInstalled($name){
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/plug.log")){
				$log=file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/plug.log");
				$log=unserialize($log);
				if(isset($log[$name])){
					return true;
				}else{
					return false;
				}
			}else{
				file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/moduls/logs/plug.log", serialize(array()));
				return false;
			}
		}
		private static function path($pack){
			return($_SERVER['DOCUMENT_ROOT']."moduls/plugins/".preg_replace("@[^a-zA-Z1-90]@", "", $pack).".pack");
		}
		public static function exists($pack){
			return(file_exists(static::path($pack)));
		}
		public static function delete($pack){
			$path= static::path($pack);
			if(file_exists($path)){
				unlink($path);
			}
			return new Result();
		}
		public static function create($name, $install, $fulluninstall, $halfuninstall){
			file_put_contents(static::path($name), serialize(array($install, $fulluninstall, $halfuninstall)));
			return new Result();
		}
	}
	class Modularity{
		public static function isInstalled($what, $name, $lang=null){
			$name=trim($name);
			switch($what){
				case Pattern::Type:
					return Pattern::exists($name);
				case ScriptModules::Type:
					return ScriptModules::isInstalled($name, $lang);
				case Part::Type:
					return Part::exists($name);
				case Plugins::Type:
					return Plugins::isInstalled($name);
			}
			return null;
		}
	}
}
?>