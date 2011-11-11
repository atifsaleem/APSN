<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
get_header();
?>
<div class="content" <?php ctx_aj_getlayout(); ?>>
    <div id="col-main">
      <div id="main-content" <?php ctx_aj_crinkled_paper(); ?>>
      <!-- BEGIN Main Content-->
<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'adventurejournal' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php _e( 'Nothing Found', 'adventurejournal' ); ?></h2>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'adventurejournal' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->
<?php endif; ?>
      <!-- END Main Content-->

      </div>
    </div>
	<?php get_sidebar(); ?>
     <div class="clear"></div>
</div>
<?php get_footer(); ?>