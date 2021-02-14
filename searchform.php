<?php
/**
 * Search field template
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

?><form role="search" method="get" class="search-form" action="<?php echo bloginfo('url'); ?>">
	<label>
		<span class="screen-reader-text"><?php _e( 'Search:', 'arnexyz' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php _e( 'Search for&#160;&hellip;', 'arnexyz' ); ?>" value="<?php echo get_search_query() ?>" name="s" />
	</label>
	<button type="submit" class="search-submit"><span class="screen-reader-text"><?php _e( 'Search', 'arnexyz' ) ?></span></button>
</form>
