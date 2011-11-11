<?php
include ('../../../wp-blog-header.php');
global $wpdb;

$eventID = $_GET['eventID'];

//Displaying Events Info
$events=$wpdb->get_results("SELECT * FROM event_details WHERE eventID=$eventID")or die(mysql_error());
foreach($events as $event)
    echo "<strong size=6>$event->name</strong><p class=\"alignright\">$event->date_from to $event->date_to</p><br>
        <strong>Venue</strong><br><p>$event->description</p>";

//Displaying Sessions Info
if($event->sessions > '1'){
    echo "<strong>Session Info : </strong><br>";
    echo"<table><tr><th>Session No.</th><th>Date</th>";
    $sessions=$wpdb->get_results("SELECT * FROM session_details WHERE eventID=$eventID");
    foreach($sessions as $session){
        echo"<tr><td>Session $session->sessionID</td><td>$session->date</td></tr>";
    }
    echo"</table>";
}

//Signing Up and Withdrawing Application
$i=0;
$email=$current_user->user_email;

if($wpdb->get_results("SELECT * FROM signedup_volunteers WHERE `eventID`='$eventID' AND `volunID`='$email'"))
    echo"<button onClick=\"withdraw(this,$eventID)\" id=\"$email\">Withdraw Application</button>";
else
    echo"<button onClick=\"register(this,$eventID)\" id=\"$email\">Sign Up</button>";
echo"";
?>