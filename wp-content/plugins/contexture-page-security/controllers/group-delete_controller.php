<?php

if ( ! current_user_can( 'edit_users' ) ){
    wp_die( __( 'You do not have sufficient permissions to manage options for this site.','contexture-page-security' ) );
}

$groupInfo = CTXPS_Queries::get_group_info($_GET['groupid']);
$groupPageCount = CTXPS_Queries::count_protected($_GET['groupid']);

$actionmessage = '';
$actionmessage2 = '';

if(!empty($_GET['action']) && !empty($_GET['submit']) && $_GET['action'] == "delete" && $_GET['submit']=="Confirm Deletion"){

    $sqlstatus = CTXPS_Queries::delete_group($_GET['groupid']);

    if(!$sqlstatus){
        $actionmessage = '<div class="error below-h2"><p>'.__('An error occurred. The group was not fully deleted.','contexture-page-security').'</p></div>';
    } else {
        $actionmessage2 = '<div id="message" class="update below-h2"><p><strong>1</strong> '.__('group was deleted.','contexture-page-security').' <a href="'.admin_url().'users.php?page=ps_groups">'.__('View all groups','contexture-page-security').' &gt;&gt;</a></p></div>';
    }
}
?>