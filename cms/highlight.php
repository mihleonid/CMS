<?php
if(!isset($OF_PHP)){
	$text=$_POST['str'];
	$content=file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/highlight.loc");
	$arr=unserialize($content);
	ini_set("highlight.comment", $arr["com"]);
	ini_set("highlight.default", $arr["def"]);
	ini_set("highlight.html", $arr["htm"]);
	ini_set("highlight.keyword", $arr["key"]);
	ini_set("highlight.string", $arr["str"]);
	ini_set("default_charset", 'utf-8');
	//$text=str_replace("&nbsp;", " ", $text);
	$text=str_replace("_t", "__t", $text);
	$text=str_replace("\t", "_t", $text);
	$text=highlight_string($text, true);
	$text=str_replace("\n", "", $text);
	$text=str_replace("\r", "", $text);
	$text=str_replace("<br />", "\n", $text);
	$style=$arr["var"];
	$text=preg_replace("@\\\$[a-zA-Z_(\\\$)]+[a-zA-Z_1-90(\\\$)]*@", "<span style=\"color: $style;\">\\0</span>", $text);
	$text=preg_replace("@_{0}_t@", "\t", $text);
	$text=str_replace("__t", "_t", $text);
	echo $text;
}
function highlight($text){
	$content=file_get_contents($_SERVER['DOCUMENT_ROOT']."/cms/location/highlight.loc");
	$arr=unserialize($content);
	ini_set("highlight.comment", $arr["com"]);
	ini_set("highlight.default", $arr["def"]);
	ini_set("highlight.html", $arr["htm"]);
	ini_set("highlight.keyword", $arr["key"]);
	ini_set("highlight.string", $arr["str"]);
	$text=str_replace("_t", "__t", $text);
	$text=str_replace("\t", "_t", $text);
	$text=highlight_string($text, true);
	$style=$arr["var"];
	$text=preg_replace("@\\\$[a-zA-Z_(\\\$)]+[a-zA-Z_1-90(\\\$)]*@", "<span style=\"color: $style;\">\\0</span>", $text);
	$text=preg_replace("@_{0}_t@", "\t", $text);
	$text=str_replace("__t", "_t", $text);
	return $text;
}
// echo htmlentities(highlight_string($_POST['str'], true));
?>