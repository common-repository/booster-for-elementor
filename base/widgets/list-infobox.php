<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ListInfoBox_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-listinfobox-widget';
    }
    public function get_title() {
        return esc_html__('List Info Box', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-editor-list-ul';
    }
    public function get_categories() {
        return array('booster-addons');
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        //List Content Section
        $this->start_controls_section(
            'section_list',
            [
                'label' => esc_html__('List Content', 'booster-addons'),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true               
            ]
        );
        $repeater->add_control(
            'heading', [
                'label' => esc_html__('Heading', 'booster-addons'),
                'default' => esc_html__('Heading Title', 'booster-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );  
        $repeater->add_control(
            'sub_heading', [
                'label' => esc_html__('Sub Heading', 'booster-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );  
        $repeater->add_control(
            'short_text', [
                'label' => esc_html__('Short Text', 'booster-addons'),               
                'default' => esc_html__('Booster Addons premium widgets bundle is one of the best bundles money can buy! with modern & creative features.', 'booster-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );    
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        );
            $repeater->add_control(
                'item_custom_style',
                [
                    'label' => esc_html__( 'Custom Styling', 'booster-addons' ),
                    'description' => esc_html__( 'Enable custom styling colors for this list info box item.', 'booster-addons' ),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'after',
                    'default' => 'no',
                    'frontend_available' => true
                ]
            );
            $repeater->add_control(
                'cst_heading_color',
                [
                    'label' => esc_html__('Heading Color', 'booster-addons'),
                    'type' => Controls_Manager::COLOR,
                    'condition' => ['item_custom_style' => [ 'yes' ]],
                    'default' => '#333',
                    'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-listib-heading span' => 'color: {{VALUE}};']
                ]
            );
            $repeater->add_control(
                'cst_subheading_color',
                [
                    'label' => esc_html__('Sub Heading Color', 'booster-addons'),
                    'type' => Controls_Manager::COLOR,
                    'condition' => ['item_custom_style' => [ 'yes' ]],
                    'separator' => 'before',
                    'default' => '#777',
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elb-listib-subheading span',
                ]
            );
            $repeater->add_control(
                'cst_shorttext_color',
                [
                    'label' => esc_html__('Short Text Color', 'booster-addons'),
                    'type' => Controls_Manager::COLOR,
                    'condition' => ['item_custom_style' => [ 'yes' ]],
                    'separator' => 'before',
                    'default' => '#444',
                    'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-listib-shorttext span' => 'color: {{VALUE}};']

                ]
            );
           //Custom Icon Color
        $repeater->start_controls_tabs( 'cst_icon_settings_tabs' );
        //Icon Normal
        $repeater->add_control(
            'cst_icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 'max' => '300',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'default' => '30',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-icon-ctn svg' => 'width:{{VALUE}}px; height:{{VALUE}}px;'],

            ]
        );
        $repeater->add_control(
            'cst_icon_size_bg',
            [
                'label' => esc_html__('Icon Background Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 'max' => '500',
                'default' => '80',
                'dynamic' => ['active' => true],
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selectors' => [                    
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn' => 'width: {{VALUE}}px; height: {{VALUE}}px; line-height: {{VALUE}}px;',
                    '{{WRAPPER}}  {{CURRENT_ITEM}} .elb-listib-content' => 'width: calc(100% - {{VALUE}}px);',
                    '{{WRAPPER}}  {{CURRENT_ITEM}}' => '--back-size:{{VALUE}}px;',
                ]
            ]
        ); 
        $repeater->start_controls_tab( 'cst_icon_normal',
            [
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'label' => esc_html__( 'Normal', 'booster-addons' )
            ]
        );
        $repeater->add_control(
            'cst_icon_color',
            [
                'label' => esc_html__('Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selectors' => ['{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn .elb-icon-r svg' => 'color: {{VALUE}};']
            ]
        );
        $repeater->add_control(
            'cst_icon_bg',
            [
                'label' => esc_html__('Icon Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-icon-ctn .elb-bg-r:after' => 'color: {{VALUE}}; background: {{VALUE}};']
            ]
        );
        $repeater->add_control(
            'cst_icon_radius',
            [
                'label' => esc_html__( 'Background Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );          
        $repeater->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cst_icon_br',
                'label' => esc_html__( 'Icon Border', 'booster-addons' ),
                'separator' => 'before',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selector' => '{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn .elb-bg-r:after',
            ]
        );
        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cst_icon_bxs',
                'label' => esc_html__('Icon Box Shadow', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elb-icon-ctn .elb-bg-r:after',
            ]
        );
        $repeater->add_control(
            'cst_icon_rotate_x',
            [
                'label' => esc_html__('Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elb-icon-ctn .elb-theicon svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg)!important;'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $repeater->add_control(
            'cst_icon_bg_rotate_x',
            [
                'label' => esc_html__('Background Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .elb-icon-ctn .elb-btn-item-back:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg)!important;'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $repeater->end_controls_tab();

        //Hover Icon
        $repeater->start_controls_tab( 'cst_icon_hover',
            [
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'label' => esc_html__( 'Hover', 'booster-addons' )
            ]
        );
        $repeater->add_control(
            'cst_icon_hover_enabled',
            [
                'label' => esc_html__( 'Enable Color Hover', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition' => ['item_custom_style' => [ 'yes' ]],
                'frontend_available' => true
            ]
        );
        $repeater->add_control(
            'cst_icon_effect',
            [
                'label' => esc_html__('Icon Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,'separator' => 'before',
                'options' => elb_icon_hover_effects(),
                'default' => 'fade',
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],
            ]
        );
        $repeater->add_control(
            'cst_icon_color_h',
            [
                'label' => esc_html__('Icon Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],
                'selectors' => ['{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn .elb-icon-h svg' => 'color: {{VALUE}};']             
            ]
        );
        $repeater->add_control(
            'cst_icon_bg_h',
            [
                'label' => esc_html__('Icon Background -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],
                'selectors' => ['{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn .elb-bg-h:after' => 'color: {{VALUE}}; background: {{VALUE}};']
            ]
        );       
        $repeater->add_control(
            'cst_icon_radius_h',
            [
                'label' => esc_html__( 'Background Radius -Hover-', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],                
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}}  {{CURRENT_ITEM}}:hover .elb-icon-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );          
        $repeater->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cst_icon_br_h',
                'label' => esc_html__( 'Icon Border -Hover-', 'booster-addons' ),
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],               
                'separator' => 'before',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .elb-icon-ctn .elb-bg-h:after',
            ]
        );
        $repeater->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cst_icon_bxs_h',
                'label' => esc_html__('Icon Box Shadow -Hover-', 'booster-addons'),
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],               
                'separator' => 'before',
                'selector' => '{{WRAPPER}}  {{CURRENT_ITEM}} .elb-icon-ctn .elb-bg-h:after',
            ]
        );
        $repeater->add_control(
            'cst_icon_rotate_x_h',
            [
                'label' => esc_html__('Icon Rotate -Hover-', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],               
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.elb-listib-item-ctn:hover .elb-icon-ctn .elb-theicon svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg)!important;'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $repeater->add_control(
            'cst_icon_bg_rotate_x_h',
            [
                'label' => esc_html__('Background Icon Rotate -Hover-', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                               
                'condition' => ['cst_icon_hover_enabled' => [ 'yes' ],'item_custom_style' => [ 'yes' ]],               
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.elb-listib-item-ctn:hover .elb-icon-ctn .elb-btn-item-back:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg)!important;'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();


        //The List
        $this->add_control(
            'list',
            [
                'label' => esc_html__('List Content', 'booster-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['icon' => 'stack'],
                    ['icon' => 'stack'],
                    ['icon' => 'stack'],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_list_layout',
            [
                'label' => esc_html__('List Layout', 'booster-addons'),
            ]
        );
        $this->add_control(
            'layout_align',
            [
                'label' => esc_html__('Layout Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left'
            ]
        );
        $this->add_control(
            'icons_enabled',
            [
                'label' => esc_html__( 'Icons Enabled', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
        //Typography Styling
        $this->start_controls_section(
            'typography_settings',
            [
                'label' => esc_html__('Typography', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_styling',
            [
                'label' => esc_html__('Heading Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Heading Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-listib-heading',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => ['{{WRAPPER}} .elb-listib-heading' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control(
            'heading_color_hover_enabled',
            [
                'label' => esc_html__( 'Heading Color hover', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'heading_color_hover',
            [
                'label' => esc_html__('Heading Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['heading_color_hover_enabled' => [ 'yes' ]],
                'default' => '#7d66e2',
                'selectors' => ['{{WRAPPER}} .elb-listib-item-ctn:hover .elb-listib-heading' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control(
            'sub_heading_styling',
            [
                'label' => esc_html__('Sub Heading Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_font',
                'label' => esc_html__('Sub Heading Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-listib-subheading',
            ]
        );
        $this->add_control(
            'subheading_color',
            [
                'label' => esc_html__('Sub Heading Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => ['{{WRAPPER}} .elb-listib-subheading' => 'color:{{VALUE}};'],

            ]
        );
        $this->add_control(
            'short_text_styling',
            [
                'label' => esc_html__('Short Text Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'shorttext_font',
                'label' => esc_html__('Short Text Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 15,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.6,'unit' => 'em']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-listib-shorttext',
            ]
        );
        $this->add_control(
            'shorttext_color',
            [
                'label' => esc_html__('Short Text Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => ['{{WRAPPER}} .elb-listib-shorttext' => 'color:{{VALUE}};'],

            ]
        );
        $this->end_controls_section();
        
        //List Styling***********
        $this->start_controls_section(
            'list_styling_settings',
            [
                'label' => esc_html__('List Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'connector_type',
            [
                'label' => esc_html__('Connector Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'none'    =>  esc_html__('None','booster-addons'), 
                    'solid'  =>  esc_html__('Solid','booster-addons'), 
                    'dotted'  =>  esc_html__('Dotted','booster-addons'), 
                    'dashed'  =>  esc_html__('Dashed','booster-addons'), 
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-listib-item:before' => 'border-left-style: {{VALUE}};',
                ],
                'default' => 'solid',
            ]
        );
        $this->add_control(
            'connector_color',
            [
                'label' => esc_html__('Connector Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['connector_type!' => ['none']],                
                'default' => '#ccc',
                'selectors' => ['{{WRAPPER}} .elb-listib-item:before' => 'border-left-color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'cnctor_width',
            [
                'label' => esc_html__('Connector Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 
                'condition' => ['connector_type!' => ['none']],                
                'dynamic' => ['active' => true],
                'default' => '1',
                'selectors' => [
                    '{{WRAPPER}} .elb-listib-item:before' => 'border-left-width: {{VALUE}}px;--cnctor-width: {{VALUE}}px;',
                ]
            ]
        );

        $this->end_controls_section();


        //Icon Styling***********
        $this->start_controls_section(
            'icon_settings',
            [
                'label' => esc_html__('Icon', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '300',
                'default' => '30',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-icon-ctn svg' => 'width:{{VALUE}}px; height:{{VALUE}}px;'],

            ]
        );
        $this->add_control(
            'icon_size_bg',
            [
                'label' => esc_html__('Icon Background Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 'max' => '500',
                'default' => '80',
                'dynamic' => ['active' => true],
                'selectors' => [                    
                    '{{WRAPPER}} .elb-icon-ctn' => 'width: {{icon_size_bg}}px; height: {{icon_size_bg}}px; line-height: {{icon_size_bg}}px;',
                    '{{WRAPPER}} .elb-listib-content' => 'width: calc(100% - {{icon_size_bg}}px);',
                    '{{WRAPPER}}  .elb-listib-item-ctn' => '--back-size:{{VALUE}}px;',
                ]
            ]
        ); 

        $this->start_controls_tabs( 'icon_settings_tabs' );
        //Icon Normal
        $this->start_controls_tab( 'icon_normal',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' )
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',                
                'selectors' => ['{{WRAPPER}} .elb-icon-ctn .elb-icon-r svg' => 'color: {{VALUE}};']

            ]
        );
        $this->add_control(
            'icon_bg',
            [
                'label' => esc_html__('Icon Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'selectors' => ['{{WRAPPER}} .elb-icon-ctn .elb-bg-r:after' => 'color: {{VALUE}}; background: {{VALUE}};']
            ]
        );
        $this->add_control(
            'icon_radius',
            [
                'label' => esc_html__( 'Background Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-icon-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );          
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_br',
                'label' => esc_html__( 'Icon Border', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-bg-r:after',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_bxs',
                'label' => esc_html__('Icon Box Shadow', 'booster-addons'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-bg-r:after',
            ]
        );
        $this->add_control(
            'icon_rotate_x',
            [
                'label' => esc_html__('Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'selectors' => [
                    '{{WRAPPER}} .elb-icon-ctn .elb-theicon svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'icon_bg_rotate_x',
            [
                'label' => esc_html__('Background Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'selectors' => [
                    '{{WRAPPER}} .elb-icon-ctn .elb-btn-item-back:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $this->end_controls_tab();

        //Hover Icon
        $this->start_controls_tab( 'icon_hover',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' )
            ]
        );
        $this->add_control(
            'icon_hover_enabled',
            [
                'label' => esc_html__( 'Enable Color Hover', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'icon_effect',
            [
                'label' => esc_html__('Icon Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,'separator' => 'before',
                'options' => elb_icon_hover_effects(),
                'default' => 'sisawa',
                'condition' => ['icon_hover_enabled' => [ 'yes' ]],
            ]
        );
        $this->add_control(
            'icon_color_h',
            [
                'label' => esc_html__('Icon Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['icon_hover_enabled' => [ 'yes' ]],
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-icon-ctn .elb-icon-h svg' => 'color: {{VALUE}};']
            ]
        );
        $this->add_control(
            'icon_bg_h',
            [
                'label' => esc_html__('Icon Background -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['icon_hover_enabled' => [ 'yes' ]],
                'default' => '#232323',
                'selectors' => ['{{WRAPPER}} .elb-icon-ctn .elb-bg-h' => 'color: {{VALUE}}; background: {{VALUE}};']
            ]
        );       
        $this->add_control(
            'icon_radius_h',
            [
                'label' => esc_html__( 'Background Radius -Hover-', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'condition' => ['icon_hover_enabled' => [ 'yes' ]],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}}:hover .elb-icon-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );          
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_br_h',
                'label' => esc_html__( 'Icon Border -Hover-', 'booster-addons' ),
                'condition' => ['icon_hover_enabled' => [ 'yes' ]],
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-bg-h',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_bxs_h',
                'label' => esc_html__('Icon Box Shadow -Hover-', 'booster-addons'),
                'condition' => ['icon_hover_enabled' => [ 'yes' ]],
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-icon-ctn .elb-bg-h',
            ]
        );
        $this->add_control(
            'icon_rotate_x_h',
            [
                'label' => esc_html__('Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'selectors' => [
                    '{{WRAPPER}} .elb-listib-item-ctn:hover .elb-icon-ctn .elb-theicon svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'icon_bg_rotate_x_h',
            [
                'label' => esc_html__('Background Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',                
                'selectors' => [
                    '{{WRAPPER}} .elb-listib-item-ctn:hover .elb-icon-ctn .elb-btn-item-back:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'
                ],
                'dynamic' => ['active' => true],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        //Icon Styling***********
        $this->start_controls_section(
            'distances_settings',
            [
                'label' => esc_html__('Distances', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '10','right' => '30','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-icon-ctn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}}' => '--margin-left:{{LEFT}}{{UNIT}};--margin-right:{{RIGHT}}{{UNIT}};--margin-bottom:{{BOTTOM}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '0','top' => '6','right' => '0','bottom' => '5','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-listib-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'subheading_margin',
            [
                'label' => esc_html__( 'Sub Heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-listib-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'shorttext_margin',
            [
                'label' => esc_html__( 'Shor Text Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-listib-shorttext' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'ctn_margin',
            [
                'label' => esc_html__( 'Container Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '40','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-listib-item-ctn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );   
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = '';        
        $icon_settings = [
            'hover' => $settings['icon_hover_enabled']
        ];
        $output .= '<div class="elb-listib-ctn" data-layout="'.esc_attr($settings['layout_align']).'">';
               
               if($settings['list']):
                    foreach($settings['list'] as $item):
                        $icon_settings['link'] = $item['link'];
                        $icon_settings['icon'] = $item['icon'];
                        $icon_settings['effect'] = ($item['item_custom_style'] == 'yes') ? $item['cst_icon_effect'] : $settings['icon_effect'];

                        $output .= '<div class="elb-listib-item-ctn elb-fs elb-btn-item elementor-repeater-item-'.$item['_id'].' elb-icon-hvctn" data-hover="'.esc_attr($settings['icon_effect']).'">';
                            $output .= '<div class="elb-listib-item elb-fs">';
                                if($settings['icons_enabled'])
                                    $icon_output = '<div class="elb-listib-icon-ctn">'.elb_render_infolist_icon($icon_settings).'</div>';
                                $content_output = '<div class="elb-listib-content">';                                
                                    $content_output .= '<div class="elb-listib-heading"><span>'.wp_kses_post($item['heading']).'</span></div>';
                                    $content_output .= '<div class="elb-listib-subheading"><span>'.wp_kses_post($item['sub_heading']).'</span></div>';
                                    $content_output .= '<div class="elb-listib-shorttext"><span>'.wp_kses_post($item['short_text']).'</span></div>';                                    
                                $content_output .= '</div>';    

                                $output .= $settings['layout_align'] == 'left' ? $icon_output . ''.$content_output : $content_output .''. $icon_output;
                                

                            $output .= '</div>';        
                        $output .= '</div>';        

                    endforeach;
               endif; 

        $output .= '</div>';        

        echo apply_filters('elb_listinfobox_output', $output, $settings);
    }

}        