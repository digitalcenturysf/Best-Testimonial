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
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/includes
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
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/includes
 * @author     digitalcenturysf <digitalcenturysf@gmail.com>
 */
class Best_Testimonial {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Best_Testimonial_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $best_testimonial    The string used to uniquely identify this plugin.
	 */
	protected $best_testimonial;

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
		if ( defined( 'BEST_TESTIMONIAL_VERSION' ) ) {
			$this->version = BEST_TESTIMONIAL_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->best_testimonial = 'best-testimonial';

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
	 * - Best_Testimonial_Loader. Orchestrates the hooks of the plugin.
	 * - Best_Testimonial_i18n. Defines internationalization functionality.
	 * - Best_Testimonial_Admin. Defines all hooks for the admin area.
	 * - Best_Testimonial_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-best-testimonial-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-best-testimonial-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-best-testimonial-admin-settings.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-best-testimonial-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/best-testimonial-admin-option.php';
 
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-best-testimonial-public.php';

		$this->loader = new Best_Testimonial_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Best_Testimonial_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Best_Testimonial_i18n();

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

		$plugin_admin = new Best_Testimonial_Admin( $this->get_best_testimonial(), $this->get_version() );
		$plugin_admin_options = new Best_Testimonial_Admin_Options( $this->get_best_testimonial(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' ); 
        $this->loader->add_action('init', $plugin_admin, 'best_testimonial_thumbnail_support');
        $this->loader->add_action('init', $plugin_admin, 'best_testimonial_post_type');
        $this->loader->add_action('init', $plugin_admin, 'best_testimonial_categories');  
        $this->loader->add_filter('post_row_actions', $plugin_admin, 'remove_quick_edit',10,1);  
        $this->loader->add_action('admin_init', $plugin_admin, 'best_testimonial_columns_register');  
        $this->loader->add_action('add_meta_boxes', $plugin_admin, 'best_testimonial_add_meta_boxes'); 
        $this->loader->add_action('save_post', $plugin_admin, 'best_testimonial_save_post_metaboxes',10,2);   
        $this->loader->add_action('admin_init', $plugin_admin_options, 'settings_init');
        $this->loader->add_action('admin_menu', $plugin_admin_options, 'admin_menu');
 

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Best_Testimonial_Public( $this->get_best_testimonial(), $this->get_version() );

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
	public function get_best_testimonial() {
		return $this->best_testimonial;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Best_Testimonial_Loader    Orchestrates the hooks of the plugin.
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
