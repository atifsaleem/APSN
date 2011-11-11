<?php
/*
Plugin Name: MyLiveChat
Plugin URI: http://www.mylivechat.com/addons/wordpress-live-chat.aspx
Description: My LiveChat is a fast, high performance and most user-friendly live chat solution. It allows you to live chat with website visitors, monitor site traffic, and analyze visitors web activities, including their search engine and keyword usage.
Author: MyLiveChat
Author URI: http://www.mylivechat.com
Version: 1.0.3
*/

if (is_admin())
{
	require_once(dirname(__FILE__).'/plugin_files/MyLiveChatAdmin.class.php');
	MyLiveChatAdmin::get_instance();
}
else
{
	require_once(dirname(__FILE__).'/plugin_files/MyLiveChat.class.php');
	MyLiveChat::get_instance();
}
?>