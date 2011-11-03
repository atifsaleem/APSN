<?php 

global $wpdb;
?>
<script type="text/javascript">
var $j = jQuery.noConflict();

function get_profile(e) 
{
var id= e.id;
$j.get('wp-content/themes/twentyeleven/approveproc.php?email='+id,function(data){
 $j("#record-container").html(data);
 alert(data);     
  });


}
</script>
<div id="record-container" style="float:right; width: auto; height: auto;">
</div>

<?php
$sql = "SELECT Email, `First Name`, `Last Name` FROM wp_volunteers_details ORDER BY `Last Name`";

$result = $wpdb->get_results($sql) or die(mysql_error());
echo "<table>";
echo "<tr> <th> Email </th> <th style=\"padding:10px\"> First name </th> <th style=\"padding:10px\"> Last Name</th> </tr>";

foreach($result as $entry)
{
$names = get_object_vars($entry);
echo "<tr id=\"$entry->Email\" class=\"record\" style=\"tr:hover{background-color: red;}\"onclick=\"get_profile(this);\"><td>".$entry->Email."</td>";
echo "<td style=\"padding:10px\">".$names['First Name']."</td>";
echo "<td style=\"padding:10px\">".$names['Last Name']."</td></tr>";
}
echo "</table>";


?>