<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_IconHover_Tab{
	
	public static function set_defaults($defaults){        
        $defaults['icon_size'] = (isset($defaults['icon_size'])) ? $defaults['icon_size'] : '30';
		$defaults['icon_size_bg'] = (isset($defaults['icon_size_bg'])) ? $defaults['icon_size_bg'] : '80';
		$defaults['image_size'] = (isset($defaults['image_size'])) ? $defaults['image_size'] : '80';               
		$defaults['icon_color'] = (isset($defaults['icon_color'])) ? $defaults['icon_color'] : ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']];
		$defaults['icon_bg'] = (isset($defaults['icon_bg'])) ? $defaults['icon_bg'] : ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]];
		$defaults['icon_radius'] = (isset($defaults['icon_radius'])) ? $defaults['icon_radius'] : ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true];
		$defaults['icon_br'] = (isset($defaults['icon_br'])) ? $defaults['icon_br'] : ['border' => ['default' => ''],'width' => ['default' => ['left'=>'0','bottom'=>'0','top'=>'0','right'=>'0']],'color' => ['default' => '']];
		$defaults['icon_bxs'] = (isset($defaults['icon_bxs'])) ? $defaults['icon_bxs'] : ['box_shadow_type' => ['default' =>'no'],'box_shadow' =>['default' => ['horizontal' => '0','vertical' => '0','blur' => '0','spread' => '0','color' => '']],'box_shadow_position' =>['default' => ' ']];
		$defaults['icon_effect'] = (isset($defaults['icon_effect'])) ? $defaults['icon_effect'] : 'none';
		$defaults['icon_color_h'] = (isset($defaults['icon_color_h'])) ? $defaults['icon_color_h'] : ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']];
		$defaults['icon_bg_h'] = (isset($defaults['icon_bg_h'])) ? $defaults['icon_bg_h'] : ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]];
		$defaults['icon_radius_h'] = (isset($defaults['icon_radius_h'])) ? $defaults['icon_radius_h'] : ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true];
		$defaults['icon_br_h'] = (isset($defaults['icon_br_h'])) ? $defaults['icon_br_h'] : ['border' => ['default' => ''],'width' => ['default' => ['left'=>'0','bottom'=>'0','top'=>'0','right'=>'0']],'color' => ['default' => '']];
		$defaults['icon_h_bxs'] = (isset($defaults['icon_h_bxs'])) ? $defaults['icon_h_bxs'] : ['box_shadow_type' => ['default' =>'no'],'box_shadow' =>['default' => ['horizontal' => '0','vertical' => '0','blur' => '0','spread' => '0','color' => '']],'box_shadow_position' =>['default' => ' ']];
		$defaults['icon_margin'] = (isset($defaults['icon_margin'])) ? $defaults['icon_margin'] : ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false];
        return $defaults;
    }

	public static function init($widget,$hover_enabled = true, $defaults = []){
		$defaults = ELB_IconHover_Tab::set_defaults($defaults);

		$widget->start_controls_section(
			'section_icon_styling',
			[
				'label' => esc_html__('Icon Area Styling', 'booster-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$widget->add_control(
			'icon_size',
			[
				'label' => esc_html__('Icon Size', 'booster-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => '5', 'max' => '300',
				'default' => $defaults['icon_size'],
				'condition' => ['icon_type' => ['icon']],
				'dynamic' => ['active' => true],
			]
		);
		$widget->add_control(
			'icon_size_bg',
			[
				'label' => esc_html__('Icon Background Size', 'booster-addons'),
				'type' => Controls_Manager::NUMBER,
				'min' => '5', 'max' => '500',
				'default' => $defaults['icon_size_bg'],
				'dynamic' => ['active' => true],
				'condition' => ['icon_type' => ['icon']],
				'selectors' => [
					'{{WRAPPER}} .elb-icon-ctn' => 'width: {{icon_size_bg}}px; height: {{icon_size_bg}}px; line-height: {{icon_size_bg}}px;',
				]
			]
		); 
		$widget->add_control(
			'image_size',
			[
				'label' => esc_html__( 'Image Width', 'booster-addons' ),
				'type' => Controls_Manager::NUMBER,
				'condition' => ['icon_type' => ['image']],
				'min' => '5', 'max' => '900',
				'default' => $defaults['image_size'],				
				'dynamic' => ['active' => true],
				'selectors' => ['{{WRAPPER}} .elb-iconarea-img' => 'width: {{VALUE}}px;'],
			]
		);
		if($hover_enabled == true):
	        //Icon Styling Normal & Hover
			$widget->start_controls_tabs( 'icon_settings_stylings' );
			$widget->start_controls_tab( 'normal_icon',
				[
					'label' => esc_html__( 'Normal', 'booster-addons' ),
					'condition' => ['icon_type' => ['icon']],
				]
			);
		endif;
		$widget->add_group_control(
			Group_Control_ELB_Icon_Gradient::get_type(),
			[
				'name' => 'icon_color',
				'condition' => ['icon_type' => ['icon']],
				'dynamic' => ['active' => true],
				'fields_options' => $defaults['icon_color'],
				'label' => esc_html__('Icon Color', 'booster-addons')
			]
		);
		$widget->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'icon_bg',
				'label' => esc_html__( 'Icon Background', 'booster-addons' ),
				'types' => [ 'classic', 'gradient'],
				'condition' => ['icon_type' => ['icon']],
				'fields_options' => $defaults['icon_bg'],				
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back-r:after',
			]
		);
		$widget->add_control(
			'icon_radius',
			[
				'label' => esc_html__( 'Background Radius', 'booster-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%'],
				'dynamic' => ['active' => true],
				'separator' => 'before',
				'default' => $defaults['icon_radius'],				
				'condition' => ['icon_type' => ['icon']],
				'selectors' => [
					'{{WRAPPER}} .elb-icon-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);          
		$widget->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'icon_br',
				'label' => esc_html__( 'Icon Border', 'booster-addons' ),
				'condition' => ['icon_type' => ['icon']],
				'fields_options' => $defaults['icon_br'],								
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back-r:after',
			]
		);
		$widget->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_bxs',
				'label' => esc_html__('Icon Box Shadow', 'booster-addons'),
				'condition' => ['icon_type' => ['icon']],
				'fields_options' => $defaults['icon_bxs'],								
				'separator' => 'before',
				'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back-r:after',
			]
		);
		$widget->add_control(
            'icon_rotate_x',
            [
                'label' => esc_html__('Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
				'condition' => ['icon_type' => ['icon']],
				'selectors' => [
					'{{WRAPPER}} .elb-icon-ctn .elb-theicon svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
				],
                'dynamic' => ['active' => true],
            ]
        );
        $widget->add_control(
            'icon_bg_rotate_x',
            [
                'label' => esc_html__('Background Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
				'condition' => ['icon_type' => ['icon']],
                'selectors' => [
					'{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
				],
                'dynamic' => ['active' => true],
            ]
        );

		if($hover_enabled ==true):		
			$widget->end_controls_tab();
	        //Styling for Hover Icon        
			$widget->start_controls_tab( 'hover_icon',
				[
					'label' => esc_html__( 'Hover', 'booster-addons' ),
					'condition' => ['icon_type' => ['icon']],
				]
			);
			$widget->add_control(
				'icon_effect',
				[
					'label' => esc_html__('Icon Hover Effect', 'booster-addons'),
					'type' => Controls_Manager::SELECT,
					'label_block' => true,'separator' => 'before',
					'condition' => ['icon_type' => ['icon']],
					'options' => elb_icon_hover_effects(),
					'default' => $defaults['icon_effect'],								
				]
			);
			$widget->add_group_control(
				Group_Control_ELB_Icon_Gradient::get_type(),
				[
					'name' => 'icon_color_h',
					'dynamic' => ['active' => true],
					'condition' => ['icon_effect!' => [ 'none' ],'icon_type' => ['icon']],
					'fields_options' => $defaults['icon_color_h'],
					'separator' => 'before',
					'label' => esc_html__('Hover Color', 'booster-addons')
				]
			); 
			$widget->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'icon_bg_h',
					'label' => esc_html__( 'Hover Icon Background', 'booster-addons' ),
					'condition' => ['icon_effect!' => [ 'none' ],'icon_type' => ['icon']],
					'fields_options' => $defaults['icon_bg_h'],	
					'separator' => 'before',
					'types' => [ 'classic', 'gradient'],
					'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back-h:after',
				]
			);
			$widget->add_control(
				'icon_radius_h',
				[
					'label' => esc_html__( 'Hover Background Radius', 'booster-addons' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%'],
					'separator' => 'before',
					'dynamic' => ['active' => true],
					'condition' => ['icon_effect!' => [ 'none' ],'icon_type' => ['icon']],
					'default' => $defaults['icon_radius_h'],						
					'selectors' => [
						'{{WRAPPER}} .elb-icon-ctn:hover, {{WRAPPER}} .elb-icon-hvctn:hover .elb-icon-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);  
			$widget->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'icon_br_h',
					'label' => esc_html__( 'Hover Icon Border', 'booster-addons' ),
					'condition' => ['icon_effect!' => [ 'none' ],'icon_type' => ['icon']],
					'separator' => 'before',
					'fields_options' => $defaults['icon_br_h'],						
					'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back-h:after',
				]
			);
			$widget->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' => 'icon_h_bxs',
					'label' => esc_html__('Hover Icon Box Shadow', 'booster-addons'),
					'separator' => 'before',
					'condition' => ['icon_effect!' => [ 'none' ],'icon_type' => ['icon']],
					'fields_options' => $defaults['icon_h_bxs'],						
					'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back-h:after',
				]
			);
			$widget->add_control(
	            'icon_rotate_x_hv',
	            [
	                'label' => esc_html__('Hover Icon Rotate', 'booster-addons'),
	                'type' => Controls_Manager::NUMBER,
	                'default' => '0',
					'selectors' => [
						'{{WRAPPER}}:hover .elb-icon-ctn .elb-theicon svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
					],
	                'dynamic' => ['active' => true],
	            ]
	        );
	        $widget->add_control(
	            'icon_bg_rotate_x_hv',
	            [
	                'label' => esc_html__('Hover Background Icon Rotate', 'booster-addons'),
	                'type' => Controls_Manager::NUMBER,
	                'default' => '0',
	                'selectors' => [
						'{{WRAPPER}}:hover .elb-icon-ctn .elb-btn-item-back:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
					],
	                'dynamic' => ['active' => true],
	            ]
	        );

			$widget->end_controls_tab();
			$widget->end_controls_tabs();
		endif;	
		$widget->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Icon Area Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
				'default' => $defaults['icon_margin'],
                'selectors' => ['{{WRAPPER}} .elb-icb-icon-ctn,{{WRAPPER}} .elb-iconarea-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
		$widget->end_controls_section();        
	}

	public static function render($settings,$type = 'included'){	
		$output = '';
		if($settings['icon_type'] != 'none'):
			$icon_area_output ='';
			if($settings['icon_type'] == 'icon' && $settings['icon'] != ''):
				$icon_settings = [
					'icon' => $settings['icon'],
					'icon_size' => $settings['icon_size'],
					'rotation' => 'none',
					'effect' => 'none',
					'icon_color' => [
						'color_one_pos'     => $settings['icon_color_color_one_pos'] ,
						'color_one'         => $settings['icon_color_color_one'] ,
						'color_two_pos'     => $settings['icon_color_color_two_pos'] ,
						'color_two'         => $settings['icon_color_color_two'] ,
						'gradient_enabled'  => $settings['icon_color_gradient_enabled'],
						'direction' 		=> $settings['icon_color_direction']
					]
				];
				if(isset($settings['icon_effect'])):
					$icon_settings['effect'] = $settings['icon_effect'];
					$icon_settings['icon_color_hover'] = [
						'color_one_pos'		=> $settings['icon_color_h_color_one_pos'] ,
						'color_one'			=> $settings['icon_color_h_color_one'] ,
						'color_two_pos'		=> $settings['icon_color_h_color_two_pos'] ,
						'color_two'			=> $settings['icon_color_h_color_two'] ,
						'gradient_enabled'	=> $settings['icon_color_h_gradient_enabled'],
                		'direction'         => $settings['icon_color_h_direction'],
					];
					$icon_settings['icon_bg_h_color'] 	= $settings['icon_bg_h_color'];            
				endif;
				if($type == 'single') $icon_settings['link'] = $settings['link'];

				$icon_area_output = elb_render_icon($icon_settings); 
			elseif($settings['icon_type'] == 'image' && $settings['image']['url']  != ''):
				$icon_area_output = '<img class="elb-iconarea-img" src="' . esc_url($settings['image']['url']) . '">';
			endif;    
			$output .= ($icon_area_output != '') ? '<div class="elb-iconarea-icon">'.$icon_area_output.'</div>' : '';
		endif;


		return $output;	
	}

}