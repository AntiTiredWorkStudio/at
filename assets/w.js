var start = 1;
	var tot = 0;
	var count = (IsPC())?6:3;//3 or mutiply of 3
	var ItemsCount = count;
	var init = false;
	var OnPost = false;
	var onborder = "none";
	var errorclick = 0;
	var OnTouchMove = false;
	//$("body")[0].addEventListener('touchmove', function (e) { if(OnTouchMove){e.preventDefault();} }, false);

	function IsPC() {
		var userAgentInfo = navigator.userAgent;
		var Agents = ["Android", "iPhone",
					"SymbianOS", "Windows Phone",
					"iPad", "iPod"];
		var flag = true;
		for (var v = 0; v < Agents.length; v++) {
			if (userAgentInfo.indexOf(Agents[v]) > 0) {
				flag = false;
				break;
			}
		}
		return flag;
	}
var W = function(s,c,f){
		
		if(f){
			if(onborder == "right"){
				errorclick++;
				if(errorclick >4){
					alert('真没有下一页了！');
				}
				return;
			}else{
				errorclick= 0;
			}
		}else{
			if(onborder == "left"){
				errorclick++;
				if(errorclick >4){
					alert('真没有上一页了！');
				}
				return;
			}else{
				errorclick= 0;
			}
		}
		
		if(!OnPost){
			OnPost = true;
			var i = 0;
			$("#works").off("touchstart");
			$("#works").off("touchend");
			$("#works").off("touchmove");
			$("#works figure").each(function(){
	//			 animation: gif 1.4s infinite linear;
				//$(this).css("opacity",0);
				//$(this).css("animation-name",null);
				$(this).css("animation",(f)?"fade-Right 1s infinite":"fade-Left 1s infinite");
				$(this).css("animation-fill-mode","forwards");
				//console.log($(this));
				i++;
			});
			if(init){
				tot = $("#galleryData").attr("total");
				console.log("total:"+tot);
				if(f){
					start = $("#galleryData").attr("nextstart");
				}else{
					start = $("#galleryData").attr("laststart");
				}
				console.log("post start:"+start);
			}
			
			
			
		}else{
			return;
		}
		
		/*if(!init){
			init = true;
		}else{
			OnPost = false;
			return;
		}*/

		var PostForm = {};
		PostForm['a'] = "works";
		PostForm['s'] = start;//+((f)?c*(-1):c);
		PostForm['c'] = c;
		PostForm['r'] = ItemsCount;
		PostForm['d'] = f;
		PostForm['key'] = keychain;
	//	console.log(PostForm);
	//	console.log("current:"+start);
		setTimeout(function(){


		$.ajax({
			type: 'POST',
			url: "a/P.php",
			data: PostForm,
			success: function(data){
				//var obj = JSON.parse(data);
			//$("#works").html("");
			
				$("#works").html(data);
				/*if(start == 0){
					start = $("#galleryData").attr("current");
					W(start,count,f);
					return;
				}*/
				if(!init){
					/*if(f){
						start = $("#galleryData").attr("nextstart");
						console.log(start);
					}else{
						start = $("#galleryData").attr("laststart");
						console.log(start);
					}*/
					//console.log(tot);
					init = true;
				}
				tot = $("#galleryData").attr("total");
				ItemsCount = $("#galleryData").attr("real");
				onborder = $("#galleryData").attr("border");
				/*if(!f){
					start = start - count*2;
					if(start <1){
						start = tot - count;
					}
				}*/
				//console.log(start);
				switch(onborder){
					case "none":
						$("#bt_Last").text("上一页");
						$("#bt_Next").text("下一页");
						break;
					case "left":
						$("#bt_Last").text("上一页[没有了]");
						$("#bt_Next").text("下一页");
						break;
					case "right":
						$("#bt_Last").text("上一页");
						$("#bt_Next").text("下一页[没有了]");
						break;
					default:
						break;
				}
				G();
				initVideos();
				//console.log($("#galleryData").attr("total"),count);
				if(tot>count){
					$("#bt_Last").css("visibility","visible");
					$("#bt_Next").css("visibility","visible");
				}else{
					$("#bt_Last").css("visibility","hidden");
					$("#bt_Next").css("visibility","hidden");
				}
				//console.log("start:"+start);
				setTimeout(function(){
					OnPost = false;
					
				},700);
				
				
				/*$("#works figure").each(function(){
							console.log("onDrop over");  
						$(this)[0].ondragover = function (event)  
						{  
							console.log("onDrop over");  
							event.preventDefault();  
						}  
			  
						$(this)[0].ondragenter = function (event)  
						{  
							console.log("onDrop enter");  
						}  
			  
						$(this)[0].ondragleave = function (event)  
						{  
							console.log("onDrop leave");  
						}  
			  
						$(this)[0].ondragend = function (event)  
						{  
							console.log("onDrop end");  
						}  
					} );*/
					
					var cx = 0;
					var lx = 0;
					
					var cy = 0;
					var ly = 0;
					
					var deltaX = 0;
					
					var deltaY = 0;
					
					var totalDeltaX = 0;
					
					var totalDeltaY = 0;
					$("#works").on("touchstart",function(e){
						return;
						var touch = e.originalEvent.targetTouches[0]; 
						var x = touch.pageX;
						var y = touch.pageY;
						cx = x;
						lx = x;
						deltaX = 0;
						totalDeltaX = 0;
						cy = y;
						ly = y;
						deltaY = 0;
						totalDeltaY = 0;
						//console.log("touchstart detected!",x,y);
					});
					$("#works").on("touchmove",function(e){ 
						return;
						//console.log(e);
						var touch = e.originalEvent.targetTouches[0]; 
						var x = touch.pageX;
						var y = touch.pageY;
						totalDeltaX += Math.abs((x - lx));
						totalDeltaY += Math.abs((y - ly));
						lx = x;
						ly = y;
						deltaX = x - cx;
						deltaY = y - cy;
						//console.log("touchmove detected!",deltaX,totalDeltaX);
						if(deltaY <10){
							if(deltaX<-130){
								OnTouchMove = true;
								W(start,count,true);
							}
							if(deltaX>130){
								OnTouchMove = true;
								W(start,count,false);
							}
						}else{
							
						}
					});
					$("#works").on("touchend",function(){
						return;
						//console.log("touchend detected!");
						deltaX = 0;
						totalDeltaX = 0;
						deltaY = 0;
						totalDeltaY = 0;
						OnTouchMove = false;
						//document.removeEventListener('touchmove');
					});
					
				
			},
			dataType: "text"});
		},600);
	}
var wjs = function(){

	W(start,count,true);
}
