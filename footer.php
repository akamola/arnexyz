<?php
/**
 * Footer template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?>
	<hr>

	<footer role="contentinfo">

		<?php if ( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'sidebar-footer' ) ): ?>

			<?php dynamic_sidebar( 'sidebar-footer' ); ?>

		<?php endif; ?>

		<p>
			<?php bloginfo('name'); ?>
			<span class="sep">·</span>
			2009–<?php echo date('Y'); ?>
			[ <a href="https://creativecommons.org/licenses/by-sa/4.0/" rel="license" lang="en"><abbr title="Creative Commons: Attribution-ShareAlike 4.0 International">CC BY-SA 4.0</abbr></a> ]
			[ <a href="<?php bloginfo('rss2_url'); ?>"><abbr title="Really Simple Syndication">RSS</abbr></a> ]
			[ <a href="https://validator.w3.org/check?uri=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Valid <abbr title="HyperText Markup Language">HTML</abbr> 5</a> ]
			[ <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Valid <abbr title="Cascading Style Sheets">CSS</abbr> 3</a> ]
		</p>
	</footer>

<?php wp_footer(); ?>

</body>
</html>