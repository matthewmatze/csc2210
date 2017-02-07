var source = new EventSource('complete.php');
//source.onerror=function(e){alert(e.data)};

source.addEventListener("complete", waitplayer, false);

function waitplayer(e){
  var pingev = document.getElementById("info");
  pingev.innerHTML = e.data;
}
