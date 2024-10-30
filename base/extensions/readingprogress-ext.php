<?php
namespace Elementor;
/*
	EXTENSIONS : Reading Progress
*/
if (!defined('ABSPATH')) exit; 

add_action('elementor/documents/register_controls', function($element){
	$booster_gb_settings = get_option('booster_gb_settings');
	$element->start_controls_section(
		'elb_reading_progress_section',
		[
			'label' => esc_html__('Booster Reading Progress', 'booster-addons'),
			'tab' => Controls_Manager::TAB_SETTINGS,
		]
	);

	$element->add_control(
		'elb_prgrs_enabled',
		[
			'label' => esc_html__( 'Enable Reading Progress', 'booster-addons' ),
			'type' => Controls_Manager::SWITCHER,
			'default' => 'no',
			'frontend_available' => true
		]
	);
	
	if(isset($booster_gb_settings['elb_global_prgrs']['enabled']) && $booster_gb_settings['elb_global_prgrs']['enabled'] == 'yes' && $booster_gb_settings['elb_global_prgrs']['post_id'] != get_the_ID()){
		$element->add_control(
			'elb_prgrs_global_text',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __('Progress bar is enabled globally, to change the global settings <strong><a href="' . get_bloginfo('url') . '/wp-admin/post.php?post=' . $booster_gb_settings['elb_global_prgrs']['post_id'] . '&action=elementor">Click Here</a></strong>', 'booster-addons'),
				'content_classes' => 'elb-message',
				'separator' => 'before',
				'condition' => ['elb_prgrs_enabled' => 'yes'],
			]
		);

	}else{		
		$element->add_control(
			'elb_prgrs_global_enabled',
			[
				'label' => esc_html__( 'Global Reading Progress', 'booster-addons' ),
				'description' => esc_html__( 'When enabling Global reading progress, it will be applied on all the pages.', 'booster-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => ['elb_prgrs_enabled' => 'yes'],
				'frontend_available' => true
			]
		);
	}

	$element->add_control(
		'elb_prgrs_type',
		[
			'label' => esc_html__('Reading Progress Style','booster-addons'),
			'type' => Controls_Manager::SELECT,
			'default' => 'bar',
			'label_block' => true,
			'condition' => ['elb_prgrs_enabled' => ['yes']],                
			'options' => [
				'bar' => esc_html__('Bar','booster-addons'),
				'radial' => esc_html__('Radial','booster-addons'),
			],
		]
	);
	$element->add_control(
		'elb_prgrs_algn',
		[
			'label' => esc_html__('Align','booster-addons'),
			'type' => Controls_Manager::SELECT,
            'separator' => 'before',
			'default' => 'left',
			'condition' => ['elb_prgrs_enabled' => ['yes']],                
			'options' => [
				'left' => esc_html__('Left','booster-addons'),
				'right' => esc_html__('Right','booster-addons'),
			],
		]
	);

	$element->add_control(
		'elb_prgrs_pos',
		[
			'label' => esc_html__('Position','booster-addons'),
			'type' => Controls_Manager::SELECT,
			'default' => 'top',
			'condition' => ['elb_prgrs_enabled' => ['yes']],                
            'separator' => 'after',
			'options' => [
				'top' => esc_html__('Top','booster-addons'),
				'bottom' => esc_html__('Bottom','booster-addons'),
			],
		]
	);

	$element->add_control(
		'elb_prgrs_bdr_height',
		[
			'label' => esc_html__('Tichkness', 'booster-addons'),
			'type' => Controls_Manager::NUMBER,
			'step' => '1', 'min' => '1','max' => '50', 
			'default' => '4',
			'dynamic' => ['active' => true],
			'condition' => ['elb_prgrs_enabled' => ['yes']],                
		]
	);
	$element->add_control(
		'elb_prgrs_radial_size',
		[
			'label' => esc_html__('Radial Size', 'booster-addons'),
			'type' => Controls_Manager::NUMBER,
			'step' => '10', 'min' => '20','max' => '300', 
			'default' => '100',
			'dynamic' => ['active' => true],
			'condition' => ['elb_prgrs_enabled' => ['yes'],'elb_prgrs_type' => ['radial']],                
		]
	);
	$element->add_control(
		'elb_prgrs_bg_color',
		[
			'label' => esc_html__('Background Color', 'booster-addons'),
			'type' => Controls_Manager::COLOR,
			'default' => 'transparent',
			'condition' => ['elb_prgrs_enabled' => 'yes']
		]
	);  
	$element->add_control(
		'elb_prgrs_fill_color',
		[
			'label' => esc_html__('Fill Color', 'booster-addons'),
			'type' => Controls_Manager::COLOR,
			'default' => '#776ade',
			'condition' => ['elb_prgrs_enabled' => 'yes'],
		]
	);  
	$element->add_control(
		'elb_prgrs_animation_speed',
		[
			'label' => esc_html__('Animation Speed', 'booster-addons'),
			'type' => Controls_Manager::NUMBER,
			'step' => '.1', 'min' => '0','max' => '10', 
			'default' => '0',
			'dynamic' => ['active' => true],
			'condition' => ['elb_prgrs_enabled' => ['yes']],                
		]
	);
	$element->add_control(
		'elb_prgrs_update',
		[
			'label'          => '<div class="elementor-update-preview elb-update-preview" style="background-color: #fff;display: block;"><div class="elementor-update-preview-button-wrapper" style="display:block;"><button class="elementor-update-preview-button elementor-button elementor-button-success" style="background: #d30c5c; margin: 0 auto; display:block;">Apply Changes</button></div></div>',
			'type'          => Controls_Manager::RAW_HTML,
			'condition' => ['elb_prgrs_enabled' => ['yes']],
		] 
	);

	$element->end_controls_section();


}, 10);