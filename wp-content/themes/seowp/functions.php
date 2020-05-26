<?php
/**
 * The template for displaying the footer.
 *
 * -------------------------------------------------------------------
 *
 * DESCRIPTION:
 *
 * This file used to call almost all other PHP scripts and libraries needed.
 * The file contains some of the primary functions to set main theme settings.
 * All bundled plugins are also called from here using TGMPA class.
 *
 * @package    SEOWP WordPress Theme
 * @author     Vlad Mitkovsky <info@lumbermandesigns.com>
 * @copyright  2014 Lumberman Designs
 * @license    GNU GPL, Version 3
 * @link       http://lumbermandesigns.com
 *
 * -------------------------------------------------------------------
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'SEOWP_THEME_VER', '2.1' );

/**
 * -----------------------------------------------------------------------------
 * Theme PHP scripts and libraries includes
 */

$theme_dir               = get_template_directory();
$plugins_integration_dir = $theme_dir . '/inc/plugins-integration';

require_once( ABSPATH . 'wp-admin/includes/plugin.php' ); // 1.
require_once( $theme_dir . '/design/functions-themedefaults.php' ); // 2.
require_once( $theme_dir . '/inc/functions-extras.php' ); // 3.

// Plugin integrations.
require_once( $plugins_integration_dir . '/plugins-installation/class-tgm-plugin-activation.php' ); // 4.
require_once( $theme_dir . '/inc/installer/vendor/autoload.php' );
require_once( $theme_dir . '/inc/installer/class-merlin.php' );
require_once( $theme_dir . '/inc/installer-config.php' );
require_once( $theme_dir . '/inc/installer-filters.php' );


require_once( $plugins_integration_dir . '/metaboxes.php' ); // 6.
require_once( $plugins_integration_dir . '/livecomposer.php' ); // 7.
require_once( $plugins_integration_dir . '/essb.php' );
require_once( $plugins_integration_dir . '/estimation-form.php' );

if ( lbmn_updated_from_first_generation() ) {
	require_once( $plugins_integration_dir . '/megamainmenu/megamainmenu.php' );   // 9.
}
require_once( $plugins_integration_dir . '/masterslider.php' );    // 10.
require_once( $plugins_integration_dir . '/rankie.php' );         // 10.1.
require_once( $plugins_integration_dir . '/ninja-forms.php' );  // 10.3.
require_once( $theme_dir . '/inc/customizer/customized-css.php' );         // 12.
require_once( $theme_dir . '/inc/functions-ini.php' );                   // 14.
require_once( $theme_dir . '/inc/customizer/customizer.php' );         // 16.
require_once( $theme_dir . '/inc/functions-nopluginsinstalled.php' );// 18.

require_once( $theme_dir . '/inc/themeupdate/theme-update.php' );      // 20.
require_once( $theme_dir . '/inc/themeupdate/theme-update-19.php' );   // 20.b.

/**
 *  1.
 *  2. Import theme default settings ( make sure theme defaults are the first
 *     among other files to include !!! )
 *  3. Some extra functions that can be used by any of theme template files
 *
 *  4. TGMP class for plugin install and updates (modified http://goo.gl/frBZcL)
 *  5. ---
 *  6. Framework used to create custom meta boxes
 *  7. LiveComposer plugin integration
 *  9. Mega Main Menu plugin integration
 *  10. Master Slider plugin integration
 *  10.1. WordPress Rankie plugin integration
 *  10.2. -reserved-
 *  10.3. Ninja-Forms plugin integration
 *
 *  11. Header design presets class (used in Theme Customizer)
 *  12. Custom CSS generator (based on Theme Customizer options)
 *  13. On theme activation installation functions
 *  14. Functions called on theme initialization
 *  15. Creates admin page used by modal window with all custom icons listed
 *  16. All Theme Customizer magic
 *
 *  17. Widget Importer Functions (based on Widget_Importer_Exporter plugin)
 *  18. Functions to be used when not all required plugins installed
 *  20. Custom functions that do some stuff during complex/big theme updates
 */

/**
 * ----------------------------------------------------------------------
 * Setup some of the theme settings
 *
 * http://codex.wordpress.org/Plugin_API/Action_Reference
 *
 * Generally used to initialize theme settings/options.
 * This is the first action hook available to themes,
 * triggered immediately after the active theme's functions.php
 * file is loaded. add_theme_support() should be called here,
 * since the init action hook is too late to add some features.
 * At this stage, the current user is not yet authenticated.
 */
add_action( 'after_setup_theme', 'lbmn_setup' ); // Bind theme setup callback.

if ( ! function_exists( 'lbmn_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 */
	function lbmn_setup() {
		load_theme_textdomain( 'seowp', get_template_directory() . '/languages' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'custom-logo' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );

		// Here we define menu locations available.
		register_nav_menus( array(
			'topbar'      => esc_html__( 'Top Bar', 'seowp' ),
			'header-menu' => esc_html__( 'Main Menu', 'seowp' ),
			// Please note: Mobile off-canvas menu is widget area not menu location.
		) );

		// Gutenberg compatibility.
		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		add_editor_style( 'style-editor.css' ); // Load CSS on the editor screen.

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'seowp' ),
					'shortName' => esc_html__( 'S', 'seowp' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => esc_html__( 'Normal', 'seowp' ),
					'shortName' => esc_html__( 'M', 'seowp' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'seowp' ),
					'shortName' => esc_html__( 'L', 'seowp' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'seowp' ),
					'shortName' => esc_html__( 'XL', 'seowp' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		$link_color = get_theme_mod( 'lbmn_typography_link_color', LBMN_TYPOGRAPHY_LINK_COLOR_DEFAULT );

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => esc_html__( 'Primary', 'seowp' ),
					'slug'  => 'primary',
					'color' => $link_color,
				),
				array(
					'name'  => esc_html__( 'Secondary', 'seowp' ),
					'slug'  => 'secondary',
					'color' => '#A2C438',
				),
				array(
					'name'  => esc_html__( 'Blue', 'seowp' ),
					'slug'  => 'blue',
					'color' => '#1E5181',
				),
				array(
					'name'  => esc_html__( 'Dark Gray', 'seowp' ),
					'slug'  => 'dark-gray',
					'color' => '#282D30',
				),
				array(
					'name'  => esc_html__( 'Light Gray', 'seowp' ),
					'slug'  => 'light-gray',
					'color' => '#9BA0A2',
				),
				array(
					'name'  => esc_html__( 'White', 'seowp' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/**
		 * -----------------------------------------------------------------------------
		 * Set the content width based on the theme's design.
		 */
		if ( ! isset( $content_width ) ) {
			$content_width = LBMN_CONTENT_WIDTH;
		}
	}

endif; // lbmn_setup.

/**
 * ------------------------------------------------------------------------------
 * Register the required plugins for this theme.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function lbmn_register_required_plugins() {
	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins_paths = LBMN_INSTALLER . LBMN_PLUGINS;
	$plugins = array(
		// Include amazing 'Live Composer' plugin pre-packaged with a theme.
		array(
			'name'               => 'Live Composer',
			'slug'               => 'live-composer-page-builder',
			'required'           => true,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
		),

		// Include 'Live Composer - Extensions' premium plugin pre-packaged with our theme.
		array(
			'name'               => 'Live Composer - Extensions',
			'slug'               => 'lc-extensions',
			'source'             => $plugins_paths . 'lc-extensions.1.2.zip',
			'required'           => true,
			'version'            => '1.2',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
		),

		// Include 'MasterSlider' plugin pre-packaged with a theme
		// http://codecanyon.net/item/master-slider-wordpress-responsive-touch-slider/7467925?ref=lumbermandesigns.
		array(
			'name'     			 => 'MasterSlider',
			'slug'     			 => 'masterslider',
			'source'   			 => $plugins_paths . 'masterslider.30.2.14.zip',
			'required' 			 => false,
			'version' 			 => '30.2.14',
			'force_activation' 	 => false,
			'force_deactivation' => false,
			'external_url' 		 => '',
		),

		// Include 'Ninja Forms' plugin pre-packaged with a theme
		// https://wordpress.org/plugins/ninja-forms/.
		array(
			'name'               => 'Ninja Forms',
			'slug'               => 'ninja-forms',
			'required'           => false,
			'version'            => '',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
		),

		// Include 'Ninja Forms Newsletter Opt-ins' premium plugin pre-packaged with our theme
		// http://codecanyon.net/item/ninja-forms-newsletter-optins/10789725/?ref=lumbermandesigns.
		array(
			'name'     			 => 'Ninja Forms MailChimp Opt-ins',
			'slug'     			 => 'ninja-forms-mailchimp-optins',
			'source'   			 => $plugins_paths . 'ninja-forms-mailchimp-optins.30.2.0.zip',
			'required' 			 => false,
			'version' 			 => '30.2.0',
			'force_activation' 	 => false,
			'force_deactivation' => false,
			'external_url' 		 => '',
		),

		// Include 'Ninja Forms PayPal Standard Payment Gateway' premium plugin pre-packaged with our theme
		// http://codecanyon.net/item/ninja-forms-paypal-standard-payment-gateway/10047955/?ref=lumbermandesigns.
		array(
			'name'     			 => 'Ninja Forms PayPal Standard Payment Gateway',
			'slug'     			 => 'ninja-forms-paypal-standard',
			'source'   			 => $plugins_paths . 'ninja-forms-paypal-standard.3.2.zip',
			'required' 			 => false,
			'version' 			 => '3.2',
			'force_activation' 	 => false,
			'force_deactivation' => false,
			'external_url' 		 => '',
		),

		// Include 'Easy Social Share Buttons for WordPress' plugin pre-packaged with a theme
		// http://codecanyon.net/item/easy-social-share-buttons-for-wordpress/6394476?ref=lumbermandesigns.
		array(
			'name'     			 => 'Easy Social Share Buttons for WordPress',
			'slug'     			 => 'easy-social-share-buttons3',
			'source'   			 => $plugins_paths . 'easy-social-share-buttons3.60.2.9.zip',
			'required' 			 => false,
			'version' 			 => '60.2.9',
			'force_activation' 	 => false,
			'force_deactivation' => false,
			'external_url' 		 => '',
		),

		// Include 'WP Cost Estimation & Payment Forms Builder' plugin pre-packaged with a theme
		// https://codecanyon.net/item/wp-cost-estimation-payment-forms-builder/7818230?ref=lumbermandesigns
		array(
			'name'     			 => 'WP Cost Estimation & Payment Forms Builder',
			'slug'     			 => 'estimation-form',
			'source'   			 => $plugins_paths . 'wp-estimation-payment-forms-builder.90.672.zip',
			'required' 			 => false,
			'version' 			 => '90.672',
			'force_activation' 	 => false,
			'force_deactivation' => false,
			'external_url' 		 => '',
		),
	);

	/* Some of the plugins not used anymore in second generation of the theme */
	if ( lbmn_updated_from_first_generation() ) {
		// Include 'Mega Main Menu' plugin pre-packaged with a theme
		// http://codecanyon.net/item/mega-main-menu-wordpress-menu-plugin/6135125?ref=lumbermandesigns.
		$plugins[] = array(
			'name'     			 => 'Mega Main Menu',
			'slug'     			 => 'mega_main_menu',
			'source'   			 => $plugins_paths . 'mega-main-menu.20.1.8.zip',
			'required' 			 => true,
			'version' 			 => '20.1.8',
			'force_activation' 	 => false,
			'force_deactivation' => false,
			'external_url' 		 => '',
		);
	}

	/**
	 * Array of configuration settings.
	 */
	$config = array(
		'id'           => 'lbmn',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'install-required-plugins', // Menu slug.
		'has_notices'  => true,                   // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is installed but inactive: %1$s.', 'The following required plugins are installed but inactive: %1$s.', 'seowp' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is installed but inactive: %1$s.', 'The following recommended plugins are installed but inactive: %1$s.', 'seowp' ),
		),
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'lbmn_register_required_plugins' );


if ( ! defined( 'LBMN_THEME_CONFUGRATED' ) ) {
	if ( get_option( LBMN_THEME_NAME . '_basic_config_done' ) ) {
		define( 'LBMN_THEME_CONFUGRATED', true );
	} else {
		define( 'LBMN_THEME_CONFUGRATED', false );
	}
}

/**
 * ----------------------------------------------------------------------
 * WPML integration
 */

add_action( 'current_screen', 'lbmn_wpml_integration' );
function lbmn_wpml_integration( $current_screen ) {

	if ( 'wpml-string-translation/menu/string-translation' === $current_screen->id ) {

		// Register single strings form the Customizer for WPML translation in WP > WPML > Strings Translation
		// @reference https://wpml.org/wpml-hook/wpml_register_string_for_translation/
		do_action( 'wpml_register_single_string', 'Theme Customizer', 'Notification panel (before header) – Message', get_theme_mod( 'lbmn_notificationpanel_message', LBMN_NOTIFICATIONPANEL_MESSAGE_DEFAULT ) );
		do_action( 'wpml_register_single_string', 'Theme Customizer', 'Notification panel (before header) – URL', get_theme_mod( 'lbmn_notificationpanel_buttonurl', LBMN_NOTIFICATIONPANEL_BUTTONURL_DEFAULT ) );

		do_action( 'wpml_register_single_string', 'Theme Customizer', 'Call to action (before footer) – Message', get_theme_mod( 'lbmn_calltoaction_message', LBMN_CALLTOACTION_MESSAGE_DEFAULT ) );
		do_action( 'wpml_register_single_string', 'Theme Customizer', 'Call to action (before footer) – URL', get_theme_mod( 'lbmn_calltoaction_url', LBMN_CALLTOACTION_URL_DEFAULT ) );
	}
}

/**
 * ----------------------------------------------------------------------
 * WPML integration - RTL Menu
 */

add_filter( 'mmm_container_class', 'mmm_container_class_rtl', 10, 2 );
function mmm_container_class_rtl( $value = '', $predefined_classes ) {

	$styling_classes = '';

	if ( apply_filters( 'wpml_is_rtl', null ) ) {
		$styling_classes = 'language_direction-rtl';
	} else {
		$styling_classes = 'language_direction-ltr';
	}

	return $styling_classes;
}

/**
 * ----------------------------------------------------------------------
 * Add lang code in body class
 */

function wpml_lang_body_class( $classes ) {

	if ( defined( "ICL_LANGUAGE_CODE" ) ) {
		$classes[] = 'current_language_' . ICL_LANGUAGE_CODE;

		return $classes;
	} else {
		return $classes;
	}
}

add_filter( 'body_class', 'wpml_lang_body_class' );

/**
 * WPML + Ninja Forms integration - Add strings to plugin 'WPML string translation'
 *
 * @param object $current_screen WP_Screen object.
 */
function lbmn_wpml_integration_ninja_forms( $current_screen ) {

	if ( $current_screen->id == 'wpml-string-translation/menu/string-translation' ) {

		$all_forms = Ninja_Forms()->form()->get_forms();

		if ( is_array( $all_forms ) && ! empty( $all_forms ) ) {

			foreach ( $all_forms as $form ) {
				$form_id = $form->get_id();

				// Returns an array of Field Models for Form ID.
				$form_fields = Ninja_Forms()->form( $form_id )->get_fields();

				foreach ( $form_fields as $field ) {

					$label = $field->get_setting( 'label' );
					$default_value = $field->get_setting( 'default_value' );
					$placeholder = $field->get_setting( 'placeholder' );
					$desc_text = $field->get_setting( 'desc_text' );

					// Label.
					do_action( 'wpml_register_single_string', 'Ninja Forms Plugin', 'Label - ' . $label, $label );

					// Default value.
					do_action( 'wpml_register_single_string', 'Ninja Forms Plugin', 'Default Value - ' . $default_value, $default_value );

					// Placeholder.
					do_action( 'wpml_register_single_string', 'Ninja Forms Plugin', 'Placeholder - ' . $placeholder, $placeholder );

					// Description Text.
					do_action( 'wpml_register_single_string', 'Ninja Forms Plugin', 'Description Text - ' . $desc_text, $desc_text );
				}
			}
		}
	}
}
add_action( 'current_screen', 'lbmn_wpml_integration_ninja_forms' );

/**
 * WPML + Ninja Forms integration - Translate strings
 *
 * @param array $field Get current fields.
 */
function lbmn_wpml_integration_ninja_forms_fields( $field ) {

	if ( is_array( $field['settings'] ) && array_key_exists( 'label', $field['settings'] ) ) {

		// Label.
		if ( isset( $field['settings']['label'] ) ) {
			$field['settings']['label'] = apply_filters( 'wpml_translate_single_string', $field['settings']['label'], 'Ninja Forms Plugin', 'Label - ' . $field['settings']['label'] );
		}

		// Default value.
		if ( isset( $field['settings']['default_value'] ) ) {
			$field['settings']['default_value'] = apply_filters( 'wpml_translate_single_string', $field['settings']['default_value'], 'Ninja Forms Plugin', 'Default value - ' . $field['settings']['default_value'] );
		}

		// Placeholder.
		if ( isset( $field['settings']['placeholder'] ) ) {
			$field['settings']['placeholder'] = apply_filters( 'wpml_translate_single_string', $field['settings']['placeholder'], 'Ninja Forms Plugin', 'Placeholder - ' . $field['settings']['placeholder'] );
		}

		// Description Text.
		if ( isset( $field['settings']['desc_text'] ) ) {
			$field['settings']['desc_text'] = apply_filters( 'wpml_translate_single_string', $field['settings']['desc_text'], 'Ninja Forms Plugin', 'Description Text - ' . $field['settings']['desc_text'] );
		}
	}

	return $field;
}
add_filter( 'ninja_forms_localize_fields', 'lbmn_wpml_integration_ninja_forms_fields' );

/**
 * Add TGMPA notice in body class
 */

function lbmn_tgmpa_notice_body_class( $classes ) {

	if ( get_option( LBMN_THEME_NAME . '_democontent_imported' ) || get_option( LBMN_THEME_NAME . '_update_mega_main_menu' ) ) {
		$classes .= ' lbmn-tgmpa-notice';

		return $classes;
	} else {
		return $classes;
	}
}

add_filter( 'admin_body_class', 'lbmn_tgmpa_notice_body_class' );
