<?php
use \LCMS\Core;
use \LCMS\Core\Security\ELog;
ini_set("error_log", $_SERVER['DOCUMENT_ROOT']."/cms/php_error.log");
class NE{
	private static $no=false;
	public static function get(){
		return NE::$no;
	}
	public static function set(){
		NE::$no=true;
	}
}
function fatal_handler() {
	if(!NE::get()){
		$error = error_get_last();
		if( $error !== null) {
			$errno = $error["type"];
			$errfile = $error["file"];
			$errline = $error["line"];
			$errstr = $error["message"];
			escreen($errstr, $errno, array_merge(array(array('line'=>$errline, 'file'=>$errfile)), debug_backtrace()));
		}
	}
}
function exception_handler($ex){
	escreen($ex->getMessage(), $ex->getCode(), $ex->getTrace());
}
function error_handler($code, $message, $file, $line, $context){
	escreen($message, $code, debug_backtrace());
}
function escreen($message, $code, $trace){
	NE::set();
	$content=file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/escreen.html");
	$traceb="";
	$push="";
	$minus=0;
	for($i=0;$i<count($trace);$i++){
		$eline=false;
		if(!isset($trace[$i]["file"])){
			$minus++;
			continue;
		}
		$trace[$i]["file"]=str_replace("\\", "/", $trace[$i]["file"]);
		$a=explode('.', $trace[$i]["file"]);
		$b=explode('(', $a[count($a)-1]);
		$a[count($a)-1]=$b[0];
		$trace[$i]["file"]=implode('.', $a);
		if(isset($b[1])){
			$c=explode(')', $b[1]);
			if(isset($trace[$i]["line"])){
				$eline=$trace[$i]["line"];
			}
			$trace[$i]["line"]=$c[0];
			$trace[$i]["function"]="eval";
		}
		if(file_exists($trace[$i]["file"])){
			$push.='arr.push(new File("'.$trace[$i]["file"].'", '.$trace[$i]["line"].', "'.base64_encode(file_get_contents($trace[$i]["file"])).'"));';
			$traceb.='<div class="tr" id="'.($i-$minus).'" onclick="cl(this)">'.Core\htmlchars($trace[$i]["file"]).'<br>LINE:'.($trace[$i]["line"]).(($eline)?(":".$eline):("")).((isset($trace[$i]["function"]))?('<br>'.Core\htmlchars($trace[$i]["function"]).'();'):('')).'</div>';
		}
	}
	$content=str_replace("//PUSH", $push, $content);
	$content=str_replace("<!--TRACE-->", ($traceb), $content);
	$content=str_replace("<!--MESSAGE-->", Core\htmlchars($message), $content);
	$content=Core\htmlchars($content);
	if( @file_exists(__DIR__ .'/location/lock.loc')){
		@unlink(__DIR__ .'/location/lock.loc');
	}
	echo('">"\'>\'</textarea></textarea></textarea></iframe></iframe></iframe></iframe>');//hack to display anywhere
	echo('<script>document.querySelectorAll("*").forEach(function(e){e.style.display="block";});</script>');
	die('<input type="button" onclick="top.document.getElementById(\'exceptionframe\').style.display=\'block\';" style="font-family: monospace;background-image:none;box-sizing: border-box;padding: 12px;border-width: 0;border-radius: 50%;background-color: #336e54;color: #bbbbbb;position: fixed;left: 0;bottom: 0;outline: 0;" value="open&nbsp;" /><iframe id="exceptionframe" style="box-sizing: border-box;border-width: 0;width: 100%;height: 100%;top: 0;left: 0;right: 0;bottom:0; position: fixed;padding: 0px;margin: 0px;" srcdoc="'.$content.'"></iframe>');
}
function exfail($ex){
	ELog::Logged("[PHP ERROR] code: ".($ex->getCode()).", msg:".($ex->getMessage())."]".($ex->getFile()).":".($ex->getLine()).", in:".date("H:i:s").'&nbsp;'.date("d.m.Y"));
}
function erfail($code, $message, $file, $line, $context){
	ELog::Logged("[PHP ERROR] code: ".($code).", msg:".($message)."]".($file).":".($line).", in:".date("H:i:s").'&nbsp;'.date("d.m.Y"));
}
if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/e.h")){
	error_reporting(E_ALL);
	set_error_handler('error_handler');
	set_exception_handler('exception_handler');
	register_shutdown_function("fatal_handler");
}else{
	error_reporting(~E_ALL);
	set_error_handler('erfail');
	set_exception_handler('exfail');
}
?>
