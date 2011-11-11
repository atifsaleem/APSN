<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
global $multipage;
get_header();
?>
<div class="content" <?php ctx_aj_getlayout(); ?>>
    <div id="col-main" style="<?php echo ctx_aj_customwidth('content'); ?>">
      <div id="main-content" <?php //ctx_aj_crinkled_paper(); ?>>
      <!-- BEGIN Main Content-->
		 <?php
		//Start the Loop
		if (have_posts()) : while (have_posts()) : the_post(); 
                ?>

                    <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                    <?php echo sprintf('<h1 class="storytitle">%s</h1>',get_the_title());
                    ?>

                    <?php 
                        /*if(!function_exists('is_admin_bar_showing')){
                            edit_post_link(__('Edit Page', 'adventurejournal'));
                        } else if ( !is_admin_bar_showing() ){
                            edit_post_link(__('Edit Page', 'adventurejournal'));
                        }*/
                    ?>

                    <div class="storycontent">
                        <?php the_content(__('(more...)')); ?>
                    </div>

					<?php if ( comments_open() || have_comments() || $multipage ) : ?>
                    <div class="feedback">
                        <?php /*wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adventurejournal' ), 'after' => '</div>' ) ); ?>
                        <?php if ( comments_open() || have_comments() ) : ?>
                        <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
                        <?php endif; */?>
                    </div>
					<?php endif; ?>
					
                 </div>
                <br/>
                <?php /*if ( comments_open() || have_comments() ) : ?>
                <?php comments_template(); // Get wp-comments.php template ?>
                <?php endif; */?>
        <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.','adventurejournal'); ?></p>
        <?php endif; ?>

        <?php posts_nav_link(' &#8212; ', __('&laquo; Newer Posts'), __('Older Posts &raquo;')); 
  ?>
 
      <!-- END Main Content-->

      </div>
    </div>
	<?php get_sidebar(); ?>
     <div class="clear"></div>
</div>
<?php get_footer(); ?>