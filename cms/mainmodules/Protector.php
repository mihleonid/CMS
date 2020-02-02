<?php
namespace LCMS\MainModules{
	use \LCMS\Core\Actions\Result;
	use \LCMS\Core\Enviroment\Loc;
	class Protector{
		protected static $ProtectorMode=null;
		public static function mode(){
			if(static::$ProtectorMode==null){
				static::$ProtectorMode=((Loc::get("protector", false)=="ON")?(true):(false));
			}
			return static::$ProtectorMode;
		}
		public static function reset(){
			return Protector::set(!Protector::mode());
		}
		public static function set($p){
			if($p===true){
				$p="ON";
			}
			if($p!="ON"){
				$p="OFF";
			}
			Loc::set("protector", $p, false);
			return new Result();
		}
	}
}
?>