<?php
if(!class_exists('CTXPS_Tags')){
/**
 * Put any code that generated
 */
class CTXPS_Shortcodes{

    /**
     * This tag will output a list of groups attached to the current page.
     *
     * @global wpdb $wpdb
     * @global array $post
     */
    public static function groups_attached($atts){
        global $wpdb, $post;

        //Attribute defaults
        $output = shortcode_atts(
        array(
            'public' => 'false',
            'label' => __('Groups attached to this page:','contexture-page-security'),
        ), $atts);

        //Create an array of groups that are already attached to the page
        $currentGroups = '';
        foreach(CTXPS_Queries::get_groups_by_post($post->ID) as $curGrp){
            $currentGroups .= "<li>".$curGrp->group_title." (id:{$curGrp->sec_access_id})</li>";
        }
        $currentGroups = (empty($currentGroups)) ? '<li><em>'.__('No groups attached.','contexture-page-security').'</em></li>' : $currentGroups;
        $return = "<div class=\"ctx-ps-groupvis\"><h3>{$output['label']}</h3><ol>{$currentGroups}</ol></div>";
        if($output['public']==='true'){
            return $return;
        }else{
            return (current_user_can('edit_others_posts')) ? $return : '';
        }
    }

    /**
     * This tag will output a list of groups required to access the current page
     *
     * @global wpdb $wpdb
     * @global array $post
     * @attr public
     * @attr label
     */
    public static function groups_required($atts){
        global $wpdb, $post;

        //Attribute defaults
        $output = shortcode_atts(
        array(
            'public' => 'false',
            'label' => __('Groups Required:','contexture-page-security'),
            'description' => __('To access this page, users must be a member of at least one group from each set of groups.','contexture-page-security'),
            'showempty' => 'true',
        ), $atts);

        $requiredGroups = CTXPS_Security::get_post_protection( $post->ID );

        //Set this var to count groups for current page
        $groupcount = 0;

        $return = "<div class=\"ctx-ps-groupvis\"><h3>{$output['label']}</h3><p>{$output['description']}</p><ul>";

        foreach($requiredGroups as $pageGroup->ID => $pageGroups->groups){

            //List the page title
            $return .= "<li><strong>".get_the_title($pageGroup->ID)." (id:{$pageGroup->ID})</strong><ul>";

            foreach($pageGroups->groups as $curGrp->ID => $curGrp->title){
                ++$groupcount;
                $return .= "<li>".$curGrp->title." (id:{$curGrp->ID})</li>";
            }

            //If there were no groups attached, show that there's no access at that level
            if(empty($groupcount) && $output['showempty']==='true'){
                $return .= "<li><em>".__('No groups attached','contexture-page-security')."</em></li>";
            }

            //Reset groupcount
            $groupcount = 0;

            $return .= '</ul></li>';
        }

        $return .= '</ul></div>';

        if($output['public']==='true'){
            return $return;
        }else{
            return (current_user_can('edit_others_posts')) ? $return : '';
        }
    }

}}
?>