<!--Name: Matthew Matze
	 Date: 2-5-2015
	 Class:CSC-2210
	 Location: ~/public_html/csc2210/Exams/midterm/form.php
	-->
<html>
<?php
	require("../include/utility.php");
	$dbconn = connectToDB();

		if(isset($_POST["ID"])&&isset($_POST["code"]&&isset($_POST["X"]))
		{
			$X		= cleanInput($_POST["X"]);
			$code = cleanInput($_POST["code"]);
			$ID 	= cleanInput($_POST["ID"]);
			logMsg('Checking data'.$last);
			$query = "Check if code and ID are in students2 (code,ID) values ('$code','$ID');";
			logMsg($query);
			$result = $dbconn->query($query);
			if(!$result)
			{
				logMsgAndDie('Select command failed:');
			} else 
			{
				logMsg('insert successful');
			}
			disconnectDB($dbconn);
		}
?>
	<div data-role="header">
   	<h1>Echo - Database Info</h1>
   </div>
   <div data-role="content">
	   <?php
   		require("../include/utility.php");
	      $students2= "SELECT * FROM students2";
	     	$dbconn = connectToDB();
   	   $result = $dbconn->query($students2);
	      if($result->num_rows > 0)
      	{
   	   	//Output data of each row
	         while($row = $result->fetch_assoc())
         	{
      	   	printf("First Name: %s -  Code: %s <br />\n", $row["first"], $row["code"]);
   	      }
	      } else {
       		echo "0 results";
      	}
   	?>
	</div>
</html>
