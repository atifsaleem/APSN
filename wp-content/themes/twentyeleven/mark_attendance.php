<?php
include ('../../../wp-blog-header.php');
global $wpdb;
$eventID=$_GET['eventID'];
$sessionID = $_GET['sessionID'];
$records=$wpdb->get_results("SELECT A.`First Name`,A.`Last Name`,A.`Email`,B.`volunID` FROM signedup_volunteers AS B,wp_volunteers_details AS A WHERE B.`eventID`='$eventID' AND B.`status`='confirmed' AND A.`Email`=B.`volunID` ORDER BY `First Name`");
$var="";
$var.="<table width=\"90%\" style=\"margin-top:10px;\">";
foreach($records as $record){
    $names = get_object_vars($record);
    $var.="<tr><td>".$names['Title']." ".$names['First Name']." ". $names['Last Name']."</td><td>".$names['Email']."</td>";
    $var.="<td>Hours : <input value=\"\" type=\"text\" style=\"height:16px;font-size:80%;position: inline;width:20px \" size=\"2\" name=\"$names[Email]\"></td></tr>";
}
$var.="</table>";
$var.= "<center><button onClick=\"\">Update</button></center>";
echo $var;
?>