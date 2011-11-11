<?php wp_enqueue_script("jquery"); ?>
<?php
wp_head();
?>
<head>
    <style>
        #displaybox {
            z-index: 5;
            filter: alpha(opacity=95); /*older IE*/
            filter: progid:DXImageTransform.Microsoft.Alpha(opacity=95); /* IE */
            -moz-opacity: .95; /*older Mozilla*/
            -khtml-opacity: 0.95;   /*older Safari*/
            opacity: 0.95;   /*supported by current Mozilla, Safari, and Opera*/
            background-color:white;
            overflow-x:auto;overflow-y:scroll; 
            position:fixed; top:0px; left:0px; width:100%; height:100%; color:#FFFFFF; text-align:center; vertical-align:middle;
        }
        div.content {
            z-index: 4;
            filter: alpha(opacity=95); /*older IE*/
            filter: progid:DXImageTransform.Microsoft.Alpha(opacity=95); /* IE */
            -moz-opacity: .95; /*older Mozilla*/
            -khtml-opacity: 0.95;   /*older Safari*/
            opacity: 0.95;   /*supported by current Mozilla, Safari, and Opera*/
            background-color:#c8d3fe;
            text-align: left;
            margin: 0 auto;
            -webkit-box-shadow: 10px 10px 5px #888888;
            box-shadow: 0px 0px 20px 5px rgba(0, 0, 0, 0.7);
            border-style: groove; border-radius: 10px; border-color: grey; border-width: medium;
            position:absolute; top:5%; left:20%; right:20%; width:auto; height:auto; color:#FFFFFF; text-align:center; vertical-align:middle;
        }
    </style>
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
            window.open('https://localhost/apsn/?page_id=52&eventID='+id,'_self');
        }
    </script>
</head>

<?php
echo "<table class=\"linked\" width=100% id=\"event-type\">";
echo "<tr class=\"record\" style=\"tr:hover{color: red;}\">
    <td id=\"past_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Past Events</td>";
echo "<td class=\"selected\"id=\"current_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Current Events</td>";
echo "<td id=\"future_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Future Events</td>";
echo "</table>";
?>
<div id="displaybox" style="display: none;"></div>
<div id="contentbox" style="display: none;"></div>
<div id="record-container" style=" margin: 0 auto; width: auto; height: auto;"></div>