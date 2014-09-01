<?php
/**
 * Theme Layout
 *
 * Set for the theme structure and grid
 *
 * @package      ${PACKAGE}
 * @license      license.txt
 * @copyright    ${YEAR} ${COMPANY}
 * @since        ${VERSION}
 *
 * Please do not edit this file. This file is part of the ${PACKAGE} Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Get current layout
 */
function responsive_II_get_layout() {

	if ( is_404() ) {
		return 'default';
	}

	$layout = '';
	$responsive_II_options = responsive_II_get_options();
	$valid_layouts      = responsive_II_valid_layouts();

	/* For singular pages, get post meta */
	if ( is_singular() ) {
		global $post;
	}
	/* Static pages */
	if ( is_page() ) {
		$page_template = get_page_template_slug( $post->ID );

		/* If custom page template is default, use page template first */
		if ( in_array( $page_template, array( 'page-templates/blog.php', 'page-templates/blog-excerpt.php' ) ) ) {
			if ( 'default' == $responsive_II_options['blog_posts_index_layout_default'] ) {
				$layout = basename( $page_template, '.php');
			} else {
				$layout = $responsive_II_options['blog_posts_index_layout_default'];
			}

		} else {
			// If page is set to default then display default layout
			if ( '' == $page_template ) {
				$layout = $responsive_II_options['static_page_layout_default'];
			}
			// Otherwise get the page template
			else {
				$layout = basename( $page_template, '.php');
			}
		}

	} /* Single blog posts */
	elseif ( is_single() ) {
		$layout_meta_value = ( false != get_post_meta( $post->ID, '_responsive_II_layout', true ) ? get_post_meta( $post->ID, '_responsive_II_layout', true ) : 'default' );
		$layout_meta       = ( array_key_exists( $layout_meta_value, $valid_layouts ) ? $layout_meta_value : 'default' );

		/* If post custom meta is set, use it */
		if ( 'default' != $layout_meta ) {
			$layout = $layout_meta;
		} /* Else, use the default */
		else {
			$layout = $responsive_II_options['single_post_layout_default'];
		}

	} else {
		/* Posts index */
		if ( is_home() || is_archive() || is_search() ) {
			$layout = $responsive_II_options['blog_posts_index_layout_default'];
		} /* Fallback */
		else {
			$layout = 'default';
		}

	}

	$layout = apply_filters( 'responsive_II_get_layout', $layout );

	return esc_attr( $layout );
}

/**
 * Add Layout Meta Box
 *
 * @link    http://codex.wordpress.org/Function_Reference/_2            __()
 * @link    http://codex.wordpress.org/Function_Reference/add_meta_box    add_meta_box()
 */
function responsive_II_add_layout_meta_box( $post ) {
	global $post, $wp_meta_boxes;

	$context  = apply_filters( 'responsive_II_layout_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$priority = apply_filters( 'responsive_II_layout_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

	add_meta_box(
		'responsive_II_layout',
		__( 'Layout', 'responsive-II' ),
		'responsive_II_layout_meta_box',
		'post',
		$context,
		$priority
	);
}
// Hook meta boxes into 'add_meta_boxes'
add_action( 'add_meta_boxes', 'responsive_II_add_layout_meta_box' );

/**
 * Define Layout Meta Box
 *
 * Define the markup for the meta box
 * for the "layout" post custom meta
 * data. The metabox will consist of
 * radio selection options for "default"
 * and each defined, valid layout
 * option for single blog posts or
 * static pages, depending on the
 * context.
 *
 * @uses    responsive_II_get_option_parameters()    Defined in \functions\options.php
 * @uses    checked()
 * @uses    get_post_custom()
 */
function responsive_II_layout_meta_box() {
	global $post;
	$custom        = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$layout        = ( isset( $custom['_responsive_II_layout'][0] ) ? $custom['_responsive_II_layout'][0] : 'default' );
	$valid_layouts = responsive_II_valid_layouts();
	?>
	<p>
		<select name="_responsive_II_layout">
		<?php foreach( $valid_layouts as $slug => $name ) { ?>
			<?php $selected = selected( $layout, $slug, false ); ?>
			<option value="<?php echo $slug; ?>" <?php echo $selected; ?>><?php echo $name; ?></option>
		<?php } ?>
		</select>
	</p>
<?php
}

/**
 * Validate, sanitize, and save post metadata.
 *
 * Validates the user-submitted post custom
 * meta data, ensuring that the selected layout
 * option is in the array of valid layout
 * options; otherwise, it returns 'default'.
 *
 * @link    http://codex.wordpress.org/Function_Reference/update_post_meta    update_post_meta()
 *
 * @link    http://php.net/manual/en/function.array-key-exists.php            array_key_exists()
 *
 * @uses    responsive_II_get_option_parameters()    Defined in \functions\options.php
 */
function responsive_II_save_layout_post_metadata() {
	global $post;
	if ( !isset( $post ) || !is_object( $post ) ) {
		return;
	}
	$valid_layouts = responsive_II_valid_layouts();
	$layout        = ( isset( $_POST['_responsive_II_layout'] ) && array_key_exists( $_POST['_responsive_II_layout'], $valid_layouts ) ? $_POST['_responsive_II_layout'] : 'default' );

	update_post_meta( $post->ID, '_responsive_II_layout', $layout );
}

// Hook the save layout post custom meta data into
// publish_{post-type}, draft_{post-type}, and future_{post-type}
add_action( 'publish_post', 'responsive_II_save_layout_post_metadata' );
add_action( 'publish_page', 'responsive_II_save_layout_post_metadata' );
add_action( 'draft_post', 'responsive_II_save_layout_post_metadata' );
add_action( 'draft_page', 'responsive_II_save_layout_post_metadata' );
add_action( 'future_post', 'responsive_II_save_layout_post_metadata' );
add_action( 'future_page', 'responsive_II_save_layout_post_metadata' );
