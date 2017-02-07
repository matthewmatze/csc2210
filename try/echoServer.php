<?php
require("../include/utility.php");
header("Content-Type: text/event-stream\n\n");
header("Cache-Control: no-cache\n\n");
date_default_timezone_set("America/New_York");
$dbconn = connectToDB();
$prevcnt=-1;
logMsg("server");
while (1) {
  // Every second, sent a "ping" event.
  
  $query="SELECT * FROM Incrementer;";
	logMsg($query);
	$result = $dbconn->query($query);

	if(!$result)
	{
		logMsgAndDie('Select command failed:');
	}
	if($myrow = $result->fetch_array())
	{
		logMsg($myrow["clickIt"]);
		$cnt=$myrow["clickIt"];
		if($cnt!=$prevcnt)
		{
			echo "event: cnt\n";
			echo 'data: ' .$cnt. '';
			echo "\n\n";
			$prevcnt=$cnt;
		}
	}	
  ob_flush();
  flush();
  sleep(1);
}

?>
