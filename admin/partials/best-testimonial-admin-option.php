<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/admin
 * @author     digitalcenturysf <digitalcenturysf@gmail.com>
 */
class Best_Testimonial_Admin_Options {

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
	 * The settings api of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var 	$settings_api	The settings api of this plugin
	 */
	private $settings_api;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $best_testimonial       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $best_testimonial, $version ) {

		$this->best_testimonial = $best_testimonial;
		$this->version = $version;

        $this->settings_api = new Best_Testimonial_Settings_API($this->best_testimonial, $this->version);  

	}
 

    public function admin_menu() {
        add_submenu_page('edit.php?post_type=best_testimonial', __('Settings', 'best-testimonial'), __('Settings', 'best-testimonial' ), 'manage_options', 'best_testimonial_settings', array($this, 'admin_settings'));
    	add_submenu_page('edit.php?post_type=best_testimonial', __('About', 'best-testimonial'), __('About', 'best-testimonial' ), 'manage_options', 'best_testimonial_settings_info', array($this, 'admin_settings_info')); 
    }
    
    public function admin_settings() { 

        include('best-testimonial-admin-display.php');
    }

	public function admin_settings_info() { 

		include('best-testimonial-admin-display-info.php');
	}

 
    public function settings_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    public function get_settings_sections() {
        $sections = array(
            array(
                'id'    => 'bestt_style_one',
                'title' => __( 'For Style 1', 'best-testimonial' )
            ), 
            array(
                'id'    => 'bestt_style_two',
                'title' => __( 'For Style 2', 'best-testimonial' )
            ) 
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    public function get_settings_fields() {
        $settings_fields = array(
            'bestt_style_one' => array(  
                array(
                    'name'    => 'c_color_1',
                    'label'   => __( 'Content Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for review content.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'c_fs_1',
                    'label'             => __( 'Content Font Size', 'best-testimonial' ),
                    'desc'              => __( 'Input font size value with px.', 'best-testimonial' ),
                    'placeholder'       => __( '16px', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),  
                array(
                    'name'    => 'n_color_1',
                    'label'   => __( 'Name Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for name .', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ), 
                array(
                    'name'              => 'n_fs_1',
                    'label'             => __( 'Name Font Size', 'best-testimonial' ),
                    'desc'              => __( 'Input font size value with px.', 'best-testimonial' ),
                    'placeholder'       => __( '16px', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'    => 'd_color_1',
                    'label'   => __( 'Designation Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for designation.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'd_fs_1',
                    'label'             => __( 'Designation Font Size', 'best-testimonial' ),
                    'desc'              => __( 'Input font size value with px.', 'best-testimonial' ),
                    'placeholder'       => __( '14px', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'    => 'indc_color_1',
                    'label'   => __( 'Indicator Fill Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for indicator.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),  
                array(
                    'name'    => 'indc_b_color_1',
                    'label'   => __( 'Indicator Border Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for indicator border.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),   
            ),
            'bestt_style_two' => array(
                array(
                    'name'    => 'bx_color_2',
                    'label'   => __( 'Box BG Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for box background.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'c_color_2',
                    'label'   => __( 'Content Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for review content.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'c_fs_2',
                    'label'             => __( 'Content Font Size', 'best-testimonial' ),
                    'desc'              => __( 'Input font size value with px.', 'best-testimonial' ),
                    'placeholder'       => __( '16px', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),  
                array(
                    'name'    => 'nd_color_2',
                    'label'   => __( 'Name & Designation Color', 'best-testimonial' ),
                    'desc'    => __( 'Pick a color for name & designation.', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'              => 'n_fs_2',
                    'label'             => __( 'Name Font Size', 'best-testimonial' ),
                    'desc'              => __( 'Input font size value with px.', 'best-testimonial' ),
                    'placeholder'       => __( '16px', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'd_fs_2',
                    'label'             => __( 'Designation Font Size', 'best-testimonial' ),
                    'desc'              => __( 'Input font size value with px.', 'best-testimonial' ),
                    'placeholder'       => __( '14px', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => '',
                    'sanitize_callback' => 'sanitize_text_field'
                ),   
            )
        );

        return $settings_fields;
    }
 
 


}
