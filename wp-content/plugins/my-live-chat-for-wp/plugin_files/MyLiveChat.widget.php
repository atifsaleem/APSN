<?php

class MyLiveChatWidget extends WP_Widget
{
	private static $my_id_base = 'mylivechat_widget';

	static public function get_id_base()
	{
		return self::$my_id_base;
	}

	function MyLiveChatWidget()
	{
		$this->WP_Widget('mylivechat_widget', 'MyLiveChat', array(
			'classname' => 'MyLiveChatWidget',
			'description' => 'Install "Chat Button, Chat Box or Chat Text Link" to let your visitors start a chat with you.'
		), array(
			'id_base' => self::$my_id_base
		));
	}

	function form($instance)
	{
		echo "<p><strong>Everything is all right!</strong></p>
		<p>To configure MyLiveChat, go to <a href=\"admin.php?page=mylivechat_settings\">Settings</a>.</p>";
	}

	function widget($args, $instance)
	{

		/*
		$mylivechat_id = MyLiveChat::get_instance()->get_mylivechat_id();
		$mylivechat_displaytype = MyLiveChat::get_instance()->get_mylivechat_displaytype();
		$isIntegrateUser = MyLiveChat::get_instance()->get_integrate_user();
		$mylivechat_encrymode = MyLiveChat::get_instance()->get_mylivechat_encrymode();
		$mylivechat_encrykey = MyLiveChat::get_instance()->get_mylivechat_encrykey();
		*/
		$mylivechat_pos = MyLiveChat::get_instance()->get_mylivechat_pos();
		if(is_null($mylivechat_pos) || $mylivechat_pos== "" || $mylivechat_pos == "widget")
		{
			MyLiveChat::get_instance()->mylivechat_code();
		}
	}
}
?>