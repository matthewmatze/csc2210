var source = new EventSource('SSEServer.php');

var plr;
var gid;
var turn;
var winner;

source.addEventListener("player", function(e) {
  var pingev = document.getElementById("tl");
  pingev.innerHTML = e.data;
  plr =e.data;
}, false);

source.addEventListener("gameid", function(e) {
  var pingev = document.getElementById("tl2");
  pingev.innerHTML = e.data;
  gid = e.data;
}, false);

source.addEventListener("turn", function(e) {
  var pingev = document.getElementById("turn");
  pingev.innerHTML = e.data;
  turn = e.data;
}, false);

source.addEventListener("winner", function(e) {
  var pingev = document.getElementById("winner");
  if(e.data==3)
	{
		pingev.innerHTML = "Tie";
	} else {
		pingev.innerHTML = e.data;
	}
  winner = e.data;
}, false);

source.addEventListener("c1", function(e) {
  var pingev = document.getElementById("1");
	if(turn==1)
   	$("#1").html("X");
	if(turn==2)
   	$("#1").html("0");
}, false);

source.addEventListener("c2", function(e) {
  var pingev = document.getElementById("2");
	if(turn==1)
   	$("#2").html("X");
	if(turn==2)
   	$("#2").html("0");
}, false);

source.addEventListener("c3", function(e) {
  var pingev = document.getElementById("3");
	if(turn==1)
   	$("#3").html("X");
	if(turn==2)
   	$("#3").html("0");
}, false);

source.addEventListener("c4", function(e) {
  var pingev = document.getElementById("4");
	if(turn==1)
   	$("#4").html("X");
	if(turn==2)
   	$("#4").html("0");
}, false);

source.addEventListener("c5", function(e) {
  var pingev = document.getElementById("5");
	if(turn==1)
   	$("#5").html("X");
	if(turn==2)
   	$("#5").html("0");
}, false);

source.addEventListener("c6", function(e) {
  var pingev = document.getElementById("6");
	if(turn==1)
   	$("#6").html("X");
	if(turn==2)
   	$("#6").html("0");
}, false);

source.addEventListener("c7", function(e) {
  var pingev = document.getElementById("7");
	if(turn==1)
   	$("#7").html("X");
	if(turn==2)
   	$("#7").html("0");
}, false);

source.addEventListener("c8", function(e) {
  var pingev = document.getElementById("8");
	if(turn==1)
   	$("#8").html("X");
	if(turn==2)
   	$("#8").html("0");
}, false);

source.addEventListener("c9", function(e) {
  var pingev = document.getElementById("9");
	if(turn==1)
   	$("#9").html("X");
	if(turn==2)
   	$("#9").html("0");
}, false);

function clickIt(buttonId)
{
   $.post('button.php',{"buttonid": buttonId, "gameid": gid, "player": plr, "turn": turn}, function(e){
   });
}

