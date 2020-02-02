<PRE>
stylestable
</PRE>
<FORM>
<form action="action.php" method="POST" autocomplete="off">
|SHeader|
<input type="hidden" name="sa" value="<?php echo($_GET['s']);?>">
<input type="hidden" name="tsel" value=$ACTNAME$>
<input type="hidden" name="page" value="shabl.php?tsel=openst&s=<?php echo($_GET['s']);?>">
<?php
$stry= \LCMS\Core\Patterns\Pattern::styletable($_GET['s'], "<tr><th colspan=\"5\">Таблица стиля</th></tr>");
echo($stry[1]);
?>
<input type="hidden" name="names" value="<?php echo(implode("|", $stry[2]));?>">
<br>
<input type="submit" value="Изменить">
</form>
</FORM>
<ACTION>
<?php
$_POST['page']="shabl.php";
if(strpos($_POST['names'], "|")!=false){
	$tmpdb=unserialize(file_get_contents("s/db/so.db"));
	$style=trim($_POST['sa']);
	if((isset($tmpdb[$style])) or \LCMS\Core\Users\Stats::can($GLOBALS['AUTH'][2], "allpatt")){
		$names=explode("|", $_POST['names']);
		$stfilewww=unserialize(file_get_contents("s/$style.seria"));
		$stfile=explode("\n", $stfilewww['css']);
		foreach($stfile as $key=>$namel){
			$namel=trim($namel);
			if(preg_match("@/\*CSS: .+\*/@", $namel)){
				$name=substr($namel, 7);
				$name=substr($name, 0, strlen($name)-2);
				$info=explode("|", $_POST["i_$name"]);
				$type=trim($info[0]);
				$def=trim($info[1]);
				$key+=1;
				$css=explode(":", rtrim($stfile[$key]));
				$vald=false;
				switch(trim($type)){
					default:
					case "text":
					if($_POST[$name]==""){
						$val=$def;
					}else{
						$val=$_POST[$name];
					}
					$stri=": ".$val.";\r";
					$cssstr=$css[0].$stri;
					$stfile[$key]=$cssstr;
					break;
					case "rgb":
					if($_POST[$name."_r"]==""){
						$vald=$def;
					}else{
						$valr=$_POST[$name."_r"];
					}
					if($_POST[$name."_g"]==""){
						$vald=$def;
					}else{
						$valg=$_POST[$name."_g"];
					}
					if($_POST[$name."_b"]==""){
						$vald=$def;
					}else{
						$valb=$_POST[$name."_b"];
					}
					if($vald==false){
						$stri=": rgb($valr, $valg, $valb);\r";
					}else{
						$stri=": $vald;\r";
					}
					$cssstr=$css[0].$stri;
					$stfile[$key]=$cssstr;
					break;
					case "rgba":
					if($_POST[$name."_r"]==""){
						$vald=$def;
					}else{
						$valr=$_POST[$name."_r"];
					}
					if($_POST[$name."_g"]==""){
						$vald=$def;
					}else{
						$valg=$_POST[$name."_g"];
					}
					if($_POST[$name."_b"]==""){
						$vald=$def;
					}else{
						$valb=$_POST[$name."_b"];
					}
					if($_POST[$name."_a"]==""){
						$vald=$def;
					}else{
						$vala=$_POST[$name."_a"];
					}
					if($vald==false){
						$stri=": rgba($valr, $valg, $valb, $vala);\r";
					}else{
						$stri=": $vald;\r";
					}
					$cssstr=$css[0].$stri;
					$stfile[$key]=$cssstr;
					break;
				}
			}
		}
		$stfile=implode("\n", $stfile);
		$stfilewww['css']=$stfile;
		file_put_contents("s/$style.seria", serialize($stfilewww));
	}
}
?>
</ACTION>