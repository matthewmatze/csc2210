var source = new EventSource('SSEchoice.php');
//source.onerror=function(e){alert(e.data)};

source.addEventListener("choicepage", waitplayer, false);

function waitplayer(e){
	window.location.href='wait.html';
}
~                                
