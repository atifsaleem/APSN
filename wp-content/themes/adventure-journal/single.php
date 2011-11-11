<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
$themeOpts = get_option('ctx-adventurejournal-options');
get_header();
?>
<div class="content" <?php ctx_aj_getlayout(); ?>>
    <div id="col-main" style="<?php echo ctx_aj_customwidth('content'); ?>">
      <div id="main-content" <?php //ctx_aj_crinkled_paper(); ?>>
      <!-- BEGIN Main Content-->
            <?php
            //Start the Loop
            if (have_posts()) : while (have_posts()) : the_post(); ?>

                <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                <?php echo sprintf('<h1 class="storytitle">%s</h1>',get_the_title());?>
                    <?php if($themeOpts['featured-header']!='true') { the_post_thumbnail(); } ?>
                    <div class="meta">Posted by <?php the_author_posts_link(); ?> on <?php the_date();?></div>

                    <?php 
                        if(!function_exists('is_admin_bar_showing')){
                            edit_post_link(__('Edit Post', 'adventurejournal'));
                        } else if ( !is_admin_bar_showing() ){
                            edit_post_link(__('Edit Post', 'adventurejournal'));
                        }
                    ?>
                        
                    <div class="storycontent">
                        <?php the_content(__('(more...)')); ?>
                        <div class="clear"></div>
                    </div>
                    
                    <div class="feedback">
                        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'adventurejournal' ), 'after' => '</div>' ) ); ?>
                        <?php _e('Posted under ','adventurejournal'); ?> <?php the_category(',') ?> <?php the_tags(__('and tagged with '), ', ', '  '); ?><br />
                        <?php comments_popup_link(__('Comments (0)'), __('Comments (1)'), __('Comments (%)')); ?>
                    </div>

                 </div>
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
