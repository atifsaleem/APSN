<?php

global $wpdb;


$wpdb->cformssubmissions = $wpdb->prefix . 'cformssubmissions';
$wpdb->cformsdata = $wpdb->prefix . 'cformsdata';

global $current_user;
get_currentuserinfo();

include("show_array.php");

$email = $current_user->user_email;
$sql = "SELECT * FROM wp_volunteers_details WHERE Email=\"" . $email . "\"";
$records = $wpdb->get_results($sql) or die(mysql_error());
foreach ($records as $record) {
    $names = get_object_vars($record);
    html_show_array($names);
}
/*
  $sql = "SELECT f_id, field_name, field_val FROM wp_cformsdata WHERE sub_id = $form->id ORDER BY f_id";

  $records = $wpdb->get_results($sql) or die(mysql_error());
  $var=$var."<table>";
  foreach($records as $record)
  {
  if(substr($record->field_name, 0, 8)!='Fieldset' && $record->field_name != 'page'){
  $var=$var."<tr><td>$record->field_name</td><td>$record->field_val</td></tr>";
  }
  }
  $var=$var."</";

  echo 'Username: ' . $current_user->user_login . "\n";
 */
?>