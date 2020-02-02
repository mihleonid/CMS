<?php
namespace LCMS\Modules\File{
	use \LCMS\Core\Actions\Result;
	class WhiteImg{
		public static function get(){
			$fi=file($_SERVER['DOCUMENT_ROOT']."/cms/file/codec/extensioni.db");
			$arr=array();
			foreach($fi as $ff){
				$ff=trim($ff);
				$ff=explode("|", $ff);
				if($ff[1]=="pic"){
					$arr[$ff[0]]=true;
				}
			}
			return $arr;
		}
		public static function getTypes(){
			$fi=file($_SERVER['DOCUMENT_ROOT']."/cms/file/codec/extension.db");
			$mimesa=array();
			foreach($fi as $ff){
				$ff=trim($ff);
				$ff=explode("|", $ff);
				$mimesa[$ff[0]]=$ff[1];
			}
			$fi=file($_SERVER['DOCUMENT_ROOT']."/cms/file/codec/extensioni.db");
			$arr=array();
			foreach($fi as $ff){
				$ff=trim($ff);
				$ff=explode("|", $ff);
				if(($ff[1]=="pic")and(isset($mimesa[$ff[0]]))){
					$arr[$ff[0]]=$mimesa[$ff[0]];
				}
			}
			return $arr;
		}
	}
	class Set{
		public static function universalExt($path, $tsel, $extSet, $exten, $exti){
			if($tsel=="Настроить"){
				if(!empty($extSet)){
					if(!is_array($extSet)){
						$extSet=array($extSet);
					}
					$array=array();
					foreach($extSet as $ext=>$type){
						$type=trim($type);
						if($type!="<del>"){
							$array[]=$ext."|".$type;
						}
					}
					$string=implode("\r\n", $array);
					file_put_contents("file/codec/extension".$path.".db", trim($string));
				}
			}elseif($tsel=="Новое"){
				$fil=file_get_contents("file/codec/extension".$path.".db");
				$exten=trim($exten);
				$exti=trim($exti);
				$fil.="\r\n$exten|$exti";
				file_put_contents("file/codec/extension".$path.".db", trim($fil));
			}
			return new Result();
		}
	}
}
?>