window.addEventListener('load', relink);
function relink(c){
	var c=document.links;
	for(var i=0;i<c.length;i++){
		var e=c[i];
		e.onclick=(function(evt){
			if(evt.button==0){
				var t=evt.currentTarget;
				if(!(evt.ctrlKey&&evt.shiftKey)){
					window.location.assign(t.href);
					evt.preventDefault();
					return false;
				}
				var h=t.href;
				var add="aj=1";
				if(h.indexOf('?')==-1){
					h+="?"+add;
				}else{
					if(h.indexOf('?')==h.length-1){
						h+=add;
					}else{
						h+="&"+add;
					}
				}
				var oAJAX=new XMLHttpRequest();
				oAJAX.open("GET", h, true);
				oAJAX.send();
				oAJAX.onreadystatechange=function(){
					if(oAJAX.readyState == 4){
						if(oAJAX.status == 200){
							if((oAJAX.responseText.indexOf('<iframe')!=-1)||(oAJAX.responseText.indexOf('<!--tohead-->')!=-1)){
								window.location.assign(t.href);
							}
							document.querySelector("section").innerHTML=oAJAX.responseText;
							window.setTimeout(relink, 400);
						}else{
							alert('error');
						}
					}else{
						//nop
					}
				};
				evt.preventDefault();
				return false;
			}
		});
	};
}