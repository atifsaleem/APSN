<?php
include ('../../../wp-blog-header.php');
$email = substr(0,-7,$_GET['email'];
global $wpdb;
$sql="SELECT DISTINCT (
a.email
) AS `email`, e.name AS `eventName`, GROUP_CONCAT( CONVERT( DATE, CHAR( 12 ) ) ) AS `sessions`
FROM  `attendance` AS  `a` ,  `event_details` AS  `e` , session_details AS  `s` 
WHERE a.email=$email
AND a.eventID = s.eventID
AND s.eventID = e.eventID
AND a.sessionID = s.sessionID
GROUP BY e.name
LIMIT 0 , 30
";
$results=$wpdb->getresults($sql);
echo "<center><button id=\"".$email."-email\" style=\"margin-bottom:30px;\" onClick=\"email(this);\">Email</button></center>";
echo "<button id=\"".$email."-close\" style=\"margin-bottom:30px;\" onClick=\"close_record(this);\" style=\"float:left;\">x</button>";
echo "<center><button id=\"".$email."\" style=\"margin-bottom:30px;\" onClick=\"get_profile(this);\">Back to Profile</button></center>";

echo "<h1> Volunteering Records </h1><br><ul>"
foreach($results as $result)
{
echo "<li>Attended $result->eventName"
$sessions=explode(",",$result->sessions);
echo "<ul>"
foreach($sessions as $session)
	{
	echo "<li>Attended session on $session</li>";
	}
echo "</ul></li>"
}
echo "</ul>";

?>