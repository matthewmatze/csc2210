<?php
function connectToDB()
{
	$dbPath="localhost";
	$dbUser="mmatzeweb";
	$dbPass=")&%(%&!";
	$dbName="csc2210_mmatze_db";
	//The object oriented way
	$dbconn = new mysqli($dbPath,$dbUser,$dbPass);
	logMsg("Connecting to $dbPath with user $dbUser");
	if(!$dbconn)
	{
		logMsg('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
		logMsgAndDie("Error Connecting to $dbPath with user $dbUser");
	}
	if(!$dbconn->select_db($dbName))
	{
		logMsgAndDie("Could not select $dbName database");
	}
	return $dbconn;
}
function disconnectDB($dbconn)
{
	$dbconn->close();
	logMsg("Disconnect from database:");
}
// The log file is in /home/faculty/rshore/log/PHP_errors.log . This is designated in the .htaccess file in the root
// directory of a project. I generally use the UNIX tail command to view the log file.
function logMsg($message)
{
	error_log($message);
}
function logMsgAndDie($message)
{
	error_log($message);
	die('See error log for details '.mysql_error());
}
function cleanInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
