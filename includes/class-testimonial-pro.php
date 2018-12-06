<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/includes
 * @author     digitalcenturysf <digitalcenturysf@gmail.com>
 */
class Testimonial_Pro {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Testimonial_Pro_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $testimonial_pro    The string used to uniquely identify this plugin.
	 */
	protected $testimonial_pro;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'TESTIMONIAL_PRO_VERSION' ) ) {
			$this->version = TESTIMONIAL_PRO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->testimonial_pro = 'testimonial-pro';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Testimonial_Pro_Loader. Orchestrates the hooks of the plugin.
	 * - Testimonial_Pro_i18n. Defines internationalization functionality.
	 * - Testimonial_Pro_Admin. Defines all hooks for the admin area.
	 * - Testimonial_Pro_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-testimonial-pro-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-testimonial-pro-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-testimonial-pro-admin-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-testimonial-pro-admin.php';
 
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-testimonial-pro-public.php';

		$this->loader = new Testimonial_Pro_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Testimonial_Pro_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Testimonial_Pro_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Testimonial_Pro_Admin( $this->get_testimonial_pro(), $this->get_version() );
		//$plugin_admin_display = new Testimonial_Pro_Admin_Display( $this->get_testimonial_pro(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' ); 
        $this->loader->add_action('init', $plugin_admin, 'testimonial_pro_thumbnail_support');
        $this->loader->add_action('init', $plugin_admin, 'testimonial_pro_post_type');
        $this->loader->add_action('init', $plugin_admin, 'testimonial_pro_categories');  
        $this->loader->add_filter('post_row_actions', $plugin_admin, 'remove_quick_edit',10,1);  
        $this->loader->add_action('admin_init', $plugin_admin, 'testimonial_pro_columns_register');  
        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'testimonial_pro_add_meta_boxes'); 
        $this->loader->add_action('save_post', $plugin_admin, 'testimonial_pro_save_post_metaboxes',10,2);   
        $this->loader->add_action('admin_init', $plugin_admin, 'testimonial_pro_settings_init');
        $this->loader->add_action('admin_menu', $plugin_admin, 'testimonial_pro_add_admin_menu');
 

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Testimonial_Pro_Public( $this->get_testimonial_pro(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_testimonial_pro() {
		return $this->testimonial_pro;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Testimonial_Pro_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
