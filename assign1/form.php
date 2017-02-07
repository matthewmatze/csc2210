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
		<div data-role="page" id="formEcho">
			<div data-role="header">
				<h1>Echo - Form Demo</h1>
			</div>
			<div data-role="content">
				<?php
					require("../include/utility.php");
					if($_SERVER["REQUEST_METHOD"] == "POST") 
					{
						$first = cleanInput($_POST["fname"]);
						$last = cleanInput($_POST["lname"]);
						$age = cleanInput($_POST["age"]);
						printf("First: %s <br />\n",$first);
						printf("Last: %s <br />\n",$last);
						printf("Age: %s <br />\n",$age);
						logMsg('Storing data'.$last);
						$dbconn = connectToDB();
						$query = "insert into students (first,last,age) values ('$first','$last','$age');";
						logMsg($query);
						$result = $dbconn->query($query);
						if(!$result) {
						logMsgAndDie('Select command failed:');
						} else {
							logMsg('insert successful');
						}
						disconnectDB($dbconn);
					}
			?>
			</div>
			<a data-role="button" href="echo.php" value="Return">
				Return
			</a>
			<a data-role="button" href="#all" value="Return">
				Show Database
			</a>
			<div data-role="footer">
			<span style="font-size: .7em">Copyleft Stump Productions&copy; 2015</span>
			</div>
		</div> 
		<div data-role="page" id=all>
			<div data-role="header">
				<h1>Echo - Database Demo</h1>
			</div>
			<div data-role="content">
				<?php
					require("../include/utility.php");
					$students= "SELECT * FROM students";
					$dbconn = connectToDB();
					$result = $dbconn->query($students);
					if($result->num_rows > 0) 
					{
						//Output data of each row
						while($row = $result->fetch_assoc())
						{
							echo "first: " . $row["first"]. " - Last: " . $row["last"]. "- Age: " . $row["age"]. "<br>";
						}
					} else {
						echo "0 results";
					}
				?>
			<a data-role="button" href="form.php" value="Return">
				Return
			</a>
			</div>
		</div>
	</body>
</html>
