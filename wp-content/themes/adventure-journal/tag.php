<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */
get_header(); ?>

<div class="content" <?php ctx_aj_getlayout(); ?>>
  <div id="col-main" style="<?php echo ctx_aj_customwidth('content'); ?>">
    <div id="main-content" <?php ctx_aj_crinkled_paper(); ?>>
        <!-- BEGIN Main Content-->
        <h1 class="page-title"><?php printf( __( 'Tagged With: %s', 'adventurejournal' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

        <?php get_template_part( 'loop', 'tag' ); ?>
        <!-- END Main Content-->
    </div>
  </div>
  <?php get_sidebar(); ?>
  <div class="clear"></div>
</div>
<?php get_footer(); ?>
