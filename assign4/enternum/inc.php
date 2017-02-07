<?php
	require("../include/utility.php");
	$dbconn=connectToDB();
	$sql="SELECT * FROM Incrementer";
	logmsg($sql);
	if(!($result=$dbconn->query($sql)))
		logMsgAndDie("Bad Query");
	if($myrow=$result->fetch_array()){
		//$sql="lock table incrementer write";
		$count=$myrow['clickIt'];
		$count++;
		$sql="update Incrementer set clickIt='$count';";
		//$sql="unlock table";
		logmsg($sql);
		if(!($result=$dbconn->query($sql)))
			logMsgAndDie("Bad Query");
	} else {
		echo "Empty Clicker Table";
	}
?>
