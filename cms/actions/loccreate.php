<PRE>
env
</PRE>
<FORM>
|F|
<input type="text" name="k" placeholder="---title---" pattern="[a-zA-Z1-90_]+">
<select name="type">
<option value="bool"**b** selected***>---datatype.type.bool---</option>
<option value="int"**i** selected***>---datatype.type.int---</option>
<option value="float"**f** selected***>---datatype.type.float---</option>
<option value="string"**s** selected***>---datatype.type.string---</option>
<option value="null"**n** selected***>---datatype.type.null---</option>
</select>
<input type="text" name="l" placeholder="---value---">
<input type="submit" value="---create---">
</form>
</FORM>
<ACTION>
<?php
$l=null;
switch($_POST['type']){
	case "bool":
		if($_POST['l']){
			$l=true;
		}else{
			$l=false;
		}
		break;
	case "int":
		$l=intval($_POST['l']);
		break;
	case "string":
		$l=strval($_POST['l']);
		break;
	case "float":
		$l=floatval($_POST['l']);
		break;
}
return \LCMS\Core\Enviroment\Loc::set($_POST['k'], $l);
?>
</ACTION>