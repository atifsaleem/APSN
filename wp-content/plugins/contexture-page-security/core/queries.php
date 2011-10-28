<?php
if(!class_exists('CTXPS_Queries')){
/**
 * Lets put as much SQL in here as possible to simplify our code
 */
class CTXPS_Queries{
    /**
     * Adds the important tables to the wordpress database
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     */
    public static function plugin_install(){
        global $wpdb, $ctxpsdb;

        self::check_php_version();

        $linkBack = admin_url();

        //Build our SQL scripts to create the new db tables
        $sql_create_groups = sprintf("CREATE TABLE IF NOT EXISTS `%s` (
            `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `group_title` varchar(40) NOT NULL COMMENT 'The name of the group',
            `group_description` text COMMENT 'A description of or notes about the group',
            `group_creator` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'The id of the user who created the group',
            `group_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP COMMENT 'The datetime the group was created',
            `group_system_id` varchar(5) UNIQUE NULL COMMENT 'A unique system id for system groups',
            `group_site_access` varchar(20) DEFAULT 'none' COMMENT 'If site security is enabled, this dictates how much access this group has. Values: none,limited,full',
            PRIMARY KEY (`ID`)
        )",$ctxpsdb->groups);

        $sql_create_group_relationships = sprintf("CREATE TABLE IF NOT EXISTS `%s` (
            `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `grel_group_id` bigint(20) UNSIGNED NOT NULL COMMENT 'The group id that the user is attached to',
            `grel_user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'The user id to attach to the group',
            `grel_expires` datetime COMMENT 'If set, user cannot access content after this date',
            PRIMARY KEY (`ID`)
        )",$ctxpsdb->group_rels);

        $sql_create_security = sprintf("CREATE TABLE IF NOT EXISTS `%s` (
            `ID` bigint(20) UNSIGNED NOT NULL auto_increment,
            `sec_protect_type` varchar(10) NOT NULL DEFAULT 'post' COMMENT 'What type of item is being protected? (post, term, media, archive, etc)',
            `sec_protect_id` bigint(20) unsigned NOT NULL COMMENT 'The id of the item (post, page, etc)',
            `sec_access_type` varchar(10) NOT NULL DEFAULT 'group' COMMENT 'Specifies whether this security entry pertains to a user, group, or role.',
            `sec_access_id` bigint(20) NOT NULL COMMENT 'The id of the user, group, or role this pertains to.',
            `sec_setting` varchar(10) NOT NULL DEFAULT 'allow' COMMENT 'Set to either allow or restrict',
            `sec_cascades` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'If true, these settings inherit down through the pages ancestors. If false (default), settings affect this page only.',
            PRIMARY KEY (`ID`)
        )",$ctxpsdb->security);

        $sql_create_term_meta = sprintf('CREATE TABLE IF NOT EXISTS `%stermmeta` (
            `meta_id` bigint(20) UNSIGNED NOT NULL auto_increment,
            `term_id` bigint(20) UNSIGNED NOT NULL,
            `meta_key` varchar(255),
            `meta_value` longtext,
            PRIMARY KEY (`meta_id`)
        )',$wpdb->prefix);

        //deactivate_plugins($ctxpsdb->pluginbase);
        //wp_die('<pre>'.print_r($ctxpsdb,true).'</pre>');
        //wp_die($ctxpsdb->security);

        //Create the tables
        $wpdb->show_errors();
        $wpdb->query($sql_create_groups);
        $wpdb->query($sql_create_group_relationships);
        $wpdb->query($sql_create_security);
        $wpdb->query($sql_create_term_meta);

        //Record what version of the db we're using (only works if option not already set - handy for ensuring upgrade path works as planned)
        add_option("contexture_ps_db_version", "1.5");

        //Set plugin options (not db version)
        CTXPS_Queries::set_options();

        /********* START UPGRADE PATH < 1.1 ***********/
        $dbver = get_option("contexture_ps_db_version");
        if($dbver == "" || (float)$dbver < 1.1){
            $wpdb->query("ALTER TABLE `".$ctxpsdb->groups."` ADD COLUMN `group_system_id` varchar(5) UNIQUE NULL COMMENT 'A unique system id for system groups' AFTER `group_date`");
            update_option("contexture_ps_db_version", "1.1");
        }
        /******** END UPGRADE PATH < 1.1 **************/

        /********* START UPGRADE PATH < 1.2 ***********/
        $dbver = get_option("contexture_ps_db_version");
        if($dbver == "" || (float)$dbver < 1.2){
            $wpdb->query("ALTER TABLE `".$ctxpsdb->group_rels."` ADD COLUMN `grel_expires` datetime COMMENT 'If set, user cannot access content after this date' AFTER `grel_user_id`");
            update_option("contexture_ps_db_version", "1.2");
        }
        /******** END UPGRADE PATH < 1.2 **************/

        /********* START UPGRADE PATH < 1.3 ***********/
        //Skip 1.3 - DB versions will now match major PSC releases
        /******** END UPGRADE PATH < 1.3 **************/

        /********* START UPGRADE PATH < 1.4 ***********/
        $dbver = get_option("contexture_ps_db_version");
        if($dbver == "" || (float)$dbver < 1.4){
            $wpdb->query("ALTER TABLE `".$ctxpsdb->groups."` ADD COLUMN `group_site_access` varchar(20) DEFAULT 'none' COMMENT 'If site security is enabled, this dictates how much access this group has. Values: none,limited,full'");
            update_option("contexture_ps_db_version", "1.4");
        }
        /******** END UPGRADE PATH < 1.4 **************/

        /********* START UPGRADE PATH < 1.5 ***********/
        //termmeta table added. No other changes necessary.
        $dbver = get_option("contexture_ps_db_version");
        if($dbver == "" || (float)$dbver < 1.5){
            //Default for posts/pages is now 'post' to correctly match WP conventions
            $wpdb->query("ALTER TABLE `".$ctxpsdb->security."` ALTER COLUMN `sec_protect_type` SET DEFAULT 'post'");
            $wpdb->query("UPDATE `".$ctxpsdb->security."` SET `sec_protect_type`='post' WHERE `sec_protect_type`='page'");
            update_option("contexture_ps_db_version", "1.5");
        }
        /******** END UPGRADE PATH < 1.5 **************/
        
        /********* START UPGRADE PATH < 1.6 ***********/
        //No changes to 1.6. JS updates only.
        /******** END UPGRADE PATH < 1.6 **************/

        //Check if our "Registered Users" group already exists
        $CntRegSmrtGrp = (bool)$wpdb->get_var("SELECT COUNT(*) FROM `".$ctxpsdb->groups."` WHERE `group_system_id` = 'CPS01' LIMIT 1");
        if(!$CntRegSmrtGrp){
            //Adds the Registered Users system group (if it doesnt exist)
            $wpdb->insert($ctxpsdb->groups, array(
                    'group_title'=>__('Registered Users','contexture-page-security'),
                    'group_description'=>__('This group automatically applies to all authenticated users.','contexture-page-security'),
                    'group_creator'=>'0',
                    'group_system_id'=>'CPS01'
            ));
        }
    }


    /**
     * Check whether the required version of PHP is present and disable the plugin if it's not.
     *
     * @global CTXPS_Tables $ctxpsdb
     * @param decimal $version Which version of PHP is required?
     * @param boolean $die If true, wp_die() is called, else returns string.
     */
    public static function check_php_version($version='5.2.4',$die=true){
        global $ctxpsdb;

        //Ensure that we're using PHP5 (plugin has reported problems with PHP4)
        if (version_compare(PHP_VERSION, $version, '<')) {

            //Ensure deactivate_plugins is loaded
            if(!function_exists('deactivate_plugins')){
                //If not, we need to include plugin.php
                require_once ABSPATH.'\wp-admin\includes\plugin.php';
            }
            //Now we can deactivate the plugin
            deactivate_plugins($ctxpsdb->pluginbase);

            //Build the error message
            $return = '<span style="color:red;font-weight:bold;">'.__('Missing Requirement:','contexture-page-security').'</span> '
                .sprintf(__('Page Security requires PHP %1$s or higher. Your server is running PHP %2$s. Please contact your hosting service about enabling PHP %1$s support.','contexture-page-security'),$version,PHP_VERSION)
                .'<a href="'.admin_url('plugins.php').'"> '.__('Return to plugin page','contexture-page-security').' &gt;&gt;</a>';

            //wp_die and show error message
            wp_die($return);
        }
    }
    
        /**
     * Check whether the required version of PHP is present and disable the plugin if it's not.
     *
     * @global CTXPS_Tables $ctxpsdb
     * @param decimal $version Which version of PHP is required?
     * @param boolean $die If true, wp_die() is called, else returns string.
     */
    public static function check_wp_version($version='3.2',$die=true){
        global $ctxpsdb, $wp_version;

        //Ensure that we're using PHP5 (plugin has reported problems with PHP4)
        if (version_compare($wp_version, $version, '<')) {

            //Ensure deactivate_plugins is loaded
            if(!function_exists('deactivate_plugins')){
                //If not, we need to include plugin.php
                require_once ABSPATH.'\wp-admin\includes\plugin.php';
            }
            //Now we can deactivate the plugin
            deactivate_plugins($ctxpsdb->pluginbase);

            //Build the error message
            $return = '<span style="color:red;font-weight:bold;">'.__('Missing Requirement:','contexture-page-security').'</span> '
                .sprintf(__('This version of Page Security requires WordPress %1$s or higher. You are running WordPress %2$s. Please update your copy of WordPress or use an earlier version of Page Security (recommended: 1.5.1).','contexture-page-security'),
                        $version,
                        $wp_version)
                .'<a href="'.admin_url('plugins.php').'"> '.__('Return to plugin page','contexture-page-security').' &gt;&gt;</a>';

            //wp_die and show error message
            wp_die($return);
        }
    }
    
    

     /**
     * Removes custom tables and options from the WP database.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     */
    public static function plugin_delete(){
        global $wpdb, $ctxpsdb;

        //Build SQL script to remove all old metadata
        $sql_scrub_postmeta = "DELETE FROM {$wpdb->postmeta} WHERE meta_key='ctx_ps_security'";
        $sql_scrub_termmeta = "DELETE FROM {$wpdb->prefix}termmeta WHERE meta_key='ctx_ps_security'";

        //Build our SQL scripts to delete the old db tables (don't touch termmeta, no telling if someone else is using it)
        $sql_drop_groups = "DROP TABLE IF EXISTS `" . $ctxpsdb->groups . "`";
        $sql_drop_group_relationships = "DROP TABLE IF EXISTS `" . $ctxpsdb->group_rels . "`";
        $sql_drop_security = "DROP TABLE IF EXISTS `" . $ctxpsdb->security . "`";

        //Run our cleanup queries
        $wpdb->show_errors();
        $wpdb->query($sql_scrub_postmeta);
        $wpdb->query($sql_scrub_termmeta);
        $wpdb->query($sql_drop_groups);
        $wpdb->query($sql_drop_group_relationships);
        $wpdb->query($sql_drop_security);

        //Remove our db version reference from options
        delete_option("contexture_ps_db_version");
        delete_option("contexture_ps_options");

    }


    /**
     * Inserts a new security setting into the db.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param string $content_id The id of the page/post/etc to be protected
     * @param string $protection_id The id of the group/user/etc being given access
     * @param string $content_type The type of content being protected (page/post/category/etc)
     * @param string $protection_type The type of protection being applied (group/user/role/etc)
     * @return mixed Either a boolean (false) if failed, or an int if succeeded (no rows affected)
     */
    public static function add_security($content_id,$protection_id,$content_type='post',$protection_type='group'){
        global $wpdb, $ctxpsdb;

        return $wpdb->insert($ctxpsdb->security,
            array(
                'sec_protect_type'  =>$content_type,
                'sec_protect_id'    =>$content_id,
                'sec_access_type'   =>$protection_type,
                'sec_access_id'     =>$protection_id
            )
        );
    }


    /**
     * Hooked to 'edit_terms'. Adds security toggle meta to the database for a specified
     * term.
     */
    public static function toggle_term_protection(){
        if ( !empty($_REQUEST['tag_ID']) ){
            if( isset($_REQUEST['prot-term']) ){
                return add_metadata('term', $_REQUEST['tag_ID'], 'ctx_ps_security', '1', true);
            }else{
                return delete_metadata('term', $_REQUEST['tag_ID'], 'ctx_ps_security');
            }
        }
        return false;
    }

    /**
     * Alias of get_metadata(), but with term and meta_key set in advance
     *
     * @param int $term_id The id of the term (see: tag_ID)
     * @param string $meta_key The key for the meta to get
     * @return mixed Returns false if no setting, else returns value.
     */
    public static function get_term_protection($term_id,$meta_key='ctx_ps_security'){
        $value = get_metadata('term',$term_id,$meta_key,'',true);
        return !empty($value);
    }

    /**
     * Alias of delete_metadata(), but with term and meta_key set in advance
     *
     * @param int $term_id The id of the term (see: tag_ID)
     * @param string $meta_key The key for the meta to get
     * @return mixed Returns false if no setting, else returns value.
     */
    public static function delete_term_protection(){
        if(!isset($_REQUEST['prot-term']) && !empty($_REQUEST['tag_ID'])){
            return delete_metadata('term', $_REQUEST['tag_ID'], 'ctx_ps_security');
        }
        return false;
    }

    /**
     * Alias of self::add_security(), but automatically changes $content_type to 'term'. Try not to use this as I plan on
     * deleting it, but want it here for reference.
     */
    public static function add_term_security($content_id,$protection_id,$content_type='term',$protection_type='group'){
        return self::add_security($content_id,$protection_id,$content_type,$protection_type);
    }

    /**
     * Deletes a group from the database. Also uses self::delete_group_members and
     * self::delete_security to ensure a completely 'clean' delete.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param type $group_id
     * @return type
     */
    public static function delete_group($group_id){
        global $wpdb, $ctxpsdb;
        if(self::delete_group_membership($group_id)===false){
            return false;
        }
        if(self::delete_security($group_id)===false){
            return false;
        }
        if($wpdb->query($wpdb->prepare('DELETE FROM `'.$ctxpsdb->groups.'` WHERE `ID` = %s',$group_id))===false){
            return false;
        }
        return true;
    }

    /**
     * Deletes one or more security records from the db.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Props $ctxpsdb
     * @param string $content_id The id of the page or post to unprotect
     * @param string $protection_id The id of the protector to be revoked. If empty, ALL groups will be removed from the content.
     * @param string $content_type Unused. Will tell PSC what type of content to protect.
     * @return mixed Either a boolean (false) if failed, or an int if succeeded (no rows affected)
     */
    public static function delete_security($content_id='',$protection_id='',$content_type='post',$protection_type='group'){
        global $wpdb, $ctxpsdb;
        $sql=false;

        if(empty($content_id) && !empty($protection_id) && is_numeric($protection_id)){
            return $wpdb->query($wpdb->prepare('
            DELETE FROM `'.$ctxpsdb->security.'`
            WHERE   sec_protect_type    = %s
            AND     sec_access_id       = %s
            AND     sec_access_type     = %s',
                /*1*/$content_type,
                /*2*/$protection_id,
                /*3*/$protection_type
            ));
        }

        //Remove specific access from specific content
        if(!empty($content_id) && is_numeric($content_id) &&
           !empty($protection_id) && is_numeric($protection_id)){
            return $wpdb->query($wpdb->prepare('
            DELETE FROM `'.$ctxpsdb->security.'`
            WHERE   sec_protect_id      = %s
            AND     sec_protect_type    = %s
            AND     sec_access_id       = %s
            AND     sec_access_type     = %s',
                /*1*/$content_id,
                /*2*/$content_type,
                /*3*/$protection_id,
                /*4*/$protection_type
            ));
        }

        //Removing ALL access from content
        return $wpdb->query($wpdb->prepare('
            DELETE FROM `'.$ctxpsdb->security.'`
            WHERE   sec_protect_id      = %s
            AND     sec_protect_type    = %s',
                /*1*/$content_id,
                /*2*/$content_type
        ));
    }

    /**
     * Deletes membership records for a specified group. If $user_id is null, this
     * method will delete ALL membership records the specified group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param type $group_id
     * @param mixed $user_id Null will delete ALL relationships. Array will delete multiple specified relationships. String or int will delete one relationship.
     * @return bool Returns true if all deleted, false if error.
     */
    public static function delete_group_membership($group_id,$user_id=null){
        global $wpdb, $ctxpsdb;
        //Delete ALL relationships
        if($user_id===null || $user_id==='all'){
            return $wpdb->query($wpdb->prepare('DELETE FROM `'.$ctxpsdb->group_rels.'` WHERE `grel_group_id` = %s',$group_id));
        }
        //Delete specified relationships (array)
        if(is_array($user_id) && count($user_id)>0){
            $uid_sql = '';
            $uid_loop = 1;
            $uid_cnt = count($user_id);
            foreach($user_id as $uid){
                $uid_sql .= $wpdb->prepare('`grel_user_id`=%s',$uid);
                if($uid_cnt>$uid_loop){ $uid_sql.=' OR '; }
                $uid_loop++;
            }
            return $wpdb->query($wpdb->prepare('DELETE FROM `'.$ctxpsdb->group_rels.'` WHERE `grel_group_id` = %s AND ('.$uid_sql.')'));
        }
        //Delete one relationship
        if(is_string($user_id) || is_numeric($user_id)){
            return $wpdb->query($wpdb->prepare('DELETE FROM `'.$ctxpsdb->group_rels.'` WHERE `grel_group_id` = %s AND `grel_user_id` = %s',$group_id,$user_id));
        }
        return false;
    }

    /**
     * Checks if a user is enrolled in a group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $user_id
     * @param int $group_id
     * @return boolean Returns true if user is in group, false if not.
     */
    public static function check_membership($user_id,$group_id){
        global $wpdb, $ctxpsdb;
        $check = $wpdb->get_var($wpdb->prepare(
            'SELECT COUNT(*) FROM `'.$ctxpsdb->group_rels.'` WHERE grel_group_id=%s AND grel_user_id=%s',
                $group_id,
                $user_id
        ));
        return ($check>0);
    }

    /**
     * Checks if user exists in WP db. Returns true if user exists, false if not.
     * If checking a username, use WordPress' username_exists() function instead.
     *
     * @global wpdb $wpdb
     * @param integer $user_id
     * @return boolean True if user exists in db. False if not.
     */
    public static function check_user_exists($user_id){
        global $wpdb;
        $check = (integer)$wpdb->get_var($wpdb->prepare(
            'SELECT COUNT(*) FROM `'.$wpdb->users.'` WHERE `'.$wpdb->users.'`.ID = %s',
                $user_id
        ));
        return ($check>0);
    }

    /**
     * Add a user to a group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $user_id
     * @param int $group_id
     * @return bool Returns 1 if success, false if failed.
     */
    public static function add_membership($user_id,$group_id,$expiration=null){
        global $wpdb,$ctxpsdb;

        //If we're trying to use this method with an expiration, forward to add_membership_with_expiration()
        if(!empty($expiration)){
            return self::add_membership_with_expiration($user_id,$group_id,$expiration);
        }

        //Otherwise, use the simple insert
        return $wpdb->insert($ctxpsdb->group_rels,
                array(
                    'grel_group_id'=>$group_id,
                    'grel_user_id'=>$user_id
                )
        );

    }

    /**
     * Serves the same general purpose of add_membership, but performs some additional validation
     * and can also add a member with an expiration.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $user_id The users id. Can be used with ::get_user_id_by_username() if unsure.
     * @param int $group_id The id of the group to add the user to.
     * @param mixed $expiration Can be null or 'null' or a valid mysql-formatted date string (Y-m-d)
     * @return boolean True if successfully registered, false if not.
     */
    public static function add_membership_with_expiration($user_id,$group_id,$expiration=null){
        global $wpdb,$ctxpsdb;

        //If either value isnt an int, fail
        if(!is_numeric($user_id) || !is_numeric($group_id)){
            return false;
        }

        //if user is already in a group, return false immediately
        if(self::check_membership($user_id, $group_id)){ return false; }

        //If this user doesn't exist
        if(!self::check_user_exists($user_id)){
            return false;
        } else {
            //Add user to group (can't use $wpdb->insert because of the NULL possibility)
            $sqlUpdateGroup = sprintf("INSERT INTO `%s` (grel_group_id, grel_user_id, grel_expires) VALUES ('%s','%s',%s);",
                $ctxpsdb->group_relss,
                $group_id,
                $user_id,
                (empty($expiration) || strtolower($expiration)==='null') ? 'NULL' : "'".$expiration."'"
            );
            if($wpdb->query($sqlUpdateGroup) === false){
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Updates a user's enrollment information, by grel_id. Use get_grel(), if needed,
     * to find the grel_id.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $grel_id
     * @param string $expiration_date A MySQL-friendly, string-formatted DateTime. yyyy-mm-dd hh:mm:ss
     * @return type
     */
    public static function update_enrollment_grel($grel_id,$expiration_date){
        global $wpdb,$ctxpsdb;

        //Return false if this is empty
        if(empty($expiration_date)){
            return false;
        }
        
        //If we need to set this to null...
        if(trim(strtolower($expiration_date))==='null'){
            return $wpdb->query($wpdb->prepare('UPDATE `'.$ctxpsdb->group_rels.'` SET grel_expires=NULL WHERE id=%s',$grel_id));
        }

        if(preg_match('/^\d{4}-\d{1,2}-\d{1,2}/', trim($expiration_date))>=1){
            //Try to format the date (extra layer of validation)
            $expiration_date = strtotime((string)$expiration_date);
            //Let's convert our unix timestamp back to a MySQL-friendly date
            $expiration_date = date('Y-m-d H:i:s', $expiration_date);
        }else{
            return false;
        }

        //Run the query and return
        return $wpdb->update($ctxpsdb->group_rels, array('grel_expires'=>$expiration_date), array('ID'=>$grel_id));
    }

    /**
     * Gets the group-relationship id for a user's group membership.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @return mixed Returns the grel_id (int) if found, false otherwise.
     */
    public static function get_grel($user_id,$group_id){
        global $wpdb,$ctxpsdb;

        $return = $wpdb->get_var($wpdb->prepare(
                'SELECT `ID` FROM `'.$ctxpsdb->group_rels.'`
                    WHERE grel_user_id=%s
                    AND grel_group_id=%s LIMIT 1',
                $user_id,
                $group_id),
            0,0
        );

        //Return false if above is empty (0 is not a valid starting id in MySQL), else return $result
        return (empty($return)) ? false : $return;
    }

    /**
     * Removes a user from a group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $user_id
     * @param int $group_id
     * @return boolean Returns true if delete was successful, false if it failed for any reason.
     */
    public static function delete_membership($user_id,$group_id){
        global $wpdb,$ctxpsdb;

        $count = $wpdb->query($wpdb->prepare('DELETE FROM `'.$ctxpsdb->group_rels.'` WHERE grel_group_id = %s AND grel_user_id = %s',
                $group_id,
                $user_id
        ));
        return ($count>0);
    }


    /**
     * Handles creating or updating the options array
     *
     * @param array $array_overrides An associative array containing key=>value pairs to override originals
     * @return string
     */
    public static function set_options($arrayOverrides=false){
        global $post;

        //Set defaults
        $defaultOpts = array(
            'ad_msg_usepages'       =>'false', //Whether to use pages as access denied
            'ad_msg_anon'           =>__('You do not have the appropriate group permissions to access this page. Please try <a href="%login_url%">logging in</a> or contact an administrator for assistance.','contexture-page-security'),
            'ad_msg_auth'           =>__('You do not have the appropriate group permissions to access this page. If you believe you <em>should</em> have access to this page, please contact an administrator for assistance.','contexture-page-security'),
            'ad_page_anon_id'       =>'',      //Id of the page to use for default anonymous denied users
            'ad_page_auth_id'       =>'',      //Id of the page to use for default authorized denied users
            'ad_msg_usefilter_menus'=>'true',  //Filter menu content
            'ad_msg_usefilter_rss'  =>'true',  //Filter RSS feed content
            'ad_opt_protect_site'   =>'false', //Enable sitewide protection options
            'ad_opt_page_replace'   =>'false', //Use replacement method instead of redirect
            'ad_opt_login_anon'     =>'false'  //Automatically redirect unauthenticated, denied users to login page
        );

        //Let's see if the options already exist...
        $dbOpts = get_option('contexture_ps_options');

        if(!$dbOpts){
            //There's no options! Let's build them...
            if($arrayOverrides!=false && is_array($arrayOverrides)){
                //If we have some custom settings, use those
                $defaultOpts = array_merge($defaultOpts, $arrayOverrides);
            }
            //Now add them to the db
            return add_option('contexture_ps_options',$defaultOpts);
        }else{
            //db options exist, so let's merge it with the defaults (just to be sure we have all the latest options
            $defaultOpts = array_merge($defaultOpts, $dbOpts);
            //Now let's add our custom settings (if appropriate)
            if($arrayOverrides!=false && is_array($arrayOverrides)){
                //If we have some custom settings, use those
                $defaultOpts = array_merge($defaultOpts, $arrayOverrides);
            }
            return update_option('contexture_ps_options',$defaultOpts);
        }

    }

    /**
     * Gets a count of the number of groups currently in the db
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $user_id Optional. If provided, will return the number of groups a specified user is a member of.
     * @return int The number of groups in the db
     */
    public static function count_groups($user_id=null){
        global $wpdb,$ctxpsdb;
        if(is_numeric($user_id) && !empty($user_id)){
            return $wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM `'.$ctxpsdb->group_rels.'` WHERE grel_user_id = %s',$user_id));
        }
        return $wpdb->get_var('SELECT COUNT(*) FROM `'.$ctxpsdb->groups.'` WHERE group_system_id IS NULL');
    }


    /**
     * Count the number of pages that use this group for permissions
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $group_id The id of the group to count for pages.
     * @param string $type Optional. The type of protection to count (null for "any").
     * @return int The number of groups attached to this page.
     */
    public static function count_protected($group_id=null,$type=null){
        global $wpdb,$ctxpsdb;

        if($type!==null){
            //At some point we'll need to specify protection type. ie: 'group' or 'user'
            trigger_error('$type parameter is currently unused.', E_USER_NOTICE);
        }

        if(is_numeric($group_id) && !empty($group_id)){
            return $wpdb->get_var($wpdb->prepare('SELECT COUNT(DISTINCT(sec_protect_id)) FROM `'.$ctxpsdb->security.'` WHERE sec_access_id=%s',$group_id));
        }
        return $wpdb->get_var('SELECT COUNT(DISTINCT(sec_protect_id)) FROM `'.$ctxpsdb->security.'`');
    }


    /**
     * Gets a count of the number of users currently in a group, or the total number of users
     * currently
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $group_id The group id to count users for
     * @return int The number of users attached to the group
     */
    public static function count_members($group_id=null){
        global $wpdb,$ctxpsdb;
        if(is_numeric($group_id) && !empty($group_id)){
            return $wpdb->get_var($wpdb->prepare('SELECT COUNT(*) FROM `'.$ctxpsdb->group_rels.'` WHERE grel_group_id = %s',$group_id));
        }
        return $wpdb->get_var('SELECT COUNT(DISTINCT(grel_user_id)) FROM `'.$ctxpsdb->group_rels.'`');
    }

    /**
     * Returns an array containing the groups attached to the specified content. This can be used
     * to either return a "simple" group list (used in tables) or a "security" group list (which
     * includes security info necessary to check permissions). Default is "simple" style list.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param integer $post_id The post_id of the content to get groups for (can be any content type that uses posts table)
     * @param boolean $security If true, will return a 'protection' array (used for validating access). Default is false.
     * @return array
     */
    public static function get_groups_by_post($post_id,$security=false){
        global $wpdb,$ctxpsdb;
        return self::get_groups_by_object('post',$post_id,$security);
    }

    /**
     * Returns a flat array containing a security list of groups attached to terms that
     * are associated with the specified post.
     *
     * The returned data is usually used to automatically apply term groups to all
     * posts associated with the term.
     *
     * @global wpdb $wpdb
     * @param integer $post_id The post_id of the content to get groups for (can be any content type that uses posts table)
     * @param boolean $inc_terms Optional. If true, will return a jagged array containing group & term info. Default is false.
     * @global CTXPSC_Tables $ctxpsdb
     */
    public static function get_groups_by_post_terms($post_id,$inc_terms=false){
        global $wpdb,$ctxpsdb;

        $groups = array();

        /******* Build a list of terms, using all taxonomies *******************/
        $terms = self::get_post_terms($post_id);

        /******* Use terms to find associated groups ***************************/
        foreach($terms as $term){
            $groups += self::get_groups_by_term($term->term_id,$term->taxonomy,$inc_terms);
        }

        return $groups;
    }

    /**
     * Returns all the groups associated with a term or it's ancestors.
     *
     * @param array $terms An array of terms to check
     * @return array An array of groups [id]=>[name]
     */
    public static function get_groups_by_term($term,$taxonomy,$inc_terms=false){
        $term = get_term($term,$taxonomy);
        $groups = array();

        //Get all the groups for this term
        foreach(self::get_groups_by_object('term',$term->term_id,true) as $tg){
            if(!$inc_terms){
                $groups[$tg->group_id] = $tg->group_title;
            }else{
                $groups[$tg->group_id] = array(
                    'group_id'=>$tg->group_id,
                    'group_title'=>$tg->group_title,
                    'term_id'=>$term->term_id,
                    'taxonomy'=>$term->taxonomy
                );
            }
            unset($tg);
        }

        //If there's a parent, recurse
        if(!empty($term->parent))
            $groups += self::get_groups_by_term($term->parent,$taxonomy,$inc_terms);

        return $groups;
    }

    /**
     * Returns an array containing the groups attached to the specified content. This can be used
     * to either return a "simple" group list (used in tables) or a "security" group list (which
     * includes security info necessary to check permissions). Default is "simple" style list.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param string $object_type The object type to check. Such as "media", "term", or "post"
     * @param integer $object_id The Tag_ID, post_id, etc of the content to get groups for (can be any content type that uses posts table)
     * @param boolean $security If true, will return a 'protection' array (used for validating access). Default is false.
     * @return array
     */
    public static function get_groups_by_object($object_type, $object_id, $security=false){
        global $wpdb,$ctxpsdb;

        //Only continue if $post_id is a valid int
        if(!empty($object_id) && is_numeric($object_id) && !empty($object_type)){

            //If this is a simple query (no security info), do this...
            if(!$security){

                //Only return basic security info (no extended results)
                return $wpdb->get_results($wpdb->prepare(
                    'SELECT * FROM `'.$ctxpsdb->security.'`
                        JOIN `'.$ctxpsdb->groups.'`
                            ON '.$ctxpsdb->security.'.sec_access_id = '.$ctxpsdb->groups.'.ID
                        WHERE sec_protect_type = %s
                        AND sec_protect_id = %s',
                    $object_type,
                    $object_id
                ));


            //If we need full security arrays with heirarchal relationships...
            }else{

                //Which table do we join with?
                switch($object_type){
                    //Get full security info for posts (posts,pages,galleries,custom types, etc)
                    case 'post':
                        return $wpdb->get_results($wpdb->prepare(
                            'SELECT
                                `'.$wpdb->posts.'`.id AS post_id,
                                `'.$wpdb->posts.'`.post_parent AS post_parent_id,
                                `'.$ctxpsdb->groups.'`.ID AS group_id,
                                `'.$ctxpsdb->groups.'`.group_title
                            FROM `'.$ctxpsdb->security.'`
                            JOIN `'.$wpdb->posts.'`
                                ON `'.$ctxpsdb->security.'`.sec_protect_id = `'.$wpdb->posts.'`.ID
                            JOIN `'.$ctxpsdb->groups.'`
                                ON `'.$ctxpsdb->security.'`.sec_access_id = `'.$ctxpsdb->groups.'`.ID
                            WHERE `'.$ctxpsdb->security.'`.sec_protect_id = %s
                            AND `'.$ctxpsdb->security.'`.sec_protect_type = %s
                        ',
                         $object_id,
                         $object_type));
                        break;

                    //Get full security info for taxonomy terms
                    case 'term':
                        return $wpdb->get_results($wpdb->prepare(
                            'SELECT
                                `'.$wpdb->terms.'`.term_id,
                                `'.$wpdb->terms.'`.name AS term_name,
                                `'.$wpdb->term_taxonomy.'`.taxonomy,
                                `'.$wpdb->term_taxonomy.'`.parent AS term_parent_id,
                                `'.$ctxpsdb->groups.'`.ID AS group_id,
                                `'.$ctxpsdb->groups.'`.group_title
                            FROM `'.$ctxpsdb->security.'`
                            JOIN `'.$wpdb->terms.'`
                                ON `'.$ctxpsdb->security.'`.sec_protect_id = `'.$wpdb->terms.'`.term_id
                            JOIN `'.$wpdb->term_taxonomy.'`
                                ON `'.$wpdb->terms.'`.term_id = `'.$wpdb->term_taxonomy.'`.term_id
                            JOIN `'.$ctxpsdb->groups.'`
                                ON `'.$ctxpsdb->security.'`.sec_access_id = `'.$ctxpsdb->groups.'`.ID
                            WHERE `'.$ctxpsdb->security.'`.sec_protect_id = %s
                            AND `'.$ctxpsdb->security.'`.sec_protect_type = %s
                        ',
                         $object_id,
                         $object_type));
                        break;

                    //Object_type did not match anything
                    default:break;
                }

            }

        }
        //If $object_id or $object_type is improper, return false
        return false;
    }

    /**
     * Returns a list of content that are attached to the specified group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param type $group_id
     * @return type
     */
    public static function get_content_by_group($group_id,$content_type='post'){
        global $wpdb,$ctxpsdb;

        //Validate
        if(is_numeric($group_id) && !empty($group_id) && !empty($content_type)){

            //Default return value (empty array)
            $return = array();
            switch($content_type){
                case 'post':
                    $return += $wpdb->get_results($wpdb->prepare(
                        'SELECT * FROM `'.$ctxpsdb->security.'`
                            JOIN `'.$wpdb->posts.'`
                                ON `sec_protect_id` = `'.$wpdb->posts.'`.`ID`
                            WHERE `sec_access_id`=%s
                            AND `sec_protect_type`="post"',
                        $group_id
                    ));
                    break;
                case 'term':
                    $return += $wpdb->get_results($wpdb->prepare(
                        'SELECT * FROM `'.$ctxpsdb->security.'`
                            JOIN `'.$wpdb->terms.'`
                                ON `sec_protect_id` = `'.$wpdb->terms.'`.term_id
                            JOIN `'.$wpdb->term_taxonomy.'`
                                ON `'.$wpdb->term_taxonomy.'`.`term_id` = `'.$wpdb->terms.'`.`term_id`
                            WHERE `sec_access_id`=%s
                            AND `sec_protect_type`="term"',
                        $group_id
                    ));
                    break;
                default:
                    return false;
                    break;
            }

            return $return;

        }
        //If $group_id is improper, return false
        return false;
    }

    /**
     * Adds a group to the database.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param string $group_title A short title for the group.
     * @param string $group_description A description of the group.
     * @param int $creator_id The user_id for the person creating this group (can use 0 for none)
     * @return mixed Returns the number of rows inserted (int) or false (bool) on error.
     */
    public static function add_group($group_title,$group_description,$creator_id='0'){
        global $wpdb,$ctxpsdb;
        //Get rid of extra whitespace
        $group_title = trim($group_title);
        //DB column requires names < 40 char
        $group_title = substr($group_title, 0, 40);

        //Only insert the group if the name isn't taken
        if(!self::check_group_exists($group_title)){
            return $wpdb->insert($ctxpsdb->groups, array(
                'group_title'=>$group_title,
                'group_description'=>$group_description,
                'group_creator'=>$creator_id
            ));
        }
        return 0;
    }

    /**
     * Determines if the current or specified page is set as an Access Denied page.
     *
     * @param int $post_id
     * @return boolean Returns true if the current page is an access denied page
     */
    public static function check_ad_status($post_id=null){
        global $post;

        //If we're checking against double null (shouldn't happen, but just-in-case)
        if(empty($post) && empty($post_id)){
            return false;
        }

        $post_id = (empty($post_id)) ? $post->ID : $post_id;
        $plugin_opts = get_option('contexture_ps_options');
        return ($plugin_opts['ad_page_anon_id']==$post_id || $plugin_opts['ad_page_auth_id']==$post_id);
    }

    /**
     * Checks if a group with the provided name already exists. This is used to validate
     * in self::create_group() to ensure duplicate group names don't crop up.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param string $group_name
     * @return boolean Returns true if the group already exists, false if not.
     */
    public static function check_group_exists($group_name){
        global $wpdb,$ctxpsdb;

        //Get rid of extra whitespace
        $group_name = trim($group_name);
        //DB column requires names < 40 char
        $group_name = substr($group_name, 0, 40);

        //Check for a match
        $check = $wpdb->get_var($wpdb->prepare(
                'SELECT COUNT(*) FROM `'.$ctxpsdb->groups.'`
                    WHERE group_title = %s',
                $group_name
        ));

        return ($check>0);
    }

    /**
     * Recursively checks security for this page/post and it's ancestors. Returns true
     * if any of them are protected or false if none of them are protected.
     *
     * Note that this check automatically includes term checks. If a post includes a
     * term that is protected, this function automatically returns
     *
     * @global wpdb $wpdb
     * @param int $post_id The id of the post to check.
     * @param bool $check_terms Optional. Set to true if you want to include term groups with the posts.
     *
     * @return bool Returns true if the page or one of it's ancestors has the "protected" flag
     */
    public static function check_section_protection($post_id,$check_terms=false){
        global $wpdb;
        if(get_post_meta($post_id,'ctx_ps_security')){
            return true;
        } else {

            //If $check_terms is true, also check term protection
            if($check_terms){
                if( self::check_post_term_protection($post_id) )
                    return true;
            }

            $parent_id = get_post($post_id);
            $parent_id = $parent_id->post_parent;
            if ($parent_id != 0)
                return self::check_section_protection($parent_id);
            else
                return false;
        }
    }


    /**
     * Checks whether a post is using a protected term.
     *
     * @param int $post_id The pos to check.
     * @return bool Returns true if post contains a protected term.
     */
    public static function check_post_term_protection($post_id){

        //initialize variables
        $terms = self::get_post_terms($post_id);

        $ancestor_protected = false;

        foreach($terms as $term){
            if(get_metadata('term',$term->term_id,'ctx_ps_security')){
                return true;
            }else{
                if( $term->parent!=0 ){
                    if(self::check_term_protection($term->term_id))
                        $ancestor_protected = true;
                }
            }
        }

        //If any ancestor terms are protected, return true
        if($ancestor_protected)
            return true;

        //If no protection flags were triggered, return false
        return false;
    }


    /**
     * Fetches a list of all terms associated with the post, ignoring taxonomy.
     *
     * @param int $post_id The id of the post to get terms for.
     * @return array An array containing all the terms attached to this post, regardless of taxonomy
     */
    public static function get_post_terms($post_id){
        //initialize variables
        $terms = array();

        //Get all terms for this post, regardless of taxonomy
        foreach(get_post_taxonomies($post_id) as $taxonomy){
            $terms = array_merge(wp_get_post_terms($post_id,$taxonomy),$terms);
        }

        return $terms;
    }

    /**
     * Fetches the name of the taxonomy the term is a part of.
     *
     * @global wpdb $wpdb
     * @param int $term_id
     * @return string The name of the taxonomy this term belongs to.
     */
    public static function get_term_taxonomy($term_id){
        global $wpdb;

        return $wpdb->get_var("SELECT `taxonomy` FROM {$wpdb->term_taxonomy} WHERE `term_id`='{$term_id}'");
    }

    /**
     * Recursively checks security for this term and it's ancestors. Returns true
     * if any of them are protected or false if none of them are protected.
     *
     * @global wpdb $wpdb
     * @param int $term_id The id of the term to check security for.
     * @param string $taxonomy The name of the taxonomy the term belongs to.
     * @param bool $recursive Set to false to disable the checking of ancestors. (Default: true)
     *
     * @return bool If this page or it's ancestors has the "protected page" flag
     */
    public static function check_term_protection($term_id,$taxonomy=null,$recursive=true){
        global $wpdb;

        if(get_metadata('term',$term_id,'ctx_ps_security')){
            return true;
        } else if($recursive) {
            //If taxonomy isnt set and we're using term id, try to get it
            if(empty($taxonomy) && is_numeric($term_id))
                $taxonomy = self::get_term_taxonomy($term_id);

            //If term has no protection, check parents
            $parent_id = get_term($term_id,$taxonomy);
            $parent_id = $parent_id->parent;
            if ($parent_id != 0)
                return self::check_term_protection($parent_id,$taxonomy);
            else
                return false;
        }else{
            //Recursive is false and no protection
            return false;
        }
    }



    /**
     * Gets the id of the specified posts parent.
     *
     * @global wpdb $wpdb
     * @param type $post_id
     * @return integer The id of the specified post's parent
     */
    public static function get_parent_id($post_id){
        global $wpdb,$ctxpsdb;
        return $wpdb->get_var($wpdb->prepare('SELECT post_parent FROM `'.$wpdb->posts.'` WHERE `ID` = %s',$post_id));
    }

    /**
     * Returns an array containing the ids of all explicitly protected pages
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @return mixed Returns an array containing post ids, or a CSV if $return_type is set to 'csv'
     */
    public static function get_protected_posts($return_type='array'){
        global $wpdb,$ctxpsdb;
        $results =  $wpdb->get_results('SELECT DISTINCT(post_id) FROM `'.$wpdb->postmeta.'` WHERE `meta_key` = "ctx_ps_security"',ARRAY_N);

        //IF WE NEED A STRING (CSV) DO THIS....
        if($return_type==='string'){
            $string = '';
            foreach($results as $page){
                $string .= $page[0].',';
            }
            //get rid of the last comma before returning
            return (string)preg_replace('/,$/','',$string);
        //HANDLE DEFAULT (ARRAY)
        }

        //We get back an unnecessary multidimensional array, so we will collapse this into a simple array
        $array = array();
        foreach($results as $page){
            $array[] = $page[0];
        }
        return $array;
    }

    /**
     * Returns an array with all the groups for which a user has a current, active
     * membership. This takes into account system groups and membership expiration
     * dates.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     *
     * @param int $user_id The user id of the user to check
     * @param boolean $site_only Optional. If true, array will only include groups with site access.
     *
     * @return array Returns a flat array with all the groups that the specified user is currently a member of.
     */
    public static function get_user_groups($user_id,$site_only=false){
        global $wpdb, $ctxpsdb;

        /**Empty array to be used for building output*/
        $array = array();
        $newArray = array();
        /**Todays date for MySQL comparison*/
        $today = date('Y-m-d');
        /**Assume user is multi-site user*/
        $multisitemember = true;
        //Get membership only if it's not expired
        $query = $wpdb->prepare(
            'SELECT * FROM `'.$ctxpsdb->group_rels.'`
            JOIN `'.$ctxpsdb->groups.'`
                ON `'.$ctxpsdb->group_rels.'`.grel_group_id = `'.$ctxpsdb->groups.'`.ID
            WHERE `'.$ctxpsdb->group_rels.'`.grel_user_id = %s
            AND (grel_expires IS NULL OR grel_expires > %s)',
                $user_id,
                $today
        );

        //If $site_only is true, append extra restriction to query
        if($site_only){
            $query .= ' AND (group_site_access = "limited" OR group_site_access = "full")';
        }

        $groups = $wpdb->get_results($query);

        //We only need an ID and a name as a key/value...
        foreach($groups as $group){
            $array += array($group->ID => $group->group_title);
        }


        //If multisite is enabled we can better support it...
        if(function_exists('is_user_member_of_blog')){
            $multisitemember = is_user_member_of_blog($user_id);
        }

        /*** ADD SMART GROUPS (AKA SYSTEM GROUPS ***/
        //Registered Users Smart Group
        if($user_id != 0 && $multisitemember){
            //Get the ID for CPS01
            $newArray = CTXPS_Queries::get_system_group('CPS01');
            //Add CPS01 to the current users permissions array
            $array += array($newArray->ID => $newArray->group_title);
        }

        return $array;
    }

    /**
     *
     * @global wpdb $wpdb
     * @param string $username
     * @return int The user_id of the specified user. False if not found.
     */
    public static function get_user_id_by_username( $username ) {
        global $wpdb;

        //Lets convert the request to a nicename (should be more reliable)
        $username = sanitize_title( $username );
        $username = apply_filters('pre_user_nicename', $username);

        //lets run this thing...
        $query = $wpdb->prepare('SELECT `ID` FROM `'.$wpdb->users.'` WHERE `user_nicename`=%s LIMIT 1',$username);
        return $wpdb->get_var($query,0,0);
    }

    /**
     * Gets all the information about a single group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $group_id The id of a group.
     * @return mixed Returns an array, or false if $group_id is invalid.
     */
    public static function get_group_info($group_id){
        global $wpdb,$ctxpsdb;
        if(is_numeric($group_id) && !empty($group_id)){
            return $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$ctxpsdb->groups.'` WHERE `ID` = %s',$group_id));
        }
        return false;
    }

    /**
     * Returns a list of all groups (incl system groups). If $user_id is provided,
     * the list only includes groups that the specified user to attached to.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $user_id
     * @return array
     */
    public static function get_groups($user_id=null){
        global $wpdb,$ctxpsdb;
        //If $user_id is any kind of empty, get a list of ALL groups
        if(is_numeric($user_id) && !empty($user_id)){
            //Otherwise, let's only fetch the ones relevant to the specified user
            return $wpdb->get_results($wpdb->prepare(
                'SELECT * FROM `'.$ctxpsdb->group_rels.'`
                JOIN `'.$ctxpsdb->groups.'`
                    ON grel_group_id = `'.$ctxpsdb->groups.'`.ID
                WHERE grel_user_id = %s
                ORDER BY `group_system_id` DESC, `group_title` ASC',
                    $user_id
            ));
        }
        return $wpdb->get_results('SELECT * FROM `'.$ctxpsdb->groups.'` ORDER BY `group_system_id` DESC, `group_title` ASC');
    }

    /**
     * This gets an array of all the users attached to a specified group.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $group_id The ID of the group to get users for.
     * @return array
     */
    public static function get_group_members($group_id){
        global $wpdb,$ctxpsdb;

        return $wpdb->get_results($wpdb->prepare(
            'SELECT
                `'.$wpdb->users.'`.ID AS ID,
                `'.$ctxpsdb->group_rels.'`.ID AS grel_id,
                `'.$wpdb->users.'`.user_login,
                `'.$wpdb->users.'`.user_email,
                `'.$ctxpsdb->group_rels.'`.grel_expires
            FROM `'.$ctxpsdb->group_rels.'`
            JOIN `'.$wpdb->users.'`
                ON `'.$ctxpsdb->group_rels.'`.grel_user_id = `'.$wpdb->users.'`.ID
            WHERE grel_group_id = %s',
            $group_id
        ));
    }


    /**
     * Get's a system group (like Registered Users) by system id. The system id
     * is usually CTX##.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $group_system_id The ID of the group to get users for.
     * @return array
     */
    public static function get_system_group($group_system_id){
        global $wpdb,$ctxpsdb;

        $array = $wpdb->get_row($wpdb->prepare(
            'SELECT * FROM `'.$ctxpsdb->groups.'`
            WHERE group_system_id = %s
            LIMIT 1',
            $group_system_id
        ));
        return $array;
    }

    /**
     * Updates basic group information.
     *
     * @global wpdb $wpdb
     * @global CTXPSC_Tables $ctxpsdb
     * @param int $group_id
     * @param array $args
     * @return bool
     */
    public static function update_group($group_id,$name,$description,$site_access='none'){
        global $wpdb,$ctxpsdb;
        //Just in case we override $site_access with an empty value
        if(empty($site_access)){
            $site_access='none';
        }
        return $wpdb->update(
                $ctxpsdb->groups,
                array(
                    'group_title'=>$name,
                    'group_description'=>$description,
                    'group_site_access'=>$site_access),
                array(
                    'ID'=>$group_id
        ));
    }

    /**
     * Checks this page/post's metadata to see if it's protected. Returns true if
     * protected false if not.
     *
     * @param mixed $content_id The id (post, term) or slug (archive) of the content to check (leave empty if checking post within the_loop)
     * @param string $content_type Optional. Must specify with $content_id if checking non-post protection. (ie: post, term, archive)
     *
     * @return bool Whether this page has the "protected page" flag
     */
    public static function check_protection($content_id=null,$content_type='post'){
        global $post;

        switch($content_type){
            case 'post':
                //If $post_id isnt set, try to set with current global post id
                if(empty($content_id) && isset($post->ID)){ $content_id=$post->ID; }

                //Validate: Fail if the post id isn't numeric at this point
                if(!is_numeric($content_id)){ return false; }

                //Return the metadata
                return (bool)get_post_meta($content_id,'ctx_ps_security');
                break;


            case 'term':
                //Validate: Fail if the post id isn't numeric at this point
                if(!is_numeric($content_id)){ return false; }

                //Return the metadata
                return (bool)get_metadata('term',$content_id,'ctx_ps_security');

                break;

            case 'archive':
                /* Don't know how this will be handled yet as archives have no numeric ids
                 * Maybe create a "blank" entry in the grel table?
                 */
                break;

            default:
                return false;
                break;
        }
    }


    /**
     * Reformats group arrays to be more easily worked with in certain cases.
     *
     * @param array $group_array The group array to reformat.
     * @param string $type The type of array you want back (default is 'names')
     * @param string $id Which table column do you want to use as the array key?
     * @return array The new array.
     */
    public static function process_group_array($group_array,$type='names',$id='ID'){
        $temp_array = array();

        switch($type){

            case 'names':
                foreach($group_array as $group){
                    $temp_array[$group->$id] = $group->group_title;
                }
                break;

            case 'full':
                foreach($group_array as $group){
                    $temp_array[$group->$id] = $group;
                }
                break;

            default:
                return false;
                break;

        }
        return $temp_array;
    }

}
}
?>