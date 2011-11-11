<?php
global $wpdb;
$eventID = $_GET['eventID'];
?>
<head>
    <script type="text/javascript">
        var $j = jQuery.noConflict();
<?php echo"var eventID=" . $eventID; ?>;
        function edit(){
            window.open("<?php echo get_permalink(56); ?>"+"&eventID="+eventID,'_self');
        }
        function view(e){
            var thediv=document.getElementById('displaybox');
            if(thediv.style.display == "none"){
                thediv.style.display = "";
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
        //alert(eventID+" "+sessionID);
        var thediv=document.getElementById('attendancebox');
        if(thediv.style.display == "none"){
            thediv.style.display = "";
<?php echo"var eventID=" . $eventID; ?>;
            $j.get('wp-content/themes/twentyeleven/mark_attendance.php?eventID='+eventID+"&sessionID="+sessionID,function(data){
                //$j("#attendancebox").html(data);
                thediv.innerHTML = data;
                //alert(data);
            });
            //thediv.innerHTML = "<div class=\"content\" id=\"contentbox\"><a href='#' onclick='return view(this);'>CLOSE WINDOW</a></div>";
        }
        else{
            thediv.style.display = "none";
            thediv.innerHTML = '';
        }
    }
    </script>
</head>
<body>
    <div class="actions">
        <ul id="navigation">
            <li class="one"><a onClick="view('confirmed');">View Attendees</a></li>
            <li class="two"><a onClick="view('wait');">View Wait-listed</a></li>
            <li class="three"><a onClick="edit();">Edit Event</a></li>
            <li class="four"><a onClick="">Close Registration</a></li>
            <li class="five"><a onClick="">Delete Event</a></li>
        </ul>
    </div>
    <hr></hr>
    <div id="displaybox" style="display: none;"></div>
    
<?php
//Displaying Events Info
$events = $wpdb->get_results("SELECT * FROM event_details WHERE eventID=$eventID") or die(mysql_error());
foreach ($events as $event)
    echo "<div class=\"event\"><strong id=\"title\">$event->name</strong><br>$event->date_from to $event->date_to<br>
        <strong>Venue</strong><br><p>$event->description</p><div id=\"sessions\" class=\"alignleft\" style=\"position:static; \">";

//Displaying Sessions Info
if ($event->sessions > '1') {
    echo "<strong>Session Info : </strong><br>";
    echo"<table id=\"session-details\"class=\"data\" style=\"margin-left:20px;\"><tr><th>Session No.</th><th>Date</th>";
    $sessions = $wpdb->get_results("SELECT * FROM session_details WHERE eventID=$eventID");
    foreach ($sessions as $session) {
        echo"<tr id=\"$session->sessionID\" onClick=\"attendance($eventID,this);\" style=\"tr:hover{color: red;}\"><td>Session $session->sessionID</td><td>$session->date</td></tr>";
    }
    echo"</table>";
}
echo"</div><div id=\"attendancebox\" style=\"display: none;\"></div></div>"
?>
</body>