<?php
namespace LCMS\Core\Actions{
	include_once($_SERVER['DOCUMENT_ROOT']."/cms/cmsinclude.php");
	use \LCMS\Core\Security\AntiXSS;
	use \LCMS\Core\Security\Salt;
	use \LCMS\Core\Security\Counter;
	use \LCMS\Core\Security\Locker;
	use \LCMS\Core\GUI\Web;
	use \LCMS\Core\Enviroment\CMSEnv;
	use \LCMS\Core\Actions\Action;
	use \LCMS\Core\Actions\Result;
	AntiXSS::H();
	AntiXSS::R();
	Web::headerEncode();
	$last=isset($_GET['last']);
	if($GLOBALS['AUTH']==false){
		header("Location: http://".$_SERVER['HTTP_HOST']."/index.php");
		exit;
	}
	if($last){
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/cms/tmp/last_action_".preg_replace('@[^a-zA-Z]@', ')', $GLOBALS['AUTH'][0]).".seria")){
			$_POST=array_merge(unserialize(file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/tmp/last_action_".preg_replace('@[^a-zA-Z]@', ')', $GLOBALS['AUTH'][0]).".seria")), $_POST);
			unlink($_SERVER['DOCUMENT_ROOT']."/cms/tmp/last_action_".preg_replace('@[^a-zA-Z]@', ')', $GLOBALS['AUTH'][0]).".seria");
		}else{
			die("<p style=\"font-size: 24pt; font-family: monospace; color: #ff3333; text-align: center;\"><b>Временный файл был удалён!</b></p><p style=\"font-size: 14pt; text-align: center;\"><a href=\"".((isset($_POST['page']))?($_POST['page']):(''))."\">Назад</a></p>");
		}
	}
	if((!isset($_POST['ZZZ_OF']))or(!Salt::compare($_POST['ZZZ_OF']))){
		die("<p style=\"font-size: 24pt; font-family: monospace; color: #ff3333; text-align: center;\"><b>Ошибка безопасности! [".((isset($_POST['tsel']))?($_POST['tsel']):(''))."]</b><img src=\"/cms/file/sec.png\"></img></p><p style=\"font-size: 14pt; text-align: center;\"><a href=\"".((isset($_POST['page']))?($_POST['page']):(''))."\">Назад</a></p>");
	}
	if(isset($_POST['UNKEY'])and(!$last)){
		if(!Counter::get($_POST['UNKEY'])){
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/tmp/last_action_".preg_replace('@[^a-zA-Z]@', ')', $GLOBALS['AUTH'][0]).".seria", serialize($_POST));
			echo('<p style="font-size: 24pt; font-family: monospace; color: #ff3333; text-align: center;"><b>Действия должны иметь строгий хронологический порядок. Это сделано для безопасности. Вы сможите повторить ваше действие позже, но помните: в случае изменения баз в промежуток времени от загрузки прошлой страницы до текущего момента может произойти ошибка структуры этих баз. <a href="/cms/error.php">Отключить</a>. <a href="/cms/action.php?last=1">Повторить</a>.</b></p>');
			echo("<p style=\"font-size: 14pt; font-family: monospace; text-align: center;\"><a href=\"".$_POST['page']."\">Назад</a></p>".'<script> document.body.addEventListener("keydown", function(evt){ if(evt.keyCode==13){window.location.replace("'.$_POST['page'].'");}}, false);</script>');
			exit;
		}
	}
	$count=5;
	while(!Locker::set()){
		if(($count--)<=0){
			file_put_contents($_SERVER['DOCUMENT_ROOT']."/cms/tmp/last_action_".preg_replace('@[^a-zA-Z]@', ')', $GLOBALS['AUTH'][0]).".seria", serialize($_POST));
			die("<p style=\"font-size: 24pt; font-family: monospace; color: #ff3333; text-align: center;\"><b>Установлен замок! Т.Е. Вы произвели действие, пока выполняется другое действие. Если вы считаете, что это ошибка, подождите 2 минуты, после чего сообщите разработчику, спасибо.</b></p><p style=\"font-size: 14pt; text-align: center;\"><a href=\"".$_POST['page']."\">Назад</a></p>".'<script> document.body.addEventListener("keydown", function(evt){ if(evt.keyCode==13){window.location.replace("'.$_POST['page'].'");}}, false);</script>');
		}else{
			sleep(1);
		}
	}
	$_POST['tsel']=trim(str_replace("..", "", $_POST['tsel']));
	$str=$_POST['tsel'];
	$result=null;
	$down=false;
	if(Action::exists($str)){
		ALog::add($str);
		$res=(new Action($str));
		$down=$res->download;
		$obuffer=CMSEnv::getBuffering();
		if(!$down){
			if($obuffer){
				ob_start();
			}else{
				echo("<progress id=\"pr\" style=\"width: 70%;\"></progress>");
				flush();
			}
		}
		$result=new Result();
		$rest=$res->ado();
		if(!(($rest===true)or($rest===false)or($rest==null))){
			$result=$rest;
		}
		if(!($result->getOK())){
			$result->setNo(true);
		}
		Locker::unlock();
		if(!$down){
			if($obuffer){
				ob_end_clean();
				if($result->getOk()){
					header("Location: http://".$_SERVER['HTTP_HOST'].$_POST['page']);
					exit;
				}
			}else{
				echo "<script>document.getElementById('pr').remove();</script>";
				flush();
			}
		}else{
			if($res->canceldownload){
				if($result->getOk()){
					header("Location: http://".$_SERVER['HTTP_HOST'].$_POST['page']);
					exit;
				}
			}
		}
	}else{
		$result=new Result("Такого действия не существует (".$_POST['tsel'].")");
	}
	if(!$down){
		if(!$obuffer){
			if($result->getOk()){
				echo("<p style=\"font-size: 24pt; font-family: monospace; color: #33ff33; text-align: center;\"><b>Успешно</b></p>");
			}else{
				echo("<p style=\"font-size: 24pt; font-family: monospace; color: #ff3333; text-align: center;\"><b>".$result->getError()."</b></p>");
			}
			if(!$result->getNo()){
				echo("<meta http-equiv=\"Refresh\" content=\"0; url=".$_POST['page']."\">");
			}else{
				echo("<p style=\"font-size: 14pt; font-family: monospace; text-align: center;\"><a href=\"".$_POST['page']."\">Назад</a></p>".'<script> document.body.addEventListener("keydown", function(evt){ if(evt.keyCode==13){window.location.replace("'.$_POST['page'].'");}}, false);</script>');
			}
			echo($result->text);
			flush();
		}else{
			if(!$result->getNo()){
				header("Location: http://".$_SERVER['HTTP_HOST'].$_POST['page']);
			}else{
				if($result->getOk()){
					echo("<p style=\"font-size: 24pt; font-family: monospace; color: #33ff33; text-align: center;\"><b>Успешно</b></p>");
				}else{
					echo("<p style=\"font-size: 24pt; font-family: monospace; color: #ff3333; text-align: center;\"><b>".$result->getError()."</b></p>");
				}
				echo("<p style=\"font-size: 14pt; font-family: monospace; text-align: center;\"><a href=\"".$_POST['page']."\">Назад</a></p>".'<script> document.body.addEventListener("keydown", function(evt){ if(evt.keyCode==13){window.location.replace("'.$_POST['page'].'");}}, false);</script>');
				echo($result->text);
				flush();
			}
		}
	}
	exit;
}
?>