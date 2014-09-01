<?php
/**
 * Theme Options Page
 *
 * Additional content for the theme options page
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
 * Theme options upgrade bar
 */
function responsive_II_upgrade_bar() {
	// @TODO Update to new theme upsell structure
	?>

	<div class="upgrade-callout">
		<p><img src="<?php echo get_template_directory_uri(); ?>/core/images/chimp.png" alt="CyberChimps"/>
			<?php printf( __( 'Welcome to %1$s! Upgrade to %2$s today.', 'responsive-II' ),
				'responsive-II',
				'<a href="http://cyberchimps.com/store/responsivepro/" target="_blank" title="Responsive Pro">Responsive Pro</a> '
			); ?>
		</p>

		<div class="social-container">
			<div class="social">
				<a href="https://twitter.com/cyberchimps" class="twitter-follow-button" data-show-count="false" data-size="small">Follow @cyberchimps</a>
				<script>!function (d, s, id) {
						var js, fjs = d.getElementsByTagName(s)[0];
						if (!d.getElementById(id)) {
							js = d.createElement(s);
							js.id = id;
							js.src = "//platform.twitter.com/widgets.js";
							fjs.parentNode.insertBefore(js, fjs);
						}
					}(document, "script", "twitter-wjs");</script>
			</div>
			<div class="social">
				<iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Fcyberchimps.com%2F&amp;send=false&amp;layout=button_count&amp;width=200&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:21px;" allowTransparency="true"></iframe>
			</div>
		</div>
	</div>

<?php
}
//add_action( 'responsive_II_theme_options', 'responsive_II_upgrade_bar', 1 );

/**
 * Theme Options Support and Information
 */
function responsive_II_theme_support() {
	?>

	<div id="info-box-wrapper" class="grid col-940">
		<div class="info-box notice">

			<a class="button" href="<?php echo esc_url( 'http://cyberchimps.com/guides/r-free/' ); ?>" title="<?php esc_attr_e( 'Guides', 'responsive-II' ); ?>" target="_blank">
				<?php _e( 'Instructions', 'responsive-II' ); ?></a>

			<a class="button button-primary" href="<?php echo esc_url( 'http://cyberchimps.com/forum/free/responsive/' ); ?>" title="<?php esc_attr_e( 'Help', 'responsive-II' ); ?>" target="_blank">
				<?php _e( 'Help', 'responsive-II' ); ?></a>

			<a class="button" href="<?php echo esc_url( 'https://webtranslateit.com/en/projects/3598-Responsive-Theme' ); ?>" title="<?php esc_attr_e( 'Translate', 'responsive-II' ); ?>" target="_blank">
				<?php _e( 'Translate', 'responsive-II' ); ?></a>

			<a class="button" href="<?php echo esc_url( 'http://cyberchimps.com/showcase/' ); ?>" title="<?php esc_attr_e( 'Showcase', 'responsive-II' ); ?>" target="_blank">
				<?php _e( 'Showcase', 'responsive-II' ); ?></a>

			<a class="button" href="<?php echo esc_url( 'http://cyberchimps.com/store/' ); ?>" title="<?php esc_attr_e( 'More Themes', 'responsive-II' ); ?>" target="_blank">
				<?php _e( 'More Themes', 'responsive-II' ); ?></a>

		</div>
	</div>

<?php
}
add_action( 'responsive_II_theme_options', 'responsive_II_theme_support', 2 );

/*
 * Add notification to Reading Settings page to notify if Custom Front Page is enabled.
 *
 * @since    1.9.4.0
 */
function responsive_II_front_page_reading_notice() {
	$screen = get_current_screen();
	$responsive_II_options = responsive_II_get_options();
	if ( 'options-reading' == $screen->id ) {
		$html = '<div class="updated">';
			if ( 1 == $responsive_II_options['front_page'] ) {
				$html .= '<p>' . sprintf( __( 'The Custom Front Page is enabled. You can disable it in the <a href="%1$s">theme settings</a>.', 'responsive-II' ), admin_url( 'themes.php?page=theme_options' ) ) . '</p>';
			} else {
				$html .= '<p>' . sprintf( __( 'The Custom Front Page is disabled. You can enable it in the <a href="%1$s">theme settings</a>.', 'responsive-II' ), admin_url( 'themes.php?page=theme_options' ) ) . '</p>';
			}
		$html .= '</div>';
		echo $html;
	}
}
add_action( 'admin_notices', 'responsive_II_front_page_reading_notice' );


function responsive_II_admin_bar_site_menu( $wp_admin_bar ) {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}

	if ( current_user_can( 'edit_theme_options' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 'appearance',
			'id'     => 'theme_options',
			'title'  => __( 'Theme Options', 'responsive-II' ),
			'href'   => admin_url( 'themes.php?page=theme_options' )
		) );
	}
}
add_action( 'admin_bar_menu', 'responsive_II_admin_bar_site_menu', 30 );
