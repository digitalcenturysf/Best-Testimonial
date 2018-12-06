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
    	add_submenu_page('edit.php?post_type=best_testimonial', __('Settings', $this->best_testimonial), __('Settings', $this->best_testimonial ), 'manage_options', 'best_testimonial_settings', array($this, 'admin_settings')); 
    }
    
	public function admin_settings() {

		include('best-testimonial-admin-display.php');
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
                'id'    => 'bestt_general',
                'title' => __( 'General', 'best-testimonial' )
            ),
            array(
                'id'    => 'bestt_advanced',
                'title' => __( 'Advanced', 'best-testimonial' )
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
            'bestt_general' => array(
                array(
                    'name'              => 'text_val',
                    'label'             => __( 'Text Input', 'best-testimonial' ),
                    'desc'              => __( 'Text input description', 'best-testimonial' ),
                    'placeholder'       => __( 'Text Input placeholder', 'best-testimonial' ),
                    'type'              => 'text',
                    'default'           => 'Title',
                    'sanitize_callback' => 'sanitize_text_field'
                ),
                array(
                    'name'              => 'number_input',
                    'label'             => __( 'Number Input', 'best-testimonial' ),
                    'desc'              => __( 'Number field with validation callback `floatval`', 'best-testimonial' ),
                    'placeholder'       => __( '1.99', 'best-testimonial' ),
                    'min'               => 0,
                    'max'               => 100,
                    'step'              => '0.01',
                    'type'              => 'number',
                    'default'           => 'Title',
                    'sanitize_callback' => 'floatval'
                ),
                array(
                    'name'        => 'textarea',
                    'label'       => __( 'Textarea Input', 'best-testimonial' ),
                    'desc'        => __( 'Textarea description', 'best-testimonial' ),
                    'placeholder' => __( 'Textarea placeholder', 'best-testimonial' ),
                    'type'        => 'textarea'
                ),
                array(
                    'name'        => 'htmld',
                    // 'label'       => __( 'HTML', 'best-testimonial' ),
                    'desc'        => __( 'HTML area description. You can use any <strong>bold</strong> or other HTML elements.', 'best-testimonial' ),
                    'type'        => 'html'
                ),
                array(
                    'name'        => 'html',
                    'label'       => __( 'HTML:', 'best-testimonial' ),
                    // 'desc'        => __( 'HTML area description. You can use any <strong>bold</strong> or other HTML elements.', 'best-testimonial' ),
                    'type'        => 'html'
                ),
                array(
                    'name'  => 'checkbox',
                    'label' => __( 'Checkbox', 'best-testimonial' ),
                    'desc'  => __( 'Checkbox Label', 'best-testimonial' ),
                    'type'  => 'checkbox'
                ),
                array(
                    'name'    => 'radio',
                    'label'   => __( 'Radio Button', 'best-testimonial' ),
                    'desc'    => __( 'A radio button', 'best-testimonial' ),
                    'type'    => 'radio',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'selectbox',
                    'label'   => __( 'A Dropdown', 'best-testimonial' ),
                    'desc'    => __( 'Dropdown description', 'best-testimonial' ),
                    'type'    => 'select',
                    'default' => 'no',
                    'options' => array(
                        'yes' => 'Yes',
                        'no'  => 'No'
                    )
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'best-testimonial' ),
                    'desc'    => __( 'Password description', 'best-testimonial' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'file',
                    'label'   => __( 'File', 'best-testimonial' ),
                    'desc'    => __( 'File description', 'best-testimonial' ),
                    'type'    => 'file',
                    'default' => '',
                    'options' => array(
                        'button_label' => 'Choose Image'
                    )
                )
            ),
            'bestt_advanced' => array(
                array(
                    'name'    => 'color',
                    'label'   => __( 'Color', 'best-testimonial' ),
                    'desc'    => __( 'Color description', 'best-testimonial' ),
                    'type'    => 'color',
                    'default' => ''
                ),
                array(
                    'name'    => 'password',
                    'label'   => __( 'Password', 'best-testimonial' ),
                    'desc'    => __( 'Password description', 'best-testimonial' ),
                    'type'    => 'password',
                    'default' => ''
                ),
                array(
                    'name'    => 'wysiwyg',
                    'label'   => __( 'Advanced Editor', 'best-testimonial' ),
                    'desc'    => __( 'WP_Editor description', 'best-testimonial' ),
                    'type'    => 'wysiwyg',
                    'default' => ''
                ),
                array(
                    'name'    => 'multicheck',
                    'label'   => __( 'Multile checkbox', 'best-testimonial' ),
                    'desc'    => __( 'Multi checkbox description', 'best-testimonial' ),
                    'type'    => 'multicheck',
                    'default' => array('one' => 'one', 'four' => 'four'),
                    'options' => array(
                        'one'   => 'One',
                        'two'   => 'Two',
                        'three' => 'Three',
                        'four'  => 'Four'
                    )
                ),
            )
        );

        return $settings_fields;
    }
 
 


}
