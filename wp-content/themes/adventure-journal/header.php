<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
$AJOpts = get_option('ctx-adventurejournal-options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php
            /*Print the <title> tag based on what is being viewed.*/
            global $page, $paged;
            wp_title( '|', true, 'right' );
            // Add the blog name.
            bloginfo( 'name' );
            // Add the blog description for the home/front page.
            $site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                    echo " | $site_description";
            // Add a page number if necessary:
            if ( $paged >= 2 || $page >= 2 )
                    echo ' | ' . sprintf( __( 'Page %s', 'adventurejournal' ), max( $paged, $page ) );
    ?></title>
    <meta name="author" content="Designed by Contexture International | http://www.contextureintl.com" />
	<meta name="iconpath" id="iconpath" content="<?php echo get_bloginfo( 'template_directory', 'raw' ); ?>/images/bh" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php
            /* We add some JavaScript to pages with the comment form
             * to support sites with threaded comments (when in use).
             */
            if ( is_singular() && get_option( 'thread_comments' ) )
                    wp_enqueue_script( 'comment-reply' );

            /* Always have wp_head() just before the closing </head>
             * tag of your theme, or you will break many plugins, which
             * generally use this hook to add elements to <head> such
             * as styles, scripts, and meta tags.
             */
            wp_head();
    ?>
</head>
<body <?php body_class(); ?>>
<?php if($AJOpts['browser-helper']=='true'): ?>
<div id="browser-helper">
    <div id="bh-bg">
        <table id="bh-notice" cellspacing="0" cellpadding="0" border="0">
            <tr>
                <td id="bh-icon-td" rowspan="3">
                    <img id="bh-icon" src="http://s.wordpress.org/images/browsers/ie.png" alt="browser icon" width="87"/>
                </td>
                <td id="bh-copy">
                    <div id="bh-warning"><?php _e('You are using an insecure version of <span id="bh-browsername">your web browser</span>. Please update your browser!','adventurejournal') ?></div>
                    <div id="bh-explain"><?php _e('Using an outdated browser makes your computer unsafe. For a safer, faster, more enjoyable user experience, please update your browser today or try a newer browser.','adventurejournal') ?></div>
                    <div id="bh-links">
                        <a id="bh-update" href="#"><?php _e('Update Your Browser','adventurejournal') ?></a> | <a href="http://www.google.com/chrome/"><?php _e('Try Something New','adventurejournal') ?></a> | <a href="#" id="bh-hide"><?php _e('Hide This Warning','adventurejournal') ?></a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div id="bh-shadow"></div>
</div>
<?php endif; ?>
    <div <?php echo ctx_aj_get_relationships($post->ID,'siteframe'); ?>>
        <div id="container">
          <div id="container2">
            <div class="nav-horz nav-main" id="menu">
              <div class="nav-main-left">
                <div class="nav-main-right">
                    <?php wp_nav_menu( array( 'theme_location' => 'primary-menu' ) ); ?>
                </div>
              </div>
              <div class="nav-main-bottom"></div>
            </div>
            <div class="clear"></div>
            <!-- end header -->
      <div id="header"><div id="header2"><div id="header3"><div id="header4">
            	<?php ctx_aj_site_title() ;?>
              <div id="banner">
                <?php

                //wp_die('||| '.(string)has_post_thumbnail( $post->ID ).' |||');

                // Check if this is a post or page, if it has a thumbnail, and if it's a big one
                if (is_singular()
                    && has_post_thumbnail( $post->ID )
                    && ( $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'post-thumbnail' ) )
                    && $image[1] >= HEADER_IMAGE_WIDTH ) {
                        // Houston, we have a new header image!
                        echo get_the_post_thumbnail( $post->ID );
                } else if ( get_header_image() ) {
                ?>
                        <img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" />
                <?php }  ?>

              </div>
      </div></div></div></div>