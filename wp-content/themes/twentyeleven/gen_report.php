<?php
include ('../../../wp-blog-header.php');
global $wpdb;

$file = 'export';
$table = $_POST['table'];
//$table = "event_details";
//$table="(SELECT `Email`, `First Name`, `Last Name` FROM wp_volunteers_details ORDER BY `Last Name`)";
$file = "Volunteers";

$results = $wpdb->get_results("SHOW COLUMNS FROM $table",ARRAY_A);
$i = 0;
if ($wpdb->num_rows > 0) {
    foreach ($results as $row) {
$csv_output .= $row['Field'].", ";
$i++;
}
}
$csv_output .= "\n";

$values = $wpdb->get_results("SELECT * FROM $table",ARRAY_N);
foreach($values as $rowr) {
for ($j=0;$j<$i;$j++) {
$csv_output .= $rowr[$j].", ";
}
$csv_output .= "\n";
}

$filename = $file."_".date("Y-m-d_H-i",time());
header("Content-type: application/vnd.ms-excel");
header("Content-disposition: csv" . date("Y-m-d") . ".csv");
header( "Content-disposition: filename=".$filename.".csv");
print $csv_output;
exit;