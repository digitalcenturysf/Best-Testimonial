<?php
/** 
 * Plugin Name:       Best Testimonial
 * Plugin URI:        https://digitalcenturysf.com/best-testimonial/
 * Description:       Very simple and powerful testimonial system for wordpress website. Customizable & user friendly.
 * Version:           1.0.0
 * Author:            DigitalCenturySF
 * Author URI:        https://digitalcenturysf.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       best-testimonial
 * Domain Path:       /languages
 *
 * @link             https://digitalcenturysf.com/
 * @since             1.0.0
 * @package           Best_Testimonial
 */
 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Currently plugin version.  
 */
define( 'BEST_TESTIMONIAL_VERSION', '1.0.0' ); 
define( 'BEST_TESTIMONIAL_PLUGIN', plugin_basename( __FILE__ ) ); // best-testimonial/best-testimonial.php
define( 'BEST_TESTIMONIAL', dirname( BEST_TESTIMONIAL_PLUGIN ) );           // best-testimonial
define( 'BEST_TESTIMONIAL_DIR', WP_PLUGIN_URL."/".dirname( plugin_basename( __FILE__ ) ) );           // best-testimonial
define( 'BEST_TESTIMONIAL_STORE_URL', 'https://digitalcenturysf.com/' );


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-best-testimonial-activator.php
 */
function activate_best_testimonial() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-best-testimonial-activator.php';
	Best_Testimonial_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-best-testimonial-deactivator.php
 */
function deactivate_best_testimonial() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-best-testimonial-deactivator.php';
	Best_Testimonial_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_best_testimonial' );
register_deactivation_hook( __FILE__, 'deactivate_best_testimonial' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-best-testimonial.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_best_testimonial() {

	$plugin = new Best_Testimonial();
	$plugin->run();

}
run_best_testimonial();

 