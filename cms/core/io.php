<?php
namespace LCMS\Core\IO{
	use \LCMS\Core\Actions\Result;
	use \LCMS\Core\Enviroment\Loc;
	class File{
		public static function unique_path($path){
			if(file_exists($path)){
				$inf=pathinfo($path);
				$inf['filename'].='d';
				$path=$inf['dirname']."/".$inf['filename'].".".$inf['extension'];
				unset($inf);
				return(unique_path($path));
			}
			return($path);
		}
	}
	class In{
		#todo MAGAZINE SECURE
		public static function shopDownload($to, $from){
			$info=@file_get_contents($from);
			if($info){
				file_put_contents($to, $info);
			}else{
				return new Result("Невозможно получить доступ к объекту.");
			}
			return new Result();
		}
		public static function uploadFile(){
			$error= new Result();
			if($_FILES['doc']['error']==0){
				$f=explode(".", $_FILES['doc']['name']);
				if(!empty($_POST['name'])){
					$name=$_POST['name'];
				}else{
					$name=$f[0];
				}
				if(!empty($_POST['ext'])){
					$ext=$_POST['ext'];
				}else{
					$ext=$f[1];
				}
				$path=$_POST['type'].$name.".".$ext;
				if(move_uploaded_file($_FILES['doc']['tmp_name'], $path)){
					echo"Перемещено. Тип: ".$_FILES['doc']['type'];
				}else{
					$error->add("Не перемещено");
				}
			}else{
				$error->add("Ошибка подгрузки");
			}
			return $error;
		}
	}
	class Out{
		public static function download($file){
			if (file_exists($file)) {
				@header('Content-Description: CMS File Transfer');
				@header('Content-Type: application/octet-stream');
				@header('Content-Disposition: attachment; filename="'.basename($file).'"');
				@header('Expires: Sat, 26 Jul 1997 15:00:00 GMT');
				@header('Cache-Control: must-revalidate');
				@header('Pragma: public');
				@header('Content-Length: ' . filesize($file));
				readfile($file);
				exit;
			}else{
				die("NO FILE");
			}
		}
	}
}
?>