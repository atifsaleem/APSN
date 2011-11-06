<?php
include ('../../../wp-blog-header.php');
$path=get_bloginfo('template_directory');
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$path"."/view.css\" media=\"all\">";
echo "<script type=\"text/javascript\" src=\"$path"."/view.js\"></script>";
echo "<script type=\"text/javascript\" src=\"$path"."/jquery.js\">";
echo "</script>";
echo "<script type=\"text/javascript\" src=\"$path"."/calendar.js\">";
echo "</script>";
?>	
<script type="text/javascript">
function changeRepeat()
{
$j=jQuery.noConflict();

if ($j("#recursive").val()==1)
{
<?php
$path=get_bloginfo('template_directory');
echo "var path=\"$path"."/repeat.php\"\n";
?>
$j("#repeat-container").load(path);
}
else
$j("#repeat-container").html("");
}
</script>
	
			<ul >
			
					<li id="li_2" >
		<label class="description" for="element_2">Recursive Event? </label>
		<div>
		<select class="element select medium" id="recursive" name="element_2" onchange="changeRepeat();"> 
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
