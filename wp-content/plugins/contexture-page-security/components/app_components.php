<?php
if(!class_exists('CTXPS_Components')){
class CTXPS_Components{

    /**
     * Adds a "Protection" column to content lists.
     *
     * @param type $columns WP column array
     * @return array The adjusted WP column array (with protected column added)
     */
    public static function add_list_protection_column($columns){
        //Initialize variables (good practice)
        $date = '';

        //Peel of the date (set temp var, remove from array)
        if(isset($columns['date'])){
            $date = $columns['date'];
            unset($columns['date']);
        }

        //Add new column
        $columns['protected'] = '<div class="vers"><img alt="Protected" src="'.CTXPSURL.'images/protected.png'.'" /></div>';

        //Add date back on (now at end of array);
        if(!empty($date)){
            $columns['date'] = $date;
        }

        //Return new column array
        return $columns;
    }

    /**
     * Adds a "Protection" column to term lists.
     *
     * @param type $columns WP column array
     * @return array The adjusted WP column array (with protected column added)
     */
    public static function add_term_protection_column($columns){

        //Add new column
        $columns['protected'] = '<div class="vers"><img alt="Protected" src="'.CTXPSURL.'images/protected.png'.'" /></div>';

        //Return new column array
        return $columns;
    }


    /**
     * Generates a "lock" symbol for the "Protected" column, if the current content
     * is protected. See WP's template.php -> display_page_row() for  more.
     *
     * @param type $column_name The name of the column to affect ('protected')
     * @param type $post_id The id of the page to check.
     */
    public static function render_list_protection_column($column_name, $post_id){

        //wp_die($column_name.' GOOGLE '.$post_id);

        //Only do this if we've got the right column
        if($column_name==='protected'){
            //If page is protected, return lock icon
            if(CTXPS_Queries::check_protection($post_id)){
                CTX_Helper::img (array(
                    'alt'=>__('Protected','contexture-page-security'),
                    'title'=>__('Protected','contexture-page-security'),
                    'src'=>CTXPSURL.'images/protected-inline.png'
                ));
            }
            //If this page isnt protected, but an ancestor is, return a lighter icon
            else if(CTXPS_Queries::check_section_protection($post_id)){
                CTX_Helper::img (array(
                    'alt'=>__('Protected (inherited)','contexture-page-security'),
                    'title'=>__('Inheriting protection','contexture-page-security'),
                    'src'=>CTXPSURL.'images/protected-inline-descendant.png'
                ));
            //If theres no direct protection, is this content protected through term inheritance?
            }else{
                //If the post belongs to a protected term, show lighter (inherited) icon
                if(CTXPS_Queries::check_post_term_protection($post_id)){
                    CTX_Helper::img (array(
                        'alt'=>__('Protected (inherited from term)','contexture-page-security'),
                        'title'=>__('Inheriting protection from term','contexture-page-security'),
                        'src'=>CTXPSURL.'images/protected-inline-inherit.png'
                    ));
                }
            }
        }
    }

        /**
     * Generates a "lock" symbol for the "Protected" column, if the current content
     * is protected. See WP's template.php -> display_page_row() for  more.
     *
     * @param type $column_name The name of the column to affect ('protected')
     * @param type $term_id The id of the page to check.
     */
    public static function render_term_protection_column($test, $column_name, $term_id){

        //Only do this if we've got the right column
        if($column_name==='protected'){
            //If page is protected, return lock icon
            if(CTXPS_Queries::check_protection($term_id,'term')){
                CTX_Helper::img (array(
                    'alt'=>__('Protected','contexture-page-security'),
                    'title'=>__('Protected','contexture-page-security'),
                    'src'=>CTXPSURL.'images/protected-inline.png'
                ));
            }
            //If this page isnt protected, but an ancestor is, return a lighter icon
            else if(CTXPS_Queries::check_term_protection($term_id,$_REQUEST['taxonomy'])){
                CTX_Helper::img (array(
                    'alt'=>__('Protected (inherited)','contexture-page-security'),
                    'title'=>__('Inheriting protection','contexture-page-security'),
                    'src'=>CTXPSURL.'images/protected-inline-descendant.png'
                ));
            }
        }
    }


    /**
     * Renders a list of pages protected by the specified group. This returns only the
     * inner HTML of the <tbody> element, as tbody should be already entered on the page.
     *
     * TODO: Rebuild this using CTX_Tables.
     *
     * @global wpdb $wpdb
     *
     * @param int $group_id The id of the group we need a member list for.
     * @return string Html to go inside tbody.
     */
    public static function render_content_by_group_list($group_id){
        global $wpdb;

        $pagelist = CTXPS_Queries::get_content_by_group($group_id);

        if(count($pagelist)===0){
            return sprintf('<td colspan="3">%s</td>',__('No content is attached to this group.','contexture-page-security'));
        }

        $html = '';
        $countpages = '';
        $alternatecss = ' class="alternate" ';

        /**TODO: Must detect if this page is directly protected, or inherrited.*/

        foreach($pagelist as $page){
            $page_title = $page->post_title;
            $html .= sprintf('
            <tr id="page-%1$s" %2$s>
                <td class="post-title page-title column-title">
                    <strong><a href="%3$s">%4$s</a></strong>
                    <div class="row-actions">
                        <span class="edit"><a href="%8$spost.php?post=%1$s&action=edit" title="Edit this page">'.__('Edit','contexture-page-security').'</a> | </span>
                        <span class="trash"><a id="remcontent-%1$s" onclick="CTXPS_Ajax.removePageFromGroup(%1$s,jQuery(this))" title="Remove this group from the content">'.__('Remove','contexture-page-security').'</a> | </span>
                        <span class="view"><a href="%7$s" title="View the page">'.__('View','contexture-page-security').'</a></span>
                    </div>
                </td>
                <td class="protected column-protected">%5$s</td>
                <td class="type column-type">%6$s</td>
            </tr>',
                /*1*/$page->sec_protect_id,
                /*2*/$alternatecss,
                /*3*/admin_url('post.php?post='.$page->sec_protect_id.'&action=edit'),
                /*4*/$page_title,
                /*5*/'',
                /*6*/$page->post_type,
                /*7*/get_permalink($page->sec_protect_id),
                /*8*/admin_url()
            );

            //Alternate css style for odd-numbered rows
            $alternatecss = ($alternatecss != '') ? '' : ' class="alternate" ';
        }
        return $html;//'<td colspan="2">There are pages attached, but this feature is not yet working.</td>';
    }

    /**
     * Used to generate <tbody> inner html for group lists. If a user_id is provided, the list
     * will only include groups attached to that specified user.
     *
     * @global wpdb $wpdb
     *
     * @param string $user_id If set, only shows groups that have a specific user as a member
     * @param string $view Specify which view the list is being generated for (there are some differences). Supports 'groups' (default) or 'users'
     * @param bool $show_actions If set to false, will not show the actions (default true)
     *
     * @return string Returns the html
     */
    public static function render_group_list($user_id='',$view='groups',$show_actions=true,$profile=true){
        global $wpdb;

        $linkBack = admin_url('users.php');

        $groups = CTXPS_Queries::get_groups($user_id);

        //If there are no groups, stop right here
        if(count($groups)===0){
            if ( $profile ) {
                return sprintf('<td colspan="4">%s</td>',sprintf(__('You are not currently a member of any groups.','contexture-page-security'),admin_url('users.php?page=ps_groups')));
            }
            else{
                return sprintf( '<td colspan="4">%s</td>', sprintf(__('This user has not been added to any custom groups. Select a group above or visit any <a href="%s">group detail page</a>.','contexture-page-security'), admin_url('users.php?page=ps_groups') ) );
            }
        }

        $html = '';
        $htmlactions = '';
        $countmembers = '';
        $alternatecss = ' class="alternate" ';
        $countusers = count_users();

        if(empty($user_id) && !empty($_REQUEST['user_id'])){
            $user_id = $_REQUEST['user_id'];
        }

        foreach($groups as $group){
            $countmembers = (!isset($group->group_system_id)) ? CTXPS_Queries::count_members($group->ID) : $countusers['total_users'];

            //Only create the actions if $showactions is true
            if($show_actions && current_user_can('promote_users')){
                switch($view){
                    case 'users':
                        //Button for "Remove" takes user out of group (ajax)
                        $htmlactions = "<div class=\"row-actions\"><span class=\"edit\"><a href=\"{$linkBack}?page=ps_groups_edit&groupid={$group->ID}\">Edit</a> | </span><span class=\"delete\"><a class=\"submitdelete\" id=\"unenroll-{$group->ID}\" onclick=\"CTXPS_Ajax.removeGroupFromUser({$group->ID},{$user_id},jQuery(this))\">Unenroll</a></span></div>";
                        break;
                    case 'groups':
                        //Button for "Delete" removes group from db (postback)
                        //If $showactions is false, we dont show the actions row at all
                        $htmlactions = "<div class=\"row-actions\"><span class=\"edit\"><a href=\"{$linkBack}?page=ps_groups_edit&groupid={$group->ID}\">Edit</a> | </span><span class=\"delete\"><a class=\"submitdelete\" href=\"?page=ps_groups_delete&groupid={$group->ID}\">Delete</a></span></div>";
                        break;
                    default:break;
                }
            }

            //If user isnt admin, we wont even link to group edit page (useful for profile pages)
            if ( current_user_can('promote_users') ){
                //User is admin - determined if link is system or not
                $grouplink = (!isset($group->group_system_id))
                    //This is a user group (editable)
                    ? "<a href=\"{$linkBack}?page=ps_groups_edit&groupid={$group->ID}\"><strong>{$group->group_title}</strong></a>{$htmlactions}"
                    //This is a system group (not editable)
                    : "<a id=\"$group->group_system_id\" class=\"ctx-ps-sysgroup\"><strong>{$group->group_title}</strong></a>";
            }else{
                //User is not admin - no links
                $grouplink = "<a id=\"$group->group_system_id\"><strong>{$group->group_title}</strong></a>";
            }

            $html .= "<tr {$alternatecss}>
                <td class=\"id\">{$group->ID}</td>
                <td class=\"name\">{$grouplink}</td>
                <td class=\"description\">{$group->group_description}</td>
                <td class=\"user-count\">$countmembers</td>
            </tr>";

            //Alternate css style for odd-numbered rows
            $alternatecss = ($alternatecss != '') ? '' : ' class="alternate" ';
        }
        return $html;
    }

    /**
     * Returns html for tbody element of group member list.
     *
     * @global wpdb $wpdb
     *
     * @param int $group_id The id of the group we need a member list for.
     * @return string Html to go inside tbody.
     */
    public static function render_member_list($group_id){
        global $wpdb;

        $members = CTXPS_Queries::get_group_members($group_id);
        if(count($members)===0){
            return '<td colspan="4">'.__('No users have been added to this group.','contexture-page-security').'</td>';
        }

        $countmembers = '';
        $alternatecss = ' class="alternate" ';
        $html = '<tr id="inline-edit" class="inline-edit-row inline-options-row-page inline-edit-page quick-edit-row quick-edit-row-page inline-edit-page" style="display: none"><td colspan="4">
                    <h4>'.__('MEMBERSHIP DETAILS','contexture-page-security').'</h4>
                    <fieldset class="inline-edit-col-left">
                        <label>
                            <span class="title">'.__('User','contexture-page-security').'</span>
                            <span class="input-text-wrap username" style="color:silver;">
                                username
                            </span>
                        </label>
                        <label>&nbsp;</label>
                    </fieldset>
                    <fieldset class="inline-edit-col-right">
                        <label>
                            <span class="title">'.__('Expires','contexture-page-security').'</span>
                            <span class="input-text-wrap">
                                <input type="checkbox" value="" name="membership_permanent"/>
                            </span>
                        </label>
                        <label>
                            <span class="title">'.__('End Date','contexture-page-security').'</span>
                        </label>
                        <div class="inline-edit-date">
                            <div class="timestamp-wrap">
                                <select tabindex="4" name="mm" disabled="disabled">
                                    <option value="01">Jan</option>
                                    <option value="02">Feb</option>
                                    <option value="03">Mar</option>
                                    <option value="04">Apr</option>
                                    <option value="05">May</option>
                                    <option value="06">Jun</option>
                                    <option value="07">Jul</option>
                                    <option value="08">Aug</option>
                                    <option value="09">Sep</option>
                                    <option value="10">Oct</option>
                                    <option value="11">Nov</option>
                                    <option value="12">Dec</option>
                                </select>
                                <input type="text" autocomplete="off" tabindex="4" maxlength="2" size="2" value="" name="jj" disabled="disabled">,
                                <input type="text" autocomplete="off" tabindex="4" maxlength="4" size="4" value="" name="aa" disabled="disabled">
                            </div>
                        </div>
                    </fieldset>
                    <p class="submit inline-edit-save">
                        <a class="button-secondary cancel alignleft" title="Cancel" href="#inline-membership" accesskey="c">'.__('Cancel','contexture-page-security').'</a>
                        <a class="button-primary save alignright" title="Update" href="#inline-membership" accesskey="s">'.__('Update','contexture-page-security').'</a>
                        <img alt="" src="'.admin_url('/images/wpspin_light.gif').'" style="display:none;" class="waiting"/>
                    </p>
                    </td></tr>';

        foreach($members as $member){
            $fname = get_user_meta($member->ID, 'first_name', true);
            $lname = get_user_meta($member->ID, 'last_name', true);
            $rawdate = strtotime($member->grel_expires);
            $jj = (!empty($rawdate)) ? date('d',$rawdate) : ''; //Day
            $mm = (!empty($rawdate)) ? date('m',$rawdate) : ''; //Month
            $aa = (!empty($rawdate)) ? date('Y',$rawdate) : ''; //Year
            if(!empty($rawdate) && $rawdate < time()){
                $displaydate = 'Expired';
            }else{
                $displaydate = (empty($rawdate) ? 'Never' : sprintf('%s-%s-%s',$mm,$jj,$aa));
            }

            $html .= sprintf('
            <tr id="user-%1$s" %2$s>
                <td class="username column-username">
                    <a href="%8$suser-edit.php?user_id=%1$s&wp_httpd_referer=%9$s"><strong>%3$s</strong></a>
                    <div class="row-actions">
                        <span class="membership"><a href="#" class="editmembership" title="Change membership options">'.__('Membership','contexture-page-security').'</a> | </span>
                        <span class="trash"><a class="row-actions" href="%8$s?page=ps_groups_edit&groupid=%6$s&action=rmvusr&usrid=%1$s&relid=%7$s&usrname=%3$s">'.__('Unenroll','contexture-page-security').'</a> | </span>
                        <span class="view"><a href="%8$suser-edit.php?user_id=%1$s&wp_httpd_referer=%9$s" title="View User">'.__('View','contexture-page-security').'</a></span>
                    </div>
                    <div id="inline_%1$s" class="hidden">
                        <div class="username">%3$s</div>
                        <div class="jj">%11$s</div>
                        <div class="mm">%12$s</div>
                        <div class="aa">%13$s</div>
                        <div class="grel">%7$s</div>
                    </div>
                </td>
                <td class="name column-name">%4$s</td>
                <td class="email column-email"><a href="mailto:%5$s">%5$s</a></td>
                <td class="expires column-expires">%10$s</td>
            </tr>',
                /*1*/$member->ID,
                /*2*/$alternatecss,
                /*3*/$member->user_login,
                /*4*/$fname.' '.$lname,
                /*5*/$member->user_email,
                /*6*/$_REQUEST['groupid'],
                /*7*/$member->grel_id,
                /*8*/admin_url(),
                /*9*/admin_url('users.php?page=ps_groups_edit&groupid='.$_REQUEST['groupid']),
                /*10*/$displaydate,
                /*11*/$jj,
                /*12*/$mm,
                /*13*/$aa
                );

            //Alternate css style for odd-numbered rows
            $alternatecss = ($alternatecss != '') ? '' : ' class="alternate" ';
        }
        return $html;
    }


    /**
     *
     * @param mixed $security Takes a security array, by default - but can provide an int or string (post_id) if security array isnt already available.
     * @param int $cur_page_id Optional. The current page id. If null, tries to get current page id from $_REQUEST['post'] or $_REQUEST['postid'].
     * @return string
     */
    public static function render_sidebar_attached_groups($security=null,$cur_page_id=null){

        if(is_numeric($security) || is_string($security)){
            //Get array with security requirements for this page
            $security = CTXPS_Security::get_post_protection( $security );
        }

        //Default vars
        $return = '';
        $termGroups = array();

        //If $cur_page_id isn't set, try to get the value from the querystring
        if(empty($cur_page_id)){
            if (!empty($_REQUEST['post_id'])){
                $cur_page_id = $_REQUEST['post_id'];
            }
            else if(!empty($_REQUEST['post'])){
                $cur_page_id = $_REQUEST['post'];
            }
            else if (!empty($_REQUEST['postid'])){
                $cur_page_id = $_REQUEST['postid'];
            }
        }

        //Fetch term groups, if we have a page id
        if(!empty($cur_page_id))
            $termGroups = CTXPS_Queries::get_groups_by_post_terms($cur_page_id,true);

        //Count the number of term groups
        $groupcount = count($termGroups);

        //Count the number of groups directly attached to this page (including inherited groups)
        if(!empty($security)){
            foreach($security as $securityGroups){
                $groupcount += count($securityGroups);
            }
        }

        //Show groups that are already added to this page
        if($groupcount===0){
            //Display this if we have no groups (inherited or otherwise)
            $return .= '<div><em>'.__('No groups have been added yet.','contexture-page-security').'</em></div>';
        }else{
            if(!empty($security)){
                foreach($security as $sec_array->pageid => $sec_array->grouparray){
                    //If this is the current page (and not an ancestor)
                    if($sec_array->pageid == $cur_page_id){
                        foreach($sec_array->grouparray as $currentGroup->id => $currentGroup->name){
                            $return .= '<div class="ctx-ps-sidebar-group">&bull; <span class="ctx-ps-sidebar-group-title">'.$currentGroup->name.'</span> <a style="text-decoration:none;" href="'.admin_url('/users.php?page=ps_groups_edit&groupid='.$currentGroup->id).'">&raquo;</a><span class="removegrp" onclick="CTXPS_Ajax.removeGroupFromPage('.$currentGroup->id.',jQuery(this))">'.__('remove','contexture-page-security').'</span></div>';
                        }
                    }else{
                        foreach($sec_array->grouparray as $currentGroup->id => $currentGroup->name){
                            $return .= '<div class="ctx-ps-sidebar-group inherited">&bull; <span class="ctx-ps-sidebar-group-title">'
                                .$currentGroup->name.'</span> <a style="text-decoration:none;" href="'
                                .admin_url('/users.php?page=ps_groups_edit&groupid='
                                .$currentGroup->id).'">&raquo;</a><a class="viewgrp" target="_blank" href="'
                                .admin_url('post.php?post='.$sec_array->pageid.'&action=edit').'" >'
                                .__('ancestor','contexture-page-security')
                                .'</a></div>';
                        }//foreach
                    }//else
                }//foreach
            }//if

            //Show terms that are already added to this list
            foreach($termGroups as $tgroup){

                //Get the term archive URL. If one doesnt exist, dont link
                $term_archive_link = admin_url(sprintf('/edit-tags.php?action=edit&taxonomy=%s&tag_ID=%s',$tgroup['taxonomy'],$tgroup['term_id']));

                //Build the link HTML for terms
                $return .= '<div class="ctx-ps-sidebar-group inherited">&bull; <span class="ctx-ps-sidebar-group-title">'
                    .$tgroup['group_title']
                    .'</span> <a style="text-decoration:none;" href="'.$term_archive_link.'">&raquo;</a><a class="viewgrp" target="_blank" href="'.$term_archive_link.'" >'
                    .__('term','contexture-page-security')
                    .'</a></div>';
            }
        }
        return $return;
    }

    /**
     * Creates an "Add to Group" drop-down list to do bulk actions on the users page
     * @return string HTML
     */
    public static function render_bulk_add_to_group(){
        $addtogrp = __('Add to group','contexture-page-security').'&hellip;';
        $groups = CTXPS_Queries::get_groups();

        //First, add our default option...
        $html = sprintf('<option value="">%s</option>',$addtogrp);
        //Then, add the rest of our groups as options
        foreach($groups as $group){
            if($group->group_system_id!=='CPS01'){ //Dont include Registered Users group
                $html .= CTX_Helper::gen('option', array('value'=>$group->ID), $group->group_title);
            }
        }

        //Now, lets wrap that in a select list
        $html = CTX_Helper::gen('select', array('name'=>'psc_group_add','id'=>'psc_group_add','style'=>'margin-left:5px;margin-right:5px;'), $html);

        //Add a label before the select
        $html = sprintf('<label class="screen-reader-text" for="psc_group_add">%s</label>',$addtogrp).$html;

        //Add a button after the select
        $html .= sprintf('<input type="button" name="enrollit" id="enrollit" class="button-secondary" value="%s"/>',__('Add','contexture-page-security'));

        //Finally, wrap all that in a div and return
        return CTX_Helper::gen('div', array('class'=>'alignleft actions'), $html);
    }

    /**
     * Takes a string and returns a wordpress-ready message. This should be
     * inserted immediately after the .wrap h2:first-child
     *
     * @param string $message The localized string to pass to the renderer
     * @param string $type Optional. The message class. possible values: 'updated','updated fade','error'
     * @return string HTML
     */
    public static function render_wp_message($message,$type='updated'){
        //Other types include:
        //  error
        //  updated fade
        return sprintf('<div id="message" class="%s"><p>%s</p></div>',$type,$message);
    }


    /**
     * Simply adds a header to taxonomy general settings, to make the page categories
     * more common-sense.
     *
     * I hate to use JS for this, but the hook is in a different place on edit-tag-form.php
     * than on edit-tags.php. This is the only way to inject it after the page title.
     */
    public static function render_taxonomy_protection_panel_pre(){
        ?>
            <script type="text/javascript">
                jQuery('#edittag').before('<h3><?php _e('General Settings','contexture-page-security') ?></h3>');
            </script>
        <?php
    }


}}
?>