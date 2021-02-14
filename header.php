<?php
/**
 * Header template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<title><?php wp_title( $sep = '›', $display = true, $seplocation = 'right' ); bloginfo('name'); ?><?php if ( is_front_page() ) { echo ' &#8226; '; bloginfo('description'); } ?></title>

	<meta name="viewport" content="width=device-width, user-scalable=yes">

	<?php if ( is_css_naked_day() ): ?>
	<!-- It's CSS Naked Day! Praise CSS and good structured HTML! https://css-naked-day.github.io -->
	<?php else: ?>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="all">
	<?php endif; ?>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/arnexyz.png">

	<link href="<?php echo get_template_directory_uri(); ?>/assets/arnexyz.png" rel="apple-touch-icon">

	<meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/assets/arnexyz.png">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/assets/arnexyz.png">
	<meta name="msapplication-TileColor" content="#FFF">
	<meta name="application-name" content="<?php bloginfo('name'); ?>">

	<link rel="pavatar" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/arnexyz.png">

	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?>" href="<?php bloginfo('atom_url'); ?>">

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

	<p id="jumper"><a href="#content">[ <?php _e( 'Jump to content', 'arnexyz' ); ?> ]</a></p>

	<header>

		<h1><?php if ( !is_front_page() || is_paged() ): ?><a href="<?php echo home_url(); ?>"><?php endif; ?><?php bloginfo('name'); ?><?php if ( !is_front_page() || is_paged() ): ?></a><?php endif; ?></h1>

		<p class="tagline"><?php bloginfo('description'); ?></p>

		<?php if ( has_nav_menu('primary') ): ?>

			<?php wp_nav_menu( array(
				'theme_location' => 'primary',
				'container' => 'nav',
				'container_id' => 'primary-nav'
			)); ?>

		<?php endif; ?>

	</header>

	<hr>
