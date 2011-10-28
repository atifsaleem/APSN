    <style type="text/css">
        #grouptable {

        }
        #grouptable tbody tr:hover td {
            background:#fffce0;
        }

        #grouptable .id {width:30px;}
        #grouptable .name {width:200px;}
        #grouptable .description {}
        #grouptable .user-count {width:60px;}

        #grouptable tbody .name a {}

    </style>
    <script type="text/javascript">
        /**/
    </script>
    <div class="wrap">
        <div class="icon32" id="icon-users"><br/></div>
        <h2><?php _e('Groups','contexture-page-security'); ?> <?php if (current_user_can('edit_users')){ ?><a href="<?php echo admin_url(); ?>users.php?page=ps_groups_add" class="button add-new-h2"><?php _e('Add New'); ?></a><?php } ?></h2>
        <?php echo $creategroup_message; ?>
        <p></p>
        <table id="grouptable" class="widefat fixed" cellspacing="0">
            <thead>
                <tr class="thead">
                    <th class="id">id</th>
                    <th class="name">Name</th>
                    <th class="description">Description</th>
                    <th class="user-count">Users</th>
                </tr>
            </thead>
            <tfoot>
                <tr class="thead">
                    <th class="id">id</th>
                    <th class="name">Name</th>
                    <th class="description">Description</th>
                    <th class="user-count">Users</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                    if(CTXPS_Queries::count_groups() == 0){
                        echo CTXPS_Components::render_group_list();
                        echo sprintf( '<td colspan="4">'.__('You have not created any groups. Please <a href="%s">add a group</a>.','contexture-page-security').'</td>',admin_url('users.php?page=ps_groups_add') );
                    } else {
                        echo CTXPS_Components::render_group_list();
                }
                ?>
            </tbody>
        </table>
    </div>
<?php

?>
