<?php
include ('../../../wp-blog-header.php');
$email = $_GET['email'];
global $wpdb;
$wpdb->cformssubmissions	= $wpdb->prefix . 'cformssubmissions';
$wpdb->cformsdata       	= $wpdb->prefix . 'cformsdata';
//mysql_connect("localhost", "admin", "admin") or die(mysql_error());
//mysql_select_db("apsn") or die(mysql_error());

$var="";
/*$sql = "SELECT email, GROUP_CONCAT( CONVERT( id, CHAR( 8 ) ) ) AS 'forms', ip, sub_date "
    . "FROM wp_cformssubmissions "
    . "GROUP BY email ";

$result = $wpdb->get_results($sql) or die(mysql_error());
$var.= "<table>";
$var.= "<tr> <th> Email </th> <th style=\"padding:10px\"> IP </th> <th style=\"padding:10px\"> Date</th> </tr>";

foreach($result as $entry)
{
$var.= "<tr><td>".$entry->email."</td>";
$var.= "<td>".$entry->ip."</td>";
$var.= "<td>".$entry->sub_date."</td>";
$var.= "<td><input type='checkbox' name='".$entry->email."'> </td></tr>";
}
$var.= "</table>";
 * 
 */

//$form_list = "SELECT form_id "
  //  . "FROM wp_cformssubmissions "
    //. "WHERE email = $email'";

$Title = array("1" => "Dr.", "2" => "Mr.", "3" => "Mdm","4"=>"Mrs.","5"=>"Ms.");
$Sex = array("1" => "Male", "2" => "Female");
$SgPR = array("1" => "Yes", "0" => "No");
$Martial = array("1" => "Single", "2" => "Married", "3" => "Divorced/Seperated","4"=>"Widowed");
$NS_Status = array("1" => "Full Time", "2" => "Reservist", "3" => "Exempted");
$HigherEdu = array("1" => "Primary", "2" => "Secondary", "3" => "GCE 'N'/'O'", "4"=>"ITE","5"=>"GCE 'A'","6"=>"Diploma","7"=>"Pass Degree","8"=>"Honors Degree","9"=>"Masters Degree","10"=>"Doctorate");
$Dwelling = array("1"=>"HDB Room","2"=>"HD Executive","3"=>"HUDC","4"=>"Semi-detached/Terrace","5"=>"Condominium/Private Appt");
$PrevVolunExp = array("1" => "Yes", "0" => "No");
$Availability = array("1" => "Once Weekly", "2" => "Twice Weekly", "3" => "More than Twice Weekly");


$forms = $wpdb->get_results("SELECT * FROM wp_cformssubmissions WHERE email = \"".$email."\"") or die(mysql_error());

$var.="<center><button id=\"".$email."\" style=\"margin-bottom:30px;\" onClick=\"approve(this);\">Approve</button></center>";
$var.="<button onClick=\"close(this);\">x</button>";
$i=0;
foreach($forms as $form)
{
    
    $sql = "SELECT f_id, field_name, field_val FROM wp_cformsdata WHERE sub_id = $form->id ORDER BY f_id";
    
    $records = $wpdb->get_results($sql) or die(mysql_error());
    $var=$var."<table>";
    foreach($records as $record)
    {   if (i%2==0)
        if(substr($record->field_name, 0, 8)!='Fieldset' && $record->field_name != 'page'){
            $var=$var."<tr class=\"single\"><td>$record->field_name</td><td>$record->field_val</td></tr>";
        }
        else
                if(substr($record->field_name, 0, 8)!='Fieldset' && $record->field_name != 'page'){
            $var=$var."<tr class=\"single alt\"><td>$record->field_name</td><td>$record->field_val</td></tr>";
        }
		$i=$i+1;
    }
    $var=$var."</";
     
}
$var .= "</table>";
echo $var;

?>