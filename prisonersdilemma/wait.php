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
	$add_instance = "INSERT INTO instances (name,status) VALUES ('SSEServer.php','running');";
	$add_result = $dbconn->query($add_instance);
	$instance_id = $dbconn->insert_id;
	error_log("wait.php instance id: " . $instance_id);
	$password=$_SESSION['password'];
	$name=$_SESSION['name'];
	$waitround=1;
	$query = "UPDATE PrisonersDilemma SET State = 1 WHERE Passcode='$password' AND PlayerName='$name';";//Set state so that it matches that you are in wait round
   $result = $dbconn->query($query);
	session_write_close();

	while(checkDeath($dbconn, $instance_id)){
		$query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND State = 1;";//select everyone in the wait round
	   //logMsg($query);
   	$result = $dbconn->query($query);
	   $number = mysqli_num_rows($result);
   	logMsg($number);
		$query = "SELECT * FROM InstructorDilemma WHERE GamePass='$password';";//select all players
	   //logMsg($query);
   	$result = $dbconn->query($query);
		$row = $result->fetch_array();
		//logMsg($row['NumPlrs']);
		if($number==$row['NumPlrs']){//is everyone in the waiting round
			$startnextround=1111;//does nothing	
			echo "event: waitplayer\n";
			echo 'data: ' .$startnextround. '';//if so echo out to go to next page
			echo "\n\n";
		}
	   ob_flush();
   	flush();
	   sleep(1);
		
	}
disconnectDB($dbconn);
?>
