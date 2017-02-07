/*
      Name: David J. Bozentka Jr. (DJ)
      Date: 2-10-2015
      Class: CSC-2210
      Location: 
               utility.php: ../../include/utility.php
               echo.php: echo.php
               index.php: index.php
               validate.js: validate.js

            URL Entry: http://linus.highpoint.edu/~dbozentka/csc2210/assignments/assign4
*/
function isDigit(aChar)
{
   if(aChar >='0' && aChar <='9')
      return true;
   else
      return false;
}

function isAnInt(aNum)
{
   //check digits until you find a non digit and return false
   for(var i=0; i < aNum.length; i++){
      if(!isDigit(aNum.charAt(i)))
         return false;
   }
   //Made it here, must be an integer
   return true;
}

function checkForm(form)
{
 
   if(form.fname.value=="") {
      alert("Enter first name!");
      form.fname.focus();
      return false;
   }

   if(form.lname.value=="") {
      alert("Enter last name!");
      form.lname.focus();
      return false;
   }

   if(!isAnInt(form.age.value)) {
      alert("Age contains a non-digit character");
      form.age.value="";
      form.age.focus();
      return false;
   } 

   var regemail = new RegExp(/^[^@]+@[A-Za-z]+(\.[A-Za-z]*)+$/);
   if(!regemail.test(form.email.value)) {
      alert("Please Correct Your Email Address");
      form.email.focus();
      return false;
   }


   var regpasswd = new RegExp(/^(?=.*\d)(?=.*[A-Z])(?=.*[^\w\s]).{6,}$/);
   if(!regpasswd.test(form.passwd.value)) {
      alert("Please Enter A Password With: 1 Digit, 1 Uppercase, 6 Characters Total, 1 Special Character");
      form.email.focus();
      return false;
   }

   if(!form.HPclass.value){
      alert("Please choose your class");
      form.HPclass.focus();
      return false;
   }

   var genderEnter = false; 
   for(var i=0; i<form.gender.length; i++){
      if(form.gender[i].checked){
         genderEnter = true;
      }
   }

   if(!genderEnter) {
      alert("Choose your gender!");
      form.gender[0].focus();
      return false;
   }

  return true;
}
