<?php

$i = $_GET['sessionID'];
echo <<<ELEMENT
<ul >
			
    <li class="section_break">
        <h3>Session $i
    <p class="alignright">
        <input id="delete-$i" name="delete-$i" class="element checkbox" style="display:inline; margin:8px 0 0 3px;" type="checkbox" value="1" />
        <strong>Delete Session</strong>
    </p></h3>
    </li>		
    <li id="li-$i-1" >
	<label class="description" for="session-$i-1">Date </label>
	<span>
            <input id="session-$i-1-1" name="session-$i-1-1" class="element text" size="2" maxlength="2" value="" type="text"> /
                <label for="session-$i-1-1">MM</label>
	</span>
	<span>
            <input id="session-$i-1-2" name="session-$i-1-2" class="element text" size="2" maxlength="2" value="" type="text"> /
                <label for="session-$i-1-2">DD</label>
		</span>
		<span>
	 		<input id="session-$i-1-3" name="session-$i-1-3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="session-$i-1-3">YYYY</label>
		</span>
	
		<span id="calendar-$i-1">
			<img id="cal_img-$i-2" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "session-$i-1-3",
			baseField    : "session-$i-1",
			displayArea  : "calendar-$i-1",
			button		 : "cal_img-$i-1",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li-$i-2" >
		<label class="description" for="session-$i">Start Time </label>
		<span>
			<input id="session-$i-2-1" name="session-$i-2-1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="session-$i-2-2" name="session-$i-2-2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="session-$i-2-3" name="session-$i-2-3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="session-$i-2-4" name="session-$i-2-4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
		</ul>	
		<br>
		<li id="li-session-$i-3">
		<label class="description" for="session-$i-1">End Time </label>
		<span>
			<input id="session-$i-3-1" name="session-$i-3-1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="session-$i-3-2" name="session-$i-3-2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="session-$i-3-3" name="session-$i-3-3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="session-$i-3-4" name="session-$i-3-4">
			
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
ELEMENT;
//echo "<input type=\"hidden\" name=\"numSessions\" id=\"numSessions\" value=$numSessions></input>";
?>