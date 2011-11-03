<?php 
include ('../../../wp-blog-header.php');
$email = $_GET['email'];
global $wpdb;
$sql='SELECT * FROM wp_volunteer_details WHERE Email=\"'.$email.'\"';
$records=$wpdb->get_results($sql);
$cols=$wpdb->get_col_info('name');
foreach($records as $record)
echo "Hi";
?>
