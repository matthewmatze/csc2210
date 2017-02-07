var source = new EventSource('echoServer.php');

source.addEventListener("cnt", function(e) {
  var pingev = document.getElementById("cnt");
  pingev.innerHTML = e.data;
}, false);

