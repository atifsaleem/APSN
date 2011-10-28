//When DOM Ready...
jQuery(function(){

    //Post sidebar & Edit users (AUTO)
    //Save data for available group drop-down list
    var grouplist_ddl = jQuery('#ctxps-grouplist-ddl');
    grouplist_ddl.data('options',grouplist_ddl.html())
        .children('.detach')
            .remove();

    //Term protection (AUTO)
    //Save data for available group drop-down list
    jQuery('#ctxps-grouplist-ddl')
        .data('options',jQuery('#ctxps-grouplist-ddl').html())
        .children('.detach')
            .remove();

    //Post sidebar - toggle security (cb)
    jQuery('#ctxps-grouplist-box #ctxps-cb-protect').click(function(){
        //CTXPS_Ajax.toggleSecurity()
        CTXPS_Ajax.toggleContentSecurity('post', parseInt(jQuery('#ctx_ps_post_id').val()), '#ctxps-grouplist-box h3.hndle');
    });
    //Post sidebar - toggle security (cb label)
    jQuery('#ctxps-grouplist-box label[for="ctx_ps_protectmy"]').click(function(){
        //If the checkbox is disabled, it's because an ancestor is protected - let the user know
        if(jQuery('#ctx_ps_protectmy:disabled').length > 0){
            alert(ctxpsmsg.NoUnprotect);
        }
    });

    //Post sidebar - add group click handler
    jQuery('#add_group_page').click(function(){ CTXPS_Ajax.addGroupToPage(); });


    //Term protection - toggle security (cb)
    jQuery('#edittag #ctxps-cb-protect').click(function(){
        //CTXPS_Ajax.toggleSecurity()
        CTXPS_Ajax.toggleContentSecurity( 'term', parseInt( jQuery('#edittag input[name="tag_ID"]').val() ) );
    });
    //Post sidebar - toggle security (cb label)
    jQuery('#edittag label[for="ctxps-cb-protect"]').click(function(){
        //If the checkbox is disabled, it's because an ancestor is protected - let the user know
        if(jQuery('#ctxps-cb-protect:disabled').length > 0){
            alert(ctxpsmsg.NoUnprotect);
        }
    });

    //Term protection - add group click handler
    jQuery('#ctxps-grouplist-ddl-btn').click(function(){
        CTXPS_Ajax.addGroupToTerm();
    });


    //Group edit - Add user button
    jQuery('#btn-add-grp-2-user').click(function(){
        CTXPS_Ajax.addGroupToUser()
    });

    //Users.php - Bulk-add users to group button
    jQuery('#enrollit').click(function(){
        CTXPS_Ajax.addBulkUsersToGroup();
    });

    //Options.php - Notify users if they are trying to remove site security
    jQuery('#ad-protect-site:checked').click(function(){
        if(jQuery(this).filter(':checked').length===0){
            return confirm(ctxpsmsg.SiteProtectDel);
        }
        return true;
    });

    //Options.php - Toggle visibility of page options (cb)
    jQuery('#ad-msg-enable, label[for="ad-msg-enable"]').click(function(){

        var optmsg = jQuery('.toggle-opts-ad-msg'),
            optpg = jQuery('.toggle-opts-ad-page'),
            forcelog = jQuery('#ad-msg-forcelogin:checked').length;

        //If checking...
        if(jQuery(this).filter(':checked').length){

            //If force login is enabled...
            if(forcelog){
                //Exclude anon opts
                optmsg.not('.ad-opt-anon').fadeOut(250,function(){
                    optpg.not('.ad-opt-anon').fadeIn(250);
                });
            //If force login is NOT enabled
            }else{
                optmsg.fadeOut(250,function(){
                    jQuery('.toggle-opts-ad-page').fadeIn(250);
                });
            }

        //If UNchecking
        }else{
            //If force login is enabled...
            if(forcelog){
               optpg.not('.ad-opt-anon').fadeOut(250,function(){
                    optmsg.not('.ad-opt-anon').fadeIn(250);
                });
            //If force login is NOT enabled
            }else{
                optpg.fadeOut(250,function(){
                    optmsg.fadeIn(250);
                });
            }
        }
    });


    //Options.php - Toggle visibility of anon boxes with force redirect (cb)
    jQuery('#ad-msg-forcelogin, label[for="ad-msg-forcelogin"]').click(function(){
        var anon = jQuery('.ad-opt-anon'),
            pages = jQuery('#ad-msg-enable:checked').length;
        //This is being checked
        if(jQuery(this).filter(':checked').length){
            anon.filter(':visible').fadeOut(250);
        //This is being UNchecked
        }else{
            //Check if we need to show pages or messages
            if(pages){
                jQuery('.toggle-opts-ad-page').fadeIn(250);
            }else{
                jQuery('.toggle-opts-ad-msg').fadeIn(250);
            }
        }
    });



});

/**
 * Let's define the custom static class
 */
function CTXPS_Ajax(){
    //Constructor
}

/**
 * USERS.PHP. Will bulk-add users to groups.
 */
CTXPS_Ajax.addBulkUsersToGroup = function(){
    var checkedArray = jQuery('#the-list input:checkbox:checked');
    jQuery.get(
        'admin-ajax.php',
        {
            action: 'ctxps_user_bulk_add',
            users:  checkedArray.serializeArray(),
            group_id:jQuery('#psc_group_add').val()
        },
        function(response){
            response = jQuery(response);
            var cmsg = jQuery('#message'),
                emsg = response.find('supplemental html').text();

            //Put a new bulk message on the page (replace current or add new)
            if(cmsg.length){
                cmsg.replaceWith(emsg);
            }else{
                jQuery('#wpbody-content h2:first').after(emsg);
            }

            //If this was a success, uncheck all selected users
            if(response.find('bulk_enroll').attr('id') == '1'){
                checkedArray.removeAttr('checked').prop('checked',false);
            }
        },
        'xml'
    );
}

/**
 * GENERAL. Will display a "Security Updated" message in the sidebar when successful change to security
 */
CTXPS_Ajax.showSaveMsg = function(selector){
    if(jQuery(selector+' .ctx-ajax-status').length==0){
        jQuery(selector)
            .append('<span class="ctx-ajax-status">Saved</span>')
            .find('.ctx-ajax-status')
            .fadeIn(500,function(){
                jQuery(this)
                    .delay(750).fadeOut(500,function(){
                        jQuery(this).remove();
                    });
            });
    }
}

/**
 * SIDEBAR. Updates the security status of a post/page
 */
CTXPS_Ajax.toggleSecurity = function(){
    var post_id = parseInt(jQuery('#ctx_ps_post_id').val());

    if(jQuery('#ctx_ps_protectmy:checked').length !== 0){
        //Turn security ON for this group
        jQuery.get('admin-ajax.php',
            {
                action:        'ctxps_security_update',
                setting:       'on',
                object_type:   'post',
                object_id:     post_id
            },
            function(response){response = jQuery(response);
                if(response.find('update_sec').attr('id') == '1'){
                    jQuery("#ctx_ps_pagegroupoptions").show();
                    CTXPS_Ajax.showSaveMsg('#ctxps-grouplist-box h3.hndle')
                }else{
                    alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                }
            },'xml'
        );
    }else{
        if(confirm(ctxpsmsg.EraseSec)){
            //Turn security OFF for this group
            jQuery.get('admin-ajax.php',
                {
                    action:        'ctxps_security_update',
                    setting:       'off',
                    object_type:   'post',
                    object_id:     post_id
                },
                function(response){
                    response = jQuery(response);
                    if(response.find('update_sec').attr('id') == '1'){
                        jQuery("#ctx_ps_pagegroupoptions").hide();
                        CTXPS_Ajax.showSaveMsg('#ctxps-grouplist-box h3.hndle')
                    }else{
                        alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                    }
                },'xml'
            );
        }else{
            //If user cancelled, re-check the box
            jQuery('#ctx_ps_protectmy').attr('checked','checked').prop('checked','checked');
        }
    }
}

/**
 * SIDEBAR. Updates the security status of a taxonomy term or other type
 */
CTXPS_Ajax.toggleContentSecurity = function(object_type,object_id,save_selector){

    var groups_ddl = jQuery('#ctxps-grouplist-ddl');

    if(typeof(object_type)=="undefined"){
        //This should never show up unless I programmed something badly
        alert('Programming Error: Type was undefined. Changes not saved.');
    }
    if(typeof(object_id)=="undefined"){
        object_id = parseInt(jQuery('#ctxps-object-id').val());
    }

    //ENABLING SECURITY:
    if(jQuery('#ctxps-cb-protect:checked').length !== 0){
        //Turn security ON for this group
        jQuery.get('admin-ajax.php',
            {
                action:      'ctxps_security_update',
                setting:     'on',
                object_type: object_type,
                object_id:   object_id

            },
            function(response){response = jQuery(response);
                if(response.find('update_sec').attr('id') == '1'){

                    //Before we show the list, regenerate the content
                    if(response.find('supplemental html').length!=0){
                        switch(object_type){
                            case 'term':
                                jQuery('#the-list-ctxps-relationships').replaceWith(response.find('supplemental html').text());
                                break;
                            default:break;
                        }
                    }

                    //Reveal the table with attached groups
                    jQuery("#ctxps-relationships-list").show();

                    //Show the saved message if the selector isn't empty
                    if(typeof(save_selector)!="undefined"){
                        CTXPS_Ajax.showSaveMsg(save_selector) //Show save message
                    }
                }else{
                    //If there was an error, show it
                    alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                }
            },'xml'
        );

    //DISABLING SECURITY
    }else{
        if(confirm(ctxpsmsg.EraseSec)){
            //Turn security OFF for this group
            jQuery.get('admin-ajax.php',
                {
                    action:     'ctxps_security_update',
                    setting:    'off',
                    object_type: object_type,
                    object_id:   object_id
                },
                function(response){ response = jQuery(response);
                    if(response.find('update_sec').attr('id') == '1'){

                        //Hide the list of attached groups
                        jQuery("#ctxps-relationships-list").hide();

                        //Before we show the list, regenerate the content
                        if(response.find('supplemental html').length>0){
                            switch(object_type){
                                case 'term':
                                    jQuery('#the-list-ctxps-relationships').replaceWith(response.find('supplemental html').text());
                                    break;
                                default:break;
                            }
                        }

                        //Reset the ddl, if needed
                        if(groups_ddl.length!=0){
                            //Do nothing atm
                        }

                        //Show the saved message if the selector isn't empty
                        if(typeof(save_loc)!="undefined"){
                            CTXPS_Ajax.showSaveMsg(save_selector); //Show save message
                        }

                        //Auto-update the page if this is inheriting protection (this is sloppy, but it works)
                        if(jQuery('#ctxps-grouplist-box #ctx-parentmsg').length>0){
                            jQuery('#publish').click();
                        }
                    }else{
                        alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                    }
                },'xml'
            );
        }else{
            //If user cancelled, re-check the box
            jQuery('#ctxps-cb-protect').attr('checked','checked').prop('checked','checked');
        }
    }
}

/**
 * USER PROFILE MEMBERSHIP TABLE. Adds a group to a user
 */
CTXPS_Ajax.addGroupToUser = function(){
    var group_id = parseInt(jQuery('#ctxps-grouplist-ddl').val());
    var user_id = parseInt(jQuery('#ctx-group-user-id').val());
    if(group_id!=0){
        jQuery('#btn-add-grp-2-user').attr('disabled','disabled').prop('disabled','disabled');
        //alert("The group you want to add is: "+$groupid);
        jQuery.get('admin-ajax.php',
            {
                action:     'ctxps_add_group_to_user',
                group_id:   group_id,
                user_id:    user_id
            },
            function(response){
                response = jQuery(response);
                if(response.find('enroll').attr('id') == '1'){

                    //Add group to the Allowed Groups list from our stored response
                    jQuery('#grouptable > tbody').html(response.find('supplemental html').text());

                    //Load the select drop down list
                    var groups_ddl = jQuery('#ctxps-grouplist-ddl');
                    groups_ddl
                        .html(groups_ddl.data('options'))           //Set the ddl content = saved response
                        .children('option[value="'+group_id+'"]')   //Select option that we just added
                            .addClass('detach')                     //Add detach class to it
                            .end()                                  //Reselect ddl again
                        .data('options',groups_ddl.html())          //Re-save the options html as response
                        .children('.detach')                        //Select all detached options
                            .remove();                              //Remove them

                    jQuery('#btn-add-grp-2-user').removeAttr('disabled').prop('disabled',false);
                    CTXPS_Ajax.showSaveMsg('.ctx-ps-tablenav');
                }else{
                    alert(ctxpsmsg.GeneralError+data.find('wp_error').text());
                }
            },'xml'
        );
    }else{
        alert(ctxpsmsg.NoGroupSel);
    }
}

/**
 * USER PROFILE MEMBERSHIP TABLE. Removes a group from a user
 */
CTXPS_Ajax.removeGroupFromUser = function(group_id,user_id,me,action){
    jQuery.get('admin-ajax.php',
        {
            action:     'ctxps_remove_group_from_user',
            groupid:    group_id,
            user_id:    user_id
        },
        function(response){
            response = jQuery(response);
            if(response.find('unenroll').attr('id') == '1'){

                //Use a cool fade effect to remove item from the list
                var group_ddl = jQuery('#ctxps-grouplist-ddl');
                group_ddl
                    .html(group_ddl.data('options'))
                    .children('option[value="'+group_id+'"]')
                        .removeClass('detach')
                        .end()
                    .data('options',group_ddl.html())
                    .children('.detach')
                        .remove();

                //Take me out of the table
                me.parents('tr:first').fadeOut(500,function(){
                    //Rebuild the group
                    me.parents('tbody:first').html(response.find('supplemental html').text());
                });

                CTXPS_Ajax.showSaveMsg('.ctx-ps-tablenav');
            }else{
                alert(ctxpsmsg.GeneralError+data.find('wp_error').text());
            }
        },'xml'
    );
}

/**
 * SIDEBAR. Adds a group to a page with security
 */
CTXPS_Ajax.addGroupToPage = function(){
    var group_id = parseInt(jQuery('#ctxps-grouplist-ddl').val());
    var post_id = parseInt(jQuery('#ctx_ps_post_id').val());
    if(group_id!=0){
        //alert("The group you want to add is: "+group_id);
        jQuery.get('admin-ajax.php',
            {
                action:     'ctxps_add_group_to_post',
                group_id:    group_id,
                post_id:     post_id
            },
            function(data){
                data = jQuery(data);
                if(data.find('add_group').attr('id')=='1'){
                    //Add group to the Allowed Groups list
                    jQuery('#ctx-ps-page-group-list').html(data.find('supplemental html').text());

                    //Update the select box and the attached group list
                    var grpsAvail = jQuery('#ctxps-grouplist-ddl');
                    grpsAvail
                        .html(grpsAvail.data('options'))
                        .children('option[value="'+group_id+'"]')
                            .addClass('detach')
                        .end()
                        .data('options',grpsAvail.html())
                        .children('.detach')
                            .remove();

                    CTXPS_Ajax.showSaveMsg('#ctxps-grouplist-box h3.hndle');
                }
            },'xml'
        );
    }else{
        alert(ctxpsmsg.NoGroupSel);
    }
}

/**
 * SIDEBAR. Adds a group to a protected term
 */
CTXPS_Ajax.addGroupToTerm = function(){

    var group_id = jQuery('#ctxps-grouplist-ddl').val(),
        content_id = jQuery('#edittag input[name="tag_ID"]').val(),
        taxonomy = jQuery('#edittag input[name="taxonomy"]').val(),
        list_selector = '#the-list-ctxps-relationships',
        ddl_selector = '#ctxps-grouplist-ddl';

    if( typeof(group_id)!='undefined' && group_id!=0 ){

        //alert("The group you want to add is: "+$groupid);
        jQuery.get('admin-ajax.php',
            {
                action:       'ctxps_add_group_to_term',
                group_id:     group_id,
                content_id:   content_id,
                taxonomy:     taxonomy
            },
            function(data){
                data = jQuery(data);
                //Only do the following if we get back a successful result
                if(data.find('add_group').attr('id')=='1'){

                    //Update the table
                    if(typeof(list_selector)!="undefined"){
                        jQuery(list_selector).replaceWith(data.find('supplemental html').text());
                    }

                    //Update the select box and the attached group list
                    var grpsAvail = jQuery(ddl_selector);
                    grpsAvail
                        .html(grpsAvail.data('options'))
                        .children('option[value="'+group_id+'"]')
                            .addClass('detach')
                        .end()
                        .data('options',grpsAvail.html())
                        .children('.detach')
                            .remove();

                    //Show save message
                    if(typeof(savemsg_selector)!="undefined"){
                        CTXPS_Ajax.showSaveMsg(savemsg_selector);
                    }
                }
            },'xml'
        );
    }else{
        alert(ctxpsmsg.NoGroupSel);
    }
}

/**
 * SIDEBAR. Adds a group to any content with security
 */
CTXPS_Ajax.addGroupToContent = function(group_id,content_type,content_id,list_selector,ddl_selector,savemsg_selector){

    if( typeof(group_id)!='undefined' && group_id!=0 ){

        //alert("The group you want to add is: "+$groupid);
        jQuery.get('admin-ajax.php',
            {
                action:     'ctxps_add_group_to_term',
                group_id:    group_id,
                content_type:content_type,
                content_id:  content_id
            },
            function(data){
                data = jQuery(data);
                if(data.find('add_group').attr('id')=='1'){

                    if(typeof(list_selector)!="undefined"){
                        //Add group to the Allowed Groups list
                        jQuery(list_selector).html(data.find('supplemental html').text());
                    }

                    //Update the select box and the attached group list
                    var grpsAvail = jQuery(ddl_selector);
                    grpsAvail
                        .html(grpsAvail.data('options'))
                        .children('option[value="'+group_id+'"]')
                            .addClass('detach')
                        .end()
                        .data('options',grpsAvail.html())
                        .children('.detach')
                            .remove();

                    //Show save message
                    if(typeof(savemsg_selector)!="undefined"){
                        CTXPS_Ajax.showSaveMsg(savemsg_selector);
                    }
                }
            },'xml'
        );
    }else{
        alert(ctxpsmsg.NoGroupSel);
    }
}

/**
 * SIDEBAR. Removes a group from a page with security
 */
CTXPS_Ajax.removeGroupFromPage = function(group_id,me){
    if(confirm(ctxpsmsg.RemoveGroup.replace(/%s/,me.parents('.ctx-ps-sidebar-group:first').children('.ctx-ps-sidebar-group-title').text()))){
        //Get the post id from the form field
        var post_id = parseInt(jQuery('#ctx_ps_post_id').val());
        //Submit the ajax request
        jQuery.get('admin-ajax.php',
            {
                action:     'ctxps_remove_group_from_page',
                group_id:    group_id,
                post_id:     post_id,
                requester:  'sidebar'
            },
            function(response){
                response = jQuery(response);
                //If request was successful
                if(response.find('remove_group').attr('id') == '1'){
                    //Remove the row from the sidebar with a nifty fade effect, and add it back to the select box
                    var grpsAvail = jQuery('#ctxps-grouplist-ddl');
                    grpsAvail
                        .html(grpsAvail.data('options'))
                        .children('option[value="'+group_id+'"]')
                            .removeClass('detach')
                        .end()
                        .data('options',grpsAvail.html())
                        .children('.detach')
                            .remove();
                    me.parent().fadeOut(500,function(){
                        console.log('Removed');
                        jQuery('#ctx-ps-page-group-list').html(response.find('supplemental html').text());
                    });

                    CTXPS_Ajax.showSaveMsg('#ctxps-grouplist-box h3.hndle');
                }else{
                    alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                }
            },'xml'
        );
    }
}


/**
 * SIDEBAR. Removes a group from a term with security
 */
CTXPS_Ajax.removeGroupFromTerm = function(group_id,me){
    var content_id = jQuery('#edittag input[name="tag_ID"]').val(),
        taxonomy = jQuery('#edittag input[name="taxonomy"]').val(),
        listbody = jQuery('#the-list-ctxps-relationships');

    if( confirm( ctxpsmsg.RemoveGroup.replace( /%s/, me.parents('tr:first').children('td.column-name a:first').text() ) ) ){

        //Submit the ajax request
        jQuery.get('admin-ajax.php',
            {
                action:     'ctxps_remove_group_from_term',
                group_id:    group_id,
                content_id:  content_id,
                taxonomy:    taxonomy
            },
            function(response){
                response = jQuery(response);
                //If request was successful
                if(response.find('remove_group').attr('id') == '1'){

                    //Update the groups drop-down by adding the group back in
                    var grouplist_ddl = jQuery('#ctxps-grouplist-ddl');
                    grouplist_ddl
                        .html(grouplist_ddl.data('options'))
                        .children('option[value="'+group_id+'"]')
                            .removeClass('detach')
                        .end()
                        .data('options',grouplist_ddl.html())
                        .children('.detach')
                            .remove();

                    //Animate the removal of this row
                    me.parents('tr:first').fadeOut(500,function(){
                        listbody.replaceWith(response.find('supplemental html').text());
                    });

                    //CTXPS_Ajax.showSaveMsg('#ctxps-grouplist-box h3.hndle');
                }else{
                    alert(ctxpsmsg.GeneralError+response.find('wp_error').text());
                }
            },'xml'
        );
    }
}

/**
 * GROUP EDIT > ASSOCIATED CONTENT TABLE. Removes a page from a group via the group screen
 */
CTXPS_Ajax.removePageFromGroup = function(post_id,me){
    if(confirm( ctxpsmsg.RemovePage.replace( /%s/,me.parents('td:first').find('strong>a:first').text() ) )){
        //Get the id of the current group
        var group_id = parseInt(jQuery('#groupid').val());

        jQuery.get('admin-ajax.php',
            {
                action:     'ctxps_remove_group_from_page',
                group_id:    group_id,
                post_id:     post_id
            },
            function(data){
                data = jQuery(data);
                if(data.find('remove_group').attr('id') == '1'){
                    me.parents('tr:first').fadeOut(500,function(){
                        jQuery(this).parents('tbody:first')
                            .html(data.find('supplemental html').text());
                    });
                    //CTXPS.showSaveMsg('#ctxps-grouplist-box h3.hndle');
                }
                else{
                    alert(ctxpsmsg.GeneralError+data.find('wp_error').text());
                }
            },'xml'
        );
    }
}