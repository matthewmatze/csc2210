<!DOCTYPE html>
<html>
<head>
   <!-- Name: David J. Bozentka Jr. (DJ)
      Date: 2-10-2015
      Class: CSC-2210
      Location: 
               utility.php: ../../include/utility.php
               echo.php: echo.php
               index.php: index.php
               validate.js: validate.js

            URL Entry: http://linus.highpoint.edu/~dbozentka/csc2210/assignments/assign4
-->

  <title>First Mobile Example</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="../../include/jquery/jquery.mobile-1.4.5.min.css" />
   <script type="text/javascript" src="../../include/jquery/jquery-1.11.2.js"></script>
   <script type="text/javascript" src="../../include/jquery/jquery.mobile-1.4.5.min.js"></script>
   <script type="text/javascript" src="validate.js"></script>
</head>
<body>
   <div data-role="page" id="formEcho">
      <div data-role="header">
         <h1>Echo - Form Demo</h1>
      </div>
      <div data-role="content">
      <?php
         require("../../include/utility.php"); 
         if($_SERVER["REQUEST_METHOD"] == "POST") {
            $first = cleanInput($_POST["fname"]); 
            $last = cleanInput($_POST["lname"]); 
            $age = cleanInput($_POST["age"]); 
            $email = cleanInput($_POST["email"]);
            $HPclass = cleanInput($_POST["HPclass"]);
            $gender = cleanInput($_POST['gender']);
            $passwd = cleanInput($_POST["passwd"]);
            printf("First: %s <br />\n",$first); 
            printf("Last: %s <br />\n",$last); 
            printf("Age: %s <br />\n",$age);
            printf("Email: %s <br />\n", $email);
            printf("Password: %s <br />\n",$passwd);
            printf("Class: %s <br />\n", $HPclass);
            printf("Gender: %s <br />\n", $gender);

            logMsg('Storing data'.$last);
            $dbconn = connectToDB();
            $query = "insert into students (first,last,age, email, HPclass, gender, passwd) values ('$first','$last','$age','$email','$HPclass','$gender','$passwd');"; 
            logMsg($query);
            $result = mysql_query($query,$dbconn);
            if(!$result) {
               logMsgAndDie('Select command failed:'); 
            } else {
               logMsg('insert successful'); 
            }
         }     
      ?>
      </div>
      <div data-role="footer">
         <span style="font-size: .7em">Copyleft Stump Productions&copy; 2015</span>
      </div>
   </div>
</body>
</html>
