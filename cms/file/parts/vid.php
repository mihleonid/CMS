<!doctype html>
<html>
<head>
<?php
echo $_HEAD;
?>
<style>
#img{
	background-position: 0px 0px, 10px 10px;
	background-size: 20px 20px;
	background-image:linear-gradient(45deg, #eee 25%, transparent 25%, transparent 75%, #eee 75%, #eee 100%),linear-gradient(45deg, #eee 25%, white 25%, white 75%, #eee 75%, #eee 100%);
}
body{
	margin: 0px;
	background-color: #eeeeee;
}
</style>
</head>
<body style="text-align: center;">
<video controls src="<?php echo ("parts/img/get.php?path=".$_PATH)?>" id="img" <?php echo $exif[3]?>>
</video>
<script>
var img=document.getElementById("img");
img.addEventListener("loadedmetadata", function(evti){
	img.width=img.videoWidth;
	img.height=img.videoHeight;
	var w=img.width;
	var h=img.height;
	document.body.addEventListener("keydown", function(evt){
		if((evt.keyCode==67)&&(evt.shiftKey==true)){
			window.close();
		}
		if(evt.keyCode==107){
			img.width=img.width+1;
			img.height=img.height+1;
		}
		if(evt.keyCode==109){
			img.width=img.width-1;
			img.height=img.height-1;
		}
		if(evt.keyCode==37){
			img.width=img.width-2;
		}
		if(evt.keyCode==39){
			img.width=img.width+2;
		}
		if(evt.keyCode==38){
			img.height=img.height-2;
		}
		if(evt.keyCode==40){
			img.height=img.height+2;
		}
		if(evt.altKey){
			if(evt.keyCode==107){
				img.width=img.width+7;
				img.height=img.height+7;
			}
			if(evt.keyCode==109){
				img.width=img.width-7;
				img.height=img.height-7;
			}
			if(evt.keyCode==37){
				img.width=img.width-6;
			}
			if(evt.keyCode==39){
				img.width=img.width+6;
			}
			if(evt.keyCode==38){
				img.height=img.height-6;
			}
			if(evt.keyCode==40){
				img.height=img.height+6;
			}
		}
		if(evt.keyCode==111){
			img.width=w;
			img.height=h;
		}
		if(evt.keyCode==106){
			img.width=window.screen.availWidth;
			img.height=window.screen.availHeight-110;
		}
		if(evt.keyCode==80){
			if(img.paused){
				img.play();
			}else{
				img.pause();
			}
		}
	}, false);
}, false);
</script>
</body>
</html>