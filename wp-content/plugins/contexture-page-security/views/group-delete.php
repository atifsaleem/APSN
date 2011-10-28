    <div class="wrap">
        <div class="icon32" id="icon-users"><br/></div>
        <h2>Delete Group</h2>
        <?php echo $actionmessage; ?>
        <?php if(!empty($actionmessage2)){ echo $actionmessage2; }else{ ?>
        <?php
            if (empty($groupInfo->group_title)){ //Group doesnt exist error
                echo '<div id="message" class="error below-h2"><p>'.__('A group with that id does not exist.','contexture-page-security').' <a href="'.admin_url().'users.php?page=ps_groups">'.__('View all groups','contexture-page-security').' &gt;&gt;</a></p></div>';
            }else if(isset($groupInfo->group_system_id)){ //Group is a system group error (cannot edit)
                echo '<div id="message" class="error below-h2"><p>'.__('System groups cannot be deleted.','contexture-page-security').' <a href="'.admin_url().'users.php?page=ps_groups">'.__('View all groups','contexture-page-security').' &gt;&gt;</a></p></div>';
            }else{
        ?>
        <form id="deletegroup" name="deletegroup" method="get" action="">
            <input type="hidden" name="page" value="ps_groups_delete"/>
            <input type="hidden" name="groupid" value="<?php echo $_GET['groupid']; ?>" />
            <input type="hidden" name="action" value="delete" />
            <p>You are about to delete the group <strong><?php echo $groupInfo->group_title; ?></strong>.</p>
            <p>Deleting this group will affect <strong><?php echo CTXPS_Queries::count_members($groupInfo->ID); ?></strong> users and <strong><?php echo $groupPageCount; ?></strong> pages/posts. Are you sure you want to continue?</p>
            <?php wp_nonce_field('delete-group'); ?>
            <p class="submit">
                <input class="button-secondary" type="submit" value="<?php _e('Confirm Deletion','contexture-page-security'); ?>" name="submit"/>
            </p>
        </form>
        <?php

            } //ENDS : if (empty($groupInfo->group_title))
        } //ENDS : if (!empty($actionmessage2))... else ...
        ?>
    </div>