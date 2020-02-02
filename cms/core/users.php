<?php
namespace LCMS\Core\Users{
	use \LCMS\Core\Actions\Result;
	use \LCMS\Core\Enviroment\Loc;
	use \LCMS\Core\Security\Hash;
	use \LCMS\MainModules\D_BASE;
	use \LCMS\Core\Security\ELog;
	class Users{
		private static $UserBase=null; // admins.tdb
		private static $UserBaseAll=null;
		private static $Login=null;
		#region Clever
		public static function setClever($UserName, $clever){
			if($UserName==null){
				$UserName=$GLOBALS['AUTH'][0];
			}
			if($clever){
				static::addClever($UserName);
			}else{
				static::deleteClever($UserName);
			}
			return new Result();
		}
		public static function addClever($UserName=null){
			if($UserName==null){
				$UserName=$GLOBALS['AUTH'][0];
			}
			$a=Loc::get("clever");
			$a[$UserName]=true;
			Loc::set("clever", $a);
			return new Result();
		}
		public static function deleteClever($UserName=null){
			if($UserName==null){
				$UserName=$GLOBALS['AUTH'][0];
			}
			$a=Loc::get("clever");
			if(isset($a[$UserName])){
				unset($a[$UserName]);
				Loc::set("clever", $a);
				return new Result();
			}
			return new Result("Пользователь уже не продвинутый");
		}
		public static function replaceClever($UserName=null){
			if($UserName==null){
				$UserName=$GLOBALS['AUTH'][0];
			}
			$a=Loc::get("clever");
			if(isset($a[$UserName])){
				unset($a[$UserName]);
			}else{
				$a[$UserName]=true;
			}
			Loc::set("clever", $a);
			return new Result();
		}
		public static function isClever($UserName=null){
			if($UserName==null){
				$UserName=$GLOBALS['AUTH'][0];
			}
			$a=Loc::get("clever");
			if(isset($a[$UserName])){
				return true;
			}
			return false;
		}
		#endregion
		#region User
		public static function add($login, $password, $status){
			if(static::$UserBase ==null){
				static::$UserBase = new D_BASE();
			}
			if(static::$UserBase ->exists_name($login)){
				return new Result("Пользователь уже существует");
			}
			if(Stats::exists($status)){
				static::$UserBase ->add_line(array(md5(trim($password)), $status), preg_replace('@[^a-zA-Z_1-90]@', '', $login))->write();
				return new Result();
			}else{
				return new Result("Статуса не существует");
			}
		}
		public static function changePassword($name, $pass, $tecus){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			$name=trim($name);
			if(! static::$UserBase ->exists_name($name)){
				return new Result("Пользователя не существует");
			}
			$line=static::$UserBase ->get_line($name);
			$pass=trim($pass);
			$line[0]=md5($pass);
			static::$UserBase ->add_line($line, $name)->write();
			if(trim($tecus)==trim($name)){
				setcookie('admin', "$name-".$line[0]);
				return 'Внимание!<br><span style="color: #99ffaa;">Вы изменили свой пароль. Новый: <code style="font-size: larger;">'.$pass.'</code></span>';
			}
			return new Result();
		}
		public static function exists($name){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			$name=trim($name);
			return(static::$UserBase ->exists_name($name));
		}
		public static function enterIn($login){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			if(! static::$UserBase ->exists_name($login)){
				return new Result("Пользователя не существует");
			}
			$line= static::$UserBase ->get_line($login);
			setcookie('sudo', $login."-".$line[0]."-".$line[1]);
			return new Result();
		}
		public static function login($login, $pass){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			if(! static::$UserBase ->exists_name($login)){
				return new Result("Пользователя не существует");
			}
			$user= static::$UserBase ->get_line($login);
			if(Hash::verify($pass, $user[0])){
				setcookie('admin', "$login-$pass");
			}
			return new Result();
		}
		public static function delete($login){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			if(! static::$UserBase ->exists_name($login)){
				return new Result("Пользователя не существует");
			}
			$tmpl=( static::$UserBase ->get_line(trim($login)));
			if($tmpl[1]=="globaladmin"){
				$c=0;
				if(static::$UserBaseAll==null){
					static::$UserBaseAll= static::$UserBase ->get_all();
				}
				foreach( static::$UserBaseAll as $line){
					if($line[1]=="globaladmin"){
						$c++;
					}
				}
			}else{
				$c=2;
			}
			if($c<=1){
				return new Result("Вы не можете удалить последнего администратора статуса <code>globaladmin</code>!");
			}else{
				static::deleteClever($login);
				unset(static::$UserBaseAll[trim($login)]);
				static::$UserBase ->del_name(trim($login))->write();
			}
			return new Result();
		}
		#endregion
		#region Level
		public static function levelDown($name){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			if(! static::$UserBase ->exists_name($name)){
				return new Result("Пользователя не существует");
			}
			$tmpl=( static::$UserBase ->get_line(trim($name)));
			if($tmpl[1]=="globaladmin"){
				$c=0;
				if(static::$UserBaseAll ==null){
					static::$UserBaseAll= static::$UserBase ->get_all();
				}
				foreach(static::$UserBaseAll as $line){
					if($line[1]=="globaladmin"){
						$c++;
					}
				}
			}else{
				$c=2;
			}
			if($c<=1){
				return new Result("Вы не можете понизить последнего администратора статуса globaladmin!");
			}else{
				$name=trim($name);
				$line=static::$UserBase ->get_line($name);
				$lineold=$line;
				if(Stats::$StatCanBase ==null){
					Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
				}
				if(Stats::$StatCanBaseAll ==null){
					Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
				}
				$lastkey=null;
				$key=null;
				foreach(Stats::$StatCanBaseAll as $key=>$value){
					if($lastkey==$line[1]){
						$line[1]=$key;
						break;
					}
					$lastkey=$key;
				}
				if($lastkey==$line[1]){
					$line[1]=$key;
				}
				if($line==$lineold){
					return new Result("Невозможно! Уже минимальный статус.");
				}
				if(static::$UserBaseAll !=null){
					static::$UserBaseAll[$name]=$line;
				}
				static::$UserBase ->add_line($line, $name)->write();
			}
			return new Result();
		}
		public static function levelUp($name){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			if(! static::$UserBase ->exists_name($name)){
				return new Result("Пользователя не существует");
			}
			$name= trim($name);
			$line= static::$UserBase ->get_line($name);
			if($line[1]=="globaladmin"){
				return new Result("Невозможно! Уже максимальный статус.");
			}
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			$lastkey=null;
			foreach(Stats::$StatCanBaseAll as $key=>$value){
				if($key==$line[1]){
					$line[1]=$lastkey;
				}
				$lastkey=$key;
			}
			static::$UserBaseAll[$name]=$line;
			static::$UserBase ->add_line($line, $name)->write();
			return new Result() ;
		}
		#endregion
		public static function auth(){
			if(Users::$Login==null){
				Users::$Login=Users::LogInCheck();
			}
			return Users::$Login;
		}
		private static function LogInCheck(){
			if(!isset($_COOKIE['admin'])){
				return false;
			}
			if(!preg_match("@.+-[a-zA-Z1-90]@u", $_COOKIE['admin'])){
				return false;
			}
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			$auf=explode("-", $_COOKIE['admin']);
			$login=trim($auf[0]);
			$pass=trim($auf[1]);
			if(static::$UserBase ->exists_name($login)){
				$user=static::$UserBase ->get_line($login);
				if(Hash::verify($pass, $user[0])){
					$auf[0]=$login;
					$auf[1]=$user[0];
					$auf[2]=$user[1];
					$newh=Hash::rehash($pass, $user[0]);
					if($newh!=false){
						static::$UserBase->add_line(array($newh, $user[1]), $login);
						static::$UserBase->write();
					}
					return $auf;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
		public static function GetStat($user){
			if(static::$UserBase ==null){
				static::$UserBase=new D_BASE();
			}
			if(! static::$UserBase ->exists_name($user)){
				return null;
			}
			$line= static::$UserBase ->get_line($user);
			return $line[1];
		}
	}
	class Stats{
		public static $StatCanBase=null; //tables.tdb
		public static $StatCanBaseAll=null;
		private static $StatTextBase=null; //tablei.tdb
		private static $StatTextBaseAll=null;
		#region Level
		public static function levelDown($newstat){
			$newstat=trim($newstat);
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			if(isset(Stats::$StatCanBaseAll [$newstat])){
				$inc=0;
				$counted=Stats::$StatCanBase ->counted();
				$bool=false;
				foreach(Stats::$StatCanBaseAll as $namee=>$linee){
					if($bool){
						$newstat=$namee;
						break;
					}
					$inc++;
					if(($inc!=1)and($inc!=$counted)){
						if($namee==$newstat){
							$bool=true;
						}
					}
				}
				if($inc==$counted){
					return new Result("Невозможно, уже минимальная позиция");
				}
				$inc=1;
				$alles=array();
				$lastline=null;
				$lastname=null;
				foreach(Stats::$StatCanBaseAll as $name=>$line){
					if(($inc>2)and($name==$newstat)){
						$alles[$name]=$line;
						$alles[$lastname]=$lastline;
					}else{
						if($inc!=1){
							$alles[$lastname]=$lastline;
						}
					}
					$inc++;
					$lastname=$name;
					$lastline=$line;
				}
				$alles[$lastname]=$lastline;
				Stats::$StatCanBase ->set_all($alles);
				Stats::$StatCanBase ->write();
			}else{
				return new Result("Статуса не существует");
			}
			return new Result();
		}
		public static function levelUp($newstat){
			$newstat=trim($newstat);
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			$lastline=null;
			$lastname=null;
			if(isset( Stats::$StatCanBaseAll [$newstat])){
				$inc=1;
				$All=array();
				foreach(Stats::$StatCanBaseAll as $name=>$line){
					if(($inc<=2)and($name==$newstat)){
						return new Result("Невозможно, позиция уже максимальна");
					}
					if(($inc>2)and($name==$newstat)){
						$All[$name]=$line;
						$All[$lastname]=$lastline;
					}else{
						if($inc!=1){
							$All[$lastname]=$lastline;
						}
					}
					$inc++;
					$lastname=$name;
					$lastline=$line;
				}
				$All[$lastname]=$lastline;
				Stats::$StatCanBase ->set_all($All);
				Stats::$StatCanBase ->write();
			}else{
				return new Result("Статуса не существует");
			}
			return new Result();
		}
		#endregion
		#region Groups
		public static function editTextGroup($status, $ops){
			if( static::$PravGroupsBase ==null){
				static::$PravGroupsBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablegroup.tdb");
			}
			if(! static::$PravGroupsBase ->exists_name($status)){
				return new Result("Пользователя не существует");
			}
			$status=trim($status);
			static::$PravGroupsBase->add_line(array($status, trim($ops)), $status);
			static::$PravGroupsBase->write();
			return new Result();
		}
		#endregion
		#region Stat
		public static function delete($newstat){
			$newstat=trim($newstat);
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			if(($newstat!="globaladmin")and($newstat!="admin")and($newstat!="bloger")){
				if(isset(Stats::$StatCanBaseAll[$newstat])){
					unset(Stats::$StatCanBaseAll[$newstat]);
					if( static::$StatTextBase ==null){
						static::$StatTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablei.tdb");
					}
					static::$StatTextBase ->del_name($newstat);
					static::$StatTextBase ->write();
				}
			}
			Stats::$StatCanBase ->set_all( Stats::$StatCanBaseAll );
			Stats::$StatCanBase ->write();
			return new Result();
		}
		public static function add($newstat, $ops){
			$newstat=trim($newstat);
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			if(!isset(Stats::$StatCanBaseAll [$newstat])){
				if( static::$StatTextBase ==null){
					static::$StatTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablei.tdb");
				}
				static::$StatTextBase ->add_line(trim($ops), $newstat);
				static::$StatTextBase ->write();
				foreach(Stats::$StatCanBaseAll ["globaladmin"] as $key=>$value){
					Stats::$StatCanBaseAll [$newstat][$key]="OFF";
				}
				Stats::$StatCanBase ->set_all(Stats::$StatCanBaseAll );
				Stats::$StatCanBase ->write();
			}
			return new Result();
		}
		public static function exists($newstat){
			$newstat=trim($newstat);
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			if(isset(Stats::$StatCanBaseAll [$newstat])){
				return true;
			}
			return false;
		}
		public static function editText($newstat, $ops){
			if( static::$StatTextBase ==null){
				static::$StatTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablei.tdb");
			}
			if(! static::$StatTextBase ->exists_name($newstat)){
				return new Result("Статуса несуществует");
			}
			static::$StatTextBase ->add_line($ops, $newstat);
			if( static::$StatTextBaseAll !=null){
				static::$StatTextBaseAll[$newstat]=$ops;
			}
			static::$StatTextBase ->write();
			return new Result();
		}
		public static function can($stat, $raz=354){
			if($raz===354){
				return Stats::can($GLOBALS['AUTH'][2], $stat);
			}
			if(is_string($raz)){
				if(strpos($raz, ',')){
					$raz=explode(',', $raz);
					foreach($raz as $rrr){
						if(Stats::can($stat, $rrr)){
							return true;
						}
					}
					return false;
				}
				if(strpos($raz, '.')){
					$raz=explode('.', $raz);
					foreach($raz as $rrr){
						if(!Stats::can($stat, $rrr)){
							return false;
						}
					}
					return true;
				}
				if(Stats::$StatCanBase ==null){
					Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
				}
				if(Stats::$StatCanBaseAll ==null){
					Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
				}
				if($stat=="globaladmin"){
					return true;
				}
				if(!isset(Stats::$StatCanBaseAll [$stat][$raz])){
					ELog::Logged("[DATA_BASE_ERROR] base: tables.tdb STAT_CAN_BASE; name: $stat\"$raz\",  in:".date("H:i:s").'&nbsp;'.date("d.m.Y"));
					return false;
				}
				if(Stats::$StatCanBaseAll [$stat][$raz]=="ON"){
					return true;
				}
				return false;
			}else{
				foreach($raz as $rrr){
					if(Stats::can($stat, $rrr)){
						return true;
					}
				}
				return false;
			}
		}
		#endregion
		#region GUI
		public static function HTMLStatuses(){
			if( Stats::$StatTextBase ==null){
				Stats::$StatTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablei.tdb");
			}
			if(Stats::$StatTextBaseAll==null){
				Stats::$StatTextBaseAll= Stats::$StatTextBase ->get_all();
			}
			$html="";
			foreach(Stats::$StatTextBaseAll as $us=>$ru){
				$html.="<option value=\"$us\">$ru</option>";
			}
			return($html);
		}
		public static function getRuStatus($stat){
			if( Stats::$StatTextBase ==null){
				Stats::$StatTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablei.tdb");
			}
			if(!Stats::$StatTextBase ->exists_name($stat)){
				return("Неизвестно");
			}
			return(Stats::$StatTextBase ->get_line($stat));
		}
		#endregion
		#region GLOBAL
		public static function setPravs(){
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			foreach(Stats::$StatCanBaseAll as $name=>$line){
				foreach($line as $key=>$value){
					if($name!="globaladmin"){
						Stats::$StatCanBaseAll [$name][$key]=(((isset($_POST[$name."_".$key]))and($_POST[$name."_".$key]=="ON"))?("ON"):("OFF"));
					}else{
						Stats::$StatCanBaseAll [$name][$key]="ON";
					}
				}
			}
			Stats::$StatCanBase->set_all(Stats::$StatCanBaseAll );
			Stats::$StatCanBase->write();
			return new Result();
		}
		#endregion
	}
	class Pravs{
		protected static $PravTextBase=null; //tablesi.tdb
		protected static $PravTextBaseAll=null;
		protected static $PravGroupsBase=null; //tablegroup.tdb
		protected static $PravGroupsBaseAll=null;
		#region PravGroup
		public static function addGroup($groupName, $ops){
			if( static::$PravGroupsBase ==null){
				static::$PravGroupsBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablegroup.tdb");
			}
			$groupName=trim($groupName);
			static::$PravGroupsBase ->add_line(array($groupName, trim($ops)), $groupName);
			static::$PravGroupsBase ->write();
			return new Result();
		}
		public static function deleteGroup($groupName){
			if( static::$PravGroupsBase ==null){
				static::$PravGroupsBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablegroup.tdb");
			}
			if(! static::$PravGroupsBase ->exists_name($groupName)){
				return new Result("Группы не существует");
			}
			static::$PravGroupsBase ->del_name(trim($groupName));
			static::$PravGroupsBase ->write();
			return new Result();
		}
		#endregion
		#region Prav
		public static function editText($newstat, $ops, $group){
			$newstat=trim($newstat);
			if(Pravs::$PravTextBase ==null){
				Pravs::$PravTextBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablesi.tdb");
			}
			if(Pravs::$PravTextBaseAll ==null){
				Pravs::$PravTextBaseAll= Pravs::$PravTextBase ->get_all();
			}
			Pravs::$PravTextBase ->add_line(array(trim($ops), trim($group)), $newstat);
			Pravs::$PravTextBase ->write();
			return new Result();
		}
		public static function add($name, $group, $ops){
			$name=trim($name);
			if( Pravs::$PravTextBase ==null){
				Pravs::$PravTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablesi.tdb");
			}
			Pravs::$PravTextBase ->add_line(array(trim($ops), trim($group)), $name);
			Pravs::$PravTextBase ->write();
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			foreach(Stats::$StatCanBaseAll as $namem=>$line){
				$line[$name]=(($namem=="globaladmin")?("ON"):("OFF"));
				Stats::$StatCanBaseAll [$namem]=$line;
			}
			Stats::$StatCanBase ->set_all(Stats::$StatCanBaseAll);
			Stats::$StatCanBase ->write();
			return new Result();
		}
		public static function delete($prav){
			if( Pravs::$PravTextBase ==null){
				Pravs::$PravTextBase =new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tablesi.tdb");
			}
			$prav=trim($prav);
			if(Pravs::$PravTextBase ->exists_name($prav)){
				Pravs::$PravTextBase ->del_name($prav);
				Pravs::$PravTextBase ->write();
			}
			if(Stats::$StatCanBase ==null){
				Stats::$StatCanBase=new D_BASE($_SERVER['DOCUMENT_ROOT']."/cms/tables.tdb");
			}
			if(Stats::$StatCanBaseAll ==null){
				Stats::$StatCanBaseAll= Stats::$StatCanBase ->get_all();
			}
			foreach(Stats::$StatCanBaseAll as $name=>$line){
				if(isset($line[$prav])){
					unset(Stats::$StatCanBaseAll [$name][$prav]);
				}
			}
			Stats::$StatCanBase ->set_all(Stats::$StatCanBaseAll);
			Stats::$StatCanBase ->write();
			return new Result();
		}
		#endregion
	}
}
?>