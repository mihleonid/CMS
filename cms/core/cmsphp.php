<?php
namespace{
function txt($str){
	$str=preg_replace_callback('@\-\-\-(.*?)\-\-\-@', "\\LCMS\\Core\\Actions\\locale", $str);
	echo($str);
}
function path($path){
	return str_replace('\\', '/', realpath($path));
}
function write_file($filename, $content=""){
	$dir=dirname($filename);
	if(!file_exists($dir)){
		mkdir($dir, 0777, true);
	}
	file_put_contents($filename, $content);
}
function smartHTML($html, $data=null){
	return \LCMS\Core\Pages\smartHTML($html, $data);
}
function plain($str, $locale=false){
	if($locale){
		txt(htmlchars($str));
	}else{
		echo \LCMS\Core\htmlchars($str);
	}
}
function l($loc, $return=false){
	if($return){
		return \LCMS\Core\Enviroment\Locale::get($loc);
	}else{
		\LCMS\Core\Enviroment\Locale::e($loc);
	}
}
function htmlchars($str){
	return \LCMS\Core\htmlchars($str);
}
function data($par, $arr=0){
		if(is_null($par)){
			$str='<code><big style="color: rgba(0, 0, 0, 0.6);">'. \LCMS\Core\Enviroment\Locale::get('datatype.value.null').'</big></code>';
		}elseif(is_string($par)){
			$str="<code style=\"color: black;\">\"".htmlentities($par, 0, 'utf-8')."\"</code>";
		}elseif(is_int($par)){
			$str="<code style=\"color: black;\">".htmlentities($par, 0, 'utf-8')."</code>";
		}elseif(is_float($par)){
			$str="<code style=\"color: black;\">f".htmlentities($par, 0, 'utf-8')."</code>";
		}elseif(is_bool($par)){
			$str="<code>".(($par)?('<span style="color: green;">'. \LCMS\Core\Enviroment\Locale::get('datatype.value.true').'</span>'):('<span style="color: red;">'. \LCMS\Core\Enviroment\Locale::get('datatype.value.false').'</span>'))."</code>";
		}elseif(is_array($par)){
			$str=((!$arr)?('<pre style="text-align: left; color: blue;">'):('')). \LCMS\Core\Enviroment\Locale::get('datatype.value.array')."(\r\n";
			foreach($par as $k=>$l){
				$str.=str_repeat("\t", $arr+1)."[".data($k)."] => ".data($l, $arr+1)."\r\n";
			}
			$str.=str_repeat("\t", $arr).")".((!$arr)?("</pre>"):(''));
			//$str='<pre style="text-align: left;">'.htmlentities(print_r($par, true), 0, 'utf-8')."</pre>";
		}else{
			$str="<code style=\"color: black;\">Неизвестный тип данных</code>";
		}
		return $str;
	}
}
namespace LCMS\Core{
	function htmlchars($str){
		return trim(htmlentities($str, ENT_QUOTES, 'utf-8'));
	}
}
?>