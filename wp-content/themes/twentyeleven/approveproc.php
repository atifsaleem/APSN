<?php 
include ('../../../wp-blog-header.php');
include("show_array.php");

$email = $_GET['email'];
global $wpdb;
$sql="SELECT * FROM wp_volunteers_details WHERE Email=\"".$email."\"";
$records = $wpdb->get_results($sql) or die(mysql_error());
foreach($records as $record)
{
$names = get_object_vars($record);
html_show_array($names);
}
?>
