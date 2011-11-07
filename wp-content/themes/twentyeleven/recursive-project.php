<?php
function get_session($timestamp_session,$i)
{
$date=date('m d Y g i s a',$timestamp_session);
$date=explode(" ",$date);
if ($date[6]=="AM")
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

$str= <<<ELEMENT

			
					<li class="section_break">
			<h3>Session $i</h3>
			<p></p>
		</li>		<li id="session-$i-1" >
		<label class="description" for="session-$i-1">Date </label>
		<span>
			<input id="session-$i-1-1" name="session-$i-1-1" class="element text" size="2" maxlength="2" value="$date[0]" type="text"> /
			<label for="session-$i-1-1">MM</label>
		</span>
		<span>
			<input id="session-$i-1-2" name="session-$i-1-2" class="element text" size="2" maxlength="2" value="$date[1]" type="text"> /
			<label for="session-$i-1-2">DD</label>
		</span>
		<span>
	 		<input id="session-$i-1-3" name="session-$i-1-3" class="element text" size="4" maxlength="4" value="$date[2]" type="text">
			<label for="session-$i-1-3">YYYY</label>
		</span>
	
		<span id="calendar-session-$i-1">
			<img id="cal_img-1" class="datepicker" src="calendar.gif" alt="Pick a date.">	
		</span>
		<script type="text/javascript">
			Calendar.setup({
			inputField	 : "session-$i-1-3",
			baseField    : "session-$i-1",
			displayArea  : "calendar-session-$i-1",
			button		 : "cal_img-1",
			ifFormat	 : "%B %e, %Y",
			onSelect	 : selectDate
			});
		</script>
		 
		</li>		<li id="li-session-$i-2" >
		<label class="description" for="session-$i-1">Start Time </label>
		<span>
			<input id="session-$i-2-1" name="session-$i-2-1" class="element text " size="2" type="text" maxlength="2" value="$date[3]"/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="session-$i-2-2" name="session-$i-2-2" class="element text " size="2" type="text" maxlength="2" value="$date[4]"/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="session-$i-2-3" name="session-$i-2-3" class="element text " size="2" type="text" maxlength="2" value="$date[5]"/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="session-$i-2-4" name="session-$i-2-4">
			$sttim
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
		<li id="li-session-$id-3" style="display:none;">
		<label class="description" for="session-$i-1">End Time </label>
		<span>
			<input id="session-$i-3-1" name="session-$i-3-1" class="element text " size="2" type="text" maxlength="2" value="$date[3]"/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="session-$i-3-2" name="session-$i-3-2" class="element text " size="2" type="text" maxlength="2" value="$date[4]"/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="session-$i-3-3" name="session-$i-3-3" class="element text " size="2" type="text" maxlength="2" value="$date[5]"/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="session-$i-3-4" name="session-$i-3-4">
			$sttim
			</select>
			<label>AM/PM</label>
		</span> 
		</li>
ELEMENT;
return $str;
}

$week_map=array("1"=>"Saturday", 
"2"=>"Sunday",
"3"=>"Monday",
"4"=>"Tuesday",
"5"=>"Wednesday",
"6"=>"Thursday",
"7"=>"Friday");

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
$enmonth=$_POST['enmonth'];
$enday=$_POST['enday'];
$enyear=$_POST['enyear'];
$howoften=$_POST['howoften'];
$repeat_days=explode("-",$_POST['days']);
$repeat_weeks=explode("-",$_POST['weeks']);
$repeat_month=$_POST['months'];

$start_date=$month."/".$day."/".$year." $sthour:$stmin";
$end_date=$enmonth."/".$enday."/".$enyear." $sthour:$stmin";
$endcompare="$enmonth/$enday/$enyear";
$timestamp_beginning=strtotime($start_date);
$timestamp_end=strtotime($end_date);
$session_date=$timestamp_beginning;
$condition=0;
$i=0;

if ($howoften==2)
{
	while($session_date<$timestamp_end)
		{
		foreach($repeat_days as $repeat_day)
			{ 
			if ($week_map[$repeat_day]!="")
				{
				$session_date=strtotime("next $week_map[$repeat_day]",$session_date);
				if ($session_date>$timestamp_end)
				break;
				$i+=1;
				$str=get_session($session_date,$i);
				echo $str;
				}
				
			}
		}

}

?>