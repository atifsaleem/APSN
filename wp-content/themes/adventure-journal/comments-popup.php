<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <title><?php echo get_option('blogname'); ?> - <?php echo sprintf(__("Comments on %s"), the_title('','',false)); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
		body { margin: 3px; }
	</style>

</head>
<body id="commentspopup">

<h1 id="header"><a href="" title="<?php echo get_option('blogname'); ?>"><?php echo get_option('blogname'); ?></a></h1>

<?php
/* Don't remove these lines. */
add_filter('comment_text', 'popuplinks');
if ( have_posts() ) :
while( have_posts()) : the_post();
?>

<h2 id="comments"><?php _e('Comments','adventurejournal'); ?></h2>

<p><a href="<?php echo get_post_comments_feed_link($post->ID); ?>"><?php _e("<abbr title=\"Really Simple Syndication\">RSS</abbr> feed for comments on this post."); ?></a></p>

<?php if ( pings_open() ) { ?>
<p><?php _e("The <abbr title=\"Universal Resource Locator\">URL</abbr> to TrackBack this entry is:"); ?> <em><?php trackback_url() ?></em></p>
<?php } ?>

<?php
// this line is WordPress' motor, do not delete it.
$commenter = wp_get_current_commenter();
extract($commenter);
$comments = get_approved_comments($id);
$commentstatus = get_post($id);
if ( post_password_required($commentstatus) ) {  // and it doesn't match the cookie
	echo(get_the_password_form());
} else { ?>

<?php if ($comments) { ?>
<ol id="commentlist">
<?php foreach ($comments as $comment) { ?>
	<li id="comment-<?php comment_ID() ?>">
	<?php comment_text() ?>
	<p><cite><?php comment_type(_x('Comment', 'noun'), __('Trackback'), __('Pingback')); ?> <?php _e('by','adventurejournal'); ?> <?php comment_author_link() ?> &#8212; <?php comment_date() ?> @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></cite></p>
	</li>

<?php } // end for each comment ?>
</ol>
<?php } else { // this is displayed if there are no comments so far ?>
	<p><?php _e('No comments yet.','adventurejournal'); ?></p>
<?php } ?>

<?php if ( comments_open($commentstatus) ) { ?>
<h2><?php _e('Leave a comment','adventurejournal'); ?></h2>
<p><?php _e("Line and paragraph breaks automatic, e-mail address never displayed, <acronym title=\"Hypertext Markup Language\">HTML</acronym> allowed:",'adventurejournal'); ?> <code><?php echo allowed_tags(); ?></code></p>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( is_user_logged_in() ) : ?>
<p><?php printf(__('Logged in as %s.','adventurejournal'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>'); ?> <a href="<?php echo wp_logout_url(); ?>" title="<?php echo esc_attr(__('Log out of this account','adventurejournal')); ?>"><?php _e('Log out &raquo;','adventurejournal'); ?></a></p>
<?php else : ?>
	<p>
	  <input type="text" name="author" id="author" class="textarea" value="<?php echo esc_attr($comment_author); ?>" size="28" tabindex="1" />
	   <label for="author"><?php _e("Name",'adventurejournal'); ?></label>
	</p>

	<p>
	  <input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="28" tabindex="2" />
	   <label for="email"><?php _e("E-mail",'adventurejournal'); ?></label>
	</p>

	<p>
	  <input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="28" tabindex="3" />
	   <label for="url"><?php _e("<abbr title=\"Universal Resource Locator\">URL</abbr>",'adventurejournal'); ?></label>
	</p>
<?php endif; ?>

	<p>
	  <label for="comment"><?php _e("Your Comment",'adventurejournal'); ?></label>
	<br />
	  <textarea name="comment" id="comment" cols="70" rows="4" tabindex="4"></textarea>
	</p>

	<p>
	  <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
	  <input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER["REQUEST_URI"]); ?>" />
	  <input name="submit" type="submit" tabindex="5" value="<?php esc_attr_e("Say It!",'adventurejournal'); ?>" />
	</p>
	<?php do_action('comment_form', $post->ID); ?>
</form>
<?php } else { // comments are closed ?>
<p><?php _e("Sorry, the comment form is closed at this time.",'adventurejournal'); ?></p>
<?php }
} // end password check
?>

<div><strong><a href="javascript:window.close()"><?php _e("Close this window.",'adventurejournal'); ?></a></strong></div>

<?php // if you delete this the sky will fall on your head
endwhile; //endwhile have_posts()
else: //have_posts()
?>
<p>Sorry, no posts matched your criteria.</p>
<?php endif; ?>

<!-- // this is just the end of the motor - don't touch that line either :) -->
<?php //} ?>
<p class="credit"><?php timer_stop(1); ?> <?php echo sprintf(__("<cite>Powered by <a href=\"http://wordpress.org\" title=\"%s\"><strong>WordPress</strong></a></cite>",'adventurejournal'),__("Powered by WordPress, state-of-the-art semantic personal publishing platform.",'adventurejournal')); ?></p>
<?php // Seen at http://www.mijnkopthee.nl/log2/archive/2003/05/28/esc(18) ?>
<script type="text/javascript">
<!--
document.onkeypress = function esc(e) {
	if(typeof(e) == "undefined") { e=event; }
	if (e.keyCode == 27) { self.close(); }
}
// -->
</script>
</body>
</html>
