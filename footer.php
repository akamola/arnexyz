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
			2009–<?php echo date('Y'); ?>
			[ <a href="https://validator.w3.org/check?uri=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Valid HTML 5</a> ]
			[ <a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Valid CSS 3</a> ]
		</p>
	</footer>

<?php wp_footer(); ?>

</body>
</html>