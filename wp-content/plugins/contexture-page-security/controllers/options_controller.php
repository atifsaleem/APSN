<?php
/**Creates the "Page Security Options" page**/
global $wpdb;

if ( !current_user_can('manage_options') )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.','contexture-page-security' ) );

$updatesettingsMessage = '';
$InvADPagesMsg = '';

//Several forms post back to this page, so we catch the action and process accordingly
if(empty($_POST['action'])){
    //NOT SAVING INFO
}else if($_POST['action']=='updateopts'){
    //SAVE MY INFO

    //Set new options
    $newopts = array(
        "ad_msg_anon"=>stripslashes($_POST['ad-msg-anon']),
        "ad_msg_auth"=>stripslashes($_POST['ad-msg-auth'])
    );

    //Add page selections if the checkbox is checked
    if(isset($_POST['ad-msg-enable'])){
        //So long as valid pages are set for both AD types, successfully set usepages to true
        if(
            (is_numeric($_POST['ad-page-auth']) && is_numeric($_POST['ad-page-anon'])) || //Either both pages have to be set....
            (is_numeric($_POST['ad-page-auth']) && isset($_POST['ad-msg-forcelogin']))    //OR auth page must be set AND anon box must be checked
        ){
            $newopts['ad_msg_usepages'] = 'true';
        }else{
            //User didn't select both AD pages, disable usepages
            $newopts['ad_msg_usepages'] = 'false';
            $InvADPagesMsg = '<div class="updated" style="clear:both;"><p><strong>'.__('Custom pages were deactivated. You must select a valid page from each list.','contexture-page-security').'</strong></p></div>';          
        }

        //Set new AD page ids
        $newopts['ad_page_auth_id'] = (is_numeric($_POST['ad-page-auth'])) ? $_POST['ad-page-auth'] : ''; //If not numeric, use blank
        $newopts['ad_page_anon_id'] = (is_numeric($_POST['ad-page-anon'])) ? $_POST['ad-page-anon'] : ''; //If not numeric, use blank      

        //Disable comments and trackbacks for currently set AD pages
        if(!empty($_POST['ad-page-auth']) && is_numeric($_POST['ad-page-auth']))
            $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET comment_status='closed', ping_status='closed' WHERE `ID`=%s",$_POST['ad-page-auth']));
        if(!empty($_POST['ad-page-anon']) && is_numeric($_POST['ad-page-anon']))
            $wpdb->query($wpdb->prepare("UPDATE {$wpdb->posts} SET comment_status='closed', ping_status='closed' WHERE `ID`=%s",$_POST['ad-page-anon']));
    }else{
        //Checkbox is not set, so we're not using pages
        $newopts['ad_msg_usepages'] = 'false';
    }

    //Update filtering options
    $newopts['ad_msg_usefilter_menus'] = (isset($_POST['filter-menus'])) ? 'true' : 'false';
    $newopts['ad_msg_usefilter_rss'] = (isset($_POST['filter-rss'])) ? 'true' : 'false';
    //Set option for AD replacement
    $newopts['ad_opt_page_replace'] = ($_POST['ad-page-replace']==='replace') ? 'true' : 'false';
    //Set option for sitewide lockdown
    $newopts['ad_opt_protect_site'] = (isset($_POST['ad-protect-site'])) ? 'true' : 'false';
    //Set option for redirecting anonymous users to login if accessing restricted content
    $newopts['ad_opt_login_anon'] = (isset($_POST['ad-msg-forcelogin'])) ? 'true' : 'false';

    //Update the options array
    $saveStatus = CTXPS_Queries::set_options($newopts);

    //If save was successful, show the message
    if(isset($saveStatus)){
        $updatesettingsMessage = '<div id="message" class="updated below-h2 fade"><p><strong>'.__('Page Security settings saved.','contexture-page-security').'</strong></p></div>';
    }
}

//Get AD messages from options
$ADMsg = get_option('contexture_ps_options');
$ProtPages = CTXPS_Queries::get_protected_posts(/*'string'*/);

//wp_die($ProtPages);

//Generate ddls with page heirarchy
$pageDDLAuth = wp_dropdown_pages(array('name' => 'ad-page-auth', 'show_option_none' => __('-- Choose Access Denied Page --','contexture-page-security'), 'show_option_none_value' => 0, 'selected'=>$ADMsg['ad_page_auth_id'], 'echo' => 0, 'exclude'=>$ProtPages));
$pageDDLAnon = wp_dropdown_pages(array('name' => 'ad-page-anon', 'show_option_none' => __('-- Choose Access Denied Page --','contexture-page-security'), 'show_option_none_value' => 0, 'selected'=>$ADMsg['ad_page_anon_id'], 'echo' => 0, 'exclude'=>$ProtPages));

//If there aren't any pages that can be used for AD, replace with this helpful message
if(empty($pageDDLAuth)){
    $pageDDLAuth = sprintf(__('No available pages were found. <a href="%s">Add Page</a>','contexture-page-security'),admin_url('post-new.php?post_type=page'));
}else{
    //Only show edit button if something is already selected
    if(!empty($ADMsg['ad_page_anon_id'])){
        $pageDDLAuth .= sprintf('<a href="%s">%s</a> | ',
            admin_url('post.php?post='.$ADMsg['ad_page_auth_id'].'&action=edit'),
            __('Edit Page')
        );
    }
    //Add an "Add Page" button...
    $pageDDLAuth .= sprintf('<a href="%s">%s</a>',
            admin_url('post-new.php?post_type=page'),
            __('Add Page')
    );
}
if(empty($pageDDLAnon)){
    $pageDDLAnon = sprintf(__('No available pages were found. <a href="%s">Add Page</a>','contexture-page-security'),admin_url('post-new.php?post_type=page'));
}else{
    //Only show edit button if something is already selected
    if(!empty($ADMsg['ad_page_anon_id'])){
        $pageDDLAnon .= sprintf('<a href="%s">%s</a> | ',
            admin_url('post.php?post='.$ADMsg['ad_page_anon_id'].'&action=edit'),
            __('Edit Page')
        );
    }
    //Add an "Add Page" button...
    $pageDDLAnon .= sprintf('<a href="%s">%s</a>',
            admin_url('post-new.php?post_type=page'),
            __('Add Page')
    );
}

$GroupEditLink = '';
if($ADMsg['ad_opt_protect_site']==='true'){
    /*$GroupEditLink = sprintf('&nbsp;&nbsp; <a href="%s">%s</a>',
        admin_url('users.php?page=ps_groups'),
        __('Edit Groups','contexture-page-security')
    );*/
}


?>