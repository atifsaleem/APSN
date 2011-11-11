<?php
include ('../../../wp-blog-header.php');
global $wpdb;

$status = $_GET['status'];
$eventID = $_GET['eventID'];
echo "<table><tr><th>Name</th><th>E-mail</th><th>Pager/Handphone</th><th>Home Telephone</th></tr>";
$volunteers = $wpdb->get_results("SELECT A.`Title`,A.`First Name`,A.`Last Name`,A.`Pager/Handphone`,A.`Home Telephone`,A.`Email`,B.`volunID` FROM wp_volunteers_details AS A,signedup_volunteers AS B WHERE B.`eventID`='$eventID' AND B.`status`='$status' AND A.`Email`=B.`volunID`") or die(mysql_error());
foreach($volunteers as $volunteer){
    $names = get_object_vars($volunteer);
    echo"<tr><td>".$names['Title']." ".$names['First Name']." ". $names['Last Name']."</td><td>$volunteer->Email</td><td>".$names['Pager/Handphone']."</td><td>".$names['Home Telephone']."</td></tr>";
}
?>