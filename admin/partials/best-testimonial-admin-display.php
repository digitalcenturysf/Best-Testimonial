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
    <h2><?php esc_html_e('Settings', 'best-testimonial'); ?></h2>
    <div id="poststuff"> 
        <div id="post-body" class="metabox-holder columns-2"> 
        	<div id="post-body-content"> 
	            <div class="inside">
	                <?php $this->settings_api->show_navigation();?>
	                <?php $this->settings_api->show_forms();?> 
	            </div>   
	        </div> 
	        <?php include('sidebar.php'); ?>  
        </div>    
    </div>   
</div>  