<?php
    /**
     * This is still a disgraceful mess, but at least it's marginally more readable. Let's put refactoring this on hold till 1.5 or 1.6
     */
    global $wpdb, $post;
    $outputHtml = '';

    //We MUST have a post id in the querystring in order for this to work (ie: this wont appear for the "create new" pages, as the page doesnt exist yet)
    if(!empty($_REQUEST['post']) && is_numeric($_REQUEST['post'])){

        //Create an array of groups that are already attached to the page (we want the id as index)
        $currentGroups = array();
        foreach(CTXPS_Queries::get_groups_by_post($_REQUEST['post']) as $curGrp){
            $currentGroups[$curGrp->sec_access_id] = $curGrp->group_title;
        }

        //Get array with security requirements for this post
        $securityStatus = CTXPS_Security::get_post_protection( $_REQUEST['post'] );
        //Get array with security requirements for this posts terms
        $termSecurityStatus = CTXPS_Queries::check_post_term_protection( $_REQUEST['post'] );

        //Get options
        $dbOpts = get_option('contexture_ps_options');
        //ad_page_auth_id     ad_page_anon_id

        /***START BUILDING HTML****************************/

        //Only print restriction options if this ISN'T set as an access denied page
        if($dbOpts['ad_page_anon_id']!=$_REQUEST['post'] && $dbOpts['ad_page_auth_id']!=$_REQUEST['post']){

            $outputHtml .= sprintf('<input type="hidden" id="ctx_ps_post_id" name="ctx_ps_post_id" value="%s" />',$_REQUEST['post']);

            //Build "Protect this page" label
            $outputHtml .= CTX_Helper::wrap('<label for="ctxps-cb-protect">',
                sprintf('<input type="checkbox" id="ctxps-cb-protect" name="ctxps-cb-protect" %s %s />',
                    ( !!$termSecurityStatus || ( !!$securityStatus && get_post_meta($_REQUEST['post'],'ctx_ps_security') ) ) ? 'checked="checked"' : '',
                    ( !!$termSecurityStatus || ( !!$securityStatus && !get_post_meta($_REQUEST['post'],'ctx_ps_security') ) ) ? 'disabled="disabled"' : '')
                .__(' Protect this page and its descendants','contexture-page-security')
            );

            /** TODO: Add "Use as Access Denied page" option */

            /******** START Inform about inherited permissions *************************/

            //If the checkbox is disabled, give admin the option to go straight to the parent (can still add groups, which directly auto-protects the page too)
            if ( !!$securityStatus && !get_post_meta($_REQUEST['post'],'ctx_ps_security') ){
                $outputHtml .= sprintf(
                    '<div id="ctx-parentmsg" style="padding-left:8px;padding-bottom:3px;font-size:0.9em;color:silver;">&gt; <em>%s</em> <a href="%s" style="font-size:0.9em;color:silver;"><em>%s</em> &gt;&gt;</a></div>',
                        __('Inheriting from an ancestor.'),
                        admin_url('post.php?post='.$post->post_parent.'&action=edit'),
                        __('Edit Parent','contexture-page-security')
                );
            }

            //If the checkbox is disabled, give admin the option to go straight to the parent (can still add groups, which directly auto-protects the page too)
            if ( !!$termSecurityStatus ){
                $outputHtml .= sprintf('<div style="padding-left:8px;font-size:0.9em;color:silver;">&gt; <em>%s</em></div>',
                    __('Inheriting from one or more terms.','contexture-page-security')
                );
            }


            /******** END Inform about inherited permissions *************************/

            //Start on "Available Groups" select box
            $outputHtml .= sprintf('<div id="ctxps-relationships-list" style="border-top:#EEEEEE 1px solid;margin-top:0.5em;%s">',
                ( !!$securityStatus || !!$termSecurityStatus )?'display:block;':''
            );

            $outputHtml .=    sprintf('<h5>%1$s <a href="%3$s" title="%2$s" style="text-decoration:none;">+</a></h5>',__('Available Groups','contexture-page-security'),__('New Group','contexture-page-security'),admin_url('users.php?page=ps_groups_add'));

            $group_avail_opts = sprintf( '<option value="0">-- %s -- </option>',__('Select','contexture-page-security') );

            //Loop through all groups in the db to populate the drop-down list
            foreach(CTXPS_Queries::get_groups() as $group){
                //Generate the option HTML, hiding it if it's already in our $currentGroups array
                $group_avail_opts .= CTX_Helper::gen('option',
                    array(
                        'class'=>(!empty($currentGroups[$group->ID]))?'detach':'',
                        'value'=>$group->ID
                    ),$group->group_title
                );
            }

            //Put all those options into the select box
            $outputHtml .= CTX_Helper::gen('select',array('id'=>'ctxps-grouplist-ddl','name'=>'ctxps-grouplist-ddl'),$group_avail_opts);

            $outputHtml .= sprintf('<input type="button" id="add_group_page" class="button-secondary action" value="%s" />',__('Add','contexture-page-security'));
            $outputHtml .= sprintf('<h5>%s</h5>',__('Groups with Access','contexture-page-security'));
            $outputHtml .= '<div id="ctx-ps-page-group-list">';


            $outputHtml .= CTXPS_Components::render_sidebar_attached_groups($securityStatus,$_REQUEST['post']);


            $outputHtml .= '      </div>'; //ctx-ps-page-group-list
            $outputHtml .= '  </div>'; //ctxps-relationships-list


        }else{
            $outputHtml .= sprintf(__('<p>This is currently an Access Denied page. You cannot restrict it.</p><p><a href="%s">View Security Settings</a></p>','contexture-page-security'),admin_url('options-general.php?page=ps_manage_opts'));
        }
    }else{
        $outputHtml = __('<p>You need to publish before you can update security settings.</p>','contexture-page-security');
    }
    CTX_Helper::div(array('class'=>'new-admin-wp25'), $outputHtml);
    /***END BUILDING HTML****************************/
?>