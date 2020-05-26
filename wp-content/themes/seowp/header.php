<?php
/**
 * The template for displaying the website header.
 *
 * -------------------------------------------------------------------
 *
 * DESCRIPTION:
 * Outputs all head of the page including notifications and site header
 *    – <head> section
 *    – Warning messages for the website admin
 *    – Notification panel
 *    – Top Bar (menu location: 'topbar' )
 *    – Site header with Mega Menu
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
} ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="off-canvas-wrap">
	<div class="site global-container inner-wrap" id="global-container">
		<div class="global-wrapper">
			<?php
			do_action( 'before' );

			/**
			 * Output Live Composer powered headers only when:
			 * – Live Composer installed
			 * – Theme Configuration (basic header/footer import) completed.
			 * In all other cases output simplified version of the header.
			 */
			if ( lbmn_livecomposer_installed() && LBMN_THEME_CONFUGRATED ) {
				if ( function_exists( 'dslc_hf_get_header' ) ) {
					// ✅ Live Composer plugin function. Escaped by the plugin.
					echo dslc_hf_get_header();
				}
			} else {
				// Prepare custom header classes.
				$custom_header_classes = '';
				$custom_header_classes .= 'mega_main_menu-disabled';
				?>
				<header class="site-header <?php echo esc_attr( $custom_header_classes ); ?>" role="banner">
				<?php
				// Show header only if LC isn't active
				if ( defined('DS_LIVE_COMPOSER_ACTIVE') && DS_LIVE_COMPOSER_ACTIVE ) {
					esc_attr_e( 'The header is disabled when editing the page.', 'seowp' );
				} else {
					?><div class="default-topbar"><?php
					echo '<p class="tagline">' . esc_html( get_bloginfo( 'description' ) ) . '</p>';
					// Disable menu for editing mode in Live Composer.
					if ( has_nav_menu( 'topbar' ) ) {
						// If 'header-menu' location has a menu assigned.
						wp_nav_menu( array(
							'theme_location' => 'topbar',
							'container_class' => 'topbar-menu',
						) );
					} else {
						if ( current_user_can( 'install_themes' ) ) {
							echo '<div class="no-menu-set">';
							esc_attr_e( 'Set Menu', 'seowp' );
							echo '</div>';
						}
					}?>
					</div>
					<div class="default-header-content"><?php
					// Add logo if Mega Main Menu plugin is disabled
					// NOTE: logo displayed by Mega Main Menu.
					echo lbmn_logo_escaped();

					/**
					 * ----------------------------------------------------------------------
					 * Site header with Mega Menu
					 * menu location 'header-menu' with Mega Main Menu inside
					 */

					// Disable menu for editing mode in Live Composer.
					if ( has_nav_menu( 'header-menu' ) ) {
						// If 'header-menu' location has a menu assigned.
						wp_nav_menu( array(
							'theme_location' => 'header-menu',
							'container_class' => 'header-top-menu',
						) );
					} else {
						if ( current_user_can( 'install_themes' ) ) {
							echo '<div class="no-menu-set">';
							esc_attr_e( 'Set Menu', 'seowp' );
							echo '</div>';
						}
					}
					?></div><!-- default-header-content --><?php
				}
				?></header><!-- #masthead --><?php
			} ?>
			<div class="site-main">
