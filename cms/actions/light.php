<CLEVER />
<PRE>
light
</PRE>
<HEADER>
Настройка
</HEADER>
<FORM>
<form action="action.php" method="POST">
|Header|
<?php
$srr=&PARAM&srr&;
if($srr==null){
	$srr=array();
}
$r=100;
$g=100;
$b=100;
$a=1;
$option=array('bo'=>'', 'i'=>'', 'bo'=>'', 'u'=>'', 't'=>'', 'o'=>'');
$arr=array('com'=>array($r, $g, $b, $a, $option), 'def'=>array($r, $g, $b, $a, $option), 'htm'=>array($r, $g, $b, $a, $option), 'key'=>array($r, $g, $b, $a, $option), 'var'=>array($r, $g, $b, $a, $option), 'str'=>array($r, $g, $b, $a, $option));
foreach($srr as $i=>$k){
	if(isset($srr[$i])){
		$k=$srr[$i];
	}
	$k=substr($k, 5);
	$r=substr($k, 0, strpos($k, ","));
	$k=substr($k, strpos($k, ",")+2);
	$g=substr($k, 0, strpos($k, ","));
	$k=substr($k, strpos($k, ",")+2);
	$b=substr($k, 0, strpos($k, ","));
	$k=substr($k, strpos($k, ",")+2);
	$a=substr($k, 0, strpos($k, ")"));
	$k=substr($k, strpos($k, ")")+2);
	$option=array();
	if(strpos($k, "font-weight: bold")!==false){
		$option['bo']=" checked";
	}else{
		$option['bo']="";
	}
	if(strpos($k, "font-style: italic")!==false){
		$option['i']=" checked";
	}else{
		$option['i']="";
	}
	if(strpos($k, " underline")!==false){
		$option['u']=" checked";
	}else{
		$option['u']="";
	}
	if(strpos($k, " line-through")!==false){
		$option['t']=" checked";
	}else{
		$option['t']="";
	}
	if(strpos($k, " overline")!==false){
		$option['o']=" checked";
	}else{
		$option['o']="";
	}
	$arr[$i]=array($r, $g, $b, $a, $option);
}
?>
<table>
<tr><th rowspan="2">Пареметр</th><th colspan="4">Цветовое значение</th><th rowspan="2" style="font-size: larger;"><big>Жирный</big></th><th rowspan="2" style="font-style: italic;">Курсив</th><th rowspan="2" style="text-decoration: underline;">Подчёркивание</th><th rowspan="2" style="text-decoration: line-through;">Зачёркивание</th><th rowspan="2" style="text-decoration: overline;">Надчёркивание</th></tr>
<tr><th>Красный</th><th>Зелёный</th><th>Синий</th><th>Прозрачный</th></tr>
<tr><td>Комментарий</td><td><input type="number" min="0" max="255" name="com_r" value="<?php echo $arr['com'][0];?>" style="width: 60px; background-color: #ffaaaa;" required></td><td><input type="number" min="0" max="255" value="<?php echo $arr['com'][1];?>" name="com_g" style="width: 60px; background-color: #aaffaa;" required></td><td><input value="<?php echo $arr['com'][2];?>" type="number" min="0" max="255" name="com_b" style="width: 60px; background-color: #aaaaff;" required></td><td><input value="<?php echo $arr['com'][3];?>" type="number" min="0" max="1" step="0.05" name="com_a" style="width: 60px; background-color: rgba(170, 170, 170, 0.35);" required></td><td><input type="checkbox" name="com_bo" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['com'][4]['bo'];?>></td><td><input type="checkbox" name="com_i" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['com'][4]['i'];?>></td><td><input type="checkbox" name="com_u" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['com'][4]['u'];?>></td><td><input type="checkbox" name="com_t" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['com'][4]['t'];?>></td><td><input type="checkbox" name="com_o" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['com'][4]['o'];?>></td></tr>
<tr><td>Прочий текст</td><td><input type="number" min="0" max="255" name="def_r" value="<?php echo $arr['def'][0];?>" style="width: 60px; background-color: #ffaaaa;" required></td><td><input type="number" min="0" max="255" value="<?php echo $arr['def'][1];?>" name="def_g" style="width: 60px; background-color: #aaffaa;" required></td><td><input value="<?php echo $arr['def'][2];?>" type="number" min="0" max="255" name="def_b" style="width: 60px; background-color: #aaaaff;" required></td><td><input value="<?php echo $arr['def'][3];?>" type="number" min="0" max="1" step="0.05" name="def_a" style="width: 60px; background-color: rgba(170, 170, 170, 0.35);" required></td><td><input type="checkbox" name="def_bo" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['def'][4]['bo'];?>></td><td><input type="checkbox" name="def_i" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['def'][4]['i'];?>></td><td><input type="checkbox" name="def_u" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['def'][4]['u'];?>></td><td><input type="checkbox" name="def_t" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['def'][4]['t'];?>></td><td><input type="checkbox" name="def_o" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['def'][4]['o'];?>></td></tr>
<tr><td>HTML</td><td><input type="number" min="0" max="255" name="htm_r" value="<?php echo $arr['htm'][0];?>" style="width: 60px; background-color: #ffaaaa;" required></td><td><input type="number" min="0" max="255" value="<?php echo $arr['htm'][1];?>" name="htm_g" style="width: 60px; background-color: #aaffaa;" required></td><td><input value="<?php echo $arr['htm'][2];?>" type="number" min="0" max="255" name="htm_b" style="width: 60px; background-color: #aaaaff;" required></td><td><input value="<?php echo $arr['htm'][3];?>" type="number" min="0" max="1" step="0.05" name="htm_a" style="width: 60px; background-color: rgba(170, 170, 170, 0.35);" required></td><td><input type="checkbox" name="htm_bo" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['htm'][4]['bo'];?>></td><td><input type="checkbox" name="htm_i" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['htm'][4]['i'];?>></td><td><input type="checkbox" name="htm_u" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['htm'][4]['u'];?>></td><td><input type="checkbox" name="htm_t" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['htm'][4]['t'];?>></td><td><input type="checkbox" name="htm_o" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['htm'][4]['o'];?>></td></tr>
<tr><td>Ключевое слово</td><td><input type="number" min="0" max="255" name="key_r" value="<?php echo $arr['key'][0];?>" style="width: 60px; background-color: #ffaaaa;" required></td><td><input type="number" min="0" max="255" value="<?php echo $arr['key'][1];?>" name="key_g" style="width: 60px; background-color: #aaffaa;" required></td><td><input value="<?php echo $arr['key'][2];?>" type="number" min="0" max="255" name="key_b" style="width: 60px; background-color: #aaaaff;" required></td><td><input value="<?php echo $arr['key'][3];?>" type="number" min="0" max="1" step="0.05" name="key_a" style="width: 60px; background-color: rgba(170, 170, 170, 0.35);" required></td><td><input type="checkbox" name="key_bo" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['key'][4]['bo'];?>></td><td><input type="checkbox" name="key_i" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['key'][4]['i'];?>></td><td><input type="checkbox" name="key_u" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['key'][4]['u'];?>></td><td><input type="checkbox" name="key_t" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['key'][4]['t'];?>></td><td><input type="checkbox" name="key_o" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['key'][4]['o'];?>></td></tr>
<tr><td>Строка</td><td><input type="number" min="0" max="255" name="str_r" value="<?php echo $arr['str'][0];?>" style="width: 60px; background-color: #ffaaaa;" required></td><td><input type="number" min="0" max="255" value="<?php echo $arr['str'][1];?>" name="str_g" style="width: 60px; background-color: #aaffaa;" required></td><td><input value="<?php echo $arr['str'][2];?>" type="number" min="0" max="255" name="str_b" style="width: 60px; background-color: #aaaaff;" required></td><td><input value="<?php echo $arr['str'][3];?>" type="number" min="0" max="1" step="0.05" name="str_a" style="width: 60px; background-color: rgba(170, 170, 170, 0.35);" required></td><td><input type="checkbox" name="str_bo" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['str'][4]['bo'];?>></td><td><input type="checkbox" name="str_i" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['str'][4]['i'];?>></td><td><input type="checkbox" name="str_u" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['str'][4]['u'];?>></td><td><input type="checkbox" name="str_t" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['str'][4]['t'];?>></td><td><input type="checkbox" name="str_o" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['str'][4]['o'];?>></td></tr>
<tr><td>Переменная</td><td><input type="number" min="0" max="255" name="var_r" value="<?php echo $arr['var'][0];?>" style="width: 60px; background-color: #ffaaaa;" required></td><td><input type="number" min="0" max="255" value="<?php echo $arr['var'][1];?>" name="var_g" style="width: 60px; background-color: #aaffaa;" required></td><td><input value="<?php echo $arr['var'][2];?>" type="number" min="0" max="255" name="var_b" style="width: 60px; background-color: #aaaaff;" required></td><td><input value="<?php echo $arr['var'][3];?>" type="number" min="0" max="1" step="0.05" name="var_a" style="width: 60px; background-color: rgba(170, 170, 170, 0.35);" required></td><td><input type="checkbox" name="var_bo" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['var'][4]['bo'];?>></td><td><input type="checkbox" name="var_i" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['var'][4]['i'];?>></td><td><input type="checkbox" name="var_u" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['var'][4]['u'];?>></td><td><input type="checkbox" name="var_t" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['var'][4]['t'];?>></td><td><input type="checkbox" name="var_o" style="width: 20px; height: 20px; margin: 0px;"<?php echo $arr['var'][4]['o'];?>></td></tr>
</table>
<input type="submit" value="Настроить">
</form>
</FORM>
<ACTION>
<?php
return \LCMS\Core\GUI\Highlight::set();
?>
</ACTION>