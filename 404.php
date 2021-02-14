<?php
/**
 * Error 404 template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

get_header(); ?>

	<main id="content" role="main">

		<article class="page error404">

			<h1><?php _e( 'Page not found', 'arnexyz' ); ?></h1>

			<!--<p>Insert your error message here</p>-->

			<p><code class="error"><?php _e( 'Error Code 404', 'arnexyz' ); ?></code></p>

		</article>

	</main>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
