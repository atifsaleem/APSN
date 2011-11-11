<link rel="stylesheet" type="text/css" href="view.css" media="all">
<script type="text/javascript" src="view.js"></script>
<script type="text/javascript">
function changeRepeat()
{
$j=jQuery.noConflict();

if ($j("#yes:selected"))
{
<?php   $path=get_bloginfo('template_directory')."/forms/createEvent/repeat.php"
echo "var path=$path;"
?>
$j("#repeat-container").load(path);
}

}
</script>
	
			<ul >
			
					<li id="li_2" >
		<label class="description" for="element_2">Recursive Event? </label>
		<div>
		<select class="element select medium" id="element_2" name="element_2" onchange="changeRepeat();"> 
			<option value="" selected="selected"></option>
<option value="1" id="yes">Yes</option>
<option value="2" >No</option>

		</select>
		</div> 
		</li>		<li id="li_1" >
		<label class="description" for="element_1">No. of Sessions </label>
		<div>
			<input id="element_1" name="element_1" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>
