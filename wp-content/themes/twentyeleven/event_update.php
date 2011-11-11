<?php

include ('../../../wp-blog-header.php');
$path = get_bloginfo('template_directory');
global $wpdb;

$keymap = array(
    1 => "Chaoyang School",
    2 => "Katong School",
    3 => "Tanglin School",
    4 => "Delta Senior School",
    5 => "Centre for Adults");
extract($_POST);

get_header();

$eventID = $_GET['eventID'];
//echo "Heloooooooo";
if($wpdb->query("UPDATE event_details SET name='$element_1',description='$element_2',organizer='$keymap[$element_4]',venue='$element_3',vacancies=$numVacancies WHERE eventID=$eventID"));
//$wpdb->query("DELETE FROM `temp_session_details` WHERE `eventID`='$eventID'");

$numSessions = 0;
$k=1;
while(array_key_exists("session-$k-1-1", $_POST)){
//for ($k = 1; $k <= $numSessions; $k++) {
    $date = "";
    //echo $k;
    //echo"event".$eventID;
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
            /* 		else if ($i==2 && $j==4)
              {
              $start_time=$start_time." ".$_POST["session-$k-2-4"];
              }
             */ else if ($i == 3 && $j < 4) {
                if ($j == 3)
                    $end_time = $end_time . $_POST["session-$k-3-$j"];
                else
                    $end_time = $end_time . $_POST["session-$k-3-$j"] . ":";
            }
            /* 		else if ($i==3 && $j==4)
              {
              $end_time=$end_time." ".$_POST["session-$k-3-4"];
              }
             */
        }
    }
    $date = substr($date, 0, -1);
    $timestamp = strtotime($date);
    $date = date('Y-m-d', $timestamp);
    //echo $start_time . "-" . $end_time;
    if($_POST["delete-$k"]==0){
        $numSessions++;
    //echo " THE K-VALUE".$k."end   ";
    $wpdb->query("INSERT INTO temp_session_details(`eventID`,`sessionID`,`date`,`starttime`,`endtime`) VALUES ('$eventID','$k','$date','$start_time','$end_time')") or die(mysql_error());
    }
    $k+=1;
    
}
if($wpdb->query("UPDATE event_details SET `sessions`='$numSessions' WHERE `eventID`='$eventID'"));
$sessions = $wpdb->get_results("SELECT * FROM `temp_session_details` WHERE `eventID`='$eventID' ORDER BY `date`");
$wpdb->query("DELETE FROM `session_details` WHERE `eventID`='$eventID'");
$k = 1;
foreach ($sessions as $session) {
    $date = $session->date;
    $wpdb->query("INSERT INTO session_details(`eventID`,`sessionID`,`date`,`starttime`,`endtime`) VALUES ('$session->eventID','$k','$session->date','$session->starttime','$session->endtime')") or die(mysql_error());
    if ($k == 1) {
        $wpdb->query("UPDATE event_details SET `date_from`='$date' WHERE `eventID`=$eventID");
    }
    if ($k == $numSessions) {
        $wpdb->query("UPDATE event_details SET `date_to`='$date' WHERE `eventID`=$eventID");
    }
    $k += 1;
}
$wpdb->query("DELETE FROM `temp_session_details` WHERE `eventID`='$eventID'");

/*    if ($k == 1) {
        $wpdb->query("UPDATE event_details SET `date_from`='$date' WHERE `eventID`=$id") or die(mysql_error());
    }
    if ($k == $numSessions) {
        $wpdb->query("UPDATE event_details SET `date_to`='$date' WHERE `eventID`=$id") or die(mysql_error());
    }
*/
echo "<div id=\"primary\">";
echo "<div id=\"content\" role=\"main\">";
echo "<p class=\"aligncenter\">All Changes have been saved successfully.</p>";
echo "</div>";
echo "</div>";
get_footer();
?>