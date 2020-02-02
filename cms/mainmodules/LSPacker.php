<?php
class LSPacker{
public static function funpack($path){
	return self::str_unpack(file_get_contents($path));
}
public static function fpack($path){
	return self::str_pack(file_get_contents($path));
}
public static function fpacki($path){
	file_put_contents($path, self::str_pack(file_get_contents($path)));
}
public static function funpacki($path){
	file_put_contents($path, self::str_unpack(file_get_contents($path)));
}
public static function str_pack($str){
	$pack=unpack('h*', gzdeflate($str, 9));
	return self::str_com($pack[1]);
}
public static function str_unpack($str){
	return gzinflate(pack('h*', self::str_uncom($str)));
}
protected static function str_com($str){
	// simple
	$str=preg_replace("@(.)\\1{6}@", "k\\1", $str);
	$str=preg_replace("@(.)\\1{5}@", "j\\1", $str);
	$str=preg_replace("@(.)\\1{4}@", "i\\1", $str);
	$str=preg_replace("@(.)\\1{3}@", "h\\1", $str);
	$str=preg_replace("@(.)\\1{2}@", "g\\1", $str);
	// max
	$str=preg_replace("@(..)\\1{5}@", "K\\1", $str);
	$str=preg_replace("@(..)\\1{4}@", "J\\1", $str);
	$str=preg_replace("@(..)\\1{3}@", "I\\1", $str);
	$str=preg_replace("@(..)\\1{2}@", "H\\1", $str);
	$str=preg_replace("@(..)\\1{1}@", "G\\1", $str);
	// s max
	$str=preg_replace("@(...)\\1{5}@", "v\\1", $str);
	$str=preg_replace("@(...)\\1{4}@", "w\\1", $str);
	$str=preg_replace("@(...)\\1{3}@", "y\\1", $str);
	$str=preg_replace("@(...)\\1{2}@", "x\\1", $str);
	$str=preg_replace("@(...)\\1{1}@", "z\\1", $str);
	// s s max
	$str=preg_replace("@(....)\\1{5}@", "V\\1", $str);
	$str=preg_replace("@(....)\\1{4}@", "W\\1", $str);
	$str=preg_replace("@(....)\\1{3}@", "Y\\1", $str);
	$str=preg_replace("@(....)\\1{2}@", "X\\1", $str);
	$str=preg_replace("@(....)\\1{1}@", "Z\\1", $str);
	// s s s max
	$str=preg_replace("@(.....)\\1{5}@", "q\\1", $str);
	$str=preg_replace("@(.....)\\1{4}@", "r\\1", $str);
	$str=preg_replace("@(.....)\\1{3}@", "s\\1", $str);
	$str=preg_replace("@(.....)\\1{2}@", "t\\1", $str);
	$str=preg_replace("@(.....)\\1{1}@", "u\\1", $str);
	// 6 max
	$str=preg_replace("@(......)\\1{5}@", "Q\\1", $str);
	$str=preg_replace("@(......)\\1{4}@", "R\\1", $str);
	$str=preg_replace("@(......)\\1{3}@", "S\\1", $str);
	$str=preg_replace("@(......)\\1{2}@", "T\\1", $str);
	$str=preg_replace("@(......)\\1{1}@", "U\\1", $str);
	return $str;
}
protected static function str_uncom($str){
	// 6 max
	$str=preg_replace("@U(......)@", "\\1\\1", $str);
	$str=preg_replace("@T(......)@", "\\1\\1\\1", $str);
	$str=preg_replace("@S(......)@", "\\1\\1\\1\\1", $str);
	$str=preg_replace("@R(......)@", "\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@Q(......)@", "\\1\\1\\1\\1\\1\\1", $str);
	// s s s max
	$str=preg_replace("@u(.....)@", "\\1\\1", $str);
	$str=preg_replace("@t(.....)@", "\\1\\1\\1", $str);
	$str=preg_replace("@s(.....)@", "\\1\\1\\1\\1", $str);
	$str=preg_replace("@r(.....)@", "\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@q(.....)@", "\\1\\1\\1\\1\\1\\1", $str);
	// s s max
	$str=preg_replace("@Z(....)@", "\\1\\1", $str);
	$str=preg_replace("@X(....)@", "\\1\\1\\1", $str);
	$str=preg_replace("@Y(....)@", "\\1\\1\\1\\1", $str);
	$str=preg_replace("@W(....)@", "\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@V(....)@", "\\1\\1\\1\\1\\1\\1", $str);
	// s max
	$str=preg_replace("@z(...)@", "\\1\\1", $str);
	$str=preg_replace("@x(...)@", "\\1\\1\\1", $str);
	$str=preg_replace("@y(...)@", "\\1\\1\\1\\1", $str);
	$str=preg_replace("@w(...)@", "\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@v(...)@", "\\1\\1\\1\\1\\1\\1", $str);
	// max
	$str=preg_replace("@G(..)@", "\\1\\1", $str);
	$str=preg_replace("@H(..)@", "\\1\\1\\1", $str);
	$str=preg_replace("@I(..)@", "\\1\\1\\1\\1", $str);
	$str=preg_replace("@J(..)@", "\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@K(..)@", "\\1\\1\\1\\1\\1\\1", $str);
	// simple
	$str=preg_replace("@g(.)@", "\\1\\1\\1", $str);
	$str=preg_replace("@h(.)@", "\\1\\1\\1\\1", $str);
	$str=preg_replace("@i(.)@", "\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@j(.)@", "\\1\\1\\1\\1\\1\\1", $str);
	$str=preg_replace("@k(.)@", "\\1\\1\\1\\1\\1\\1\\1", $str);
	return $str;
}
}
?>