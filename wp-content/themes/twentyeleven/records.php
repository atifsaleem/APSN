<style type="text/css">
div#primary{background:white;}
</style>
<?php wp_enqueue_script("jquery"); ?>
<?php wp_head(); 
$message=$_GET['message'];
$to=$_GET['email'];
$login=$_GET['login'];
if ($message==1): ?>
<script type="text/javascript">
$j=jQuery.noConflict();
<?php echo "var email=\"$to\";"; ?>
$j.Growl.show("Email has been sent to "+email, {
	//settings
	"icon": "star",
	"title": "Email has been sent!",
	"cls": "",
	"speed": 500,
	"timeout": 3000
});
</script>
<?php endif; ?>
<?php if ($message==2):?>
<script type="text/javascript">
$j=jQuery.noConflict();
<?php echo "var login=\"$login\";"; ?>
$j.Growl.show("Volunteer "+login+" has been approved", {
	//settings
	"icon": "star",
	"title": "Volunteer Approval!!",
	"cls": "",
	"speed": 500,
	"timeout": 3000
});
</script>
<?php endif; ?>
<script type="text/javascript">
var $j = jQuery.noConflict();
<?php
echo "var page_id=$post->ID;";
?>

function email(e)
{
$j.get("wp-content/themes/twentyeleven/mailform.php?page="+page_id+"&email="+e.id,function(data)
{
$j(data).modal();
}
);
}
function close_record(e)
{ 
$j("#record-container").html("");
}

function get_profile(e) 
{
var id= e.id;

$j.get('wp-content/themes/twentyeleven/recordproc.php?email='+id,function(data){
$j("#record-container").html(data);
  });

//alert(data);

}

function reject(e)
{
var id=e.id;
$j.get("wp-content/themes/twentyeleven/recordreject.php?email="+id, function(data)
{

}
);
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
{ 
$j('table').hide();
$j('#approve-container').html(data);
window.location = "http://localhost/apsn/?page_id=2&message=2&login="+login;
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
echo "<div id=\"table-container\">";
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
echo "</div>"

?>

<div id="record-container" style="margin: 0 auto; width: auto; height: auto;">
</div>
<div id="approve-container" style="display: none;">
</div>