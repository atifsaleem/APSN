<?php
global $current_user, $wpdb;

//Decide if we're displaying the current user, or a specified user
$display_user = (!isset($_GET['user_id']) || IS_PROFILE_PAGE) ? $current_user->ID : $_GET['user_id'];

//Create an array of groups that are already attached to this user
$currGroups = array();

 $sqlCurrGroups = $wpdb->prepare("
    SELECT
        {$wpdb->prefix}ps_groups.ID,
        {$wpdb->prefix}ps_groups.group_title
    FROM {$wpdb->prefix}ps_groups
    JOIN {$wpdb->prefix}ps_group_relationships
        ON {$wpdb->prefix}ps_group_relationships.grel_group_id = {$wpdb->prefix}ps_groups.ID
    WHERE {$wpdb->prefix}ps_group_relationships.grel_user_id = '%s'
",$display_user);
 $results = $wpdb->get_results($sqlCurrGroups);



foreach(/*CTXPS_Queries::get_groups($display_user)*/$results as $curGrp){
    $currentGroups[$curGrp->ID] = $curGrp->group_title;
}


?>