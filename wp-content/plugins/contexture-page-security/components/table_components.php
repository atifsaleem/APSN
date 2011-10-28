<?php
if(!class_exists('CTX_Tables')){
/**
 * STATIC. Contains methods for generating WP-style table lists.
 *
 * Usage:
 * Create a "packages" class that extends this one. In that class, create public
 * methods that start with the name "package_". You may want to copy the package_demo
 * class from here and use that as a template for your own
 *
 * If you're a developer reading this. Yes, you can steal this class wholesale. It should
 * be very portable. Take a look in table-packages.php too, as it shows this class being
 * used in a practical application.
 *
 * TODO: Add pagination support.
 */
class CTX_Tables {

    /** Assoc array.
     * Default list-table configuration settings.
     * @var array
     * @var 'form_id' : The id to be used in <form>
     * @var 'form_method' : Whether to use 'get' or 'post' in the form
     * @var 'list_id' : The id to use in the table's <tbody>
     * @var 'record_slug' : Used for generating table row classes
     * @var 'bulk' : true will show bulk options (if any are set). False will hide them.
     * @var 'no_records' : The text/html to render out if the query returns no records
     * @var 'actions_col' : The 0-index (int) or name (string) of the column to place the actions in
     */
    public $table_conf      = array();
    /** Index array => Assoc arrays.
     * An array of column options. Each indexed array represents another column to be displayed.
     * Each associative array must have the following values...
     * @var array
     * @var 'title' : The title to display in the thead and tfoot
     * @var 'slug' : Slug to use for css class of columns
     * @var 'class' : Additional css classes to add to columns (ie: col-first or col-last)
     * @var 'width' : Optional css value for width. Leave blank for auto.
     */
    public $column_conf     = array();
    /** Index array => Assoc arrays.
     * An array of action options. Each indexed array represents another row-action to be displayed.
     * Each associative array must have the following values...
     * @var array
     * @var 'title' : The text to display for the action
     * @var 'tip' : Tooltip renders into the link's title attribute
     * @var 'slug' : Slug to render into css
     * @var 'color' : Optional css value for text color. Leave blank for auto.
     */
    public $actions_conf    = array();
    /**
     * Assoc array. Allows configuration of bulk actions. If empty, bulk actions will be
     * hidden and no checkboxes will be rendered.
     * @var array
     * @var KEY : Visible bulk action text. ie: "Delete"
     * @var VALUE : Slug-value to be passed in querystring. Use $_GET['action'] to get value. ie: "delete"
     */
    public $bulk_conf       = array();
    /**
     * An array of configuration packages we've included in this class.
     * @var array
     */
    private $lists          = array('demo');
    /**
     * Store final, processed query data here. This is passed directly to $this->create
     * @var array
     */
    public $list_data       = array();
    /**
     * If true, output will only include list-table content (useful for ajax)
     * @var boolean
     */
    public $content_only    = false;

    /**
     * Stores the completed list table
     * @var string
     */
    public $rendered_table      = '';

    /**
     * Routes request to correct configuration package then runs the create function
     * @param string $list The name of the list to generate (if using packaged ;ist table)
     */
    public function __construct($list='demo',$echo=true,$content_only=false){

        //STORE VALUE IN PROPERTY
        $this->content_only = $content_only;

        //USE EXISTING PACKAGE, IF EXISTS....
        if( method_exists($this,sprintf('package_%s',$list)) ){
            eval(sprintf('$this->package_%s();',$list));

        //PACKAGE NOT FOUND, TRY LOADING VIA HOOK...
        }else{
            do_action('ctx_list_table_prepare-'.$list,$this);
        }

        //RENDER THE TABLE...
        $this->render($echo);
    }

    /**
     * If class is called like a string ($echo is false), be sure to return a string.
     *
     * @return string The rendered table as a string
     */
    public function __toString() {
        return $this->rendered_table;
    }

    /** Immediately renders/echos the table in it's current state. */
    public function render($echo=true){
        $this->rendered_table = $this->create($this->table_conf, $this->column_conf, $this->actions_conf, $this->bulk_conf, $this->list_data, $this->content_only);

        //ECHO IF SET
        if($echo){ echo $this->rendered_table; }
    }

    /** Procedural setter for $this->table_conf */
    public function set_table_conf($array){
        $this->table_conf = $array;
    }
    /** Procedural setter for $this->column_conf */
    public function set_column_conf($array){
        $this->column_conf = $array;
    }
    /** Procedural setter for $this->actions_conf */
    public function set_actions_conf($array){
        $this->actions_conf = $array;
    }
    /** Procedural setter for $this->bulk_conf */
    public function set_bulk_conf($array){
        $this->bulk_conf = $array;
    }
    /** Procedural setter for $this->list_data */
    public function set_list_data($array){
        $this->list_data = $array;
    }

    /**
     * Returns an associative array compatible with a single entry in the self::create()'s $records array.
     * Use $records[] = prepare_row(); to append returned record to your $records array for use in list_table.
     *
     * Note: Be sure that the column and action slugs correspond to the configs you will use in self::create()
     *
     * @param string $id A unique id that corresponds to the db id.
     * @param array $columns An associative array of $col['slug']=>$display_html
     * @param array $actions An associative array of $acts['slug']=>$link_url
     * @return array Returns a self::create($records) compatible array entry.
     */
    public static function prepare_row($id,$columns,$actions=null){
        //Check for errors
        if(empty($id)) trigger_error (__('Parameter $id must be set to a unique record id or guid.','contexture-page-security'), E_USER_WARNING);
        if(!is_array($columns)) trigger_error (__('Parameter $columns is not an array.','contexture-page-security'), E_USER_WARNING);
        if(!is_array($columns) && !empty($columns)) trigger_error (__('Parameter $actions is not an array or empty value.','contexture-page-security'), E_USER_WARNING);
        //Build the array
        $row_array = array();
        $row_array['id'] = $id;
        $row_array['columns'] = $columns;
        $row_array['actions'] = $actions;
        return $row_array;
    }

    /**
     * Can be used to generate WP-style list tables
     *
     * @param type $tableinfo
     * @param type $columninfo
     * @param type $rowinfo
     * @param type $demo If true, a demo table will be generated, regardless of settings
     */
    public static function create($table_conf=array(),$column_conf=array(),$action_conf=array(),$bulk_conf=array(),$records=array(),$content_only=false){

        /** Stores output HTML */
        $html ='';
        /** Stores html for the table */
        $table='';
        /** Whether or not to use bulk actions and checkboxes */
        $usebulk=true;
        /** Stores count information for columns */
        $column_count=0;
        /** Stores count information for records */
        $record_count=0;
        /** Stores count info for actions */
        $action_count=0;
        /** The page this form is currently on */
        $current_page=(!empty($_GET['page'])) ? $_GET['page'] : '';

        /****** USE DEFAULT ARRAYS ********************************************
        if($demo===true){
            $table_conf = $demo_tableopts;
            $column_conf = $demo_columns;
            $action_conf = $demo_actions;
            $bulk_conf = $demo_bulk;
            $records = $demo_records;

        /****** USE CUSTOM ARRAYS **********************************************
        }else{
            $table_conf = array_merge($demo_tableopts, $table_conf);
        }
        ***/

        /****** SHOW ERROR OUTPUT IF CONFIG IS WRONG **************************/
        //Check whether or not we can show valid bulk options
        $usebulk = (count($bulk_conf)>0 && strtolower($table_conf['bulk'])==='true');
        //Lets get a count of columns and records
        $column_count = ($usebulk) ? count($column_conf)+1 : count($column_conf);
        $record_count = count($records);
        $action_count = count($action_conf);

        //TODO: Run checks to ensure array formatting is correct and required data is available. Output error message if any test fails.

        if ($column_count===0) return __('<h3>Can\'t Render Table!</h3><p>Either your package could not be loaded or there is a problem with your columns array. See the demo package in CTX_Table for an example configuration.</p>','contexture-page-security');

        /****** BULK OPTIONS **************************************************/

        if($usebulk){
            //Must have items in bulk array AND must have use checkboxes option set to true

            //Build start of bulk settings at top of $html
            $html .= '
    <div class="tablenav top">
        <div class="alignleft actions">
            <input type="hidden" name="page" value="'.$current_page.'" />
            <select name="action">
                <option value="-1" selected="selected">'.__('Bulk Actions','contexture-page-security').'</option>';

            //Build custom bulk options
            foreach($bulk_conf as $bulk_key=>$bulk_value){
                $html .= sprintf('<option value="%1$s">%2$s</option>',$bulk_value,$bulk_key);
            }
            //Toss these variables, we don't need them any more
            unset ($bulk_key,$bulk_value);

            //Build end of bulk settings html
            $html .= '
            </select>
            <input type="submit" id="'.$table_conf['form_id'].'-doaction" class="button-secondary action" value="Apply" />
        </div>
        <br class="clear"/>
    </div>';
        }


        /****** BUILD RECORDS *************************************************/
        if($record_count===0){ //If there are no records to show, use no_records message

            $table = sprintf('<tr><td colspan="%s">'.$table_conf['no_records'].'</td></tr>',$column_count);

        } else { //We got some records, so lets build those rows!

            $alt=true;
            //***************** ROWS ********************
            foreach($records as $record){
                //SET $ROWHTML. Do we need to show a checkbox for this row?
                $rowhtml = ($usebulk) ? sprintf('<th scope="row" class="check-column"><input type="checkbox" name="%1$s[]" value="%2$s" /></th>',$table_conf['record_slug'],$record['id']) : '';
                //We need to count iterations
                $count_cols = 0;
                //***************** COLUMNS ********************
                foreach($column_conf as $column){
                    //Main column content
                    $colhtml = '<div>'.$record['columns'][$column['slug']].'</div>';

                    //***************** ACTIONS ********************
                    if(
                        //If this is the column specified for the actions (by index or slug name), show actions here
                        ( isset($table_conf['actions_col']) && ( $count_cols===$table_conf['actions_col'] || $column['slug']===$table_conf['actions_col'] ) )
                        //Or if there is no override and this is the first column, show actions
                        || ( empty($table_conf['actions_col']) && $count_cols===0 )
                    ){

                        if(count($action_conf)>0){ //If actions are defined

                            $colhtml .= '<div class="row-actions" style="white-space:nowrap">';
                            $count_acts = 0;
                            foreach($action_conf as $action){
                                ++$count_acts;
                                //Determine if we need to add attributes other than href (such as onclick)
                                if(is_array($record['actions'][$action['slug']])){
                                    $actatts='';
                                    foreach($record['actions'][$action['slug']] as $attkey=>$attval){
                                        $actatts .= sprintf('%s="%s" ',$attkey,$attval);
                                    }
                                }else{
                                    //Not an array, use as href value
                                    $actatts = sprintf('href="%s"',$record['actions'][$action['slug']]);
                                }
                                //Build the action
                                $colhtml .= sprintf('<span class="il-action %1$s"><a %3$s title="%4$s">%2$s</a></span>',
                                        /*1*/$action['slug'],
                                        /*2*/$action['title'],
                                        /*3*/$actatts,
                                        /*4*/$action['tip']
                                );
                                if($count_acts!==$action_count){
                                    $colhtml .= ' | ';
                                }
                            }
                            $colhtml .= '</div>'; //Close out .row-actions
                        }

                    } //**************** End actions ****************
                    ++$count_cols;

                    //Wrap cell content in a <td>
                    $rowhtml .= sprintf('<td class="%1$s column-%1$s">%2$s</td>',$column['slug'],$colhtml);
                } //**************** End columns ****************

                //Wrap the $rowhtml content in a <tr>
                $table .= sprintf(' <tr id="%1$s-%2$s" class="%4$s">%3$s</tr>',
                    /*1*/$table_conf['record_slug'],
                    /*2*/$record['id'],
                    /*3*/$rowhtml,
                    /*4*/($alt) ? 'alternate' : '');

                //Reverse the alt value
                !$alt;

            }
            //Lets toss all these throw-away loop variables
            unset($record,$alt,$column,$count_cols,$count_acts,$action,$rowhtml,$colhtml);
        }

        //Wrap the rows in tbody
        $table = sprintf('<tbody id="the-list-%1$s" class="list:%1$s">%2$s</tbody>',$table_conf['list_id'],$table);

        if($content_only){
            return $table;
        }

        /****** BUILD THEAD & TFOOT *******************************************/
        $column_heads='';
        foreach($column_conf as $th_column){
            $column_heads .= sprintf('<th scope="col" id="%1$s" class="manage-column column-%1$s %4$s" %2$s>%3$s</th>',
                    /*1*/$th_column['slug'],
                    /*2*/(!empty($th_column['width'])) ? sprintf(' style="width:%s"',$th_column['width']) : '',
                    /*3*/$th_column['title'],
                    /*4*/$th_column['class']
            );
        }
        $table .= '<thead><tr>';
        $table .= ($usebulk) ? '<th scope="col" id="cb" class="manage-column column-cb check-column"><input type="checkbox"/></th>' : '';
        $table .= $column_heads;
        $table .= '</tr></thead>';
        $table .= '<tfoot><tr>';
        $table .= ($usebulk) ? '<th scope="col" class="manage-column column-cb check-column"><input type="checkbox"/></th>' : '';
        $table .= $column_heads;
        $table .= '</tr></tfoot>';
        unset($column_heads,$th_column);


        /****** MERGE TABLE WITH HTML *****************************************/
        $html = sprintf('%1$s<table class="wp-list-table widefat fixed %2$s" cellspacing="0">%3$s</table>',
                /*1*/$html,
                /*2*/$table_conf['list_id'],
                /*3*/$table);


        /****** RETURN FORM & TABLE *******************************************/
        if( empty($table_conf['form_id']) || empty($table_conf['form_method'])){
            return $html;
        }

        return sprintf('<form id="%1$s" action="" method="%2$s">%3$s</form>',
            /*1*/$table_conf['form_id'],
            /*2*/$table_conf['form_method'],
            /*3*/$html);
    }

    /**
     * Default demo package. usually, packages are places in a separate, inherrited class.
     */
    public function package_demo(){

        $this->table_conf = array(
            'form_id'=>'new_table', //id value for the form (css-friendly id)
            'form_method'=>'get',   //how to submit the form get/post
            'list_id'=>'new-list',  //id value for the table (css-friendly id)
            'record_slug'=>'record',//css-class-friendly slug for uniquely referring to records
            'bulk'=>'true',         //set to true to include checkboxes (if false, bulk options will be disabled)
            'no_records'=>__('There are no records to show... yet!','contexture-page-security'), //HTML to show if no records are provided
            'actions_col'=>0        //Set the column where actions will appear. Takes an int (zero-index) or string (column slug)
        );
        $this->bulk_conf = array(
            'Delete'=>'delete',
            'Duplicate'=>'duplicate'
        );

        // Indexed array. Each entry is an assoc array. All values required.
        $this->column_conf = array(
            /**
             * title: The visible title of the column
             * slug: The common slug to use in css classes etc
             * class: Any additional classes you want to add
             * width: Leave empty for auto. Specify a css width value to force
             */
            array(
                'title'=>'Column 1',
                'slug'=>'col1',
                'class'=>'col-first',
                'width'=>'200px'
            ),
            array(
                'title'=>'Column 2',
                'slug'=>'col2',
                'class'=>'',
                'width'=>''
            ),
            array(
                'title'=>'Column 3',
                'slug'=>'col3',
                'class'=>'col-last',
                'width'=>''
            )
        );

        // Indexed array. Each entry is an associative array. All values required.
        $this->actions_conf = array(
            /**
             * title: The visible text for the action
             * slug: The slug to be used in css classes and querystring requests
             * color: Set to any css color value to override default color
             */
            array(
                'title'=>'View',
                'tip'=>'',
                'slug'=>'view',
                'color'=>''
            ),
            array(
                'title'=>'Edit',
                'tip'=>'',
                'slug'=>'edit',
                'color'=>''
            ),
            array(
                'title'=>'Delete',
                'tip'=>'',
                'slug'=>'delete',
                'color'=>'red'
                )
        );
        // Indexed array. Each entry is an associative array. All values required.
        $this->list_data = array(
            array(
                /** Association, must assign record a unique id (usually from db) */
                'id'=>'1',
                /**
                 * Associate array. Each key MUST correspond to a column slug. Value can be any HTML.
                 */
                'columns'=>array(
                    'col1'=>'<strong><a href="#a">Hello world!</a></strong>',
                    'col2'=>'testing',
                    'col3'=>'first row'
                ),
                /**
                 * Associative array. Each key MUST correspond to an action slug. If value is a string,
                 * it will be automatically turned into an href value. If value is an array, it will be
                 * parsed into link attributes (useful for adding ajax).
                 */
                'actions'=>array(
                    'view'=>'/wp-admin/post.php?post=1&action=edit',
                    'edit'=>'/wp-admin/edit.php',
                    'delete'=>array('onclick'=>'delete(this);return false;','href'=>'#')
                )
            ),
            array(
                'id'=>'2',
                'columns'=>array(
                    'col1'=>'Hello world 2!',
                    'col2'=>'testing 2',
                    'col3'=>'middle row'
                ),
                'actions'=>array(
                    'view'=>'/wp-admin/post.php?post=1&action=edit',
                    'edit'=>'/wp-admin/edit.php',
                    'delete'=>array('onclick'=>'delete(this);return false;','href'=>'#')
                )
            ),
            array(
                'id'=>'3',
                'columns'=>array(
                    'col1'=>'<a href="#a">Hello world 3!</a>',
                    'col2'=>'testing 3',
                    'col3'=>'last row'
                ),
                'actions'=>array(
                    'view'=>'/wp-admin/post.php?post=1&action=edit',
                    'edit'=>'/wp-admin/edit.php',
                    'delete'=>array('onclick'=>'delete(this);return false;','href'=>'#')
                )
            )
        );

    }

}}
?>