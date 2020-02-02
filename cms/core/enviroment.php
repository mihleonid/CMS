<?php
namespace{
	function Loc_Flush(){
		LCMS\Core\Enviroment\Loc::flush();
	}
}
namespace LCMS\Core\Enviroment{
	register_shutdown_function("Loc_Flush");
	use LCMS\Core\Actions\Result;
	use LCMS\Core\Actions\Action;
	use LCMS\Core\Archiver\Compressor;
	use LCMS\MainModules\CHTML;
	use LCMS\Core;
	class Loc{
		private static $loc=null;
		private static $was=false;
		#region cache
		public static function load(){
			if(static::$loc===null){
				if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/file.loc")){
					static::$loc=unserialize(Compressor::uncompress(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/file.loc")));
					return new Result();
				}else{
					static::$loc=array();
					file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/file.loc", Compressor::compress(serialize(static::$loc)));
					return new Result("Ошибка переменных окружения. Попытка исправить закончилась успешно.");
				}
			}
			return new Result();
		}
		public static function flush(){
			$r=null;
			if(Loc::$was){
				$r=Loc::load();
				file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/file.loc", Compressor::compress(serialize(static::$loc)));
			}else{
				$r=new Result();
			}
			return $r;
		}
		#endregion
		#region prime
		public static function exists($name){
			$name=preg_replace("@[^a-zA-Z1-90_]@", "", $name);
			if($name==""){
				$name='new';
			}
			Loc::load();
			return isset(Loc::$loc [$name]);
		}
		public static function set($name, $data){
			$name=preg_replace("@[^a-zA-Z1-90_]@", "", $name);
			if($name==""){
				$name='new';
			}
			$r=Loc::load();
			Loc::$loc [$name]=$data;
			Loc::$was=true;
			return $r;
		}
		public static function delete($name){
			$name=preg_replace("@[^a-zA-Z1-90_]@", "", $name);
			if($name==""){
				$name='new';
			}
			$r=Loc::load();
			if(array_key_exists($name, Loc::$loc)){
				unset(Loc::$loc [$name]);
				Loc::$was=true;
			}else{
				$r->add("Уже удалено[$name]");
			}
			return $r;
		}
		public static function get($name){
			$name=preg_replace("@[^a-zA-Z1-90_]@", "", $name);
			if($name==""){
				$name='new';
			}
			Loc::load();
			if(isset(Loc::$loc [$name])){
				return Loc::$loc [$name];
			}
			return null;
		}
		#endregion
		public static function getall(){
			Loc::load();
			return Loc::$loc;
		}
		public static function echoall(){
			txt('<table><tr><th>---title---</th><th>---value---</th><th>---change-value---</th><th>---delete---</th></tr>');
			foreach(static::getall() as $k=>$l){
				echo('<tr><td><div title="'.$k.'">'.Locale::get("loc.".$k).'</div></td><td>'.data($l).'</td><td>'.((is_string($l)or is_bool($l)or is_int($l)or is_float($l)or is_null($l))?(Action::n("locchange", array('k'=>$k, 'l'=>$l, 'b'=>is_bool($l), 'n'=>is_null($l), 's'=>is_string($l), 'i'=>is_int($l), 'f'=>is_float($l)))):(Locale::get('no-editing'))).'</td><td>'.Action::n("locdel", $k).'</td></tr>');
			}
			echo('<tr><td><div title="new>">'.Locale::get("new").'</div></td><td colspan="3" style="text-align: right;">'.Action::n("loccreate").'</td></tr>');
			echo('</table>');
		}
	}
	class CMSEnv{
		#region ShopPath
		public static function getShopPath(){
			return Loc::get("magaz");
		}
		public static function setShopPath($val){
			return Loc::set("magaz", $val);
		}
		#endregion
		#region Version
		public static function getVersion(){
			return Loc::get("version");
		}
		public static function changeVersion($version){
			return Loc::set("version", $version);
		}
		#endregion
		#region Timezone
		public static function getTimezone(){
			return Loc::get("timezone");
		}
		public static function setTimezone($timezone){
			return Loc::set("timezone", $timezone);
		}
		#endregion
		#region CacheMode
		public static function getCacheMode(){
			return Loc::get("cache");
		}
		public static function setCacheMode($mode){
			return Loc::set("cache", $mode);
		}
		#endregion
		#region ObnovPath
		public static function getObnovPath(){
			return Loc::get("new");
		}
		public static function setObnovPath($path){
			return Loc::set("new", $path);
		}
		#endregion
		#region FeedBack
		#region CreaterPath
		public static function getCreaterPath(){
			return Loc::get("adminpath");
		}
		public static function setCreaterPath($path){
			return Loc::set("adminpath", trim($path));
		}
		#endregion
		#todo do
		public static function sendMessageToCreater($subject, $content){
			if(trim($subject)==""){
				$subject="NO_THEME";
			}
			$content= Core\htmlchars($content);
			$subject= Core\htmlchars("CMS_".$subject);
			$name=$_SERVER['SERVER_NAME'];
			$addr=$_SERVER['SERVER_ADDR']." as ".$_SERVER['REMOTE_ADDR'];
			$mail= Core\htmlchars($_POST['mail']);
			$content.="\r\n\r\n\t$mail\r\n\t\t$addr\t:\t$name";
			mail("info@nt10.ru", $subject, $content);
			return new Result();
		}
		#endregion
		#region Buffering
		public static function getBuffering(){
			$a=Loc::get("obuffered");
			if($a=="ON"){
				return true;
			}else{
				return false;
			}
		}
		public static function setBuffering($speed){
			if($speed===true){
				$speed="ON";
			}
			if($speed==false){
				$speed="OFF";
			}
			return Loc::set("obuffered", (($speed=="ON")?("ON"):("OFF")));
		}
		#endregion
		#region Eco
		public static function getEcoMode(){
			return Loc::get('ecomode');
		}
		public static function setEcoMode($b){
			if($b){
				return Loc::set('ecomode', true);
			}else{
				return Loc::set('ecomode', false);
			}
		}
		public static function getEco(){
			return intval(Loc::get('eco'));
		}
		public static function eco($plus){
			$eco=intval(Loc::get('eco'));
			$plus=intval($plus);
			return Loc::set('eco', $eco+$plus);
		}
		#endregion
	}
	class Config{
		public static function setHtaccessAll($text){
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/.htaccess", trim($text));
			return new Result();
		}
		public static function setHtaccessCMS($text){
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/.htaccess", trim($text));
			return new Result();
		}
		public static function setIniCMS($text){
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/php.ini", trim($text));
			return new Result();
		}
	}
	class Timezone{
		public static function date($tz=null){
			if($tz==null){
				$tz=Timezone::get();
			}
			if($tz==null){
				$tz='Europe/Moscow';
				Timezone::set($tz);
			}
			$tz=Timezone::correct($tz);
			date_default_timezone_set('America/Los_Angeles');
			date_default_timezone_set('Europe/Moscow');
			date_default_timezone_set($tz);
			return new Result();
		}
		public static function set($tz){
			return Loc::set("timezone", $tz);
		}
		public static function get(){
			return Loc::get("timezone");
		}
		private static function correct($tz){
			$tt=array('Europe/Moscow'=>true, 'America/Los_Angeles'=>true);
			if(!isset($tt[$tz])){
				return('Europe/Moscow');
			}
			return($tz);
		}
	}
	class Locale{
		private static function currentpath(){
			return $_SERVER['DOCUMENT_ROOT'].'/cms/localization/current.file';
		}
		private static function localepath($locale=null){
			if($locale==null){
				$locale=static::current();
			}
			return $_SERVER['DOCUMENT_ROOT'].'/cms/localization/'.$locale.'.lcz';
		}
		public static function current(){
			if(file_exists(static::currentpath())){
				return file_get_contents(static::currentpath());
			}else{
				return "NO";
			}
		}
		public static function setLocale($locale){
			file_put_contents(static::currentpath(), substr(preg_replace("@[^a-z]@", "", strtolower(strval($locale)))."NNN", 0, 3));
		}
		public static function get($key){
			$path=static::localepath();
			if(file_exists($path)){
				$content=file_get_contents($path);
				$ret=trim(CHTML::cPath($content, $key));
				$depth=20;
				while(strpos($ret, '---')!==false){
					$ret=trim(preg_replace_callback('@\-\-\-(.*?)\-\-\-@', "\\LCMS\\Core\\Actions\\locale", $ret));
					if(($depth--)==0){
						return "Localization error [MaxDepth]";
					}
				}
				if($ret!=""){
					return $ret;
				}else{
					$c=explode('.', $key);
					return $c[count($c)-1];
				}
			}else{
				$c=explode('.', $key);
				return $c[count($c)-1];
			}
		}
		public static function e($k){
			echo(static::get($k));
		}
	}
}
?>