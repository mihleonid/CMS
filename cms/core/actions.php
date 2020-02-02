<?php
namespace LCMS\Core\Actions{
	use \LCMS\Core\Enviroment\Loc;
	use \LCMS\Core\Enviroment\Locale;
	use \LCMS\Core\Security\Counter;
	use \LCMS\Core\Security\Salt;
	use \LCMS\Core\Users\Stats;
	use \LCMS\Core\Users\Users;
	use \LCMS\Core;
	use \LCMS\MainModules\CHTML;
	class Result{
		private $error;
		public $text;
		public $canceldownload;
		private $ok;
		private $no;
		public function __construct($str="", $t=""){
			$this->canceldownload=false;
			$this->error=$str;
			$this->text=$t;
			if((strtolower($str)=="ok")or($str=="")){
				$this->ok=true;
			}else{
				$this->ok=false;
			}
		}
		public function __toString(){
			return $this->error;
		}
		public function addError($str){
			$this->error=trim(($this->error)."<br>".$str);
			if(strpos($this->error, "<br>")===0){
				$this->error =substr($this->error, 4);
			}
			$this->ok=false;
		}
		public function add($str){
			$this->addError($str);
		}
		public function getError(){
			return $this->error;
		}
		#region Ok
		public function setOk($ok){
			$this->ok=$ok;
		}
		public function resetOk(){
			$this->setOk(!($this->getOk()));
		}
		public function getOk(){
			return $this->ok;
		}
		#endregion
		#region NoExit
		public function setNo($ok){
			$this->no=$ok;
		}
		public function resetNo(){
			$this->setOk(!($this->getOk()));
		}
		public function getNo(){
			return $this->no;
		}
		#endregion
	}
	class ALog{
		public static function add($act){
			if(filesize(ALog::path())<93000){
				if(file_exists(ALog::path())){
					file_put_contents(ALog::path(), trim(date("d.m.Y H:i:s")."|".$GLOBALS['AUTH'][0]."|".$act."\r\n".file_get_contents("actions.log")));
				}else{
					file_put_contents(ALog::path(), trim(date("d.m.Y H:i:s")."|".$GLOBALS['AUTH'][0]."|".$act));
				}
			}
		}
		public static function path(){
			return $_SERVER['DOCUMENT_ROOT']."/cms/actions.log";
		}
	}
	class Form{
		public $html=array();
		public function __construct(){}
		public static function Sheader(){
			$c=Counter::get();
			$s=Salt::get();
			return '<input type="hidden" name="ZZZ_OF" value="'.$s.'"><input type="hidden" name="UNKEY" value="'.$c.'">';
		}
		private static function input($name, $arr){
			//print_r($arr);
			//die($name);
			$param=array();
			$prelabel="";
			$postlabel="";
			foreach($arr as $p=>$k){
				if(($k==null)or($k===false)){
					continue;
				}
				if(($p=="label")or($p=="prelabel")){
					$prelabel=($k).": ";
					continue;
				}
				if($p=="postlabel"){
					$postlabel=" ".($k);
					continue;
				}
				if($k===true){
					$param[]=$p;
				}else{
					$param[]=$p.'="'.Core\htmlchars($k).'"';
				}
			}
			return ($prelabel.'<input name="'.$name.'" '.implode(" ", $param).' />'.$postlabel);
		}
		private function formcontent(){
			$param=Form::Sheader();
			foreach($this->html as $k){
				if($k==null){
					continue;
				}
				$param.=$k;
			}
			return $param;
		}
		public function clear(){
			$this->html=array();
		}
		public function add($name, $type, $un=false){
			$oname=$name;
			if((!$un)and(isset($this->text[$oname]))){
				$i=0;
				while(isset($this->text[$oname.$i])){
					$i++;
				}
				$oname.=$i;
			}
			$this->html[$oname]=Form::input($name, $type);
		}
		public function submit($val, $name=null, $style=null){
			if(isset($this->html["asubmit".(($name!=null)?($name):(""))])){
				unset($this->html["asubmit".(($name!=null)?($name):(""))]);
			}
			$this->html["asubmit".(($name!=null)?($name):(""))]='<input type="submit" value="'.Core\htmlchars($val).'"'.(($name!=null)?(' name="'.Core\htmlchars($name).'"'):('')).''.(($style!=null)?(' style="'.Core\htmlchars($style).'"'):('')).' />';
		}
		public function delete($name){
			$this->html[$name]=null;
		}
		public function deleteSubmit($name=""){
			$this->html["asubmit".$name]=null;
		}
		public function display($action, $page=null, $style=""){
			echo($this->get($action, $page, $style));
		}
		public function get($action, $page=null, $style="", $autocomplete=true){
			if($page==null){
				$page=$_SERVER['PHP_SELF'];
			}
			$str="";
			if(!$autocomplete){
				$str=" autocomplete=\"off\"";
			}
			return '<form action="action.php" method="POST" style="'.$style.'"'.$str.'><input type="hidden" name="page" value="'.$page.'" /><input type="hidden" name="tsel" value="'.$action.'" />'.($this->formcontent()).'</form>';
		}
	}
	class Action{
		#region Static
		private static function path($a){
			$a=str_replace(".", "", $a);
			return $_SERVER['DOCUMENT_ROOT']."/cms/actions/$a.php";
		}
		public static function exists($a){
			return file_exists(Action::path($a));
		}
		#endregion
		private $form;
		private $act;
		private $can;
		private $r;
		private $clever;
		private $header;
		private $h;
		public $download;
		public $canceldownload;
		public function __construct($a, $params=array()){
			$a=str_replace(".", "", $a);
			if(is_null($params)){
				$params=array();
			}elseif(is_string($params)or is_int($params)or is_bool($params)){
				$params=array('all'=>$params);
			}
			if(!is_array($params)){
				throw new Exception("Неверные параметры для действия.");
			}
			if(Action::exists($a)){
				$act=file_get_contents(Action::path($a));
				$act=preg_replace_callback('@\-\-\-(.*?)\-\-\-@', "\\LCMS\\Core\\Actions\\locale", $act);
				$act=preg_replace_callback('@\+\+\+(.*?)\+\+\+@', "\\LCMS\\Core\\Actions\\localew", $act);
				foreach($params as $k=>$l){
					if($l){
						if(strpos($act, "***")!==false){
							$k=preg_quote($k, "@");
							$act=preg_replace("@\*\*$k\*\*(.*?)\*\*\*@s", "\\1", $act);
							$act=preg_replace("@\*\*!$k\*\*(.*?)\*\*\*@s", "", $act);
						}
					}
					$PARAM='$PARAM$'.$k.'$';
					if(strpos($act, $PARAM)){
						$act=str_replace($PARAM, $l, $act);
					}
					$PARAM='&PARAM&'.$k.'&';
					if(strpos($act, $PARAM)){
						$act=str_replace($PARAM, "unserialize('".str_replace(array('\\', '\''), array('\\\\', '\\\''), serialize($l))."')", $act);
					}
				}
				$act=str_ireplace('|F|', '|Form||Header|', $act);
				$act=str_ireplace('|SHeader|', '<?php echo(Form::Sheader()); ?>', $act);
				$act=str_ireplace('|Header|', '<?php echo(Form::Sheader()); ?>|FH|', $act);
				$act=str_ireplace('|Form|', '<form action="/cms/action.php" method="POST">', $act);
				$act=str_ireplace('|FH|', '<input type="hidden" name="tsel" value=$ACTNAME$><input type="hidden" name="page" value=$PAGE$>', $act);
				$act=str_ireplace('$ACTNAME$', '"'.addslashes($a).'"', $act);
				$act=str_ireplace('|ACTNAME$', addslashes($a), $act);
				$act=str_ireplace('|ACTNAME|', $a, $act);
				$act=str_ireplace('$PAGE$', '"'.addslashes($_SERVER['PHP_SELF']).'"', $act);
				$act=str_ireplace('|PAGE$', addslashes($_SERVER['PHP_SELF']), $act);
				$act=str_ireplace('|PAGE|', $_SERVER['PHP_SELF'], $act);
				$this->canceldownload=false;
				//$act=str_ireplace('<NOT_DOWNLOAD>', '$this->canceldownload=true;', $act);
				$act=preg_replace("@\*\*!(.*?)\*\*(.*?)\*\*\*@s", "\\2", $act);
				$act=preg_replace("@\*\*(.*?)\*\*(.*?)\*\*\*@s", "", $act);
				if(\LCMS\Core\Users\Users::isClever()){
					$act=preg_replace('@\*CLEVER\*(.*?)\*\*\*@s', "\\1", $act);
				}
				$this->clever=CHTML::has($act, "CLEVER");
				$this->download=CHTML::has($act, "DOWNLOAD");
				if(isset($params['noheader'])and($params['noheader'])){
					$this->h=false;
					$this->header="";
				}else{
					$this->h=CHTML::hasopen($act, "HEADER", "su");
					$this->header=CHTML::between($act, "HEADER", "su");
				}
				$this->form=CHTML::between($act, "FORM", "su");
				$classes=explode(',', CHTML::between($act, "CLASS", "su"));
				$this->act=CHTML::between($act, "ACTION", "su");
				$this->can=Stats::can($GLOBALS['AUTH'][2], trim(CHTML::between($act, "PRE")));
				$this->r=false;
				foreach($classes as $cl){
					$cl=trim($cl);
					if($cl==""){
						continue;
					}
					if(!class_exists($cl)){
						$this->r=new Result("Не установлен модуль [".$a."][".$cl."]");
						break;
					}
				}
			}else{
				$this->r=new Result("Действия не существует [".$a."]");
			}
		}
		public static function e($a, $params=array()){
			echo(new Action($a, $params));
		}
		public static function n($a, $params=array()){
			return(new Action($a, $params));
		}
		public function get(){
			if($this->r){
				return '<b style="color: #b35;">'.($this->r->getError()).'</b>';
			}
			if($this->can){
				if((!($this->clever))or(Users::isClever())){
					ob_start();
					eval(" use \LCMS\Core\Actions\Form; ?> ". $this->form ." <?php ");
					$c=ob_get_contents();
					ob_end_clean();
					return (($this->h)?("<h3>".trim($this->header)."</h3>"):("")).trim($c);
				}else{
					return "";
				}
			}else{
				return '<h3 style="color: #b35;">'.trim($this->header).'[<b>У Вас нет прав</b>]</h3>';
			}
		}
		public function __toString(){
			return($this->get());
		}
		public function display(){
			echo($this->get());
		}
		public function ado(){
			$us="
	#todo FROM FILE
	use \LCMS\Core\Security\AntiXSS;
	use \LCMS\Core\Security\Counter;
	use \LCMS\Core\Security\Salt;
	use \LCMS\Core\Security\Locker;
	use \LCMS\Core\Enviroment\CMSEnv;
	use \LCMS\Core\Actions\Action;
	use \LCMS\Core\Actions\Result;
	";
			if($this->r){
				return $this->r;
			}
			if($this->can){
				if(!($this->download)){
					ob_start();
				}
				$res=eval($us.str_replace("?>", " ", str_replace("<?php", " ", $this->act)));
				if(!($this->download)){
					ob_end_clean();
				}
				if(is_object($res)){
					$this->canceldownload=$res->canceldownload;
				}else{
					$this->canceldownload=false;
				}
				return $res;
			}else{
				return new Result("У Вас нет прав");
			}
		}
	}
	function locale($m){
		return(Locale::get(trim($m[1])));
	}
	function localew($m){
		return("'".str_replace(array('\\', '\''), array('\\\\', '\\\''), Locale::get(trim($m[1])))."'");
	}
}
?>