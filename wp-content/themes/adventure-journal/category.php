<?php
/**
 * @package WordPress
 * @subpackage Adventure_Journal
 */

get_header(); ?>

<div class="content type-category" <?php ctx_aj_getlayout(); ?>>
  <div id="col-main" style="<?php echo ctx_aj_customwidth('content'); ?>">
    <div id="main-content" <?php ctx_aj_crinkled_paper(); ?>>
        <!-- BEGIN Main Content-->
        <h1><?php echo '<span>'.single_cat_title('',false).'</span>';?></h1>
        <?php
            $category_description = category_description();
            if ( ! empty( $category_description ) )
                    echo '<div class="archive-meta">' . $category_description . '</div>';

            /* Run the loop for the category page to output the posts.
             * If you want to overload this in a child theme then include a file
             * called loop-category.php and that will be used instead.
             */
            get_template_part( 'loop', 'category' );
        ?>
        <!-- END Main Content-->
    </div>
  </div>
  <?php get_sidebar(); ?>
  <div class="clear"></div>
</div>
<?php get_footer(); ?>
