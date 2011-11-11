<?php

include ('../../../wp-blog-header.php');
global $wpdb;
$eventID = $_GET['eventID'];
$email = $_GET['email'];
$diff = 0;
$queue = 0;
$status = "";

foreach ($wpdb->get_results("SELECT * FROM signedup_volunteers WHERE `eventID`='$eventID' AND `volunID`='$email'") as $reqSignup) {
    $queue = $reqSignup->queueNum;
    $status = $reqSignup->status;
}
if ($status == "confirmed") {
    foreach ($wpdb->get_results("SELECT * FROM signedup_volunteers WHERE `eventID`='$eventID' AND `status`='confirmed' ORDER BY queueNum") as $signup) {
        $wpdb->get_results("UPDATE TABLE signedup_volunteers SET `queueNum`='$signup->queueNum - $diff' WHERE `eventID`='$signup->eventID' AND `volunID`='$signup->volunID'");
        if ($queue == $signup->queueNum) {
            $diff = 1;
            $wpdb->get_results("DELETE FROM signedup_volunteers WHERE `eventID`='$eventID' AND `volunID`='$email'");
        }
    }
    if ($wpdb->get_results("UPDATE TABLE signedup_volunteers SET `status`='confirmed' `queueNum`='$signup->queueNum' WHERE `eventID`='$signup->eventID' AND `status`='wait' AND `queueNum`='1'"))
        ;
}

if ($signups = $wpdb->get_results("SELECT * FROM signedup_volunteers WHERE `eventID`='$eventID' AND `status`='wait' ORDER BY queueNum")){
    foreach ($signups as $signup) {
        $wpdb->get_results("UPDATE TABLE signedup_volunteers SET `queueNum`='$signup->queueNum - $diff' WHERE `eventID`='$signup->eventID' AND `volunID`='$signup->volunID'");
        if ($queue == $signup->queueNum) {
            $diff = 1;
            $wpdb->get_results("DELETE FROM signedup_volunteers WHERE `eventID`='$eventID' AND `volunID`='$email'");
        }
    }
    $wpdb->get_results("UPDATE apsn.event_details SET `waitlist`=waitlist-1 WHERE `eventID`='$eventID'");
}

echo "Application Successfully Withdrawn";
?>