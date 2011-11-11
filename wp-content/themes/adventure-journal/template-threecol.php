<?php
/**
 * Template Name: Three columns, content center
 *
 * A page template with a sidebar on the left and right.
 *
 * @package WordPress
 * @subpackage Adventure_Journal
 */
get_header();
?>
<div class="content" id="col-3">
    <div id="col-main" style="<?php echo ctx_aj_customwidth('content-3'); ?>">
      <div id="main-content" <?php //ctx_aj_crinkled_paper(); ?>>
      <!-- BEGIN Main Content-->
		 <?php
		//Start the Loop
		if (have_posts()) : while (have_posts()) : the_post(); ?>

                    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <?php echo sprintf('<h1 class="storytitle">%s</h1>',get_the_title());?>

                    <?php if(!is_admin_b)edit_post_link(__('Edit')); ?>

                    <div class="storycontent">
                        <?php the_content(__('(more...)')); ?>
                    </div>

                    <div class="feedback">
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adventurejournal' ), 'after' => '</div>' ) ); ?>
                        <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
                    </div>

                 </div>
                <br/>
                <?php comments_template(); // Get wp-comments.php template ?>
        <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.','adventurejournal'); ?></p>
        <?php endif; ?>

        <?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); ?>
      <!-- END Main Content-->

      </div>
    </div>
	<?php get_sidebar(); ?>
     <div class="clear"></div>
</div>
<?php get_footer(); ?>