<?php
/**
 * Template Name: Archive
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

get_header(); ?>

<main id="content" role="main">

	<article id="post-<?php the_ID(); ?>" itemtype="https://schema.org/BlogPosting" itemscope="" <?php post_class(); ?>>

		<h1 itemprop="name headline"><?php the_title(); ?></h1>

		<?php if ( !empty( get_the_content() ) ): ?>
			<div itemprop="articleBody">
				<?php the_content( __( 'Continue', 'arnexyz' ) ); ?>
			</div>

			<hr>
		<?php endif; ?>

		<section class="search">
			<h2><?php _e( 'Search', 'arnexyz' ); ?></h2>
			<?php get_search_form(); ?>
		</section>

		<section class="tagcloud">
			<h2><?php _e( 'Tags', 'arnexyz' ); ?></h2>
			<?php wp_tag_cloud( array( // @see https://developer.wordpress.org/reference/functions/wp_tag_cloud/
				'number' => 0
			)); ?>
		</section>

		<section class="categories">
			<h2><?php _e( 'Categories', 'arnexyz' ); ?></h2>
			<ul>
				<?php wp_list_categories( array( // @see https://developer.wordpress.org/reference/functions/wp_list_categories/
					'feed'					=> '<abbr title="Really Simple Syndication">RSS</abbr>',
					'show_count'			=> true,
					'title_li'				=> '',
					'use_desc_for_title'	=> true
				)); ?>
			</ul>
		</section>

		<section class="post-formats">
			<h2><?php _e( 'Post Formats', 'arnexyz' ); ?></h2>

			<?php $post_formats = get_post_format_strings(); // @see /wp-includes/post-formats.php ?>

			<ul>
				<?php foreach ( $post_formats as $post_format => $name ): $link = get_post_format_link( $post_format ); ?>
					<?php if ( ! empty( $link ) ): ?>
						<li><a href="<?php echo get_post_format_link( $post_format ); ?>"><?php echo $name; ?></a></li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		</section>

		<?php if ( function_exists( 'compact_archive' ) ): ?>
			<section class="compact-archive">
				<h2><?php _e( 'Archive', 'arnexyz' ); ?></h2>
				<?php compact_archive( $style='block', $before='<p>', $after='</p>' ); ?>
			</section>
		<?php endif; ?>

	</article>
</main>

<?php get_footer(); ?>
