var keychain = "";
var k = function(){
var postform = {'gk':sha1('antitired')};
$.ajax({
	type: 'POST',
	url: "/a/Keychain.php",
	data: postform,
	success: function(data){
		var json = JSON.parse(data);
		keychain = sha1(""+json['t']+json['r']);
		if(typeof(initInternet)!="undefined")
			initInternet();
		if(typeof(wjs)!="undefined")
			wjs();
		if(typeof(pf)!="undefined")
			pf();
	},
	dataType: "text"});
}

var fk = function(func){
var postform = {'gk':sha1('antitired')};
$.ajax({
	type: 'POST',
	url: "/a/Keychain.php",
	data: postform,
	success: function(data){
		var json = JSON.parse(data);
		keychain = sha1(""+json['t']+json['r']);
		if(typeof(func)!="undefined")
			func();
	},
	dataType: "text"});
}

var rk = function(){
	var postform = {'gk':sha1('antitired')};
	$.ajax({
	type: 'POST',
	url: "/a/Keychain.php",
	data: postform,
	success: function(data){
		var json = JSON.parse(data);
		keychain = sha1(""+json['t']+json['r']);
	},
	dataType: "text"});
}

self.setInterval(rk,30000);
//setInterval(
k();