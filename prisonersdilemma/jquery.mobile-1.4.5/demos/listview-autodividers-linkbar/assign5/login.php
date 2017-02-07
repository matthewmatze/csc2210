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
         <h1>Login Form</h1>
      </div>
      <div data-role="content">

         <form action="#" method="post" data-ajax="false" name="login" id="login" 
	  onSubmit="return checkLogin(this);">
	  
         <div data-role="fieldcontain">
      	      <label for="LoginEmail"><b>Email Login:</b></label>
     		   <input type="text" id="LoginEmail" name="LoginEmail" value=""/> 
    	  </div>
               
    	  <div data-role="fieldcontain">
      	      <label for="LoginPassword"><b>Password:</b></label>
     		   <input type="password" id="LoginPassword" name="LoginPassword" value=""/> 
          </div>

    	   <div data-role="fieldcontain">
     		   <input type="submit" id="LoginSubmit" name="LoginSubmit" value="Send"/> 
          </div>
	      
      </form>


      <div id="name"></div>
      
      <div data-role="fieldcontain" id="create_account">
            <p>No Account? Create one <a href="register.php">Here!</a></p>
      </div>
      
      </div>
      <div data-role="footer">
      </div>
  </div>
</body>
</html>
