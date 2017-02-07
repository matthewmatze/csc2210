<!DOCTYPE html>
<html>
<head>
   <!-- Name: David J. Bozentka Jr. (DJ)
      Date: 1-29-2015
      Class: CSC-2210
      Location: 
               utility.php: public_html->csc2210->include->utility.php
               echo.php: public_html->csc2210->assignments->Assignment3->echo.php
               index.php: public_html->csc2210->assignments->Assignment3->index.php

            URL Entry: http://linus.highpoint.edu/~dbozentka/csc2210/assignments/Assignment3/index.php
   -->

  <title>First Mobile Example</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="/~mmatze/csc2210/include/jquery/jquery.mobile-1.4.5.min.css" />
   <script type="text/javascript" src="/~mmatze/csc2210/include/jquery/jquery-1.11.2.js"></script>
   <script type="text/javascript" src="/~mmatze/csc2210/include/jquery/jquery.mobile-1.4.5.min.js"></script>
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
            printf("First: %s <br />\n",$first); 
            printf("Last: %s <br />\n",$last); 
            printf("Age: %s <br />\n",$age);

            logMsg('Storing data'.$last);
            $dbconn = connectToDB();
            $query = "insert into students (first,last,age) values ('$first','$last','$age');"; 
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
