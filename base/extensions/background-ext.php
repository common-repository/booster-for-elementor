<?php
namespace Elementor;
/*
	EXTENSIONS : Parallax Background Image for Background & for Overlay
*/

add_action('elementor/element/before_section_end', function($element, $section_id, $args) {
    if ('section_background' === $section_id) {
		$element->add_control(
			'elb_back_ext_hd',
			[
				'label' => esc_html__('Booster Background Extensions', 'booster-addons'),
				'separator' => 'before',
				'type' => Controls_Manager::HEADING,
			]
		);

		$element->add_control(
            'elb_back_prlx_ext_enabled',
            [
                'label' => esc_html__('Enable Background Parallax', 'booster-addons'),
                'description' => esc_html__('Please make sure you have added backgound image.', 'booster-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $element->add_control(
            '_elb_back_prlx_type',
            [
                'label' => esc_html__('Parallax Effect','booster-addons'),
                'type' => Controls_Manager::SELECT,
                #'hide_in_top' => true,
                'default' => 'onscroll',
              	'condition' => ['elb_back_prlx_ext_enabled' => ['yes']],                
                'options' => [
                    'onscroll' => esc_html__('On Scroll','booster-addons'),
                    'automove' => esc_html__('Auto Moving','booster-addons'),
                    'mousemove' => esc_html__('Follow Mouse','booster-addons'),
                ],
				'prefix_class' => 'elb-bg-prlx-type-',
            ]
        );

        $element->add_control(
            '_elb_back_prlx_hrz_direction',
            [
                'label' => esc_html__('Horizontal Direction','booster-addons'),
                'type' => Controls_Manager::SELECT,
                #'hide_in_top' => true,
                'default' => 'left',
                'condition' => ['elb_back_prlx_ext_enabled' => ['yes']],                
                'options' => [
                    'none' => esc_html__('None','booster-addons'),
                    'left' => esc_html__('Left','booster-addons'),
                    'right' => esc_html__('Right','booster-addons'),
                ],
				'prefix_class' => 'elb-bg-prlx-hrz-direction-',
            ]
        );
         $element->add_control(
            '_elb_back_prlx_hrz_speed',
            [
                'label' => esc_html__('Horizontal Speed', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'step' => '.1', 'min' => '0','max' => '1', 
                'default' => '0.75',
                'dynamic' => ['active' => true],
                'condition' => ['elb_back_prlx_ext_enabled' => ['yes'],'_elb_back_prlx_hrz_direction!' => ['none']],                
                'selectors' => ['{{WRAPPER}}' => '--elb-bg-prlx-hrz-speed: {{VALUE}};'],
            ]
        );

        $element->add_control(
            '_elb_back_prlx_vrt_direction',
            [
                'label' => esc_html__('Vertical Direction','booster-addons'),
                'type' => Controls_Manager::SELECT,
                #'hide_in_top' => true,
                'default' => 'none',
                'condition' => ['elb_back_prlx_ext_enabled' => ['yes']],                
                'options' => [
                    'none' => esc_html__('None','booster-addons'),
                    'top' => esc_html__('Top','booster-addons'),
                    'bottom' => esc_html__('Bottom','booster-addons'),
                ],
				'prefix_class' => 'elb-bg-prlx-vrt-direction-',
            ]
        );
       
        $element->add_control(
            '_elb_back_prlx_vrt_speed',
            [
                'label' => esc_html__('Verical Speed', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'step' => '.1', 'min' => '0','max' => '1', 
                'default' => '0.75',
                'dynamic' => ['active' => true],
                'condition' => ['elb_back_prlx_ext_enabled' => ['yes'],'_elb_back_prlx_vrt_direction!' => ['none']],                
                'selectors' => ['{{WRAPPER}}' => '--elb-bg-prlx-vrt-speed: {{VALUE}};'],
            ]
        );
        $element->add_control(
            'elb_back_prlx_update',
            [
                'label'          => '<div class="elementor-update-preview elb-update-preview" style="background-color: #fff;display: block;"><div class="elementor-update-preview-button-wrapper" style="display:block;"><button class="elementor-update-preview-button elementor-button elementor-button-success" style="background: #d30c5c; margin: 0 auto; display:block;">Apply Changes</button></div></div>',
                'type'          => Controls_Manager::RAW_HTML,
                'condition'   => ['elb_back_prlx_ext_enabled' => 'yes']
            ] 
        );
	}
		
},10,3);