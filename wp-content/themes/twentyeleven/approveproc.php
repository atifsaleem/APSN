</script>
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
echo "<center><button id=\"".$email."-email\" style=\"margin-bottom:30px;\" onClick=\"email(this);\">Email</button></center>";
echo "<center><button id=\"".$email."-record\" style=\"margin-bottom:30px;\" onClick=\"see_record(this);\">See records</button></center>";
echo "<button id=\"".$email."-close\" style=\"margin-bottom:30px;\" onClick=\"close_record(this);\" style=\"float:left;\">x</button>";

html_show_array($names);
}
?>
