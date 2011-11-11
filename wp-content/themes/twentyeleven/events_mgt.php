<?php wp_enqueue_script("jquery"); ?>
<?php
wp_head();
?>
<head>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
        function get_events(e) 
        {
            var id= e.id;
            
            $j.get('wp-content/themes/twentyeleven/event_type.php?type='+id,function(data){
                $j("#record-container").html(data);
                //alert();
            });
        }
    
        function signup(e)
        {
            var id=e.id;
            //alert(id);
            window.open("<?php echo get_permalink(47); ?>"+"&eventID="+id,'_self');
        }
    </script>
</head>
<?php
echo "<table class=\"options\" width=100% id=\"event-type\">";
echo "<tr class=\"record\" style=\"tr:hover{color: red;}\">
    <td id=\"past_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Past Events</td>";
echo "<td id=\"current_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Current Events</td>";
echo "<td id=\"future_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Future Events</td>";
echo "</table>";
?>
<div id="displaybox" style="display: none;"></div>
<div id="contentbox" style="display: none;"></div>
<div id="record-container" style=" margin: 0 auto; width: auto; height: auto;"></div>