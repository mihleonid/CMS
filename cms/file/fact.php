<?php
ob_start();
include_once "login.php";
$z=file("z.php");
$z=$z[1];
if($_POST['zz']!=md5($_POST['z'].md5($z))){
	die("<h1 style=\"color: red; text-align: center;\">Error of security!<img src=\"sec.png\"/></h1><a href=\"file.php\" style=\"text-align: center; display: block;\">Back</a>");
}
// print_r($_POST);
switch($_POST['tsel']){
	case "Выйти":
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/admin.php");
	exit;
	break;
	case "Скачать1":
	if(!empty($_POST['file'])){
		header("Content-type: application/octet-stream;");
		header('Content-Disposition: attachment;filename="'.basename($_POST['file'][0]).'"');
		ob_end_clean();
		readfile($_POST['file'][0]);
		exit;
	}
	exit;
	break;
	case "Скачать2":
	if(!empty($_POST['files'])){
		header("Content-type: application/octet-stream;");
		header('Content-Disposition: attachment;filename="'.basename($_POST['files'][0]).'"');
		ob_end_clean();
		readfile($_POST['files'][0]);
		exit;
	}
	exit;
	break;
	case "Копировать1":
	if(!empty($_POST['file'])){
	foreach($_POST['file'] as $file){
		$copy=$_POST['paths'];
		if(empty($_POST['name']) or isset($_POST['file'][1]) or(is_dir($_POST['file'][0]))){
			$toc=basename($file);
		}else{
			$toc=$_POST['name'];
		}
		if(is_file($file) or is_link($file)){
			copy($file, $copy.DIRECTORY_SEPARATOR .$toc);
		}elseif(is_dir($file)){
			$iter=new RecursiveDirectoryIterator($file);
			// echo(Reflection::export(new ReflectionClass("RecursiveIteratorIterator")));
			if(!file_exists($copy.DIRECTORY_SEPARATOR .$toc)){
				mkdir($copy.DIRECTORY_SEPARATOR .$toc);
			}
			foreach(new RecursiveIteratorIterator($iter, 1) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
				$str=str_replace($file, $copy.DIRECTORY_SEPARATOR .$toc, $f->getPathname());
				if($f->isDir()){
					if(!file_exists($str)){
						mkdir($str);
					}
				}else{
					copy($f, $str);
				}
			}
		}
	}
	}
	break;
	case "Копировать2":
	if(!empty($_POST['files'])){
	foreach($_POST['files'] as $file){
		$copy=$_POST['path'];
		if(empty($_POST['name']) or isset($_POST['files'][1]) or(is_dir($_POST['files'][0]))){
			$toc=basename($file);
		}else{
			$toc=$_POST['name'];
		}
		if(is_file($file) or is_link($file)){
			copy($file, $copy.DIRECTORY_SEPARATOR .$toc);
		}elseif(is_dir($file)){
			$iter=new RecursiveDirectoryIterator($file);
			// echo(Reflection::export(new ReflectionClass("RecursiveIteratorIterator")));
			if(!file_exists($copy.DIRECTORY_SEPARATOR .$toc)){
				mkdir($copy.DIRECTORY_SEPARATOR .$toc);
			}
			foreach(new RecursiveIteratorIterator($iter, 1) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
				$str=str_replace($file, $copy.DIRECTORY_SEPARATOR .$toc, $f->getpathname());
				if($f->isDir()){
					if(!file_exists($str)){
						mkdir($str);
					}
				}else{
					copy($f, $str);
				}
			}
		}
	}
	}
	break;
	case "Переместить1":
	if(!empty($_POST['file'])){
	foreach($_POST['file'] as $file){
		$copy=$_POST['paths'];
		if(empty($_POST['name']) or isset($_POST['file'][1]) or(is_dir($_POST['file'][0]))){
			$toc=basename($file);
		}else{
			$toc=$_POST['name'];
		}
		if(is_file($file) or is_link($file)){
			rename($file, $copy.DIRECTORY_SEPARATOR .$toc);
		}elseif(is_dir($file)){
			$iter=new RecursiveDirectoryIterator($file);
			// echo(Reflection::export(new ReflectionClass("RecursiveIteratorIterator")));
			if(!file_exists($copy.DIRECTORY_SEPARATOR .$toc)){
				rmdir($file);
				mkdir($copy.DIRECTORY_SEPARATOR .$toc);
			}
			foreach(new RecursiveIteratorIterator($iter, 1) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
				$str=str_replace($file, $copy.DIRECTORY_SEPARATOR .$toc, $f->getPathname());
				if($f->isDir()){
					if(!file_exists($str)){
						rmdir($f);
						mkdir($str);
					}
				}else{
					rename($f, $str);
				}
			}
		}
	}
	}
	break;
	case "Переместить2":
	if(!empty($_POST['files'])){
	foreach($_POST['files'] as $file){
		$copy=$_POST['path'];
		if(empty($_POST['name']) or isset($_POST['file'][1]) or(is_dir($_POST['file'][0]))){
			$toc=basename($file);
		}else{
			$toc=$_POST['name'];
		}
		if(is_file($file) or is_link($file)){
			rename($file, $copy.DIRECTORY_SEPARATOR .$toc);
		}elseif(is_dir($file)){
			$iter=new RecursiveDirectoryIterator($file);
			// echo(Reflection::export(new ReflectionClass("RecursiveIteratorIterator")));
			if(!file_exists($copy.DIRECTORY_SEPARATOR .$toc)){
				rmdir($file);
				mkdir($copy.DIRECTORY_SEPARATOR .$toc);
			}
			foreach(new RecursiveIteratorIterator($iter, 1) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
				$str=str_replace($file, $copy.DIRECTORY_SEPARATOR .$toc, $f->getPathname());
				if($f->isDir()){
					if(!file_exists($str)){
						rmdir($f);
						mkdir($str);
					}
				}else{
					rename($f, $str);
				}
			}
		}
	}
	}
	break;
	case "Удалить1":
	if(!empty($_POST['file'])){
	foreach($_POST['file'] as $file){
		if(is_file($file) or is_link($file)){
			unlink($file);
		}elseif(is_dir($file)){
			$iter=new RecursiveDirectoryIterator($file);
			foreach(new RecursiveIteratorIterator($iter, RecursiveIteratorIterator::CHILD_FIRST) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
				if($f->isDir()){
					rmdir($f);
				}else{
					unlink($f);
				}
			}
			rmdir($file);
		}
	}
	}
	break;
	case "Удалить2":
	if(!empty($_POST['files'])){
	foreach($_POST['files'] as $file){
		if(is_file($file) or is_link($file)){
			unlink($file);
		}elseif(is_dir($file)){
			$iter=new RecursiveDirectoryIterator($file);
			foreach(new RecursiveIteratorIterator($iter, RecursiveIteratorIterator::CHILD_FIRST) as $f){#, RecursiveIteratorIterator::PARENT_FIRST
				if($f->isDir()){
					rmdir($f);
				}else{
					unlink($f);
				}
			}
			rmdir($file);
		}
	}
	}
	break;
	case "Папка1":
	if((!file_exists($_POST['path'].DIRECTORY_SEPARATOR .$_POST['name'])) and (!empty($_POST['name']))){
		mkdir($_POST['path'].DIRECTORY_SEPARATOR .$_POST['name']);
	}
	break;
	case "Папка2":
	if((!file_exists($_POST['paths'].DIRECTORY_SEPARATOR .$_POST['name'])) and (!empty($_POST['name']))){
		mkdir($_POST['paths'].DIRECTORY_SEPARATOR .$_POST['name']);
	}
	break;
	case "Загрузить1":
	// echo("a");
	// print_r($_POST);
	// print_r($_FILES);
	if(isset($_FILES['document']) and ($_FILES['document']['error']==UPLOAD_ERR_OK)){
		// echo("a");
		if(empty($_POST['name'])){
			$newp=$_POST['path'].DIRECTORY_SEPARATOR .basename($_FILES['document']['name']);
		}else{
			$newp=$_POST['path'].DIRECTORY_SEPARATOR .$_POST['name'];
		}
		// echo($_FILES['document']['tmp_name']."<br>".$newp);
		move_uploaded_file($_FILES['document']['tmp_name'], $newp);
	}
	break;
	case "Загрузить2":
	if(isset($_FILES['file']) and ($_FILES['file']['error']==UPLOAD_ERR_OK)){
		if(empty($_POST['name'])){
			$newp=$_POST['path'].DIRECTORY_SEPARATOR .basename($_FILES['files']['name']);
		}else{
			$newp=$_POST['path'].DIRECTORY_SEPARATOR .$_POST['name'];
		}
		move_uploaded_file($_FILES['file']['tmp_name'], $newp);
	}
	break;
	case "Новый1":
	if((!file_exists($_POST['path'].DIRECTORY_SEPARATOR .$_POST['name'])) and (!empty($_POST['name']))){
		copy("codec".DIRECTORY_SEPARATOR .$_POST['codec'], $_POST['path'].DIRECTORY_SEPARATOR .$_POST['name']);//look
	}
	break;
	case "Новый2":
	if((!file_exists($_POST['paths'].DIRECTORY_SEPARATOR .$_POST['name'])) and (!empty($_POST['name']))){
		copy("codec".DIRECTORY_SEPARATOR .$_POST['codec'], $_POST['path'].DIRECTORY_SEPARATOR .$_POST['name']);//look
	}
	break;
	case "Вверх1":
	$r=explode(DIRECTORY_SEPARATOR, $_POST['path']);
	unset($r[count($r)-1]);
	$path=implode(DIRECTORY_SEPARATOR, $r);
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=$path&paths=".$_POST['paths']);
	exit;
	break;
	case "Вверх2":
	$r=explode(DIRECTORY_SEPARATOR, $_POST['paths']);
	unset($r[count($r)-1]);
	$paths=implode(DIRECTORY_SEPARATOR, $r);
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['path']."&paths=$paths");
	exit;
	break;
	case "Назад":
	if($_POST['t']=="j"){$patht="path";$pathts="paths";}else{$patht="paths";$pathts="path";}
	$paths=$_POST[$pathts];
	$r=explode(DIRECTORY_SEPARATOR, $_POST[$patht]);
	unset($r[count($r)-1]);
	$path=implode(DIRECTORY_SEPARATOR, $r);
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?$patht=$path&$pathts=$paths");
	exit;
	break;
	case "Изменить":
	if($_GET['t']=="j"){
		$patht="paths";
	}else{
		$patht="path";
	}
	$r=explode(DIRECTORY_SEPARATOR, $_POST[$patht]);
	unset($r[count($r)-1]);
	$path=implode(DIRECTORY_SEPARATOR, $r);
	$text=$_POST['text'];
	// $text=str_replace("</*ecran*textarea>", "</textarea>", $text);
	if($_POST['trim']){
		$text=trim($text);
	}
	copy("codec/".$_POST['codec'], $_POST[$patht]);
	$mys=fopen($_POST[$patht], "a+");
	fwrite($mys, $text);
	fclose($mys);
	$_POST[$patht]=$path;
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['path']."&paths=".$_POST['paths']);
	exit;
	break;
	case "Сменить затравку безопасности":
	$file=file("z.php");
	$dstr="qwertyuiopasdfghjklzxcvbnm1234567890";
	$str="";
	$i=0;
	while($i<40){
		$str.=$dstr[mt_rand(0, 35)];
		$i+=1;
	}
	$file[1]=$str."\r\n";
	$file=implode("", $file);
	$fh=fopen("z.php", "w+");
	fwrite($fh, $file);
	fclose($fh);
	break;
	case "disk1":
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['disk'].":".DIRECTORY_SEPARATOR ."&paths=".$_POST['paths']);
	exit;
	break;
	case "disk2":
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['path']."&paths=".$_POST['disk'].":".DIRECTORY_SEPARATOR);
	exit;
	break;
	case "dir1":
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['disk']."&paths=".$_POST['paths']);
	exit;
	break;
	case "dir2":
	header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['path']."&paths=".$_POST['disk']);
	exit;
	break;
}
header("Location: http://".$_SERVER['HTTP_HOST']."/cms/file/file.php?path=".$_POST['path']."&paths=".$_POST['paths']);
ob_end_flush();
?>