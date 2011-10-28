<h3 id="term-restrict"><?php echo $txt_h3_restrict ?></h3>
<table class="form-table">
    <tr>
        <th scope="row" valign="top"><label for="ctxps-cb-protect"><?php echo $txt_label_protect ?></label></th>
        <td>
            <input name="ctxps-cb-protect" id="ctxps-cb-protect" type="checkbox" <?php echo $echo_protcheck ?>/>
            <label for="ctxps-cb-protect"><?php echo $txt_prottext ?></label>
        </td>
    </tr>
</table>
<p></p>
<div id="ctxps-relationships-list" style="padding-left:7px;<?php echo $echo_tlist_style ?>">
    <!--<h4><?php echo $txt_subtitle_table ?></h4>-->
    <div class="tablenav top">
        <div class="alignleft actions">
            <label class="screen-reader-text" for="ctxps-grouplist-ddl"><?php echo $echo_addgroup ?></label>
            <?php echo $selectbox; ?>
            <input type="button" name="ctxps-grouplist-ddl-btn" id="ctxps-grouplist-ddl-btn" class="button-secondary" value="Add">
        </div>
    </div>
    <?php new CTXPS_Table_Packages('taxonomy_term_groups'); ?>
</div>