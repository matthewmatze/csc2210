var source = new EventSource('SSEServer.php');

source.onerror = function(e) {
     alert("EventSource failed.");
};


source.addEventListener("cnt", function(e) {
  var pingev = document.getElementById("cnt");
  pingev.innerHTML = e.data;
}, false);

