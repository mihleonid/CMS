<?php
namespace LCMS\MainModules{
	function str_replace_once($search, $replace, $text) {
		$pos = strpos($text, $search);
		return (($pos!==false)?(substr_replace($text, $replace, $pos, strlen($search))):($text));
	}
	use DOMNode;
	use DOMDocument;
	class TagStripper{
		protected $allowed=array();
		protected $PHP=true;
		public function __construct($php = true, $tags=null, $can=false){
			if($tags===null){
				$this->allowed=CMS::getAllowedTags($can);
			}
			$this->setPHPMode($php);
		}
		public function setPHPMode($php){
			if($php){
				$this->PHP=true;
			}else{
				$this->PHP=false;
			}
		}
		public function strip($html){
			$m=array();
			if($this->PHP){
				$html=str_replace("<?", "<code>&lt;?", $html);
				$html=str_replace("?>", "?&gt;</code>", $html);
				$html=preg_replace("@php@i", "<code>\\0</code>", $html);
				$html=str_replace("<%", "<code>&lt;%", $html);
				$html=str_replace("%>", "%&gt;</code>", $html);
			}else{
				$html=str_replace("<php>", "", $html);
				$html=str_replace("</php>", "", $html);
				preg_match("@\<\?.*?\?\>@s", $html, $m);
				$html=preg_replace("@\<\?.*?\?\>@s", '<php></php>', $html);
			}
			try{
				$dirty=new DOMDocument;
				$dirty->loadHTML('<?xml encoding="utf-8" ?>' .$html);//"<html><head></head><body>$html</body></html>"
				$dirtyBody=$dirty->getElementsByTagName('body')->item(0);
				$clean=new DOMDocument();
				$cleanBody=$clean->appendChild($clean->createElement('body'));
				$this->copyNodes($dirtyBody, $cleanBody);
				$stripped='';
				foreach($cleanBody->childNodes as $node){
					$stripped.=$clean->saveXml($node);
				}
			}
			catch(Exception $e){
				$stripped="INCORRECT_HTML:".htmlentities($html, ENT_QUOTES, 'utf-8');
			}
			if(!($this->PHP)){
				foreach($m as $line){
					$stripped=str_replace_once("&lt;php&gt;&lt;/php&gt;", $line, $stripped);
				}
			}
			return trim($stripped);
		}
		protected function copyNodes(DOMNode $dirty, DOMNode $clean){
			foreach($dirty->attributes as $name=>$valueNode){
				if(isset($this->allowed[$dirty->nodeName][$name])){
					$attr=$clean->ownerDocument->createAttribute($name);
					$attr->value=$valueNode->value;
					$clean->appendChild($attr);
				}
			}
			foreach($dirty->childNodes as $child){
				if(($child->nodeType==XML_ELEMENT_NODE)and(isset($this->allowed[$child->nodeName]))){
					$node=$clean->ownerDocument->createElement($child->nodeName);
					$clean->appendChild($node);
					$this->copyNodes($child, $node);
				}elseif($child->nodeType==XML_TEXT_NODE){
					$text=$clean->ownerDocument->createTextNode($child->textContent);
					$clean->appendChild($text);
				}else{
					$text=$clean->ownerDocument->createTextNode("<".$child->nodeName .">".$child->textContent . "</".$child->nodeName .">");
					$clean->appendChild($text);
				}
			}
		}
		/*
		protected static function allCombo($arr, $empty=false, $spliter="", $level=null, $main=true, $firstconcat=""){
		$array=array();
		if($level===null){
		$level=count($arr);
		}
		if($level==0){
		return $array;
		}
		foreach($arr as $val){
		$firstconcate=$firstconcat.$spliter.$val;
		$array[]=$firstconcate;
		$array=array_merge($array, static::allCombo($arr, $empty, $spliter, $level-1, false, $firstconcate));
		}
		if(($empty)and($main)){
		$array[]='';
		}
		return $array;
		}
		public static function Ecran($text, $tags=null){
		if($tags==null){
		static::$tagsToEcran=CMS::getLoc("tag");
		}else{
		static::$tagsToEcran=$tags;
		}
		$text=str_replace("\'", "\"", $text);
		while(strpos($text, "\t")!==false){
		$text=str_replace("\t", " ", $text);
		}
		while(strpos($text, "  ")!==false){
		$text=str_replace("  ", " ", $text);
		}
		$text=htmlentities($text, ENT_NOQUOTES, 'utf-8');
		foreach(static::$tagsToEcran as $name=>$tag){
		foreach($tag as $o=>$k){
		$tagg[]="(".$o."(=\"[a-zа-я!1-90\/\.\-\*\+]*?\")?)";
		}
		$tagg=static::AllCombo($tagg, true, " ");
		//print_r($tagg);
		foreach($tagg as $l){
		$text=preg_replace("@&lt;(/?".$name.$l." ?/?)&gt;@ui", "<\\1>", $text);
		}
		}
		return($text);
		}*/
	}
	class CHTML{
		public static function has($text, $tag){
			$tag=preg_quote($tag, "@");
			return(preg_match("@<$tag ?/>@u", $text)!=0);
		}
		public static function hasopen($text, $tag){
			$tag=preg_quote($tag, "@");
			return(preg_match("@<$tag.*?>@u", $text)!=0);
		}
		public static function cPath($text, $path, $m="sui"){
			$path=explode('.', trim(trim($path, '.')));
			foreach($path as $p){
				$text=static::between($text, $p, $m);
			}
			return $text;
		}
		public static function between($text, $tag, $m="sui", $arg=array()){
			$tag=preg_quote($tag, "@");
			if($arg==array()){
				$i=preg_match("@<$tag>(.*?)</$tag>@$m", $text, $matches);
				if($i==0){
					return "";
				}
				return $matches[1];
			}
			if($arg==null){
				preg_match("@<$tag(.*?)>(.*?)</$tag>@$m", $text, $matches);
				if($i==0){
					return "";
				}
				return $matches[1];
			}
			$s="";
			foreach($arg as $k=>$i){
				if($i===true){
					$s.=" $k";
				}else{
					$i=preg_quote($i, "@");
					$s.=" $k=\"$i\"";
				}
			}
			$i=preg_match("@<$tag".$s.">(.*?)</$tag>@$m", $text, $matches);
			if($i==0){
					return "";
			}
			return $matches[1];
		}
	}
}
?>