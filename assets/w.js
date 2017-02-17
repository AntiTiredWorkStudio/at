var PostForm = [];
PostForm['a'] = "works";
$.ajax({
	type: 'POST',
	url: "http://www.lofs.pw/at/a/P.php",
	data: PostForm,
	success: function(data){
		$("#works").html(data);
	//	console.log(data);
	},
	dataType: "text"});