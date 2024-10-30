<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_IconBoxAction_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-iconboxaction-widget';
    }
    public function get_title() {
        return esc_html__('IconBox Action', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-info-box';
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
            'action_hover_effect',
            [
                'label' => esc_html__('Action Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'zoom_in' => esc_html__('Zoom In', 'booster-addons'),
                    'translate' => esc_html__('Translate', 'booster-addons'),
                ],
                'default' => 'zoom_in',
            ]
        );
        $this->add_control(
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'default' => 'fire',
                'label_block' => true          
            ]
        );
        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'booster-addons'),
                'label_block' => true,
                'default' => 'Booster Addons',
            ]
        );
        $this->add_control(
            'sub_heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub Heading', 'booster-addons'),
                'label_block' => true,
                'default' => 'Premium Addons',
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'short_text',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Short text', 'booster-addons'),
                'label_block' => true,
                'default' => 'One of the best elementor widgets addons available on the market with unique and modern elements.',
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'btn_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Button Text', 'booster-addons'),
                'label_block' => true,
                'default' => '',
                'dynamic' => ['active' => true],
            ]
        );
        //-----------------Settings Sub Content----------------
        $this->add_control(
            'settings_subcontent',
            [
                'label' => esc_html__('Settings', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'ctn_height',
            [
                'label' => esc_html__('Container Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '50', 'max' => '900',
                'default' => '250',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-icba-ctn' => 'min-height: {{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        );
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'h1' => esc_html__('H1', 'booster-addons'),
                    'h2' => esc_html__('H2', 'booster-addons'),
                    'h3' => esc_html__('H3', 'booster-addons'),
                    'h4' => esc_html__('H4', 'booster-addons'),
                    'h5' => esc_html__('H5', 'booster-addons'),
                    'h6' => esc_html__('H6', 'booster-addons'),
                    'div' => esc_html__('div', 'booster-addons'),
                ],
                'default' => 'h2',
            ]
        );
        $this->add_control(
            'sub_heading_tag',
            [
                'label' => esc_html__('Sub Heading HTML Tag', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'h1' => esc_html__('H1', 'booster-addons'),
                    'h2' => esc_html__('H2', 'booster-addons'),
                    'h3' => esc_html__('H3', 'booster-addons'),
                    'h4' => esc_html__('H4', 'booster-addons'),
                    'h5' => esc_html__('H5', 'booster-addons'),
                    'h6' => esc_html__('H6', 'booster-addons'),
                    'div' => esc_html__('div', 'booster-addons'),
                ],
                'default' => 'h4',
            ]
        );
         $this->add_control(
            'icon_type',
            [
                'type' => Controls_Manager::HIDDEN,
                'default' => 'icon',
            ]
        );
        $this->end_controls_section();

        /********************************************
                    STYLE SECTION       
        ********************************************/

        //-----------------Icon Styling Sub Content----------------             
        $iconDefaults = [
            'icon_margin' => ['left' => '0','top' => '0','right' => '0','bottom' => '10','isLinked' => false],
            'icon_effect' => 'fade'
        ];
       
        ELB_IconHover_Tab::init($this,true,$iconDefaults);
                    



                    
        //-----------------Title Styling Sub Content----------------             
        $this->start_controls_section(
            'section_title_styling',
            [
                'label' => esc_html__('Title Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-title',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-title',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-title',
            ]
        );
        $this->add_control(
            'title_color_hover_enabled',
            [
                'label' => esc_html__( 'Title Hover Color', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_color_hover',
                'label' => esc_html__('Hover Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-title:hover',
                'condition' => [
                    'title_color_hover_enabled' => [ 'yes' ],
                ]
            ]
        );     
        $this->end_controls_section();


         //-----------------Sub Heading Styling Sub Content----------------             
        $this->start_controls_section(
            'section_sub_heading_styling',
            [
                'label' => esc_html__('Sub Heading Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'sub_heading_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-subheading',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#888']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-subheading',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 13,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sub_heading_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-subheading',
            ]
        );    
        $this->end_controls_section();


        //-----------------Short Text Styling Sub Content----------------             
        $this->start_controls_section(
            'section_short_text_styling',
            [
                'label' => esc_html__('Short text Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'short_text_color',
            [
                'label' => esc_html__('Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .elb-icba-shorttext' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-shorttext',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 15,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.5,'unit' => 'em']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
          
        $this->end_controls_section();
        
        //-----------------Button Styling Sub Content----------------             
        $this->start_controls_section(
            'section_button_styling',
            [
                'label' => esc_html__('Button Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'btn_font',
                'label' => esc_html__('Button Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-btn',
            ]
        );
        $this->add_control(
            'btn_pdg',
            [
                'label' => esc_html__( 'Button Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '20','top' => '10','right' => '20','bottom' => '10','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-icba-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
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
                'selector' => '{{WRAPPER}} .elb-icba-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'btn_txt_color',
                'label' => esc_html__('Button Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-btn span',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icba-btn',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-icba-btn',
            ]
        );
        $this->add_control(
            'btn_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-icba-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'btn_hover_enabled',
            [
                'label' => esc_html__( 'Enable Button Hover', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_h',
                'label' => esc_html__( 'Button Background-Hover-', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'condition' => ['btn_hover_enabled' => 'yes'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-icba-btn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'btn_txt_color_h',
                'label' => esc_html__('Button Color -Hover-', 'booster-addons'),
                'condition' => ['btn_hover_enabled' => 'yes'],
                'selector' => '{{WRAPPER}} .elb-icba-btn:hover span',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs_h',
                'label' => esc_html__('Button Box Shadow -Hover-', 'booster-addons'),
                'condition' => ['btn_hover_enabled' => 'yes'],
                'selector' => '{{WRAPPER}} .elb-icba-btn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br_h',
                'label' => esc_html__( 'Button Border -Hover-', 'booster-addons' ),
                'condition' => ['btn_hover_enabled' => 'yes'],
                'selector' => '{{WRAPPER}} .elb-icba-btn:hover',
            ]
        );
        $this->add_control(
            'btn_radius_h',
            [
                'label' => esc_html__( 'Button Border Radius -Hover-', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'condition' => ['btn_hover_enabled' => 'yes'],
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-icba-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );    

        $this->end_controls_section();

        //-----------------Distances Styling Sub Content----------------        
        $this->start_controls_section(
            'section_distances_styling',
            [
                'label' => esc_html__('Content Distances', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );    
        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Heading Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '5',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icba-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );   
        $this->add_control(
            'sub_heading_margin',
            [
                'label' => esc_html__( 'Sub Heading Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icba-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );    
        $this->add_control(
            'short_text_margin',
            [
                'label' => esc_html__( 'Short Text Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '25',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icba-shorttext' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'btn_margin',
            [
                'label' => esc_html__( 'Button Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '25',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icba-btn-ctn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );     
        $this->end_controls_section();


    }
    protected function render() {
        $settings = $this->get_settings_for_display();  
        $output = ''; 
        

        $settings['icon_type'] = 'icon';
        $icon_area = ELB_IconHover_Tab::render($settings);

        $output .= '<div class="elb-icba-ctn elb-widget elb-btn-item elb-icon-hvctn elb-tr-2" data-action-hover="'.esc_attr($settings['action_hover_effect']).'" data-hover="'.esc_attr($settings['icon_effect']).'">';
            $output .= '<div class="elb-icba-icon-ctn elb-fs">'.$icon_area.'</div>';            
            $title = '<' . esc_html($settings['title_tag']) . ' class="elb-icba-title elb-tr-3">' . wp_kses_post($settings['title']) . '</' . esc_html($settings['title_tag']) . '>';
            $output .= elb_render_elementor_link($settings['link'], $title);

            if(!empty($settings['sub_heading']))
                $output .= '<' . esc_html($settings['sub_heading_tag']) . ' class="elb-icba-subheading">' . wp_kses_post($settings['sub_heading']) . '</' . esc_html($settings['sub_heading_tag']) . '>';
            
            if(!empty($settings['short_text']))
                $output .= '<div class="elb-icba-shorttext elb-icba-animated elb-trd-2 elb-tr-2">' . wp_kses_post($settings['short_text']) . '</div>';
            if(!empty($settings['btn_text'])){
                $button = '<div class="elb-icba-btn-ctn elb-icba-animated elb-tr-2"><div class="elb-icba-btn"><span>' . wp_kses_post($settings['btn_text']) . '</span></div></div>';
           	 	$output .= elb_render_elementor_link($settings['link'], $button);
            }
                                    
        $output .= '</div>';
        echo apply_filters('elb_iconboxaction_output', $output, $settings);
    }
}                 