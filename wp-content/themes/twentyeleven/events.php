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
            var thediv=document.getElementById('displaybox');
            if(thediv.style.display == "none"){
                thediv.style.display = "";
                var x = "<div class=\"content\" id=\"contentbox\">";
                //$var="<div class=\"content\" id=\"contentbox\">";
                $j.get('wp-content/themes/twentyeleven/eventproc.php?eventID='+id,function(data){
                    //$j("#contentbox").html(data);
                    x+=data;
                    x+="<button onclick='return signup(this);'>Close</button></div>";
                    thediv.innerHTML = x;
                    //alert(x);
                });
                
                //thediv.innerHTML = "<div class=\"content\" id=\"contentbox\">"+$data+"<a href='#' onclick='return signup(this);'>CLOSE WINDOW</a></div>";
            }
            else{
                thediv.style.display = "none";
                thediv.innerHTML = '';
            }
            return false;
        }
        function withdraw(e,eventID){
            if(confirm("Are you sure you wish to wishdraw your application. Once withdrawn you will be placed last on the waiting list."))
                $j.get('wp-content/themes/twentyeleven/signup_withdraw.php?eventID='+eventID+'&email='+e.id,function(data){
                    //$j("#contentbox").html(data);
                    alert(data);
                    signup(this);
                });
               else;
        }
        function register(e,eventID){
            var email = e.id;
            if(confirm("Are you sure you wish to sign up for this event"))
            $j.get('wp-content/themes/twentyeleven/signup_volunteers.php?eventID='+eventID+'&email='+email,function(data){
                    //$j("#contentbox").html(data);
                    alert(data);
                    signup(this);
                });
            else;
        }
    </script>
</head>

<?php
echo "<table class=\"options\"width=100% id=\"event-type\">";
echo "<tr class=\"record\" style=\"tr:hover{color: red;}\">
    <td id=\"past_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Past Events</td>";
echo "<td class=\"selected\"id=\"current_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Current Events</td>";
echo "<td id=\"future_events\" style=\"padding:10px\" onclick=\"get_events(this);\">Future Events</td>";
echo "</table>";
?>
<div id="displaybox" style="display: none;"></div>
<div id="contentbox" style="display: none;"></div>
<div id="record-container" style=" margin: 0 auto; width: auto; height: auto;"></div>