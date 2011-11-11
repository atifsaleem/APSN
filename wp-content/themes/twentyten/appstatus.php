<?php
global $wpdb;
$id=$current_user->user_email;
$sql= "SELECT email, GROUP_CONCAT( CONVERT( id, CHAR( 8 ) ) ) AS 'forms', ip, sub_date, approved FROM wp_cformssubmissions WHERE email=\"$id\"";
$results=$wpdb->get_results($sql) or die(mysql_error());
foreach($results as $result)
{
if ($result->approved==0 && $result->email==$id)
echo "<ul id=\"appstatus\"><li><p>Your Application is pending approval</p></li></ul>";
else if ($result->approved==1 && $result->email==$id)
echo "<ul id=\"appstatus\"><li><p>Congrats! Your Application has been approved, you may now sign up for events</p></li></ul>";
else
echo "<ul id=\"appstatus\"><li><p>You have not submitted your application yet</p></li></ul>";

}

?>