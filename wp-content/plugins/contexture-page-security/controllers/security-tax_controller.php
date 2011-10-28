<?php
global $taxonomy,$tag,$wpdb;

/**
 * TRANSLATABLE OUTPUT STRINGS
 ******************************************************************************/
$txt_h3_restrict = __('Restrict Access','contexture-page-security');
$txt_label_protect = __('Protect Term','contexture-page-security');
$txt_prottext =  __('Protect this term and any content associated with it.','contexture-page-security');
$txt_addgroup = __('Add group...','contexture-page-security');
$txt_subtitle_table = __('Groups With Access','contexture-page-security');


/**
 * LOGIC
 ******************************************************************************/

//Determined if this term is protected
$protected_status = CTXPS_Queries::get_term_protection( $_REQUEST['tag_ID'] );

//Determine how protected status alters display
$echo_protcheck = ($protected_status) ? 'checked="checked"' : '';
$echo_tlist_style = ($protected_status) ? 'display:block;' : '';

//Get list of all groups
$all_groups = CTXPS_Queries::get_groups();

//Start with an empty array for $term_groups
$term_groups = CTXPS_Queries::get_groups_by_object('term', $_REQUEST['tag_ID']);

//Build $term_groups manually so that the array index uses id (to make it easier to sort)
$term_groups_simple = CTXPS_Queries::process_group_array($term_groups,'names');

//Set default option
$ddl_group_opts = sprintf( '<option value="0">%s</option>', $txt_addgroup );

//Loop through all groups in the db to populate the drop-down list
foreach($all_groups as $group){
    //Generate the option HTML, hiding it if it's already in our $currentGroups array
    $ddl_group_opts .= CTX_Helper::gen('option',
        array(
            'class'=>(isset($term_groups_simple[$group->ID])?'detach':''),
            'value'=>$group->ID
        ),$group->group_title
    );
}

//Put all those options into the select box
$selectbox = CTX_Helper::gen('select', array('id'=>'ctxps-grouplist-ddl','name'=>'ctxps-grouplist-ddl'), $ddl_group_opts);

/*
echo '<pre>
$avail::::
';
print_r($avail_groups);
echo '

$term_groups::::
';
print_r($term_groups);
echo '

$all_groups::::
';
print_r($all_groups);
echo '</pre>';
*/
?>