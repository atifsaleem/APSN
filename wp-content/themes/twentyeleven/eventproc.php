<?php
$keymap=array(
1=>"Chaoyang School",
2=>"Katong School",
3=>"Tanglin School",
4=>"Delta Senior School",
5=>"Centre for Adults");
include ('../../../wp-blog-header.php');
$path=get_bloginfo('template_directory');
global $wpdb;
get_header();
extract($_POST);
$wpdb->query("INSERT INTO event_details(name,description,organizer,venue,vacancies,sessions) VALUES ('$element_1','$element_2','$keymap[$element_4]','$element_3',$numSessions,$numVacancies)") or die(mysql_error());
$result=$wpdb->get_results("SELECT eventID FROM event_details WHERE `name`='$element_1'");

for ($k=1;$k<=$numSessions;$k++)
{$date="";
$start_time="";
$end_time="";
 for ($i=1;$i<=3;$i++)
	{ 
	
	for ($j=1;$j<=4;$j++)
		{
		if ($i==1 && $j<4)
		   {
		   	if ($_POST["session-$k-$i-$j"]!="")
			$date=$date.$_POST["session-$k-$i-$j"]."/";
			}
		else if ($i==2 && $j<4)
			{ if ($j==3)
			 $start_time=$start_time.$_POST["session-$k-2-$j"];
			  else
 			$start_time=$start_time.$_POST["session-$k-2-$j"].":";
 			   }
		else if ($i==2 && $j==4)
			{
			$start_time=$start_time." ".$_POST["session-$k-2-4"];
			}
	    else if ($i==3 && $j<4)
			{ if ($j==3)
			 $end_time=$end_time.$_POST["session-$k-2-$j"];
			  else
 			$end_time=$end_time.$_POST["session-$k-2-$j"].":";
 			   }
		else if ($i==3 && $j==4)
			{
			$end_time=$end_time." ".$_POST["session-$k-2-4"];
			}
		}
		
	}
$date = substr($date, 0, -1);
$timestamp=strtotime($date);
$date=date('Y-m-d',$timestamp);
$wpdb->query("INSERT INTO session_details VALUES (6,$k,'$date','$start_time','$end_time')");
}

echo "<div id=\"primary\">";
echo "<div id=\"content\" role=\"main\">";
echo "<p class=\"aligncenter\">The event has been created successfully</p>";
echo "</div>";
echo  "</div>";
get_footer();
?>