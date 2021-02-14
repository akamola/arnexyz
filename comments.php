<?php
/**
 * Comment area template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?><aside id="comments">

	<?php if ( have_comments() ): ?>

		<?php wp_list_comments(); ?>

	<?php endif; ?>

	<?php comment_form(); ?>

</aside>
