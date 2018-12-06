<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link      https://digitalcenturysf.com/
 * @since      1.0.0
 *
 * @package    Testimonial_Pro
 * @subpackage Testimonial_Pro/admin/partials
 */
 
 ?>

<div class="wrap"> 
    <h2><?php esc_html_e('Settings', 'testimonial-pro'); ?></h2>
    <div id="poststuff"> 
        <div id="post-body"> 
	        <div class="postbox">
	            <div class="inside">
	                <?php $this->settings_api->show_navigation();?>
	                <?php $this->settings_api->show_forms();?> 
	            </div>  
	        </div>  
        </div>    
    </div>   
</div>  
