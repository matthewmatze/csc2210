function checkCreate(form)
{
	if(form.password.value == "") 
	{
		alert("Enter Password!");
		form.password.focus();
		return false;
	}
	if(form.nplayers.value == "") 
	{
		alert("Enter Number of Players!");
		form.nplayers.focus();
		return false;
	}
	$.post('form.php',{
		"password":form.password.value,
		"nrounds":form.nrounds.value,
		"nplayers":form.nplayers.value
	}, function(ResData){
         if(ResData=="good")
			{
         	window.location.href='start.html';
         	//alert("Good Password");
				//$('#name').html(jsonResData.first+" "+jsonResData.last);
         	//$('#loginEntry').hide();
         	//$('#createAccount').hide();
         }
         if(ResData=="used_pass")
			{
         	alert("The Password Has been used. Try again.");
         }
			if(ResData=="nplayers")
			{
				alert("Please enter a valid number of users");
			}
			if(ResData=="nrounds")
			{
				alert("Please enter a valid number of users");
			}
	});
		return false;
}

function checkLogin(form)
{
	if(form.name.value == "")
	{
	   alert("Enter Name!");
   	form.name.focus();
	   return false;
	}
	if(form.password.value == "")
	{
	   alert("Enter Password!");
   	form.password.focus();
	   return false;
	}
	$.post('login.php',{
		"Name":form.name.value, 
		"Password":form.password.value
	}, function(ResData){
        
			//Putting the data sent back encoded as JSON to the log
         //console.log(jsonResData);
         //console.log(jsonResData.type);
         
         if(ResData=="Good"){
         	window.location.href='wait.html';
         	//$('#loginEntry').hide();
         	//$('#createAccount').hide();
         }

			if(ResData=="badpass"){
				//$('#loginPassword').html("Email Not Found In Database");
				//form.loginEmail.value="";
				//form.loginPassword.focus();
				alert("Name is Used or password is bad");
			}
      
	});
	return false;
}
