<?php
namespace Booster_Addons\Traits;
if (!defined('ABSPATH'))
    exit();

use \Elementor\Core\Settings\Manager as Settings_Manager;

trait Elb_Global{


	//Print Global HTML For Booster Addons
	public function elb_render_global_html(){
        if (is_singular()) {
	        $page_manager = Settings_Manager::get_settings_managers('page');
	        $page_model = $page_manager->get_model(get_the_ID());
	        $output_HTML = '';
	    	$booster_gb_settings = get_option('booster_gb_settings');
	        if($page_model->get_settings('elb_prgrs_enabled') == 'yes' || isset($booster_gb_settings['elb_global_prgrs']['enabled'])){	  
	        	$prgrs_type = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_type') : @$booster_gb_settings['elb_global_prgrs']['type'];
	        	$prgrs_pos = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_pos') : @$booster_gb_settings['elb_global_prgrs']['pos'];
	        	$prgrs_align = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_algn') : @$booster_gb_settings['elb_global_prgrs']['algn'];	        	
	        	$prgrs_bdr_height = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_bdr_height') : @$booster_gb_settings['elb_global_prgrs']['bdr_height'];
				$prgrs_bg_color = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_bg_color') : @$booster_gb_settings['elb_global_prgrs']['bg_color'];
				$prgrs_fill_color = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_fill_color') : @$booster_gb_settings['elb_global_prgrs']['fill_color'];
				$prgrs_animation_speed = ($page_model->get_settings('elb_prgrs_enabled') == 'yes') ?  $page_model->get_settings('elb_prgrs_animation_speed') : @$booster_gb_settings['elb_global_prgrs']['animation_speed'];

	        	$output_HTML .= '<div class="elb-prgrs-ctn" data-layout="'.esc_attr($prgrs_type).'" data-position="'.esc_attr($prgrs_pos).'" data-align="'.esc_attr($prgrs_align).'">';
					if($prgrs_type == 'bar'){
						$output_HTML .= '<div class="elb-prgrs-bar-ctn" style="height:'.$prgrs_bdr_height.'px; background:'.$prgrs_bg_color.';">';
							$output_HTML .= '<div class="elb-prgrs-bar-inside" style="background:'.$prgrs_fill_color.';-webkit-transition:'.$prgrs_animation_speed.'s; transition:'.$prgrs_animation_speed.'s;"></div>';
						$output_HTML .= '</div>';
					}

					if($prgrs_type == 'radial'){
	        			$prgrs_radial_size = $page_model->get_settings('elb_prgrs_radial_size');
	        			$cirlcePath = 'M50,10 a40,40 0 0,1 0,80 a40,40 0 0,1 0,-80';
						$output_HTML .= '<div class="elb-prgrs-radial-ctn" style="height:'.$prgrs_radial_size.'px; width:'.$prgrs_radial_size.'px;">';
							$output_HTML .= '<svg class="elb-prgrs-radial-insider" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMinYMin meet" class="svg-content"><path style="stroke:'.$prgrs_bg_color.'; stroke-width:'.$prgrs_bdr_height.';" d="'.$cirlcePath.'"/></svg>'; 
							$output_HTML .= '<svg class="elb-prgrs-circle" width="100%" height="100%" viewBox="0 0 100 100" preserveAspectRatio="xMinYMin meet" class="svg-content"><path style="stroke:'.$prgrs_fill_color.'; stroke-width:'.$prgrs_bdr_height.';" d="'.$cirlcePath.'"/></svg>'; 
							
						$output_HTML .= '<div class="elb-prgrs-radial-txt"><span>0</span>%</div>';
						$output_HTML .= '</div>';
					}
	        	$output_HTML .='</div>';
	        }
		
			echo $output_HTML;
		}
	}


	//SAVE GLOBAL SETTINGS
	public function elb_save_global_settings($post_id, $editor_data){
		$page_manager = Settings_Manager::get_settings_managers('page');
	    $page_model = $page_manager->get_model($post_id);
	    $booster_gb_settings = get_option('booster_gb_settings');
	    
	   if($page_model->get_settings('elb_prgrs_global_enabled') == 'yes') {
	    	$booster_gb_settings = [];
	    	$booster_gb_settings['elb_global_prgrs'] = [
                'post_id' => $post_id,
                'enabled' => $page_model->get_settings('elb_prgrs_global_enabled'),
               #'display_condition' => $page_model->get_settings('eael_ext_reading_progress_global_display_condition'),
                'type'  => $page_model->get_settings('elb_prgrs_type'),
				'algn'  => $page_model->get_settings('elb_prgrs_algn'),
				'pos'  => $page_model->get_settings('elb_prgrs_pos'),
				'bdr_height'  => $page_model->get_settings('elb_prgrs_bdr_height'),
				'radial_size'  => $page_model->get_settings('elb_prgrs_radial_size'),
				'bg_color'  => $page_model->get_settings('elb_prgrs_bg_color'),
				'fill_color'  => $page_model->get_settings('elb_prgrs_fill_color'),
				'animation_speed'  => $page_model->get_settings('elb_prgrs_animation_speed')
            ];
	   }else{
            if(isset($booster_gb_settings['elb_global_prgrs']['post_id']) && $booster_gb_settings['elb_global_prgrs']['post_id'] == $post_id) {	   	
	    		$booster_gb_settings['elb_global_prgrs'] = [];
	    	}
	 }

	    update_option('booster_gb_settings', $booster_gb_settings);
	}

}