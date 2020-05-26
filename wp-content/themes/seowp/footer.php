<?php
/**
 * The template for displaying the footer.
 *
 * -------------------------------------------------------------------
 *
 * DESCRIPTION:
 *
 * This file outputs the next theme parts:
 *    – Site-wide pre-footer 'Call to action' block
 *    – LiveComposer based footer
 *    – Off-canvas mobile menu ('mobile-offcanvas' widget area)
 *
 * @package    SEOWP WordPress Theme
 * @author     Vlad Mitkovsky <info@lumbermandesigns.com>
 * @copyright  2014 Lumberman Designs
 * @license    GNU GPL, Version 3
 * @link       http://themeforest.net/user/lumbermandesigns
 *
 * -------------------------------------------------------------------
 *
 * Send your ideas on code improvement or new hook requests using
 * contact form on http://themeforest.net/user/lumbermandesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo '</div><!-- .site-main -->'; // opened in the header.php.

if ( lbmn_livecomposer_installed() && LBMN_THEME_CONFUGRATED ) {
	if ( function_exists( 'dslc_hf_get_footer' ) ) {
		// ✅ Live Composer plugin function. Escaped by the plugin.
		echo dslc_hf_get_footer();
	}
} else {
	// The functions below called only if Live Composer isn't active or configured.
	echo lbmn_footer_default_escaped();
}

/**
 * ----------------------------------------------------------------------
 * Off-canvas mobile menu panel ('mobile-offcanvas' widget area)
 */

// Disable Off-canvas panel while editing mode in Live Composer.
if ( ! lbmn_livecomposer_editing_mode() && lbmn_updated_from_first_generation() ) {
	if ( get_theme_mod( 'lbmn_advanced_off_canvas_mobile_menu', 1 ) ) : ?>
		<a href="#" class="off-canvas__overlay exit-off-canvas">&nbsp;</a>
		<aside class="right-off-canvas-menu off-canvas-area">
			<?php if ( is_active_sidebar( 'mobile-offcanvas' ) ) : /* Mobile off-canvas */ ?>
				<div class="close-offcanvas">
					<a class="right-off-canvas-toggle" href="#"><i aria-hidden="true" class="lbmn-icon-cross"></i>
						<span>close</span></a>
				</div>
				<?php dynamic_sidebar( 'mobile-offcanvas' ); ?>
			<?php endif; ?>
		</aside>
		<?php
	endif;
} // End if(). ?>

		</div><!--  .global-wrapper -->
	</div><!-- .global-container -->
</div><!-- .off-canvas-wrap -->

<?php wp_footer(); ?>
</body>
</html>
