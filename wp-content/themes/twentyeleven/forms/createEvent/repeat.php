<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="calendar.js"></script>
<script type="text/javascript">
function changeRecurrence()
{
if ($j("#weekly:selected"))
{
$j(".month-repeat").css("display","none");
$j(".repeat-days .weeks-repeat").css("display","inline");
}
else if ($j("#monthly:selected"))
{
$j(".repeat-days .weeks-repeat").css("display","none");
$j(".month-repeat").css("display","inline");
}
}
</script>
				<ul >
			
					<li id="li_5" >
		<label class="description" for="element_5">How Often? </label>
		<div>
		<select class="element select medium" id="element_5" name="element_5" onchange="changeRecurrence"> 
			<option value="" selected="selected"></option>
<option value="1" id="daily" >Daily</option>
<option value="2" id="weekly">Weekly</option>
<option value="3" id="monthly">Monthly</option>

		</select>
		</div> 
		</li>		<li id="li_1" >
		<label class="description" for="element_1">Start Repeat </label>
		<span>
			<input id="element_1_1" name="element_1_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_1_1">MM</label>
		</span>
		<span>
			<input id="element_1_2" name="element_1_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_1_2">DD</label>
		</span>
		<span>
	 		<input id="element_1_3" name="element_1_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_1_3">YYYY</label>
		</span>
	
		<span id="calendar_1">
			<img id="cal_img_1" class="datepicker" src="calendar.gif" alt="Pick a date.">	
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
		 
		</li>		<li id="li_2" >
		<label class="description" for="element_2">Time </label>
		<span>
			<input id="element_2_1" name="element_2_1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element_2_2" name="element_2_2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element_2_3" name="element_2_3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element_2_4" name="element_2_4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>		<li id="li_3" >
		<label class="description" for="element_3">End Repeat </label>
		<span>
			<input id="element_3_1" name="element_3_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_3_1">MM</label>
		</span>
		<span>
			<input id="element_3_2" name="element_3_2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_3_2">DD</label>
		</span>
		<span>
	 		<input id="element_3_3" name="element_3_3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element_3_3">YYYY</label>
		</span>
	
		<span id="calendar_3">
			<img id="cal_img_3" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_3_3",
			baseField    : "element_3",
			displayArea  : "calendar_3",
			button		 : "cal_img_3",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li_6" class"repeat-days" style="display:none;">
		<label class="description" for="element_6">Repeat Days </label>
		<span>
			<input id="element_6_1" name="element_6_1" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_1">Saturday</label>
<input id="element_6_2" name="element_6_2" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_2">Sunday</label>
<input id="element_6_3" name="element_6_3" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_3">Monday</label>
<input id="element_6_4" name="element_6_4" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_4">Tuesday</label>
<input id="element_6_5" name="element_6_5" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_5">Wednesday</label>
<input id="element_6_6" name="element_6_6" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_6">Thursday</label>
<input id="element_6_7" name="element_6_7" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_6_7">Friday</label>

		</span> 
		</li>		<li id="li_7" class="weeks-repeat" style="display:none;">
		<label class="description" for="element_7">Weeks to repeat </label>
		<span>
			<input id="element_7_1" name="element_7_1" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_1">First</label>
<input id="element_7_2" name="element_7_2" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_2">Second</label>
<input id="element_7_3" name="element_7_3" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_3">Third</label>
<input id="element_7_4" name="element_7_4" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_4">Fourth</label>
<input id="element_7_5" name="element_7_5" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_5">Last</label>
<input id="element_7_6" name="element_7_6" class="element checkbox" type="checkbox" value="1" />
<label class="choice" for="element_7_6">All</label>

		</span> 
		</li>		<li id="li_4" class="month-repeat" style="display:none;">
		<label class="description" for="element_4">Day of the Month </label>
		<span>
			<input id="element_4_1" name="element_4_1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element_4_1">DD</label>
		</span>
		<span id="calendar_4">
			<img id="cal_img_4" class="datepicker" src="images/calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element_4_3",
			baseField    : "element_4",
			displayArea  : "calendar_4",
			button		 : "cal_img_4",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectEuropeDate
			});
		</script>
		 
		</li>