<?php
/*
Plugin Name: Osmig
Plugin URI: http://tmertz.com/projects/osmig
Description: A supersimple signup plugin.
Version: 1.0.1
Author: Thomas Mertz
Author URI: http://tmertz.com/
*/

$osmig_db_version = "1.0";
include("languages/" . get_option("osmig-language") . ".php");

####################################################################
#
# INSTALLATION
#
####################################################################
function osmig_install () {
	global $wpdb;
	global $osmig_db_version;

	$table_name = $wpdb->prefix . "osmig_fields";
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
				`id` MEDIUMINT( 11 ) NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR( 200 ) NOT NULL ,
				`slug` VARCHAR( 200 ) NOT NULL ,
				`type` VARCHAR( 10 ) NOT NULL ,
				`helptext` LONGTEXT NOT NULL ,
				`default` LONGTEXT NOT NULL ,
                                `code` LONGTEXT NOT NULL ,
				`ordering` INT( 2 ) NOT NULL ,
				PRIMARY KEY (  `id` ) ,
				INDEX (  `id` )
		);";
		
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
	
	$table_name = $wpdb->prefix . "osmig_signups";
	if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
		$sql = "CREATE TABLE " . $table_name . " (
				`id` MEDIUMINT( 11 ) NOT NULL AUTO_INCREMENT ,
				`replyToFieldID` MEDIUMINT( 11 ) NOT NULL ,
				`value` LONGTEXT NOT NULL ,
				`userkey` VARCHAR( 200 ) NOT NULL ,
				PRIMARY KEY (  `id` ) ,
				INDEX (  `id` )
		);";
				
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		add_option("osmig_db_version", $osmig_db_version);
	}
	
	$installed_ver = get_option( "osmig_db_version" );
	
	if( $installed_ver != $osmig_db_version ) {
		$table_name = $wpdb->prefix . "osmig_fields";
		$sql = "CREATE TABLE " . $table_name . " (
				`id` MEDIUMINT( 11 ) NOT NULL AUTO_INCREMENT ,
				`name` VARCHAR( 200 ) NOT NULL ,
				`slug` VARCHAR( 200 ) NOT NULL ,
				`type` VARCHAR( 10 ) NOT NULL ,
				`helptext` LONGTEXT NOT NULL ,
				`default` LONGTEXT NOT NULL ,
                                `code` LONGTEXT NOT NULL ,
				`ordering` INT( 2 ) NOT NULL ,
				PRIMARY KEY (  `id` ) ,
				INDEX (  `id` )
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		$table_name = $wpdb->prefix . "osmig_signups";
		$sql = "CREATE TABLE " . $table_name . " (
				`id` MEDIUMINT( 11 ) NOT NULL AUTO_INCREMENT ,
				`replyToFieldID` MEDIUMINT( 11 ) NOT NULL ,
				`value` LONGTEXT NOT NULL ,
				`userkey` VARCHAR( 200 ) NOT NULL ,
				PRIMARY KEY (  `id` ) ,
				INDEX (  `id` )
		);";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		update_option( "osmig_db_version", $osmig_db_version );
	  }
	  add_option("osmig-language", '255', '', 'no');
	  update_option("osmig-language","en");
}
register_activation_hook(__FILE__,'osmig_install');

####################################################################
#
# UNINSTALLATION
#
####################################################################
function osmig_uninstall() {
	global $wpdb;
	
	$wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'osmig_signups;');
	$wpdb->query('DROP TABLE IF EXISTS ' . $wpdb->prefix . 'osmig_fields;');

	delete_option("osmig-language");
	delete_option("osmig_db_version");
}
register_deactivation_hook(__FILE__,'osmig_uninstall');

####################################################################
#
# THEME OUTPUT
#
####################################################################
function displaySignups($atts) {
	
	global $wpdb;
	
	$output .= '<table cellpadding="0" cellspacing="0" width="100%" class="osmig-signups">';
	
	$output .= '<thead>';
	$output .= '<tr>';
	$table_name = $wpdb->prefix . "osmig_fields";
	$rows = $wpdb->get_results("SELECT id,name FROM {$table_name} WHERE slug = '{$atts["slug"]}'");
	foreach($rows as $row) {
		$output .= '<th>' . $row->name . '</th>';
	}
	$output .= '</tr>';
	$output .= '</thead>';
	$output .= '';
	
	$output .= '<tbody>';
	
	$table_name = $wpdb->prefix . "osmig_signups";
	$attendees = $wpdb->get_results("SELECT userkey FROM $table_name GROUP BY userkey");
	foreach($attendees as $attendee) {
		$output .= '  <tr>';
		
		$userdata = $wpdb->get_results("SELECT value FROM $table_name WHERE userkey='{$attendee->userkey}' AND replyToFieldID='{$row->id}' ORDER BY replyToFieldID ASC LIMIT 1");
		foreach($userdata as $data) {
			$output .= '    <td>' . ucfirst($data->value) . '</td>';
		}
		$output .= '  </tr>';
	}
	$output .= '</tbody>';
		
	$output .= '</table>';
	
	echo $output;
}
add_shortcode('osmig-signups', 'displaySignups');

function displayForm() {
	global $wpdb;
	
	if($_POST["osmig_submit"]=="yes") {
		$table_name = $wpdb->prefix . "osmig_signups";
		#$output .= "<pre>" . print_r($_POST, true) . "</pre>";
		#$output .= "<hr />";

		foreach ($_POST as $k => $v) {
			// Search for strings starting with "wp_"
			if (substr($k, 0, 6) == "osmig_") {
				$new_key = substr($k, 6);
				$_POST[$new_key] = $v;
				unset($_POST[$k]);
			}
		}
		$uuid = $_POST["uuid"];
		
		foreach($_POST as $key => $value) {
			if(is_array($value)) {
				#$output .= $key . ": ";
				foreach($value as $subkey=>$subvalue) {
					$output .= $subvalue . ",";
					$values = substr($subvalue . ",", 0, -1);
				}
				#$output .= "<br />";
				$wpdb->insert($table_name, array( 'replyToFieldID' => $key , 'value' => $values , 'userkey' => $uuid ));
			} else {
				#$output .= $key . ": " . $value . "<br />";
				if($key<>"uuid" && $key<>"submit") {
					$wpdb->insert($table_name, array( 'replyToFieldID' => $key , 'value' => $value , 'userkey' => $uuid ));
				}
			}
		}
		
		#$output .= "<pre>" . print_r($_POST, true) . "</pre>";
		$output .= '<p>Tak for din tilmelding.</p>';
		
	} else {
		$table_name = $wpdb->prefix . "osmig_fields";
		$fields = $wpdb->get_results("SELECT * FROM {$table_name} ORDER BY ordering ASC");
		$output .= "<form class=\"osmig\" method=\"post\" action=\"\">\n";
		$output .= "<input type=\"hidden\" name=\"uuid\" value=\"" . sha1(time().$_SERVER['REMOTE_ADDR']) . "\" />";

		foreach($fields as $field) {
                        $output .=$field->code;
			if($field->helptext<>"") {
				$output .= "<label>" . $field->name . " <span>" . $field->helptext . "</span></label>\n";
			} else {
				$output .= "<label>" . $field->name . "</label>\n";
			}
		
			switch($field->type) {
			case "text":
      			$output .= "<input type=\"text\" name=\"osmig_" . $field->id . "\" placeholder=\"" . $field->default . "\" />\n";
			break;
			case "textarea":
				$output .= "<textarea name=\"osmig_" . $field->id . "\" rows=\"4\" placeholder=\"" . $field->default . "\"></textarea>\n";
			break;
			case "select":
				$output .= "<select name=\"osmig_" . $field->id . "\">\n";
				$options = explode(",",$field->default);
				foreach($options as $option) {
					$output .= "<option value=\"{$option}\">" . ucfirst($option) . "</option>\n";
				}
				$output .= "</select>\n";
			break;
			case 'checkboxes':
				$options = explode(",",$field->default);
				foreach($options as $option) {
					$output .= "<div class=\"checkbox\"><input type=\"checkbox\" name=\"osmig_" . $field->id . "[]\" value=\"" . $option . "\" />" . ucfirst($option) . "</div>\n";
				}
			break;
                        case 'radio':
				$options = explode(",",$field->default);
				foreach($options as $option) {
					$output .= "<div class=\"checkbox\"><input type=\"radio\" name=\"osmig_" . $field->id . "[]\" value=\"" . $option . "\" />" . ucfirst($option) . "</div>\n";
				}
			break;
			}
		}
		$output .= "</table><p><button type=\"submit\">Submit</button></p>\n";
		$output .= "<input type=\"hidden\" name=\"osmig_submit\" value=\"yes\" />\n";
		$output .= "</form>\n";
	}
	echo $output;
}
add_shortcode('osmig-form', 'displayForm');

####################################################################
#
# ADMINISTRATION OUTPUT
#
####################################################################
add_action('admin_menu', 'osmig_plugin_menu');

function osmig_plugin_menu() {
	add_menu_page('osmig', 'Osmig', 'publish_posts', 'osmig-menu', 'osmig_information','',10);
	add_submenu_page('osmig-menu', LANG_SIDEBAR_CONFIGURATION, LANG_SIDEBAR_CONFIGURATION, 'publish_posts', 'osmig-configuration', 'osmig_configuration');
	add_submenu_page('osmig-menu', LANG_SIDEBAR_REPLIES, LANG_SIDEBAR_REPLIES, 'publish_posts', 'osmig-signups', 'osmig_signups');
	add_submenu_page('osmig-menu', LANG_SIDEBAR_HELP, LANG_SIDEBAR_HELP, 'publish_posts', 'osmig-help', 'osmig_help');
}

function osmig_information() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	echo '<div class="wrap">';
	echo '<div id="icon-themes" class="icon32"></div>';
	echo '<h2>Osmig Signup Plugin</h2>';
	echo '<p>' . LANG_DESC_ONE . '</p>';
	echo '<p>' . LANG_DESC_TWO . '</p>';
	if($_POST["flash"]=="thunder") {
		update_option("osmig-language",$_POST["language"]);
		echo '<div id="message" class="updated"><p>Language <strong>changed</strong>.</p></div>';
	}
	echo '<form method="post" action="">';
	echo '<table class="form-table"><tbody>';
	echo '<tr>';
	echo '<th>';
	echo '<label>' . LANG_CHOOSE_LANGUAGE . '</label>';
	echo '</th>';
	echo '<td>';
	echo '<select name="language">';
	switch(get_option("osmig-language")) {
	case 'en':
	echo '<option value="da">' . LANG_DANISH . '</option>';
	echo '<option value="en" selected="selected">' . LANG_ENGLISH . '</option>';
	break;
	case 'da':
	echo '<option value="da" selected="selected">' . LANG_DANISH . '</option>';
	echo '<option value="en">' . LANG_ENGLISH . '</option>';
	break;
	}
	echo '</select>';
	echo '</td>';
	echo '</tr>';
	echo '</tbody></table>';
	echo '<p class="submit"><input type="submit" name="Submit" class="button-primary" value="' . LANG_SAVE_CHANGES_BUTTON . '"></p>';
	echo '<input type="hidden" name="flash" value="thunder" />';
	echo '</form>';
	echo '</div>';

}

function osmig_signups() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	global $wpdb;

	echo '<div class="wrap">';
	echo '<div id="icon-themes" class="icon32"></div>';
	echo '<h2>' . LANG_SIGNUPS_PAGE_TITLE . '</h2>';
	echo '<p>' . LANG_SIGNUPS_DESCRIPTION . '</p>';
	
	if($_GET["action"]=="delete" && isset($_GET["uuid"])) {
		$table_name = $wpdb->prefix . "osmig_signups";
		$result = $wpdb->query("DELETE FROM {$table_name} WHERE userkey='{$_GET["uuid"]}'");
		if($result) {
			echo '<div id="message" class="updated"><p>' . LANG_SIGNUPS_DELETION_SUCCESS . '</p></div>';
		} else {
			echo '<div id="message" class="updated"><p>' . LANG_SIGNUPS_DELETION_SUCCESS . '</p></div>';
		}
	}
	
	echo '<table class="widefat fixed" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	$table_name = $wpdb->prefix . "osmig_fields";
	$rows = $wpdb->get_results("SELECT name FROM $table_name ORDER BY ordering ASC LIMIT 5");
	foreach($rows as $row) {
		echo '<th scope="col">' . $row->name . '</th>';
	}
	echo '<th width="5%"></th>';
	echo '</tr>';
	echo '</thead>';
	
	echo '<tfoot>';
	echo '<tr>';
	$table_name = $wpdb->prefix . "osmig_fields";
	$rows = $wpdb->get_results("SELECT name FROM $table_name ORDER BY ordering ASC LIMIT 10");
	foreach($rows as $row) {
		echo '<th scope="col">' . $row->name . '</th>';
	}
	echo '<th width="5%"></th>';
	echo '</tr>';
	echo '</tfoot>';
	
	echo '<tbody>';
	$table_name = $wpdb->prefix . "osmig_signups";
	$attendees = $wpdb->get_results("SELECT userkey FROM $table_name GROUP BY userkey");
	
	foreach($attendees as $attendee) {
		echo '  <tr>';
		$userdata = $wpdb->get_results("SELECT * FROM $table_name WHERE userkey='{$attendee->userkey}' ORDER BY replyToFieldID ASC");
		foreach($userdata as $data) {
			echo '    <td>' . ucfirst($data->value) . '</td>';
		}
		echo '<td width="5%"><a href="/wp-admin/admin.php?page=osmig-signups&action=delete&uuid=' . $attendee->userkey . '" class="delete">' . LANG_GLOBAL_DELETE . '</a></td>';
		echo '  </tr>';
	}
	echo '</tbody>';
	
	echo '</table>';
	echo '</div>';
}

function osmig_configuration() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	
	global $wpdb;

	echo '<div class="wrap">';
	echo '<div id="icon-themes" class="icon32"></div>';
	echo '<h2>' . LANG_CONFIGURATION_PAGE_TITLE . '</h2>';
	if(isset($_GET["action"]) && isset($_GET["id"])) {
		$table_name = $wpdb->prefix . "osmig_fields";
		$fieldID = mysql_real_escape_string($_GET["id"]);
		$result = $wpdb->query("DELETE FROM {$table_name} WHERE id='{$fieldID}'");
		if($result) {
			$table_name = $wpdb->prefix . "osmig_signups";
			$result = $wpdb->query("DELETE FROM {$table_name} WHERE replyToFieldID='{$fieldID}'");
			if($result) {
				echo '<div id="message" class="updated"><p>' . LANG_CONFIGURATION_DELETION_SUCCESS . '</p></div>';
			} else {
				echo '<div id="message" class="updated"><p>' . LANG_CONFIGURATION_DELETION_PARTIAL_SUCCESS . '</p></div>';
			}
		} else {
			echo '<div id="message" class="updated"><p>' . LANG_CONFIGURATION_DELETION_FAILURE . '</p></div>';
		}
	}
	if($_POST["submit"]=="yes") {
		function generateSlug($phrase, $maxLength) {
			$result = strtolower($phrase);
			$result = preg_replace("/[^a-z0-9\s-]/", "", $result);
			$result = trim(preg_replace("/[\s-]+/", " ", $result));
			$result = trim(substr($result, 0, $maxLength));
			$result = preg_replace("/\s/", "-", $result);
			return $result;
		}
		$input["name"] = $_POST["name"];
		$input["slug"] = generateSlug($_POST["name"],50);
		$input["type"] = $_POST["type"];
		$input["default"] = $_POST["default"];
                $input["code"] = $_POST["code"];
		$input["helptext"] = $_POST["helptext"];
		$input["ordering"] = $_POST["ordering"];
		
		$table_name = $wpdb->prefix . "osmig_fields";
		$result = $wpdb->insert( $table_name, $input );
		if($result) {
			echo '<div id="message" class="updated below-h2">' . LANG_CONFIGURATION_ADDING_SUCCESS . '</div>';
		} else {
			echo '<div id="message" class="updated below-h2">' . LANG_CONFIGURATION_ADDING_FAILURE . '</div>';
		}
	}
	echo '<div id="col-container">';
	echo '<div id="col-right">';
	echo '<table class="widefat fixed" cellspacing="0">';
	echo '<thead>';
	echo '<tr>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_NAME . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_TYPE . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_DEFAULT . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_HELPTEXT . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_ORDER . '</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tfoot>';
	echo '<tr>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_NAME . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_TYPE . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_DEFAULT . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_HELPTEXT . '</th>';
	echo '<th scope="col">' . LANG_CONFIGURATION_TABLE_ORDER . '</th>';
	echo '</tr>';
	echo '</tfoot>';
	
	echo '<tbody>';
	$table_name = $wpdb->prefix . "osmig_fields";
	$rows = $wpdb->get_results("SELECT * FROM $table_name");
	foreach($rows as $row) {
		echo '  <tr>';
		echo '    <td>' . $row->name . '<br /><a href="/wp-admin/admin.php?page=osmig-configuration&action=delete&id=' . $row->id . '" class="delete">Delete</a></td>';
		echo '    <td>' . $row->type . '</td>';
		echo '    <td>' . $row->default . '</td>';
                //echo '    <td>' . $row->code . '</td>';
		echo '    <td>' . $row->helptext . '</td>';
		echo '    <td>' . $row->ordering . '</td>';
		echo '  </tr>';
	}
	echo '</tbody>';
	
	echo '</table>';
	echo '<p>' . LANG_CONFIGURATION_TABLE_DESCRIPTION . '</p>';
	echo '</div>';
	echo '<div id="col-left">';
	echo '<div class="col-wrap"><div class="form-wrap">';
	echo '<h3>' . LANG_CONFIGURATION_FORM_TITLE . '</h3>';
	echo '<form method="post" action="'. $_SERVER["REQUEST_URI"] .'">';
	echo '<div class="form-field form-required">';
	echo '<label for="name">' . LANG_CONFIGURATION_FORM_NAME . '</label>';
	echo '<input name="name" id="link-name" type="text" value="" size="40" aria-required="true">';
	echo '</div>';
	echo '<div class="form-field form-required">';
	echo '<label for="type">' . LANG_CONFIGURATION_FORM_TYPE . '</label>';
	echo '<select name="type"><option value="text">Text field</option><option value="radio">Radio Buttons</option><option value="select">Select dropdown</option><option value="textarea">Textarea</option><option value="checkboxes">Checkboxes</option></select>';
	echo '</div>';
	echo '<div class="form-field form-required">';
	echo '<label for="default">' . LANG_CONFIGURATION_FORM_DEFAULT . '</label>';
	echo '<textarea name="default" rows="4"></textarea>';
	echo '<p>' . LANG_CONFIGURATION_FORM_DEFAULT_DESCRIPTION . '</p>';
	echo '</div>';
        echo '<div class="form-field form-required">';
	echo '<label for="code">' . "Pre-field HTML code" . '</label>';
	echo '<textarea name="code" rows="4"></textarea>';
	echo '<p>' . "You can enter a piece of html code to be executed before the display of the field for formatting purpose. Escape characters to be used where ever needed." . '</p>';
	echo '</div>';
	echo '<div class="form-field form-required">';
	echo '<label for="helptext">' . LANG_CONFIGURATION_FORM_HELPTEXT . '</label>';
	echo '<textarea name="helptext" rows="4"></textarea>';
	echo '<p>' . LANG_CONFIGURATION_FORM_HELPTEXT_DESCRIPTION . '</p>';
	echo '</div>';
	echo '<div class="form-field form-required">';
	echo '<label for="ordering">' . LANG_CONFIGURATION_FORM_ORDER . '</label>';
	echo '<input type="text" name="ordering" />';
	echo '<p>' . LANG_CONFIGURATION_FORM_ORDER_DESCRIPTION . '</p>';
	echo '</div>';
	echo '<p class="submit"><input type="submit" class="button" name="submit" value="' . LANG_CONFIGURATION_FORM_SUBMIT_BUTTON . '"></p>';
	echo '<input type="hidden" name="submit" value="yes" />';
	echo '</form>';
	echo '</div></div></div>';
	echo '</div>';
	echo '</div>';

}

function osmig_help() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

	echo '<div class="wrap">';
	echo '<div id="icon-themes" class="icon32"></div>';
	echo '<h2>' . LANG_HELP_PAGE_TITLE . '</h2>';
	echo '<p>' . LANG_HELP_PAGE_DESCRIPTION . '</p>';
	echo '<h3>' . LANG_HELP_PAGE_SHORTCODE_FORM . '</h3>';
	echo LANG_HELP_PAGE_SHORTCODE_FORM_DESCRIPTION;
	echo '<hr />';
	echo '<h3>' . LANG_HELP_PAGE_SHORTCODE_SIGNUPS . '</h3>';
	echo LANG_HELP_PAGE_SHORTCODE_SIGNUPS_DESCRIPTION;
	echo '</div>';

}

####################################################################
#
# DASHBOARD WIDGET
#
####################################################################
function osmig_dashboard_widget() {
	global $wpdb;
	
	$table_name = $wpdb->prefix . "osmig_signups";
	$attendee_count = $wpdb->query("SELECT COUNT(id) as CNT FROM $table_name GROUP BY userkey");
	echo "Signups so far: <strong>" . $attendee_count . "</strong>";
} 

// Create the function use in the action hook

function add_osmig_dashboard_widget() {
	wp_add_dashboard_widget('osmig_dashboard_widget', 'Osmig Signups', 'osmig_dashboard_widget');	
} 

// Hook into the 'wp_dashboard_setup' action to register our other functions

add_action('wp_dashboard_setup', 'add_osmig_dashboard_widget' );

####################################################################
#
# STYLESHEET INCLUSION
#
####################################################################
wp_enqueue_style('osmig', plugins_url('osmig/css/osmig.css'), false, $osmig_db_version, 'all');
?>