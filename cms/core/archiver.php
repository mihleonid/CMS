<?php
namespace LCMS\Core\Archiver{
	use \LCMS\Core\Enviroment\Loc;
	use \LCMS\Core\Actions\Result;
	class Compressor{
		public static function compress($str, $level=9){
			if(function_exists("gzdeflate")){
				$compressed=gzdeflate($str, $level);
				return "{".$compressed."}";
			}
			return "|".$str."}";
		}
		public static function uncompress($str){
			$str=trim($str);
			$str=substr($str, 0, strlen($str)-1);
			$ch=$str[0];
			$str=substr($str, 1);
			if($ch=="{"){
				return gzinflate($str);
			}else{
				return $str;
			}
		}
	}
	class Archiver{
		
		public static function archiveN($files, $archive, $download=false){
			$file = $_SERVER['DOCUMENT_ROOT']."/cms/tmp/archive".time().mt_rand()."me.zip";
			$zip = new ZipArchive();
			$zip->open($file, \ZipArchive::CREATE);
			foreach($files as $name){
				if($name==".."){
					continue;
				}
				$name=substr($name, 2);
				if(is_file($_SERVER['DOCUMENT_ROOT'].$name)){
					$zip->addFile($_SERVER['DOCUMENT_ROOT'].$name, substr($name, 1));
				}
			}
			$zip->close();
			$archive=preg_replace('@[^a-zA-Z1-90_]@', '', $archive);
			if($download){
				header("Content-Type: application/zip");
				header("Content-Length: ".filesize($file));
				header("Content-Disposition: attachment; filename=\"".$archive.".zip\"");
				readfile($file);
				unlink($file);
				return new Result();
			}else{
				rename($file, $_SERVER['DOCUMENT_ROOT']."/archives/".$archive.".zip");
				$r=new Result();
				$r->canceldownload=true;
				return $r;
			}
		}
		public static function unarchive($path, $replace=true){
			$path=preg_replace("@[^a-zA-Z1-90_]@", '', $path);
			$path=$_SERVER['DOCUMENT_ROOT']."/archives/".$path.".zip";
			if(file_exists($path)){
				$zip= new \ZipArchive();
				if($zip->open($path)){
					for($i=0; $i<$zip->numFiles; $i++){#or extract to
						$entry=$zip->getNameIndex($i);
						$entry=str_replace('\\', '/', $entry);
						if(substr($entry, -1 )=='/' ){
							if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.trim($entry, '/'))){
								mkdir($_SERVER['DOCUMENT_ROOT'].'/'.trim($entry, '/'));
							}
						}else{
							if((!file_exists($_SERVER['DOCUMENT_ROOT'].'/'.trim($entry, '/')))or($replace)){
								$fp=$zip->getStream($entry);
								$ofp=fopen($_SERVER['DOCUMENT_ROOT'].'/'.trim($entry, '/'), 'w');
								if(!$fp){
									return new Result('Файл в архиве повреждён.');
								}
								while(!feof($fp)){
									fwrite($ofp, fread($fp, 8192));
								}
								fclose($fp);
								fclose($ofp);
							}
						}
					}
					$zip->close();
				}else{
					return new Result('Архив повреждён.');
				}
			}else{
				return new Result('Архива не существует.');
			}
			return new Result();
		}
		public static function delete($archive){
			$archive=str_replace('..', '', $archive);
			if(file_exists($_SERVER['DOCUMENT_ROOT']."/archives/".$archive.".zip")){
				unlink($_SERVER['DOCUMENT_ROOT']."/archives/".$archive.".zip");
			}
			return new Result();
		}
	}
}
?>