<?php
/** 
 * Plugin Name:       Testimonial Pro
 * Plugin URI:        https://digitalcenturysf.com/testimonial-pro/
 * Description:       A very simple and powerful testimonial system for wordpress website. Customizable & user friendly.
 * Version:           1.0.0
 * Author:            DigitalCenturySF
 * Author URI:        https://digitalcenturysf.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       testimonial-pro
 * Domain Path:       /languages
 *
 * @link             https://digitalcenturysf.com/
 * @since             1.0.0
 * @package           Testimonial_Pro
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Currently plugin version.  
 */
define( 'TESTIMONIAL_PRO_VERSION', '1.0.0' ); 
define( 'TESTIMONIAL_PRO_PLUGIN', plugin_basename( __FILE__ ) ); // testimonials-pro/testimonials-pro.php
define( 'TESTIMONIAL_PRO', dirname( TESTIMONIAL_PRO_PLUGIN ) );           // testimonials-pro
define( 'TESTIMONIAL_PRO_STORE_URL', 'https://digitalcenturysf.com/' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-testimonial-pro-activator.php
 */
function activate_testimonial_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-pro-activator.php';
	Testimonial_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-testimonial-pro-deactivator.php
 */
function deactivate_testimonial_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-pro-deactivator.php';
	Testimonial_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_testimonial_pro' );
register_deactivation_hook( __FILE__, 'deactivate_testimonial_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_testimonial_pro() {

	$plugin = new Testimonial_Pro();
	$plugin->run();

}
run_testimonial_pro();
