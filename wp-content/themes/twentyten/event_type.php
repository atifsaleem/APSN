<?php

include ('../../../wp-blog-header.php');

global $wpdb;

$type = $_GET['type'];
$events = $wpdb->get_results("SELECT * FROM event_details") or die(mysql_error());

$var = "";

switch ($type) {
    
}
$var.= "<table class=\"linked\" width=100% id=\"event-list\">";
foreach ($events as $event) {
    $var.= "<tr class=\"record\" style=\"tr:hover{background-color:red;}\">
    <td style=\"padding:10px\" id=\"$event->eventID\" onclick=\"signup(this);\"> $event->name
            <p class=\"alignright\"> $event->date_from to $event->date_to </p>
            <br>$event->description<br>
            </td></tr>";
}
$var .= "</table>";
echo $var;
//<button class=\"alignright\" id=\"$event->eventID\" style=\"margin-bottom:5px;\" onClick=\"signup(this);\">Sign Up</button>
?>