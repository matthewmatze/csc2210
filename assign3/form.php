<?php
	require("../include/utility.php");
	$dbconn = connectToDB();
  	logMsg($_POST["first_name"]);
	logMsg($_POST["last_name"]);
	logMsg($_POST["age"]);
	logMsg($_POST["email"]);
	logMsg($_POST["year"]);
	logMsg($_POST["gender"]);
	logMsg($_POST["password"]);
      $email = cleanInput($_POST['email']);
      $query = "SELECT * FROM students WHERE email='$email';";
      logMsg($query);
      $result = $dbconn->query($query);
		logMsg($result);
      if($result =="") 
      {
			$first = cleanInput($_POST["first_name"]);
			$last = cleanInput($_POST["last_name"]);
			$age = cleanInput($_POST["age"]);
			$email = cleanInput($_POST["email"]);
			$year = cleanInput($_POST["year"]);
			$gender = cleanInput($_POST["gender"]);
			$password = cleaninput($_POST["password"]);

         $insert_query = "insert into students2 (first, last, age, email, year, gender, password) values ('$first','$last','$age','$email','$year','$gender','$password');";
         logMsg($insert_query);
         $entered = $dbconn->query($insert_query);

         if(!$entered){
            logMsgAndDie('Insert Command Didnt Work');
         }
         else {
            logMsg('Insert was Successful');
            $message = array("type"=>"good", "first"=>$first, "last"=>$last);
            $encode = json_encode($message);
            logMsg($encode);
            echo $encode;
         }
      }
      else
      {
         $message = array("type"=>"used_email");
         logMsg("Email is already in use");
         $encode = json_encode($message);
         logMsg($encode);
         echo $encode;
      }
disconnectDB($dbconn);
?>
