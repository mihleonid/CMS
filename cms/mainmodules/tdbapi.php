<?php
namespace LCMS\MainModules{
	class D_BASE{
		protected $base_name;
		protected $un_array;
		protected $unwrite;
		public function __construct($name=null, $open=true, $autowrite=false){
			$this->unwrite=$autowrite;
			if(!is_string($name)){
				$this->base_name=$_SERVER['DOCUMENT_ROOT']."/cms/admins.tdb";
			}else{
				$this->base_name=$name;
			}
			if($open==true){
				$this->open();
			}
		}
		public function new_base(){
			file_put_contents($this->base_name, "<?php\n\n?>");
			return $this;
		}
		public function del_base(){
			delete($this->base_name);
			return $this;
		}
		public function get_path(){
			return $this->base_name;
		}
		public function set_path($path){
			if(is_string($path)){
				$this->base_name=$path;
			}
			return $this;
		}
		public function open($multiline=true){
			//$text=file($this->base_name);
			//if($multiline){
			//	unset($text[count($text)-1]);
			//	unset($text[0]);
			//	$text=implode('', $text);
			//}else{
			//	$text=$text[1];
			//}
			//$this->un_array=unserialize(trim($text));
			$this->un_array=unserialize(file_get_contents($this->base_name));
			return $this;
		}
		public function __destruct(){
			if($this->unwrite==true){
				$this->write();
			}
		}
		public function write(){
			file_put_contents($this->base_name, serialize($this->un_array));
			return $this;
		}
		public function add_line($line, $name=null){
			if($name==null){
				$this->un_array[]=$line;
			}else{
				$this->un_array[$name]=$line;
			}
			return $this;
		}
		public function counted(){
			return count($this->un_array);
		}
		public function del_name($name){
			unset($this->un_array[$name]);
			return $this;
		}
		public function del_line($line){
			$name=array_search($line, $this->un_array);
			unset($this->un_array[$name]);
			return $this;
		}
		public function exists_name($name){
			if(key_exists($name, $this->un_array)){
				return true;
			}else{
				return false;
			}
		}
		public function name_of_line($line){
			if(in_array($this->un_array, $line)){
				return array_search($line, $this->un_array);
			}else{
				return false;
			}
		}
		public function get_line($name){
			return $this->un_array[$name];
		}
		public function get_name($line){
			return array_search($line, $this->un_array);
		}
		public function get_all(){
			return $this->un_array;
		}
		public function set_all($newarray){
			$this->un_array=$newarray;
			return $this;
		}
		public function print_re($pre=true){
			if($pre==true){
				echo("<pre>");
			}
			print_r($this->un_array);
			if($pre==true){
				echo("</pre>");
			}
		}
	}
}
?>