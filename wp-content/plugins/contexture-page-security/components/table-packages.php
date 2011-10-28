<?php
if(!class_exists('CTXPS_Table_Packages')){
/**
 * This class can be instantiated to automatically build table views. All package methods
 * should be prefixed with package_ to distinguish the packages from core methods.
 */
class CTXPS_Table_Packages extends CTX_Tables{

    /**
     * CONFIG PACKAGE for Associated Content
     */
    public function package_associated_content(){
        $this->table_conf = array(
            'form_id'       =>'assoc_content_form', //id value for the form (css-friendly id)
            'form_method'   =>'get',   //how to submit the form get/post
            'list_id'       =>'pagetable',  //id value for the table (css-friendly id)
            'record_slug'   =>'assoc_cont_rec',//css-class-friendly slug for uniquely referring to records
            'bulk'          =>'false',       //set to true to include checkboxes (if false, bulk options will be disabled)
            'no_records'    =>__('No content is attached to this group.','contexture-page-security') //HTML to show if no records are provided
        );
        $this->bulk_conf = array();

        // Indexed array. Each entry is an assoc array. All values required.
        $this->column_conf = array(
            /**
             * title: The visible title of the column
             * slug: The common slug to use in css classes etc
             * class: Any additional classes you want to add
             * width: Leave empty for auto. Specify a css width value to force
             */
            array(
                'title' =>__('Title','contexture-page-security'),
                'slug'  =>'title',
                'class' =>'col-first',
                'width' =>''
            ),
            array(
                'title' =>'',
                'slug'  =>'protected',
                'class' =>'',
                'width' =>'50px'
            ),
            array(
                'title' =>__('Type','contexture-page-security'),
                'slug'  =>'type',
                'class' =>'col-last',
                'width' =>'100px'
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
                'title' =>__('Edit','contexture-page-security'),
                'tip'   =>__('Edit this content.','contexture-page-security'),
                'slug'  =>'edit',
                'color' =>''
            ),
            array(
                'title' =>__('Remove','contexture-page-security'),
                'tip'   =>__('Detach this group from the content.','contexture-page-security'),
                'slug'  =>'trash',
                'color' =>'red'
            ),
            array(
                'title' =>__('View','contexture-page-security'),
                'tip'   =>__('View this content on the website.','contexture-page-security'),
                'slug'  =>'view',
                'color' =>''
                )
        );

        //****** GET & SHOW TERMS **************************************************
        $termlist = CTXPS_Queries::get_content_by_group($_GET['groupid'],'term');

        //wp_die('<pre>'.print_r($termlist,true).'</pre>');

        foreach($termlist as $term){

            $archiveurl = get_term_link(get_term($term->term_id, $term->taxonomy));

            $term_edit_url = admin_url('edit-tags.php?action=edit&taxonomy='.$term->taxonomy.'&tag_ID='.$term->term_id);
            $this->list_data[] = array(
                'id'=>$term->sec_protect_id,
                'columns'=>array(
                    'title'     => sprintf('<strong><a href="%s">%s</a></strong>',$term_edit_url,$term->name),
                    'protected' => '',
                    'type'      => 'term'
                ),
                'actions'=>array(
                    'edit'  => $term_edit_url,
                    'trash' => array('onclick'=>sprintf('CTXPS_Ajax.removeTermFromGroup(%1$s,jQuery(this));return false;',$term->sec_protect_id)),
                    'view'  => (!is_wp_error($archiveurl)) ? $archiveurl : ''
                )
            );
        }unset($termlist,$term);

        //****** GET & SHOW POSTS *************************************************
        $pagelist = CTXPS_Queries::get_content_by_group($_GET['groupid'],'post');
        foreach($pagelist as $page){
            $page_title = $page->post_title;
            $this->list_data[] = array(
                'id'=>$page->sec_protect_id,
                'columns'=>array(
                    'title'     => sprintf('<strong><a href="%s">%s</a></strong>',admin_url('post.php?post='.$page->sec_protect_id.'&action=edit'),$page_title),
                    'protected' => '',
                    'type'      => $page->post_type
                ),
                'actions'=>array(
                    'edit'  => admin_url('post.php?post='.$page->sec_protect_id.'&action=edit'),
                    'trash' => array('onclick'=>sprintf('CTXPS_Ajax.removePageFromGroup(%1$s,jQuery(this));return false;',$page->sec_protect_id)),
                    'view'  => get_permalink($page->ID)
                )
            );
        }unset($pagelist,$page);

    }

    /**
     * CONFIG PACKAGE for groups attached to taxonomy terms
     */
    public function package_taxonomy_term_groups(){

        $this->table_conf = array(
            'form_id'=>     '',                 //id value for the form (css-friendly id)
            'form_method'=> '',              //how to submit the form get/post
            'list_id'=>     'ctxps-relationships',        //id value for the table (css-friendly id)
            'record_slug'=> 'term_group_rec',   //css-class-friendly slug for uniquely referring to records
            'bulk'=>        'false',            //set to true to include checkboxes (if false, bulk options will be disabled)
            'no_records'=>  __('No groups have been added yet.','contexture-page-security'), //HTML to show if no records are provided
            'actions_col'=> 'name'              //Which column do actions go in?
        );
        $this->bulk_conf = array();

        // Indexed array. Each entry is an assoc array. All values required.
        $this->column_conf = array(
            /**
             * title: The visible title of the column
             * slug: The common slug to use in css classes etc
             * class: Any additional classes you want to add
             * width: Leave empty for auto. Specify a css width value to force
             */
            array(
                'title'=>'id',
                'slug'=>'id',
                'class'=>'col-first',
                'width'=>'30px'
            ),
            array(
                'title'=>__('Name','contexture-page-security'),
                'slug'=>'name',
                'class'=>'',
                'width'=>'300px'
            ),
            array(
                'title'=>__('Description','contexture-page-security'),
                'slug'=>'description',
                'class'=>'',
                'width'=>''
            ),
            array(
                'title'=>__('Users','contexture-page-security'),
                'slug'=>'users',
                'class'=>'col-last',
                'width'=>'60px'
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
                'title'=>__('Edit','contexture-page-security'),
                'tip'=>__('Edit this content.','contexture-page-security'),
                'slug'=>'edit',
                'color'=>''
            ),
            array(
                'title'=>__('Remove','contexture-page-security'),
                'tip'=>__('Detach this group from the content.','contexture-page-security'),
                'slug'=>'trash',
                'color'=>'red'
            )
        );

        //Try to get a tag id (can be called different things in different places)
        $term_id = 0;
        if(isset($_REQUEST['tag_ID'])){ $term_id=$_REQUEST['tag_ID']; }
        else if (isset($_REQUEST['content_id'])){ $term_id=$_REQUEST['content_id']; }
        else if (isset($_REQUEST['object_id'])){ $term_id=$_REQUEST['object_id']; }

        //Get a list of all the groups attached to this term
        $list = CTXPS_Queries::get_groups_by_object('term', $term_id);

        foreach($list as $record){
            //Get edit URL
            $edit_url = admin_url("users.php?page=ps_groups_edit&groupid={$record->ID}");
            //Build records
            $this->list_data[] = array(
                //Give this row an id
                'id'=>$record->ID,
                //Define column data
                'columns'=>array(
                    'id'=>$record->ID,
                    'name'=>sprintf('<strong><a href="%s">%s</a></strong>',$edit_url,$record->group_title),
                    'description'=>$record->group_description,
                    'users'=>CTXPS_Queries::count_members($record->ID)
                ),
                //Define available actions
                'actions'=>array(
                    'edit'=>$edit_url,
                    'trash'=>array('onclick'=>'CTXPS_Ajax.removeGroupFromTerm('.$record->ID.',jQuery(this))')
                )
            );//End array add

        }//End foreach

    }

}}
?>