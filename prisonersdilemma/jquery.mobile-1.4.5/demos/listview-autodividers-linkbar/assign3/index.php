<!DOCTYPE html>
<html>
<!-- Name: David J. Bozentka Jr. (DJ)
      Date: 1-29-2015
      Class: CSC-2210
      Location: 
               utility.php: public_html->csc2210->include->utility.php
               echo.php: public_html->csc2210->assignments->Assignment3->echo.php
               index.php: public_html->csc2210->assignments->Assignment3->index.php

            URL Entry: http://linus.highpoint.edu/~dbozentka/csc2210/assignments/Assignment3/index.php
-->

<head>
  <title>First Mobile Example</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="/~mmatze/csc2210/include/jquery/jquery.mobile-1.4.5.min.css" />
   <script type="text/javascript" src="/~mmatze/csc2210/include/jquery/jquery-1.11.2.js"></script>
   <script type="text/javascript" src="/~mmatze/csc2210/include/jquery/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>
   <div data-role="page" id="formEntry">
      <div data-role="header">
         <a href="#dataPage" data-ajax="false"> Dump </a>
         <h1>Header</h1>
         <a href="echo.php" data-ajax="false"> Submit</a>
      </div>
      <div data-role="content">
         <form action="echo.php" method="post">
            <div data-role="fieldcontain">
               <label for="fname">First:</label>
               <input type="text" name="fname" id="fname" value="" />
            </div>
            <div data-role="fieldcontain">
               <label for="lname">Last:</label>
               <input type="text" name="lname" id="lname" value="" />
            </div>
            <div data-role="fieldcontain">
               <label for="age">Age:</label>
               <input type="text" name="age" id="age" value="" />
            </div>
            <div data-role="fieldcontain">
               <input type="submit" name="submit" value="Send" />
            </div>
         </form>
      </div>
      <div data-role="footer">
         <span style="font-size: .7em">Click here to see full database: </span>
      </div>
   </div>
   <div data-role="page" id="dataPage">
      <div data-role="header">
         <h1>It's a header</h1>   
      </div>
      <div data-role="content">
      <?php
         require("../../include/utility.php");

         if ($_SERVER['REQUEST_METHOD'] == 'GET') 
         {
            logMsg('simpleConnect embedded PHP page'); 
            $dbconn = connectToDB();
            $query = "select * from students;"; 
            logMsg($query);
            $result = mysql_query($query,$dbconn); 
            if(!$result) {
               logMsgAndDie('Select command failed:');
            }
            if ($myrow = mysql_fetch_array($result)) 
            {
               do {
                  $id = $myrow["id"];
                  $first = $myrow["first"];
                  $last = $myrow["last"];
                  $age = $myrow["age"];
                  printf("<li>%07d %s %s %3d</li>\n",$id,$first,$last,$age);
               } while ($myrow = mysql_fetch_array($result)); 
            } else {
               echo "Sorry, no records were found!"; 
            }
         } else {
            echo "a non GET/POST request; see system admin";
         } 
      ?>
      </div>
   </div>
</body>
</html>
