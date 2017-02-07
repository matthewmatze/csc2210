
var source = new EventSource('start.php');
var plr;

source.addEventListener("player", jplayers, false);

source.addEventListener("nplayers", nplayers, false);

source.addEventListener("stats", stats, false);

function nplayers(e){
	//alert(e.data);
  var pingev = document.getElementById("nplayers");
  pingev.innerHTML = e.data;
  plr =e.data;
}	
function jplayers(e){
	//alert(e.data);
  var pingev = document.getElementById("jplayers");
  pingev.innerHTML = e.data;
  plr =e.data;
}	
function stats(e){
	//alert(e.data);
	window.location.href='stats.html';
}	
