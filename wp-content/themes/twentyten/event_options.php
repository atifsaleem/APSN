<?php
global $wpdb;
$eventID = $_GET['eventID'];
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
        function view(e){
            var thediv=document.getElementById('displaybox');
            if(thediv.style.display == "none"){
                thediv.style.display = "";
                <?php echo"var eventID=" . $eventID; ?>;
                var x = "<div class=\"content\" id=\"contentbox\">";
                $j.get('wp-content/themes/twentyeleven/view_participants.php?status='+e+'&eventID='+eventID,function(data){
                //$j("#contentbox").html(data);
                x+=data;
                x+="<button onclick='return view(this);'>Close</button></div>";
                thediv.innerHTML = x;
                //alert(data);
            });
            //thediv.innerHTML = "<div class=\"content\" id=\"contentbox\"><a href='#' onclick='return view(this);'>CLOSE WINDOW</a></div>";
        }
        else{
            thediv.style.display = "none";
            thediv.innerHTML = '';
        }
    }
    function attendance(eventID,e){
        var sessionID=e.id;
        alert(eventID+" "+sessionID);
    }
    </script>
</head>
<body>
    <a onClick="view('confirmed');">View Attendees</a>
    <a onClick="view('wait');">View Wait-listed</a>
    <a onClick="">Edit Event</a>
    <a onClick="">Close Registration</a>
    <a onClick="">Delete Event</a>
    <br>
    <div id="displaybox" style="display: none;"></div>
</body>
<?php
//Displaying Events Info
$events = $wpdb->get_results("SELECT * FROM event_details WHERE eventID=$eventID") or die(mysql_error());
foreach ($events as $event)
    echo "<strong size=6>$event->name</strong><p class=\"alignright\">$event->date_from to $event->date_to</p><br>
        <strong>Venue</strong><br><p>$event->description</p>";

//Displaying Sessions Info
if ($event->sessions > '1') {
    echo "<strong>Session Info : </strong><br>";
    echo"<table id=\"session-details\"class=\"linked\"><tr><th>Session No.</th><th>Date</th>";
    $sessions = $wpdb->get_results("SELECT * FROM session_details WHERE eventID=$eventID");
    foreach ($sessions as $session) {
        echo"<tr id=\"$session->sessionID\" onClick=\"attendance($eventID,this);\" style=\"tr:hover{color: red;}\"><td>Session $session->sessionID</td><td>$session->date</td></tr>";
    }
    echo"</table>";
}
?>