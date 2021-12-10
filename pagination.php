<?php
/**
 * Pagination template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?>
<nav class="pagination">

	<?php if ( is_single() ): ?>

		<ul>
			<li rel="prev" class="prev"><?php previous_post_link( '%link' ); ?></li>
			<li rel="next" class="next"><?php next_post_link( '%link' ); ?></li>
		</ul>

	<?php elseif ( $wp_query->max_num_pages > 1 ): ?>

		<ul>
			<li rel="prev" class="prev"><?php next_posts_link( __( 'Past', 'arnexyz' ) ); ?></li>
			<li rel="next" class="next"><?php previous_posts_link( __( 'Future', 'arnexyz' ) ); ?></li>
		</ul>

	<?php endif ?>

</nav>
