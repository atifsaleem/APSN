<?php	
$numSessions=$_GET['numSessions'];
for ($i=1;$i<=$numSessions;$i=$i+2)
{ $j=$i+1;
echo <<<ELEMENT
<ul >
			
					<li class="section_break">
			<h3>Session $i</h3>
			<p></p>
		</li>		<li id="li-$i" >
		<label class="description" for="element-$i">Date </label>
		<span>
			<input id="element-$i-1" name="element-$i-1" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element-$i-1">MM</label>
		</span>
		<span>
			<input id="element-$i-2" name="element-$i-2" class="element text" size="2" maxlength="2" value="" type="text"> /
			<label for="element-$i-2">DD</label>
		</span>
		<span>
	 		<input id="element-$i-3" name="element-$i-3" class="element text" size="4" maxlength="4" value="" type="text">
			<label for="element-$i-3">YYYY</label>
		</span>
	
		<span id="calendar-$i">
			<img id="cal_img-$i" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element-$i-3",
			baseField    : "element-$i",
			displayArea  : "calendar-$i",
			button		 : "cal_img-$i",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li-$j" >
		<label class="description" for="element-$i">Time </label>
		<span>
			<input id="element-$j-1" name="element-$j-1" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element-$j-2" name="element-$j-2" class="element text " size="2" type="text" maxlength="2" value=""/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element-$j-3" name="element-$j-3" class="element text " size="2" type="text" maxlength="2" value=""/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element-$i-4" name="element-$i-4">
				<option value="AM" >AM</option>
				<option value="PM" >PM</option>
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
		</ul>	
		<br>
ELEMENT;
}
?>