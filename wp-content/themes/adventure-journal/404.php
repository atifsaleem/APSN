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
		<div id="post-0" class="post error404 not-found">
				<h1 class="entry-title"><?php _e( 'Not Found', 'adventurejournal' ); ?></h1>
				<div class="entry-content">
					<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'adventurejournal' ); ?></p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div>
      <!-- END Main Content-->

      </div>
    </div>
	<?php get_sidebar(); ?>
     <div class="clear"></div>
</div>
<?php get_footer(); ?>