<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Create Event</title>
<?php
$path=get_bloginfo('template_directory');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$path"."/view.css\" media=\"all\">";
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
{$j("#single-container").load(path+'/single-event.php');
}
else 
{$j("#single-container").load(path+'/project-1.php');
}
}
</script>
</head>
<body id="main_body" >

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
	<div id="single-container" style="height:auto;"> </div>
	<div id="repeat-container" style="height:auto;"></div>

					<li class="buttons">
			    <input type="hidden" name="form_id" value="284569" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
		</div>
	</div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>