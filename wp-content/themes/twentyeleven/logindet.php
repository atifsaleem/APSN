<?php
include ('../../../wp-blog-header.php');

$email=$_GET['email'];

global $wpdb;
$sql="SELECT user_login FROM wp_users WHERE user_email=\"".$email."\"";
$results=$wpdb->get_results($sql) or die(mysql_error());
foreach($results as $result)
echo $result->user_login;
?>