<?php
if(!class_exists('CTXPS_App')){
/**
 * Static. Application-level methods, such as init methods.
 */
class CTXPS_App{

    /**
     * Adds the security box on the right side of the 'edit page' admin section
     */
    public static function admin_init(){
        //Add our JS strings (using PHP allows us to localize JS strings)
        add_action('admin_head', array('CTXPS_App','js_strings_init'));

        //Enable Restrict Access sidebar for ALL post types (will also automatically enable support for any custom types)
        $post_types = get_post_types();
        foreach($post_types as $type){
            add_meta_box('ctxps-grouplist-box', 'Restrict Access', array('CTXPS_Router','sidebar_security'), $type, 'side', 'low');
        }unset($type);
        //Enable Restrict Access options for taxonomy terms
        $tax_types = get_taxonomies();
        foreach($tax_types as $tax){
            //Add fields to the taxonomy term edit form
            add_action( $tax.'_edit_form', array('CTXPS_Router','security_tax') );
            //Add "fields to the taxonomy add form"General Settings" title to
            add_action( $tax.'_edit_form', array('CTXPS_Components','render_taxonomy_protection_panel_pre') );
            //Add protected columns to all taxonomy types
            add_filter('manage_edit-'.$tax.'_columns', array('CTXPS_Components','add_term_protection_column'));
            add_action('manage_'.$tax.'_custom_column', array('CTXPS_Components','render_term_protection_column'),10,3); //Priority 10, Takes 2 args (use default priority only so we can specify args)
        }unset($tax);

        //Add our custom admin styles
        wp_enqueue_style('psc_admin',CTXPSURL.'views/admin.css');

        //Add an asterisk to the end of protected terms
        add_filter('terms_to_edit',array('CTXPS_Security','tag_protected_terms'),10,2);
        //add_filter('the_category',array('CTXPS_Security','tag_protected_terms_heirarchal')); //Disabled, 'post' post type reports incorrect taxonomy
    }


    /**
     * Adds additional contextual help to WordPress' existing contextual help screens
     * @global array $_wp_contextual_help
     */
    public static function help_init(){
        //We bring in the global help array so we can modify it
        global $_wp_contextual_help,$pagenow;

        $post_types = get_post_types();
        $taxonomies = get_taxonomies();

        //Build a visual key showing the icons and their meanings
        $iconkey = '<p><div><img src="'.CTXPSURL.'/images/protected-inline.png" alt="" title=""> '.__('The content is protected directly.','contexture-page-security').'</div><div><img src="'.CTXPSURL.'/images/protected-inline-descendant.png" alt="" title=""> '.__('The content is inheriting protection from a parent.','contexture-page-security').'</div><div><img src="'.CTXPSURL.'/images/protected-inline-inherit.png" alt="" title=""> '.__('The content is inheriting protection from one or more terms.','contexture-page-security').'</div></p>';
        //Link to be added to all help text
        $supporturl = '<p><a href="http://www.contextureintl.com/open-source-projects/contexture-page-security-for-wordpress/">'.__('Official Page Security Support','contexture-page-security').'</a></p>';
        //Help text for post edit page
        $posthelp = '<div style="border-top:1px solid silver;"></div>'.sprintf(__('<h4><strong>Page Security:</strong></h4><p>To restrict access to this content, find the "Restrict Access" sidebar and check the box next to "Protect this page and its decendants". This will reveal some additional options.</p><p>If a page is protected, but you don\'t have any groups assigned to it, only admins will be able to see or access the page. To give users access to the page, select a group from the "Available Groups" drop-down and click "Add". You may need to <a href="%s">create a group</a>, if you haven\'t already.</p><p>To remove a group, either uncheck the "Protect this page..." box (all permissions will be removed), or find a group in the "Allowed Groups" list and click "Remove".</p><p>All changes are saved immediately. There is no need to click "Update" in order to save your security settings.</p>','contexture-page-security').$supporturl,admin_url('users.php?page=ps_groups_add'));
        //Help text for post listing pages
        $postlisthelp = '<div style="border-top:1px solid silver;"></div>'.sprintf(__('<h4><strong>Page Security:</strong></h4><p>The lock icons indicate which content is protected. Dark icons are shown when content is directly protected, while the lighter icons indicate that permissions are being inherited.</p>','contexture-page-security').$iconkey.$supporturl,admin_url('users.php?page=ps_groups_add'));
        //Help text for term edit page
        $termhelp = '<div style="border-top:1px solid silver;"></div>'.sprintf(__('<h4><strong>Page Security:</strong></h4><p>When you protect a term, such as a category or tag, you are also protecting every piece of content that uses the term. For heirarchal terms (like "Categories") any child terms are also protected, as well as any content attached to those terms.</p><p>To restrict access to this term (as well as its children and associated content), find the "Restrict Access" section and check the box next to "Protect this term and any content associated with it". This will reveal some additional options.</p><p>If a term is protected, but you don\'t have any groups assigned to it, only admins will be able to see or access the page. To give users access to the page, select a group from the "Add group..." drop-down and click "Add". You may need to <a href="%s">create a group</a>, if you haven\'t already.</p><p>To remove restrictions, either uncheck the "Protect this term..." box (all permissions and groups will be removed), or select the "Remove" option for any specific group in the list.</p><p>All changes are saved immediately. There is no need to click "Update" in order to save your security settings.</p><p><em>Note: Term permissions are post-specific, and are not passed to descendant pages.</em></p>','contexture-page-security').$supporturl,admin_url('users.php?page=ps_groups_add'));

        //Append additional help to users page (use preg_replace to add it seamlessly before "Fore more information")
        if(isset($_wp_contextual_help['users']))
            $_wp_contextual_help['users'] .= '<div style="border-top:1px solid silver;"></div>'.__('<h4><strong>Page Security:</strong></h4><p>To add a user to a group, check the users to add, and select a group from the "Add to group..." drop down. Click "Add" to save the changes.</p>','contexture-page-security');

        //Loop through all post types and modify help
        foreach($post_types as $ptype){
            if(isset($_wp_contextual_help[$ptype]))
                $_wp_contextual_help[$ptype] .= $posthelp;
            else
                $_wp_contextual_help[$ptype] = __('<p>This is a custom post type.</p>').$posthelp;

            if(isset($_wp_contextual_help['edit-'.$ptype]))
                $_wp_contextual_help['edit-'.$ptype] .= $postlisthelp;
            else
                $_wp_contextual_help['edit-'.$ptype] = __('<p>This is a custom post type.</p>').$postlisthelp;
        }
        //Loop through all taxonomies and modify help
        foreach($taxonomies as $tax){

                //Handle edit term pages
                if( isset($_REQUEST['action']) && 'edit'===$_REQUEST['action'] ){
                    if(isset($_wp_contextual_help['edit-'.$tax]))
                        $_wp_contextual_help['edit-'.$tax] .= $termhelp;
                    else
                        $_wp_contextual_help['edit-'.$tax] = $termhelp;
                //Handle term list (taxonomy) pages
                }else{
                    if(isset($_wp_contextual_help['edit-'.$tax]))
                        $_wp_contextual_help['edit-'.$tax] .= $postlisthelp;
                    else
                        $_wp_contextual_help['edit-'.$tax] = $postlisthelp;
                }

        }

        if ( function_exists('add_contextual_help') ){
            //Add our contextual help
            add_contextual_help( 'users_page_ps_groups', __('<p>This screen shows a list of all the groups currently available. Groups are used to arbitrarily "group" users together for permissions purposes. Once you "attach" one or more groups to a piece of content, only users in one of those groups will be able to access it!</p><p>You can also view a complete list of a groups members and associated content by clicking on the groups name.</p><p>&bull; <strong>Registered Users</strong> - This is a system group that is automatically applied to all registered users. It can\'t be edited or deleted as it is managed by WordPress automatically.</p><p><strong>For more information:</strong></p>','contexture-page-security').$supporturl );
            add_contextual_help( 'users_page_ps_groups_add', __('<p>This screen allows you to add a new group. Simply enter a new, unique name for your group, and an optional description.</p><p>Once created, you will be able to add users to the group from either the Group or Users pages.</p><p><strong>For more information:</strong></p>','contexture-page-security').$supporturl );
            $ps_groups_edit = __('<p>This screen shows you all the details about the current group, and allows you to edit some of those details.</p><p>&bull; <strong>Group Details</strong> - Change a group\'s title or description.</p><p>&bull; <strong>Site Access</strong> - This option is visible if you have Site Protection enabled. Set to "Allowed" if you would like users in this group to be able to access your website. All content-specific restrictions still apply.</p><p>&bull; <strong>Group Members</strong> - A list of users currently attached to the group. You also add users to a group if you know their username (users can also be added to groups from their profile pages).</p><p>&bull; <strong>Associated Content</strong> - A list of all the content that this group is attached to.</p><p><strong>For more information:</strong></p>','contexture-page-security').$supporturl;
            add_contextual_help( 'dashboard_page_ps_groups_edit', $ps_groups_edit );
            add_contextual_help( 'users_page_ps_groups_edit', $ps_groups_edit );
            $ps_groups_delete = __('<p>This screen allows you to delete the selected group. Once you click "Confirm Deletion", the group will be permanently deleted, and all users will be removed from the group.</p><p>Also note that if this is the only group attached to any "restricted" pages, those pages will not longer be accessible to anyone but administrators.</p><p><strong>For more information:</strong></p>','contexture-page-security').$supporturl;
            add_contextual_help( 'dashboard_page_ps_groups_delete', $ps_groups_delete );
            add_contextual_help( 'users_page_ps_groups_delete', $ps_groups_delete );
            add_contextual_help( 'settings_page_ps_manage_opts', __('<p>This screen contains general settings for Page Security.</p><p><strong>For more information:</strong></p>','contexture-page-security').$supporturl );
            //add_contextual_help( 'users_page', __('<p><strong>Page Security:</strong></p><p>To add multiple users to a group, check off the users you want to add, select the group from the "Add to group..." drop-down, and click "Add".</p><p><p><strong>For more information:</strong></p><a href="http://www.contextureintl.com/open-source-projects/contexture-page-security-for-wordpress/">Official Page Security Support</a></p>','contexture-page-security') );
        }

        //If this is the users page, use javascript to inject another bulk options box (damn you, WP core team for pulling my 3.1 bulk hooks!)
        if($pagenow==='users.php' && empty($_GET['page']) && current_user_can( 'promote_users' )){
            self::js_userbulk_init();
        }
    }

    /**
     * Adds some custom JS to the header, primarily AJAX. We can't enqueue these since we need PHP localization for the strings.
     */
    public static function js_strings_init(){
        ?>
        <script type="text/javascript">
            var ctxpsmsg = {
                NoUnprotect : '<?php _e('You cannot unprotect this page. It is protected by a parent or ancestor.','contexture-page-security') ?>',
                EraseSec : "<?php _e("This will completely erase this content's security settings and make it accessible to the public. Continue?",'contexture-page-security') ?>",
                RemoveGroup : '<?php _e('Are you sure you want to remove group "%s" from this page?','contexture-page-security') ?>',
                RemovePage : '<?php _e('Are you sure you want to remove this group from %s ?','contexture-page-security') ?>',
                RemoveUser : '<?php _e('Remove this user from the group?','contexture-page-security') ?>',
                YearRequired : '<?php _e('You must specify an expiration year.','contexture-page-security') ?>',
                GeneralError : '<?php _e('An error occurred: ','contexture-page-security') ?>',
                NoGroupSel : '<?php _e('You must select a group to add.','contexture-page-security') ?>',
                SiteProtectAdd : '<?php _e('This adds protection at a site level. Until you select site options for each group, your users will be unable to access the website.','contexture-page-security') ?>',
                SiteProtectDel : '<?php _e('This will completely erase site-level security settings and make it accessible to the public. Continue?','contexture-page-security') ?>'
            };
            jQuery(function(){
                jQuery('#post .tagsdiv, #post .categorydiv').parent().append('<p style="color:silver;border-top:1px solid #EEE;">* <em>indicates protected terms.</em></p>');
            });
        </script>
        <script type="text/javascript" src="<?php echo CTXPSURL.'js/core-ajax'.((CTXPSJSDEV)?'.dev':'').'.js' ?>"></script>
        <?php
    }



    /**
     * Adds various menu items to WordPress admin
     */
    public static function admin_screens_init(){
        //Add Groups option to the WP admin menu under Users (these also return hook names, which are needed for contextual help)
        add_submenu_page('users.php', __('Group Management','contexture-page-security'), __('Groups','contexture-page-security'), 'manage_options', 'ps_groups', array('CTXPS_Router','groups_list'));
        add_submenu_page('users.php', __('Add a Group','contexture-page-security'), __('Add Group','contexture-page-security'), 'manage_options', 'ps_groups_add', array('CTXPS_Router','group_add'));
        add_submenu_page('', __('Edit Group','contexture-page-security'), __('Edit Group','contexture-page-security'), 'manage_options', 'ps_groups_edit', array('CTXPS_Router','group_edit'));
        add_submenu_page('', __('Delete Group','contexture-page-security'), __('Delete Group','contexture-page-security'), 'manage_options', 'ps_groups_delete', array('CTXPS_Router','group_delete'));

        add_options_page('Page Security by Contexture', 'Page Security', 'manage_options', 'ps_manage_opts', array('CTXPS_Router','options'));
        //add_submenu_page('options-general.php', 'Page Security', 'Page Security', 'manage_options', 'ps_manage_opts', 'ctx_ps_page_options');
    }

    /**
     * Loads localized language files, if available
     */
    public static function localize_init(){
       if (function_exists('load_plugin_textdomain')) {
          load_plugin_textdomain('contexture-page-security', false, CTXPSDIR.'/languages' );
       }
    }

    /**
     * Creates a new group
     *
     * @global wpdb $wpdb
     * @param string $name A short, meaningful name for the group
     * @param string $description A more detailed description for the group
     * @return <type>
     */
    public static function create_group($name, $description){
        global $wpdb;

        if(!CTXPS_Queries::check_group_exists($name)){
            $current_user = wp_get_current_user();

            if(CTXPS_Queries::add_group($name, $description, $current_user->ID) !== FALSE){
                return '<div id="message" class="updated"><p>'.__('New group created','contexture-page-security').'</p></div>';
            }else{
                return '<div id="message" class="error below-h2"><p>'.__('Unable to create group. There was an unspecified system error.','contexture-page-security').'</p></div>';
            }
        } else {
            return '<div id="message" class="error below-h2"><p>'.__('Unable to create group. A group with that name already exists.','contexture-page-security').'</p></div>';
        }
    }

    /**
     * Uses javascript to inject an AJAX-loaded bulk-add-to-group box to the Users list
     */
    public static function js_userbulk_init(){
        ?>
        <script type="text/javascript">
            jQuery(function(){
                jQuery('.tablenav.top .alignleft.actions:last').after('<?php echo CTXPS_Components::render_bulk_add_to_group(); ?>');
            });
        </script>
        <?php
    }

}
}

?>