<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); ?>


<script type="text/javascript">
var $j = jQuery.noConflict();

function get_profile(e) 
{
var id= e.id;
$j.get('wp-content/themes/twentyeleven/recordproc.php?email='+id,function(data){
 $j("#record-container").html(data);     
  });

//alert(data);

}

function approve(e)
{
var id=e.id;
/* $j.get("recordapprove.php?fieldname=email&fieldvalue="+id,function(data)
{
alert(data);
}
);
var rows=$j("tr.single");
rows.each(
function()
{
var cells=$j(this).children("td");
var i=0;
var field_name;
var field_value;
cells.each
( function(){
if (i%2==0)
field_name=$j(this).html();
else
field_value=$j(this).html();
}
)
}
);*/
$j.get("wp-content/themes/twentyeleven/recordapprove.php?email="+id, function(data)
{
alert(data);
}
);
}
</script>
<div id="record-container" style="float:right; width: auto; height: auto;">
</div>
<div id="log"></div>
<?php 

global $wpdb;
$wpdb->cformssubmissions	= $wpdb->prefix . 'cformssubmissions';
$wpdb->cformsdata       	= $wpdb->prefix . 'cformsdata';

$sql = "SELECT email, GROUP_CONCAT( CONVERT( id, CHAR( 8 ) ) ) AS 'forms', ip, sub_date "
    . "FROM wp_cformssubmissions "
    . "GROUP BY email ";

$result = $wpdb->get_results($sql) or die(mysql_error());
echo "<table>";
echo "<tr> <th> Email </th> <th style=\"padding:10px\"> IP </th> <th style=\"padding:10px\"> Date</th> </tr>";

foreach($result as $entry)
{
echo "<tr id=\"$entry->email\" class=\"record\" style=\"tr:hover{background-color: red;}\"onclick=\"get_profile(this);\"><td>".$entry->email."</td>";
echo "<td style=\"padding:10px\">".$entry->ip."</td>";
echo "<td style=\"padding:10px\">".$entry->sub_date."</td>";
echo "<td><input type='checkbox' name='".$entry->email."'> </td></tr>";
}
echo "</table>";
?>