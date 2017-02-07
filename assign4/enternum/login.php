<?php
	require("../include/utility.php");
	$dbconn = connectToDB();

	if(isset($_POST["loginEmail"])&&isset($_POST["loginPassword"]))
	{
		$email = cleanInput($_POST["loginEmail"]);
		printf("Email: %s <br />\n",$email);
		$password = cleaninput($_POST["loginPassword"]);
		printf("Password: %s <br />\n",$password);
		logMsg($email);
		logMsg($password);
		//$dbconn = connectToDB();
				
		$query = "SELECT * FROM students2 WHERE email='$email';";
		logMsg($query);
		$result = $dbconn->query($query);
		logMsg($result);
		if(!$result) 
		{
			logMsgAndDie('Select command failed:');
		}
		if($myrow = $result->fetch_array()) 
		{
        	logMsg($myrow);
         if($email == $myrow["email"])
			{
           	if($password == $myrow["password"])
				{
            	$fname = $myrow["first"];
               $lname = $myrow["last"];
               $message = array("type"=>"good", "fname"=>$fname, "lname"=>$lname);
               logMsg($fname);
               logMsg($lname);
               $encode = json_encode($message);
               logMsg($encode);
               echo $encode;
				}
           	else 
				{
               $message = array("type"=>"badpass");
               logMsg("Incorrect Password");
               $encode = json_encode($message);
               logMsg($encode);
               echo $encode;
           	}
        	}
        	else 
			{
           	$message = array("type"=>"bademail");
	         logMsg("No Email Found");
            $encode = json_encode($message);
     	      logMsg($encode);
        	   echo $encode;
			}
		}
		else
		{
			echo "No Data Available";
		}
	}
	disconnectDB($dbconn);
?>
