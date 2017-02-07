function clickIt(buttonId)
{
	$.post('button.php',{buttonid: buttonId, gameid: e.data, player: e.data}, function(e){
	$('#'+buttonId).html("X");
	});
}
