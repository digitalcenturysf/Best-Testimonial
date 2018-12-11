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
class Best_Testimonial_Admin {

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
	 * The plugin plugin_base_file of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string plugin_base_file The plugin plugin_base_file of this plugin.
	 */
	protected $plugin_base_file;

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

	/**
	 * Register the stylesheets for the admin area.
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
	 * Register the JavaScript for the admin area.
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


    /**
     * Support post thumbnail 
     * @since    1.0.0
     */
    public function best_testimonial_thumbnail_support() {
        if ( ! current_theme_supports( 'post-thumbnails' ) ) {
            add_theme_support( 'post-thumbnails' );
        } 
    }

 
	/**
	 * Register Post Type for Best Testimonial
	 *
	 * @since    1.0.0
	 */
	public function best_testimonial_post_type() {

		$labels_Testimonial_pro = array(
			'name'               => _x( 'Testimonials', 'Post Type General Name', 'best-testimonial' ),
			'singular_name'      => _x( 'Testimonial', 'Post Type Singular Name', 'best-testimonial' ),
			'menu_name'          => __( 'Testimonials', 'best-testimonial' ),
			'parent_item_colon'  => __( 'Parent Testimonial:', 'best-testimonial' ),
			'all_items'          => __( 'All Testimonials', 'best-testimonial' ),
			'view_item'          => __( 'View Testimonials', 'best-testimonial' ),
			'add_new_item'       => __( 'Add New Testimonial', 'best-testimonial' ),
			'add_new'            => __( 'Add Testimonial', 'best-testimonial' ),
			'edit_item'          => __( 'Edit Testimonial', 'best-testimonial' ),
			'update_item'        => __( 'Update Testimonial', 'best-testimonial' ),
			'search_items'       => __( 'Search Testimonials', 'best-testimonial' ),
			'not_found'          => __( 'Not found', 'best-testimonial' ),
			'not_found_in_trash' => __( 'Not found in Trash', 'best-testimonial' ),
		);

		$args_Testimonial_pro   = array(
			'label'               => __( 'Testimonial', 'best-testimonial' ),
			'description'         => __( 'Testimonial Display', 'best-testimonial' ),
			'labels'              => $labels_Testimonial_pro,
			'supports'            => array( 'editor','thumbnail' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'menu_icon'           => 'dashicons-editor-quote',
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		register_post_type( 'best_testimonial', $args_Testimonial_pro );
 
	}

	/**
	 * Register Categories for Best Testimonial
	 *
	 * @since    1.0.0
	 */
	public function best_testimonial_categories() {

		$best_testimonial_cats_args = array(
			'hierarchical'   => true,
			'label'          => 'Categories',
			'show_ui'        => true,
			'query_var'      => true,
			'rewrite'        => true,
			'singular_label' => 'Categories'
		);
		register_taxonomy('best_testimonial_cats', array('best_testimonial'), $best_testimonial_cats_args);
 
	}

	/**
	 * Remvoe quick edit 
	 *
	 * @since    1.0.0
	 */ 
	function remove_quick_edit( $actions ) {    
	    unset($actions['inline hide-if-no-js']);
	    return $actions;
	}
		 

	/**
	 * Register Columns for Best Testimonial Admin View
	 *
	 * @since    1.0.0
	 */ 
	public function best_testimonial_columns_register() {

		add_filter( 'manage_best_testimonial_posts_columns', array($this, 'best_testimonial_columns_head'), 10, 1);
		add_action('manage_best_testimonial_posts_custom_column', array($this, 'best_testimonial_columns_content'), 10, 2);

	}

	/**
	 * Register Columns head for Best Testimonial Admin View
	 *
	 * @since    1.0.0
	 */ 
	public function best_testimonial_columns_head($columns) {
	   $columns = array(
	      'cb' => $columns['cb'],
	      'tpro_full_name' => __( 'Full Name','best-testimonial' ), 
	      'tpro_excerpt' => __( 'Excerpt','best-testimonial' ),
	      'tpro_designation' => __( 'Designation','best-testimonial' ),
	      'tpro_thumbnail' => __( 'Thumbnail','best-testimonial' ), 
	      'date' => $columns['date'], 
	    ); 
	    return $columns;
	}


	/**
	 * Register Columns content for Best Testimonial Admin View
	 *
	 * @since    1.0.0
	 */ 
	public function best_testimonial_columns_content($column_name, $post_id) { 

		$fieldValues = get_post_meta( $post_id, '_testimonialprometa', true ); 

		$client_name    = !empty( $fieldValues['client_name'] ) ? $fieldValues['client_name'] : '';
		$client_designation    = isset( $fieldValues['client_designation'] ) ? $fieldValues['client_designation'] : '';
		$email = !empty( $fieldValues['email'] ) ? $fieldValues['email'] : '';
		$company_name = !empty( $fieldValues['company_name'] ) ? $fieldValues['company_name'] : '';
		$company_website= !empty( $fieldValues['company_website'] ) ? $fieldValues['company_website'] : '#'; 

		$excerpt =  wp_trim_words(get_the_content(),16,'[...]');

		if ( 'tpro_full_name' === $column_name ) {
		    if ( ! $client_name ) {
		      esc_html_e( 'n/a','best-testimonial' );  
		    } else {
		      echo esc_html($client_name);
		    }
		}
		if ( 'tpro_excerpt' === $column_name ) { 

		    if ( ! $excerpt ) {
		      esc_html_e( 'n/a','best-testimonial' );  
		    } else {
		      echo esc_html($excerpt);
		    }
		}
		if ( 'tpro_designation' === $column_name ) { 

		    if ( ! $client_designation ) {
		      esc_html_e( 'n/a','best-testimonial' );  
		    } else {
		      echo esc_html($client_designation);
		    }
		}
	    if ( 'tpro_thumbnail' === $column_name ) {
		    echo get_the_post_thumbnail( $post_id, array(80, 80) );
		}
		  
	}

	/**
	 * Register Columns content for Best Testimonial Admin View
	 *
	 * @since    1.0.0
	 */ 
	public function best_testimonial_add_meta_boxes() { 
	    add_meta_box( 'food_meta_box', __( 'Client Details', 'best-testimonial' ), array($this,'best_testimonial_metabox_display'), 'best_testimonial', 'normal', 'low' );
	}


	/**
	 * Add metabox for custom post type
	 *
	 * @since    1.0.0
	 */
	public function best_testimonial_metabox_display( $post) {

 
		$fieldValues = get_post_meta( $post->ID, '_testimonialprometa', true );

		wp_nonce_field( 'best_testimonial', 'best_testimonial[nonce]' );

		echo '<div id="testimonialpro_metabox_wrapper">';

		$client_name    = isset( $fieldValues['client_name'] ) ? $fieldValues['client_name'] : '';
		$client_designation    = isset( $fieldValues['client_designation'] ) ? $fieldValues['client_designation'] : '';
		$email = isset( $fieldValues['email'] ) ? $fieldValues['email'] : '';
		$company_name = isset( $fieldValues['company_name'] ) ? $fieldValues['company_name'] : '';
		$company_website= isset( $fieldValues['company_website'] ) ? $fieldValues['company_website'] : ''; 
		?>

		<div class="inside">
			<table class="options">
				<tbody>
					<tr>
						<td colspan="2">
							<p>To add a photo or logo, use the Featured Image option.</p>
						</td>
					</tr>
					<tr>
						<th>
							<label for="client_name"><?php esc_html_e( 'Full Name', 'best-testimonial' ); ?></label>
						</th>
						<td>
							<div class="text">
								<input id="client_name" type="text" class="custom-input" name="best_testimonial[client_name]" value="<?php echo esc_attr($client_name); ?>">                        
							</div>
						</td>
					</tr>
					<tr>
						<th>
							<label for="client_designation"><?php esc_html_e( 'Designation', 'best-testimonial' ); ?></label>
						</th>
						<td>
							<div class="text">
								<input id="client_designation" type="text" class="custom-input" name="best_testimonial[client_designation]" value="<?php echo esc_attr($client_designation); ?>">                        
							</div>
						</td>
					</tr>
					<tr style="display:none;">
						<th>
							<label for="email"><?php esc_html_e( 'Email', 'best-testimonial' ); ?></label>
						</th>
						<td>
							<div class="email">
								<input id="email" type="email" class="custom-input" name="best_testimonial[email]" value="<?php echo esc_attr($email); ?>">                        
							</div>
						</td>
					</tr>
					<tr style="display:none;">
						<th>
							<label for="company_name"><?php esc_html_e( 'Company Name', 'best-testimonial' ); ?></label>
						</th>
						<td>
							<div class="text">
								<input id="company_name" type="text" class="custom-input" name="best_testimonial[company_name]" value="<?php echo esc_attr($company_name); ?>">                        
							</div>
						</td>
					</tr>
					<tr style="display:none;">
						<th>
							<label for="company_website"><?php esc_html_e( 'Company Website', 'best-testimonial' ); ?></label>
						</th>
						<td>
							<div class="url">
								<div class="input-url">
									<input id="company_website" type="url" class="custom-input" name="best_testimonial[company_website]" value="<?php echo esc_attr($company_website); ?>" size="" placeholder="http://">        
								</div> 
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<?php
		echo '</div>';


	}


	/**
	 * Determines whether or not the current user has the ability to save meta data associated with this post.
	 *
	 * Save testimonialpro Meta Field
	 *
	 * @param        int $post_id //The ID of the post being save
	 * @param         bool //Whether or not the user has the ability to save this post.
	 */
	public function best_testimonial_save_post_metaboxes( $post_id, $post ) {

		$post_type = 'best_testimonial';

		// If this isn't a 'book' post, don't update it.
		if ( $post_type != $post->post_type ) {
			return;
		}

		if ( ! empty( $_POST['best_testimonial'] ) ) {

			$postData = $_POST['best_testimonial'];

			$saveableData = array();

			if ( $this->user_can_save( $post_id, 'best_testimonial', $postData['nonce'] ) ) {
 
				$saveableData['client_name']        = sanitize_text_field( $postData['client_name'] );
				$saveableData['client_designation']        = sanitize_text_field( $postData['client_designation'] );
				$saveableData['email']       = sanitize_text_field( $postData['email'] );
				$saveableData['company_name']     = $postData['company_name'];
				$saveableData['company_website']     = $postData['company_website'];
				$saveableData['custom_tag_three']   = $postData['custom_tag_three'];

				update_post_meta( $post_id, '_testimonialprometa', $saveableData );
			}
		}
	}// End  Meta Save  

	/**
	 * Determines whether or not the current user has the ability to save meta data associated with this post.
	 *
	 * user_can_save
	 *
	 * @param        int $post_id // The ID of the post being save
	 * @param        bool /Whether or not the user has the ability to save this post.
	 *
	 * @since 1.0
	 */
	public function user_can_save( $post_id, $action, $nonce ) {

		$is_autosave    = wp_is_post_autosave( $post_id );
		$is_revision    = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $nonce ) && wp_verify_nonce( $nonce, $action ) );

		// Return true if the user is able to save; otherwise, false.
		return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

	}


}
