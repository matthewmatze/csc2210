function checkForm(form)
{
if(form.fname.value == "") {
	alert("Enter first name!");
	form.fname.focus();
	return false;
}
if(form.lname.value == "") {
	alert("Enter Last name!");
	form.lname.focus();
	return false;
}
if(form.age.value == "") {
	alert("Enter Age!");
	form.age.focus();
	return false;
}
if(form.age.value !=""){
	var ageCheck=new RegExp(/^\d+$/);
	if(!ageCheck.test(form.age.value)) {
		alert("Age has a problem ");
		form.age.value="";
		form.age.focus();
		return false;
	}
}
if(form.email.value == ""){
	alert("Enter Email!");
	form.email.focus();
	return false;
}
if(form.email.value != ""){
	var emailCheck=new RegExp(/^[^@]+@[^\.]+\..+$/);
	if(!emailCheck.test(form.email.value)){
		alert("Email has a Problem");
		form.email.value;
		form.email.focus();
		return false;
	}
}
if(form.year.value == "") {
	alert("Enter Year!");
	form.year.focus();
	return false;
}
if(!form.gender[0].checked&&!form.gender[1].checked&&!form.gender[2].checked) {
	alert("Enter Gender!");
	form.gender[0].focus();
	return false;
}
if(form.password.value == "") {
	alert("Enter Password!");
	form.password.focus();
	return false;
}
if(form.password.value != ""){
	var passwordCheck=new RegExp(/^(?=(?:.*[A-Z]){1})(?=(?:.*\d){1})(?=(?:.*[!@#$%^&*-]){1}).{6,}$/);
	if(!passwordCheck.test(form.password.value)){
		alert("Password is invalid");
		form.password.value;
		form.password.focus();
		return false;
	}
}
	/* do validation checks on each field when the field values are incorrect
 * a) alert the user
 * b) focus on the item
 * c) return false
 * Try to remember that, fundamentally, every value is considered to be a string of characters.
 * How it's used can convert it, maybe, to other data types on the fly.
 * */
//If you make it hear, form must be OK
	return true;
}
