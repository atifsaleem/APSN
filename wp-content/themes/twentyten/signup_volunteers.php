<?php

include ('../../../wp-blog-header.php');
global $wpdb;
$eventID = $_GET['eventID'];
$email = $_GET['email'];
$queueNum = 0;
$msg = "";

foreach ($wpdb->get_results("SELECT * FROM event_details WHERE eventID='$eventID'") as $event_detail) {
    
}

if ($signups = $wpdb->get_results("SELECT * FROM signedup_volunteers WHERE `eventID`='$eventID' AND `status`='confirmed' ORDER BY queueNum")) {
    foreach ($signups as $lastSignup)
        $queueNum = $lastSignup->queueNum;
}
//echo $queueNum;
if ($queueNum >= $event_detail->vacancies) {
    $queueNum = $event_detail->waitlist;
    /*if ($signups = $wpdb->get_results("SELECT * FROM signedup_volunteers WHERE `eventID`='$eventID' AND `status`='confirmed' ORDER BY queueNum")) {
        foreach ($signups as $lastSignup)
            $queueNum = $lastSignup->queueNum;
    }
    */
    $queueNum += 1;
    $wpdb->get_results("INSERT INTO apsn.signedup_volunteers (`eventID`, `volunID`,`status`,`queueNum`) VALUES ('$eventID', '$email','wait','$queueNum')");
    $wpdb->get_results("UPDATE apsn.event_details SET `waitlist`=waitlist+1 WHERE `eventID`='$eventID'");
    $msg = "All vacancies are presently full. You have been registered to the waitlist.";
} else {
    $queueNum+=1;
    $wpdb->get_results("INSERT INTO apsn.signedup_volunteers (`eventID`, `volunID`,`status`,`queueNum`) VALUES ('$eventID', '$email','confirmed','$queueNum');");
    $msg = "Registration Successful.";
}
echo $msg;
?>