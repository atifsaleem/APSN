<?php
$path = get_bloginfo('template_directory');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$path" . "/view.css\" media=\"all\">";
/*
  Disappearing header and site title is a result of clashing of stylesheets, fix this in the end
 */
echo "<script type=\"text/javascript\" src=\"$path" . "/view.js\"></script>";
echo "<script type=\"text/javascript\" src=\"$path" . "/calendar.js\"></script>";
?>
<?php
//include ('../../../wp-blog-header.php');
global $wpdb;
$eventID = $_GET['eventID'];
$event = $wpdb->get_row("SELECT * FROM event_details WHERE `eventID`='$eventID'");
?>

<script type="text/javascript">
    var numSessions= <?php echo $event->sessions; ?>;
    $j=jQuery.noConflict();
<?php
$path = get_bloginfo('template_directory');
echo "var path=\"$path\";\n";
?>
    function addSession()
    {
        $j.get(path+"/new-session.php?sessionID="+(numSessions+1),function(data){
            $j("#sessions").append(data);
        });
        numSessions++;
    }

    function generateSessions()
    {
        var eventID = <?php echo $eventID; ?>;
        $j.get(path+"/edit_sessions.php?numSessions="+numSessions+"&eventID="+eventID, function(data) {
            $j("#sessions").css('display','block');
            $j("#sessions").html(data);
            //alert();
        });
        $j("#saveForm").css('display','inline');
    }
</script>

<body onLoad="generateSessions();">
    <div id="form_container">

        <h1><a>Edit Event</a></h1>
        <form id="form_284569" class="appnitro"  method="post" action="<?php $path = get_bloginfo('template_directory');
echo $path; ?>/event_update.php?eventID=<?php echo $eventID; ?>">
            <div class="form_description">
                <h2>Create Event</h2>
                <p>Edit the Following details in order to edit the event.</p>
            </div>						
            <ul >

                <li id="li_1" >
                    <label class="description" for="element_1">Name </label>
                    <div>
                        <input value="<?php echo $event->name; ?>" id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div><p class="guidelines" id="guide_1"><small>Name of Event</small></p> 
                </li>		
                <li id="li_2" >
                    <label class="description" for="element_2">Description </label>
                    <div>
                        <textarea id="element_2" name="element_2" class="element textarea medium"><?php echo $event->description; ?></textarea> 
                    </div><p class="guidelines" id="guide_2"><small>Description of event</small></p> 
                </li>		
                <li id="li_3" >
                    <label class="description" for="element_3">Venue </label>
                    <div>
                        <textarea id="element_3" name="element_3" class="element textarea medium"><?php echo $event->venue; ?></textarea> 
                    </div><p class="guidelines" id="guide_3"><small>Where is it going to be held?</small></p> 
                </li>		
                <li id="li_4" >
                    <label class="description" for="element_4">Organizer </label>
                    <div>
                        <span>
                            <select class="element select medium" id="element_4" name="element_4"> 
                                <option value="" selected="selected"></option>
                                <option id="element_4_1" value="1" >Chaoyang School</option>
                                <option id="element_4_2" value="2" >Katong School</option>
                                <option id="element_4_3" value="3" >Tanglin School</option>
                                <option id="element_4_4" value="4" >Delta Senior School</option>
                                <option id="element_4_5" value="5" >Centre for Adults</option>
                            </select>
                        </span><p class="guidelines" id="guide_4"><small>Select the Organizer</small></p>
                    </div> 
                </li>

                <li id="li_5" >
                    <label class="description" for="element_5">Number of Vacancies </label>
                    <div>
                        <input value="<?php echo $event->vacancies; ?>" id="numVacancies" name="numVacancies" class="element text medium" type="text" maxlength="255" value=""/> 
                    </div><p class="guidelines" id="guide_1"><small>Enter the maximum number of vacancies</small></p> 
                </li>
                <li>
                    <div id="sessions">
                        <input type="hidden" name="numSessions" id="numSessions" value=4 />
                    </div>
                </li>
                <li class="buttons">
                    <input type="hidden" name="form_id" value="284569" />
                    <p id="add-sessions" style="background:black ; color: white; width: 120px; cursor: pointer; margin:0 auto;" onclick="addSession();">Add a Session</p>
                </li>
            </ul>
            <input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" style="display:none;"/>
        </form>
    </div>
</body>