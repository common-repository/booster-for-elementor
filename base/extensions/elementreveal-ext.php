<?php
namespace Elementor;
/*
    EXTENSIONS : Element Reveal
*/
if (!defined('ABSPATH')) exit; 
new Elb_ElementReveal_Extension();
class Elb_ElementReveal_Extension{
    function __construct(){
		add_action('elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_scripts']);
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_controls'], 10);
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'register_controls'], 10);
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_controls'], 10);
    }



     public function enqueue_scripts(){
		wp_enqueue_script(
			'elb-inview',
			BOOSTER_ADDONS_URL . 'assets/js/inview.js',
			['jquery'],
			BOOSTER_ADDONS_VERSION,
			true
		);
    }

    function register_controls($element){ 
    	$element->start_controls_section(
            'elb_elmrveal_section',
            [
                'label' => esc_html__('Booster Element Reveal', 'booster-addons'),
                'tab' => Controls_Manager::TAB_ADVANCED,
            ]
        );
        $element->add_control(
                'elb_elmrveal_enabled',
                [
                    'label' => esc_html__('Enable Element Reveal', 'booster-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'no',
                    'description' => esc_html__('The behavior and result of the element reveal is disbaled in the edit mode for a better experience, to see the results please preview the page.', 'booster-addons' ),
                    'frontend_available' => true,
                    'prefix_class' => 'elb-rveal-el-'
                ]
            );
    	$element->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'elb_elmrveal_bg',
                'label' => esc_html__( 'Reveal Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],                
                'condition' => ['elb_elmrveal_enabled' => ['yes']],
                'selector' => '{{WRAPPER}} .elb-elementback-reveal',
            ]
        );
        $element->add_control(
            'elb_elmrveal_direction',
            [
                'label' => esc_html__('Reveal Direction', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
           		'name' => 'elb_elmrveal_direction',
                'label_block' => true,
                'options' => [
                    'from-left'	=> esc_html__('From Left', 'booster-addons'),
					'from-right'	=> esc_html__('From Right', 'booster-addons'),
					'from-top'	=> esc_html__('From Top', 'booster-addons'),
					'from-bottom'	=> esc_html__('From Bottom', 'booster-addons'),
                ],
                'condition' => ['elb_elmrveal_enabled' => ['yes']],
                #'selectors' => ['{{WRAPPER}}' => '--reveal-direction:{{elb_elmrveal_direction}};'],
                'prefix_class' => 'elb-rveal-direction-',
                'default' => 'from-top',
            ]
        );
        $element->add_control(
            'elb_elmrveal_animation_duration',
            [
           	 	'name' => 'elb_elmrveal_animation_duration',
                'label' => esc_html__('Reveal Duration', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'max' => '20','step' => '.1',
                'condition' => ['elb_elmrveal_enabled' => [ 'yes' ]],
                'default' => '1',
                'selectors' => ['{{WRAPPER}}' => '--reveal-animation-duration:{{VALUE}}s;'],
                'dynamic' => ['active' => true]
            ]
        );
        $element->add_control(
            'elb_elmrveal_animation_delay',
            [
           	 	'name' => 'elb_elmrveal_animation_delay',
                'label' => esc_html__('Reveal Delay', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'max' => '20','step' => '.1',
                'condition' => ['elb_elmrveal_enabled' => [ 'yes' ]],
                'default' => '0',
                'selectors' => ['{{WRAPPER}}' => '--reveal-animation-delay:{{VALUE}}s;'],
                'dynamic' => ['active' => true]
            ]
        );

        $element->add_control(
            'elb_elmrveal_content_animation',
            [
           		'name' => 'elb_elmrveal_content_animation',
                'label' => esc_html__('Reveal Content Animation', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                   	'none' => esc_html__('None', 'booster-addons'),    
					'zoom-in' => esc_html__('Zoom In', 'booster-addons'),    
					'zoom-out' => esc_html__('Zoom Out', 'booster-addons'),    
					'fade' => esc_html__('Fade', 'booster-addons'),    
					'from-left' => esc_html__('From Left', 'booster-addons'),    
					'from-right' => esc_html__('From Right', 'booster-addons'),    
					'from-top' => esc_html__('From Top', 'booster-addons'),    
					'from-bottom' => esc_html__('From Bottom', 'booster-addons'),    
                ],
                'condition' => ['elb_elmrveal_enabled' => ['yes']],
                #'selectors' => ['{{WRAPPER}}' => '--reveal-content-animation:{{elb_elmrveal_content_animation}};'],
                'prefix_class' => 'elb-rveal-content-animation-',
                'default' => 'from-bottom',
            ]
        );
       $element->end_controls_section();
    }

  
}