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

		$this->settings_api = new Best_Testimonial_Settings_API($this->best_testimonial, $this->version);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function bestt_css() {
		$sett_val = $this->settings_value();   
 		?>
		<style>
			.bestt-testimonial-area .total-testimonial .bestt-testimonial .single-testimonial p{
				color:<?php echo $sett_val[1]['c_color_1']; ?>;
				font-size:<?php echo $sett_val[1]['c_fs_1']; ?>;
			}
			.bestt-testimonial-area .total-testimonial .bestt-testimonial .single-testimonial .details h3{
				color:<?php echo $sett_val[1]['n_color_1']; ?>;
				font-size:<?php echo $sett_val[1]['n_fs_1']; ?>;
			}
			.bestt-testimonial-area .total-testimonial .bestt-testimonial .single-testimonial .details p{
				color:<?php echo $sett_val[1]['d_color_1']; ?>;
				font-size:<?php echo $sett_val[1]['d_fs_1']; ?>;
			}
			.bestt-testimonial-area .total-testimonial .bestt-testimonial .owl-controls .owl-pagination .owl-page.active span{
				border-color:<?php echo $sett_val[1]['indc_b_color_1']; ?>;  
			}
			.bestt-testimonial-area .total-testimonial .bestt-testimonial .owl-controls .owl-pagination .owl-page span{ 
				background:<?php echo $sett_val[1]['indc_color_1']; ?>; 
			}
			.bestt2-testimonial-area .carousel-indicators li p{ 
				background:<?php echo $sett_val[2]['bx_color_2']; ?>; 
			}
			.bestt2-testimonial-area blockquote p:nth-child(2){ 
				color:<?php echo $sett_val[2]['c_color_2']; ?>; 
				font-size:<?php echo $sett_val[2]['c_fs_2']; ?>;
			}
			.bestt2-testimonial-area .carousel-indicators li.active p{ 
				color:<?php echo $sett_val[2]['nd_color_2']; ?>; 
				font-size:<?php echo $sett_val[2]['n_fs_2']; ?>;
			}
			.bestt2-testimonial-area .carousel-indicators li.active p span{  
				font-size:<?php echo $sett_val[2]['d_fs_2']; ?>;
			}
		</style>
 		<?php
	}
	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'bestt-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bestt-owl.carousel', plugin_dir_url( __FILE__ ) . 'css/owl.carousel.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bestt-font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bestt-style', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'bestt-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'bestt-owl-carousel', plugin_dir_url( __FILE__ ) . 'js/owl.carousel.min.js', array(), $this->version, true );
		wp_enqueue_script( 'bestt-main', plugin_dir_url( __FILE__ ) . 'js/main.js', array(), $this->version, true );

	}

	/**
	 * Frontend Shortcode
	 *
	 * @since    1.0.0
	 */
	public function best_testimonial_frontend($atts,$content = null) {
		$sett_val = $this->settings_value();
		$atts = shortcode_atts(array(
		    'style' =>'2',  
		    'number' => 3,  
		    'bg_img_id' => '',  
		    'cat' => '',     
		), $atts); 
 
		if($atts['style']=='2'){
			$output = $this->best_testimonial_frontend_style_two($atts);
		}else{
			$output = $this->best_testimonial_frontend_style_one($atts);
		} 

		return $output;
	}

	/**
	 * Frontend Testimonial Style 1
	 *
	 * @since    1.0.0
	 */
	public function best_testimonial_frontend_style_one($atts) {


		// section bg image
		$img_id = wp_get_attachment_image_src($atts['bg_img_id'],'full',true);
		$image_url = $img_id[0];
		$style = '';
		if(!empty($atts['bg_img_id'])){
			$style = 'style="background:url('.esc_url($image_url).') center center no-repeat"';
		}

		ob_start(); 
		?> 
	    <div class="bestt-testimonial-area">
	        <div class="container">
	            <div class="row">
	                <div class="total-testimonial">
	                    <div class="bestt-testimonial">
							<?php 
							$qatts = array(
								'post_type' => 'best_testimonial',
								'posts_per_page' => $atts['number'],
							);
							if($atts['cat']!=''){
								$qatts['best_testimonial_cats'] = $atts['cat'];
							}
							$query = new WP_Query($qatts);
							while($query->have_posts()) : $query->the_post();

							// meta key value
							$fieldValues = get_post_meta( get_the_ID(), '_testimonialprometa', true );
							$client_name    = isset( $fieldValues['client_name'] ) ? $fieldValues['client_name'] : '';
							$client_designation    = isset( $fieldValues['client_designation'] ) ? $fieldValues['client_designation'] : ''; 

							?>
		                        <div class="single-testimonial text-center">
		                            <p> <i class="fa fa-quote-left" aria-hidden="true"></i><?php echo get_the_content(); ?></p>
		                            <div class="details">
		                                <h3><?php echo esc_html($client_name); ?></h3>
		                                <p><?php echo esc_html($client_designation); ?></p>
		                            </div>
		                        </div>
							<?php endwhile; wp_reset_postdata(); ?>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		<?php
		
		return ob_get_clean();
	}

	/**
	 * Frontend Testimonial Style 2
	 *
	 * @since    1.0.0
	 */
	public function best_testimonial_frontend_style_two($atts) {
	  
		// section bg image
		$img_id = wp_get_attachment_image_src($atts['bg_img_id'],'full',true);
		$image_url = $img_id[0];
		$style = '';
		if(!empty($atts['bg_img_id'])){
			$style = 'style="background:url('.esc_url($image_url).') center center no-repeat"';
		}

		ob_start();
		?>

		<div class="bestt2-testimonial-area spacer60" <?php echo $style; ?>>
		  <div class="container">
		    <div class="row">
		      <div class="col-md-12" data-wow-delay="0.2s">
		        <div class="carousel slide" data-ride="carousel" id="quote-carousel"> 
		          <!-- Bottom Carousel Indicators -->
		          <ol class="carousel-indicators">
					<?php 
					$qatts = array(
						'post_type' => 'best_testimonial',
						'posts_per_page' => $atts['number'],
					);
					if($atts['cat']!=''){
						$qatts['best_testimonial_cats'] = $atts['cat'];
					}
					$i=0;
					$query = new WP_Query($qatts);
					while($query->have_posts()) : $query->the_post();
						$image_id = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full',true);
						$image_url = $image_id[0];

						// meta key value
						$fieldValues = get_post_meta( get_the_ID(), '_testimonialprometa', true );
						$client_name    = isset( $fieldValues['client_name'] ) ? $fieldValues['client_name'] : '';
						$client_designation    = isset( $fieldValues['client_designation'] ) ? $fieldValues['client_designation'] : ''; 
					?> 
				        <li data-target="#quote-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo ($i==0) ? 'active' : ''; ?>"><img class="img-responsive " src="<?php echo esc_url($image_url); ?>" alt="buyer image">
			              <p><?php echo esc_html($client_name); ?> <span><?php echo esc_html($client_designation); ?></span> </p>
			            </li>
					<?php $i++; endwhile; wp_reset_postdata(); ?>
		          </ol>
		          
		          <!-- Carousel Slides / Quotes -->
		          <div class="carousel-inner text-center"> 
		            
		            <!-- Quote 1 -->

					<?php 
					$qatts = array(
						'post_type' => 'best_testimonial',
						'posts_per_page' => 3,
					);
					$k=1;
					$query = new WP_Query($qatts);
					while($query->have_posts()) : $query->the_post(); 
					?>
			            <div class="item <?php echo ($k==1) ? 'active' : ''; ?>">
			              <blockquote>
			                <div class="row">
			                <div class="col-sm-8 col-sm-offset-2">
			                  <p><i><img src="<?php echo BEST_TESTIMONIAL_DIR; ?>/public/img/quote.png" alt="testimonial icon"></i></p>
			                  <p><?php echo get_the_content(); ?></p>
			                </div>
			                </div>
			              </blockquote>
			            </div>
					<?php $k++; endwhile; wp_reset_postdata(); ?>

		          </div>
		          
		          <!-- Carousel Buttons Next/Prev --> 
		          <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a> <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a> </div>
		      </div>
		    </div>
		  </div>
		</div>
		<?php
		return ob_get_clean();
	}

    public function settings_value(){  
		$c_color_1 = $this->settings_api->get_option('c_color_1','bestt_style_one','');
		$c_fs_1 = $this->settings_api->get_option('c_fs_1','bestt_style_one','');
		$n_color_1 = $this->settings_api->get_option('n_color_1','bestt_style_one','');
		$n_fs_1 = $this->settings_api->get_option('n_fs_1','bestt_style_one','');
		$d_color_1 = $this->settings_api->get_option('d_color_1','bestt_style_one','');
		$d_fs_1 = $this->settings_api->get_option('d_fs_1','bestt_style_one','');
		$indc_color_1 = $this->settings_api->get_option('indc_color_1','bestt_style_one','');
		$indc_b_color_1 = $this->settings_api->get_option('indc_b_color_1','bestt_style_one','');
		$bx_color_2 = $this->settings_api->get_option('bx_color_2','bestt_style_two','');
		$c_color_2 = $this->settings_api->get_option('c_color_2','bestt_style_two','');
		$c_fs_2 = $this->settings_api->get_option('c_fs_2','bestt_style_two','');
		$nd_color_2 = $this->settings_api->get_option('nd_color_2','bestt_style_two','');
		$n_fs_2 = $this->settings_api->get_option('n_fs_2','bestt_style_two','');
		$d_fs_2 = $this->settings_api->get_option('d_fs_2','bestt_style_two',''); 
		$one =  array('c_color_1'=>$c_color_1,'c_fs_1'=>$c_fs_1,'n_color_1'=>$n_color_1,'n_fs_1'=>$n_fs_1,'d_color_1'=>$d_color_1,'d_fs_1'=>$d_fs_1,'indc_color_1'=>$indc_color_1,'indc_b_color_1'=>$indc_b_color_1);
		$two =  array('bx_color_2'=>$bx_color_2,'c_color_2'=>$c_color_2,'c_fs_2'=>$c_fs_2,'nd_color_2'=>$nd_color_2,'n_fs_2'=>$n_fs_2,'d_fs_2'=>$d_fs_2);
		return array('1'=>$one,'2'=>$two);
    } 
}
