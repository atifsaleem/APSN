<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title>
	<?php $the_title = wp_title('', false);
		if ($the_title != '') :
			echo wp_title('',false),' | '; bloginfo('name');
		else :
			bloginfo('name');
			if ($paged > 1) { echo ' - page '.$paged; } else { if ($blogdesc=get_bloginfo('description')) echo ' - '.$blogdesc; }
		endif; ?>
	</title>
	<?php if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script('comment-reply'); ?>
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="nav">
	<div id="menus">
		<ul><li<?php if (is_home()) echo ' class="current_page_item"'; ?>><a href="<?php echo home_url('/'); ?>"><?php _e('Home', 'zbench'); ?></a></li></ul>
		<?php wp_nav_menu( array( 'container' => 'none', 'theme_location' => 'primary' ) ); ?>
	</div>
	<div id="search">
		<?php get_search_form(); ?>
	</div>
</div>
<div id="wrapper">
	<div id="header"><?php global $zbench_options; $logo=''; if($zbench_options['logo_url']!='') $logo=' class="header_logo" style="background:url('.$zbench_options['logo_url'].') no-repeat 0 0"'; ?>
		<h1<?php if($zbench_options['hide_title']!='') echo ' class="hidden"'; ?>><a href="<?php echo home_url('/'); ?>"<?php if($logo) echo $logo; ?>><?php bloginfo('name'); ?></a></h1>
		<h2<?php if($logo || $zbench_options['hide_title']!='') echo ' class="hidden"'; ?>><?php bloginfo('description');?></h2>
		<div class="clear"></div>
		<?php if ( get_header_image() != '' ) : ?>
		<div id="header_image">
			<div id="header_image_border">
				<a href="<?php if($zbench_options['header_image_url']!='') { echo $zbench_options['header_image_url']; } else { echo home_url('/'); } ?>"><img src="<?php header_image(); ?>" width="<?php echo HEADER_IMAGE_WIDTH; ?>" height="<?php echo HEADER_IMAGE_HEIGHT; ?>" alt="" /></a>
			</div>
		</div>
		<?php endif; ?>
	</div>
