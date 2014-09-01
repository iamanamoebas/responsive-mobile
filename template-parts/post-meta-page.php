<?php
/**
 * Page Meta-Data Template
 *
 * The template used for displaying page meta data for the pages
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
?>

<header class="entry-header">
	<?php the_title( '<h1 class="entry-title post-title">', '</h1>' ); ?>

	<?php if ( comments_open() ) : ?>
		<div class="post-meta">
			<?php responsive_II_post_meta_data(); ?>
			<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
				<span class="comments-link">
					<span class="mdash">&mdash;</span>
					<?php comments_popup_link( __( 'No Comments &darr;', 'responsive-II' ), __( '1 Comment &darr;', 'responsive-II' ), __( '% Comments &darr;', 'responsive-II' ) ); ?>
				</span>
			<?php endif; ?>
		</div><!-- .post-meta -->
	<?php endif; ?>
</header><!-- .entry-header -->
