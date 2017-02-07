var source = new EventSource('SSEchoice.php');
//source.onerror=function(e){alert(e.data)};

source.addEventListener("choicepage", waitplayer, false);

function waitplayer(e){
   window.location.href='wait.html';
}

function choices(form){
	$.post('choice.php',{"choice":form.choose.value
	}, function(ResData){
		//alert(form.choose.value);
   	if(ResData==1)
			window.location.href='wait.html';
   	if(ResData==3)
			window.location.href='ucomplete.html';
   });
	return false;
}
