<?php

include ('../../../wp-blog-header.php');
$path=get_bloginfo('template_directory');
global $wpdb;
$where="WHERE ";
$i=0;
while (list($var, $val) = each($_POST)) {
    if ($i!=0)
    $where=$where."AND `".preg_replace('/_/',' ',$var)."`='$val' ";
   
    else { $where= $where."`".preg_replace('/_/',' ',$var)."`='$val' ";
     $i=1;
    	}
}
if ($i==0)
{
$sql="SELECT Email, `First Name`,`Last Name` FROM wp_volunteers_details ORDER BY `Last Name`";
$result=$wpdb->get_results($sql) or die(mysql_error());
}
else
{ $sql="SELECT Email, `First Name`,`Last Name` FROM wp_volunteers_details $where ORDER BY `Last Name`";
$result=$wpdb->get_results($sql) or die(mysql_error());
}

$var.="<center><button style=\"margin-bottom:30px;\" onclick=\"close();\">x</button></center>";

echo "<table id=\"approved-table\">";
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