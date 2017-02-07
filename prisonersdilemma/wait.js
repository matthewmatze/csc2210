var source = new EventSource('wait.php');
//source.onerror=function(e){alert(e.data)};

source.addEventListener("waitplayer", waitplayer, false);

function waitplayer(e){
	window.location.href='choice.html';
}
