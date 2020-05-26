<?php
/**
 * Ninja Forms plugin integration
 *
 * -------------------------------------------------------------------
 *
 * DESCRIPTION:
 *
 * In this file we integrate Ninja Forms with our theme:
 *    – Add the NINJA FORMS module on Live Composer toolbar
 *
 * @package    SEOWP WordPress Theme
 * @author     Vlad Mitkovsky <info@lumbermandesigns.com>
 * @copyright  2015 Lumberman Designs
 * @license    GNU GPL, Version 3
 * @link       http://themeforest.net/user/lumbermandesigns
 *
 * -------------------------------------------------------------------
 *
 * Send your ideas on code improvement or new hook requests using
 * contact form on http://themeforest.net/user/lumbermandesigns
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

// Delete the redirect transient to not allow Ninja Forms to redirect
// theme users to their welcome page ont he first plugin install
delete_transient( '_nf_activation_redirect' );
