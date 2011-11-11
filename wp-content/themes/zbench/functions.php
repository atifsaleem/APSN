<?php // Widgetized Sidebar.
function zbench_widgets_init() {
	register_sidebar(array(
		'name' => __('Primary Widget Area','zbench'),
		'id' => 'primary-widget-area',
		'description' => __('The primary widget area','zbench'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Singular Widget Area','zbench'),
		'id' => 'singular-widget-area',
		'description' => __('The singular widget area','zbench'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Not Singular Widget Area','zbench'),
		'id' => 'not-singular-widget-area',
		'description' => __('Not the singular widget area','zbench'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Footer Widget Area','zbench'),
		'id' => 'footer-widget-area',
		'description' => __('The footer widget area','zbench'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>'
	));
}
add_action( 'widgets_init', 'zbench_widgets_init' );

// Custom Comments List.
function zbench_mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
	switch ($pingtype=$comment->comment_type) {
		case 'pingback' :
		case 'trackback' : ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard pingback">
			<cite class="fn zbench_pingback"><?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php printf(__('%1$s at %2$s', 'zbench'), get_comment_date(),  get_comment_time()); ?></cite>
		</div>
	</div>
<?php
			break;
		default : ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar($comment,$size='40',$default='' ); ?>
			<cite class="fn"><?php comment_author_link(); ?></cite>
			<span class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php printf(__('%1$s at %2$s', 'zbench'), get_comment_date(),  get_comment_time()); ?></a><?php edit_comment_link(__('[Edit]','zbench'),' ',''); ?></span>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
		<em class="approved"><?php _e('Your comment is awaiting moderation.','zbench'); ?></em>
		<br />
		<?php endif; ?>
		<div class="comment-text">
			<?php comment_text(); ?>
		</div>
		<div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
		</div>
	</div>

<?php 		break;
	}
}

/* wp_list_comments()->pings callback */
function zbench_custom_pings($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    if('pingback' == get_comment_type()) $pingtype = 'Pingback';
    else $pingtype = 'Trackback';
?>
    <li id="comment-<?php echo $comment->comment_ID ?>">
        <?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php echo mysql2date('Y/m/d/ H:i', $comment->comment_date); ?>
<?php }

if ( ! isset( $content_width ) )
	$content_width = 620;
	
// WP nav menu
if (function_exists('wp_nav_menu')) {
	register_nav_menus(array('primary' => 'Primary Navigation'));
}

// LOCALIZATION
load_theme_textdomain('zbench', get_template_directory() . '/lang');

// custom excerpt
function zbench_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'zbench_excerpt_length' );

function zbench_continue_reading_link() {
	return '<p class="read-more"><a href="'. get_permalink() . '">' . __( 'Read more &raquo;', 'zbench' ) . '</a></p>';
}

function zbench_auto_excerpt_more( $more ) {
	return ' &hellip;' . zbench_continue_reading_link();
}
add_filter( 'excerpt_more', 'zbench_auto_excerpt_more' );

function zbench_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= zbench_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'zbench_custom_excerpt_more' );

// Tell WordPress to run zbench_setup() when the 'after_setup_theme' hook is run.
add_action( 'after_setup_theme', 'zbench_setup' );
if ( ! function_exists( 'zbench_setup' ) ):
function zbench_setup() {

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme allows users to set a custom background
	add_custom_background();
	
	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'extra-featured-image', 620, 200, true );
	function zbench_featured_content($content) {
		if (is_home() || is_archive()) {
			the_post_thumbnail( 'extra-featured-image' );
		}
		return $content;
	}
	add_filter( 'the_content', 'zbench_featured_content',1 );
	function zbench_post_image_html( $html, $post_id, $post_image_id ) {
		$html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';
		return $html;
	}
	add_filter( 'post_thumbnail_html', 'zbench_post_image_html', 10, 3 );

	// Your changeable header business starts here
	define( 'HEADER_TEXTCOLOR', '' );
	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	define( 'HEADER_IMAGE', '' ); // default: none IMG

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to zbench_header_image_width and zbench_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'zbench_header_image_width', 950 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'zbench_header_image_height', 180 ) );

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be 950 pixels wide by 180 pixels tall.
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	// Don't support text inside the header image.
	define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See zbench_admin_header_style(), below.
	add_custom_image_header( '', 'zbench_admin_header_style' );
	if ( ! function_exists( 'zbench_admin_header_style' ) ) {
	//Styles the header image displayed on the Appearance > Header admin panel.
		function zbench_admin_header_style() {
		?>
			<style type="text/css">
			/* Shows the same border as on front end */
			#headimg { }
			/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
				#headimg #name { }
				#headimg #desc { }
			*/
			</style>
		<?php
		}
	}

} // end of zbench_setup()
endif;

// Theme Options
$zbench_options = get_option('zBench_options');
function zbench_options_items() {
	$items = array (
		array(
			'id' => 'logo_url',
			'name' => __('Logo URL', 'zbench'),
			'desc' => __('Put your full logo image address here.(with http://) Image Height: 36px', 'zbench')
		),
		array(
			'id' => 'hide_title',
			'name' => __('Hide the title and description', 'zbench'),
			'desc' => __('If your set the "Header image", you can check it to hide the title and description.', 'zbench')
		),
		array(
			'id' => 'header_image_url',
			'name' => __('Header image link', 'zbench'),
			'desc' => __('Custom header image link. The default is Home Page.', 'zbench')
		),
		array(
			'id' => 'rss_url',
			'name' => __('RSS URL', 'zbench'),
			'desc' => __('Put your full rss subscribe address here.(with http://)', 'zbench')
		),
		array(
			'id' => 'twitter_url',
			'name' => __('twitter URL', 'zbench'),
			'desc' => __('Put your full twitter address here.(with http:// , leave it blank for display none.)', 'zbench')
		),
		array(
			'id' => 'facebook_url',
			'name' => __('facebook URL', 'zbench'),
			'desc' => __('Put your full facebook address here.(with http:// , leave it blank for no display none.)', 'zbench')
		),
		array(
			'id' => 'googleplus_url',
			'name' => __('Google+ URL', 'zbench'),
			'desc' => __('Put your full Google+ address here.(with http:// , leave it blank for no display none.)', 'zbench')
		),
		array(
			'id' => 'social_network_1_name',
			'name' => __('Custom social network 1', 'zbench'),
			'desc' => __('Social network name:', 'zbench')
		),
		array(
			'id' => 'social_network_1_img',
			'name' =>'Custom social network 1 icon',
			'desc' => __('Social network icon address: (image size limits: 16px*16px)', 'zbench')
		),
		array(
			'id' => 'social_network_1_url',
			'name' => 'Custom social network 1 url',
			'desc' => __('Social network links address:', 'zbench')
		),
		array(
			'id' => 'social_network_2_name',
			'name' => __('Custom social network 2', 'zbench'),
			'desc' => __('Social network name:', 'zbench')
		),
		array(
			'id' => 'social_network_2_img',
			'name' => 'Custom social network 2 icon',
			'desc' => __('Social network icon address: (image size limits: 16px*16px)', 'zbench')
		),
		array(
			'id' => 'social_network_2_url',
			'name' => 'Custom social network 2 url',
			'desc' => __('Social network links address:', 'zbench')
		),
		array(
			'id' => 'excerpt_check',
			'name' => __('Excerpt?', 'zbench'),
			'desc' => __('If excerpt of posts display in home and archive page, check.', 'zbench')
		),
		array(
			'id' => 'comment_notes',
			'name' => __('Disable the comment notes','zbench'),
			'desc' => __('Disabling this will remove the note text that displays with more options for adding to comments (html).', 'zbench')
		),
		array(
			'id' => 'smilies',
			'name' => __('Disable the comments smilies','zbench'),
			'desc' => __('Disabling this will remove the comments smilies.', 'zbench')
		)
	);
	return $items;
}

add_action( 'admin_init', 'zbench_theme_options_init' );
add_action( 'admin_menu', 'zbench_theme_options_add_page' );
function zbench_theme_options_init(){
	register_setting( 'zbench_options', 'zBench_options', 'zbench_options_validate' );
}
function zbench_theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'zbench' ), __( 'Theme Options', 'zbench' ), 'edit_theme_options', 'theme_options', 'zbench_theme_options_do_page' );
}

function zbench_default_options() {
	$options = get_option( 'zBench_options' );
	foreach ( zbench_options_items() as $item ) {
		if ( ! isset( $options[$item['id']] ) ) {
			$options[$item['id']] = '';
		}
	}
	update_option( 'zBench_options', $options );
}
add_action( 'init', 'zbench_default_options' );

function zbench_theme_options_do_page() {
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	if( isset( $_REQUEST['action'])&&('reset' == $_REQUEST['action']) ) {
		delete_option( 'zBench_options' );
		zbench_default_options();
	}
?>
	<div class="wrap">
		<?php screen_icon(); echo "<h2>" . sprintf( __( '%1$s Theme Options', 'zbench' ), get_current_theme() )	 . "</h2>"; ?>
		<?php settings_errors(); ?>
		<div id="poststuff" class="metabox-holder">
			<form method="post" action="options.php">
				<?php settings_fields( 'zbench_options' ); ?>
				<?php $options = get_option( 'zBench_options' ); ?>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'zbench' ); ?>" />
				</p>
				<div class="stuffbox" style="padding-bottom:10px;max-width:990px;">
					<h3><label for="link_url"><?php _e( 'Header settings', 'zbench' ); ?></label></h3>
					<table class="form-table">
					<?php foreach (zbench_options_items() as $item) { ?>
						<?php if ($item['id'] == 'hide_title' || $item['id'] == 'excerpt_check' || $item['id'] == 'comment_notes' || $item['id'] == 'smilies') { ?>
						<tr valign="top">
							<th scope="row"><?php echo $item['name']; ?></th>
							<td>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="checkbox" value="true" <?php if ( $options[$item['id']] ) { $checked = "checked=\"checked\""; } else { $checked = ""; } echo $checked; ?> />
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
							</td>
						</tr>
						<?php } elseif ($item['id'] == 'social_network_1_name') { ?>
						<tr valign="top">
							<th scope="row"><?php echo $item['name']; ?></th>
							<td>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								<br/>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="20" />
						<?php } elseif ($item['id'] == 'social_network_1_img') { ?>
								<br/>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								<br/>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="60" />
						<?php } elseif ($item['id'] == 'social_network_1_url') { ?>
								<br/>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								<br/>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="60" />
							</td>
						</tr>
						<?php } elseif ($item['id'] == 'social_network_2_name') { ?>
						<tr valign="top">
							<th scope="row"><?php echo $item['name']; ?></th>
							<td>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								<br/>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="20" />
						<?php } elseif ($item['id'] == 'social_network_2_img') { ?>
								<br/>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								<br/>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="60" />
						<?php } elseif ($item['id'] == 'social_network_2_url') { ?>
								<br/>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
								<br/>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="60" />
							</td>
						</tr>
					</table>
				</div>
				<div class="stuffbox" style="padding-bottom:10px;max-width:990px;">
					<h3><label for="link_url"><?php _e( 'General settings', 'zbench' ); ?></label></h3>
					<table class="form-table">
						<?php } else { ?>
						<tr valign="top">
							<th scope="row"><?php echo $item['name']; ?></th>
							<td>
								<input name="<?php echo 'zBench_options['.$item['id'].']'; ?>" type="text" value="<?php if ( $options[$item['id']] != "") { echo $options[$item['id']]; } else { echo ''; } ?>" size="60" />
								<br/>
								<label class="description" for="<?php echo 'zBench_options['.$item['id'].']'; ?>"><?php echo $item['desc']; ?></label>
							</td>
						</tr>
						<?php } ?>
						<?php if ($item['id'] == 'header_image_url') { ?>
					</table>
				</div>
				<div class="stuffbox" style="padding-bottom:10px;max-width:990px;">
					<h3><label for="link_url"><?php _e( 'Social network settings', 'zbench' ); ?></label></h3>
					<table class="form-table">
						<?php } ?>
					<?php } ?>
					</table>
				</div>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'zbench' ); ?>" />
				</p>
			</form>
			<div style="position:relative;">
			<form method="post">
				<p class="submit" style="position:absolute;left:130px;top:-75px;">
					<input class="button" name="reset" type="submit" value="<?php _e('Reset All Settings','zbench'); ?>" onclick="return confirm('<?php _e('Click OK to reset. Any settings will be lost!', 'zbench'); ?>');" />
					<input type="hidden" name="action" value="reset" />
				</p>
			</form>
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="max-width:990px;">
				<div class="stuffbox" style="max-width:990px;background-color:#ffffe0;border:1px solid #e6db55;">
					<h3><label for="link_url"><strong><?php _e('Donation','zbench'); ?></strong></label></h3>
					<div style="padding:10px;">
						<?php printf(__('Created, Developed and maintained by %s . If you feel my work is useful and want to support the development of more free resources, you can donate me. Thank you very much!','zbench'), '<a href="http://zww.me">zwwooooo</a>'); ?>
						<br /><br />
						<input type="hidden" name="cmd" value="_s-xclick">
						<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
						">
						<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						<img alt="" border="0" src="https://www.paypal.com/zh_XC/i/scr/pixel.gif" width="1" height="1">
					</div>
				</div>
			</form>
			</div>
		</div>
<?php
}
function zbench_options_validate($input) {
	return apply_filters( 'zbench_options_validate', $input);
}