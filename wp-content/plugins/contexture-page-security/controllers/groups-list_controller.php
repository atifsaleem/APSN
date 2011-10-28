<?php
/**Creates the "Add/View Groups" page**/

if ( ! current_user_can( 'edit_users' ) )
	wp_die( __( 'You do not have sufficient permissions to manage options for this site.' ) );

$creategroup_message = '';

//Several forms post back to this page, so we catch the action and process accordingly
if(!empty($_POST['action'])){
    //Launch code based on action
    switch($_POST['action']){
        case 'addgroup':
            $creategroup_message = CTXPS_App::create_group($_POST['group_name'], $_POST['group_description']);
            break;
        default: break;
    }

}

?>