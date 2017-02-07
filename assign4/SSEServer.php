<?php
require("../include/utility.php");
header("Content-Type: text/event-stream\n\n");
header("Cache-Control: no-cache\n\n");
date_default_timezone_set("America/New_York");
$dbconn = connectToDB();
//Sets up the instance table so that incase we have an unending logging loop we can stop it
$add_instance = "INSERT INTO instances (name,status) VALUES ('SSEServer.php','running');";
$add_result = $dbconn->query($add_instance);
$instance_id = $dbconn->insert_id;
error_log("SSEServer.php instance id: " . $instance_id);
//initialize Each cell and board variable in each array
$prevcnt=-1;
$cell[1]=0;
$cell[2]=0;
$cell[3]=0;
$cell[4]=0;
$cell[5]=0;
$cell[6]=0;
$cell[7]=0;
$cell[8]=0;
$cell[9]=0;
$board[1]=0;
$board[2]=0;
$board[3]=0;
$board[4]=0;
$board[5]=0;
$board[6]=0;
$board[7]=0;
$board[8]=0;
$board[9]=0;
logMsg("server");
	//lock the table to prevent race conditions
	$lock="lock tables TicTacToe write";
	$result = $dbconn->query($lock);
	if(!$result)
	{
		logMsgAndDie('Lock command failed:');
	}
	//Query the database for a row that has now player 2
	$query="SELECT * FROM TicTacToe WHERE player2=-1;";
	logMsg($query);
	$result = $dbconn->query($query);
	if($myrow = $result->fetch_array()) //if there is a row without player2 join game
	{
		logMsg($myrow["gameId"]);
		$gameid=$myrow["gameId"];//Save info locally
		$player2=$myrow["player2"];
		$query="UPDATE TicTacToe SET State = 2,player2 = 1 WHERE gameId=$gameid;";
		logMsg($query);
		if(!($result=$dbconn->query($query)))
			logMsgAndDie("Bad Query");	
		$state=2; //Save info locally
		$player=2;
		echo "event: player\n";
		echo 'data: ' .$player. '';
		echo "\n\n";
	} else{ //if there isn't a row with a player 2 make new game
		$query="INSERT INTO TicTacToe (player1,player2, state) VALUES ('1', '-1', '1')";	
		$result=$dbconn->query($query);
		$gameid=$dbconn->insert_id;
		$state=1;
		$player=1;
		echo "event: player\n";
		echo 'data: ' .$player. '';
		echo "\n\n";
	}
	//Unlock tables so other players can join
	$unlock="unlock tables";
	$result = $dbconn->query($unlock);
	echo "event: gameid\n";
	echo 'data: ' .$gameid. '';
	echo "\n\n";
	$turn=1;
//Purpose: Updates the local and server with the new current state and the winner if p1 wins
function checkboard1(){
	$game=$GLOBALS["gameid"];
	$query="UPDATE TicTacToe SET State = 3,Winner = 2 WHERE gameId=$game;";
	logMsg($query);
	if(!($result=$GLOBALS["dbconn"]->query($query)))
		logMsgAndDie("Bad Query");
	$GLOBALS["state"]=3;
	$GLOBALS["winner"]=2;
}
//Purpose: Updates the local and server with the new current state and the winner if p2 wins
function checkboard2(){
	$game=$GLOBALS["gameid"];
	$query="UPDATE TicTacToe SET State = 3,Winner = 1 WHERE gameId=$game;";
	logMsg($query);
	if(!($result=$GLOBALS["dbconn"]->query($query)))
		logMsgAndDie("Bad Query");
	$GLOBALS["state"]=3;
	$GLOBALS["winner"]=1;
}
	
while(checkDeath($dbconn, $instance_id))//checks death so it can stop infinite log if neccesary
{
	ob_flush();
	flush();
	sleep(1);
	if($state==1)//if you are player 1 then wait for a player 2
	{
		//query the row
		$query="SELECT * FROM TicTacToe WHERE gameId=$gameid;";
		if(!($result=$dbconn->query($query)))
			logMsgAndDie("Bad Query");	
		$myrow = $result->fetch_array();
		if($myrow["player2"]!=-1)//if player 2 join
		{
			$state=2;
		}
	}
	if($state==2)//Once there is a game with two players
	{
		//query the row
		$query="SELECT * FROM TicTacToe WHERE gameId=$gameid;";
		if(!($result=$dbconn->query($query)))
			logMsgAndDie("Bad Query");	
		$myrow = $result->fetch_array();
		//logMsg($myrow["p1"]);
		//logMsg($cell[1]);
		$turn=$myrow["turn"];
		echo"event: turn\n";
		echo'data: ' .$myrow["turn"]. '';
		echo "\n\n";
		logMsg($board[1]);
		logMsg($board[2]);
		logMsg($board[3]);
		//Check if cell has changed in the server if so then update local values
		if($myrow["p1"]!=$cell[1]){
			$cell[1]=$myrow["p1"];
			logMsg($cell[1]);
			echo"event: c1\n";
			echo'data: ' .$cell[1]. '';
			echo "\n\n";
			if($turn==1)
				$board[1]=1;
			if($turn==2)
				$board[1]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p2"]!=$cell[2])
		{
			$cell[2]=$myrow["p2"];
			echo"event: c2\n";
			echo'data: ' .$cell[2]. '';
			echo "\n\n";
			if($turn==1)
				$board[2]=1;
			if($turn==2)
				$board[2]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p3"]!=$cell[3])
		{
			$cell[3]=$myrow["p3"];
			echo"event: c3\n";
			echo'data: ' .$cell[3]. '';
			echo "\n\n";
			if($turn==1)
				$board[3]=1;
			if($turn==2)
				$board[3]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p4"]!=$cell[4])
		{
			$cell[4]=$myrow["p4"];
			echo"event: c4\n";
			echo'data: ' .$cell[4]. '';
			echo "\n\n";
			if($turn==1)
				$board[4]=1;
			if($turn==2)
				$board[4]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p5"]!=$cell[5])
		{
			$cell[5]=$myrow["p5"];
			echo"event: c5\n";
			echo'data: ' .$cell[5]. '';
			echo "\n\n";
			if($turn==1)
				$board[5]=1;
			if($turn==2)
				$board[5]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p6"]!=$cell[6])
		{
			$cell[6]=$myrow["p6"];
			echo"event: c6\n";
			echo'data: ' .$cell[6]. '';
			echo "\n\n";
			if($turn==1)
				$board[6]=1;
			if($turn==2)
				$board[6]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p7"]!=$cell[7])
		{
			$cell[7]=$myrow["p7"];
			echo"event: c7\n";
			echo'data: ' .$cell[7]. '';
			echo "\n\n";
			if($turn==1)
				$board[7]=1;
			if($turn==2)
				$board[7]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p8"]!=$cell[8])
		{
			$cell[8]=$myrow["p8"];
			echo"event: c8\n";
			echo'data: ' .$cell[8]. '';
			echo "\n\n";
			if($turn==1)
				$board[8]=1;
			if($turn==2)
				$board[8]=2;
		}
		//Check if cell has changed in the server if so then update local values
		if($myrow["p9"]!=$cell[9])
		{
			$cell[9]=$myrow["p9"];
			echo"event: c9\n";
			echo'data: ' .$cell[9]. '';
			echo "\n\n";
			if($turn==1)
				$board[9]=1;
			if($turn==2)
				$board[9]=2;
		}
		//Check if the top row is ones
		if($board[1]==1&&$board[2]==1&&$board[3]==1)
			checkboard1();

		//Check if the top row is twos
		if($board[1]==2&&$board[2]==2&&$board[3]==2)
			checkboard2();

		//Check if the left column is ones
		if($board[1]==1&&$board[4]==1&&$board[7]==1)
			checkboard1();

		//Check if the left column is twos
		if($board[1]==2&&$board[4]==2&&$board[7]==2)
			checkboard2();

		//Check if the middle column is ones
		if($board[2]==1&&$board[5]==1&&$board[8]==1)
			checkboard1();

		//Check if the middle column is twos
		if($board[2]==2&&$board[5]==2&&$board[8]==2)
			checkboard2();

		//Check if the right column is ones
		if($board[3]==1&&$board[6]==1&&$board[9]==1)
			checkboard1();

		//Check if the right column is twos
		if($board[3]==2&&$board[6]==2&&$board[9]==2)
			checkboard2();

		//Check if the middle row is ones
		if($board[4]==1&&$board[5]==1&&$board[6]==1)
			checkboard1();

		//Check if the middle row is twos
		if($board[4]==2&&$board[5]==2&&$board[6]==2)
			checkboard2();

		//Check if the bottom row is ones
		if($board[7]==1&&$board[8]==1&&$board[9]==1)
			checkboard1();

		//Check if the bottom row is twos
		if($board[7]==2&&$board[8]==2&&$board[9]==2)
			checkboard2();

		//Check if the left diagonal is ones
		if($board[1]==1&&$board[5]==1&&$board[9]==1)
			checkboard1();

		//Check if the left diagonal is twos
		if($board[1]==2&&$board[5]==2&&$board[9]==2)
			checkboard2();

		//Check if the right diagonal is ones
		if($board[3]==2&&$board[5]==2&&$board[7]==2)
			checkboard2();

		//Check if the right diagonal is twos
		if($board[3]==1&&$board[5]==1&&$board[7]==1)
			checkboard1();
		
		//Check if all cells are filled and there is no winner
		if($myrow["p1"]!=0&&$myrow["p2"]!=0&&$myrow["p3"]!=0&&$myrow["p4"]!=0&&$myrow["p5"]!=0&&$myrow["p6"]!=0&&$myrow["p7"]!=0&&$myrow["p8"]!=0&&$myrow["p9"]!=0&&$state!=3)
		{
			$query="UPDATE TicTacToe SET State = 3,Winner = 3 WHERE gameId=$gameid;";
			logMsg($query);
			if(!($result=$dbconn->query($query)))
				logMsgAndDie("Bad Query");
			$state=3;
		}
	}
	//show the winner and disallow people from entering moves
	if($state==3)
	{
		$query="SELECT * FROM TicTacToe WHERE gameId=$gameid;";
		if(!($result=$dbconn->query($query)))
			logMsgAndDie("Bad Query");	
		$myrow = $result->fetch_array();
		echo"event: winner\n";
		echo'data: ' .$myrow["Winner"]. '';
		echo "\n\n";
	}
}

?>
