<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_AdvancedButton_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-advancedbutton-widget';
    }
    public function get_title() {
        return esc_html__('Advanced Button', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-button';
    }
    public function get_categories() {
        return array('booster-addons');
    }

    protected function _register_controls() {
    	/********************************************
                    CONTENT SECTION       
        ********************************************/
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Button Settings', 'booster-addons'),
            ]
        ); 
        $this->add_control(
            'btn_txt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button text', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => esc_html__('Click Me', 'booster-addons'),
               
            ]
        );
        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#'],
            ]
        );
        $this->add_control(
            'btnlayout_settings',
            [
                'label' => esc_html__('Layout', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'btn_layout',
            [
                'label' => esc_html__('Button Layout', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'noicon' 	=>  esc_html__('No Icon','booster-addons'), 
                	'withicon' 	=>  esc_html__('With Icon','booster-addons'), 
                	'justicon' 	=>  esc_html__('Just Icon','booster-addons'), 
                ],
                'default' => 'noicon',
            ]
        );
        $this->add_control(
            'btn_txt_align',
            [
                'label' => esc_html__('Text Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center'
            ]
        );
        $this->add_control(
            'btn_align',
            [
                'label' => esc_html__('Button Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
            ]
        );
        $this->add_control(
            'btn_icon_settings',
            [
                'label' => esc_html__('Icon', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['btn_layout' => ['withicon','justicon']],
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'btn_icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'condition' => ['btn_layout' => ['withicon','justicon']],
                'label_block' => true               
            ]
        );
        $this->add_control(
            'btn_icon_align',
            [
                'label' => esc_html__('Icon Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left',
                'condition' => ['btn_layout' => ['withicon','justicon']],
            ]
        );
        $this->add_control(
            'btn_id',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button Custom ID', 'booster-addons'),
                'description' => esc_html__('Please make sure you enter a unique ID for your button.', 'booster-addons'),
                'separator' => 'before',
                'label_block' => true,
               
            ]
        );
        $this->end_controls_section();
         /********************************************
                    STYLING SECTION       
        ********************************************/
        //-----------------Button Global Styling----------------             
        $this->start_controls_section(
            'btn_settings_gb',
            [
                'label' => esc_html__('Button Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_full_width',
            [
                'label' => esc_html__( 'Enable Button Full Width', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'btn_width',
            [
                'label' => esc_html__('Button Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 
                'condition' => ['btn_full_width!' => ['yes']],                
                'dynamic' => ['active' => true],
                'default' => '150',
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'width: {{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'btn_height',
            [
                'label' => esc_html__('Button Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'min' => '10', 
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'height: {{VALUE}}px;'],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_txt_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'separator' => 'after',
                'selector' => '{{WRAPPER}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'btn_styling',
            [
                'label' => esc_html__('Button Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Styling for Normal Button
        $this->start_controls_tabs( 'btn_settings' );
		$this->start_controls_tab( 'normal_btn',
			[
				'label' => esc_html__( 'Normal', 'booster-addons' ),
			]
		);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg',
                'label' => esc_html__( 'Button Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'btn_txt_color',
                'label' => esc_html__('Text Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-btn-txt-r span',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],

            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_txt_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-btn-txt-r span',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-btn-insider',
            ]
        );
        $this->add_control(
            'btn_radius',
            [
                'label' => esc_html__( 'Button  Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->end_controls_tab();

        //Styling for Hover Button        
        $this->start_controls_tab( 'hover_btn',
			[
				'label' => esc_html__( 'Hover', 'booster-addons' ),
			]
		);
		$this->add_control(
            'btn_hover_effect',
            [
                'label' => esc_html__('Button Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_button_hover_effects(),
                'default' => 'none',
            ]
        );
       	$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_hv',
                'label' => esc_html__( 'Button Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'condition' => ['btn_hover_effect!' => [ 'none' ]],
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'btn_txt_color_hv',
                'label' => esc_html__('Text Color', 'booster-addons'),
                'condition' => ['btn_hover_effect!' => [ 'none' ]],
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
                'selector' => '{{WRAPPER}} .elb-btn-txt-h span',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_txt_shadow_hv',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'condition' => ['btn_hover_effect!' => [ 'none' ]],
                'selector' => '{{WRAPPER}} .elb-btn-txt-h span',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br_hv',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'condition' => ['btn_hover_effect!' => [ 'none' ]],
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs_hv',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'condition' => ['btn_hover_effect!' => [ 'none' ]],
                'selector' => '{{WRAPPER}} .elb-btn-insider:hover',
            ]
        );
        $this->add_control(
            'btn_radius_hv',
            [
                'label' => esc_html__( 'Button  Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'condition' => ['btn_hover_effect!' => [ 'none' ]],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->end_controls_section();


        //Icon Settings
        $this->start_controls_section(
            'btn_icon_settings_styling',
            [
                'label' => esc_html__('Icon Settings', 'booster-addons'),
                'condition' => ['btn_layout' => ['withicon','justicon']],                
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '500',
                'default' => '20',
                'dynamic' => ['active' => true]
            ]
        );
        $this->add_control(
            'btn_icon_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '7','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-btn-ic' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'btn_icon_adv_enabled',
            [
                'label' => esc_html__( 'Advanced Icon Styling', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'btn_icon_bg_sz',
            [
                'label' => esc_html__('Icon Background Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 'max' => '500',
                'separator' => 'before',                
                'condition' => ['btn_icon_adv_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} .elb-btn-ic' => 'width: {{VALUE}}px; height: {{VALUE}}px;'],
                'default' => '50'
            ]
        );
        $this->add_control(
            'btn_icon_radius',
            [
                'label' => esc_html__( 'Icon Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'condition' => ['btn_icon_adv_enabled' => ['yes']],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-btn-ic' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        //Start Tabs for Icon
        $this->start_controls_tabs( 'btn_icon_sty_settings' );
        //Styling for Normal Icon        		
		$this->start_controls_tab( 'normal_icon',
			[
				'label' => esc_html__( 'Normal', 'booster-addons' ),
			]
		);
		$this->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'btn_icon_color',
                'dynamic' => ['active' => true],
                'label' => esc_html__('Icon Color', 'booster-addons')
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_icon_bg',
                'label' => esc_html__( 'Icon Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#fff'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-btn-ic-r',
            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_icon_br',
				'label' => esc_html__( 'Icon Border', 'booster-addons' ),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'selector' => '{{WRAPPER}} .elb-btn-ic-r',
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_icon_bxs',
				'label' => esc_html__('Icon Box Shadow', 'booster-addons'),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'selector' => '{{WRAPPER}} .elb-btn-ic-r',
			]
		);

		$this->end_controls_tab();

        //Styling for Hover Icon        
        $this->start_controls_tab( 'hover_icon',
			[
				'label' => esc_html__( 'Hover', 'booster-addons' ),
			]
		);
		$this->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'btn_icon_color_hv',
                'dynamic' => ['active' => true],                
                'label' => esc_html__('Icon Hover Color', 'booster-addons')
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_icon_bg_hv',
                'label' => esc_html__( 'Icon Background Hover', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#fff'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-btn-ic-h',

            ]
        );
        $this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'btn_icon_br_hv',
				'label' => esc_html__( 'Icon Border Hover', 'booster-addons' ),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'selector' => '{{WRAPPER}} .elb-btn-ic-h',				
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'btn_icon_bxs_hv',
				'label' => esc_html__('Icon Box Shadow Hover', 'booster-addons'),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'selector' => '{{WRAPPER}} .elb-btn-ic-h',				
			]
		);

		$this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();

    }
   
    protected function render() {
    	$settings = $this->get_settings_for_display();
    	$icon_colors = [
    		'btn_icon_color' => [
        		'color_one_pos'		=> $settings['btn_icon_color_color_one_pos'] ,
				'color_one'			=> $settings['btn_icon_color_color_one'] ,
				'color_two_pos'		=> $settings['btn_icon_color_color_two_pos'] ,
				'color_two'			=> $settings['btn_icon_color_color_two'] ,
                'gradient_enabled'  => $settings['btn_icon_color_gradient_enabled'],
				'direction'	        => $settings['btn_icon_color_direction']
        	],
        	'btn_icon_color_hv' => [
        		'color_one_pos'		=> $settings['btn_icon_color_hv_color_one_pos'] ,
				'color_one'			=> $settings['btn_icon_color_hv_color_one'] ,
				'color_two_pos'		=> $settings['btn_icon_color_hv_color_two_pos'] ,
				'color_two'			=> $settings['btn_icon_color_hv_color_two'] ,
				'gradient_enabled'	=> $settings['btn_icon_color_hv_gradient_enabled'],
                'direction'         => $settings['btn_icon_color_hv_direction']
        	]
        ];

        $output = elb_render_button($settings,$icon_colors,'real');
        echo apply_filters('elb_advancedbutton_output', $output, $settings);

    }

}