<?php
$month=$_POST['month'];
$day=$_POST['day'];
$year=$_POST['year'];
$sthour=$_POST['sthour'];
$stmin=$_POST['stmin'];
$stsec=$_POST['stsec'];
$sttim=$_POST['sttim'];
$enhour=$_POST['enhour'];
$enmin=$_POST['enmin'];
$ensec=$_POST['ensec'];
$entim=$_POST['entim'];
				if ($entim=="AM")
				{$entim=<<<ENTIM
				<option value="AM" selected="selected">AM</option>
				<option value="PM" >PM</option>
ENTIM;
				}
				else
				{
				$entim=<<<ENTIM
				<option value="AM">AM</option>
				<option value="PM" selected="selected">PM</option>
ENTIM;
				}
				if ($sttim=="AM")
				{$sttim=<<<ENTIM
				<option value="AM" selected="selected">AM</option>
				<option value="PM" >PM</option>
ENTIM;
				}
				else
				{
				$sttim=<<<ENTIM
				<option value="AM">AM</option>
				<option value="PM" selected="selected">PM</option>
ENTIM;
				}

echo <<<ELEMENT
<ul >
			
					<li class="section_break">
			<h3>Session 1</h3>
			<p></p>
		</li>		<li id="li-1" >
		<label class="description" for="element-1">Date </label>
		<span>
			<input id="element-1-1" name="element-1-1" class="element text" size="2" maxlength="2" value="$month" type="text"> /
			<label for="element-1-1">MM</label>
		</span>
		<span>
			<input id="element-1-2" name="element-1-2" class="element text" size="2" maxlength="2" value="$day" type="text"> /
			<label for="element-1-2">DD</label>
		</span>
		<span>
	 		<input id="element-1-3" name="element-1-3" class="element text" size="4" maxlength="4" value="$year" type="text">
			<label for="element-1-3">YYYY</label>
		</span>
	
		<span id="calendar-1">
			<img id="cal_img-1" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "element-1-3",
			baseField    : "element-1",
			displayArea  : "calendar-1",
			button		 : "cal_img-1",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li-2" >
		<label class="description" for="element-1">Start Time </label>
		<span>
			<input id="element-2-1" name="element-2-1" class="element text " size="2" type="text" maxlength="2" value="$sthour"/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element-2-2" name="element-2-2" class="element text " size="2" type="text" maxlength="2" value="$stmin"/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element-2-3" name="element-2-3" class="element text " size="2" type="text" maxlength="2" value="$stsec"/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element-2-4" name="element-2-4">
				$sttim;			</select>
			<label>AM/PM</label>
		</span> 
		</li>
		<li id="li-3" >
		<label class="description" for="element-1">End Time </label>
		<span>
			<input id="element-3-1" name="element-3-1" class="element text " size="2" type="text" maxlength="2" value="$enhour"/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="element-3-2" name="element-3-2" class="element text " size="2" type="text" maxlength="2" value="$enmin"/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="element-3-3" name="element-3-3" class="element text " size="2" type="text" maxlength="2" value="$ensec"/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="element-3-4" name="element-3-4">
			$entim;
			</select>
			<label>AM/PM</label>
		</span> 
		</li>

		</ul>	
		<br>
ELEMENT;

?>