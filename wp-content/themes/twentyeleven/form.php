<?php
$path=get_bloginfo('template_directory');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$path"."/view.css\" media=\"all\">";
/*
Disappearing header and site title is a result of clashing of stylesheets, fix this in the end
*/
echo "<script type=\"text/javascript\" src=\"$path"."/view.js\"></script>";
echo "<script type=\"text/javascript\" src=\"$path"."/calendar.js\"></script>";

?>
<script type="text/javascript">
function change() 
{
<?php
$path=get_bloginfo('template_directory');
echo "var path=\"$path\";\n";

?>
$j=jQuery.noConflict();
if($j("#singleorproject").val()==1)
{
$j("#project-container").css('display','none');
$j("#sessions").css('display','none');
$j("#repeat-container").css('display','none');
$j(".repeat-days").css("display","none");
$j(".repeat-weeks").css("display","none");
$j(".month-repeat").css("display","none");
$j("#single-container").css('display','inline');
}
else 
{
$j("#single-container").css('display','none');
$j("#project-container").css('display','inline');
}
}
</script>


<script type="text/javascript">
function generateSessions()

{
<?php
$path=get_bloginfo('template_directory');
echo "var path=\"$path\";\n";
?>

$j=jQuery.noConflict();
if ($j("#singleorproject").val()==1)
{

var mm=$j("#element_6_1").val();
var dd=$j("#element_6_2").val();
var yy=$j("#element_6_3").val();
var sthh=$j("#element_7_1").val();
var stmm=$j("#element_7_2").val();
var stss=$j("#element_7_3").val();
var stam=$j("#element_7_4").val();
var enhh=$j("#element_8_1").val();
var enmm=$j("#element_8_2").val();
var enss=$j("#element_8_3").val();
var enam=$j("#element_8_4").val();
var details=new Object();
details= {month: mm,
day: dd,
year: yy,
sthour: sthh,
stmin: stmm,
stsec: stss,
sttim: stam,
enhour: enhh,
enmin: enmm,
ensec: enss,
entim: enam};
$j.post(path+"/event-single.php", details, function(data)
{$j("#sessions").css('display','inline');
$j("#sessions").html(data);}
);
}

if ($j("#singleorproject").val()==1)
{

var mm=$j("#element_11_1").val();
var dd=$j("#element_11_2").val();
var yy=$j("#element_11_3").val();
var sthh=$j("#element_12_1").val();
var stmm=$j("#element_12_2").val();
var stss=$j("#element_12_3").val();
var stam=$j("#element_12_4").val();
var enhh=$j("#element_17_1").val();
var enmm=$j("#element_17_2").val();
var enss=$j("#element_17_3").val();
var enam=$j("#element_17_4").val();
var mm=$j("#element_11_1").val();
var dd=$j("#element_11_2").val();
var yy=$j("#element_11_3").val();
var enmm=$j("#element_11_1").val();
var endd=$j("#element_11_2").val();
var enyy=$j("#element_11_3").val();

var details=new Object();
details= {month: mm,
day: dd,
year: yy,
sthour: sthh,
stmin: stmm,
stsec: stss,
sttim: stam,
enhour: enhh,
enmin: enmm,
ensec: enss,
entim: enam,
enmonth: enmm,
enday: endd,
enyear: enyy};
$j.post(path+"/recursive-project.php", details, function(data)
{$j("#sessions").css('display','inline');
$j("#sessions").html(data);}
);
}

if ($j("#recursive").val()==2)
{
var numSessions= $j("#element_9").val();

var session;
$j.get(path+"/non-recursive-project.php?numSessions="+numSessions,function(data){
$j("#sessions").css('display','inline');
$j("#sessions").html(data);
});

}

}
</script>


	<img id="top" src="top.png" alt="">
	<div id="form_container">
	
		<h1><a>Create Event</a></h1>
		<form id="form_284569" class="appnitro"  method="post" action="">
					<div class="form_description">
			<h2>Create Event</h2>
			<p>Fill out the following details to create a new event</p>
		</div>						
			<ul >
			
					<li id="li_1" >
		<label class="description" for="element_1">Name </label>
		<div>
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
		</div><p class="guidelines" id="guide_1"><small>Name of Event</small></p> 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Description </label>
		<div>
			<textarea id="element_2" name="element_2" class="element textarea medium"></textarea> 
		</div><p class="guidelines" id="guide_2"><small>Description of event</small></p> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">Venue </label>
		<div>
			<textarea id="element_3" name="element_3" class="element textarea medium"></textarea> 
		</div><p class="guidelines" id="guide_3"><small>Where is it going to be held?</small></p> 
		</li>		<li id="li_4" >
		<label class="description" for="element_4">Organizer </label>
		<span>
			<input id="element_4_1" name="element_4" class="element radio" type="radio" value="1" />
<label class="choice" for="element_4_1">Chaoyang School</label>
<input id="element_4_2" name="element_4" class="element radio" type="radio" value="2" />
<label class="choice" for="element_4_2">Katong School</label>
<input id="element_4_3" name="element_4" class="element radio" type="radio" value="3" />
<label class="choice" for="element_4_3">Tanglin School</label>
<input id="element_4_4" name="element_4" class="element radio" type="radio" value="4" />
<label class="choice" for="element_4_4">Delta Senior School</label>
<input id="element_4_5" name="element_4" class="element radio" type="radio" value="5" />
<label class="choice" for="element_4_5">Centre for Adults</label>

		</span><p class="guidelines" id="guide_4"><small>Select the Organizer</small></p> 
		</li>		<li id="li_5" >
		<label class="description" for="element_5">Type of Event </label>
		<div>
		<select class="element select medium" id="singleorproject" name="element_5" onchange="change();"> 
			<option value="" selected="selected"></option>
<option id="single" value="1" >Single</option>
<option id="project" value="2" >Project</option>

		</select>
		</div> 
		</li>
	<div id="single-container" style="height:auto; display: none;">
						<li id="li_6" >
		<label class="description" for="element_6">Date </label>
		<span>
			<input id="element_6_1" name="element_6_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_1_1">MM</label>
		</span>
		<span>
			<input id="element_6_2" name="element_6_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_1_2">DD</label>
		</span>
		<span>
	 		<input id="element_6_3" name="element_6_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_1_3">YYYY</label>
		</span>
	
		<span id="calendar_1">
		<?php
$path=get_bloginfo('template_directory');

			echo "<img id=\"cal_img_1\" class=\"datepicker\" src=\"$path"."/calendar.gif\" alt=\"Pick a date.\">";	
			?>
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_1_3",
			baseField    : "element_1",
			displayArea  : "calendar_1",
			button		 : "cal_img_1",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li_7" >
		<label class="description" for="element_7">Start Time </label>
		<span>
			<input id="element_7_1" name="element_7_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element_7_2" name="element_7_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element_7_3" name="element_7_3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element_7_4" name="element_7_4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>		<li id="li_8" >
		<label class="description" for="element_8">End Time </label>
		<span>
			<input id="element_8_1" name="element_8_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element_8_2" name="element_3_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element_8_3" name="element_8_3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element_8_4" name="element_8_4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
	
	 </div>
	 <div id="project-container" style="height: auto; display:none;">
	 <script type="text/javascript">
function changeRepeat()
{
$j=jQuery.noConflict();

if ($j("#recursive").val()==1)
{
<?php
$path=get_bloginfo('template_directory');
echo "var path=\"$path"."/repeat.php\"\n";
?>
$j("#sessions").css('display','none');
$j("#repeat-container").css('display','inline');
}
else
{$j("#sessions").css('display','none');
$j("#repeat-container").css('display','none');
}
}
</script>

					<li id="li_9" >
		<label class="description" for="element_9">Recursive Event? </label>
		<div>
		<select class="element select medium" id="recursive" name="element_9" onchange="changeRepeat();"> 
			<option value="" selected="selected"></option>
<option value="1" id="yes">Yes</option>
<option value="2" >No</option>

		</select>
		</div> 
		</li>		<li id="li_9" >
		<label class="description" for="element_9">No. of Sessions </label>
		<div>
			<input id="element_9" name="element_9" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>

	 </div>
	<div id="repeat-container" style="height:auto; display: none;">
	<script type="text/javascript">
function changeRecurrence()
{
if ($j("#howoften").val()==2)
{
$j(".month-repeat").css("display","none");
$j(".repeat-days").css("display","inline");
$j(".repeat-weeks").css("display","inline");

}
else if ($j("#howoften").val()==3)
{
$j(".repeat-days").css("display","none");
$j(".repeat-weeks").css("display","none");
$j(".month-repeat").css("display","inline");
}
}
</script>
						<li id="li_5" >
		<label class="description" for="element_10">How Often? </label>
		<div>
		<select class="element select medium" id="howoften" name="element_10" onchange="changeRecurrence();"> 
			<option value="" selected="selected"></option>
<option value="1" id="daily" >Daily</option>
<option value="2" id="weekly">Weekly</option>
<option value="3" id="monthly">Monthly</option>

		</select>
		</div> 
		</li>		<li id="li_11" >
		<label class="description" for="element_11">Start Repeat </label>
		<span>
			<input id="element_11_1" name="element_11_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_11_11">MM</label>
		</span>
		<span>
			<input id="element_11_2" name="element_11_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_1_2">DD</label>
		</span>
		<span>
	 		<input id="element_11_3" name="element_11_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_11_3">YYYY</label>
		</span>
	
		<span id="calendar_2">
			<img id="cal_img_2" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_11_3",
			baseField    : "element_11",
			displayArea  : "calendar_11",
			button		 : "cal_img_11",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li_12" >
		<label class="description" for="element_12">Start Time </label>
		<span>
			<input id="element_12_1" name="element_12_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element_12_2" name="element_12_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element_12_3" name="element_12_3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element_12_4" name="element_12_4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
		<li id="li_17" >
		<label class="description" for="element_17">End Time </label>
		<span>
			<input id="element_17_1" name="element_17_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element_17_2" name="element_17_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element_17_3" name="element_17_3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element_17_4" name="element_17_4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
				<li id="li_13" >
		<label class="description" for="element_13">End Repeat </label>
		<span>
			<input id="element_13_1" name="element_13_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_3_1">MM</label>
		</span>
		<span>
			<input id="element_13_2" name="element_13_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_13_2">DD</label>
		</span>
		<span>
	 		<input id="element_13_3" name="element_13_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_13_3">YYYY</label>
		</span>
	
		<span id="calendar_13">
			<img id="cal_img_13" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_13_3",
			baseField    : "element_13",
			displayArea  : "calendar_13",
			button		 : "cal_img_13",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li_14" class="repeat-days" style="display:none;">
		<label class="description" for="element_14">Repeat Days </label>
		<span>
			<input id="element_14_1" name="element_14_1" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_1">Saturday</label>
<input id="element_14_2" name="element_14_2" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_2">Sunday</label>
<input id="element_14_3" name="element_14_3" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_3">Monday</label>
<input id="element_14_4" name="element_14_4" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_4">Tuesday</label>
<input id="element_14_5" name="element_14_5" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_5">Wednesday</label>
<input id="element_14_6" name="element_14_6" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_6">Thursday</label>
<input id="element_14_7" name="element_14_7" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_14_7">Friday</label>

		</span> 
		</li>		<li id="li_15" class="repeat-weeks" style="display:none;">
		<label class="description" for="element_15">Weeks to repeat </label>
		<span>
			<input id="element_15_1" name="element_15_1" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_15_1">First</label>
<input id="element_15_2" name="element_15_2" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_15_2">Second</label>
<input id="element_15_3" name="element_15_3" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_3">Third</label>
<input id="element_15_4" name="element_15_4" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_4">Fourth</label>
<input id="element_15_5" name="element_15_5" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_5">Last</label>
<input id="element_15_6" name="element_15_6" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_6">All</label>

		</span> 
		</li>		<li id="li_16" class="month-repeat" style="display:none;">
		<label class="description" for="element_16">Day of the Month </label>
		<span>
			<input id="element_16_1" name="element_16_1" class="element text" size="2" maxlength="2" value="" type="text"> 
			<label for="element_16_1">DD</label>
		</span>
		<span id="calendar_16">
			<img id="cal_img_16" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_16_1",
			baseField    : "element_16",
			displayArea  : "calendar_16",
			button		 : "cal_img_16",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectEuropeDate
			});
		</script>
		 
		</li>
	</div>
	<div id="sessions"></div>
					<li class="buttons">
			    <input type="hidden" name="form_id" value="284569" />
			    
	<!--			<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" /> !-->
	<p id="generate-sessions" style="background:black ; color: white; width: 50px; cursor: pointer;" onclick="generateSessions();">Submit!</p>
		</li>
			</ul>
		
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">