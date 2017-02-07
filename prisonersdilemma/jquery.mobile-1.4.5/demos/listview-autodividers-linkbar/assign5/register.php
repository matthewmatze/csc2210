<!DOCTYPE html>
<html>
<!-- Name: David J. Bozentka Jr. (DJ)
      Date: 3-1-2015
      Class: CSC-2210
      Location: 
               utility.php: ../../include/utility.php
               register.php: register.php
               validateregister.php: validateregister.php
               login.php: login.php
               validatelogin.php: validatelogin.php
               validate.js: validate.js

            URL Entry: http://linus.highpoint.edu/~dbozentka/csc2210/assignments/assign5
-->

<head>
  <title>Register Page</title>
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <link rel="stylesheet" href="../../include/jquery/jquery.mobile-1.4.5.min.css" />
   <script type="text/javascript" src="../../include/jquery/jquery-1.11.2.js"></script>
   <script type="text/javascript" src="../../include/jquery/jquery.mobile-1.4.5.min.js"></script>
   <script type="text/javascript" src="validate.js"></script>
</head>
<body>
   <div data-role="page" id="formEntry">
      <div data-role="header">
         <h1>Register Here</h1>
         <a href="login.php" data-ajax="false" id="btn_login"> Login </a>
      </div>
      <div data-role="content">
         <form action="#" data-ajax="false" method="post" id="register" name="register" 
	   onSubmit="return checkForm(this);">
           
           <div data-role="fieldcontain">
               <label for="fname">First:</label>
               <input type="text" name="fname" id="fname" value="" />
            </div>

            <div data-role="fieldcontain">
               <label for="lname">Last:</label>
               <input type="text" name="lname" id="lname" value="" />
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
               <input type="submit" name="submit" value="Send" />
            </div>
         
         </form>

         <div id="name"></div>
      </div>
      <div data-role="footer">
      </div>      
   </div>
</body>
</html>
