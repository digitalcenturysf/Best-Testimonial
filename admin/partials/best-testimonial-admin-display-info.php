<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Best_Testimonial
 * @subpackage Best_Testimonial/admin/partials
 */
  
 ?>

<div class="wrap"> 
    <h2><?php esc_html_e('Best Testimonial Info:', 'best-testimonial'); ?></h2>
    <div id="poststuff"> 
        <div id="post-body" class="metabox-holder columns-2"> 
            
        	<div id="post-body-content"> 
	            <div class="inside"> 
                    <p>There are two ways to use <b><i>shortcode</i></b> to display the testimonial output.</p>
                    <p>In posts or pages editor:</p>
                    <code> [best_testimonial style="" bg_img_id="" number="" cat=""]</code> 
                    <p>In php file:</p>
                    <code> &lt;?php echo do_shortcode('[best_testimonial style="" bg_img_id="" number="" cat=""]') ?&gt;
                    </code><br>
                    <code> <b><i>Shortcode parameters:</i></b>
                       <br> <b>style:</b> Testimonial style. Insert value 1 or 2
                       <br> <b>bg_img_id:</b>  Background image. Insert image id. Go to Media > Library: Select an image and follow the url at address bar of the browser, item=image_id. 
                       <br> <b>number:</b> Number of testimonial to show. 
                       <br> <b>cat:</b> Category slug, used to display testimonial form specific category.
                    </code> <br><br>  
	            </div>   
	        </div>  
            <div id="postbox-container-1" class="postbox-container">
                <div class="meta-box-sortables">
                    <div class="postbox">
                        <h3>Support </h3>
                        <span class="support">Feel free contact us.</span>
                        <hr>
                        <div class="inside">
                            <p>Plugin : <b>Best Testimonial</b> - v<?php echo $this->version; ?> </p>
                            <p>Author : digitalcenturysf</p>
                            <p>Email : <a href="mailto:digitalcenturysf@gmail.com" target="_blank">digitalcenturysf@gmail.com</a></p> 
                            <p>Website : <a href="https://digitalcenturysf.com" target="_blank">https://digitalcenturysf.com</a></p>
                        </div>
                    </div> 
                </div> 
            </div>    
        </div>    
    </div>   
</div>  