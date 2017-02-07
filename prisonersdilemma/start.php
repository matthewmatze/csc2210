<?php
	require("../include/utility.php");
	header("Content-Type: text/event-stream\n\n");
	header("Cache-Control: no-cache\n\n");
	date_default_timezone_set("America/New_York");
	$dbconn = connectToDB();
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
	$add_instance = "INSERT INTO instances (name,status) VALUES ('start.php','running');";
	$add_result = $dbconn->query($add_instance);
	$instance_id = $dbconn->insert_id;
	error_log("start.php instance id: " . $instance_id);
	$password=$_SESSION['password'];
	$number1=-1;
	$number2=-1;
	session_write_close();

	while(checkDeath($dbconn, $instance_id)){
		$query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND PlayerName!='';";
	   //logMsg($query);
   	$result = $dbconn->query($query);
		if($number1 != mysqli_num_rows($result)){
		   $number1 = mysqli_num_rows($result);
	   	logMsg($number1);
			echo "event: player\n";
			echo 'data: ' .$number1. '';
			echo "\n\n";
		}
		$query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password';";
	   //logMsg($query);
   	$result = $dbconn->query($query);
		if($number2 != mysqli_num_rows($result)){
			$number2 = mysqli_num_rows($result);
	   	logMsg($number2);
			echo "event: nplayers\n";
			echo 'data: ' .$number2. '';
			echo "\n\n";
		}
		if($number1==$number2){
			$query = "UPDATE * FROM PrisonersDilemma SET State=2 WHERE Passcode='$password';";
	   	//logMsg($query);
			$state=2;
   		$result = $dbconn->query($query);
			echo "event: stats\n";
			echo 'data: ' .$state. '';
			echo "\n\n";
		}
	   ob_flush();
   	flush();
	   sleep(1);
	}
disconnectDB($dbconn);
?>
