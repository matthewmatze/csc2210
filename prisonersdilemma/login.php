<?php
	require("../include/utility.php");
	$dbconn = connectToDB();

	session_start();
   logMsg("Session:".session_id()." Begins");
   if(isset($_SESSION['session_start']))//Old Session
   {
   LogMsg("Old Session");
   } else {    //New Session
   LogMsg(" NewSession");
   $_SESSION['session_start']=TRUE;
   }
	if(isset($_POST["Name"])&&isset($_POST["Password"]))
	{
		$name = cleanInput($_POST["Name"]);
		//printf("Email: %s <br />\n",$email);
		$password = cleaninput($_POST["Password"]);
		$_SESSION['name']=$name;
		$_SESSION['password']=$password;
		//printf("Password: %s <br />\n",$password);
		logMsg($name);
		logMsg($password);
	
		$query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND PlayerName='' AND PlayerName!='$name';";
		logMsg($query);
		$result = $dbconn->query($query);
		$number = mysqli_num_rows($result);
		logMsg($number);
		if($number!=0)
		{
			$query = "SELECT * FROM PrisonersDilemma WHERE Passcode='$password' AND PlayerName='$name';";
			logMsg($query);
			$result = $dbconn->query($query);
			$number = mysqli_num_rows($result);
			logMsg($number);
			if($number==0){
				$query = "UPDATE PrisonersDilemma SET PlayerName='$name', State=1 WHERE Passcode='$password' AND PlayerName='' LIMIT 1;";
				logMsg($query);
				if(!$result = $dbconn->query($query))
				{
					logMsgAndDie('Update command failed:');
				}
      	   echo "Good";
			} else {
   	   	echo "badpass";
      	}
		} else {
   	  	echo "badpass";
      }
	}
	disconnectDB($dbconn);
?>
