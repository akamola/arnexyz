<?php
/**
 * Footer template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

// Get theme options
$theme_options = get_option( 'arnexyz_theme_options' );

?>
	<hr>

	<footer role="contentinfo">

		<?php if ( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'sidebar-footer' ) ): ?>

			<?php dynamic_sidebar( 'sidebar-footer' ); ?>

		<?php endif; ?>

		<p>
			<?php bloginfo('name'); ?>
			<span class="sep">·</span>
			<?php echo arnexyz_get_first_post_date(); ?>–<?php echo date('Y'); ?>
			<?php if ( isset( $theme_options['show_cc_license'] ) ): ?>
				<?php if ( in_array( 'creative-commons/creativecommons.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ): ?>
					<?php $cc_license = get_option('license'); ?>
					[ <a href="<?php echo $cc_license['deed'] ?>" rel="license" lang="en"><abbr title="<?php echo $cc_license['name'] ?>">CC <?php echo strtoupper( $cc_license['choice'] ); ?></abbr></a> ]
				<?php endif; ?>
			<?php endif; ?>
			<?php if ( isset( $theme_options['show_rss_link'] ) ): ?>
				[ <a href="<?php bloginfo('rss2_url'); ?>"><abbr title="Really Simple Syndication">RSS</abbr></a> ]
			<?php endif; ?>
			<?php if ( isset( $theme_options['show_html_validation_link'] ) ): ?>
				[ <a href="https://validator.w3.org/check?uri=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Valid <abbr title="HyperText Markup Language">HTML</abbr> 5</a> ]
			<?php endif; ?>
			<?php if ( isset( $theme_options['show_css_validation_link'] ) ): ?>
				[ <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Valid <abbr title="Cascading Style Sheets">CSS</abbr> 3</a> ]
			<?php endif; ?>
		</p>
	</footer>

<?php wp_footer(); ?>

</body>
</html>