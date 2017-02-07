<!--Name: Matthew Matze
    Date: 2-9-2015
    Class:CSC-2210
    Location: ~/public_html/csc2210/assign2
   -->
<html>
	<head>
		<title>Assign 2</title>
			<link href="../include/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>
			<script type="text/javascript" src="../include/jquery-2.1.3.js"></script>
			<script type="text/javascript" src="../include/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
			<script type="text/javascript" src="validate.js"></script>
	</head>
	<body>
		<div data-role="page" id="formEntry">
			<div data-role="header">
				<h1>Form Demo</h1>
			</div>
			<div data-role="content">
				<form action="form.php" method="post" name="personEntry" onSubmit="return checkForm(document.personEntry);">
					<div data-role="fieldcontain">
						<label for="fname">First:</label>
						<input type="text" name="fname" id="fname" value="" />
					</div>
					<div data-role="fieldcontain">
						<label for="lname">Last:</label>
						<input type="text" name="lname" id="lname" value="" />
					</div>
					<div data-role="fieldcontain">
						<label for="age">Age: </label>
						<input type="text" name="age" id="age" value="" />
					</div>
					<div data-role="fieldcontain">
						<label for="email">Email: </label>
						<input type="text" name="email" id="email" value="" />
					</div>
					<div data-role="fieldcontain">
						<select name="year">
							<option value="">Select Year</option>
							<option value="Freshman">Freshman</option>
							<option value="Sophmore">Sophmore</option>
							<option value="Junior">Junior</option>
							<option value="Senior">Senior</option>
						</select>
					</div>
					<div data-role="fieldcontain">
							Male<input type="radio" name="gender" id="gender" value="male" >
							Female<input type="radio" name="gender" id="gender" value="female" >
							Other<input type="radio" name="gender" id="gender" value="other" >
					</div>
					<div data-role="fieldcontain">
						<label for="password">Password:</label>
						<input type="password" name="password" id="password" value="" />
					</div>
					<div data-role="fieldcontain">
						<input type="submit" name="submit" value="Send" />
					</div>
				</form>
			</div>
			<div data-role="footer">
				<span style="font-size: .7em">Copyleft Stump Productions&copy; 2015</span>
			</div>
		</div>
	</body>
</html>
