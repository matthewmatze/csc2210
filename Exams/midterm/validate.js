function checkForm(form)
{
	if(form.code.value<5)
	{

		"ID":form.ID.value, "code":form.code.value, "X":form.X.value;
     	function(resData)
		{  	
			jsonResData = $.parseJSON(resData);
         console.log(jsonResData);
  	      console.log(jsonResData.type);
			if(jsonResData.X=="X")
			{
	         jsonResData.code="";
     		} else if(jsonResData.code=="good")
			{
	         $('#code').html(jsonResData.code);
   	      $('#pad').hide();
     	   	$('#ID').hide();
     		}else if(jsonResData.type=="Invalid_code")
			{
     			$('#code').html("Not used in database");
      	   form.code.value="";
  	      	form.code.focus();
			}
		}

	}
}		
