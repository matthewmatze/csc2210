<?php
   require("../../include/utility.php");
   $dbconn = connectToDB();

   if(isset($_POST["LoginEmail"]) && isset($_POST["LoginPassword"])) {
      $email = cleanInput($_POST['LoginEmail']);
      $passwd = cleanInput($_POST['LoginPassword']);
      logMsg($email);
      logMsg($passwd);

      $query = "SELECT * FROM students WHERE email='$email';";
      logMsg($query);   
      $result = $dbconn->query($query);
      if(!$result) 
      {
      	logMsgAndDie('Select command failed:');
      }

      if($myrow = $result->fetch_array()) {
          logMsg($myrow);
          if($email == $myrow["email"]){
              if($passwd == $myrow["passwd"]){
                  $fname = $myrow["first"];
                  $lname = $myrow["last"];
                  $message = array("type"=>"good", "fname"=>$fname, "lname"=>$lname);
                  logMsg($fname);
                  logMsg($lname);
                  $encode = json_encode($message);
                  logMsg($encode);
                  echo $encode;
              }

              else {
                  $message = array("type"=>"badpass");
                  logMsg("Incorrect Password");
                  $encode = json_encode($message);
                  logMsg($encode);
                  echo $encode;
              }
          }

          else {
            $message = array("type"=>"bademail");
            logMsg("No Email Found");
            $encode = json_encode($message);
            logMsg($encode);
            echo $encode;

        }

      }
      else {
        echo "No Data Available!";
      }
  }
disconnectDB($dbconn);
?>