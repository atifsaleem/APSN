<?php
if(!class_exists('CTXPS_Ajax')){
class CTXPS_Ajax {

    /**
     * GENERAL. Handles ajax requests to add a group to various content. When successful, generates HTML to be used in the "Allowed Groups"
     * section of the "Restrict Page" sidebar. Spits out XML response for AJAX use.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     */
    public static function add_group_to_term(){
        global $wpdb, $ctxpsdb;

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('edit_others_posts')){
            //ERROR! If user isn't authorized, stop and return error
            $response = new WP_Ajax_Response(array(
                'what'=>    'add_group',
                'action'=>  'add_group_to_post',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            ));
            $response->send();
        }

        //Run the query
        $result = CTXPS_Queries::add_security($_REQUEST['content_id'], $_REQUEST['group_id'], 'term');

        if($result!==false){

            //Get security info for the specified page and it's parents
            //$security = CTXPS_Security::get_term_protection( $_REQUEST['content_id'], $_REQUEST['taxonomy'] );

            $response = new WP_Ajax_Response(array(
                'what'=>    'add_group',
                'action'=>  'add_group_to_post',
                'id'=>      1,
                'data'=>    __('Group added to content','contexture-page-security'),
                'supplemental'=> array( 'html'=>new CTXPS_Table_Packages( 'taxonomy_term_groups', false, true ) )
            ));

            $response->send();
        }
    }

    /**
     * Alias for add_group_to_post() for BC purposes.
     */
    public static function add_group_to_page(){
        self::add_group_to_post();
    }

    /**
     * SIDEBAR. Handles ajax requests to add a group to a page. When successful, generates HTML to be used in the "Allowed Groups"
     * section of the "Restrict Page" sidebar. Spits out XML response for AJAX use.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     */
    public static function add_group_to_post(){
        global $wpdb, $ctxpsdb;

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('edit_others_posts')){
            //ERROR! If user isn't authorized, stop and return error
            $response = new WP_Ajax_Response(array(
                'what'=>    'add_group',
                'action'=>  'add_group_to_post',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            ));
            $response->send();
        }

        //If the protected flag isnt explicitly set already, set it (prevent problems when parent permissions are removed)
        if(!get_post_meta($_REQUEST['post_id'], 'ctx_ps_security'))
            add_post_meta($_REQUEST['post_id'], 'ctx_ps_security', '1', true);

        //Run the query
        $result = CTXPS_Queries::add_security( $_REQUEST['post_id'], $_REQUEST['group_id'] );

        if($result!==false){

            //Get security info for the specified page and it's parents
            $security = CTXPS_Security::get_post_protection( $_REQUEST['post_id'] );

            //SUCCESS!
            $response = new WP_Ajax_Response(array(
                'what'=>    'add_group',
                'action'=>  'add_group_to_post',
                'id'=>      1,
                'data'=>    __('Group added to content','contexture-page-security'),
                'supplemental'=>array( 'html'=>CTXPS_Components::render_sidebar_attached_groups( $security, $_REQUEST['post_id'] ) )
            ));
            $response->send();
        }
    }

    /**
     * Handles ajax requests to remove a group from a specified page
     */
    public static function remove_group_from_page(){
        global $wpdb;

        $response='';
        $supplemental=array();

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('edit_others_posts')){
            //ERROR! If user isn't authorized
            $response = array(
                'what'=>    'remove_group',
                'action'=>  'remove_group_from_page',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            );
            $response = new WP_Ajax_Response($response);
            $response->send();
        }

        if(CTXPS_Queries::delete_security($_REQUEST['post_id'],$_REQUEST['group_id']) !== false){
            //Which content do we need to render?
            if(isset($_REQUEST['requester']) && $_REQUEST['requester']=='sidebar'){
                $supplemental = array('html'=>CTXPS_Components::render_sidebar_attached_groups($_REQUEST['post_id']));//We need to regenerate sidebar content
            }else{
                $supplemental = array('html'=>new CTXPS_Table_Packages('associated_content',false,true)/*CTXPS_Components::render_content_by_group_list($_REQUEST['group_id'])*/);//We need to regenerate list-table content
            }

            //SUCCESS!
            $response = array(
                'what'=>    'remove_group',
                'action'=>  'remove_group_from_page',
                'id'=>      1,
                'data'=>    __('Group removed from content','contexture-page-security'),
                'supplemental'=>$supplemental
            );
        }
        else{
            //ERROR!
            $response = array(
                'what'=>    'remove_group',
                'action'=>  'remove_group_from_page',
                'id'=>      new WP_Error('error',__('Query failed or content not in group.','contexture-page-security'))
            );
        }
        $response = new WP_Ajax_Response($response);
        $response->send();
    }

    /**
     * Handles ajax requests to remove a group from a specified page
     */
    public static function remove_group_from_term(){
        global $wpdb;

        $response='';
        $supplemental=array();

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('edit_others_posts')){
            //ERROR! If user isn't authorized
            $response = array(
                'what'=>    'remove_group',
                'action'=>  'remove_group_from_term',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            );
            $response = new WP_Ajax_Response($response);
            $response->send();
        }

        //NOT YET UPDATED BELOW THIS LINE!!!!!!
        if( CTXPS_Queries::delete_security( $_REQUEST['content_id'], $_REQUEST['group_id'], 'term' )!==false ){
            //Which content do we need to render?
            $supplemental = array('html'=>new CTXPS_Table_Packages('taxonomy_term_groups',false,true));//We need to regenerate list-table content

            //SUCCESS!
            $response = array(
                'what'=>    'remove_group',
                'action'=>  'remove_group_from_term',
                'id'=>      1,
                'data'=>    __('Group removed from content','contexture-page-security'),
                'supplemental'=>$supplemental
            );
        }
        else{
            //ERROR!
            $response = array(
                'what'=>    'remove_group',
                'action'=>  'remove_group_from_term',
                'id'=>      new WP_Error('error',__('Query failed or content not in group.','contexture-page-security'))
            );
        }
        $response = new WP_Ajax_Response($response);
        $response->send();
    }

    /**
     * GROUP EDIT > USERS. USER PROFILES. Handles ajax requests to add a user to a group
     *
     * @global wpdb $wpdb
     */
    public static function add_group_to_user(){
        global $wpdb;

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('promote_users')){
            //ERROR! If user isn't authorized
            $response = new WP_Ajax_Response(array(
                'what'=>    'enroll',
                'action'=>  'add_group_to_user',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            ));
            $response->send();
        }

        //If this user doesn't exist
        if(!CTXPS_Queries::check_user_exists($_REQUEST['user_id'])){
            //ERROR!
            $response = new WP_Ajax_Response(array(
                'what'=>    'enroll',
                'action'=>  'add_group_to_user',
                'id'=>      new WP_Error('error',__('User not found','contexture-page-security'))
            ));
            $response->send();
        } else {

            //Make sure user isnt already in the group
            if(CTXPS_Queries::check_membership($_REQUEST['user_id'], $_REQUEST['group_id'])){
                //ERROR!
                $response = new WP_Ajax_Response(array(
                    'what'=>    'enroll',
                    'action'=>  'add_group_to_user',
                    'id'=>      new WP_Error('error',__('User already in group','contexture-page-security'))
                ));
                $response->send();
            }

            //Add the user to the group
            if(CTXPS_Queries::add_membership($_REQUEST['user_id'], $_REQUEST['group_id']) === false){
                //ERROR!
                $response = new WP_Ajax_Response(array(
                    'what'=>    'enroll',
                    'action'=>  'add_group_to_user',
                    'id'=>      new WP_Error('error',__('Query failed','contexture-page-security'))
                ));
                $response->send();
            } else {
                //SUCCESS!!!!
                $response = new WP_Ajax_Response(array(
                    'what'=>    'enroll',
                    'action'=>  'add_group_to_user',
                    'id'=>      1,
                    'data'=>    __('User enrolled in group','contexture-page-security'),
                    'supplemental'=>array('html'=>CTXPS_Components::render_group_list($_REQUEST['user_id'],'users'))//We need to regenerate table content
                ));
                $response->send();
            }
        }

    }


    /**
     * GROUP MEMBER TABLE. Handles ajax requests to update a users membership info
     *
     * @global wpdb $wpdb
     */
    public static function update_membership(){
        global $wpdb;

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('promote_users')){
            //ERROR! If user isn't authorized, stop and return error
            $response = new WP_Ajax_Response(array(
                'what'=>    'update',
                'action'=>  'update_membership',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            ));
            $response->send();
        }

        //Determine if we need to pass NULL or a DateTime value...
        $db_expires = ($_POST['expires']=='1') ? $_POST['date'] : 'NULL';
        
        //Determine response
        if(CTXPS_Queries::update_enrollment_grel($_POST['grel'], $db_expires) === false){
            $response = array(
                'what'=>    'update',
                'action'=>  'update_membership',
                'id'=>      new WP_Error('error',__('Query failed.','contexture-page-security'))
            );
        } else {
            $response = array(
                'what'=>    'update',
                'action'=>  'update_membership',
                'id'=>      1,
                'data'=>    __('User membership updated to '.$db_expires,'contexture-page-security')
            );
        }
        $response = new WP_Ajax_Response($response);
        $response->send();
    }

    /**
     * GROUP EDIT & USER PROFILE. Handles ajax requests to remove a group from a users account
     *
     * @global wpdb $wpdb
     */
    public static function remove_group_from_user(){
        global $wpdb, $current_user;
        $response = array();

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if(!current_user_can('promote_users')){
            //ERROR! - membership not found.
            $response = new WP_Ajax_Response(array(
                'what'=>    'unenroll',
                'action'=>  'remove_group_from_user',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            ));
            $response->send();
        }

        if( !CTXPS_Queries::delete_membership( $_REQUEST['user_id'], $_REQUEST['group_id'] ) ){
            //Error - membership not found.
            $response = array(
                'what'=>    'unenroll',
                'action'=>  'remove_group_from_user',
                'id'=>      new WP_Error('error',__('User not found in group.','contexture-page-security'))
            );
        } else {
            //SUCCESS!
            $response = array(
                'what'=>    'unenroll',
                'action'=>  'remove_group_from_user',
                'id'=>      1,
                'data'=>    __('User removed from group.','contexture-page-security'),
                'supplemental'=>array( 'html'=>CTXPS_Components::render_group_list( $_REQUEST['user_id'], 'users', current_user_can('promote_users'), ($_REQUEST['user_id']==$current_user->ID) ) )//We need to regenerate table content
            );
        }
        $response = new WP_Ajax_Response($response);
        $response->send();
    }

    /**
     * Toggles page security on or off - removes all groups from post if toggled off
     *
     * @global wpdb $wpdb
     */
    public static function update_security(){
        global $wpdb;
        $response = array();

        //Added in 1.1 - ensures current user is an admin before processing, else returns an error (probably not necessary - but just in case...)
        if( !current_user_can('edit_others_posts') ){
            //ERROR! - membership not found.
            $response = new WP_Ajax_Response(array(
                'what'=>    'update_sec',
                'action'=>  'update_security',
                'id'=>      new WP_Error('error',__('User is not authorized.','contexture-page-security'))
            ));
            $response->send();
        }

        //VALIDATE - ensure type and id are set
        if(empty($_REQUEST['object_type']) || empty($_REQUEST['object_id'])){
            //ERROR! - membership not found.
            $response = new WP_Ajax_Response(array(
                'what'=>    'update_sec',
                'action'=>  'update_security',
                'id'=>      new WP_Error('error',__('Object type or ID was not defined.','contexture-page-security'))
            ));
            $response->send();
        }


        //PROCESS REQUEST....
        switch($_REQUEST['setting']){

            //TURNING SECURITY ON
            case 'on':
                $response = array(
                    'what'=>    'update_sec',
                    'action'=>  'update_security',
                    'id'=>      add_metadata($_REQUEST['object_type'], $_REQUEST['object_id'], 'ctx_ps_security', '1', true),
                    'data'=>    __('Security enabled.','contexture-page-security')
                );
                break;

            //TURNING SECURITY OFF
            case 'off':
                if(CTXPS_Queries::delete_security($_REQUEST['object_id'],'',$_REQUEST['object_type']) !== false){
                    //Successfully deleted security
                    $response = array(
                        'what'=>    'update_sec',
                        'action'=>  'update_security',
                        'id'=>      delete_metadata($_REQUEST['object_type'], $_REQUEST['object_id'], 'ctx_ps_security'),
                        'data'=>    __('Security disabled.','contexture-page-security')
                    );
                    //If we disabled a term, return supplemental table data
                    if($_REQUEST['object_type']=='term'){
                        $response['supplemental'] = array( 'html'=>new CTXPS_Table_Packages( 'taxonomy_term_groups', false, true ) );
                    }
                }else{
                    //Failed to delete security
                    $response = new WP_Ajax_Response(array(
                        'what'=>    'update_sec',
                        'action'=>  'update_security',
                        'id'=>      new WP_Error('error',__('Query failed.','contexture-page-security'))
                    ));
                }
                break;

            //ERROR: UNSPECIFIED SETTING CHANGE
            default:
                $response = new WP_Ajax_Response(array(
                    'what'=>    'update_sec',
                    'action'=>  'update_security',
                    'id'=>      new WP_Error('error',__('Unrecognized request.','contexture-page-security'))
                ));
                break;
        }

        //SEND THE RESULT
        $response = new WP_Ajax_Response($response);
        $response->send();
    }

    public static function add_bulk_users_to_group(){
        $added_users = 0;

        //ERROR - No users selected!
        if(empty($_REQUEST['users'])){
            $response = new WP_Ajax_Response(array(
                'what'=>    'bulk_enroll',
                'action'=>  'add_bulk_users_to_group',
                'id'=>      new WP_Error('error',__('No users were selected.','contexture-page-security')),
                'supplemental'=>array('html'=>  CTXPS_Components::render_wp_message(__('No users were selected.','contexture-page-security'), 'error'))
            ));
            $response->send();
        }

        //ERROR - No group selected
        if(empty($_REQUEST['group_id'])){
            $response = new WP_Ajax_Response(array(
                'what'=>    'bulk_enroll',
                'action'=>  'add_bulk_users_to_group',
                'id'=>      new WP_Error('error',__('No group was selected.','contexture-page-security')),
                'supplemental'=>array('html'=>  CTXPS_Components::render_wp_message(__('No group was selected.','contexture-page-security'), 'error'))
            ));
            $response->send();
        }

        //Loop through all selected users...
        foreach($_REQUEST['users'] as $user){
            //Ensure users exists and is isnt already in group
            if(CTXPS_Queries::check_user_exists($user['value']) && !CTXPS_Queries::check_membership($user['value'], $_REQUEST['group_id'])){
                //Try to add user
                if(CTXPS_Queries::add_membership($user['value'], $_REQUEST['group_id'])){
                    //increment for added users
                    $added_users++;
                }
            }
        }

        $response = new WP_Ajax_Response(array(
            'what'=>    'bulk_enroll',
            'action'=>  'add_bulk_users_to_group',
            'id'=>      1,
            'data'=>    '',
            'supplemental'=>array( 'html'=>CTXPS_Components::render_wp_message(sprintf(__('%d users were enrolled.','contexture-page-security'),$added_users), 'updated fade') )
        ));
        $response->send();
    }
}}
?>