<?php
ini_set('extension', 'php_zip.dll');
ini_set('memory_limit', -1);
if((ini_get('max_execution_time')<60)and(ini_get('max_execution_time') != -1)){
	ini_set('max_execution_time' , 60);
}
class LZip extends ZipArchive{
	protected $IsOpend=false;
	public function __construct($filename=null, $flags=null){
		if(is_string($filename)){
			if(is_int($flags)){
				$this->open($filename, $flags);
			}else{
				$this->open($filename, ZIPARCHIVE::CREATE);
			}
			$this->IsOpend=true;
		}
	}
	public function addO($filenameR, $filenameL){
		if(is_file($filenameR)){
			$this->addFile($filenameR, $filenameL);
		}elseif(is_dir($filenameR)){
			$this->addEmptyDir($filenameL);
		}
	}
	public function add($filename, $filename2){
		$filename=trim(str_replace('\\', '/', $filename), '/');
		$filename2=trim(str_replace('\\', '/', $filename2), '/');
		if(file_exists($filename)){
			$len=strlen($filename);
			if(is_dir($filename)){
				$iter=new RecursiveDirectoryIterator($filename);
				foreach(new RecursiveIteratorIterator($iter, RecursiveIteratorIterator::SELF_FIRST) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
					$this->addO($f->GetRealPath(), trim($filename2.substr($f->GetPathName(), $len), '/'));
				}
			}elseif(is_file($filename)){
				$f=new SplFileInfo($filename);
				$this->addO($f->GetRealPath(), trim($filename2.substr($f->GetPathName(), $len), '/'));
			}
		}
	}
	public function __destruct(){
		$this->close();
	}
	public function download(){
		if(!$this->IsOpend){
			$file = tempnam("tmp", "zip"); 
			header("Content-Type: application/zip"); 
			header("Content-Length: " . filesize($file)); 
			header("Content-Disposition: attachment; filename=\"a_zip_file.zip\""); 
			readfile($file); 
			unlink($file); 
		}else{
			error_log("Error: ZipArchive has never opend, can not download it. Archiver:". __FILE__ );
		}
	}
}
?>