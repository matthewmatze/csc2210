function checkForm(form)
{
	if(form.fname.value == "") 
	{
		alert("Enter first name!");
		form.fname.focus();
		return false;
	}
	if(form.lname.value == "") 
	{
		alert("Enter Last name!");
		form.lname.focus();
		return false;
	}
	if(form.age.value == "") 
	{
		alert("Enter Age!");
		form.age.focus();
		return false;
	}
	if(form.age.value !="")
	{
		var ageCheck=new RegExp(/^\d+$/);
		if(!ageCheck.test(form.age.value)) 
		{
			alert("Age has a problem ");
			form.age.value="";
			form.age.focus();
			return false;
		}
	}
	if(form.email.value == "")
	{
		alert("Enter Email!");
		form.email.focus();
		return false;
	}
	if(form.email.value != "")
	{
		var emailCheck=new RegExp(/^[^@]+@[^\.]+\..+$/);
		if(!emailCheck.test(form.email.value))
		{
			alert("Email has a Problem");
			form.email.value;
			form.email.focus();
			return false;
		}
	}
	if(form.year.value == "") 
	{
		alert("Enter Year!");
		form.year.focus();
		return false;
	}
	if(!form.gender[0].checked&&!form.gender[1].checked&&!form.gender[2].checked) 
	{
		alert("Enter Gender!");
		form.gender[0].focus();
		return false;
	}
	if(form.password.value == "") 
	{
		alert("Enter Password!");
		form.password.focus();
		return false;
	}
	if(form.password.value != "")
	{
		var passwordCheck=new RegExp(/^(?=(?:.*[A-Z]){1})(?=(?:.*\d){1})(?=(?:.*[!@#$%^&*-]){1}).{6,}$/);
		if(!passwordCheck.test(form.password.value))
		{
			alert("Password is invalid");
			form.password.value;
			form.password.focus();
			return false;
		}
	}

	$.post('form.php',{
		"first_name":form.fname.value, 
		"last_name":form.lname.value, 
		"age":form.age.value, 
		"email":form.email.value, 
		"year":form.year.value,
		"gender":form.gender.value, 
		"password":form.password.value
	}, function(resData){
	jsonResData = $.parseJSON(resData);
         //Putting the data sent back encoded as JSON to the log
         console.log(jsonResData);
         console.log(jsonResData.type);
         if(jsonResData.type=="good")
			{
         	alert("Good");
				$('#name').html(jsonResData.first+" "+jsonResData.last);
         	$('#loginEntry').hide();
         	$('#createAccount').hide();
         }
         if(jsonResData.type=="used_email")
			{
         	alert("bad");
         	$('#email').html("Already already used in database");
         	form.email.value="";
         	form.email.focus();
         }
	});
		return false;
}

function checkLogin(form)
{
	if(form.loginEmail.value == "")
	{
	   alert("Enter Email!");
   	form.loginEmail.focus();
	   return false;
	}

	if(form.loginEmail.value != "")
	{
   	var emailCheck=new RegExp(/^[^@]+@[^\.]+\..+$/);
	   if(!emailCheck.test(form.loginEmail.value))
		{
   	   alert("Email has a Problem");
      	form.loginEmail.value;
	      form.loginEmail.focus();
   	   return false;
	   }
	}

   var passwordCheck=new RegExp(/^(?=(?:.*[A-Z]){1})(?=(?:.*\d){1})(?=(?:.*[!@#$%^&*-]){1}).{6,}$/);
	if(!passwordCheck.test(form.loginPassword.value))
	{
      alert("Password is invalid");
	   form.loginPassword.value;
      form.loginPassword.focus();
     	return false;
	}

	$.post('login.php',{"loginEmail":form.loginEmail.value, "loginPassword":form.loginPassword.value},
      function(resData){
				alert(resData);

         var jsonResData = JSON.parse(resData);
         
			//Putting the data sent back encoded as JSON to the log
         //console.log(jsonResData);
         //console.log(jsonResData.type);
         
         if(jsonResData.type=="good"){
         	$('#name').html(jsonResData.fname+" "+jsonResData.lname);
         	$('#loginEntry').hide();
         	$('#createAccount').hide();
         }

			if(jsonResData.type=="badpass"){
				$('#loginPassword').html("Email Not Found In Database");
				form.loginEmail.value="";
				form.loginPassword.focus();
			}

         if(jsonResData.type=="used_email"){
         	$('#loginEmail').html("Already already used in database");
         	form.loginEmail.value="";
         	form.loginEmail.focus();
         }
		});
	return false;
}
