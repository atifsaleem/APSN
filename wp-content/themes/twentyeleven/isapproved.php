<?php
include ('../../../wp-blog-header.php');
$email = $_GET['email'];
global $wpdb;

$sql="SELECT * FROM wp_cformssubmissions WHERE email=\"".$email."\"";
$results=$wpdb->get_results($sql);

foreach ($results as $result)
{
if ($email==$result->email)
echo "1";
else echo "0";
}
?>