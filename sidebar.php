<?php
/**
 * Sidebar template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?><hr>

<aside class="sidebar primary">

	<?php if ( function_exists( 'dynamic_sidebar' ) && is_active_sidebar( 'sidebar-1' ) ): ?>

		<?php dynamic_sidebar( 'sidebar-1' ); ?>

	<?php endif; ?>

</aside>
