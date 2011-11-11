<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Create Event</title>
<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript" src="jquery.js">
</script>
<script type="text/javascript">
function change() 
{
$j=jQuery.noConflict();
if ($j("#single:selected"))
{
<?php   $path=get_bloginfo('template_directory')."/forms/createEvent/single-event.php"
echo "var path=$path;"
?>
$j("#single-container").load(path);

}
else 
{
<?php   $path=get_bloginfo('template_directory')."/forms/createEvent/project-1.php"
echo "var path=$path;"
?>
$j("project-container").load(path);
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
		<select class="element select medium" id="element_5" name="element_5" onchange="change();"> 
			<option value="" selected="selected"></option>
<option id="single" value="1" >Single</option>
<option id="project" value="2" >Project</option>

		</select>
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="284569" />
			    
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	
		<div id="footer">
		</div>
	</div>
	<div id="single-container" style="height:auto;"> </div>
	<div id="project-container" style="height:auto;"></div>
	<div id="repeat-container" style="height:auto;"></div>
	<img id="bottom" src="bottom.png" alt="">
	</body>
</html>