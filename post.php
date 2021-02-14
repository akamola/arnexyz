<?php
/**
 * Single post template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?><article id="post-<?php the_ID(); ?>" itemtype="https://schema.org/BlogPosting" itemscope="" <?php post_class(); ?>>

	<?php if ( !is_page() ): ?>
		<header>
	<?php endif; ?>

		<h1 itemprop="name headline"><?php if ( !is_singular() ): ?><a href="<?php the_permalink(); ?>" itemprop="url" rel="bookmark"><?php endif; ?><?php the_title(); ?><?php if ( !is_singular() ): ?></a><?php endif; ?></h1>

		<?php if ( !is_page() ): ?>
			<aside class="meta">
				<p><time datetime="<?php echo get_the_date('Y-m-d\TH:i'); ?>" itemprop="datePublished"><span class="date"><?php echo get_the_date( get_option('date_format') ); ?></span>, <span class="time"><?php the_time( get_option('time_format') ); ?></span></time> · <?php _e( 'by', 'arnexyz' ) ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" itemtype="https://schema.org/Person" itemscope="" itemprop="author"><span itemprop="name"><?php the_author(); ?></span></a></p>
			</aside>
		<?php endif; ?>

	<?php if ( !is_page() ): ?>
		</header>
	<?php endif; ?>

	<div itemprop="articleBody">
		<?php the_content( __( 'Continue', 'arnexyz' ) ); ?>
	</div>

	<?php if ( !is_page() ): ?>
		<footer class="meta">

			<p>
				<span class="cat"><?php _e( 'In', 'arnexyz' ); ?>: <span itemprop="articleSection"><?php the_category(', '); ?></span></span>
				<?php if ( has_post_format() ): ?>
					<span class="sep">·</span>
					<a href="<?php echo get_post_format_link( get_post_format() ); ?>"><?php echo get_post_format_string( get_post_format() ); ?></a>
				<?php endif; ?>
				<?php if ( has_tag() ): ?>
					<span class="sep">·</span>
					<span class="tags"><?php the_tags( __( 'Tags: ', 'arnexyz' ), '<span class="sep">, </span>' ); ?></span>
				<?php endif; ?>
			</p>

			<?php if ( !is_singular() && comments_open() ): ?>
				<p class="comments-info">
					<?php comments_popup_link(
						__( '<span class="count">0<span> Comments</span>', 'arnexyz' ),
						__( '<span class="count">1<span> Comment</span></span>', 'arnexyz' ),
						__( '<span class="count">%<span> Comments</span></span>', 'arnexyz' ),
						$css_class = 'comments'
					); ?>
				</p>
			<?php endif; ?>

		</footer>
	<?php endif; ?>

</article>

<?php if ( !is_page() && comments_open() ): ?>

	<?php comments_template(); ?>

<?php endif; ?>
