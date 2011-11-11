<?php
    if ( !current_user_can('manage_options') ) {
        wp_die( __( 'You do not have sufficient permissions to manage options for this site.','contexture-page-security' ) );
    }

    global $themeDir,
           $hook_suffix;

    $newOpts    = array();
    $message    = '';
    $debugOpts  = '';

    echo "<!-- The hook for the current page is \"";
    print_r( $hook_suffix );
    echo "\" -->\n";

    if(!empty($_POST) && wp_verify_nonce($_POST['_wpnonce'],'aj-options')){

        //Get rid of any leading forward slashes
        $_POST['css-path'] = preg_replace('/^\/+/', '', trim( $_POST['css-path'] ) );
		$_POST['logo-path'] = preg_replace('/^\/+/', '', trim( $_POST['logo-path'] ) );

        //Set new options
        $newOpts['layout']          = $_POST['master-layout'];
        $newOpts['css-path']        = $_POST['css-path'];
        $newOpts['logo-path']       = $_POST['logo-path'];
        $newOpts['title-type']      = $_POST['title-type'];
        $newOpts['paper-type']      = $_POST['paper-type'];
        $newOpts['header-height']   = $_POST['header-height'];
        $newOpts['sidebar-width']   = ( empty($_POST['sidebar-width']) )     ? 220     : $_POST['sidebar-width'];
        $newOpts['featured-header'] = ( isset( $_POST['featured-header'] ) ) ? 'true'  : 'false';
        $newOpts['attrib']          = ( isset( $_POST['attrib'] ) )          ? 'false' : 'true';
        $newOpts['browser-helper']  = ( isset( $_POST['browser-helper'] ) )  ? 'true'  : 'false';

        //Update the options
        ctx_aj_set_options($newOpts);
        //Show success message

        //Build error message
        $message = sprintf(__('<div id="message" class="updated below-h2">
            <p>
                Options updated. <a href="%s" target="_blank">View your site</a> to see how it looks.
            </p>%s
        </div>','adventurejournal'),
                home_url(),
                (isset($_POST['attrib'])) ? __('<p>I see you removed the attribution. Does this mean we\'re not friends any more?</p>','adventurejournal') : ''
        );
    }

    //Load default theme variables
    $AJOpts = get_option('ctx-adventurejournal-options');

    if(!empty($_GET['showopts']) && $_GET['showopts']=='true'){
        $debugOpts = '<hr/><pre>'.print_r($AJOpts,true).'</pre><hr/>';
    }

    ?>
    <script type="text/javascript">
        jQuery(function(){
            jQuery('#show-more').click(function(){
                jQuery(this).hide();
                jQuery('#more-opts').show();
            });
                    jQuery('#title-default').click(function(){
                            jQuery('.custom-logo').hide();
            });
                    jQuery('#title-blank').click(function(){
                            jQuery('.custom-logo').hide();
            });
                    jQuery('#title-logo').click(function(){
                            jQuery('.custom-logo').show();
            });
            jQuery('#admin-layout input:radio').change(function(){
                if(this.checked){
                    switch(this.value){
                        case 'col-3':
                        case 'col-3-left':
                        case 'col-3-right':
                            document.getElementById('csw-1').style.display = 'none';
                            document.getElementById('csw-2').style.display = 'block';
                            break; 
                        case 'col-1':
                        case 'col-2-left':
                        case 'col-2-right':
                        default:
                            document.getElementById('csw-1').style.display = 'block';
                            document.getElementById('csw-2').style.display = 'none';
                            break;
                    }
                }
            });
        });
    </script>
    <style type="text/css">
        #ad-msg-auth, #ad-msg-anon { width:500px; }
        #ctx-about {width:326px;float:right;border:1px solid #e5e5e5;border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;padding:10px;margin-right:20px;margin-left:10px;}
        #ctx-about a.img-block {display:block;text-align:center;}
        #ctx-about p, #ctx-about div {padding-left:10px;color:#9c9c9c;}
        #ctx-about p a { color:gray; }
        #ctx-ps-opts-form {float:left;width:765px;padding-top:0 !important;}
        .ctx-footnote { color:#9C9C9C; font-style:italic; }
        #show-more { cursor:pointer; color:gray; visibility:hidden; }
        #ctx-opts-table { }
        .helptext { color:gray; }
    </style>
<div id="aj-options" class="wrap">
    
    <div id="icon-themes" class="icon32"><br/></div>
    <h2><?php _e('Adventure Journal Options','adventurejournal') ?></h2>
    <?php echo $message,$debugOpts; ?>
    
<table cellpadding="0" cellspacing="0" id="ctx-opts-table" style="border:none;width:100%;">
    <tr>
        <td id="ctx-ps-opts-form">
                <p></p>
                <form method="post" action="">
                    <?php wp_nonce_field('aj-options'); ?>
                    <p style="font-style:italic"><?php _e('This screen allows you to customize advanced options exclusive to Adventure Journal. Customizing your website has never been easier!','adventurejournal'); ?></p>
                    
                    
                    <div style="border-bottom:1px dotted silver;margin:2em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Site Layout','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('Your site can be displayed in a variety of different layouts. Please note that changing layouts may require you to tweak your widget settings. Also keep in mind that not all <em>page templates</em> are compatible with all site layouts.','adventurejournal'); ?></p>
                    <table cellpadding="0" cellspacing="0" id="admin-layout">
                        <tr>
                            <td <?php if($AJOpts['layout'] == 'col-1'){echo ' class="active-layout"';}?>>
                                <input name="master-layout" type="radio" value="col-1" id="layout-1" class="radial" <?php if($AJOpts['layout'] == 'col-1'){echo ' checked="checked"';}?>>
                                <label for="layout-1">
                                    <div style="text-align:center;padding-bottom:5px;"><?php _e('1 Column<br/>(No Sidebar)','adventurejournal') ?></div>
                                    <img src="<?php echo $themeDir; ?>/images/layout-opt-1col.gif" alt="1 Col" />
                                </label>
                            </td>
                            <td <?php if($AJOpts['layout'] == 'col-2-left'){echo ' class="active-layout"';}?>>
                                <input name="master-layout" type="radio" value="col-2-left" id="layout-2l" class="radial" <?php if($AJOpts['layout'] == 'col-2-left'){echo ' checked="checked"';}?>>
                                <label for="layout-2l">
                                    <div style="text-align:center;padding-bottom:5px;"><?php _e('2 Columns <br />(Content Left)','adventurejournal') ?></div>
                                    <img src="<?php echo $themeDir; ?>/images/layout-opt-2collt.gif" alt="2 Col Lt" />
                                </label>
                            </td>
                            <td <?php if($AJOpts['layout'] == 'col-2-right'){echo ' class="active-layout"';}?>>
                                <input name="master-layout" type="radio" class="radial" id="layout-2r" value="col-2-right" <?php if($AJOpts['layout'] == 'col-2-right'){echo ' checked="checked"';}?>>
                                <label for="layout-2r">
                                    <div style="text-align:center;padding-bottom:5px;"><?php _e('2 Columns <br />(Content Right)','adventurejournal') ?></div>
                                    <img src="<?php echo $themeDir; ?>/images/layout-opt-2colrt.gif" alt="2 Col Rt" />
                                </label>
                            </td>
                            <td <?php if($AJOpts['layout'] == 'col-3'){echo ' class="active-layout"';}?>>
                                <input name="master-layout" type="radio" class="radial" id="layout-3" value="col-3" <?php if($AJOpts['layout'] == 'col-3'){echo ' checked="checked"';}?>>
                                <label for="layout-3">
                                    <div style="text-align:center;padding-bottom:5px;"><?php _e('3 Columns <br/>(Content Middle)','adventurejournal') ?></div>
                                    <img src="<?php echo $themeDir; ?>/images/layout-opt-3col.gif" alt="3 Col" />
                                </label>
                            </td>
                            <td <?php if($AJOpts['layout'] == 'col-3-left'){echo ' class="active-layout"';}?>>
                                <input name="master-layout" type="radio" class="radial" id="layout-3l" value="col-3-left" <?php if($AJOpts['layout'] == 'col-3-left'){echo ' checked="checked"';}?>>
                                <label for="layout-3l">
                                    <div style="text-align:center;padding-bottom:5px;"><?php _e('3 Columns <br/>(Content Left)','adventurejournal') ?></div>
                                    <img src="<?php echo $themeDir; ?>/images/layout-opt-3col-lt.gif" alt="3 Col Lt" />
                                </label>
                            </td>
                        </tr>
                    </table>

                    

                    <div style="border-bottom:1px dotted silver;margin:1em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Site Title &amp; Description','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('You can choose how you want your site title to display. You can choose a custom image, or completely hide the paperclipped title scrap (which is useful if you plan on using the header image as your title).','adventurejournal'); ?></p>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ctx-table site-title admin-choosebox">
                    <tr>
                        <td <?php if($AJOpts['title-type'] == 'title-default'){echo ' class="active-layout"';}?>>
                            <input style="margin-top:80px;" name="title-type" value="title-default" id="title-default" class="radial" type="radio" <?php if($AJOpts['title-type'] == 'title-default'){echo ' checked="checked"';}?>>
                            <label for="title-default" style="margin-left:0;">
                            <p><strong><?php _e('Default (Text Only)','adventurejournal'); ?></strong></p>
                            <img src="<?php echo $themeDir; ?>/images/title-default.jpg" alt="Default Site Title" width="200" height="122" /></label></td>
                        <td <?php if($AJOpts['title-type'] == 'title-logo'){echo ' class="active-layout"';}?>>
                            <input style="margin-top:80px;" name="title-type" value="title-logo" id="title-logo" class="radial" type="radio" <?php if($AJOpts['title-type'] == 'title-logo'){echo ' checked="checked"';}?>>
                            <label for="title-logo" style="margin-left:0;"><p><strong><?php _e('Logo (Custom Image)','adventurejournal'); ?></strong></p>
                            <img src="<?php echo $themeDir; ?>/images/title-logo.jpg" alt="Custom Logo Site Title" width="200" height="122"  /></label></td>
                        <td <?php if($AJOpts['title-type'] == 'title-blank'){echo ' class="active-layout"';}?>>
                            <input style="margin-top:80px;" name="title-type" value="title-blank" id="title-blank" class="radial" type="radio" <?php if($AJOpts['title-type'] == 'title-blank'){echo ' checked="checked"';}?>>
                            <label for="title-blank" style="margin-left:0;">
                            <p><strong><?php _e('No Title','adventurejournal'); ?></strong></p>
                            <img src="<?php echo $themeDir; ?>/images/title-blank.jpg" alt="No Site Title" width="200" height="122"  /></label></td>
                      </tr>
                    </table>

                    <table class="form-table custom-logo" <?php if($AJOpts['title-type'] != 'title-logo'){echo ' style="display:none;"';}?>>
                    <tr valign="top">
                    <th scope="row"> <label for="css-path-logo"><?php _e('Custom Logo Location:','adventurejournal'); ?></label><br />
                    <p style="font-size:10px;"><?php _e('Image height should be <br />less than 90 pixels.','adventurejournal'); ?></p>
                      </th>
                        <td><label> <em>  <?php echo 'http://'.$_SERVER['SERVER_NAME'].'/' ?></em>
                          <input type="text" name="logo-path" id="logo-path" title="Example: wp-content/adventurejournal_override.css" style="width:300px;font-size:10px;" value="<?php echo $AJOpts['logo-path']; ?>" />
                          <span style="color:red;"><?php if(!file_exists(ABSPATH.$AJOpts['logo-path'])){ _e('<br /> Notice: File may not exist at '.'http://'.$_SERVER['SERVER_NAME'].'/'.$AJOpts['logo-path'],'adventurejournal'); } ?></span> </label><br />
                    <p style="font-size:10px;font-style:italic;"><?php _e('For best results, use an image file with a transparent background such as png.','adventurejournal'); ?></p>
                      </td>
                      </tr>
                    </table>

                                     
                    
                    <div style="border-bottom:1px dotted silver;margin:2em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Crumbled Paper Background','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('By default, Adventure Journal only uses a neat "crumbled paper with tape" texture for stickied posts. If you would like this texture to appear on ALL post listings, choose the "All Posts" option below.','adventurejournal'); ?></p>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ctx-table site-title admin-choosebox">
                    <tr>
                        <td <?php if($AJOpts['paper-type'] == 'paper-sticky' || !isset($AJOpts['paper-type'])){echo ' class="active-layout"';}?>>
                            <input name="paper-type" value="paper-sticky" id="paper-sticky" class="radial" type="radio" style="margin-top:80px;" <?php if($AJOpts['paper-type'] == 'paper-sticky' || !isset($AJOpts['paper-type'])){echo ' checked="checked"';}?>>
                            <label for="paper-sticky" style="margin-left:0;">
                                <p><?php _e('<strong>Stickied Posts Only</strong> (default)','adventurejournal'); ?></p>
                                <img src="<?php echo $themeDir; ?>/images/options-crumble-sticky.jpg" alt="Default Site Title" width="200" height="122" /> </td>
                            </label>
                        <td <?php if($AJOpts['paper-type'] == 'paper-all'){echo ' class="active-layout"';}?>>
                            <input name="paper-type" value="paper-all" id="paper-all" class="radial" type="radio" style="margin-top:80px;" <?php if($AJOpts['paper-type'] == 'paper-all'){echo ' checked="checked"';}?>>
                            <label for="paper-all" style="margin-left:0;">
                                <p><?php _e('<strong>All Posts</strong>','adventurejournal'); ?></p>
                                <img src="<?php echo $themeDir; ?>/images/options-crumble-all.jpg" alt="Default Site Title" width="200" height="122" /> </td>
                            </label>
                        <td style="width:240px;background:transparent !important;"></td>
                      </tr>
                    </table>

                    
                    
                    <div style="border-bottom:1px dotted silver;margin:2em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Custom Stylesheet','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('You can use a custom stylesheet to override the default Adventure Journal styles.
                    We suggest you keep the custom css file in the <code>/wp-content/</code>
                    directory so that upgrades to WordPress or Adventure Journal don\'t erase your CSS.','adventurejournal') ?></p>
                    <table class="form-table" style="margin-bottom:0;">
                        <tr valign="top">
                            <th scope="row">
                                <label for="filter-menu"><?php _e('CSS File Location:','adventurejournal') ?></label>
                            </th>
                            <td>
                                <label>
                                    <?php echo 'http://'.$_SERVER['SERVER_NAME'].'/' ?>
                                    <input type="text" name="css-path" id="css-path" title="Example: wp-content/adventurejournal_override.css" style="width:300px;font-size:10px;" value="<?php echo (!empty($AJOpts['css-path']))?$AJOpts['css-path']:''; ?>" /> <br /><span style="color:red;"><?php if(!empty($AJOpts['css-path']) && !file_exists(ABSPATH.$AJOpts['css-path'])){ _e('Notice: File may not exist at '.'http://'.$_SERVER['SERVER_NAME'].'/'.$AJOpts['css-path'].' ','adventurejournal'); } ?></span><br/>
                                </label>
                            </td>
                        </tr>
                    </table>
                    
                    <div id="csw-1" style="<?php echo ($AJOpts['layout']!=='col-3' && $AJOpts['layout']!=='col-3-left')?'display:block':'display:none'; ?>">
                    <div style="border-bottom:1px dotted silver;margin:.5em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Custom Sidebar Width','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('By default, Adventure Journals sidebars are 220 pixels wide. For some widgets and advertisements, this may be too narrow. To increase the width of the sidebar, enter a new value below.','adventurejournal'); ?></p>
                    <p><input type="text" name="sidebar-width" id="sidebar-width" value="<?php echo (!empty($AJOpts['sidebar-width'])) ? $AJOpts['sidebar-width'] :'220'; ?>" size="6" /> pixels</p>
                    <p><span style="font-style:italic;color:silver;font-size:0.8em;"><?php echo sprintf(__('Note: If you are using a two-sidebar layout, please take this into account, as you may be dramatically decreasing the size of your content area. You may also need to use the %s plugin to adjust the size of your featured images if they become too large for the content area.','adventurejournal'),'<a style="color:silver" href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a>'); ?></span></p>
                    </div>
                    
                    <div id="csw-2" style="<?php echo ($AJOpts['layout']!=='col-3' && $AJOpts['layout']!=='col-3-left')?'display:none':'display:block'; ?>">
                    <div style="border-bottom:1px dotted silver;margin:.5em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Custom Sidebar Width','adventurejournal'); ?> <em><?php _e('(Disabled)','adventurejournal'); ?></em></h3>
                    <p class="helptext"><?php _e('Your current layout selection (3 columns) does not allow for custom sidebar widths because the content area would become too compressed. To use custom sidebar widths, please select a layout that uses one or two columns.','adventurejournal'); ?></p>
                    <p><span style="font-style:italic;color:silver;font-size:0.8em;"><?php _e('Note: 3-column layouts always have a sidebar width of 220px. The content has a usable width of 558px.','adventurejournal') ?></span></p>
                    </div>
                    <br/>
                    
                    <div style="border-bottom:1px dotted silver;margin:.5em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Custom Header Height','adventurejournal'); ?></h3>
                    <p class="helptext"><?php echo sprintf(__('To change the vertical size of the header image, first enter a value in below, save changes and then upload your image on the <a href="%s">header page</a>. The default value is 360.','adventurejournal'),admin_url().'themes.php?page=custom-header'); ?></p>
                    <p>920 x <input type="text" name="header-height" id="header-height" value="<?php echo (!empty($AJOpts['header-height'])) ? $AJOpts['header-height'] :'360'; ?>" size="6" /> pixels</p>


                    <div style="border-bottom:1px dotted silver;margin:2em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Featured Header Images','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('Enable this option if you would like featured images to replace your site header on single pages. When enabled, featured images will no longer appear in blog listings.','adventurejournal'); ?></p>
                    <p><label><input type="checkbox" name="featured-header" <?php echo ($AJOpts['featured-header']==='true') ? 'checked="checked"' : ''; ?>/> <strong><?php _e('Use featured images as custom site header, if available','adventurejournal'); ?></strong></label></p>
                    <p><span style="font-style:italic;color:silver;font-size:0.8em;"><?php echo sprintf(__('Note: If your featured images aren\'t appearing after you enable this option, first ensure that your header images are <em>at least</em> 920 pixels wide. If you\'re still having trouble, please use the %s plugin to update your currently-saved header images.','adventurejournal'),'<a style="color:silver" href="http://wordpress.org/extend/plugins/regenerate-thumbnails/">Regenerate Thumbnails</a>'); ?></span></p>

                    
                    <div style="border-bottom:1px dotted silver;margin:2em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Browser Update Helper','adventurejournal'); ?></h3>
                    <p class="helptext"><?php _e('Adventure Journal now includes a customized version of the upcoming "Browser Update Helper" plugin, a new initiative meant to speed up adoption of newer, faster, more secure web browsers. This feature temporarily displays an attractive, helpful notice at the top of the site when a users browser is badly out of date. Leaving this feature on <em>will</em> make the web a better, safer place. To disable this feature, uncheck the box below.','adventurejournal'); ?> <a href="http://wordpress.org/news/2011/07/are-you-ready-for-wordpress-3-2/" target="_blank"><?php _e('Why include this?','adventurejournal') ?></a></p>
                    <p><label><input type="checkbox" name="browser-helper" <?php echo ($AJOpts['browser-helper']==='true' || !isset($AJOpts['browser-helper'])) ? 'checked="checked"' : ''; ?>/> <strong><?php _e('Make the web a better, safer place','adventurejournal'); ?></strong></label></p>

                    <!--
                    <div style="border-bottom:1px dotted silver;margin:2em 0 -1em 0;"></div>
                    <h3 class="title"><?php _e('Layout','adventurejournal'); ?></h3>
                    <p class="helptext"><?php echo sprintf(__('If you would like to change the site\'s layout (number of columns), visit the <a href="%s">layout screen</a>','adventurejournal'),admin_url().'themes.php?page=theme-layouts'); ?></p>
                    -->
                    <br/>
                    <p>
                        <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
                    </p>
            </form>
        </td>
        <td style="vertical-align:top;">
            <div id="ctx-about">
                <a class="img-block" href="http://www.contextureintl.com"><img src="<?php echo get_template_directory_uri().'/images/ctx-logo.png'; ?>" alt="Contexture International" /></a>
                <p>Contexture International is an all-in-one agency specializing in <a href="http://www.contextureintl.com/portfolio/graphic-design/">graphic design</a>, <a href="http://www.contextureintl.com/portfolio/web-interactive/">web design</a>, and <a href="http://www.contextureintl.com/portfolio/broadcast-video-production/">broadcast and video production</a>, with an unparalleled ability to connect with the heart of your audience.</p>
                <p>Contexture's staff has successfully promoted organizations and visionaries for more than 2 decades through exceptional storytelling, in just the right contexts for their respective audiences, with overwhelming returns on investment.  See the proof in our <a href="http://www.contextureintl.com/portfolio/">portfolio </a>or learn more <a href="http://www.contextureintl.com/about-us/">about us</a>.</p>
                <div><a href="http://www.contextureintl.com/">Need a custom web or video project?</a></div>
                <div><a href="http://www.contextureintl.com/wordpress/adventure-journal-wordpress-theme/">Need help with Adventure Journal?</a></div>
            </div>
        </td>
    </tr>
</table>
</div>