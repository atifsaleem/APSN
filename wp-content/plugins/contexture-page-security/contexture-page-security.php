<?php
/*
Plugin Name: Page Security by Contexture
Plugin URI: http://www.contextureintl.com/open-source-projects/contexture-page-security-for-wordpress/
Description: Allows admins to create user groups and restrict access to sections of the site by group.
Version: 1.5.3
Author: Contexture Intl, Matt VanAndel
Author URI: http://www.contextureintl.com
License: GPL2
*/
/*  Copyright 2010  Contexture Intl.  (email : webteam@contextureintl.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/***************************** SET GLOBALS ************************************/
/**The absolute local path to the plugin*/
define('CTXPSPATH',dirname(__FILE__));
/**The directory path to the plugin*/
define('CTXPSDIR',basename(CTXPSPATH));
/**The URL of the plugin directory*/
define('CTXPSURL',plugin_dir_url(__FILE__));
/**If true, uses dev javascript - minify all dev js and set this to false before release */
define('CTXPSJSDEV',false);
global $wpdb, $ctxpsdb;

/**************************** LOAD CORE FILES *********************************/
require_once 'core/model.php';          //Model instance ($ctxpsdb)
require_once 'core/queries.php';        //Stored db queries
require_once 'core/helpers.php';        //Common, reusable classes, methods, functions
/**************************** LOAD COMPONENTS *********************************/
require_once 'components/app_components.php';          //Plugin-wide components
require_once 'components/shortcode_components.php';    //Short-codes
require_once 'components/table_components.php';        //Table generator
require_once 'components/table-packages.php';          //Table generator packages
/**************************** LOAD CORE CONTROLLERS ***************************/
require_once 'core/CTXPS_App.php';         //Common, reusable classes, methods, functions
require_once 'core/CTXPS_Security.php';    //Most of the permissions-checking code is here
require_once 'core/CTXPS_Ajax.php';        //AJAX-specific methods
require_once 'core/CTXPS_Router.php';      //All requests for views are sent through here

/********************** SPARTAN REQUIREMENT CHECK *****************************/
if(is_admin()){
    //If we're accessing a WP admin page, check PHP requirements
    CTXPS_Queries::check_php_version();
    //And check that WP 3.2+ is being used
    CTXPS_Queries::check_wp_version();
}

/******************************** HOOKS ***************************************/
// Install new tables (on activate)
register_activation_hook(__FILE__,array('CTXPS_Queries','plugin_install'));
// Remove tables from db (on delete)
register_uninstall_hook(__FILE__,array('CTXPS_Queries','plugin_delete'));


// Add "Groups" option to "Users" in admin
add_action('admin_menu', array('CTXPS_App','admin_screens_init'));
// Add a "Groups" view to a user's user-edit.php page
add_action('edit_user_profile', array('CTXPS_Router','user_groups'));
// Add a "Groups" view to a user's profile.php page
add_action('show_user_profile', array('CTXPS_Router','user_groups'));

//Add the security box sidebar to the pages section
add_action('admin_init', array('CTXPS_App','admin_init'));

//Load localized language files
add_action('init',array('CTXPS_App','localize_init'));

//Handle Ajax for Edit Page/Post page
add_action('wp_ajax_ctxps_add_group_to_post', array('CTXPS_Ajax','add_group_to_post'));
add_action('wp_ajax_ctxps_remove_group_from_page', array('CTXPS_Ajax','remove_group_from_page'));
add_action('wp_ajax_ctxps_security_update', array('CTXPS_Ajax','update_security'));

//Handle Ajax for term page
add_action('wp_ajax_ctxps_add_group_to_term', array('CTXPS_Ajax','add_group_to_term'));
add_action('wp_ajax_ctxps_remove_group_from_term', array('CTXPS_Ajax','remove_group_from_term'));

//Handle Ajax for Edit User page
add_action('wp_ajax_ctxps_add_group_to_user', array('CTXPS_Ajax','add_group_to_user'));
add_action('wp_ajax_ctxps_remove_group_from_user', array('CTXPS_Ajax','remove_group_from_user'));
add_action('wp_ajax_ctxps_update_member', array('CTXPS_Ajax','update_membership'));

//handle Ajax for bulk add
add_action('wp_ajax_ctxps_user_bulk_add', array('CTXPS_Ajax','add_bulk_users_to_group'));

//Add basic security to all public "static" pages and posts [highest priority]
add_action('wp', array('CTXPS_Security','protect_content'),1);

//Add basic security to dynamically displayed posts (such as on Blog Posts Page, ie: Home) [highest priority]
add_filter('the_posts', array('CTXPS_Security','filter_loops'),1);

//Ensure that menus do not display protected pages (when using default menus only) [highest priority]
add_filter('get_pages', array('CTXPS_Security','filter_auto_menus'),1);
//Ensure that menus do not display protected pages (when using WP3 custom menus only) [highest priority]
add_filter('wp_get_nav_menu_items', array('CTXPS_Security','filter_custom_menus'),1);

//Add shortcodes!
add_shortcode('groups_attached', array('CTXPS_Shortcodes','groups_attached')); //Current page permissions only
add_shortcode('groups_required', array('CTXPS_Shortcodes','groups_required')); //Complete permissions for current page

//Update the edit.php pages & posts lists to include a "Protected" column
add_filter('manage_pages_columns', array('CTXPS_Components','add_list_protection_column'));
add_filter('manage_posts_columns', array('CTXPS_Components','add_list_protection_column'));
add_action('manage_pages_custom_column', array('CTXPS_Components','render_list_protection_column'),10,2); //Priority 10, Takes 2 args (use default priority only so we can specify args)
add_action('manage_posts_custom_column', array('CTXPS_Components','render_list_protection_column'),10,2); //Priority 10, Takes 2 args (use default priority only so we can specify args)
//Taxonomy columns added from admin_init (app_controller.php)

//Modify the global help array so we can add extra help text to default WP pages
add_action('admin_head', array('CTXPS_App','help_init'));

//Inject Javascript that marks used category tags
add_action('admin_head', array('CTXPS_Security','tag_protected_terms_heirarchal'));
//Also add asterisks to unused tags
add_action('tag_cloud_sort', array('CTXPS_Security','tag_protected_terms_unused'),10,2);

//add_action('edit_terms', array('CTXPS_Queries','toggle_term_protection')); //Disabled. This is now done via ajax


/*********************** FUNCTIONS **********************************/

//Load deprecated theme functions
require_once 'controllers/theme-functions.php';

//Super-handy tool for taking a peek at ALL available variables in the plugin scope
//wp_die(var_dump(get_defined_vars()));

?>