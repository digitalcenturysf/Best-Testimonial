<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/public
 * @author     digitalcenturysf <digitalcenturysf@gmail.com>
 */
class Best_Testimonial_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $best_testimonial    The ID of this plugin.
	 */
	private $best_testimonial;

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
	 * @param      string    $best_testimonial       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $best_testimonial, $version ) {

		$this->best_testimonial = $best_testimonial;
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
		 * defined in Best_Testimonial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Best_Testimonial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->best_testimonial, plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

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
		 * defined in Best_Testimonial_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Best_Testimonial_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->best_testimonial, plugin_dir_url( __FILE__ ) . 'js/main.js', array( 'jquery' ), $this->version, false );

	}

}
