<div class="wrap">
    <table id="ctx-ps-opts-container" cellpadding="0" cellspacing="0" style="">
        <tr>
            <td id="ctx-ps-opts-form" style="padding:0 !important;">
                <div class="">
                    <div class="icon32" id="icon-users" style="padding-top:0;margin-top:0;"><br/></div>
                    <h2 style="padding-top:0;margin-top:-8px;">Page Security Options</h2>
                    <?php echo $updatesettingsMessage,$InvADPagesMsg;/*print_r($ADMsg)*/ ?>
                    <p></p>
                    <form method="post" action="">

                        <!-- ACCESS DENIED CONFIG -->
                        <input type="hidden" name="action" id="action" value="updateopts" />
                        <h3 class="title"><?php _e('Access Denied Messages','contexture-page-security') ?></h3>
                        <p><?php _e('Use these settings to determine what your users will see when accessing content they are not allowed to view.','contexture-page-security') ?></p>
                        <table class="form-table">

                            <!-- USE PAGES INSTEAD OF MESSAGES -->
                            <tr valign="top" class="toggle-opts-ad">
                                <th scope="row">
                                    <label for="ad-msg-enable"> <?php _e('Use Custom Pages:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="ad-msg-enable" id="ad-msg-enable" <?php echo ($ADMsg['ad_msg_usepages']=='true') ? 'checked="checked"' : ''; ?> /> <?php _e('Use <strong>pages</strong> for default access denied screens','contexture-page-security') ?>
                                    </label>
                                </td>
                            </tr>

                            <!-- AD PAGE AUTHENTICATED SELECT -->
                            <tr valign="top" class="toggle-opts-ad-page" style="<?php echo ($ADMsg['ad_msg_usepages']==='true') ? 'display:table-row;' : ''; ?>">
                                <th scope="row">
                                    <label for="ad-page-auth"><?php _e('Authenticated Users:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <!-- NOTE: Should show only pages marked as "Use as Access Denied" -->
                                    <?php echo $pageDDLAuth; ?> <br/>
                                    <div class="ctx-footnote"><?php _e('The "access denied" page to show users who <strong><em>are logged in</em></strong>.','contexture-page-security') ?></div>
                                </td>
                            </tr>

                            <!-- AD PAGE ANONYMOUS SELECT -->
                            <tr valign="top" class="toggle-opts-ad-page ad-opt-anon" style="<?php echo ($ADMsg['ad_msg_usepages']==='true' && $ADMsg['ad_opt_login_anon']!=='true') ? 'display:table-row;' : ''; ?>">
                                <th scope="row">
                                    <label for="ad-page-anon"><?php _e('Anonymous Users:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <!-- NOTE: Should show only pages marked as "Use as Access Denied" -->
                                    <?php echo $pageDDLAnon; ?><br/>
                                    <div class="ctx-footnote"><?php _e('The "access denied" page to show users who are <strong><em>not</em></strong> logged in.','contexture-page-security') ?></div>
                                </td>
                            </tr>

                            <!-- PROTECTION METHOD -->
                            <tr valign="top" class="toggle-opts-ad-page" style="<?php echo ($ADMsg['ad_msg_usepages']==='true') ? 'display:table-row;' : ''; ?>">
                                <th scope="row">
                                    <label><?php _e('Protection Type:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="radio" name="ad-page-replace" id="ad-page-replace" value="redirect" <?php echo ($ADMsg['ad_opt_page_replace']!=='true') ? 'checked="checked"' : ''; ?> /> <?php _e('Redirect','contexture-page-security') ?>
                                    </label>
                                    <label style="margin-left:15px;">
                                        <input type="radio" name="ad-page-replace" id="ad-page-replace" value="replace" <?php echo ($ADMsg['ad_opt_page_replace']==='true') ? 'checked="checked"' : ''; ?> /> <?php _e('Replace','contexture-page-security') ?>
                                    </label><br/>
                                    <div class="ctx-footnote"><?php _e('This dictates <strong>how</strong> users are shown the Access Denied page. They can either be redirected to a different page, or the content of the restricted page can be replaced.','contexture-page-security') ?></span>
                                </td>
                            </tr>

                            <!-- MESSAGE AUTHENTICATED -->
                            <tr valign="top" class="toggle-opts-ad-msg" style="<?php echo ($ADMsg['ad_msg_usepages']==='true') ? 'display:none;' : ''; ?>">
                                <th scope="row">
                                    <label for="ad-msg-auth"><?php _e('Authenticated Users:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <input type="text" name="ad-msg-auth" id="ad-msg-auth" value="<?php echo esc_attr($ADMsg['ad_msg_auth']); ?>" /><br/>
                                    <div class="ctx-footnote"><?php _e('The "access denied" message to show users who are logged in (HTML OK).','contexture-page-security') ?></div>
                                </td>
                            </tr>

                            <!-- MESSAGE ANONYMOUS -->
                            <tr valign="top" class="toggle-opts-ad-msg ad-opt-anon" style="<?php echo ($ADMsg['ad_msg_usepages']==='true' || $ADMsg['ad_opt_login_anon']==='true') ? 'display:none;' : ''; ?>">
                                <th scope="row">
                                    <label for="ad-msg-anon"><?php _e('Anonymous Users:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <input type="text" name="ad-msg-anon" id="ad-msg-anon" value="<?php echo esc_attr($ADMsg['ad_msg_anon']); ?>" title="<?php _e('Use the %login_url% token to dynamically generate a login URL.','contexture-page-security') ?>" /><br/>
                                    <div class="ctx-footnote"><?php _e('The "access denied" message to show users who are <strong><em>not</em></strong> logged in (HTML OK).','contexture-page-security') ?></div>
                                </td>
                            </tr>

                            <!-- LOGIN REDIRECT -->
                            <tr valign="top">
                                <th scope="row">
                                    <label for="ad-msg-forcelogin"><?php _e('Force Login:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="ad-msg-forcelogin" id="ad-msg-forcelogin" <?php echo ($ADMsg['ad_opt_login_anon']==='true') ? 'checked="checked"' : ''; ?> /> <?php _e('Send anonymous users to login screen','contexture-page-security'); ?><br/>
                                        <div class="ctx-footnote"><?php _e('If an anonymous user tries to access restricted content, send them to the login page.<br/>Notice: If enabled, the "Anonymous Users" setting will be ignored.','contexture-page-security') ?></div>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <!-- GLOBAL SECURITY -->
                        <h3 class="title"><?php _e('Global Security Features','contexture-page-security') ?></h3>
                        <p><?php _e('These options selectively enable/disable Page Security features.','contexture-page-security') ?></p>
                        <table class="form-table">

                            <!-- PROTECT ENTIRE SITE -->
                            <tr valign="top">
                                <th scope="row">
                                    <label for="filter-all"><?php _e('Protect Entire Site:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="ad-protect-site" id="ad-protect-site" <?php echo ($ADMsg['ad_opt_protect_site']==='true') ? 'checked="checked"' : ''; ?> /> <?php _e('Protect the entire website','contexture-page-security'); echo $GroupEditLink; ?><br/>
                                        <div class="ctx-footnote"><?php echo sprintf(__('Only registered users will be able to view the site (useful for intranet implementations).<br/>Notice: For maximum security, uncheck the "Anyone can register" option in <a href="%s">Settings &gt; General</a>.','contexture-page-security'), admin_url('options-general.php')) ?></div>
                                    </label>
                                </td>
                            </tr>

                            <!-- MENU FILTERING -->
                            <tr valign="top">
                                <th scope="row">
                                    <label for="filter-menu"><?php _e('Enable Menu Filtering:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="filter-menus" id="filter-menus" <?php echo ($ADMsg['ad_msg_usefilter_menus']!='false') ? 'checked="checked"' : ''; ?> /> <?php _e('Use permissions to filter menu items','contexture-page-security') ?><br/>
                                        <div class="ctx-footnote"><?php _e('Remove restricted content from menus unless user is authenticated.','contexture-page-security') ?></div>
                                    </label>
                                </td>
                            </tr>

                            <!-- RSS FILTERING -->
                            <tr valign="top">
                                <th scope="row">
                                    <label for="filter-rss"><?php _e('Enable RSS Filtering:','contexture-page-security') ?></label>
                                </th>
                                <td>
                                    <label>
                                        <input type="checkbox" name="filter-rss" id="filter-rss" <?php echo ($ADMsg['ad_msg_usefilter_rss']!='false') ? 'checked="checked"' : ''; ?> /> <?php _e('Use permissions to filter RSS content','contexture-page-security') ?><br/>
                                        <div class="ctx-footnote"><?php _e('Remove restricted posts from RSS unless user is authenticated<br/> Warning: This will hide protected content from most RSS readers.','contexture-page-security') ?></div>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes','contexture-page-security') ?>" />
                    </form>
                </div>
            </td>
            <td style="vertical-align:top;">
                <div id="ctx-about">
                    <a class="img-block" href="http://www.contextureintl.com"><img src="<?php echo CTXPSURL.'images/ctx-logo.gif'; ?>" alt="Contexture International" /></a>
                    <p>Contexture International is an all-in-one agency specializing in <a href="http://www.contextureintl.com/portfolio/graphic-design/">graphic design</a>, <a href="http://www.contextureintl.com/portfolio/web-interactive/">web design</a>, and <a href="http://www.contextureintl.com/portfolio/broadcast-video-production/">broadcast and video production</a>, with an unparalleled ability to connect with the heart of your audience.</p>
                    <p>Contexture's staff has successfully promoted organizations and visionaries for more than 2 decades through exceptional storytelling, in just the right contexts for their respective audiences, with overwhelming returns on investment.  See the proof in our <a href="http://www.contextureintl.com/portfolio/">portfolio </a>or learn more <a href="http://www.contextureintl.com/about-us/">about us</a>.</p>
                    <div><a href="http://www.contextureintl.com/offers/">Need a custom web or video project?</a></div>
                    <div><a href="http://www.contextureintl.com/open-source-projects/contexture-page-security-for-wordpress/">Need help with Page Security?</a></div>
                </div>
            </td>
        </tr>
    </table>
</div>