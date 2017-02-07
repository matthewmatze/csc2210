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
	$add_instance = "INSERT INTO instances (name,status) VALUES ('SSEchoice.php','running');";
	$add_result = $dbconn->query($add_instance);
	$instance_id = $dbconn->insert_id;
	error_log("SSEchoice.php instance id: " . $instance_id);
	$password=$_SESSION['password'];
	$name=$_SESSION['name'];
	$waitround=1;
	session_write_close();
	sleep(1);
	$State=1;
	while(checkDeath($dbconn, $instance_id)){
		if($State!=2){
			$query = "UPDATE PrisonersDilemma SET State = 2 WHERE Passcode='$password' AND PlayerName='$name';";//If you are in the round page change the database to match
   		$result = $dbconn->query($query);
			$State=2;
		}
		//logMsg($query);
      ob_flush();
      flush();
      sleep(1);
	}
disconnectDB($dbconn);
?>
