<?php
/**
 * Gallery Sidebar
 *
 * Displays on the image page after clicking on a gallery image
 *
 * @package      ${PACKAGE}
 * @license      license.txt
 * @copyright    ${YEAR} ${COMPANY}
 * @since        ${VERSION}
 *
 * Please do not edit this file. This file is part of the ${PACKAGE} Framework and all modifications
 * should be made in a child theme.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

responsive_II_widgets_before(); // above widgets container hook
?>

	<div id="widgets" class="widget-area gallery-sidebar" role="complementary" itemscope="itemscope"
	     itemtype="http://schema.org/WPSideBar">
		<?php responsive_II_widgets(); // above widgets hook ?>
		<aside class="widget-wrapper">

			<h3 class="widget-title"><?php _e( 'Image Information', 'responsive-II' ); ?></h3>
			<ul>
				<?php $responsive_II_data = get_post_meta( $post->ID, '_wp_attachment_metadata', true ); ?>
				<?php if ( is_array( $responsive_II_data ) ) : ?>
					<span class="full-size"><?php _e( 'Full Size:', 'responsive-II' ); ?> <a
							href="<?php echo wp_get_attachment_url( $post->ID ); ?>"><?php echo $responsive_II_data['width'] . '&#215;' . $responsive_II_data['height']; ?></a>px</span>

					<?php if ( is_array( $responsive_II_data['image_meta'] ) ) : ?>
						<?php if ( $responsive_II_data['image_meta']['aperture'] ) : ?>
							<span
								class="aperture"><?php _e( 'Aperture: f&#47;', 'responsive-II' ); ?><?php echo $responsive_II_data['image_meta']['aperture']; ?></span>
						<?php endif; ?>

						<?php if ( $responsive_II_data['image_meta']['focal_length'] ) : ?>
							<span
								class="focal-length"><?php _e( 'Focal Length:', 'responsive-II' ); ?> <?php echo $responsive_II_data['image_meta']['focal_length']; ?><?php _e( 'mm', 'responsive-II' ); ?></span>
						<?php endif; ?>

						<?php if ( $responsive_II_data['image_meta']['iso'] ) : ?>
							<span
								class="iso"><?php _e( 'ISO:', 'responsive-II' ); ?> <?php echo $responsive_II_data['image_meta']['iso']; ?></span>
						<?php endif; ?>

						<?php if ( $responsive_II_data['image_meta']['shutter_speed'] ) : ?>
							<span class="shutter"><?php _e( 'Shutter:', 'responsive-II' ); ?>
								<?php if ( ( 1 / $responsive_II_data['image_meta']['shutter_speed'] ) > 1 ) {
									echo "1/";
									if ( number_format( ( 1 / $responsive_II_data['image_meta']['shutter_speed'] ), 1 ) == number_format( ( 1 / $responsive_II_data['image_meta']['shutter_speed'] ), 0 ) ) {
										echo number_format( ( 1 / $responsive_II_data['image_meta']['shutter_speed'] ), 0, '.', '' ) . ' sec';
									} else {
										echo number_format( ( 1 / $responsive_II_data['image_meta']['shutter_speed'] ), 1, '.', '' ) . ' sec';
									}
								} else {
									echo $responsive_II_data['image_meta']['shutter_speed'] . ' sec';
								} ?>
							</span>
						<?php endif; ?>

						<?php if ( $responsive_II_data['image_meta']['camera'] ) : ?>
							<span
								class="camera"><?php _e( 'Camera:', 'responsive-II' ); ?> <?php echo $responsive_II_data['image_meta']['camera']; ?></span>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</ul>

		</aside>
		<!-- .widget-wrapper -->
	</div>
	<!-- #widgets -->

<?php if ( ! is_active_sidebar( 'gallery-widget' ) ) {
	return;
} ?>

<?php if ( is_active_sidebar( 'gallery-widget' ) ) : ?>

	<div id="widgets" class="widget-area" role="complementary">

		<?php responsive_II_widgets(); // above widgets hook ?>

		<?php dynamic_sidebar( 'gallery-widget' ); ?>

		<?php responsive_II_widgets_end(); // after widgets hook ?>
	</div>
	<!-- end of #widgets -->
	<?php responsive_II_widgets_after(); // after widgets container hook ?>

<?php endif; ?>