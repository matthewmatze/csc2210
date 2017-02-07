<?php
	require("../include/utility.php");
	$dbconn=connectToDB();
	$gameid=$_POST["gameid"];
	$sql="SELECT * FROM TicTacToe Where gameId=$gameid";
	logmsg($sql);
	$buttonid=$_POST["buttonid"];
	$player=$_POST["player"];
	$turn=$_POST["turn"];
	if(!($result=$dbconn->query($sql)))
		logMsgAndDie("Bad Query");
	if($myrow=$result->fetch_array()){
		if($myrow["p$buttonid"]==0)//If there isn't already an X or O
		{
			if($turn==$player)//If it is your turn
			{
				if(1==$player)//If it is player one's turn
				{
					$sql="UPDATE TicTacToe SET turn = 2, p$buttonid = $buttonid WHERE gameId=$gameid;";
					logmsg($sql);
					if(!($result=$dbconn->query($sql)))
						logMsgAndDie("Bad Query");
				}
				if(2==$player)//If it is player two's turn
				{
					$sql="UPDATE TicTacToe SET turn = 1, p$buttonid = $buttonid WHERE gameId=$gameid;";
					logmsg($sql);
					if(!($result=$dbconn->query($sql)))
						logMsgAndDie("Bad Query");
				}
			}
		}
	}
?>
