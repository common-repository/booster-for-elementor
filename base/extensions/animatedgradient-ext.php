<?php
namespace Elementor;
/*
    EXTENSIONS : Animated Gradient
*/
if (!defined('ABSPATH')) exit; 
new Elb_AnimatedGradient_Extension();
class Elb_AnimatedGradient_Extension{
    function __construct(){
        add_action('elementor/element/section/section_layout/after_section_end', [$this, 'register_controls'], 10);
        add_action('elementor/frontend/section/after_render', [$this, 'render_output'], 10);
    }

    function register_controls($element){ 
        $element->start_controls_section(
            'elb_backgrdmv_section',
            [
                'label' => esc_html__('Booster Animated Gradient', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $element->add_control(
            'elb_backgrdmv_ext_enabled',
            [
                'label' => esc_html__('Gradient Animated Background', 'booster-addons'),
                'description' => esc_html__('Add an animated gradient background to your row.', 'booster-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
       $element->add_control(
            'elb_backgrdmv_angle',
            [
                'label' => esc_html__('Gradient Angle', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'max' => '360',
                'condition' => ['elb_backgrdmv_ext_enabled' => [ 'yes' ]],
                'default' => '270',
                'dynamic' => ['active' => true]
            ]
        );
       $element->add_control(
        'elb_backgrdmv_animation',
            [
                'label' => esc_html__('Animation Speed (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'step' => '10', 'max' => '200',
                'condition' => ['elb_backgrdmv_ext_enabled' => [ 'yes' ]],
                'default' => '20',
                'dynamic' => ['active' => true]
            ]
        );

       $repeater = new Repeater();
       $repeater->add_control(
              'elb_backgrdmv_clr',
              [
                 'label' => esc_html__('Gradient Color', 'booster-addons'),
                 'type' => Controls_Manager::COLOR,    			
                 'default' => '#333',
                 'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-listib-heading span' => 'color: {{VALUE}};']
             ]
         );
       $element->add_control(
            'elb_backgrdmv_clr_list',
            [
                'label' => esc_html__('Gradient Colors', 'booster-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'condition' => ['elb_backgrdmv_ext_enabled' => ['yes']],                
                'default' => [],
                'title_field' => '{{{ elb_backgrdmv_clr }}}',
            ]
        );
       $element->add_control(
            'elb_backgrdmv_ext_update',
            [
                'label'          => '<div class="elementor-update-preview elb-update-preview" style="background-color: #fff;display: block;"><div class="elementor-update-preview-button-wrapper" style="display:block;"><button class="elementor-update-preview-button elementor-button elementor-button-success" style="background: #d30c5c; margin: 0 auto; display:block;">Apply Changes</button></div></div>',
                'type'          => Controls_Manager::RAW_HTML,
                'condition' => ['elb_backgrdmv_ext_enabled' => ['yes']],
            ] 
        );
       $element->end_controls_section();

   }


   function render_output($element){
    	$data     = $element->get_data();
    	$type     = $data['elType'];
    	$settings = $data['settings'];	
    	if('section' === $type && 'yes' === $element->get_settings('elb_backgrdmv_ext_enabled')){
    		if(null !== $element->get_settings('elb_backgrdmv_clr_list')){
    			$gradientsArray = [];
    			foreach ($element->get_settings('elb_backgrdmv_clr_list') as $singleColor) {
    				array_push($gradientsArray, $singleColor['elb_backgrdmv_clr']);
    			}
    			$gradientsString = implode(",", $gradientsArray);
    			$size = sizeof($gradientsArray) * 200;
    			$animationSpeed = $element->get_settings('elb_backgrdmv_animation');
    			$gradientsStyle = '-webkit-animation-duration: '.$animationSpeed.'s; animation-duration: '.$animationSpeed.'s; background: linear-gradient('.$element->get_settings('elb_backgrdmv_angle').'deg, '.$gradientsString.'); background-size: '.$size.'% '.$size.'%;';			
    			$gradientContainer = '<div class="elb-gradient-section-el" style="'.$gradientsStyle.'"></div>';
    			?>
    				<script>
    					(function($){
        	                "use strict";
    						var section = $('.elementor-element-<?php echo $element->get_id(); ?>');
    						$(window).on('elementor/frontend/init', function(){	
    							$('<?php echo $gradientContainer ?>').prependTo(section);
    						});
    					}(jQuery));		
    				</script>
    			<?php 
    		}
    	}
   }
}