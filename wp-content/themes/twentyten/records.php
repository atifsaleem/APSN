<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); 

?>


<script type="text/javascript">
var $j = jQuery.noConflict();
function close(e)
{ 
$j("#record-container").html();
}
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
    
    $j.get("wp-content/themes/twentyeleven/recordapprove.php?email="+id, function(data)
    {
        
    }
);
    var login;
    $j.get("wp-content/themes/twentyeleven/logindet.php?email="+id, function(data)
    {
        login=data;
        $j.get("wp-admin/users.php?page=ps_groups_edit&action=addusr&groupid=2&add-username="+login,function(data)
        { alert(data);
             });
        
    }
);
    
}
</script>
<?php 

global $wpdb;
$wpdb->cformssubmissions	= $wpdb->prefix . 'cformssubmissions';
$wpdb->cformsdata       	= $wpdb->prefix . 'cformsdata';

$sql = "SELECT email, GROUP_CONCAT( CONVERT( id, CHAR( 8 ) ) ) AS 'forms', ip, sub_date, approved "
    . "FROM wp_cformssubmissions "
    . "GROUP BY email ";

$result = $wpdb->get_results($sql) or die(mysql_error());
echo "<table id=\"pending-table\">";
echo "<tr> <th> Email </th> <th style=\"padding:10px\"> IP </th> <th style=\"padding:10px\"> Date</th> </tr>";

foreach($result as $entry)
{
if ($entry->approved==0)
{echo "<tr id=\"$entry->email\" class=\"record\" style=\"tr:hover{background-color: red;}\"onclick=\"get_profile(this);\"><td>".$entry->email."</td>";
echo "<td style=\"padding:10px\">".$entry->ip."</td>";
echo "<td style=\"padding:10px\">".$entry->sub_date."</td>";
}
}
echo "</table>";


?>

<div id="record-container" style="margin: 0 auto; width: auto; height: auto;">
</div>