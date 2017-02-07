<!DOCTYPE html>
<html>
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

<head>
  <title>First Mobile Example</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="../../include/jquery/jquery.mobile-1.4.5.min.css" />
   <script type="text/javascript" src="../../include/jquery/jquery-1.11.2.js"></script>
   <script type="text/javascript" src="../../include/jquery/jquery.mobile-1.4.5.min.js"></script>
   <script type="text/javascript" src="validate.js"></script>
</head>
<body>
   <div data-role="page" id="formEntry">
      <div data-role="header">
         <a href="#dataPage" data-ajax="false"> Dump </a>
         <h1>Header</h1>
         <a href="echo.php" data-ajax="false"> Submit</a>
      </div>
      <div data-role="content">
         <form action="echo.php" method="post" name="personEntry" 
	   onSubmit="return checkForm(document.personEntry);">
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
               <label for="email">Email:</label>
               <input type="text" name="email" id="email" value"" />
            </div>
            <div data-role="fieldcontain">
               <label for="passwd">Password:</label>
               <input type="password" name="passwd" id="passwd" value="" />
            </div>
            <div data-role="fieldcontain">
               <label for="HPclass" class="select"> Choose Your Class </label>
               <select name="HPclass" id="HPclass">
                  <option> Please Select One</option>
                  <option value="Freshman">Freshman</option>
                  <option value="Sophmore">Sophmore</option>
                  <option value="Junior">Junior</option>
                  <option value="Senior">Senior</option>
               </select>
            </div>
           
         <div data-role="fieldcontain">
            <legend>Choose Your Class:</legend>
               <input type="radio" name="gender" id="male" value="Male" />
               <label for="male">Male</label>

               <input type="radio" name="gender" id="female" value="Female"  />
               <label for="female">Female</label>

               <input type="radio" name="gender" id="other" value="Other"  />
               <label for="other">Other</label>
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
                  $email = $myrow["email"];
                  $HPclass = $myrow["HPclass"];
                  $gender = $myrow["gender"];
                  $passwd = $myrow["passwd"];
                  printf("<li>%07d %s %s %3d %s %s %s %s</li>\n",$id,$first,$last,$age,$email,$HPclass,$gender,$passwd);
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
