<?php 
wp_enqueue_script('jquery');
wp_enqueue_script('dependencies',get_bloginfo('template_directory').'/dependencies.js',array('jquery')); 
wp_enqueue_script('visualsearch', get_bloginfo('template_directory').'/visualsearch.js',array('jquery','dependencies'));
wp_enqueue_style('visualsearch-style', get_bloginfo('template_directory').'/visualsearch-datauri.css', false, false, 'screen');
wp_enqueue_style('visualsearch-style', get_bloginfo('template_directory').'/visualsearch.css', false, false, 'screen');


?>


<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php the_post(); 
				
				?>
				
				<?php get_template_part( 'content', 'page' ); 
				if ($post->ID==2)
				include('records.php');
				if ($post->ID==16)
				include('approved.php');
				?>
				<?php if ($post->ID==22)
				include('appstatus.php');
				?>
				<?php if ($post->ID==20)
				include('profile.php');
				?>
				<?php if ($post->ID==46)
				include('rejected.php');
				?>

				<?php if ($post->ID==39)
				include('form.php');
				?>
				
			</div><!-- #content -->
		</div><!-- #primary -->
<?php get_footer(); ?>