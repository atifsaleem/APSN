<?php

include ('../../../wp-blog-header.php');
$path = get_bloginfo('template_directory');
global $wpdb;
get_header();

$keymap = array(
    1 => "Chaoyang School",
    2 => "Katong School",
    3 => "Tanglin School",
    4 => "Delta Senior School",
    5 => "Centre for Adults");
extract($_POST);

$wpdb->query("INSERT INTO `event_details` (`name`,`description`,`organizer`,`venue`,`sessions`,`vacancies`) VALUES ('$element_1','$element_2','$keymap[$element_4]','$element_3','$numSessions','$numVacancies')");
$results = $wpdb->get_results("SELECT MAX(eventID) AS id_great FROM event_details");
foreach ($results as $result)
    $id = $result->id_great;

for ($k = 1; $k <= $numSessions; $k++) {
    $date = "";
    $start_time = "";
    $end_time = "";
    for ($i = 1; $i <= 3; $i++) {

        for ($j = 1; $j <= 4; $j++) {
            if ($i == 1 && $j < 4) {
                if ($_POST["session-$k-$i-$j"] != "")
                    $date = $date . $_POST["session-$k-$i-$j"] . "/";
            }
            else if ($i == 2 && $j < 4) {
                if ($j == 3)
                    $start_time = $start_time . $_POST["session-$k-2-3"];
                else
                    $start_time = $start_time . $_POST["session-$k-2-$j"] . ":";
            }
            else if ($i == 2 && $j == 4) {
                $start_time = $start_time . " " . $_POST["session-$k-2-4"];
            } else if ($i == 3 && $j < 4) {
                if ($j == 3)
                    $end_time = $end_time . $_POST["session-$k-3-$j"];
                else
                    $end_time = $end_time . $_POST["session-$k-3-$j"] . ":";
            }
            else if ($i == 3 && $j == 4) {
                $end_time = $end_time . " " . $_POST["session-$k-3-4"];
            }
        }
    }
    $date = substr($date, 0, -1);
    $timestamp = strtotime($date);
    $date = date('Y-m-d', $timestamp);
    echo $start_time . "-" . $end_time;

    $wpdb->query("INSERT INTO `temp_session_details`(`eventID`,`sessionID`,`date`,`starttime`,`endtime`) VALUES ('$id','$k','$date','$start_time','$end_time')");
}

$sessions = $wpdb->get_results("SELECT * FROM `temp_session_details` WHERE `eventID`='$id' ORDER BY `date`");
$k = 1;
foreach ($sessions as $session) {
    $date = $session->date;
    $wpdb->query("INSERT INTO `session_details`(`eventID`,`sessionID`,`date`,`starttime`,`endtime`) VALUES ('$session->eventID','$session->sessionID','$session->date','$session->starttime','$session->endtime')");
    if ($k == 1) {
        $wpdb->query("UPDATE `event_details` SET `date_from`='$date' WHERE `eventID`='$id'");
    }
    if ($k == $numSessions) {
        $wpdb->query("UPDATE `event_details` SET `date_to`='$date' WHERE `eventID`='$id'");
    }
    $k += 1;
}
$wpdb->query("DELETE FROM `temp_session_details` WHERE `eventID`='$id'");

echo "<div id=\"primary\">";
echo "<div id=\"content\" role=\"main\">";
echo "<p class=\"aligncenter\">The event has been created successfully</p>";
echo "</div>";
echo "</div>";
get_footer();
?>