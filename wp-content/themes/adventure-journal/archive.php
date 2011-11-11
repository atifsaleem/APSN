<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
get_header();
?>
<div class="content type-archive" <?php ctx_aj_getlayout(); ?>>
    <div id="col-main" style="<?php echo ctx_aj_customwidth('content'); ?>">
      <div id="main-content" <?php ctx_aj_crinkled_paper(); ?>>
      <!-- BEGIN Main Content-->
<?php if ( have_posts() ) the_post(); ?>

			<h1 class="page-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'adventurejournal' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'adventurejournal' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'adventurejournal' ), get_the_date('Y') ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'adventurejournal' ); ?>
<?php endif; ?>
			</h1>

<?php
	rewind_posts();
	get_template_part( 'loop', 'archive' );
?>      <!-- END Main Content-->

      </div>
    </div>
	<?php get_sidebar(); ?>
     <div class="clear"></div>
</div>
<?php get_footer(); ?>