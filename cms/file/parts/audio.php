<!doctype html>
<html>
<head>
<?php
echo $_HEAD;
?>
<style>
#img{
	width: 100vw;
	margin-top: calc(50vh - 32px);
}
body{
	margin: 0px;
	background-color: #eeeeee;
}
</style>
</head>
<body>
<audio controls src="<?php echo ("parts/img/get.php?path=".$_PATH)?>" id="img" <?php echo $exif[3]?>>
</audio>
<script>
var img=document.getElementById("img");
document.body.addEventListener("keydown", function(evt){
	// window.alert(evt.keyCode);
	if(evt.keyCode==80){
		if((evt.keyCode==67)&&(evt.shiftKey==true)){
			window.close();
		}
		if(img.paused){
			img.play();
		}else{
			img.pause();
		}
	}
}, false);
</script>
</body>
</html>