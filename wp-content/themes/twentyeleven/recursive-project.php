<?php
function return_week($a)
{
$i=1;
while ($a>(7*$i))
$i=$i+1;
return $i;
}
function get_session($timestamp_session,$session_end,$i)
{ 
$date=date('m d Y g i s a',$timestamp_session);
$date_end=date('g i s a', $session_end);
$date=explode(" ",$date);
$date_end=explode(" ",$date_end);
if ($date[6]=="AM")
				{$sttim=<<<STTIM
				<option value="AM" selected="selected">AM</option>
				<option value="PM" >PM</option>
STTIM;
				}
				else
				{
				$sttim=<<<STTIM
				<option value="AM">AM</option>
				<option value="PM" selected="selected">PM</option>
STTIM;
				}

if ($date_end[4]=="AM")
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
		<li id="li-session-$id-3">
		<label class="description" for="session-$i-1">End Time </label>
		<span>
			<input id="session-$i-3-1" name="session-$i-3-1" class="element text " size="2" type="text" maxlength="2" value="$date_end[0]"/> : 
			<label>HH</label>
		</span>
		<span>
			<input id="session-$i-3-2" name="session-$i-3-2" class="element text " size="2" type="text" maxlength="2" value="$date_end[1]"/> : 
			<label>MM</label>
		</span>
		<span>
			<input id="session-$i-3-3" name="session-$i-3-3" class="element text " size="2" type="text" maxlength="2" value="$date_end[2]"/>
			<label>SS</label>
		</span>
		<span>
			<select class="element select" style="width:4em" id="session-$i-3-4" name="session-$i-3-4">
			$entim
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

$start_date=$month."/".$day."/".$year." $sthour:$stmin:$stsec $sttim";
$start_end_time=$month."/".$day."/".$year." $enhour:$enmin:$ensec $entim";
$end_date=$enmonth."/".$enday."/".$enyear." $sthour:$stmin";
$endcompare="$enmonth/$enday/$enyear";
$timestamp_beginning=strtotime($start_date);
$timestamp_endtime=strtotime($start_end_time);
$timestamp_end=strtotime($end_date);
$session_date=$timestamp_beginning;
$session_end=$timestamp_endtime;
$i=1;
$str=get_session($session_date,$session_end,$i);
echo $str;
$all=0;
foreach($repeat_weeks as $repeat_week)
		{if (intval($repeat_week)==6)
			$all=1;
			}

$condition=0;
$present=0;

if ($howoften==2)
{ 
	while($session_date<$timestamp_end)
		{
		foreach($repeat_days as $repeat_day)
			{ 
			if ($week_map[$repeat_day]!="")
				{
				$session_date=strtotime("next $week_map[$repeat_day]",$session_date);
				$session_end=strtotime("next $week_map[$repeat_day]",$session_end);
				$d=intval(date('d',$session_date));
				$week_num=return_week($d);
				foreach($repeat_weeks as $repeat_week)
					{if (intval($repeat_week)==$week_num)
					$present=1;
					}
				if ($session_date>$timestamp_end)
					break;
				if ($present==1 || $all==1)
					{ $i+=1;
					$str=get_session($session_date,$session_end,$i);
					echo $str;}
				}
				$present=0;
			}
		}

}

if ($howoften==1)
{ 

while($session_date<$timestamp_end)
{ 
$session_date=strtotime("+1 day",$session_date);
$session_end=strtotime("+1 day",$session_end);
$i=$i+1;
$str=get_session($session_date,$session_end,$i);
echo $str;
}

}

if ($howoften==3)
{ 

while($session_date<$timestamp_end)
{ 
$session_date=strtotime("+1 month",$session_date);
$session_end=strtotime("+1 month",$session_end);
$i=$i+1;
if ($session_date<$timestamp_end)
{$str=get_session($session_date,$session_end,$i);
echo $str;
}
}
}
echo "<input type=\"hidden\" name=\"numSessions\" id=\"numSessions\" value=$i></input>";

?>