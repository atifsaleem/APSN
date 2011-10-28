<script type="text/javascript" src="<?php echo CTXPSURL.'js/inline-edit-membership'.((CTXPSJSDEV)?'.dev':'').'.js' ?>"></script>
<div class="wrap">
    <div class="icon32" id="icon-users"><br/></div>
    <h2>Editing a Group</h2>
    <?php echo $actionmessage; ?>
    <?php
        if (empty($groupInfo->group_title)){ //Group doesnt exist error
            echo '<div id="message" class="error below-h2"><p>',__('A group with that id does not exist.','contexture-page-security'),' <a href="'.admin_url().'users.php?page=ps_groups">',__('View all groups','contexture-page-security'),' &gt;&gt;</a></p></div>';
        }else if(isset($groupInfo->group_system_id)){ //Group is a system group error (cannot edit)
            echo '<div id="message" class="error below-h2"><p>',__('System groups cannot be edited.','contexture-page-security'),' <a href="'.admin_url().'users.php?page=ps_groups">',__('View all groups','contexture-page-security'),' &gt;&gt;</a></p></div>';
        }else{
    ?>

    <form id="editgroup" name="editgroup" class="validate" method="get" action="">
        <?php _e('<h3>Group Details</h3>'); ?>
        <input id="action" name="page" type="hidden" value="ps_groups_edit" />
        <input id="action" name="action" type="hidden" value="updtgrp" />
        <input id="groupid" name="groupid" type="hidden" value="<?php echo $_GET['groupid']; ?>" />
        <?php wp_nonce_field('edit-group'); ?>
        <table class="form-table">
            <tr class="form-field form-required">
                <th scope="row">
                    <label for="group_name">
                        <?php _e('Group Name <span class="description">(required)</span>','contexture-page-security'); ?>
                    </label>
                </th>
                <td>
                    <input id="group_name" name="group_name" type="text" aria-required="true" class="regular-text" value="<?php echo $groupInfo->group_title; ?>" maxlength="30" /> <span style="color:silver;">id: <?php echo $groupInfo->ID; ?></span>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row">
                    <label for="group_description">
                        <?php _e('Description','contexture-page-security'); ?>
                    </label>
                </th>
                <td>
                    <input id="group_description" name="group_description" type="text" aria-required="false" class="regular-text" value="<?php echo $groupInfo->group_description; ?>" maxlength="400" />
                </td>
            </tr>
            <tr class="form-field" class="site-options" style="<?php echo ($dbopts['ad_opt_protect_site']==='true' && false) ? '' : 'display:none;'; ?>">
                <th scope="row">
                    <label for="group_description">
                        <?php _e('Site Access:','contexture-page-security'); ?>
                    </label>
                </th>
                <td>
                    <label title="<?php _e('This group has no access to the website.','contexture-page-security') ?>" >
                        <input type="radio" name="group_site_access" id="group_site_access_1" value="none" <?php echo ($groupInfo->group_site_access==='none') ? 'checked="checked"' : ''; ?> /> <?php _e('None','contexture-page-security') ?>
                    </label><br/>
                    <label title="<?php _e('This group can access the site. All other security restrictions apply.','contexture-page-security') ?>" > <!--style="margin-left:15px;"-->
                        <input type="radio" name="group_site_access" id="group_site_access_2" value="limited" <?php echo ($groupInfo->group_site_access==='limited') ? 'checked="checked"' : ''; ?> /> <?php _e('Allowed','contexture-page-security') ?>
                    </label><br/><!--
                    <label title="<?php _e('This group can access any and all site content. This overrides any other restrictions.','contexture-page-security') ?>">
                        <input type="radio" name="group_site_access" id="group_site_access_3" value="full"  <?php echo ($groupInfo->group_site_access==='full') ? 'checked="checked"' : ''; ?> /> <?php _e('Unrestricted','contexture-page-security') ?>
                    </label><br/>-->
                    <div class="ctx-footnote"><?php _e('Site protection is enabled. You can choose what level of site access this group is allowed.<br/>Notice: Setting this to &quot;Unrestricted&quot; will give this group access to <em>all</em> site content.','contexture-page-security') ?></span>
                </td>
            </tr>
        </table>
        <p class="submit">
            <input id="savegroupsub" name="savegroupsub" class="button-primary" type="submit" value="Save Changes" onclick="return validateForm(jQuery(this).parents('#addgroup'));"/>
        </p>
    </form>
    <p></p>
    <form id="addgroupmember" name="addgroupmember" method="get" action="">
        <?php _e('<h3>Group Members</h3>','contexture-page-security'); ?>
        <div class="tablenav">
            <input id="action" name="page" type="hidden" value="ps_groups_edit" />
            <input id="action" name="action" type="hidden" value="addusr" />
            <input id="groupid" name="groupid" type="hidden" value="<?php echo $_GET['groupid']; ?>" />
            <input id="add-username" name="add-username" class="regular-text" type="text" value="username" onclick="if(jQuery(this).val()=='username'){jQuery(this).val('')}" onblur="if(jQuery(this).val().replace(' ','')==''){jQuery(this).val('username')}" /> <input type="submit" class="button-secondary action" value="<?php _e('Add User','contexture-page-security'); ?>" onclick="if(jQuery('#add-username').val().replace(' ','') != '' && jQuery('#add-username').val().replace(' ','') != 'username'){return true;}else{ jQuery('#add-username').css({'border-color':'#CC0000','background-color':'pink'});return false; }" />
            <?php wp_nonce_field('ps-add-user','',false); ?>
        </div>
        <table id="grouptable" class="widefat fixed" cellspacing="0">
            <thead>
                <tr class="thead">
                    <th class="username"><?php _e('Username','contexture-page-security') ?></th>
                    <th class="name"><?php _e('Name','contexture-page-security') ?></th>
                    <th class="email"><?php _e('Email','contexture-page-security') ?></th>
                    <th class="expires"><?php _e('Expires','contexture-page-security') ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr class="thead">
                    <th class="username"><?php _e('Username','contexture-page-security') ?></th>
                    <th class="name"><?php _e('Name','contexture-page-security') ?></th>
                    <th class="email"><?php _e('Email','contexture-page-security') ?></th>
                    <th class="expires"><?php _e('Expires','contexture-page-security') ?></th>
                </tr>
            </tfoot>
            <tbody id="users" class="list:user user-list">
                <?php echo CTXPS_Components::render_member_list($_GET['groupid']); ?>
            </tbody>
        </table>
    </form>
    <?php _e('<h3>Associated Content</h3>','contexture-page-security'); ?>
    <?php new CTXPS_Table_Packages('associated_content'); ?>
    <?php } //ENDS : if (empty($groupInfo->group_title)) ?>
</div>