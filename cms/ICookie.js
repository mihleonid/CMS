function Cget(name) {
	var a=window.localStorage.getItem(name);
	if(a==null){
		a="";
	}
	return a;
}
function Cdelete(name) {
	return window.localStorage.removeItem(name);
}
function Cset(name, value) {
	return window.localStorage.setItem(name, value);
}