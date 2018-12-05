<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/public
 * @author     digitalcenturysf <digitalcenturysf@gmail.com>
 */
class Testimonial_Pro_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $testimonial_pro    The ID of this plugin.
	 */
	private $testimonial_pro;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $testimonial_pro       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $testimonial_pro, $version ) {

		$this->testimonial_pro = $testimonial_pro;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Testimonial_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Testimonial_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->testimonial_pro, plugin_dir_url( __FILE__ ) . 'css/testimonial-pro-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Testimonial_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Testimonial_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->testimonial_pro, plugin_dir_url( __FILE__ ) . 'js/testimonial-pro-public.js', array( 'jquery' ), $this->version, false );

	}

}
