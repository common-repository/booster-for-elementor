<?php
/*
	FILE CONTAINING GLOBAL FUNCTIONS
*/ 
//Getting the Slug for the Plugin
if(!function_exists('elb_get_slug')):
	function elb_get_slug(){
		return is_multisite() ? 'elb'.get_current_blog_id() : 'elb';
	}	
endif;	

//Get single options default values
if(!function_exists('elb_get_option_default')):
	function elb_get_option_default($option_name){
		$default_settings = elb_default_settings();
		return $default_settings[$option_name];
	}
endif;	

//Get a single option
if(!function_exists('elb_get_option')):
	function elb_get_option($option_name){
		$optnameslg = elb_get_slug().'-'.$option_name;
		if(get_option($optnameslg))    
	        return get_option($optnameslg);
	    return elb_get_option_default($option_name);
	}
endif;	
	
function elb_check_pro_version() {
	if (!function_exists('get_plugins')) {
		include_once ABSPATH . '/wp-admin/includes/plugin.php';
	}
 	return is_plugin_active('booster-addons-elementor-pro/booster-addons-pro_elementor.php');
}
require_once(BOOSTER_ADDONS_PATH. 'base/traits/global.php');

if(elb_check_pro_version() == false)://Check if Pro Exists
	require_once(BOOSTER_ADDONS_PATH. 'admin/admin.php');
	require_once(BOOSTER_ADDONS_PATH. 'base/core/ajax_handler.php');
endif;
require_once(BOOSTER_ADDONS_PATH. 'base/core/widgets-bundle.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/extensions-bundle.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/icons.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/objects-decoration.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/image-maskshapes.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/sections/button-section.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/sections/iconhover-section.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/sections/modernimage-section.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/sections/testimonial-section.php');
require_once(BOOSTER_ADDONS_PATH. 'base/core/sections/wooitem-section.php');

require_once(BOOSTER_ADDONS_PATH. 'base/core/sections/csstransform-section.php');

if (did_action('elementor/loaded')) {
	/*Library*/
	require_once(BOOSTER_ADDONS_PATH. 'base/core/library/booster-library.php');
	require_once(BOOSTER_ADDONS_PATH. 'base/core/library/booster-library-manager.php');
	Elementor\ELB_Templates_Library_Manager::instance();
}





//Save an Options Vlaues
if(!function_exists('elbfree_save_option')):
	function elbfree_save_option($option_name, $option_value){
		$slug_name = elb_get_slug();
	    $option = $slug_name.'-'.$option_name; 
	    if(get_option($option))
	        update_option($option, $option_value);       
	    else {
	        add_option($option, $option_value);
	        update_option($option, $option_value);            
	    }
	}
endif;	

//List of Content Templates 
function elb_get_content_templates(){
	$templates = \Elementor\Plugin::$instance->templates_manager->get_source('local')->get_items();
	$templates_list = [];
	foreach ($templates as $tmp) :
		$templates_list[$tmp['template_id']] = $tmp['title'];
	endforeach;
	return $templates_list;
}

//Masonry Show Effect
function elb_masonry_show_effects(){
	return [
		'none' 						=>  esc_html__('None','booster-addons'),
		'fade' 						=> esc_html__('Fade','booster-addons'),
		'fadeup' 					=> esc_html__('Fade Up','booster-addons'),
		'fadedown' 					=> esc_html__('Fade Down','booster-addons'),
		'fadeleft' 					=> esc_html__('Fade Left','booster-addons'),
		'faderight' 				=> esc_html__('Fade Right','booster-addons'),
		'fadeupbig' 				=> esc_html__('Fade Up Big','booster-addons'),
		'fadedownbig' 				=> esc_html__('Fade Down Big','booster-addons'),
		'fadeleftbig' 				=> esc_html__('Fade Left Big','booster-addons'),
		'faderightbig' 				=> esc_html__('Fade Right Big','booster-addons'),
		'zoomin' 					=> esc_html__('Zoom In','booster-addons'),
		'zoomout' 					=> esc_html__('Zoom Out','booster-addons'),
		'slideup' 					=> esc_html__('Slide Up','booster-addons'),
		'slidedown' 				=> esc_html__('Slide Down','booster-addons'),
		'slideleft' 				=> esc_html__('Slide Left','booster-addons'),
		'slideright' 				=> esc_html__('Slide Right','booster-addons'),
		'slideupbig' 				=> esc_html__('Slide Up Big','booster-addons'),
		'slidedownbig' 				=> esc_html__('Slide Down Big','booster-addons'),
		'slideleftbig' 				=> esc_html__('Slide Left Big','booster-addons'),
		'sliderightbig' 			=> esc_html__('Slide Right Big','booster-addons'),
		'isotope_fallperspective' 	=> esc_html__('Fall Perspective','booster-addons'),
		'isotope_fly' 				=> esc_html__('Fly','booster-addons'),
		'isotope_flip' 				=> esc_html__('Flip','booster-addons'),
		'isotope_popup' 			=> esc_html__('Popup','booster-addons')	
	];
}

//WooCommerce Cart Icon
function elb_woo_cart_icon(){
	return [
		'cart'					=>  esc_html__('Cart Icon 1','booster-addons'),		
		'cart_n1'				=>  esc_html__('Cart Icon 2','booster-addons'),		
		'cart_n2'				=>  esc_html__('Cart Icon 3','booster-addons'),		
		'opencart'				=>  esc_html__('Cart Icon 4','booster-addons'),		
		'shopping_cart'			=>  esc_html__('Cart Icon 5','booster-addons'),		
		'shopping-cart'			=>  esc_html__('Cart Icon 6','booster-addons'),		
		'add_shopping_cart'		=>  esc_html__('Cart Icon 7','booster-addons'),		
		'shop_n1'				=>  esc_html__('Basket Icon 1','booster-addons'),		
		'shop_n2'				=>  esc_html__('Basket Icon 2','booster-addons'),		
		'shop_n3'				=>  esc_html__('Basket Icon 3','booster-addons'),		
		'shop_n4'				=>  esc_html__('Basket Icon 4','booster-addons'),		
		'shopping-bag'			=>  esc_html__('Basket Icon 5','booster-addons'),		
		'shopping_basket'		=>  esc_html__('Basket Icon 6','booster-addons'),		
		'basket'				=>  esc_html__('Basket Icon 7','booster-addons'),			
		'basket_n1'				=>  esc_html__('Basket Icon 8','booster-addons'),			
		'basket_n2'				=>  esc_html__('Basket Icon 9','booster-addons'),			
		'basket_n3'				=>  esc_html__('Basket Icon 10','booster-addons'),			
		'basket_n4'				=>  esc_html__('Basket Icon 11','booster-addons'),			
		'basket_n5'				=>  esc_html__('Basket Icon 12','booster-addons'),			
		'basket_n6'				=>  esc_html__('Basket Icon 13','booster-addons'),			
		'basket_n7'				=>  esc_html__('Basket Icon 14','booster-addons'),			
	];
}


//Icon Hover Effect
function elb_icon_hover_effects(){
	return [
		'none' =>  esc_html__('None','booster-addons'),                   
		'fade' => esc_html__('Fade','booster-addons'),
		'slideleft' => esc_html__('Slide Left','booster-addons') , 
		'slidetop' => esc_html__('Slide Top','booster-addons') , 
		'slideright' => esc_html__('Slide Right','booster-addons') , 
		'slidebottom' => esc_html__('Slide Bottom','booster-addons') , 
		'pushleft' => esc_html__('Push Left','booster-addons') , 
		'pushtop' => esc_html__('Push Top','booster-addons') , 
		'pushright' => esc_html__('Push Right','booster-addons') , 
		'pushbottom' => esc_html__('Push Bottom','booster-addons') , 
		'fadepushleft' => esc_html__('Fade Push Left','booster-addons') , 
		'fadepushtop' => esc_html__('Fade Push Top','booster-addons') , 
		'fadepushright' => esc_html__('Fade Push Right','booster-addons') , 
		'fadepushbottom' => esc_html__('Fade Push Bottom','booster-addons') , 
		'zoomin' => esc_html__('Zoom In','booster-addons') , 
		'zoomout' => esc_html__('Zoom Out','booster-addons') , 
		'sasuki' => esc_html__('Sasuki','booster-addons') , 
		'hiroshi' => esc_html__('Hiroshi','booster-addons') , 
		'haruki' => esc_html__('Haruki','booster-addons') , 
		'murawa' => esc_html__('Murawa','booster-addons') , 
		'sisawa' => esc_html__('Sisawa','booster-addons') , 
		'rotatehorizontal' => esc_html__('Rotate Horizontal','booster-addons') , 
		'rotatevertical' => esc_html__('Rotate Vertical','booster-addons') , 
		'3drotateleft' => esc_html__('3D Rotate Left','booster-addons') , 
		'3drotateright' => esc_html__('3D Rotate Right','booster-addons') , 
		'3drotatebottom' => esc_html__('3D Rotate Bottom','booster-addons') , 
		'3drotatetop' => esc_html__('3D Rotate Top','booster-addons') , 
		'tada' => esc_html__('Tada','booster-addons') 
	];
}


//Button Hover Effects
function elb_button_hover_effects(){
	return [		
		'none' => esc_html__('None','booster-addons'),		
		'fade' => esc_html__('Fade','booster-addons'),		
		'pushleft' => esc_html__('Push Left','booster-addons'),		
		'pushright' => esc_html__('Push Right','booster-addons'),		
		'pushtop' => esc_html__('Push Top','booster-addons'),		
		'pushbottom' => esc_html__('Push Bottom','booster-addons'),		
		'fillleft' => esc_html__('Fill Left','booster-addons'),		
		'fillright' => esc_html__('Fill Right','booster-addons'),		
		'filltop' => esc_html__('Fill Top','booster-addons'),		
		'fillbottom' => esc_html__('Fill Bottom','booster-addons'),		
		'scaledown' => esc_html__('Scale Down','booster-addons'),		
		'scaleup' => esc_html__('Scale Up','booster-addons'),		
		'rotateleft' => esc_html__('Rotate Left','booster-addons'),		
		'rotateright' => esc_html__('Rotate Right','booster-addons'),		
		'rotatebottom' => esc_html__('Rotate Bottom','booster-addons'),		
		'rotatetop'  => esc_html__('Rotate Top','booster-addons')
	];
}


//Icon Quotes Chooser 
function elb_icon_quote_chooser(){
	return [		
		'quote' => esc_html__('Quote Icon 1', 'booster-addons'),
		'quote-left' => esc_html__('Quote Icon 2', 'booster-addons'),
		'quote-right' => esc_html__('Quote Icon 3', 'booster-addons'),
		'quotes-left' => esc_html__('Quote Icon 4', 'booster-addons'),
		'quotes-right' => esc_html__('Quote Icon 5', 'booster-addons'),
		'left-quote' => esc_html__('Quote Icon 6', 'booster-addons'),
		'right-quote' => esc_html__('Quote Icon 7', 'booster-addons'),
		'left-quote-alt' => esc_html__('Quote Icon 9', 'booster-addons'),
		'right-quote-alt' => esc_html__('Quote Icon 10', 'booster-addons'),
		'format_quote' => esc_html__('Quote Icon 11', 'booster-addons'),
	];
}

//Icon Side Position
function elb_icon_side_positions(){
	return [		
		'left-top' => esc_html__('Left Top', 'booster-addons'),
		'left-center' => esc_html__('Left Center', 'booster-addons'),
		'left-bottom' => esc_html__('Left Bottom', 'booster-addons'),
		'right-top' => esc_html__('Right Top', 'booster-addons'),
		'right-center' => esc_html__('Right Center', 'booster-addons'),
		'right-bottom' => esc_html__('Right Bottom', 'booster-addons'),
		
	];
}


//Image Positions
function elb_image_positions_map(){
	return [		
		'left top' => esc_html__('Left Top', 'booster-addons'),
		'left center' => esc_html__('Left Center', 'booster-addons'),
		'left bottom' => esc_html__('Left Bottom', 'booster-addons'),
		'center center' => esc_html__('Center Center', 'booster-addons'),
		'center top' => esc_html__('Center Top', 'booster-addons'),
		'center bottom' => esc_html__('Center Bottom', 'booster-addons'),
		'right top' => esc_html__('Right Top', 'booster-addons'),
		'right center' => esc_html__('Right Center', 'booster-addons'),
		'right bottom' => esc_html__('Right Bottom', 'booster-addons'),
		
	];
}
//Image Repeat
function elb_image_repeat_map(){
	return [
        'no-repeat' => esc_html__('No Repeat', 'booster-addons'),
		'repeat' => esc_html__('Repeat', 'booster-addons'),
        'repeat-x' => esc_html__('Repeat X', 'booster-addons'),
        'repeat-y' => esc_html__('Repeat Y', 'booster-addons'),
		'space' => esc_html__('Space', 'booster-addons'),
		'round' => esc_html__('Round', 'booster-addons'),
        'round space' => esc_html__('Round Space', 'booster-addons'),
        'repeat space' => esc_html__('Repeat Space', 'booster-addons'),
        'repeat round' => esc_html__('Repeat Round', 'booster-addons'),
        'no-repeat round' => esc_html__('No Repeat Round', 'booster-addons'),		
        'no-repeat space' => esc_html__('No Repeat Space', 'booster-addons'),		
	];
}


//Image Size
function elb_image_size_map(){
	return [		
		'auto' => esc_html__('Auto', 'booster-addons'),
		'contain' => esc_html__('Contain', 'booster-addons'),
		'cover' => esc_html__('Cover', 'booster-addons'),
		'initial' => esc_html__('Custom', 'booster-addons'),		
	];
}



//Modal Element Show Effects
function elb_modal_show_effects(){
	return [		
		'km-effect-1' => esc_html__("Fade in / Scale",'booster-addons'),		
		'km-effect-2' => esc_html__("Slide in (right)",'booster-addons'),		
		'km-effect-3' => esc_html__("Slide in (bottom)",'booster-addons'),		
		'km-effect-4' => esc_html__("Newspaper",'booster-addons'),		
		'km-effect-5' => esc_html__("Fall",'booster-addons'),		
		'km-effect-6' => esc_html__("Side Fall",'booster-addons'),		
		'km-effect-8' => esc_html__("3D Flip (horizontal)",'booster-addons'),		
		'km-effect-9' => esc_html__("3D Flip (vertical)",'booster-addons'),		
		'km-effect-10' => esc_html__("3D Sign",'booster-addons'),		
		'km-effect-11' => esc_html__("Super Scaled",'booster-addons'),		
		'km-effect-12' => esc_html__("Just Me",'booster-addons'),		
		'km-effect-13' => esc_html__("3D Slit",'booster-addons'),		
		'km-effect-14' => esc_html__("3D Rotate Bottom",'booster-addons'),		
		'km-effect-15' => esc_html__("3D Rotate In Left",'booster-addons'),		
		'km-effect-16' => esc_html__("Blur",'booster-addons'),		
	];
}

//Tow Elements Hover Effects
function elb_two_elements_hover_effects(){
	return [
		'fade' => esc_html__('Fade In', 'booster-addons'),                   
		'move_left' => esc_html__('Move Left', 'booster-addons'),                   
		'move_top' => esc_html__('Move Top', 'booster-addons'),                   
		'move_right' => esc_html__('Move Right', 'booster-addons'),                   
		'move_bottom' => esc_html__('Move Bottom', 'booster-addons'),                   
		'zoom_in' => esc_html__('Zoom In', 'booster-addons'),                   
		'zoom_out' => esc_html__('Zoom Out', 'booster-addons'),        
		'card_left' => esc_html__('Card Left', 'booster-addons'),                   
		'card_top' => esc_html__('Card Top', 'booster-addons'),                   
		'card_right' => esc_html__('Card Right', 'booster-addons'),                   
		'card_bottom' => esc_html__('Card Bottom', 'booster-addons'),                   
	];
}



//Modal Element Show Effects
function elb_transition_timing_type(){
	return [		
		'ease' => esc_html__('Ease', 'booster-addons'),
		'ease-in-out' => esc_html__('Ease In Out', 'booster-addons'),
		'ease-in' => esc_html__('Ease In', 'booster-addons'),
		'ease-out' => esc_html__('Ease Out', 'booster-addons'),
		'cubic-bezier(.15,.48,1,.43)' => esc_html__('Cubic Bezier 1', 'booster-addons'),
		'cubic-bezier(0.14,-0.03, 1, 0.43)' => esc_html__('Cubic Bezier 2', 'booster-addons'),	
	];
}

//Custom Modern Images Size
function elb_custom_images_sizes(){
	return [
	    'full'                                                 =>  esc_html__( 'Full Size','booster-addons'),                    
	    'certaindev_elements-modernimage-grid'                      =>  esc_html__( '(Grid Like)','booster-addons'),                   
	    'certaindev_elements-modernimage-masonryextrasmall'         =>  esc_html__( '(Masonry Like) Extra Small','booster-addons'),    
	    'certaindev_elements-modernimage-masonrysmall'              =>  esc_html__( '(Masonry Like) Small','booster-addons'),          
	    'certaindev_elements-modernimage-masonrymedium'             =>  esc_html__( '(Masonry Like) Medium','booster-addons'),         
	    'certaindev_elements-modernimage-masonrytall'               =>  esc_html__( '(Masonry Like) Tall','booster-addons'),           
	    'certaindev_elements-modernimage-metrosquare'               =>  esc_html__( '(Metro Like) Square','booster-addons'),            
	    'certaindev_elements-modernimage-metrowide'                 =>  esc_html__( '(Metro Like) Wide','booster-addons'),              
	    'certaindev_elements-modernimage-metrotall'                 =>  esc_html__( '(Metro Like) Tall','booster-addons'),
	];
}
function elb_modern_images_styles(){
	return [
	    'mercury'   => esc_html__( 'Mercury','booster-addons') ,
		'venus'     => esc_html__( 'Venus','booster-addons') ,
		'neptune'   => esc_html__( 'Neptune','booster-addons') ,
		'uranus'    => esc_html__( 'Uranus','booster-addons') ,
		'pluto'     => esc_html__( 'Pluto','booster-addons') , 
	];
}


function elb_custom_images_show_effect(){
	return [
	    'fade' =>  esc_html__('Fade','booster-addons'),                    
	    'slideleft' =>  esc_html__('Slide Left','booster-addons'),                    
	    'slidetop' =>  esc_html__('Slide Top','booster-addons'),                    
	    'slideright' =>  esc_html__('Slide Right','booster-addons'),                    
	    'slidebottom' =>  esc_html__('Slide Bottom','booster-addons'),                    
	    'zoomin' =>  esc_html__('Zoom In','booster-addons'),                    
	    'zoomout' =>  esc_html__('Zoom Out','booster-addons'),                    
	    'revealtop' =>  esc_html__('Reveal Top','booster-addons'),                    
	    'revealbottom' =>  esc_html__('Reveal Bottom','booster-addons'),                    
	    'popup' =>  esc_html__('Pop Up','booster-addons'),                    
	];
}

function elb_custom_images_show_ovl_effect(){
	return [
	    'fade' =>  esc_html__('Fade','booster-addons'),                    
	    'slideleft' =>  esc_html__('Slide Left','booster-addons'),                    
	    'slidetop' =>  esc_html__('Slide Top','booster-addons'),                    
	    'slideright' =>  esc_html__('Slide Right','booster-addons'),                    
	    'slidebottom' =>  esc_html__('Slide Bottom','booster-addons'),  
	    'fadeleft' =>  esc_html__('Fade Left','booster-addons'),                    
	    'fadetop' =>  esc_html__('Fade Top','booster-addons'),                    
	    'faderight' =>  esc_html__('Fade Right','booster-addons'),                    
	    'fadebottom' =>  esc_html__('Fade Bottom','booster-addons'),                    
	    'zoomin' =>  esc_html__('Zoom In','booster-addons'),                    
	    'rotatezoom' =>  esc_html__('Rotate Zoom','booster-addons'),                    
	];
}




//Render the Link 
function elb_render_elementor_link($link, $content, $isFull = false,$custom_class = '', $custom_attributes = ''){
	$output = $content;
	$customClass = ($isFull) ? ' elb-fs-a ' : '';
	$customClass .= $custom_class;
	if(!empty($link['url'])){
		$output = '<a href="'.esc_url($link['url']).'" class="'.esc_attr($customClass).'" '.$custom_attributes;
		$output .= ($link['is_external']) ? ' target="_blank" ' : '';
		$output .= ($link['nofollow']) ? ' rel="nofollow" ' : '';
		$output .= '>'.$content.'</a>';
	}
	return $output;
}	


//Render Advanced Icon
function elb_render_icon($settings){
	$output = '';	
	$output .= '<div class="elb-icon-ctn elb-icon-hvctn elb-btn-item elb-btn-item-element" data-rotation="'.esc_attr($settings['rotation']).'" data-hover="'.esc_attr($settings['effect']).'">';
		$output .= '<div class="elb-theicon elb-icon-r elb-icc-r elb-tr-3 elb-btn-item-txt elb-btn-item-txt-r elb-btn-item-r">'.\Elementor\CertainDev_Icons::get_icon($settings['icon'], $settings['icon_color'], $settings['icon_size']).'</div>';
		$output .= '<div class="elb-thebg elb-bg-r elb-icc-r elb-tr-3 elb-btn-item-back elb-btn-item-back-r elb-btn-item-r "></div>';
		if($settings['effect'] != 'none'):
			$output .= '<div class="elb-theicon elb-icon-h elb-icc-h elb-tr-3 elb-btn-item-txt elb-btn-item-txt-h elb-btn-item-h">'.\Elementor\CertainDev_Icons::get_icon($settings['icon'], $settings['icon_color_hover'], $settings['icon_size']).'</div>';
			$output .= '<div class="elb-thebg elb-bg-h elb-icc-h elb-tr-3 elb-btn-item-back elb-btn-item-back-h elb-btn-item-h" style="color:'.$settings['icon_bg_h_color'].';"></div>';
		endif;
		$output .= (!empty($settings['link']['url'])) ? elb_render_elementor_link($settings['link'], '', true) : '';
	$output .= '</div>';
	return $output;
}

function elb_render_infolist_icon($settings){
	$output = '';	
	$output .= '<div class="elb-icon-ctn elb-icon-hvctn elb-btn-item elb-btn-item-element" data-hover="'.esc_attr($settings['effect']).'">';
		$output .= '<div class="elb-theicon elb-icon-r elb-icc-r elb-tr-3 elb-btn-item-txt elb-btn-item-txt-r elb-btn-item-r">'.\Elementor\CertainDev_Icons::get_simple_icon($settings['icon']).'</div>';
		$output .= '<div class="elb-thebg elb-bg-r elb-icc-r elb-tr-3 elb-btn-item-back elb-btn-item-back-r elb-btn-item-r "></div>';
		if($settings['effect'] != 'none'):
			$output .= '<div class="elb-theicon elb-icon-h elb-icc-h elb-tr-3 elb-btn-item-txt elb-btn-item-txt-h elb-btn-item-h">'.\Elementor\CertainDev_Icons::get_simple_icon($settings['icon']).'</div>';
			$output .= '<div class="elb-thebg elb-bg-h elb-icc-h elb-tr-3 elb-btn-item-back elb-btn-item-back-h elb-btn-item-h"></div>';
		endif;
		$output .= (!empty($settings['link']['url'])) ? elb_render_elementor_link($settings['link'], '', true) : '';
	$output .= '</div>';
	return $output;
}



//Render Advanced Button
function elb_render_button($settings,$icon_colors, $type, $align ='left',$action = 'none'){
	$output = '';	
	$attributes = '  data-hover="'.esc_attr($settings['btn_hover_effect']).'" data-layout="'.esc_attr($settings['btn_layout']).'" data-text-align="'.esc_attr($settings['btn_txt_align']).'" data-icon-pos="'.esc_attr($settings['btn_icon_align']).'" ';
	$attributes .= ($type == 'real') ? ' data-btn-align="'.esc_attr($settings['btn_align']).'"  data-fullwidth="'.esc_attr($settings['btn_full_width']).'" ' : ' data-btn-align="'.esc_attr($align).'" ';
	$attributes .= ($action != 'none') ? $action : '';

	$output .= '<div class="elb-btn-ctn" '.$attributes.'>';
		$output .= '<div class="elb-btn-insider elb-tr-3">';
			
			$output .= elb_render_btn_content($settings,$icon_colors,'r');
			$output .= '<div class="elb-btn-bg elb-btn-bg-r elb-btn-el-r elb-tr-3"></div>';
			
			if($settings['btn_hover_effect'] != 'none'):
				$output .=  elb_render_btn_content($settings,$icon_colors,'h');
				$output .= '<div class="elb-btn-bg elb-btn-bg-h elb-btn-el-h elb-tr-3"></div>';
			endif;	
			
			if(!empty($settings['btn_link']['url'])):
				$output .= '<a href="'.esc_url($settings['btn_link']['url']).'" ';
				$output .= ($settings['btn_link']['is_external']) ? ' target="_blank" ' : '';
				$output .= ($settings['btn_link']['nofollow']) ? ' rel="nofollow" ' : '';
				$output .= '></a>';
			endif;	

		$output .= '</div>';
	$output .= '</div>';

	return $output;
}


//Render Icon in the Buttton Elements
function elb_render_btn_content($settings,$icon_colors,$type){	
	$output = $inside_content = '';
	$text_area = '<span>'.wp_kses_post($settings['btn_txt']).'</span>';
	$name_suff = ($type == 'h') ? '_hv' : '';
	if($settings['btn_layout'] != 'noicon'):
		$icon_area = '<div class="elb-btn-ic elb-btn-ic-'.$type.' elb-btn-el-'.$type.'">'.\Elementor\CertainDev_Icons::get_icon($settings['btn_icon'], $icon_colors['btn_icon_color'.$name_suff], $settings['btn_icon_size']).'</div>';
		if($settings['btn_layout'] == 'withicon'):
			$inside_content = ($settings['btn_icon_align'] == 'left') ? $icon_area.''.$text_area : $text_area.''.$icon_area;
		elseif($settings['btn_layout'] == 'justicon'):
			$inside_content = $icon_area;
		endif;	
	else:
		$inside_content = $text_area;
	endif;
	$output .= '<div class="elb-btn-txt elb-btn-txt-'.$type.' elb-btn-el-'.$type.' elb-tr-3">'.$inside_content.'</div>';
	return $output;
}



//Getting a List of Social Profiles Along with there info
function elb_social_array(){
	return [
		'facebook'		=>	['#3b5999'	,	esc_html__('Facebook','booster-addons')			,	'facebook3'		 , 'https://facebook.com/sharer/sharer.php?u='],
		'twitter'		=>	['#55acee'	,	esc_html__('Twitter','booster-addons')			,	'twitter'		 , 'https://twitter.com/intent/tweet/?url='],
		'linkedin'		=>	['#0077B5'	,	esc_html__('LinkedIn','booster-addons')			,	'linkedin3'		 , 'https://www.linkedin.com/shareArticle?mini=true&amp;url='],
		'instagram'		=>	['#e4405f'	,	esc_html__('Instagram','booster-addons')			,	'instagram2'	 , ''],
		'google'		=>	['#dd4b39'	,	esc_html__('Google +','booster-addons')			,	'google-plus'	 , ''],
		'youtube'		=>	['#cd201f'	,	esc_html__('YouTube','booster-addons')			,	'youtube3'		 , ''],
		'skype'			=>	['#00AFF0'	,	esc_html__('Skype','booster-addons')				,	'skype2'		 , ''],
		'wordpress'		=>	['#21759b'	,	esc_html__('WordPress','booster-addons')			,	'wordpress'		 , ''],
		'vimeo'			=>	['#1ab7ea'	,	esc_html__('Vimeo','booster-addons')				,	'vimeo3'		 , ''],
		'slideshare'	=>	['#0077b5'	,	esc_html__('SlideShare','booster-addons')		,	'slideshare'	 , ''],
		'vk'			=>	['#4c75a3'	,	esc_html__('VK','booster-addons')				,	'vk2'			 , 'http://vk.com/share.php?url='],
		'tumblr'		=>	['#34465d'	,	esc_html__('Tumblr','booster-addons')			,	'tumblr3'		 , 'https://www.tumblr.com/widgets/share/tool?posttype=link&amp;canonicalUrl='],
		'reddit'		=>	['#ff5700'	,	esc_html__('Reddit','booster-addons')			,	'reddit'		 , 'https://reddit.com/submit/?url='],
		'pinterest'		=>	['#bd081c'	,	esc_html__('Pinterest','booster-addons')			,	'pinterest-p'	 , 'https://pinterest.com/pin/create/button/?url='],
		'vine'			=>	['#00b489'	,	esc_html__('Vine','booster-addons')				,	'vine2'			 , ''],
		'slack'			=>	['#3aaf85'	,	esc_html__('Slack','booster-addons')				,	'slack'			 , ''],
		'quora'			=>	['#b92b27'	,	esc_html__('Quora','booster-addons')				,	'question2'		 , ''],
		'behance'		=>	['#131418'	,	esc_html__('Behance','booster-addons')			,	'behance'		 , ''],
		'xing'			=>	['#006567'	,	esc_html__('Xing','booster-addons')				,	'xing3'			 , 'https://www.xing.com/app/user?op=share;url='],
		'flickr'		=>	['#ff0084'	,	esc_html__('Flickr','booster-addons')			,	'flickr2'		 , ''],
		'dribbble'		=>	['#ea4c89'	,	esc_html__('Dribbble','booster-addons')			,	'dribbble2'		 , ''],
		'spotify'		=>	['#84bd00'	,	esc_html__('Spotify','booster-addons')			,	'spotify2'		 , ''],
		'rss'			=>	['#ff6600'	,	esc_html__('RSS','booster-addons')				,	'rss'			 , ''],
		'dropbox'		=>	['#007ee5'	,	esc_html__('Dropbox','booster-addons')			,	'dropbox2'		 , ''],
		'github'		=>	['#333333'	,	esc_html__('GitHub','booster-addons')			,	'github2'		 , ''],
		'digg'			=>	['#333333'	,	esc_html__('Digg','booster-addons')				,	'digg'			 , ''],
		'soundcloud'	=>	['#ff3300'	,	esc_html__('SoundCloud','booster-addons')		,	'soundcloud'	 , ''],
		'snapchat'		=>	['#FFFC00'	,	esc_html__('Snapchat','booster-addons')			,	'snapchat-ghost' , ''],
		'blogger'		=>	['#f57d00'	,	esc_html__('Blogger','booster-addons')			,	'blogger'		 , ''],
		'foursquare'	=>	['#f94877'	,	esc_html__('FourSquare','booster-addons')		,	'foursquare'	 , ''],
		'twitch'		=>	['#4a367c'	,	esc_html__('Twitch','booster-addons')			,	'twitch2'		 , ''],
		'telegram'		=>	['#54a9eb'	,	esc_html__('Telegram','booster-addons')			,	'telegram'		 , 'https://telegram.me/share/url?url='],
	];

}

//Social Find US Select
function elb_social_findus_array(){
	$result = [];
	foreach (elb_social_array() as $key => $social) {
		$result[$key] = $social[1];	
	}
	return $result;
}



//Render Single Social Icon
function elb_render_social_content($type, $social_array,$social_id,$social_link,$social_styling){
	$icon_class = ($social_styling['clr_scheme_en'] == 'yes') ? ' elb-ss-cl-'.$social_id : '';
	$bg_class = ($social_styling['bg_scheme_en'] == 'yes') ? ' elb-ss-bg-'.$social_id. '-aft elb-ss-cl-'.$social_id : '';
	$bg_class .= ($social_styling['br_scheme_en'] == 'yes') ? ' elb-ss-br-'.$social_id.'-aft ' : '';

	$social_output = '<div class="elb-social-item elb-btn-item elb-social-'.$social_id.'" data-hover="'.esc_attr($social_styling['hover_effect']).'">';
		$social_output .= '<div class="elb-btn-item-txt elb-btn-item-txt-r elb-btn-item-r '.$icon_class .'">'.\Elementor\CertainDev_Icons::get_icon_minimal($social_array[$social_id][2]).'</div>';
		$social_output .= '<div class="elb-btn-item-back elb-btn-item-back-r elb-btn-item-r '.$bg_class.'"></div>';

		if($social_styling['hover_effect'] != 'none'):
			$icon_class_h = ($social_styling['clr_scheme_en_h'] == 'yes') ? ' elb-ss-cl-'.$social_id : '';
			$bg_class_h = ($social_styling['bg_scheme_en_h'] == 'yes') ? ' elb-ss-bg-'.$social_id. '-aft elb-ss-cl-'.$social_id : '';
			$bg_class_h .= ($social_styling['br_scheme_en_h'] == 'yes') ? ' elb-ss-br-'.$social_id.'-aft ' : '';

			$social_output .= '<div class="elb-btn-item-txt elb-btn-item-txt-h elb-btn-item-h '.$icon_class_h .'">'.\Elementor\CertainDev_Icons::get_icon_minimal($social_array[$social_id][2]).'</div>';
			$social_output .= '<div class="elb-btn-item-back elb-btn-item-back-h elb-btn-item-h '.$bg_class_h.'"></div>';
		endif;
		if($social_styling['hover_effect'] == 'tada'):
			$tada_class = ($social_styling['bg_scheme_en_h'] == 'yes') ? ' elb-ss-bg-'.$social_id : '';
			$social_output .= '<div class="elb-eff-tada tada-eff-top"><div class="tada-eff-insider '.$tada_class.' tada-eff-insider-one"></div></div>							
						<div class="elb-eff-tada tada-eff-top-left"><div class="tada-eff-insider '.$tada_class.' tada-eff-insider-one"></div></div>							
						<div class="elb-eff-tada tada-eff-top-right"><div class="tada-eff-insider '.$tada_class.' tada-eff-insider-one"></div></div>							
						<div class="elb-eff-tada tada-eff-bottom"><div class="tada-eff-insider '.$tada_class.' tada-eff-insider-two"></div></div>							
						<div class="elb-eff-tada tada-eff-bottom-left"><div class="tada-eff-insider '.$tada_class.' tada-eff-insider-two"></div></div>							
						<div class="elb-eff-tada tada-eff-bottom-right"><div class="tada-eff-insider '.$tada_class.' tada-eff-insider-two"></div></div>							
						<div class="elb-eff-tada tada-eff-center-right"><div class="tada-eff-center-insider '.$tada_class.' tada-eff-insider-three"></div></div>							
						<div class="elb-eff-tada tada-eff-center-left"><div class="tada-eff-center-insider '.$tada_class.' tada-eff-insider-four"></div></div>';
		endif;

		if($social_link != '' && $type == 'find_us'):
			$social_output .= '<a class="elb-fslink" href="'.esc_url($social_link).'" target="'.esc_url($social_styling['open_in']).'"></a>';
		endif;

		if($type == 'share'):			 
			$link_share =  $social_array[$social_id][3] .''. ($social_styling['what_share'] == 'page' ? get_the_permalink() : $social_styling['link_share']);
			$social_output .= ($social_styling['open_in'] == 'tab') ? '<a class="elb-fslink" href="'.esc_url($link_share).'" target="_blank"></a>' : '<div class="elb-fslink" onclick="elb_social_share(this)" data-url="'.esc_url($link_share).'"></div>'; 
		endif;
	$social_output .= '</div>';
	
	return $social_output;
}


//Render Full Screen Content Element
function elb_render_fulscreen_element($settings,$modal_id,$icon_colors,$content,$cls_icon = ''){
	$output = '';
	$output .= '<div class="elb-mdl-ctn elb-fs-ctn" data-modal-id="modal-'.esc_attr($modal_id).'" data-situation="inactive" >';
            $output .= '<div class="elb-mdl-fs elb-flex-ctn '.$settings['show_effect'].'" data-hrz-pos="'.esc_attr($settings['content_hrz_pos']).'" data-vrt-pos="'.esc_attr($settings['content_vrt_pos']).'" data-modal-id="modal-'.esc_attr($modal_id).'" data-modal-effect="'.esc_attr($settings['show_effect']).'">';
	   			$output .= ($settings['cls_icon_layout'] == 'outside' && (!isset($settings['close_layout']) || in_array($settings['close_layout'], ['only_icon','both'])) ) ? 
                        '<div class="elb-mdl-w-cls-icon elb-tr-2" data-layout="'.esc_attr($settings['cls_icon_layout'] ).'" onclick="elb_change_situation(this,\'inactive\', \'parent\', \'.elb-mdl-ctn\')" data-align="'.$settings['cls_icon_pos'].'" data-radius="'.esc_attr($settings['cls_icon_radius']).'"></div>' : ''; 
            
                $output .= '<div class="elb-mdl-bg"></div>';
                $output .= '<div class="elb-mdl-content elb-tr-5">'.$content;
              	  $output .= ($settings['cls_icon_layout'] == 'inside' ) ? $cls_icon : '';
            	$output .= '</div>'; 
            $output .= '</div>'; 
            $output .= elb_render_button($settings,$icon_colors,'real','',' onclick="elb_change_situation(this,\'active\', \'parent\', \'.elb-mdl-ctn\')" ');
    $output .= '</div>';
    return $output;
}


//MODERN IMAGES OUTPUT
function elb_modernimage_output($settings, $masonry = false){
	$output = $ctn_attr = $insider_attr = '';

	$insider_attr .= ($settings['3d_enabled'] == 'enabled') ? ' data-tilt data-3d-enabled="enabled" data-max-tilt="'.esc_attr($settings['max_tilt']).'" data-scale-tilt="'.esc_attr($settings['scale_tilt']).'"  data-tilt-glare="'.esc_attr($settings['glare_tilt_enabled']).'" data-tilt-glare-value="'.esc_attr($settings['glare_tilt_value']).'" data-tilt-reset="'.esc_attr($settings['reset_tilt_enabled']).'" ' : '';

	$ctn_attr .= ' data-container-frame="'.esc_attr($settings['frame_enabled']).'" data-content-showeffect="'.esc_attr($settings['show_content_effect']).'"  data-overlay-showeffect="'.esc_attr($settings['show_ovl_effect']).'" data-columnposition="'.esc_attr($settings['hrz_pos']).'"  data-rowposition="'.esc_attr($settings['vrt_pos']).'" data-portfoliostyle="'.esc_attr($settings['style']).'" data-hover-image="none" data-overlay-type="normal" data-bordersize="medium" ';	
	$custom_class = isset($settings['cst_classes']) ? $settings['cst_classes'] : '';
	$custom_class_insider = isset($settings['cst_classes_insider']) ? $settings['cst_classes_insider'] : '';
	$ctn_attr .= ($masonry) ? ' data-isotope-situation="hidden" ' : '';
	$linkHref = '';
	if(!empty($settings['link']['url'])){
		$linkHref = 'href="'.esc_url($settings['link']['url']).'"';
		$linkHref .= ($settings['link']['is_external']) ? ' target="_blank" ' : '';
		$linkHref .= ($settings['link']['nofollow']) ? ' rel="nofollow" ' : '';
	}	
		

	$output .= '<a class="elb-lportf-ctn elb-hvimage-ctn elb-masonry-item elb-hvimage-'.$settings['style'].' '.$custom_class.'" '.$ctn_attr.' '.$linkHref.'>';
			$output .= '<div class="elb-hvimage-insider elb-portfolio-insider elb-masonry-item-insider elb-tilt-ctn '.$custom_class_insider.'" '.$insider_attr.'>';	
			#$output .= elb_render_elementor_link($settings['link'], '', true);				
				switch ($settings['style']) {
					case 'mercury':
						$output .= elb_modernimage_output_mercury($settings);
						break;
					case 'venus':
						$output .= elb_modernimage_output_venus($settings);
						break;
					case 'neptune':
						$output .= elb_modernimage_output_neptune($settings);
						break;
					case 'uranus':
						$output .= elb_modernimage_output_uranus($settings);
						break;
					case 'pluto':
						$output .= elb_modernimage_output_pluto($settings);
						break;				
				}
		$output .= '</div>';
	$output .= '</a>';
    return $output;
}

#Mercury Style
function elb_modernimage_output_mercury($settings){
	$output = '';
	$output .= '<div class="elb-lportf-overlay elb-hvimage-overlay elb-tr-3">';
		$output .= '<div class="elb-lportf-content elb-hvimage-content elb-tilt-elem">';
		$output .= '<h3 class="elb-lportf-title elb-hvimage-content-elem elb-trd-2 elb-and-2 elb-tr-4"><span class="elb-hvimage-content-elemspan ">'.wp_kses_post($settings['heading']).'</span></h3>';
		$output .= '<div class="elb-lportf-info elb-hvimage-content-elem elb-trd-3 elb-and-4 elb-tr-4"><span class="elb-hvimage-content-elemspan">'.wp_kses_post($settings['sub_heading']).'</span></div>';
		$output .= '</div>';
		$output .= '<div class="elb-lportf-border elb-hvimage-borderctn elb-tilt-elem">';
			$output .= '<div class="elb-hvimage-br elb-hvimage-bleft elb-hvimage-brlr elb-tr-3 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bright elb-hvimage-brlr elb-tr-4 elb-trd-2"></div>';
			$output .= '<div class="elb-hvimage-br elb-hvimage-btop elb-hvimage-brtb elb-tr-3 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bottom elb-hvimage-brtb elb-tr-4 elb-trd-2"></div>';
		$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="elb-lportf-background elb-hvimage-background"><img class="elb-lportf-img" src="'.esc_url($settings['image']).'" alt="'.esc_attr($settings['heading']).'"></div>';

    return $output;
}

#Venus Style
function elb_modernimage_output_venus($settings){
	$output = '';
	$output .= '<div class="elb-lportf-overlay elb-hvimage-overlay elb-tr-3">';
		$output .= '<div class="elb-lportf-content elb-hvimage-content elb-tilt-elem">';
			$output .= '<h3 class="elb-lportf-title elb-hvimage-content-elem elb-trd-2 elb-and-2 elb-tr-3"><span class="elb-hvimage-content-elemspan ">'.wp_kses_post($settings['heading']).'</span></h3>';
			$output .= '<div class="elb-lportf-info elb-hvimage-content-elem elb-trd-3 elb-and-4 elb-tr-3"><span class="elb-hvimage-content-elemspan">'.wp_kses_post($settings['sub_heading']).'</span></div>';
		$output .= '</div>';
		$output .= '<div class="elb-lportf-border elb-hvimage-borderctn elb-tilt-elem">';
			$output .= '<div class="elb-hvimage-br elb-hvimage-bleft elb-hvimage-brlr elb-tr-3 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bright elb-hvimage-brlr elb-tr-3 elb-trd-2"></div>';
			$output .= '<div class="elb-hvimage-br elb-hvimage-btop elb-hvimage-brtb elb-tr-3 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bottom elb-hvimage-brtb elb-tr-3 elb-trd-2"></div>';
		$output .= '</div>';	
	$output .= '</div>';
	$output .= '<div class="elb-lportf-background elb-hvimage-background"><img class="elb-lportf-img" src="'.esc_url($settings['image']).'" alt="'.esc_attr($settings['heading']).'"></div>';
    return $output;
}


#Neptune Style
function elb_modernimage_output_neptune($settings){
	$output = '';
	$output .= '<div class="elb-lportf-overlay elb-hvimage-overlay elb-tr-3 elb-tilt-elem">';
		$output .= '<div class="elb-lportf-content elb-hvimage-content elb-tilt-elem">';
			$output .= '<h3 class="elb-lportf-title elb-hvimage-content-elem elb-trd-2 elb-and-2 elb-tr-4"><span class="elb-hvimage-content-elemspan ">'.wp_kses_post($settings['heading']).'</span></h3>';
			$output .= '<div class="elb-lportf-info elb-hvimage-content-elem elb-trd-3 elb-and-4 elb-tr-4"><span class="elb-hvimage-content-elemspan">'.wp_kses_post($settings['sub_heading']).'</span></div>';
		$output .= '</div>';
		$output .= '<div class="elb-lportf-border elb-hvimage-borderctn elb-tilt-elem">';
			$output .= '<div class="elb-hvimage-br elb-hvimage-bleft elb-hvimage-brlr elb-tr-3 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bright elb-hvimage-brlr elb-tr-4 elb-trd-2"></div>';
			$output .= '<div class="elb-hvimage-br elb-hvimage-btop elb-hvimage-brtb elb-tr-3 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bottom elb-hvimage-brtb elb-tr-4 elb-trd-2"></div>';
		$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="elb-lportf-background elb-hvimage-background"><img class="elb-lportf-img" src="'.esc_url($settings['image']).'" alt="'.esc_attr($settings['heading']).'"></div>';
	
    return $output;
}


#Uranus Style
function elb_modernimage_output_uranus($settings){
	$output = '';
	$output .= '<div class="elb-lportf-overlay elb-hvimage-overlay elb-tr-3">';
		$output .= '<div class="elb-lportf-content elb-hvimage-content elb-tilt-elem">';
			$output .= '<h3 class="elb-lportf-title elb-hvimage-content-elem elb-trd-2 elb-and-2 elb-tr-4"><span class="elb-hvimage-content-elemspan ">'.wp_kses_post($settings['heading']).'</span></h3>';
			$output .= '<div class="elb-lportf-info elb-hvimage-content-elem elb-trd-3 elb-and-4 elb-tr-4"><span class="elb-hvimage-content-elemspan">'.wp_kses_post($settings['sub_heading']).'</span></div>';
		$output .= '</div>';
		$output .= '<div class="elb-lportf-border elb-hvimage-borderctn elb-tilt-elem">';
			$output .= '<div class="elb-hvimage-br elb-hvimage-bleft elb-hvimage-brlr elb-tr-4 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bright elb-hvimage-brlr elb-tr-4 elb-trd-2"></div>';
			$output .= '<div class="elb-hvimage-br elb-hvimage-btop elb-hvimage-brtb elb-tr-4 elb-trd-2"></div><div class="elb-hvimage-br elb-hvimage-bottom elb-hvimage-brtb elb-tr-4 elb-trd-2"></div>';
		$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="elb-lportf-background elb-hvimage-background"><img class="elb-lportf-img" src="'.esc_url($settings['image']).'" alt="'.esc_attr($settings['heading']).'"></div>';
	
    return $output;
}

#Pluto Style
function elb_modernimage_output_pluto($settings){
	$output = '';
	$output .= '<div class="elb-lportf-overlay elb-hvimage-overlay elb-tr-3">';
		$output .= '<div class="elb-lportf-content elb-hvimage-content elb-tr-2 elb-tilt-elem" >';
			$output .= '<h3 class="elb-lportf-title elb-hvimage-content-elem elb-trd-2 elb-and-2 elb-tr-4"><span class="elb-hvimage-content-elemspan">'.wp_kses_post($settings['heading']).'</span></h3>';
			$output .= '<div class="elb-lportf-info elb-hvimage-content-elem elb-trd-3 elb-and-4 elb-tr-4"><span class="elb-hvimage-content-elemspan">'.wp_kses_post($settings['sub_heading']).'</span></div>';
		$output .= '</div>';
		$output .= '<div class="elb-hvimage-arrowctn elb-tilt-elem">';
			$output .= '<div class="elb-hvimage-arrowtop elb-hvimage-arrowitem elb-hvimage-arrowside elb-trd-4 elb-tr-4"></div>';
			$output .= '<div class="elb-hvimage-arrowline elb-hvimage-arrowitem elb-trd-3 elb-tr-4"></div>';
			$output .= '<div class="elb-hvimage-arrowbottom elb-hvimage-arrowitem elb-hvimage-arrowside elb-trd-4 elb-tr-4"></div>';
		$output .= '</div>';
	$output .= '</div>';
	$output .= '<div class="elb-lportf-background elb-hvimage-background"><img class="elb-lportf-img" src="'.esc_url($settings['image']).'" alt="'.esc_attr($settings['heading']).'"></div>';
	return $output;
}


/*
	ELB GET / UPDATE OPTIONS
*/
if(!function_exists('elb_default_settings')):		
	function elb_default_settings(){
		return [
			'active_widgets' => [
				'icon-box','card-flip','advanced-button','image-banner','pricing-plan','testimonial','single-icon','interactive-iconbox','iconbox-action','modern-video','list-infobox','counter','modal-window','social-find-us','social-share','drop-caps','image-swap','animated-heading','alert-box','threecard-flip','vertical-skillbar','countdown','modern-image','modal-anything','toggle-content','price-listing','side-navigation','fullscreen-content-slider'
			],	
			'active_extensions' => [],	
			'objects_decoration' => [],
			'image_maskshapes' => [],
			'booster_color_scheme' => 'inactive'
		];
	}
endif;	



//WooCommerce Products List
function elb_woo_products_list(){
	$products_list = [];
    $query_options = array('post_type'=> 'product', 'paged'=> 1  , 'order' => 'DESC');
    $products = new \WP_Query( $query_options );
    if ($products->have_posts()) : 
    	while ($products->have_posts()) : $products->the_post();
    		$product = new \WC_Product(get_the_ID());
    		$products_list[$product->get_id()] = get_the_title();
    	endwhile;
		 wp_reset_postdata();
    endif;	
	return $products_list;
}

//WooCommerce Get Categories List
function elb_woo_categories_list(){
	$categories_list = [];
	$args = array(
	    'taxonomy'   => "product_cat",
	    'order'      => 'DESC',
	);
	$categories = get_terms($args);
	foreach ($categories as $category) {
		$categories_list[$category->term_id] =  $category->name;
	}
	return $categories_list;
}

add_action('admin_head', 'elb_custom_dshb_logo');

function elb_custom_dshb_logo() {
  echo '<style>
    .toplevel_page_booster-addons .wp-menu-image img {opacity:1!important;}
  </style>';
}