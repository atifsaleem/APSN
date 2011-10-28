<?php

/*************************** THEME FUNCTIONS *****************************
 * These are generally "friendlier", more-generic versions of basic plugin
 * functions that theme designers can use to more easily customize PSC.
 *************************************************************************/

function psc_deprecated($replacement='') {
  $stack = debug_backtrace();
  assert($stack[0]['function'] == __FUNCTION__);

  // Get name of function that called deprecated() function.
  $function = $stack[1]['function'];

  //If a replacement method is provided, show the name
  $useinstead = (!empty($replacement)) ?  "Use {$replacement} instead." : '';

  trigger_error('Function '. check_plain($function) .'() is deprecated. '.$useinstead, E_DEPRECATED);
}

if(!function_exists('psc_add_user_to_group')){
/**
 * Can be used by developers to add a user to a group programatically.
 *
 * @param int $user_id Required. The id of the user to add to a group.
 * @param int $group_id Required. The id of the group to add the user to.
 * @param string $expires Optional. A string-formatted datetime (YYYY-MM-DD). If provided, the user wont be able to access group content after this date.
 * @return bool Returns true if user was successfully added to a group.
 */
function psc_add_user_to_group($user_id,$group_id,$expires=null){
    global $wpdb;

    //This function is deprecated
    psc_deprecated('CTXPS_Queries::add_membership()');

    //If either value isnt an int, fail
    if(!is_numeric($user_id) || !is_numeric($group_id)){
        return false;
    }

    //Make sure user exists in db
    $UserInfo = (int)$wpdb->get_var(
        $wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->users} WHERE {$wpdb->users}.ID = %s",$user_id)
    );

    //Make sure user isnt already in the group
    $UserInGroup = $wpdb->prepare('SELECT COUNT(*) FROM `'.$wpdb->prefix.'ps_group_relationships` WHERE grel_group_id=%s AND grel_user_id=%s',$group_id,$user_id);
    if($wpdb->get_var($sqlUpdateGroup)>0){ return false; }

    //If this user doesn't exist
    if($UserInfo === 0){
        return false;
    } else {
        //Add user to group
        $sqlUpdateGroup = sprintf("INSERT INTO `{$wpdb->prefix}ps_group_relationships` (grel_group_id, grel_user_id, grel_expires) VALUES ('%s','%s',%s);",
            $group_id,
            $user_id,
            (empty($expires) || strtolower($expires)==='null') ? 'NULL' : "'".$expires."'"
        );
        if($wpdb->query($sqlUpdateGroup) === false){
            return false;
        } else {
            return true;
        }
    }

}
}

if(!function_exists('psc_update_user_membership')){
/**
 * This function is primarily used to update expiration information for a user's group membership, but may be used for other things in future updates.
 *
 *
 * @param int $user_id Required. The users userid. Can usually be retrieved with $current_user->ID.
 * @param int $group_id Required. The id of the group the user is a member of.
 * @param string $expires Optional. A date formatted as a string (YYYY-MM-DD). If left blank or null, membership never expires.
 * @return bool Returns true if record was updated. False if query fails.
 */
function psc_update_user_membership($user_id,$group_id,$expires=null){
    global $wpdb;

    //This function is deprecated
    psc_deprecated('CTXPS_Queries::update_enrollment_grel()');

    //Fail if the id's aren't numeric
    if(!is_numeric($user_id) || !is_numeric($group_id)){ return false; }

    //Check if expires date is null
    $expires = (empty($expires) || strtolower($expires)==='null') ? 'NULL' : "'".date('Y-m-d',strtotime($expires))."'";

    $query = sprintf('UPDATE `%1$sps_group_relationships` SET grel_expires=%2$s WHERE `grel_group_id`=\'%3$s\' AND `grel_user_id`=\'%4$s\'',
        /*1*/$wpdb->prefix,
        /*2*/$expires,
        /*3*/$group_id,
        /*4*/$user_id);
    return $wpdb->query($query);
}
}

if(!function_exists('psc_remove_user_from_group')){
/**
 * Removes a user from a group.
 *
 * @param int $user_id The id of the user to unenroll.
 * @param int $group_id The group to unenroll from.
 * @return bool Returns true if the query succeeded. False if it failed.
 */
function psc_remove_user_from_group($user_id,$group_id){
    global $wpdb;

    //This function is deprecated
    psc_deprecated('CTXPS_Queries::delete_membership()');

    //If either value isnt an int, fail
    if(!is_numeric($user_id) || !is_numeric($group_id)){
        return false;
    }
    $sqlRemoveUserRel = $wpdb->prepare("DELETE FROM `{$wpdb->prefix}ps_group_relationships` WHERE grel_group_id = %s AND grel_user_id = %s;", $group_id, $user_id);
    return $wpdb->query($sqlRemoveUserRel) == 0;
}
}

if(!function_exists('psc_get_groups')){
/**
 * Gets an assoc array containing a list of all groups. This can also be used to get
 * a list of only groups belonging to an individual user.
 *
 * @param int $user_id Optional. Include if you want groups a user is attached to. Leave blank for all groups.
 * @return array Associative array with groups. Format: Group_ID => Group_Title
 */
function psc_get_groups($user_id=null){
    global $wpdb, $current_user;
    $array = array();

    //This function is deprecated
    psc_deprecated('CTXPS_Queries::get_groups()');

    //Determine if we're looking up groups for a user, or all groups
    if(is_numeric($user_id)){
        $groups = $wpdb->get_results("
            SELECT * FROM `{$wpdb->prefix}ps_group_relationships`
            JOIN `{$wpdb->prefix}ps_groups`
                ON {$wpdb->prefix}ps_group_relationships.grel_group_id = {$wpdb->prefix}ps_groups.ID
            WHERE {$wpdb->prefix}ps_group_relationships.grel_user_id = '{$user_id}'
        ");
    }else{
        $groups = $wpdb->get_results("SELECT * FROM `{$wpdb->prefix}ps_groups`");
    }

    //We only need an ID and a name as a key/value..., so we'll build a new array
    foreach($groups as $group){
        $array[$group->ID] = $group->group_title;
    }

    //If multisite is enabled we can better support it...
    if(function_exists('is_user_member_of_blog')){
        //Make sure user is a member of this blog (in addition to being logged in)
        $multisitemember = is_user_member_of_blog($current_user->ID);
    }else{
        //Assume user is member of blog
        $multisitemember = true;
    }

    /*** ADD SMART GROUPS (AKA SYSTEM GROUPS) ***/
    //Registered Users Smart Group
    if($current_user->ID != 0 && $multisitemember){
        //Get the ID for CPS01 (added in 1.1, so cant assume 1)
        $newArray = CTXPS_Queries::get_system_group('CPS01');
        //Add CPS01 to the current users permissions array
        $array += array($newArray->ID => $newArray->group_title);
    }

    return $array;
}
}

if(!function_exists('psc_has_protection')){
/**
 * Recursively checks security for this page/post and it's ancestors. Returns true
 * if any of them are protected or false if none of them are protected.
 *
 * @param int $post_id Optional. The id of the page or post to check. If left null, will try to check current post id from the loop (if available).
 * @param bool $dontcheck Optional. Set to true to prevent automatically checking current post id in the loop (if $post_id is null).
 * @return bool If this page or it's ancestors has the "protected page" flag
 */
function psc_has_protection($post_id=null,$dontcheck=false){
    global $wpdb, $post;

    //This function is deprecated
    psc_deprecated('CTXPS_Queries::check_section_protection()');

    //If $post_id isnt set, try to get global post id
    if(empty($post_id) && !$dontcheck && isset($post->ID)){ $post_id=$post->ID; }
    //Fail if the post id isn't numeric
    if(!is_numeric($post_id)){ return false; }

    //Try to get post meta
    $mymeta=get_post_meta($post_id,'ctx_ps_security');

    //Check permissions for current page
    if( !empty( $mymeta ) ){
        return true;
    } else {
        //If this isn't protected, lets see if there's a parent...
        $parent_id = $wpdb->get_var(sprintf('SELECT post_parent FROM %s WHERE `ID` = %s',$wpdb->posts,$post_id));
        //If we have a parent, repeat this check with the parent.
        if ($parent_id != 0)
            return CTXPS_Queries::check_section_protection($parent_id);
        else
            return false;
    }
}
}

?>
