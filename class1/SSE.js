var source = new EventSource('echoServer.php');

source.addEventListener("tl", function(e) {
  var pingev = document.getElementById("tl");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("tm", function(e) {
  var pingev = document.getElementById("tm");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("tr", function(e) {
  var pingev = document.getElementById("tr");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("ml", function(e) {
  var pingev = document.getElementById("ml");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("mm", function(e) {
  var pingev = document.getElementById("mm");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("mr", function(e) {
  var pingev = document.getElementById("mr");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("bl", function(e) {
  var pingev = document.getElementById("bl");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("bm", function(e) {
  var pingev = document.getElementById("bm");
  pingev.innerHTML = e.data;
}, false);

source.addEventListener("br", function(e) {
  var pingev = document.getElementById("br");
  pingev.innerHTML = e.data;
}, false);
