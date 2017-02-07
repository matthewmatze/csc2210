/*
      Name: David J. Bozentka Jr. (DJ)
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
*/
function checkForm(form)
{
 
   //Check first name value(if empty->Alert->focus)
   if(form.fname.value=="") {
      alert("Enter first name!");
      form.fname.focus();
      return false;
   }

   //Check last name value(if empty->alert->focus)
   if(form.lname.value=="") {
      alert("Enter last name!");
      form.lname.focus();
      return false;
   }
    

   var regemail = new RegExp(/^[^@]+@[A-Za-z]+(\.[A-Za-z]*)+$/);
   if(!regemail.test(form.email.value)) {
      alert("Please Correct Your Email Address");
      form.email.value="";
      form.email.focus();
   }


   var regpasswd = new RegExp(/^(?=.*\d)(?=.*[A-Z])(?=.*[^\w\s]).{6,}$/);
   if(!regpasswd.test(form.passwd.value)) {
      alert("Please Enter A Password With: 1 Digit, 1 Uppercase, 6 Characters Total, 1 Special Character");
      form.passwd.value="";
      form.passwd.focus();
   }
   
   $.post(
      'validateregister.php',
      {"first_name":form.fname.value, "last_name":form.lname.value, "email":form.email.value, "password":form.passwd.value},
      function(resData){
         jsonResData = $.parseJSON(resData);

         //Putting the data sent back encoded as JSON to the log
         console.log(jsonResData);
         console.log(jsonResData.type);

         if(jsonResData.type=="good"){
            $('#name').html(jsonResData.first+" "+jsonResData.last);
            $('#register').hide();
            $('#btn_login').hide();
            
         }
         if(jsonResData.type=="used_email"){
            $('#email').html("Already already used in database");
            form.email.value="";
            form.email.focus();
         }
      });


  return false;
}

function checkLogin(form) {

   var regemail = new RegExp(/^[^@]+@[A-Za-z]+(\.[A-Za-z]*)+$/);
   if(!regemail.test(form.LoginEmail.value)) {
      alert("Please Correct Your Email Address");
      form.LoginEmail.value="";
      form.LoginEmail.focus();
   }


   var regpasswd = new RegExp(/^(?=.*\d)(?=.*[A-Z])(?=.*[^\w\s]).{6,}$/);
   if(!regpasswd.test(form.LoginPassword.value)) {
      alert("Please enter your password");
      form.LoginPassword.value="";
      form.LoginPassword.focus();
   }

    $.post(
       'validatelogin.php',
       {"LoginEmail":form.LoginEmail.value, "LoginPassword":form.LoginPassword.value},
       function(resData) {

         //Converts resData to Json type data
         jsonResData = $.parseJSON(resData); 

         //Logging values in log to see if they are O'Kay!
         console.log(jsonResData);
         console.log(jsonResData.type);

         if(jsonResData.type=="good"){         
            $('#name').html(jsonResData.fname+" "+jsonResData.lname);
            $("#login").hide(); 
            $('#create_account').hide();
         }
         
         if(jsonResData.type=="badpass"){
            $('#LoginPassword').html("Password was incorrect");
            form.LoginPassword.value="";
            form.LoginPassword.focus();

         }

         if(jsonResData.type=="bademail"){
            $('#LoginEmail').html("Email Not Found In Database");
            form.LoginEmail.value="";
            form.LoginPassword.focus();
         }
            

    });

   return false;
}