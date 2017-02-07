<?php
	require("../include/utility.php");
   header("Content-Type: text/event-stream\n\n");
   header("Cache-Control: no-cache\n\n");
   date_default_timezone_set("America/New_York");
	LogMsg("PHP Start");
	session_start();
	logMsg("Session:".session_id()." Begins");
	if(isset($_SESSION['session_start']))//Old Session
	{	
	LogMsg("Old Session");
	} else {		//New Session
	LogMsg(" NewSession");
	$_SESSION['session_start']=TRUE;
	}
	$dbconn = connectToDB();
	$GLOBALS['dbconn']=$dbconn;//Set Global dbconn for function
	$add_instance = "INSERT INTO instances (name,status) VALUES ('choice.php','running');";
	$add_result = $dbconn->query($add_instance);
	$instance_id = $dbconn->insert_id;
	error_log("choice.php instance id: " . $instance_id);
	$password=$_SESSION['password'];//Set local pass and name from session
	$name=$_SESSION['name'];
	$GLOBAL['name']=$name;
	$GLOBAL['password']=$password;//Set Name and password to global
	$waitround=1;
   $choice=$_POST['choice'];//Set User's choice locally and globally
	$GLOBAL['choice']=$choice;
	if($choice==1){	//If they chose to defect
	   $query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND PlayerName='$name';";
      //logMsg($query);
      $result = $dbconn->query($query);
      $row2 = $result->fetch_array();//Get the user's info
		$curround=$row2['Cooperate']+$row2['Defect'];//find the current number of rounds
	   $query = "SELECT * FROM InstructorDilemma WHERE GamePass='$password';";//query all of the players in the game's data
      //logMsg($query);
      $result = $dbconn->query($query);
      $row1 = $result->fetch_array();//Get instructor's info
		if($row1['NumRnds']-1>$curround){//check if the user is in the final round had issue with last round so i did minus one as a temporary fix to make sure it worked
			$query = "UPDATE PrisonersDilemma SET State = 1, Defect = Defect + 1 WHERE Passcode='$password' AND PlayerName='$name';";//Change the State to 1 and add one to defect
			//logMsg($query);
   		$result = $dbconn->query($query);
		   $query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND wait != 0 AND State=1;";//query all the games waiting for players
      	//logMsg($query);
   	   $result = $dbconn->query($query);
			$number = mysqli_num_rows($result);//see how many games are waiting
	      $row = $result->fetch_array();
			$GLOBALS['Wait']=$row['Wait'];
			$GLOBALS['player1'] = $row['PlayerName'];//set global wait and player name
			if($number==0) {
		   $query = "UPDATE PrisonersDilemma SET Wait = 1  WHERE Passcode='$password' AND PlayerName='$name';";//Set to wait for another player
			//logMsg($query);
   		$result = $dbconn->query($query);
			} else {
				scoredecision();//decide how it is scored
			}
			echo 1;
		} else {
			$query = "UPDATE PrisonersDilemma SET Defect = Defect + 1, State = 3 WHERE Passcode='$password' AND PlayerName='$name';";//Change the State to 1 and add one to defect
			//logMsg($query);
   		$result = $dbconn->query($query);
		   $query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND wait != 0 AND State=1;";//query all games waiting for players
      	//logMsg($query);
   	   $result = $dbconn->query($query);
			$number = mysqli_num_rows($result);//see how many games are waiting
	      $row = $result->fetch_array();
			$GLOBALS['Wait']=$row['Wait'];
			$GLOBALS['player1'] = $row['PlayerName'];//set global wait and player name
			if($number==0) {
				$query = "UPDATE PrisonersDilemma SET Wait = 1 WHERE Passcode='$password' AND PlayerName='$name';";//Set to wait for another player
				//logMsg($query);
   			$result = $dbconn->query($query);
			} else {
				scoredecision();//Decide how it is scored
			}
			echo 3;
		}
	}
	if($choice==2){	//if the choice is Cooaperate
	   $query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND PlayerName='$name';";//Select The user's information
      //logMsg($query);
      $result = $dbconn->query($query);
      $row2 = $result->fetch_array();
		$curround=$row2['Cooperate']+$row2['Defect'];//find the number of rounds played
	   $query = "SELECT * FROM InstructorDilemma WHERE GamePass='$password';";//query all the players info in the game
      //logMsg($query);
      $result = $dbconn->query($query);
      $row1 = $result->fetch_array();
		if($row1['NumRnds']-1>$curround){//if the current is the last round
			$query = "UPDATE PrisonersDilemma SET State = 2, Cooperate = Cooperate + 1 WHERE Passcode='$password' AND PlayerName='$name';";//Upload the current round choice
			//logMsg($query);
   		$result = $dbconn->query($query);
		   $query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND wait != 0 AND State=1;";//query all games waiting for players
      	//logMsg($query);
   	   $result = $dbconn->query($query);
			$number = mysqli_num_rows($result);//look and the amount of games waiting for players
	      $row = $result->fetch_array();
			$GLOBALS['Wait']=$row['Wait'];
			$GLOBALS['player1'] = $row['PlayerName'];//Set the other players decision and name to globals for the score decision function
			if($number==0) {
		   $query = "UPDATE PrisonersDilemma SET Wait = 2  WHERE Passcode='$password' AND PlayerName='$name';";//if no games waiting then wait
			//logMsg($query);
   		$result = $dbconn->query($query);
			} else {
			scoredecision();//if game waiting then update scores
			}
		} else {
			$query = "UPDATE PrisonersDilemma SET Cooperate = Cooperate + 1, State = 3 WHERE Passcode='$password' AND PlayerName='$name';";//set cooaperate 
			//logMsg($query);
   		$result = $dbconn->query($query);
		   $query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND wait != 0 AND State=1;";//check games where people are waiting
      	//logMsg($query);
   	   $result = $dbconn->query($query);
			$number = mysqli_num_rows($result);//check the number of games waiting
	      $row = $result->fetch_array();
			$GLOBALS['Wait']=$row['Wait'];
			$GLOBALS['player1'] = $row['PlayerName'];//Set global variables for the other player's choice and name
			if($number==0) {
			   $query = "UPDATE PrisonersDilemma SET Wait = 2 WHERE Passcode='$password' AND PlayerName='$name';";//if no games waiting then wait
				logMsg($query);
   			$result = $dbconn->query($query);
			} else {
			scoredecision();//if someone is waiting then set the scores
			}
			echo 3;
		}
	}
	function scoredecision(){
			//lock table
			$dbconn=$GLOBALS['dbconn'];
		   $query = "LOCK TABLE PrisonersDilemma;";//lock the tables to prevent raceconditions
			//logMsg($query);
   		$result = $dbconn->query($query);
			$player1 = $GLOBALS['player1'];
			$name = $GLOBALS['name'];
			$password = $GLOBALS['password'];//set globals to locals
		   $query = "UPDATE PrisonersDilemma SET Wait = 3 WHERE Passcode='$password' AND PlayerName='$player1';";//update the waiting screen
			//logMsg($query);
   		$result = $dbconn->query($query);
			if($GLOBALS['Wait']==1&&$GLOBALS['choice']==1){//if they both defect
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 5 WHERE Passcode='$password' AND PlayerName='$name';";//assign both players a score of 5 
				//logMsg($query);
   			$result = $dbconn->query($query);
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 5 WHERE Passcode='$password' AND PlayerName='$player1';";
				//logMsg($query);
   			$result = $dbconn->query($query);
			}
			if($GLOBALS['Wait']==2&&$GLOBALS['choice']==1){//if player one defects and player two cooaperates
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 0 WHERE Passcode='$password' AND PlayerName='$name';";//player1 gets 0 points
				//logMsg($query);
   			$result = $dbconn->query($query);
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 10 WHERE Passcode='$password' AND PlayerName='$player1';";//player 2 gets 10 points
				//logMsg($query);
   			$result = $dbconn->query($query);
				}
			if($GLOBALS['Wait']==1&&$GLOBALS['choice']==2){//if player two defects and player one cooaperates
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 10 WHERE Passcode='$password' AND PlayerName='$name';";//player1 gets 10 points
				//logMsg($query);
   			$result = $dbconn->query($query);
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 0 WHERE Passcode='$password' AND PlayerName='$player1';";//player2 gets 0 points
				//logMsg($query);
   			$result = $dbconn->query($query);
			}
			if($GLOBALS['Wait']==2&&$GLOBALS['choice']==2){//if they both cooaperate
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 2 WHERE Passcode='$password' AND PlayerName='$name';";//They both get 2 points
				//logMsg($query);
   			$result = $dbconn->query($query);
		   	$query = "UPDATE PrisonersDilemma SET Score = Score + 2 WHERE Passcode='$password' AND PlayerName='$player1';";
				//logMsg($query);
   			$result = $dbconn->query($query);
			}
		   	$query = "UNLOCK TABLE PrisonersDilemma;";//unlock tables after finished
				//logMsg($query);
   			$result = $dbconn->query($query);
	}
	disconnectDB($dbconn);

?>
