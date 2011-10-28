<?php
if(!class_exists('CTXPS_Router')){
/**
 * Methods for handling individual views.
 */
class CTXPS_Router{

    /**
     * Used to route all view requests to the correct controller and view files.
     * This will automatically process the controller and display the view (unless
     * the $auto_load parameter is overriden).
     *
     * @global CTXPSC_Tables $ctxpsdb
     * @global wpdb $wpdb
     * @param string $view The name of the view to load (filename conventions)
     * @param boolean $auto_load If true, a view will be automatically loaded. Set to false if controller will select view.
     * @param array $args Provide an array if you need to pass values to a controller
     */
    public static function render($view,$auto_load=true,$args=array()){
        global $wpdb,$ctxpsdb;
        $controller_path = CTXPSPATH.'/controllers/'.$view.'_controller.php';
        //Load the controller, if it exists
        if (file_exists($controller_path)) require_once $controller_path;
        //Load the view automatically unless overridden (some controllers may need to handle this dynamically)
        if ($auto_load) require_once CTXPSPATH.'/views/'.$view.'.php';
    }

    public static function group_add(){ self::render('group-add'); }
    public static function group_delete(){ self::render('group-delete'); }
    public static function group_edit(){ self::render('group-edit'); }
    public static function groups_list(){ self::render('groups-list'); }
    public static function options(){ self::render('options'); }
    public static function user_groups(){ self::render('user-groups'); }
    public static function sidebar_security(){ self::render('sidebar-security',false); }
    public static function security_posts(){ self::render('sidebar-security',false); }
    public static function security_tax(){ self::render('security-tax'); }
}}

?>