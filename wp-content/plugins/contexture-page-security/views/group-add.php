    <div class="wrap">
        <div class="icon32" id="icon-users"><br/></div>
        <h2>Add New Group</h2>
        <form id="addgroup" name="addgroup" class="validate" method="post" action="?page=ps_groups">
            <?php wp_nonce_field('add-group'); ?>
            <input id="action" name="action" type="hidden" value="addgroup" />
            <table class="form-table">
                <tr class="form-field form-required">
                    <th scope="row">
                        <label for="group_name">
                            <?php _e('Group Name <span class="description">(required)</span>','contexture-page-security'); ?>
                        </label>
                    </th>
                    <td>
                        <input id="group_name" name="group_name" type="text" aria-required="true" class="regular-text" value="" maxlength="30" />
                    </td>
                </tr>
                <tr class="form-field">
                    <th scope="row">
                        <label for="group_description">
                            <?php _e('Description','contexture-page-security'); ?>
                        </label>
                    </th>
                    <td>
                        <input id="group_description" name="group_description" type="text" aria-required="false" class="regular-text" value="" maxlength="400" />
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input id="addgroupsub" name="addgroupsub" class="button-primary" type="submit" value="Add Group" onclick="return validateForm(jQuery(this).parents('#addgroup'));"/>
            </p>
        </form>
    </div>