<?php
	error_log($_POST["password"]);
	require("../include/utility.php");
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
	$password = cleaninput($_POST["password"]);
	$nplayers = cleaninput($_POST["nplayers"]);
	$nrounds = cleaninput($_POST["nrounds"]);
	$_SESSION['password']=$password;

	logMsg($_POST["password"]);
   $query = "SELECT * FROM InstructorDilemma WHERE GamePass='$password';";
      logMsg($query);
      $result = $dbconn->query($query);
      if($result !="") 
      {
			if($nplayers<50&&$nplayers>0)
			{
	         $insert_query = "insert into InstructorDilemma (GamePass,NumPlrs,NumRnds) values ('$password',$nplayers,$nrounds);";
      		logMsg($insert_query);
      		$result = $dbconn->query($query);
         	$entered = $dbconn->query($insert_query);
         	if(!$entered){
           		logMsgAndDie('Insert Command Didnt Work');
         	} else {
            	logMsg('Insert was Successful');
	            echo "good";
   	      }
				for($i=0;$i < $nplayers;$i++)
				{
		         $insert_query = "insert into PrisonersDilemma (Passcode) values ('$password');";
   	   		logMsg($insert_query);
      			$result = $dbconn->query($query);
         		$entered = $dbconn->query($insert_query);
         		if(!$entered){
	           		logMsgAndDie('Insert Command Didnt Work');
   	      	} else {
      	      	logMsg('Insert was Successful');
   	      	}
				}
	      } else {
   	   	logMsg("Number of users not valid");
      	   echo "nplayers";
	   	}
		} else {
      	logMsg("Passcode is already in use");
         echo "used_pass";
	   }
disconnectDB($dbconn);
?>
