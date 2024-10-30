<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Button_Tab{
    public static function set_defaults($defaults){        
        $defaults['btn_txt'] = (isset($defaults['btn_txt'])) ? $defaults['btn_txt'] : 'Click me';
        $defaults['btn_layout'] = (isset($defaults['btn_layout'])) ? $defaults['btn_layout'] : 'noicon';
        $defaults['btn_txt_align'] = (isset($defaults['btn_txt_align'])) ? $defaults['btn_txt_align'] : 'center';
        $defaults['btn_width'] = (isset($defaults['btn_width'])) ? $defaults['btn_width'] : '150';
        $defaults['btn_height'] = (isset($defaults['btn_height'])) ? $defaults['btn_height'] : '50';
        $defaults['btn_txt_font'] = (isset($defaults['btn_txt_font'])) ? $defaults['btn_txt_font'] : ['font_size' => ['default' =>['size' => 14,'unit' => 'px']],'font_weight' => ['default' => '500'],'typography' => ['default' => 'custom']];
        $defaults['btn_bg'] = (isset($defaults['btn_bg'])) ? $defaults['btn_bg'] : ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]];
        $defaults['btn_txt_color'] = (isset($defaults['btn_txt_color'])) ? $defaults['btn_txt_color'] : ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']];
        $defaults['btn_txt_shadow'] = (isset($defaults['btn_txt_shadow'])) ? $defaults['btn_txt_shadow'] : '';
        $defaults['btn_br'] = (isset($defaults['btn_br'])) ? $defaults['btn_br'] : '';
        $defaults['btn_bxs'] = (isset($defaults['btn_bxs'])) ? $defaults['btn_bxs'] : '';
        $defaults['btn_radius'] = (isset($defaults['btn_radius'])) ? $defaults['btn_radius'] : ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true];
        $defaults['btn_hover_effect'] = (isset($defaults['btn_hover_effect'])) ? $defaults['btn_hover_effect'] : 'none';
        $defaults['btn_bg_hv'] = (isset($defaults['btn_bg_hv'])) ? $defaults['btn_bg_hv'] : ['background' => ['default' => 'classic'],'color' => ['default' => '#232323'],'image' => ['type' => Controls_Manager::HIDDEN]];
        $defaults['btn_txt_color_hv'] = (isset($defaults['btn_txt_color_hv'])) ? $defaults['btn_txt_color_hv'] : ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']];
        $defaults['btn_txt_shadow_hv'] = (isset($defaults['btn_txt_shadow_hv'])) ? $defaults['btn_txt_shadow_hv'] : '';
        $defaults['btn_br_hv'] = (isset($defaults['btn_br_hv'])) ? $defaults['btn_br_hv'] : '';
        $defaults['btn_bxs_hv'] = (isset($defaults['btn_bxs_hv'])) ? $defaults['btn_bxs_hv'] : '';
        $defaults['btn_radius_hv'] = (isset($defaults['btn_radius_hv'])) ? $defaults['btn_radius_hv'] : ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true];
        $defaults['btn_icon'] = (isset($defaults['btn_icon'])) ? $defaults['btn_icon'] : 'fire';
        $defaults['btn_icon_align'] = (isset($defaults['btn_icon_align'])) ? $defaults['btn_icon_align'] : 'left';
        $defaults['btn_icon_size'] = (isset($defaults['btn_icon_size'])) ? $defaults['btn_icon_size'] : '20';
        $defaults['btn_icon_margin'] = (isset($defaults['btn_icon_margin'])) ? $defaults['btn_icon_margin'] : ['left' => '0','top' => '0','right' => '7','bottom' => '0','isLinked' => false];
        $defaults['btn_icon_adv_enabled'] = (isset($defaults['btn_icon_adv_enabled'])) ? $defaults['btn_icon_adv_enabled'] : 'no';
        $defaults['btn_icon_bg_sz'] = (isset($defaults['btn_icon_bg_sz'])) ? $defaults['btn_icon_bg_sz'] : '50';
        $defaults['btn_icon_radius'] = (isset($defaults['btn_icon_radius'])) ? $defaults['btn_icon_radius'] : ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true];
        $defaults['btn_icon_color'] = (isset($defaults['btn_icon_color'])) ? $defaults['btn_icon_color'] : ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']];
        $defaults['btn_icon_bg'] = (isset($defaults['btn_icon_bg'])) ? $defaults['btn_icon_bg'] : ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]];
        $defaults['btn_icon_br'] = (isset($defaults['btn_icon_br'])) ? $defaults['btn_icon_br'] : '';
        $defaults['btn_icon_bxs'] = (isset($defaults['btn_icon_bxs'])) ? $defaults['btn_icon_bxs'] : '';
        $defaults['btn_icon_color_hv'] = (isset($defaults['btn_icon_color_hv'])) ? $defaults['btn_icon_color_hv'] : ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']];
        $defaults['btn_icon_bg_hv'] = (isset($defaults['btn_icon_bg_hv'])) ? $defaults['btn_icon_bg_hv'] : ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]];
        $defaults['btn_icon_br_hv'] = (isset($defaults['btn_icon_br_hv'])) ? $defaults['btn_icon_br_hv'] : '';
        $defaults['btn_icon_bxs_hv'] = (isset($defaults['btn_icon_bxs_hv'])) ? $defaults['btn_icon_bxs_hv'] : '';
        return $defaults;
    }
	public static function init($widget,$type,$defaults = []){
        $defaults = ELB_Button_Tab::set_defaults($defaults);        
		//Button Secttion
        $widget->start_controls_section(
            'button_section_styling',
            [
                'label' => esc_html__('Button Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        if($type == 'full'):
            $widget->add_control(
                'btn_align',
                [
                    'label' => esc_html__('Button Alignment', 'booster-addons'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                        'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                        'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                    ],                
                    'default' => 'center'
                ]
            );
            $widget->add_control(
                'btn_enabled',
                [
                    'label' => esc_html__( 'Enable Button', 'booster-addons' ),
                    'type' => Controls_Manager::HIDDEN,
                    'default' => 'yes',
                    'frontend_available' => true
                ]
            );
        endif;    

        if($type == 'included'):
            $widget->add_control(
                'btn_enabled',
                [
                    'label' => esc_html__( 'Enable Button', 'booster-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                    'frontend_available' => true
                ]
            );
        endif;
        $widget->add_control(
            'btn_txt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button text', 'booster-addons'),
                'dynamic' => ['active' => true],
                'condition' => ['btn_enabled' => ['yes']],
                'label_block' => true,
                'default' => $defaults['btn_txt']           
            ]
        );
        $widget->add_control(
            'btn_layout',
            [
                'label' => esc_html__('Button Layout', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'noicon'    =>  esc_html__('No Icon','booster-addons'), 
                    'withicon'  =>  esc_html__('With Icon','booster-addons'), 
                    'justicon'  =>  esc_html__('Just Icon','booster-addons'), 
                ],
                'condition' => ['btn_enabled' => ['yes']],
                'default' => $defaults['btn_layout'],
            ]
        );
        $widget->add_control(
            'btn_txt_align',
            [
                'label' => esc_html__('Text Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'condition' => ['btn_enabled' => ['yes']],
                'default' => $defaults['btn_txt_align'],
                
            ]
        );
        $widget->add_control(
            'btn_settings',
            [
                'label' => esc_html__('Button Styling', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['btn_enabled' => ['yes']],                
                'type' => Controls_Manager::HEADING,
            ]
        );
        if($type == 'full'):        
            $widget->add_control(
                'btn_full_width',
                [
                    'label' => esc_html__( 'Enable Button Full Width', 'booster-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'dynamic' => ['active' => true],
                    'default' => 'no',
                    'frontend_available' => true
                ]
            );
            $widget->add_control(
                'btn_width',
                [
                    'label' => esc_html__('Button Width', 'booster-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => '10', 
                    'condition' => ['btn_enabled' => ['yes'],'btn_full_width!' => ['yes']],               
                    'dynamic' => ['active' => true],
                    'default' => $defaults['btn_width'],
                    'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'width: {{VALUE}}px;'],
                ]
            );
        endif;    
        if($type == 'included'): 
            $widget->add_control(
                'btn_width',
                [
                    'label' => esc_html__('Button Width', 'booster-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => '10', 
                    'condition' => ['btn_enabled' => ['yes']],               
                    'dynamic' => ['active' => true],
                    'default' => $defaults['btn_width'],
                    'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'width: {{VALUE}}px;'],
                ]
            );       
        endif;    

        $widget->add_control(
            'btn_height',
            [
                'label' => esc_html__('Button Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'min' => '10', 
                'default' => $defaults['btn_height'],
                'condition' => ['btn_enabled' => ['yes']],    
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'height: {{VALUE}}px;'],
            ]
        );
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_txt_font',
                'label' => esc_html__('Button Typography', 'booster-addons'),
                'fields_options' => $defaults['btn_txt_font'],
                'condition' => ['btn_enabled' => ['yes']],                
                'separator' => 'after',
                'selector' => '{{WRAPPER}}',
            ]
        );


        //Button Styling Normal & Hover
        $widget->start_controls_tabs( 'btn_settings_stylings' );
        $widget->start_controls_tab( 'normal_btn',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
                'condition' => ['btn_enabled' => ['yes']],
            ]
        );
        $widget->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg',
                'label' => esc_html__( 'Button Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => $defaults['btn_bg'],                
                'condition' => ['btn_enabled' => ['yes']],
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'btn_txt_color',
                'label' => esc_html__('Text Color', 'booster-addons'),
                'condition' => ['btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_txt_color'],
                'selector' => '{{WRAPPER}} .elb-btn-txt-r span',
            ]
        );
        $widget->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_txt_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'condition' => ['btn_enabled' => ['yes']],
                'selector' => '{{WRAPPER}} .elb-btn-txt-r span',
            ]
        );
        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'condition' => ['btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_br'],
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'condition' => ['btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_bxs'],
                'selector' => '{{WRAPPER}} .elb-btn-insider',
            ]
        );
        $widget->add_control(
            'btn_radius',
            [
                'label' => esc_html__( 'Button  Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => $defaults['btn_radius'],
                'condition' => ['btn_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $widget->end_controls_tab();

        //Styling for Hover Button        
        $widget->start_controls_tab( 'hover_btn',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
                'condition' => ['btn_enabled' => ['yes']],
            ]
        );
        $widget->add_control(
            'btn_hover_effect',
            [
                'label' => esc_html__('Button Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_button_hover_effects(),
                'condition' => ['btn_enabled' => ['yes']],
                'default' => $defaults['btn_hover_effect'],
            ]
        );
        $widget->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_hv',
                'label' => esc_html__( 'Button Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => $defaults['btn_bg_hv'],
                'condition' => ['btn_hover_effect!' => [ 'none' ],'btn_enabled' => ['yes']],
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'btn_txt_color_hv',
                'label' => esc_html__('Text Color', 'booster-addons'),
                'condition' => ['btn_hover_effect!' => [ 'none' ],'btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_txt_color_hv'],           
                'selector' => '{{WRAPPER}} .elb-btn-txt-h span',
            ]
        );
        $widget->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'btn_txt_shadow_hv',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'condition' => ['btn_hover_effect!' => [ 'none' ],'btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_txt_shadow_hv'],           
                'selector' => '{{WRAPPER}} .elb-btn-txt-h span',
            ]
        );
        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br_hv',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'condition' => ['btn_hover_effect!' => [ 'none' ],'btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_br_hv'],           
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs_hv',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'condition' => ['btn_hover_effect!' => [ 'none' ],'btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_bxs_hv'],           
                'selector' => '{{WRAPPER}} .elb-btn-insider:hover',
            ]
        );
        $widget->add_control(
            'btn_radius_hv',
            [
                'label' => esc_html__( 'Button  Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => $defaults['btn_radius_hv'],           
                'condition' => ['btn_hover_effect!' => [ 'none' ],'btn_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $widget->end_controls_tab();
        $widget->end_controls_tabs();
        

        //Button Icon
        $widget->add_control(
            'btn_icon_settings',
            [
                'label' => esc_html__('Icon', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'type' => Controls_Manager::HEADING,
            ]
        );
        $widget->add_control(
            'btn_icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'default' => $defaults['btn_icon'],    
                'label_block' => true               
            ]
        );
        $widget->add_control(
            'btn_icon_align',
            [
                'label' => esc_html__('Icon Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => $defaults['btn_icon_align'],    
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
            ]
        );
        $widget->add_control(
            'btn_icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '500',
                'default' => $defaults['btn_icon_size'],    
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'dynamic' => ['active' => true]
            ]
        );
        $widget->add_control(
            'btn_icon_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => $defaults['btn_icon_margin'],    
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} .elb-btn-ic' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $widget->add_control(
            'btn_icon_adv_enabled',
            [
                'label' => esc_html__( 'Advanced Icon Styling', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => $defaults['btn_icon_adv_enabled'],    
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'frontend_available' => true
            ]
        );
        $widget->add_control(
            'btn_icon_bg_sz',
            [
                'label' => esc_html__('Icon Background Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 'max' => '500',
                'separator' => 'before',                
                'condition' => ['btn_icon_adv_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} .elb-btn-ic' => 'width: {{VALUE}}px; height: {{VALUE}}px;'],
                'default' => $defaults['btn_icon_bg_sz'],    
            ]
        );
        $widget->add_control(
            'btn_icon_radius',
            [
                'label' => esc_html__( 'Icon Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'condition' => ['btn_icon_adv_enabled' => ['yes']],
                'default' => $defaults['btn_icon_radius'],    
                'selectors' => [
                    '{{WRAPPER}} .elb-btn-ic' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        //Start Tabs for Icon
        $widget->start_controls_tabs( 'btn_icon_sty_settings' );
        //Styling for Normal Icon               
        $widget->start_controls_tab( 'btn_normal_icon',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'btn_icon_color',
                'dynamic' => ['active' => true],
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_icon_color'],    
                'label' => esc_html__('Icon Color', 'booster-addons')
            ]
        ); 
        $widget->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_icon_bg',
                'label' => esc_html__( 'Icon Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['btn_icon_adv_enabled' => ['yes']],        
                'fields_options' => $defaults['btn_icon_bg'],    
                'selector' => '{{WRAPPER}} .elb-btn-ic-r',
            ]
        );
        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_icon_br',
                'label' => esc_html__( 'Icon Border', 'booster-addons' ),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => $defaults['btn_icon_br'],    
                'selector' => '{{WRAPPER}} .elb-btn-ic-r',
            ]
        );
        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_icon_bxs',
                'label' => esc_html__('Icon Box Shadow', 'booster-addons'),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => $defaults['btn_icon_bxs'],    
                'selector' => '{{WRAPPER}} .elb-btn-ic-r',
            ]
        );

        $widget->end_controls_tab();

        //Styling for Hover Icon        
        $widget->start_controls_tab( 'btn_hover_icon',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'btn_icon_color_hv',
                'dynamic' => ['active' => true],                
                'condition' => ['btn_layout' => ['withicon','justicon'],'btn_enabled' => ['yes']],
                'fields_options' => $defaults['btn_icon_color_hv'],    
                'label' => esc_html__('Icon Hover Color', 'booster-addons')
            ]
        ); 
        $widget->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_icon_bg_hv',
                'label' => esc_html__( 'Icon Background Hover', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => $defaults['btn_icon_bg_hv'],
                'selector' => '{{WRAPPER}} .elb-btn-ic-h',

            ]
        );
        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_icon_br_hv',
                'label' => esc_html__( 'Icon Border Hover', 'booster-addons' ),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => $defaults['btn_icon_br_hv'],
                'selector' => '{{WRAPPER}} .elb-btn-ic-h',              
            ]
        );
        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_icon_bxs_hv',
                'label' => esc_html__('Icon Box Shadow Hover', 'booster-addons'),
                'condition' => ['btn_icon_adv_enabled' => ['yes']],                
                'fields_options' => $defaults['btn_icon_bxs_hv'],
                'selector' => '{{WRAPPER}} .elb-btn-ic-h',              
            ]
        );

        $widget->end_controls_tab();
        $widget->end_controls_tabs();

        $widget->end_controls_section();
	}

}