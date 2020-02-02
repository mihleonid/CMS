<?php
namespace LCMS\MainModules{
	use RecursiveDirectoryIterator;
	use RecursiveIteratorIterator;
	use SPLFileInfo;
	class LArchiver{
		protected $dumped=false;
		protected $dump;
		protected $plaindump=array();
		public function __construct($filename=null, $filename2=null, $add=array()){
			if(is_array($filename)){
				$filename3=$filename[1];
				$filename=$filename[0];
				$filename=trim($filename);
				$filename3=trim($filename3);
				$this->add($filename, $filename3);
				if(is_string($filename2)){
					$this->todump();
					$filename2=trim($filename2);
					if($add['echo']==true){
						echo($this->write($filename2));
					}else{
						$this->write($filename2);
					}
				}
			}
		}
		public static function ini(){
			ini_set('memory_limit', "99999999999999999999999999M");
			ini_set('memory_limit', -1);
			if((ini_get('max_execution_time')<60)and(ini_get('max_execution_time') != -1)){
				ini_set('max_execution_time' , 60);
			}
		}
		public function add($filename, $filename2){
			$this->dumped=false;
			$filename=trim(str_replace('\\', '/', $filename), '/');
			$filename2=trim(str_replace('\\', '/', $filename2), '/');
			if(file_exists($filename)){
				$len=strlen($filename);
				if(is_dir($filename)){
					$iter=new RecursiveDirectoryIterator($filename);
					foreach(new RecursiveIteratorIterator($iter, RecursiveIteratorIterator::SELF_FIRST) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
						$this->plaindump[trim(str_replace("\\", "/", $filename2.substr($f->GetPathName(), $len)), '/')]=$f->GetRealPath();
					}
				}elseif(is_file($filename)){
					$f=new SplFileInfo($filename);
					$this->plaindump[trim(str_replace("\\", "/", $filename2.substr($f->GetPathName(), $len)), '/')]=$f->GetRealPath();
				}
			}
		}
		public function clean(){
			$this->dump=array();
			$this->dumped=false;
		}
		protected function swrite($filename, $content=""){
			if(!file_exists($filename)){
				$rev=strrev($filename);
				if(($rev[0]=="/")or($rev[0]=="\\")){
					$filename.="_";
				}
				unset($rev);
				$dirs=array();
				$dir=pathinfo($filename);
				$dir=$dir['dirname'];
				while(!file_exists($dir)){
					$dirs[]=$dir;
					$dir=pathinfo($dir);
					$dir=$dir['dirname'];
				}
				$dirs=array_reverse($dirs);
				foreach($dirs as $dir){
					mkdir($dir);
				}
			}
			file_put_contents($filename, $content);
		}
		protected function smkdir($filename){
			if(!file_exists($filename)){
				$dirs=array();
				$dir=pathinfo($filename);
				$dir=$dir['dirname'];
				while(!file_exists($dir)){
					$dirs[]=$dir;
					$dir=pathinfo($dir);
					$dir=$dir['dirname'];
				}
				$dirs=array_reverse($dirs);
				foreach($dirs as $dir){
					mkdir($dir);
				}
				mkdir($filename);
			}
		}
		public function todump(){
			$this->dump=array();
			foreach($this->plaindump as $key=>$line){
				if(file_exists($line)){
					if(is_dir($line)){
						$line='>';
					}elseif(is_file($line)){
						$line='!'.file_get_contents($line);
					}
					$this->dump[$key]=$line;
				}
			}
			foreach($this->dump as $k=>$v){
				echo($k."<br>");
			}
			$this->dump=gzdeflate(serialize($this->dump), 9);
			$this->dumped=true;
		}
		public function write($filename){
			if(!($this->dumped)){
				$this->todump();
			}
			$this->swrite($filename.'.lbgz', $this->dump);
			return strlen($this->dump);
		}
		public function open($file){
			$file.='.lbgz';
			if(file_exists($file)){
				$this->dump=file_get_contents($file);
			}else{
				return false;
			}
			return $this;
		}
		public function depack($dir, $zamena=true){
			$dir=trim(str_replace('\\', '/', $dir), '/').'/';
			if($dir!='/'){
				if(file_exists($dir)){
					if(is_dir($dir)){
						$www=true;
					}else{
						$www=false;
					}
				}else{
					$www=true;
				}
			}else{
				$dir='';
			}
			if($www){
				$dedump=unserialize(gzinflate($this->dump));
				if(!is_array($dedump)){
					die("Archive is incorrect.");
				}
				foreach($dedump as $f=>$sod){
					if($sod[0]=='>'){
						$this->smkdir($dir.$f);
					}else{
						if((!file_exists($dir.$f))or($zamena)){
							$this->swrite($dir.$f, substr($sod, 1));
						}
					}
				}
			}
		}
		public function sfx($file){
			if(!($this->dumped)){
				$this->todump();
			}
			$this->swrite($file.'.lbgz.sfx.php', $this->sfx_text($this::str_pack($this->dump), "key"));
		}

		protected function sfx_text($text, $key){
			$HTML_SFX="<?php
header(\"Content-type: text/html; charset=utf-8\");
\$file=file( __FILE__ );
if('<?php /*'.\$_REQUEST['key'].'*/ ?>'==trim(\$file[0])){
if(\$_POST['unpack']=='unopack'){
\$abc=trim(\$file[1]);
\$abc=substr(\$abc, 8);
\$abc=substr(\$abc, 0, strlen(\$abc)-5);
\$ar=new LArchiver();
\$ar->un_sfx(\$abc);
\$ar->depack(\$_POST['name']);
?>
<html>
<head>
<title>Успешно</title>
</head>
<body>
<h1 style=\"color: green;\">Успешно</h1>
<p>".$after."</p>
</body>
</html>
<?php
if(\$_POST['del']=='dellllll'){
	unlink( __FILE__ );
	exit;
}elseif(\$_POST['del']=='zashita'){
	\$file[0]='<?php /*'.\$_POST['key'].'*/ ?>\r\n';
	file_put_contents( __FILE__ , implode('', \$file));
}else{
	echo('Небезопасно');
}
}else{ ?>
<html>
<head>
<title>".$title."</title>
</head>
<body>
<h1>".$header."</h1>
<p>".$maintext."</p>
<form method=\"post\">
<input type=\"hidden\" value=\"unopack\" name=\"unpack\">
<p>
Действие с установщиком-распаковщиком:
<br>
<input type=\"radio\" value=\"dellllll\" name=\"del\">Удалить
<br>
<input type=\"radio\" value=\"zashita\" name=\"del\" selected>Защитить новым ключём <input type=\"text\" name=\"key\" pattern=\"[a-zA-Z1-90]+\">
<br>
<input type=\"radio\" value=\"un\" name=\"del\" selected>Оставить без защиты (небезопасно)
</p>
<input type=\"hidden\" name=\"key\" value=\"<?php echo(\$_REQUEST['key']);?>\">
Куда распаковать: <input type=\"text\" name=\"name\">
<br>
<input type=\"submit\" value=\"".$button."\">
</form>
</body>
</html>
<?php }}else{ ?>
<form method=\"get\">
Ключ: <input type=\"text\" name=\"key\" pattern=\"[a-zA-Z1-90]+\">
<br>
<input type=\"submit\" value=\"Приступить к установке\">
</form>
<?php } ?>";
			$text="<?php /*$key*/ ?>\r\n<?php /*$text*/ ?>\r\n".file_get_contents( __FILE__ )."\r\n".$HTML_SFX;
			return $text;
		}
		public function un_sfx($text){
			$this->dumped=true;
			$this->dump=$this::str_unpack($text);
		}
		public static function str_pack($str){
			$str=explode("\r", $str);
			foreach($str as $key=>$line){
				$val=explode("\n", $line);
				foreach($val as $key2=>$line2){
					$val[$key2]=explode('*/', $line2);
				}
				$str[$key]=$val;
			}
			return serialize($str);
		}
		public static function str_unpack($str){
			$str=unserialize($str);
			foreach($str as $key=>$line){
				foreach($line as $key2=>$line2){
					$line[$key2]=implode('*/', $line2);
				}
				$str[$key]=implode("\n", $line);
			}
			$str=implode("\r", $str);
			return $str;
		}
		/*
		protected static function str_pack($str){
		$str=str_replace("\\", "\\\\", $str);
		$str=str_replace("\n", "\\n", $str);
		$str=str_replace("\r", "\\r", $str);
		$str=str_replace("/", "\\/", $str);
		//$str=str_replace("?", "\\?", $str);
		return $str;
		}
		protected static function str_unpack($str){
		$strlen=strlen($str);
		$newstr="";
		$count=0;
		for($i=0; $i<$strlen; $i++){
		if($str[$i]=="\\"){
		$count++;
		}else{
		$l=$str[$i];
		if($i>=0){
		if($str[$i-1]=="\\"){
		$tmpl=$l;
		if(($count % 2)==0){
		$l=str_repeat("\\", ($count/2));
		$l.=$tmpl;
		}else{
		$l=str_repeat("\\", (($count-1)/2));
		if($tmpl=="/"){
		$l.="/";
		}elseif($tmpl=="n"){
		$l.="\n";
		}elseif($tmpl=="r"){
		$l.="\r";
		}else{
		eval("\$l.=\"\\".$tmpl."\"");
		}
		}
		}
		}
		$newstr.=$l;
		$count=0;
		}
		}
		return $str;
		}*/
	}
}
/*
public static function archiveN($files){
$ar=new LArchiver();
foreach($files as $k=>$l){
$ar->add($l, substr($l, 2));
}
$ar->write($_SERVER['DOCUMENT_ROOT']."/archives/".$_POST['name']);
unset($ar);
return Result::OK;
}
public static function Unarchive($archive, $zamena){
if($zamena=="down"){
$zamena=false;
}else{
$zamena=true;
}
$ar=new LArchiver();
$ar->open($_SERVER['DOCUMENT_ROOT']."/archives/$archive");
$ar->depack($_SERVER['DOCUMENT_ROOT'], $zamena);
return Result::OK;
}
public static function deleteArchive($archive){
$archive=str_replace('..', '', $archive);
unlink($_SERVER['DOCUMENT_ROOT']."/archives/$archive");
return Result::OK;
}*/
?>