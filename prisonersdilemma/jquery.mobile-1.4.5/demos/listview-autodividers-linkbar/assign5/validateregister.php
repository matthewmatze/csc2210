<?php
   require("../../include/utility.php");
   $dbconn = connectToDB();

   if(isset($_POST["first_name"]) && isset($_POST["last_name"])
      && isset($_POST["email"]) && isset($_POST["password"])) 
   {
      $email = cleanInput($_POST['email']);
      $query = "SELECT * FROM students WHERE email='$email';";
      logMsg($query);   
      $result = $dbconn->query($query);
      if($result->num_rows == 0) 
      {
         $first = cleanInput($_POST['first_name']);
         $last = cleanInput($_POST['last_name']);
         $passwd = cleanInput($_POST['password']);

         $insert_query = "insert into students (first,last, email, passwd) values ('$first','$last', '$email','$passwd');";
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
      
         disconnectDB($dbconn);
      }
      
      else
      {
         $message = array("type"=>"used_email");
         logMsg("Email is already in use");
         $encode = json_encode($message);
         logMsg($encode);
         echo $encode;
      }

   }
   disconnectDB($dbconn);
?>