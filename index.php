<?php
/**
 * Main template
 *
 * @see https://wphierarchy.com
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

get_header(); ?>

	<main id="content" role="main">

		<?php if ( is_archive() || is_search() ): // Show headline and breadcrumb on archive pages ?>
			<header>

				<?php if ( is_category() ): ?>

					<h1><?php single_cat_title(); ?></h1>

					<?php if ( !empty( category_description() ) ): ?>
						<aside class="description">
							<?php echo category_description(); ?>
						</aside>
					<?php endif; ?>

				<?php elseif ( is_tag() ): ?>

					<h1><?php single_tag_title( $prefix = '#' ); // @see https://developer.wordpress.org/reference/functions/single_tag_title/ ?></h1>

					<?php if ( !empty( tag_description() ) ): ?>
						<aside class="description">
							<?php echo tag_description(); ?>
						</aside>
					<?php endif; ?>

				<?php elseif ( is_tax( 'post_format' ) ): // @see https://developer.wordpress.org/reference/functions/is_tax/#comment-807 ?>

					<h1><?php printf( __( 'All %s', 'arnexyz' ), get_the_archive_title() ); // Translatable string with placeholder, @see https://wordpress.stackexchange.com/a/114203 ?></h1>

				<?php elseif ( is_author() ): ?>

					<h1><?php printf( __( 'All posts of %s', 'arnexyz' ), get_the_author() ); ?></h1>

					<?php if ( !empty( get_the_author_meta( 'description' ) ) ): ?>
						<aside class="description">
							<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>
						</aside>
					<?php endif; ?>

				<?php elseif ( is_year() ): ?>

					<h1><?php printf( __( 'In the year of %s', 'arnexyz' ), get_query_var('year') ); ?></h1>

				<?php elseif ( is_month() ): ?>

					<h1><?php single_month_title( $sep = ' ' ); ?></h1>

				<?php elseif ( is_day() ): ?>

					<h1><?php echo get_the_archive_title(); ?></h1>

				<?php elseif ( is_search() ): ?>

					<h1><?php printf( __( 'Results for: %s', 'arnexyz' ), get_search_query() ); ?></h1>

				<?php else: ?>

					<h1><?php echo get_the_archive_title(); ?></h1>

				<?php endif; ?>

				<nav class="breadcrumb">
					<?php arnexyz_breadcrumb(); ?>
				</nav>

			</header>
		<?php endif; ?>

		<?php // Posts aka. The Loop
			if ( have_posts() ) {
				while ( have_posts() ) { the_post();
					get_template_part( 'post' ); // @see post.php
				}
			}
		?>

		<?php // Pagination
			if ( !is_page() ) { // Don't show pagination on single pages
				$prev_link = get_previous_posts_link();
				$next_link = get_next_posts_link();

				// Only show pagination if there are more pages
				if ( is_single() || $prev_link || $next_link ) {
					get_template_part( 'pagination' ); // @see pagination.php
				}
			}
		?>

	</main>

	<?php // Sidebar
		if ( !is_single() && !is_page() ) { // Only show sidebar the blog page
			get_sidebar(); // @see sidebar.php
		}
	?>

<?php get_footer(); ?>
