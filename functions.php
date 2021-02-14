<?php
/**
 * Template functions
 *
 * @package WordPress
 * @subpackage arnexyz
 * @since arnexyz 1.0.0
 * @author Arne Kamola <arne@arne.xyz>
 */

/**
 * Activate the classic link manager
 *
 * @see https://blog.templatetoaster.com/wordpress-links-manager/
 * @since arnexyz 1.0.0
 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
 * Check if it's CSS Naked Day: April 9th
 * The day is changeable via parameters for debugging purposes.
 *
 * @see https://css-naked-day.github.io
 * @since arnexyz 1.2.0
 * @param int $d Day of the CSS Naked Day
 * @param int $m Month of the CSS Naked Day
 */
function is_css_naked_day( $d = 9, $m = 4 ) {
	$start	= date( 'U', mktime( -12, 0, 0, $m, $d, date('Y') ) );
	$end	= date( 'U', mktime(  36, 0, 0, $m, $d, date('Y') ) );
	$z		= date( 'Z' ) * -1;
	$now	= time() + $z;

	if ( $now >= $start && $now <= $end ) {
		return true;
	}

	return false;
}

/**
 * Check whether a page is a subpage or not
 *
 * @see https://codex.wordpress.org/Conditional_Tags#Testing_for_sub-Pages
 * @since arnexyz 1.0.0
 * @return False or the parent page object
 */
function is_subpage() {
	global $post;

	if ( is_page() && $post->post_parent ) {
		return $post->post_parent;
	} else {
		return false;
	}
}

/**
 * Show a breadcrumb navigation
 *
 * @see http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * @since arnexyz 1.0.0
 */
function arnexyz_breadcrumb() {
	// Settings

	$sep	= '<span class="sep">›</span>';
	$home	= get_bloginfo('name');
	$before	= '<span class="current-page">';
	$after	= '</span>';

	// Generate breadcrumb navigation

	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<p>' . __( 'You are here:' ) . ' ';

		global $post;

		$home_link = get_bloginfo('url');

		echo '<a href="' . $home_link . '">' . $home . '</a> ' . $sep . ' ';

		if ( is_category() ) {
			global $wp_query;

			$cat_obj = $wp_query->get_queried_object();

			$this_cat = $cat_obj->term_id;
			$this_cat = get_category( $this_cat );
			$parentCat = get_category( $this_cat->parent );

			if ( $this_cat->parent != 0 ) {
				echo get_category_parents( $parentCat, $link = true, ' ' . $sep . ' ' );
			}

			echo $before . single_cat_title( '', $print = false ) . $after;
		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a> ' . $sep . ' ';
			echo '<a href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '">' . get_the_time('F') . '</a> ' . $sep . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link( get_the_time('Y') ) . '">' . get_the_time('Y') . '</a> ' . $sep . ' ';
			echo $before . get_the_time('F') . $after;
 		} elseif ( is_year() ) {
 			echo $before . get_the_time('Y') . $after;
 		} elseif ( is_single() && !is_attachment() ) {
 			if ( get_post_type() != 'post' ) {
 				$post_type = get_post_type_object( get_post_type() );

 				$slug = $post_type->rewrite;

 				echo '<a href="' . $home_link . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $sep . ' ';
 				echo $before . get_the_title() . $after;
 			} else {
 				$post_type = get_post_type_object( get_post_type() );

 				$slug = $post_type->rewrite;

 				//if ( is_front_page )
 					echo '<a href="' . get_permalink( get_option('page_for_posts') ) . '">' . __( 'Blog', 'arnexyz' ) . '</a> ' . $sep . ' ';
 				//endif;
 				echo $before . get_the_title() . $after;
 			}
 		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
 			$post_type = get_post_type_object( get_post_type() );

 			echo $before . $post_type->labels->singular_name . $after;
 		} elseif ( is_attachment() ) {
 			$parent = get_post( $post->post_parent );

 			$cat = get_the_category( $parent->ID );
 			$cat = $cat[0];

 			echo get_category_parents( $cat, $link = true, ' ' . $sep . ' ' );
 			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $sep . ' ';
 			echo $before . get_the_title() . $after;
 		} elseif ( is_page() && !$post->post_parent ) {
 			echo $before . get_the_title() . $after;
 		} elseif ( is_page() && $post->post_parent ) {
 			$parent_id = $post->post_parent;

 			$breadcrumbs = array();

 			while ( $parent_id ) {
 				$page = get_page( $parent_id );

 				$breadcrumbs[] = '<a href="' . get_permalink( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a>';

 				$parent_id = $page->post_parent;
 			}

 			$breadcrumbs = array_reverse( $breadcrumbs );

 			foreach ( $breadcrumbs as $crumb ) {
 				echo $crumb . ' ' . $sep . ' ';
 			}

 			echo $before . get_the_title() . $after;
 		} elseif ( is_search() ) {
 			echo $before . __( 'Search results for: "', 'arnexyz' ) . get_search_query() . '"' . $after;
 		} elseif ( is_tag() ) {
 			echo $before . __( 'Posts with the tag "', 'arnexyz' ) . single_tag_title( '', false ) . '"' . $after;
 		} elseif ( is_404() ) {
 			echo $before . __( 'Error 404', 'arnexyz' ) . $after;
 		} elseif ( is_home() ) {
 			echo $before . __( 'Blog', 'arnexyz' ) . $after;
 		}

 		if ( get_query_var('paged') ) {
 			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
 				echo ' (';
 			}

 			echo ': ' . __( 'Page', 'arnexyz' ) . ' ' . get_query_var('paged');

 			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) {
 				echo ')';
 			}
 		}

 		echo '</p>';
 	}
}

/**
 * Remove the brackets around the categories post count
 *
 * @since arnexyz 1.2.0
 * @return string
 */
function arnexyz_categories_postcount_filter( $count ) {
	$count = str_replace('(', '<span class="post_count">', $count);
	$count = str_replace(')', '</span>', $count);

	return $count;
}
add_filter( 'wp_list_categories', 'arnexyz_categories_postcount_filter' );

/**
 * Add custom post status for "retired" posts
 *
 * @see https://wordpress.org/support/article/post-status/#custom-status
 * @since arnexyz 1.2.0
 */
function arnexyz_post_status() {
	register_post_status( 'retired', array(
		'label'						=> _x( 'Retired', 'Status General Name', 'arnexyz' ),
		'label_count'				=> _n_noop( 'Retired <span class="count">(%s)</span>',  'Retired <span class="count">(%s)</span>', 'arnexyz' ),
		// 'public'					=> false,
		'protected'					=> true,
		// 'show_in_admin_all_list'	=> true,
		// 'show_in_admin_status_list'	=> true,
		// 'exclude_from_search'		=> false,
	));
}
add_action( 'init', 'arnexyz_post_status', 0 );

 /**
  * Add custom post status to the "Quick Edit" dropdown
  *
  * @see arnexyz_post_status()
  * @see https://rudrastyh.com/wordpress/custom-post-status-quick-edit.html
  * @since arnexyz 1.2.0
  */
function arnexyz_status_into_inline_edit() { // ultra-simple example
	echo '<script>
	jQuery(document).ready( function($) {
		$( \'select[name="_status"]\' ).append( \'<option value="retired">' . __( 'Retired', 'arnexyz' ) . '</option>\' );
	});
	</script>';
}
add_action( 'admin_footer-edit.php', 'arnexyz_status_into_inline_edit' );

/**
 * Add custom post type to the post status dropdown
 *
 * @see arnexyz_post_status()
 * @since arnexyz 1.2.0
 */
function arnexyz_display_custom_post_status_option() {
	global $post;

	$complete = '';
	$label = '';

	if ( isset( $post ) && $post->post_type == 'post' ) {
		if( $post->post_status == 'retired' ) {
			$selected = 'selected';
		}

		echo '<script>
		jQuery(document).ready( function($) {
			$( \'select#post_status\' ).append( \'<option value="retired" ' . $selected . '>' . __( 'Retried', 'arnexyz' ) . '</option>\' );
			$( \'#post-status-display\' ).text(' . __( 'Retired', 'arnexyz' ) . ');
		});
		</script>';
	}
}
add_action( 'admin_footer', 'arnexyz_display_custom_post_status_option' );

/**
 * Show custom post status label in the post overview
 *
 * @see https://rudrastyh.com/wordpress/custom-post-status-quick-edit.html
 * @since arnexyz 1.2.0
 * @return array
 */
function arnexyz_display_status_label( $statuses ) {
	global $post; // we need it to check current post status

	if ( isset( $post ) && get_query_var( 'post_status' ) != 'retired' ) { // not for pages with all posts of this status
		if ( $post->post_status == 'retired' ) {
			return array( __( 'Retired', 'arnexyz' ) ); // returning our status label
		}
	}

	return $statuses; // returning the array with default statuses
}
add_filter( 'display_post_states', 'arnexyz_display_status_label' );

/**
 * Add custom JavaScript that depends on jQuery.
 *
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
 * @since arnexyz 1.0.0
 */
function arnexyz_js() {
	wp_enqueue_script(
		$handle = 'theme-script',
		$src = get_template_directory_uri() . '/app.js',
		array( 'jquery' ),
		$ver = false,
		$in_footer = true
	);
}
add_action( 'wp_enqueue_scripts', 'arnexyz_js' );

/**
 * WordPress theme features
 *
 * @see https://developer.wordpress.org/reference/functions/add_theme_support/
 * @since arnexyz 1.0.3
 */
function arnexyz_support() {
	// Features
	// @see https://developer.wordpress.org/reference/functions/add_theme_support/#features

	// HTML5
	// @see https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	add_theme_support( 'html5', array(
		'caption',
		'comment-list',
		'comment-form',
		'gallery',
		'search-form'
	));

	// Post Formats
	// @see https://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		'aside',
		'gallery',
		'link',
		'image',
		'quote',
		'status',
		'video',
		'audio',
		'chat'
	));
}
add_action( 'after_setup_theme', 'arnexyz_support' );

/**
 * Add theme menus for the WordPress menu feature
 *
 * @see https://codex.wordpress.org/Function_Reference/register_nav_menu
 * @since arnexyz 1.0.0
 */
function arnexyz_register_menus() {
	if ( function_exists('register_nav_menus') ) {
		register_nav_menus( array(
			'primary'	=> __('Main Navigation', 'arnexyz')
		));
	}
}
add_action( 'after_setup_theme', 'arnexyz_register_menus' );

/**
 * Add theme sidebars for the WordPress widget feature
 *
 * @see https://codex.wordpress.org/Function_Reference/register_sidebars
 * @since arnexyz 1.0.0
 */
function arnexyz_register_sidebars() {
	// Primary
	register_sidebar( array(
		'name'			=> __('Sidebar', 'arnexyz'),
		'id'			=> 'sidebar-1',
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>'
	));

	// Footer
	register_sidebar( array(
		'name'			=> __('Footer', 'arnexyz'),
		'id'			=> 'sidebar-footer',
		'before_widget'	=> '<div class="widget">',
		'after_widget'	=> '</div>'
	));
}
add_action( 'widgets_init', 'arnexyz_register_sidebars' );

/**
 * Remove the WordPress emoji embed
 *
 * @see https://www.denisbouquet.com/remove-wordpress-emoji-code/
 * @since arnexyz 1.0.0
 */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

/**
 * Remove DNS prefetch
 *
 * @see https://fransdejonge.com/2017/11/remove-dns-prefetch-from-wordpress-4-9/
 * @since arnexyz 1.1.0
 */
remove_action( 'wp_head', 'wp_resource_hints', 2 );

/**
 * Remove the generator meta tag with the WordPress version from the HTML for
 * better security.
 *
 * @see https://developer.wordpress.org/reference/hooks/the_generator/
 * @since arnexyz 1.1.0
 * @return string silence is golden ...
 */
function arnexyz_remove_version() {
	return '';
}
add_filter( 'the_generator', 'arnexyz_remove_version' );

/**
 * Replace the default login error message to hide any information that could
 * maybe used for cracking into the system.
 *
 * @see https://codex.wordpress.org/Plugin_API/Filter_Reference/login_errors
 * @since arnexyz 1.0.2
 * @return string Login error message
 */
function arnexyz_wrong_login() {
	return __( 'Wrong username or password.', 'arnexyz' );
}
add_filter( 'login_errors', 'arnexyz_wrong_login' );

/**
 * Don't store IP of commentors
 *
 * @see https://www.wpbeginner.com/wp-tutorials/how-to-stop-storing-ip-address-in-wordpress-comments/
 * @since arnexyz 1.0.0
 * @return string Silence is golden ...
 */
function arnexyz_remove_comments_ip( $comment_author_ip ) {
	return '';
}
add_filter( 'pre_comment_user_ip', 'arnexyz_remove_comments_ip' );

/**
 * Don't store the user agent of commentors
 *
 * @see wp_filter_comment()
 * @since arnexyz 1.0.0
 * @return string Silence is golden ...
 */
function arnexyz_remove_comments_useragent( $comment_author_agent ) {
	return '';
}
add_filter( 'pre_comment_user_agent', 'arnexyz_remove_comments_useragent' );
