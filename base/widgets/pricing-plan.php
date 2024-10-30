<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_PricingPlan_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-pricingplan-widget';
    }
    public function get_title() {
        return esc_html__('Pricing Plan', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-product-price';
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
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );
        $this->add_control(
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Plan Heading', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => esc_html__('Premium', 'booster-addons'),
            ]
        ); 
        $this->add_control(
            'price',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Plan Price', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '50',
            ]
        ); 
        $this->add_control(
            'unit',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Plan Unit', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '$',
            ]
        ); 
        $this->add_control(
            'period',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Plan Period', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '/yearly',
            ]
        ); 
        $this->add_control(
            'info',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Plan Info', 'booster-addons'),
                'dynamic' => ['active' => true],
                'default' => 'Up to 255GB',
                'label_block' => true
            ]
        ); 
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Plan Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'default' => ['url' => ''],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout Settings ', 'booster-addons'),
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
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
            'hover_effect',
            [
                'label' => esc_html__('Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'separator' => 'before',
                'options' => [
                    'none' => esc_html__('None', 'booster-addons'),
                    'fade' => esc_html__('Fade In', 'booster-addons'),
                    'zoomin' => esc_html__('Zoom In', 'booster-addons'),
                    'translateup' => esc_html__('Translate Up', 'booster-addons'),                    
                ],
                'default' => 'translateup',
            ]
        );
        $this->add_control(
            'unit_align',
            [
                'label' => esc_html__('Unit Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'right'
            ]
        );
        $this->add_control(
            'unit_pos',
            [
                'label' => esc_html__('Unit Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'center' => esc_html__('Middle', 'booster-addons'),
                    'flex-start' => esc_html__('Top', 'booster-addons'),
                    'flex-end' => esc_html__('Bottom', 'booster-addons'),
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elb-prp-price-area' => 'align-items: {{align}};',
                ],
            ]
        );
        $this->end_controls_section();
        /********************************************
                    STYLING SECTION       
        ********************************************/
        $this->start_controls_section(
            'section_styling',
            [
                'label' => esc_html__('Content Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Typography Styling
        $this->add_control(
            'content_typography',
            [
                'label' => esc_html__('Content Typography', 'booster-addons'),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Heading Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prp-heading',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_font',
                'label' => esc_html__('Price Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 78,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prp-price',                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'unit_font',
                'label' => esc_html__('Unit Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 50,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],           
                'selector' => '{{WRAPPER}} .elb-prp-unit',
               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_font',
                'label' => esc_html__('Period Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prp-period',
               
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_font',
                'label' => esc_html__('Info Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 15,'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prp-info',               
            ]
        );
        $this->end_controls_section();

        //Content Color Styling
        $this->start_controls_section(
            'content_styling',
            [
                'label' => esc_html__('Content Colors', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs( 'content_normal_colors' );
        
        //**Normal Colors
        $this->start_controls_tab( 'normal_colors',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
            ]
        );
        //Heading Colors       
        $this->add_control(
            'hd_cl',
            [
                'label' => esc_html__('Heading Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color',
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-heading',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow',
                'label' => esc_html__('Heading Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-heading',               
            ]
        );
        //Price Styling    
        $this->add_control(
            'pr_cl',
            [
                'label' => esc_html__('Price Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );           
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'price_color',
                'label' => esc_html__('Price Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-price',      
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'],'gradient_enabled' => ['default' => 'yes'], 'color_one' => ['default' => '#7d66e2'], 'color_two' => ['default' => '#20c4e5'], 'direction' => ['default' => 'to bottom left']],          
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'price_shadow',
                'label' => esc_html__('Price Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-price',
                
            ]
        );
        //Unit Styling  
        $this->add_control(
            'un_cl',
            [
                'label' => esc_html__('Unit Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );           
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'unit_color',
                'label' => esc_html__('Unit Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'],'gradient_enabled' => ['default' => 'yes'], 'color_one' => ['default' => '#7d66e2'], 'color_two' => ['default' => '#20c4e5'], 'direction' => ['default' => 'to bottom left']],
                'selector' => '{{WRAPPER}} .elb-prp-unit',                
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'unit_shadow',
                'label' => esc_html__('Unit Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-unit',                
            ]
        );
        //Period Styling      
        $this->add_control(
            'per_cl',
            [
                'label' => esc_html__('Period Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );    
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'period_color',
                'label' => esc_html__('Period Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'],'gradient_enabled' => ['default' => 'yes'], 'color_one' => ['default' => '#7d66e2'], 'color_two' => ['default' => '#20c4e5'], 'direction' => ['default' => 'to bottom left']],          
                'selector' => '{{WRAPPER}} .elb-prp-period',                                
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'period_shadow',
                'label' => esc_html__('Period Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-period',
            ]
        );
        //Info Styling         
        $this->add_control(
            'inf_cl',
            [
                'label' => esc_html__('Info Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );             
        $this->add_control(
            'info_color',
            [
                'label' => esc_html__('Info Text Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-prp-info' => 'color: {{VALUE}};',
                ],                             
            ]
        );
        $this->end_controls_tab();

        //**Hover Colors        
        $this->start_controls_tab( 'hover_colors',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
                'condition' => ['hover_effect!' => ['none']],                

            ]
        );
         //Heading Colors -Hover-
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color_h',
                'label' => esc_html__('Heading Color -Hover-', 'booster-addons'),
                'condition' => ['hover_effect!' => ['none']],                
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-heading',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],          

            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow_h',
                'label' => esc_html__('Heading Shadow -Hover-', 'booster-addons'),
                'condition' => ['hover_effect!' => ['none']],                
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-heading',                                                
            ]
        );
        //Price Styling -Hover-   
        $this->add_control(
            'pr_cl_h',
            [
                'label' => esc_html__('Price Colors', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['hover_effect!' => ['none']],                
                'type' => Controls_Manager::HEADING,
            ]
        );             
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'price_color_h',
                'label' => esc_html__('Price Color -Hover-', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['hover_effect!' => ['none']],                
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],          
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-price',                                                
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'price_shadow_h',
                'label' => esc_html__('Price Shadow -Hover-', 'booster-addons'),
                'condition' => ['hover_effect!' => ['none']],                
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-price',                                                             
            ]
        );
        //Unit Styling -Hover-     
        $this->add_control(
            'un_cl_h',
            [
                'label' => esc_html__('Unit Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
                'condition' => ['hover_effect!' => ['none']],                
            ]
        );      
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'unit_color_h',
                'label' => esc_html__('Unit Color -Hover-', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['hover_effect!' => ['none']],                
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],          
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-unit',                                                             
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'unit_shadow_h',
                'label' => esc_html__('Unit Shadow -Hover-', 'booster-addons'),
                'condition' => ['hover_effect!' => ['none']],                
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-unit',                                                                           
            ]
        );
        //Period Styling -Hover-    
        $this->add_control(
            'per_cl_h',
            [
                'label' => esc_html__('Period Colors', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['hover_effect!' => ['none']],                
                'type' => Controls_Manager::HEADING,
            ]
        );   
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'period_color_h',
                'separator' => 'before',
                'label' => esc_html__('Period Color -Hover-', 'booster-addons'),
                'condition' => ['hover_effect!' => ['none']],                
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],          
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-period',                                                                             
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'period_shadow_h',
                'label' => esc_html__('Period Shadow -Hover-', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-period',
                'condition' => ['hover_effect!' => ['none']],                
            ]
        );
        //Info Styling -Hover-
        $this->add_control(
            'inf_cl_h',
            [
                'label' => esc_html__('Info Colors', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
                'condition' => ['hover_effect!' => ['none']],                
            ]
        );                    
        $this->add_control(
            'info_color_h',
            [
                'label' => esc_html__('Info Text Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'default' => '#fff',
                'condition' => ['hover_effect!' => ['none']],                
                'selectors' => [
                    '{{WRAPPER}} .elb-prp-insider:hover .elb-prp-info' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();
       
        //**********CONTAINER STYLING       
        $this->start_controls_section(
            'container_styling',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'ctn_settings' );
        //Styling for Normal Container     
        $this->start_controls_tab( 'normal_ctn',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_bg',
                'label' => esc_html__( 'Container Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#fafafa'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-prp-insider',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Shadow', 'booster-addons'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-prp-insider',                
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-prp-insider',
               
            ]
        );
        $this->add_control(
            'ctn_radius',
            [
                'label' => esc_html__( 'Container Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-prp-insider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();

        //Styling for Hover Container     
        $this->start_controls_tab( 'hover_ctn',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
                'condition' => ['hover_effect!' => ['none']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_bg_h',
                'label' => esc_html__( 'Container Background -Hover-', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover',
                'condition' => ['hover_effect!' => ['none']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs_h',
                'label' => esc_html__('Container Shadow -Hover-', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['hover_effect!' => ['none']],                
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br_h',
                'label' => esc_html__( 'Container Border -Hover-', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-prp-insider:hover',
                'condition' => ['hover_effect!' => ['none']],                
            ]
        );
        $this->add_control(
            'ctn_radius_h',
            [
                'label' => esc_html__( 'Container Radius -Hover-', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'condition' => ['hover_effect!' => ['none']],                
                'selectors' => ['{{WRAPPER}} .elb-prp-insider:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        //**********DISTANCES SETTINGS       
        $this->start_controls_section(
            'distance_settings',
            [
                'label' => esc_html__('Distances Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ctn_pdg',
            [
                'label' => esc_html__( 'Container Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '50','right' => '0','bottom' => '50','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-insider' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'heading_mrg',
            [
                'label' => esc_html__( 'Heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'pr_area_mrg',
            [
                'label' => esc_html__( 'Price Area Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-price-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'price_mrg',
            [
                'label' => esc_html__( 'Price Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'unit_mrg',
            [
                'label' => esc_html__( 'Unit Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'period_mrg',
            [
                'label' => esc_html__( 'Period Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'separator' => 'before',
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '10','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-period' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'info_mrg',
            [
                'label' => esc_html__( 'Info Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prp-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $this->end_controls_section();

   }
   
    protected function render() {
        $settings = $this->get_settings_for_display();  
        $output = '';
        $output = '<div class="elb-prp-ctn">';
            $output .= '<div class="elb-prp-insider elb-tr-3" data-hover="'.esc_attr($settings['hover_effect']).'" data-align="'.esc_attr($settings['align']).'">';
                $output .=  ($settings['heading'] != '') ? '<div class="elb-prp-heading elb-tr-3">'.wp_kses_post($settings['heading']).'</div>' : '';
            
                $output .= '<div class="elb-prp-price-area">';
                    $price_output =  ($settings['price'] != '') ? '<div class="elb-prp-price elb-tr-3">'.wp_kses_post($settings['price']).'</div>' : '';
                    $unit_output =  ($settings['unit'] != '') ? '<div class="elb-prp-unit elb-tr-3">'.wp_kses_post($settings['unit']).'</div>' : '';
                    $output .= ($settings['unit_align'] == 'left')  ? $unit_output . '' . $price_output : $price_output . '' . $unit_output;
                $output .= '</div>'; 

                $output .=  ($settings['period'] != '') ? '<div class="elb-prp-period elb-tr-3">'.wp_kses_post($settings['period']).'</div>' : '';
                $output .=  ($settings['info'] != '') ? '<div class="elb-prp-info elb-tr-3">'.wp_kses_post(nl2br($settings['info'])).'</div>' : '';
                $output .= elb_render_elementor_link($settings['link'], '',true);
            $output .= '</div>'; 
        $output .= '</div>'; 

        echo apply_filters('elb_pricingplan_output', $output, $settings);

    }

}                 