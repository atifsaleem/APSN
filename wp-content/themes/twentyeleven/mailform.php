
	<div id="mail-form">
	
		<h1><a>Mail</a></h1>
	
		<form id="mail_form" class="appnitro"  method="post" action="wp-content/themes/twentyeleven/send-mail.php">
					<div class="form_description">
			<h2>Mail Form</h2>
			<p>Fill up the form to send an email to the user</p>
		</div>						
			<ul >
			
					<li id="li_1" >

		<label class="description" for="to">To </label>
		<div>
		<?php
		$email=$_GET['email'];
		$email=substr($email,0,-6);
		echo "<input id=\"to\" name=\"to\" class=\"element text medium\" type=\"text\" maxlength=\"255\" value=\"$email\"/>";
		?>
		</div> 
		</li>		<li id="li_2" >
		<label class="description" for="subject">Subject </label>
		<div>
			<input id="subject" name="subject" class="element text medium" type="text" maxlength="255" value=""/> 
		</div> 
		</li>		<li id="li_3" >
		<label class="description" for="message">Message </label>
		<div>
			<textarea id="message" name="message" class="element textarea medium"></textarea> 
		</div> 
		</li>
			
					<li class="buttons">
			    <input type="hidden" name="form_id" value="288041" />
			    <?php echo "<input type=\"hidden\" id=\"page-id\" name=\"page-id\" value=".$_GET['page']." />" ;?>

				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
		</li>
			</ul>
		</form>	