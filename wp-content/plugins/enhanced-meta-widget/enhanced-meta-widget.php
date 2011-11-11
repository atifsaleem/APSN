<?php
/*
Plugin Name: Enhanced Meta Widget
Plugin URI: http://neurodawg.wordpress.com/enhanced-meta-widget/
Description: Replaces the meta sidebar included with WordPress, and displays various links based upon user roles.
Version: 3.0.0
Text Domain: enhanced-meta-widget
Author: NeuroDawg
Author URI: http://neurodawg.wordpress.com
Copyright 2009 - NeuroDawg
License:
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation; either version 3 of the License, or
  (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, visit http://www.gnu.org/licenses/
*/

/*
 * Enhanced Meta Widget Class
*/
class meta_enhanced extends WP_Widget { //extends the base widget class
function meta_enhanced() {
  unregister_widget ('WP_Widget_Meta'); //comment out or delete this line if you want to keep the default meta widget
  $widget_ops = array('classname' => 'meta_enhanced', 'description' => __('Adds various admin links for logged in users on every page.', 'enhanced-meta-widget'));
  // $control_ops = array( 'width' => 400, 'height' => 200 ); //sets size of admin panel for widget options
  $this->WP_Widget('meta_enhanced', __('Enhanced Meta', 'enhanced-meta-widget'), $widget_ops);
} //closes function meta_enhanced()
/*
 * Get variables and output the sidebar
*/
function widget( $args, $instance ) {
  extract($args, EXTR_SKIP);  //gets the before_widget, after_widget, before_title, after_title tags if defined in a theme's functions.php
                              //otherwise uses the defaults for these tags
  global $post, $user_ID, $user_level, $user_login, $userdata; // This gets the post and user information
  $base_url = get_bloginfo('wpurl');
  /* 
   * This sub-section gets the variables
  */
  $title = apply_filters('widget_title', empty($instance['title']) ? __('Meta', 'enhanced-meta-widget') : $instance['title']);
  $display_username     = $instance['username'] ? '1' : '0';
  $display_userlink     = $instance['userlink'] ? '1' : '0';
  $display_profile      = $instance['profile'] ? '1' : '0';
  $display_login        = $instance['login'] ? '1' : '0';
  $display_logout       = $instance['logout'] ? '1' : '0';
  $display_loginform    = $instance['loginform'] ? '1' : '0';
  $display_register     = $instance['register'] ? '1' : '0';
  $display_editthispost = $instance['editthispost'] ? '1' : '0';
  $display_editthispage = $instance['editthispage'] ? '1' : '0';
  $display_newpost      = $instance['newpost'] ? '1' : '0';
  $display_newpage      = $instance['newpage'] ? '1' : '0';
  $display_dashboard    = $instance['dashboard'] ? '1' : '0';
  $display_manposts     = $instance['manposts'] ? '1' : '0';
  $display_mandrafts    = $instance['mandrafts'] ? '1' : '0';
  $display_medialib     = $instance['medialib'] ? '1' : '0';
  $display_manlinks     = $instance['manlinks'] ? '1' : '0';
  $display_manpages     = $instance['manpages'] ? '1' : '0';
  $display_mancomments  = $instance['mancomments'] ? '1' : '0';
  $display_manthemes    = $instance['manthemes'] ? '1' : '0';
  $display_manwidgets   = $instance['manwidgets'] ? '1' : '0';
  $display_manplugins   = $instance['manplugins'] ? '1' : '0';
  $display_manusers     = $instance['manusers'] ? '1' : '0';
  $display_tools        = $instance['tools'] ? '1' : '0';
  $display_settings     = $instance['settings'] ? '1' : '0';
  $display_entrss       = $instance['entrss'] ? '1' : '0';
  $display_commrss      = $instance['commrss'] ? '1' : '0';
  $display_wplink       = $instance['wplink'] ? '1' : '0';
  $display_linebreaks   = $instance['linebreaks'] ? '1' : '0';

  /*
   * This sub-section outputs the sidebar
  */
  if (is_user_logged_in()) { //begins section for all logged in users
  /*
   * This section tests to see if only the "edit this post" or "edit this page" options have been selected
   * and displays the form only in the appropriate places, without displaying an empty widget
   * in the sidebar.
  */
  if (is_single() && !($display_username || $display_profile || $display_logout || $display_newpost || $display_newpage || $display_dashboard || $display_manposts || $display_mandrafts || $display_medialib || $display_manlinks || $display_manpages || $display_mancomments || $display_manthemes || $display_manwidgets || $display_manplugins || $display_manusers || $display_tools || $display_settings || $display_entrss || $display_commrss || $display_wplink) && $display_editthispost && (current_user_can('edit_others_posts') || (current_user_can('edit_posts') && $user_ID == $post->post_author))) {
    echo $before_widget;
    echo $before_title . $title . $after_title;
    echo '<ul>'; ?>
      <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/post.php?action=edit&post=<?php the_id();?>"><?php _e('Edit This Post', 'enhanced-meta-widget')?></a></li><?php
    echo '</ul>';
    echo $after_widget; }
  elseif (is_page() && !($display_username || $display_profile || $display_logout || $display_newpost || $dipslay_newpage || $display_dashboard || $display_manposts || $display_mandrafts || $display_medialib || $display_manlinks || $display_manpages || $display_mancomments || $display_manthemes || $display_manwidgets || $display_manplugins || $display_manusers || $display_tools || $display_settings || $display_entrss || $display_commrss || $display_wplink) && $display_editthispage && (current_user_can('edit_others_pages') || (current_user_can('edit_pages') && $user_ID == $post->post_author))) {
    echo $before_widget;
    echo $before_title . $title . $after_title;
    echo '<ul>'; ?>
      <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/page.php?action=edit&post=<?php the_id();?>"><?php _e('Edit This Page', 'enhanced-meta-widget')?></a></li><?php
    echo '</ul>';
    echo $after_widget; }
  /* 
   *Displays the the complete sidebar if options other than just "edit this post" and/or "edit this page" are selected
  */
  elseif ($display_username || $display_profile || $display_logout || $display_newpost || $display_newpage || $display_dashboard || $display_manposts || $display_mandrafts || $display_medialib || $display_manlinks || $display_manpages || $display_mancomments || $display_manthemes || $display_manwidgets || $display_manplugins || $display_manusers || $display_tools || $display_settings || $display_entrss || $display_commrss || $display_wplink ) { //only shows form if one of these options has been selected
    echo $before_widget;
    echo $before_title . $title . $after_title;
    echo '<ul>';
    /*
     * This section is for all logged in users based upon their roles/permissions
     * and does not include any links that require adminstrator status
    */
    if ($display_username) {
      if ($display_userlink) { ?>
        <p><?php printf(__('Welcome, <a href="%1$s/wp-admin/profile.php"><em>%2$s</em></a>', 'enhanced-meta-widget'), $base_url, $userdata->display_name);?></p><?php }
      else { ?>
        <p><?php printf(__('Welcome, <em>%s</em>', 'enhanced-meta-widget'), $userdata->display_name);?></p><?php }}
    if ($display_logout) { ?>
      <li><?php wp_loginout($_SERVER['REQUEST_URI']);?></li><?php }
    if ($display_profile) { ?>
      <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/profile.php"><?php _e('My Profile', 'enhanced-meta-widget')?></a></li><?php }
    //if ($display_linebreaks) echo '</ul><br /><ul>';
    if ($display_dashboard && ($user_level <= 9)) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/index.php"><?php _e('Dashboard', 'enhanced-meta-widget')?></a></li><?php }
    if (current_user_can('edit_posts') && $display_newpost) {?>
      <li><a href="<?php bloginfo('wpurl') ?>/wp-admin/post-new.php"><?php _e('New Post', 'enhanced-meta-widget')?></a></li> <?php }
	  if (current_user_can('edit_pages') && $display_newpage) {?>
      <li><a href="<?php bloginfo('wpurl') ?>/wp-admin/post-new.php?post_type=page"><?php _e('New Page', 'enhanced-meta-widget')?></a></li> <?php }
    if ((is_single() && $display_editthispost) && (current_user_can('edit_others_posts') || (current_user_can('edit_posts') && $user_ID == $post->post_author))) { ?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/post.php?post=<?php the_id();?>&action=edit"><?php _e('Edit This Post', 'enhanced-meta-widget')?></a></li><?php }
    if ((is_page() && $display_editthispage) && (current_user_can('edit_others_pages') || (current_user_can('edit_pages') && $user_ID == $post->post_author))) { ?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/post.php?post=<?php the_id();?>&action=edit"><?php _e('Edit This Page', 'enhanced-meta-widget')?></a></li><?php }
    /*
     * This section displays only when an administrator is logged in
    */
    if ($user_level == 10) { ?>
      <?php if ((( $display_logout || $display_profile || (is_single() && $display_editthispost) || (is_page() && $display_editthispage) || $display_newpost) && ( $display_dashboard || $display_manposts || $display_mandrafts || $display_medialib || $display_manlinks || $display_manpages || $display_mancomments || $display_manthemes || $display_manwidgets || $display_manwidgets || $display_manplugins || $display_manusers || $display_tools || $display_settings)) && ($display_linebreaks)) echo '</ul><br /><ul>';
      if ($display_dashboard) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/index.php"><?php _e('Dashboard', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manposts) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/edit.php"><?php _e('Manage Posts', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_mandrafts) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/edit.php?post_status=draft"><?php _e('Manage Drafts', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_medialib) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/upload.php"><?php _e('Media Library', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manlinks) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/link-manager.php"><?php _e('Manage Links', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manpages) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/edit.php?post_type=page"><?php _e('Manage Pages', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_mancomments) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/edit-comments.php"><?php _e('Manage Comments', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manthemes) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/themes.php"><?php _e('Manage Themes', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manwidgets) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/widgets.php"><?php _e('Manage Widgets', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manplugins) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/plugins.php"><?php _e('Manage Plugins', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_manusers) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/users.php"><?php _e('Manage Users', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_tools) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/tools.php"><?php _e('Tools', 'enhanced-meta-widget')?></a></li><?php }
      if ($display_settings) {?>
        <li><a href="<?php bloginfo('wpurl'); ?>/wp-admin/options-general.php"><?php _e('Settings', 'enhanced-meta-widget')?></a></li><?php }
    } // ends if user is admin sub-section and restarts options for all logged in users
    if (((( $display_logout || $display_profile || (is_single() && $display_editthispost) || (is_page() && $display_editthispage) || $display_newpost) || ( $display_dashboard || $display_manposts || $display_mandrafts || $display_medialib || $display_manlinks || $display_manpages || $display_mancomments || $display_manthemes || $display_manwidgets || $display_manwidgets || $display_manplugins || $display_manusers || $display_tools || $display_settings)) && ( $display_entrss || $display_commrss || $display_wplink)) && ($display_linebreaks)) echo '</ul><br /><ul>';
    if ($display_entrss) {?>
      <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0', 'enhanced-meta-widget'); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>', 'enhanced-meta-widget'); ?></a></li><?php }
    if ($display_commrss) {?>
      <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS', 'enhanced-meta-widget'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'enhanced-meta-widget'); ?></a></li><?php }
    if ($display_wplink) {?>
      <li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'enhanced-meta-widget'); ?>">WordPress.org</a></li><?php }
      echo '</ul>';
      //var_dump($userdata); 
      echo $after_widget;
  } // ends if requiring various display options
  } // ends if user logged in section
  /*
   * This Section displays the some links (register, RSS, and wordpress.org) and the login-in form if a user is not logged in
  */
  else {
  if (($display_register && get_option('users_can_register')) || $display_login || $display_entrss || $display_commrss || $display_wplink) {
    echo $before_widget;
    echo $before_title . $title . $after_title;
    echo '<ul>'; 
    if ($display_login && !($display_loginform)) {?>
      <li><?php echo wp_loginout($_SERVER['REQUEST_URI']);?></li><?php }
    if (get_option('users_can_register') && $display_register) { //shows the register link if registration is allowed
      wp_register(); }
    if ( ((($display_register && get_option('users_can_register')) || ($display_login && !($display_loginform))) && ($display_entrss || $display_commrss || $display_wplink)) && ($display_linebreaks) ) echo '</ul><br /><ul>';
    if ($display_entrss) {?>
      <li><a href="<?php bloginfo('rss2_url'); ?>" title="<?php _e('Syndicate this site using RSS 2.0', 'enhanced-meta-widget'); ?>"><?php _e('Entries <abbr title="Really Simple Syndication">RSS</abbr>', 'enhanced-meta-widget'); ?></a></li><?php }
    if ($display_commrss) {?>
      <li><a href="<?php bloginfo('comments_rss2_url'); ?>" title="<?php _e('The latest comments to all posts in RSS', 'enhanced-meta-widget'); ?>"><?php _e('Comments <abbr title="Really Simple Syndication">RSS</abbr>', 'enhanced-meta-widget'); ?></a></li><?php }
    if ($display_wplink) {?>
      <li><a href="http://wordpress.org/" title="<?php _e('Powered by WordPress, state-of-the-art semantic personal publishing platform.', 'enhanced-meta-widget'); ?>">WordPress.org</a></li><?php }
    echo '</ul>';
    echo $after_widget; }
    if ($display_loginform) { /* Starts to generate the Login Form */
      echo $before_widget;
      echo $before_title; _e('Log In', 'enhanced-meta-widget'); echo $after_title; ?>
      <form method="post" action="<?php echo get_bloginfo('wpurl'); ?>/wp-login.php" id="emw_loginform" name="loginform">
      <p>
      <label><?php _e('Username', 'enhanced-meta-widget'); ?><br/>
        <input type="text" tabindex="10" size="20" value="" class="input" id="user_login" name="log"/></label>
      </p>
      <p>
      <label><?php _e('Password', 'enhanced-meta-widget'); ?><br/>
        <input type="password" tabindex="20" size="20" value="" class="input" id="user_pass" name="pwd"/></label>
      </p>
      <?php
        do_action('login_form'); // creates a hook to allow other plugins to run actions just before the end of the login form
      ?>
      <p class="forgetmenot"><label><input type="checkbox" tabindex="90" value="forever" id="rememberme" name="rememberme"/><?php _e('Remember Me', 'enhanced-meta-widget'); ?></label></p>
      <p class="submit">
        <input type="submit" tabindex="100" value="Log In" id="wp-submit" name="wp-submit"/>
        <input type="hidden" value="<?php echo $_SERVER['REQUEST_URI']; ?>" name="redirect_to" class=""/>
        <input type="hidden" value="1" name="testcookie" class=""/>
      </p>
    </form><?php
    echo $after_widget;
    } //ends if... statement to display login form
  } //ends else statement to display meta links for users not logged in
} //ends widget function

/*
 * Process options to be saved
*/
function update($new_instance, $old_instance) {
  $instance = $old_instance;
  $new_instance = wp_parse_args((array) $new_instance, array('title' => '', 'username' => 0, 'userlink' => 0, 'profile' => 0, 'login' => 0, 'logout' => 0, 'loginform' => 0, 'register' => 0, 'editthispost' => 0, 'editthispage' => 0, 'newpost' => 0, 'dashboard' => 0, 'manposts' => 0, 'mandrafts' =>0, 'medialib' => 0, 'manlinks' => 0, 'manpages' => 0, 'mancomments' => 0, 'manthemes' => 0, 'manwidgets' => 0, 'manplugins' => 0, 'manusers' => 0, 'tools' => 0, 'settings' => 0, 'entrss' => 0, 'commrss' => 0, 'wplink' => 0, 'linebreaks' => 0));
    $instance['title']        = strip_tags($new_instance['title']);
    $instance['username']     = $new_instance['username'] ? '1' : '0';
    $instance['userlink']     = $new_instance['userlink'] ? '1' : '0';
    $instance['profile']      = $new_instance['profile'] ? '1' : '0';
    $instance['login']        = $new_instance['login'] ? '1' : '0';
    $instance['logout']       = $new_instance['logout'] ? '1' : '0';
    $instance['loginform']    = $new_instance['loginform'] ? '1' : '0';
    $instance['register']     = $new_instance['register'] ? '1' : '0';
    $instance['editthispost'] = $new_instance['editthispost'] ? '1' : '0';
    $instance['editthispage'] = $new_instance['editthispage'] ? '1' : '0';
    $instance['newpost']      = $new_instance['newpost'] ? '1' : '0';
    $instance['newpage']      = $new_instance['newpage'] ? '1' : '0';
    $instance['dashboard']    = $new_instance['dashboard'] ? '1' : '0';
    $instance['manposts']     = $new_instance['manposts'] ? '1' : '0';
    $instance['mandrafts']    = $new_instance['mandrafts'] ? '1' : '0';
    $instance['medialib']     = $new_instance['medialib'] ? '1' : '0';
    $instance['manlinks']     = $new_instance['manlinks'] ? '1' : '0';
    $instance['manpages']     = $new_instance['manpages'] ? '1' : '0';
    $instance['mancomments']  = $new_instance['mancomments'] ? '1' : '0';
    $instance['manthemes']    = $new_instance['manthemes'] ? '1' : '0';
    $instance['manwidgets']   = $new_instance['manwidgets'] ? '1' : '0';
    $instance['manplugins']   = $new_instance['manplugins'] ? '1' : '0';
    $instance['manusers']     = $new_instance['manusers'] ? '1' : '0';
    $instance['tools']        = $new_instance['tools'] ? '1' : '0';
    $instance['settings']     = $new_instance['settings'] ? '1' : '0';
    $instance['entrss']       = $new_instance['entrss'] ? '1' : '0';
    $instance['commrss']      = $new_instance['commrss'] ? '1' : '0';
    $instance['wplink']       = $new_instance['wplink'] ? '1' : '0';
    $instance['linebreaks']   = $new_instance['linebreaks'] ? '1' : '0';
    return $instance;
  } //ends update function
  /*
   * Creates the widget admin options form
  */
  function form( $instance ) {
    $instance = wp_parse_args((array) $instance, array('title' => '', 'username' => 0, 'userlink' => 0, 'profile' => 0, 'login' => 0, 'logout' => 0, 'loginform' => 0, 'register' => 0, 'editthispost' => 0, 'editthispage' => 0, 'newpost' => 0, 'newpage' => 0, 'dashboard' => 0, 'manposts' => 0, 'mandrafts' => 0, 'medialib' => 0, 'manlinks' => 0, 'manpages' => 0, 'mancomments' => 0, 'manthemes' => 0, 'manwidgets' => 0, 'manplugins' => 0, 'manusers' => 0, 'tools' => 0, 'settings' => 0, 'entrss' => 0, 'commrss' => 0, 'wplink' => 0, 'linebreaks' => 0));
    $title        = strip_tags($instance['title']);
    $username     = $instance['username'] ? 'checked="checked"' : '';
    $userlink     = $instance['userlink'] ? 'checked="checked"' : '';
    $profile      = $instance['profile'] ? 'checked="checked"' : '';
    $login        = $instance['login'] ? 'checked="checked"' : '';
    $logout       = $instance['logout'] ? 'checked="checked"' : '';
    $loginform    = $instance['loginform'] ? 'checked="checked"' : '';
    $register     = $instance['register'] ? 'checked="checked"' : '';
    $editthispost = $instance['editthispost'] ? 'checked="checked"' : '';
    $editthispage = $instance['editthispage'] ? 'checked="checked"' : '';
    $newpost      = $instance['newpost'] ? 'checked="checked"' : '';
		$newpage			= $instance['newpage'] ? 'checked="checked"' : '';
    $dashboard    = $instance['dashboard'] ? 'checked="checked"' : '';
    $manposts     = $instance['manposts'] ? 'checked="checked"' : '';
    $mandrafts    = $instance['mandrafts'] ? 'checked="checked"' : '';
    $medialib     = $instance['medialib'] ? 'checked="checked"' : '';
    $manlinks     = $instance['manlinks'] ? 'checked="checked"' : '';
    $manpages     = $instance['manpages'] ? 'checked="checked"' : '';
    $mancomments  = $instance['mancomments'] ? 'checked="checked"' : '';
    $manthemes    = $instance['manthemes'] ? 'checked="checked"' : '';
    $manwidgets   = $instance['manwidgets'] ? 'checked="checked"' : '';
    $manplugins   = $instance['manplugins'] ? 'checked="checked"' : '';
    $manusers     = $instance['manusers'] ? 'checked="checked"' : '';
    $tools        = $instance['tools'] ? 'checked="checked"' : '';
    $settings     = $instance['settings'] ? 'checked="checked"' : '';
    $entrss       = $instance['entrss'] ? 'checked="checked"' : '';
    $commrss      = $instance['commrss'] ? 'checked="checked"' : '';
    $wplink       = $instance['wplink'] ? 'checked="checked"' : '';
    $linebreaks   = $instance['linebreaks'] ? 'checked="checked"' : '';
  ?>
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'enhanced-meta-widget'); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
    <div style="text-align:left">
    <?php $adminlocale = get_locale();
    if ($adminlocale=='fr_FR')
      echo '<p>'; // style="font-size: 10px;">';
    else
      echo '<p>';
    _e('Display:<br />', 'enhanced-meta-widget') ?>
    <input class="checkbox" type="checkbox" <?php checked($instance['username'], true) ?> id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" />
    <label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('username', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['userlink'], true) ?> id="<?php echo $this->get_field_id('userlink'); ?>" name="<?php echo $this->get_field_name('userlink'); ?>" />
    <label for="<?php echo $this->get_field_id('userlink'); ?>"><?php _e('username as profile link', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['login'], true) ?> id="<?php echo $this->get_field_id('login'); ?>" name="<?php echo $this->get_field_name('login'); ?>" />
    <label for="<?php echo $this->get_field_id('login'); ?>"><?php _e('login link', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['logout'], true) ?> id="<?php echo $this->get_field_id('logout'); ?>" name="<?php echo $this->get_field_name('logout'); ?>" />
    <label for="<?php echo $this->get_field_id('logout'); ?>"><?php _e('logout link', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['loginform'], true) ?> id="<?php echo $this->get_field_id('loginform'); ?>" name="<?php echo $this->get_field_name('loginform'); ?>" />
    <label for="<?php echo $this->get_field_id('loginform'); ?>"><?php _e('login form', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['register'], true) ?> id="<?php echo $this->get_field_id('register'); ?>" name="<?php echo $this->get_field_name('register'); ?>" />
    <label for="<?php echo $this->get_field_id('register'); ?>"><?php _e('register link', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['newpost'], true) ?> id="<?php echo $this->get_field_id('newpost'); ?>" name="<?php echo $this->get_field_name('newpost'); ?>" />
    <label for="<?php echo $this->get_field_id('newpost'); ?>"><?php _e('<em>new post</em>', 'enhanced-meta-widget'); ?></label><br />
		<input class="checkbox" type="checkbox" <?php checked($instance['newpage'], true) ?> id="<?php echo $this->get_field_id('newpage'); ?>" name="<?php echo $this->get_field_name('newpage'); ?>" />
    <label for="<?php echo $this->get_field_id('newpage'); ?>"><?php _e('<em>new page</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['profile'], true) ?> id="<?php echo $this->get_field_id('profile'); ?>" name="<?php echo $this->get_field_name('profile'); ?>" />
    <label for="<?php echo $this->get_field_id('profile'); ?>"><?php _e('<em>my profile</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['editthispost'], true) ?> id="<?php echo $this->get_field_id('editthispost'); ?>" name="<?php echo $this->get_field_name('editthispost'); ?>" />
    <label for="<?php echo $this->get_field_id('editthispost'); ?>"><?php _e('<em>edit this post</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['editthispage'], true) ?> id="<?php echo $this->get_field_id('editthispage'); ?>" name="<?php echo $this->get_field_name('editthispage'); ?>" />
    <label for="<?php echo $this->get_field_id('editthispage'); ?>"><?php _e('<em>edit this page</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['dashboard'], true) ?> id="<?php echo $this->get_field_id('dashboard'); ?>" name="<?php echo $this->get_field_name('dashboard'); ?>" />
    <label for="<?php echo $this->get_field_id('dashboard'); ?>"><?php _e('<em>site admin</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manposts'], true) ?> id="<?php echo $this->get_field_id('manposts'); ?>" name="<?php echo $this->get_field_name('manposts'); ?>" />
    <label for="<?php echo $this->get_field_id('manposts'); ?>"><?php _e('<em>manage posts</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['mandrafts'], true) ?> id="<?php echo $this->get_field_id('mandrafts'); ?>" name="<?php echo $this->get_field_name('mandrafts'); ?>" />
    <label for="<?php echo $this->get_field_id('mandrafts'); ?>"><?php _e('<em>manage drafts</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['medialib'], true) ?> id="<?php echo $this->get_field_id('medialib'); ?>" name="<?php echo $this->get_field_name('medialib'); ?>" />
    <label for="<?php echo $this->get_field_id('medialib'); ?>"><?php _e('<em>media library</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manlinks'], true) ?> id="<?php echo $this->get_field_id('manlinks'); ?>" name="<?php echo $this->get_field_name('manlinks'); ?>" />
    <label for="<?php echo $this->get_field_id('manlinks'); ?>"><?php _e('<em>manage links</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manpages'], true) ?> id="<?php echo $this->get_field_id('manpages'); ?>" name="<?php echo $this->get_field_name('manpages'); ?>" />
    <label for="<?php echo $this->get_field_id('manpages'); ?>"><?php _e('<em>manage pages</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['mancomments'], true) ?> id="<?php echo $this->get_field_id('mancomments'); ?>" name="<?php echo $this->get_field_name('mancomments'); ?>" />
    <label for="<?php echo $this->get_field_id('mancomments'); ?>"><?php _e('<em>manage comments</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manthemes'], true) ?> id="<?php echo $this->get_field_id('manthemes'); ?>" name="<?php echo $this->get_field_name('manthemes'); ?>" />
    <label for="<?php echo $this->get_field_id('manthemes'); ?>"><?php _e('<em>manage themes</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manwidgets'], true) ?> id="<?php echo $this->get_field_id('manwidgets'); ?>" name="<?php echo $this->get_field_name('manwidgets'); ?>" />
    <label for="<?php echo $this->get_field_id('manwidgets'); ?>"><?php _e('<em>manage widgets</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manplugins'], true) ?> id="<?php echo $this->get_field_id('manplugins'); ?>" name="<?php echo $this->get_field_name('manplugins'); ?>" />
    <label for="<?php echo $this->get_field_id('manplugins'); ?>"><?php _e('<em>manage plugins</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['manusers'], true) ?> id="<?php echo $this->get_field_id('manusers'); ?>" name="<?php echo $this->get_field_name('manusers'); ?>" />
    <label for="<?php echo $this->get_field_id('manusers'); ?>"><?php _e('<em>manage users</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['tools'], true) ?> id="<?php echo $this->get_field_id('tools'); ?>" name="<?php echo $this->get_field_name('tools'); ?>" />
    <label for="<?php echo $this->get_field_id('tools'); ?>"><?php _e('<em>tools</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['settings'], true) ?> id="<?php echo $this->get_field_id('settings'); ?>" name="<?php echo $this->get_field_name('settings'); ?>" />
    <label for="<?php echo $this->get_field_id('settings'); ?>"><?php _e('<em>settings</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['entrss'], true) ?> id="<?php echo $this->get_field_id('entrss'); ?>" name="<?php echo $this->get_field_name('entrss'); ?>" />
    <label for="<?php echo $this->get_field_id('entrss'); ?>"><?php _e('<em>entries rss</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['commrss'], true) ?> id="<?php echo $this->get_field_id('commrss'); ?>" name="<?php echo $this->get_field_name('commrss'); ?>" />
    <label for="<?php echo $this->get_field_id('commrss'); ?>"><?php _e('<em>comments rss</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['wplink'], true) ?> id="<?php echo $this->get_field_id('wplink'); ?>" name="<?php echo $this->get_field_name('wplink'); ?>" />
    <label for="<?php echo $this->get_field_id('wplink'); ?>"><?php _e('<em>wordpress.org</em>', 'enhanced-meta-widget'); ?></label><br />
    <input class="checkbox" type="checkbox" <?php checked($instance['linebreaks'], true) ?> id="<?php echo $this->get_field_id('linebreaks'); ?>" name="<?php echo $this->get_field_name('linebreaks'); ?>" />
    <label for="<?php echo $this->get_field_id('linebreaks'); ?>"><?php _e('line breaks between sections', 'enhanced-meta-widget'); ?></label>
    </div>
  <?php
  } // ends form function
} //closes class function
add_action('widgets_init', create_function('', 'return register_widget("meta_enhanced");'));
/*
* Set Locale and get appropriate language translation
*/
$mylocale = get_locale();
$localedir = 'enhanced-meta-widget/lang/' . $mylocale;
load_plugin_textdomain('enhanced-meta-widget', '', $localedir);