<!--Name: Matthew Matze
    Date: 2-5-2015
    Class:CSC-2210
    Location: ~/public_html/csc2210/assign1
   -->
<html>
	<head>
		<title>Assign 1</title>
			<link href="../include/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet" type="text/css"/>
			<script type="text/javascript" src="../include/jquery-2.1.3.js"></script>
			<script type="text/javascript" src="../include/jquery.mobile-1.4.5/jquery.mobile-1.4.5.min.js"></script>
	</head>
	<body>
		<div data-role="page" id="formEntry">
			<div data-role="header">
				<h1>Form Demo</h1>
			</div>
			<div data-role="content">
				<form action="form.php" method="post">
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
