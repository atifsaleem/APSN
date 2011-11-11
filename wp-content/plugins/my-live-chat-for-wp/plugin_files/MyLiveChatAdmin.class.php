<?php

require_once('MyLiveChat.class.php');

final class MyLiveChatAdmin extends MyLiveChat
{
	/**
	 * Plugin's version
	 */
	protected $plugin_version = null;

	/**
	 * Returns true if "Advanced settings" form has just been submitted,
	 * false otherwise
	 *
	 * @return bool
	 */
	protected $changes_saved = false;

	/**
	 * Starts the plugin
	 */
	protected function __construct()
	{
		parent::__construct();
		
		wp_enqueue_script('mylivechatjquery', $this->get_plugin_url().'/js/jquery-1.6.min.js', '', $this->get_plugin_version(), true);
		wp_enqueue_script('mylivechat', $this->get_plugin_url().'/js/mylivechat.js', 'jquery', $this->get_plugin_version(), true);

		add_action('admin_menu', array($this, 'admin_menu'));

		// tricky error reporting
		if (defined('WP_DEBUG') && WP_DEBUG == true)
		{
			add_action('init', array($this, 'error_reporting'));
		}

		if (isset($_GET['clear']) && $_GET['clear'] == '1')
		{
			$this->reset_options();
		}
		else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['saved']) && $_GET['saved'] == '1')
		{
			$this->update_options($_POST);
		}
	}

	public static function get_instance()
	{
		if (!isset(self::$instance))
		{
			$c = __CLASS__;
			self::$instance = new $c;
		}

		return self::$instance;
	}

	/**
	 * Set error reporting for debugging purposes
	 */
	public function error_reporting()
	{
		error_reporting(E_ALL & ~E_USER_NOTICE);
	}

	/**
	 * Returns this plugin's version
	 *
	 * @return string
	 */
	public function get_plugin_version()
	{
		if (is_null($this->plugin_version))
		{
			if (!function_exists('get_plugins'))
			{
				require_once(ABSPATH.'wp-admin/includes/plugin.php');
			}

			$plugin_folder = get_plugins('/'.plugin_basename(dirname(__FILE__).'/..'));
			$this->plugin_version = $plugin_folder['mylivechat.php']['Version'];
		}

		return $this->plugin_version;
	}

	public function admin_menu()
	{
		add_menu_page(
			'MyLiveChat',
			'MyLiveChat',
			'administrator',
			'mylivechat',
			array($this, 'mylivechat_settings_page'),
			$this->get_plugin_url().'/images/livechat.png'
		);
	
		add_submenu_page(
			'mylivechat',
			'Settings',
			'Settings',
			'administrator',
			'mylivechat_settings',
			array($this, 'mylivechat_settings_page')
		);

		add_submenu_page(
			'mylivechat',
			'Control panel',
			'Control panel',
			'administrator',
			'mylivechat_control_panel',
			array($this, 'control_panel_page')
		);


		// remove the submenu that is automatically added
		if (function_exists('remove_submenu_page'))
		{
			remove_submenu_page('mylivechat', 'mylivechat');
		}

		// Settings link
		add_filter("plugin_action_links", array($this, 'mylivechat_settings_link'));
		
	}

	public function control_panel_page()
	{
		echo '<iframe id="control_panel" src="https://www.mylivechat.com/addon-panel.aspx" frameborder="0" style="width:100%; height:500px;"></iframe>
			<p>Optionally, open the Control panel in an <a href="https://www.mylivechat.com/addon-panel.aspx" target="_blank">external window</a>.</p>';
	}

	/**
	 * Displays settings page
	 */
	public function mylivechat_settings_page()
	{
		if (isset($_GET['saved']))
		{
			echo "<div id=\"changes_saved_info\" class=\"updated installed_ok\"><p>MyLiveChat settings saved successfully.</p></div>";
		}

		global $current_user;
		get_currentuserinfo();

		$firstname = $current_user->user_firstname;
		$lastname = $current_user->user_lastname;
		$email = $current_user->user_email;
		
		if($this->is_installed() == false)
		{
			echo "<div class=\"metabox-holder\">
				<div class=\"postbox\">
					<h3>Do you already have a MyLiveChat account?</h3>
					<div class=\"postbox_content\">
					<ul id=\"choice_account\">
					<li><input type=\"radio\" name=\"choice_account\" id=\"choice_account_1\" checked=\"checked\" onclick=\"MyLiveChat_Show_Setting();\"> <label for=\"choice_account_1\">Yes, I already have a MyLiveChat account</label></li>
					<li><input type=\"radio\" name=\"choice_account\" id=\"choice_account_0\" onclick=\"MyLiveChat_Show_Signup();\"> <label for=\"choice_account_0\">No, I want to create one</label></li>
					</ul>
					</div>
				</div>
			</div>";

			echo "<div class=\"metabox-holder\" id=\"Cont_MyLiveChat_Signup\" style=\"display:none;\">
					<div class=\"postbox\">
						<h3>Create new MyLiveChat account</h3>
						<div class=\"postbox_content\">
						<table class=\"form-table\">
							<th scope=\"row\"><label for=\"email\">Email:</label></th>
							<td><input type=\"text\" name=\"email\" id=\"email\" maxlength=\"100\" value=\"".$email."\" size=\"40\" /></td>
							</tr>
							<tr>
							<th scope=\"row\"><label for=\"password\">Password:</label></th>
							<td><input type=\"password\" name=\"password\" id=\"password\" maxlength=\"100\" value=\"\" size=\"40\" /></td>
							</tr>
							<tr>
							<th scope=\"row\"><label for=\"password_retype\">Retype Password:</label></th>
							<td><input type=\"password\" name=\"password_retype\" id=\"password_retype\" maxlength=\"100\" value=\"\" size=\"40\" /></td>
							</tr>
							<tr>
							<th scope=\"row\"><label for=\"firstname\">First Name:</label></th>
							<td><input type=\"text\" name=\"firstname\" id=\"firstname\" maxlength=\"60\" value=\"".$firstname."\" size=\"40\" /></td> 
							</tr>
							<tr>
							<th scope=\"row\"><label for=\"lastname\">Last Name:</label></th>
							<td><input type=\"text\" name=\"lastname\" id=\"lastname\" maxlength=\"60\" value=\"".$lastname."\" size=\"40\" /></td> 
							</tr>
							<tr>
						</table>

						<p class=\"ajax_message\"></p>
						<p class=\"submit\">
							<input type=\"button\" value=\"Create account\" id=\"submit\" class=\"button-primary\" onclick=\"MyLiveChat_Signup();\"/>
						</p>
						</div>
					</div>
				</div>";
		}
		else
		{
			echo "<div class=\"updated fade\"><p>Go to <a href=\"widgets.php\">widgets</a> config page, add MyLiveChat widget to Sidebar.</p></div>";
		}
		
		echo "<div class=\"metabox-holder\" id=\"Cont_MyLiveChat_Setting\">

			<div class=\"postbox\">
				<form method=\"post\" id=\"mylivechat_settings_form\" action=\"?page=mylivechat_settings&saved=1\">
					<h3>MyLiveChat Settings</h3>
					<div class='postbox_content'>
					<table class='form-table'>
					<tr>
						<td scope=\"row\" style=\"width:160px;\"><label for=\"mylivechat_id\">MyLiveChatID:</label></td>
						<td><input type=\"text\" name=\"mylivechat_id\" id=\"mylivechat_id\" value=\"".$this->get_mylivechat_id()."\"/></td>
					</tr>
					<tr><td colspan=\"2\">Don't have MyLiveChat account? <a href=\"https://www.mylivechat.com/register.aspx\" target=\"_blank\">Get it for free!</a></td></tr>
					<tr>
						<td scope=\"row\"><label for=\"mylivechat_pos\">Display Posistion:</label></td>
						<td>
							<select name=\"mylivechat_pos\" id=\"mylivechat_pos\">
								<option value=\"widget\">Widget</option>
								<option value=\"footer\">Footer</option>
							</select>
						</td>
					</tr>
					<tr>
						<td scope=\"row\"><label for=\"mylivechat_displaytype\">Display Type:</label></td>
						<td>
							<select name=\"mylivechat_displaytype\" id=\"mylivechat_displaytype\">
								<option value=\"button\">Chat Button</option>
								<option value=\"box\">Chat Box</option>
								<option value=\"link\">Chat Text Link</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan=\"2\">
							<input type=\"hidden\" name=\"changes_saved\" value=\"1\">
							<input type=\"hidden\" name=\"settings_form\" value=\"1\">
							<input type=\"submit\" class=\"button-primary\" value=\"Save changes\" />
						</td>
					</tr>
					</table>
				</form>
			</div>

			<p id=\"reset_settings\">Something went wrong? <a href=\"?page=mylivechat_settings&amp;clear=1\">Reset your settings</a>.</p>
		</div>";
		
		echo "<script type=\"text/javascript\">				
				document.getElementById('mylivechat_displaytype').value='".$this->get_mylivechat_displaytype()."'||'button';
				document.getElementById('mylivechat_pos').value='".$this->get_mylivechat_pos()."'||'widget';
			</script>";
	}

	public function changes_saved()
	{
		return $this->changes_saved;
	}

	public function mylivechat_settings_link($links)
	{
		if(count($links)==0) 
			return $links;
		$ix = count($links)-1;
		$pos = strrpos($links[$ix], "mylivechat.php");
		if($pos=== false)
			return $links;
		$settings_link = sprintf('<a href="admin.php?page=mylivechat_settings">%s</a>', __('Settings'));
		array_unshift ($links, $settings_link); 
		return $links;
	}

	protected function reset_options()
	{
		
		delete_option('mylivechat_id');
		delete_option('mylivechat_displaytype');
		delete_option('mylivechat_membership');
		delete_option('mylivechat_encrymode');
		delete_option('mylivechat_encrykey');
		
	}

	protected function update_options($data)
	{
		
		$mylivechat_id = isset($data['mylivechat_id']) ? $data['mylivechat_id'] : "";
		$mylivechat_pos = isset($data['mylivechat_pos']) ? $data['mylivechat_pos'] : "widget";
		$mylivechat_displaytype = isset($data['mylivechat_displaytype']) ? $data['mylivechat_displaytype'] : "button";
		//$mylivechat_membership = isset($data['mylivechat_membership']) ? $data['mylivechat_membership'] : "no";
		//$mylivechat_encrymode = isset($data['mylivechat_encrymode']) ? $data['mylivechat_encrymode'] : "none";
		//$mylivechat_encrykey = isset($data['mylivechat_encrykey']) ? $data['mylivechat_encrykey'] : "";

		update_option('mylivechat_id', $mylivechat_id);
		update_option('mylivechat_pos', $mylivechat_pos);
		update_option('mylivechat_displaytype', $mylivechat_displaytype);
		//update_option('mylivechat_membership', $mylivechat_membership);
		//update_option('mylivechat_encrymode', $mylivechat_encrymode);
		//update_option('mylivechat_encrykey', $mylivechat_encrykey);

		if (isset($data['changes_saved']) && $data['changes_saved'] == '1')
		{
			$this->changes_saved = true;
		}		
	}
}
?>