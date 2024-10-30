<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_InteractiveIconBox_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-interactiveiconbox-widget';
    }
    public function get_title() {
        return esc_html__('Interactive IconBox', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-icon-box';
    }
    public function get_categories() {
        return array('booster-addons');
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        //Content
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );    
        $this->add_control(
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => 'fire'  
            ]
        );
        $this->add_control(
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading', 'booster-addons'),
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
                'default' => 'Far far away, behind the word mountains,  at the coast of the Semantics, a large language ocean. A small river named Duden',
                'dynamic' => ['active' => true],
            ]
        );
        $this->end_controls_section();
        //Layout
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'booster-addons'),
            ]
        );  
        //Icon Area
        $this->add_control(
            'settings_icon_area',
            [
                'label' => esc_html__('Icon Area Settings', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'icon_position',
            [
                'label' => esc_html__('Icon Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left'
            ]
        );
        $this->add_control(
            'content_position',
            [
                'label' => esc_html__('Content Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'flex-end' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-primary' => 'justify-content: {{VALUE}};',
                ]
            ]
        );
        //Icon Area
        $this->add_control(
            'settings_text_content',
            [
                'label' => esc_html__('Short Text Settings', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'short_text_position',
            [
                'label' => esc_html__('Short Text Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-secondary' => 'text-align: {{VALUE}};',
                ]
            ]
        );        
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'separator' => 'before',
                'default' => ['url' => ''],
            ]
        );
        $this->end_controls_section();
        /********************************************
                    STYLE SECTION       
        ********************************************/

        //-----------------Icon Styling Sub Content---------------- 
        //Icon Styling            
        $this->start_controls_section(
            'section_icon_styling',
            [
                'label' => esc_html__('Icon Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 'max' => '300',
                'default' => '30',
                'dynamic' => ['active' => true],
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
                    '{{WRAPPER}} .elb-inicb-pr-icon' => 'width: {{icon_size_bg}}px; height: {{icon_size_bg}}px; line-height: {{icon_size_bg}}px;',
                ]
            ]
        ); 
        $this->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'icon_color',
                'dynamic' => ['active' => true],
                'label' => esc_html__('Icon Color', 'booster-addons'),
                'fields_options' => ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'separator' => 'before',
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]],                
                'selector' => '{{WRAPPER}} .elb-inicb-pr-icon',
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
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-pr-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_br',
                'label' => esc_html__( 'Icon Border', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-inicb-pr-icon',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'icon_bxs',
                'label' => esc_html__('Icon Box Shadow', 'booster-addons'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-inicb-pr-icon',
            ]
        );
        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-pr-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->end_controls_section();
        
        //Heading Styling             
        $this->start_controls_section(
            'section_heading_styling',
            [
                'label' => esc_html__('Heading Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-pr-heading',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],                

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-pr-heading',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 17,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-pr-heading',
            ]
        );
        $this->add_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '6','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-pr-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->end_controls_section();
        
        //Sub Heading Styling    
        $this->start_controls_section(
            'section_subheading_styling',
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
                'selector' => '{{WRAPPER}} .elb-inicb-pr-subheading',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#999']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-pr-subheading',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->end_controls_section();

        //Short Text Styling    
        $this->start_controls_section(
            'section_shorttext_styling',
            [
                'label' => esc_html__('Short Text Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );         
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'short_text_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-sc-text',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-sc-text',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.8,'unit' => 'em']],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->end_controls_section();
   
        //Container Styling    
        $this->start_controls_section(
            'section_container_styling',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );      
        $this->add_control(
            'hover_effect',
            [
                'label' => esc_html__('Hover Styling', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_two_elements_hover_effects(),
                'default' => 'move_left',
            ]
        );
        $this->add_control(
            'ctn_height',
            [
                'label' => esc_html__('Container Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '60', 'max' => '750',
                'default' => '250',
                'dynamic' => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-ctn' => 'min-height: {{VALUE}}px;',
                ],
            ]
        );        
        //Styling for Primary Area
        $this->start_controls_tabs( 'btn_settings' );
        $this->start_controls_tab( 'primary_area',
            [
                'label' => esc_html__( 'Primary', 'booster-addons' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'primary_bg',
                'label' => esc_html__( 'Primary Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#fafafa']],                
                'selector' => '{{WRAPPER}} .elb-inicb-primary',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'primary_br',
                'label' => esc_html__( 'Primary Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-inicb-primary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'primary_bxs',
                'label' => esc_html__('Primary Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-primary',
            ]
        );
        $this->add_control(
            'primary_ctn_padding',
            [
                'label' => esc_html__( 'Container Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'after',
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
            'primary_ctn_ovl_hd',
            [
                'label' => esc_html__('Overlay Background', 'booster-addons'),
                'description' => esc_html__( 'Apply background overlay only if you have an image as a background.', 'booster-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'primary_ctn_ovl',
                'label' => esc_html__( 'Overlay Background', 'booster-addons' ),
                'description' => esc_html__( 'Apply background overlay only if you have an image as a background.', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'transparent'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-inicb-primary:before',
            ]
        );
        $this->end_controls_tab();
        //Styling for Secondary Area
        $this->start_controls_tab( 'secondary_area',
            [
                'label' => esc_html__( 'Secondary', 'booster-addons' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'secondary_bg',
                'label' => esc_html__( 'Secondary Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#f8f8f8']],
                'selector' => '{{WRAPPER}} .elb-inicb-secondary',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'secondary_br',
                'label' => esc_html__( 'Secondary Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-inicb-secondary',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'secondary_bxs',
                'label' => esc_html__('Secondary Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-inicb-secondary',
            ]
        );
        $this->add_control(
            'secondary_ctn_padding',
            [
                'label' => esc_html__( 'Container Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'separator' => 'after',
                'default' => ['left' => '31','top' => '31','right' => '31','bottom' => '31','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-inicb-secondary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
            'secondary_ctn_ovl_hd',
            [
                'label' => esc_html__('Overlay Background', 'booster-addons'),
                'description' => esc_html__( 'Apply background overlay only if you have an image as a background.', 'booster-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'secondary_ctn_ovl',
                'label' => esc_html__( 'Overlay Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'transparent'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-inicb-secondary:before',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
   }
   
    protected function render() {
        $settings = $this->get_settings_for_display();  
        
        $icon_color = [
                'color_one_pos'     => $settings['icon_color_color_one_pos'],
                'color_one'         => $settings['icon_color_color_one'],
                'color_two_pos'     => $settings['icon_color_color_two_pos'] ,
                'color_two'         => $settings['icon_color_color_two'] ,
                'direction'         => $settings['icon_color_direction'] ,
                'gradient_enabled'  => $settings['icon_color_gradient_enabled']
        ];

        $output = '<div class="elb-inicb-ctn elb-widget elb-hv2el-ctn " data-hover="'.esc_attr($settings['hover_effect']).'" data-icon-position="'.esc_attr($settings['icon_position']).'" data-primary-align="'.esc_attr($settings['content_position']).'" data-secondary-align="'.esc_attr($settings['short_text_position']).'">';
            $output .= '<div class="elb-inicb-insider elb-hv2el-insider">';
                //Primary Area   
                $output .= '<div class="elb-inicb-primary elb-inicb-area elb-tr-3 elb-hv2el-1">';
                    $output .= '<div class="elb-inicb-primary-insider">';
                        $output .= '<div class="elb-inicb-pr-icon-ctn"><div class="elb-inicb-pr-icon">'.CertainDev_Icons::get_icon($settings['icon'], $icon_color, $settings['icon_size']).'</div></div>';
                        $output .= '<div class="elb-inicb-pr-heading-ctn"><div class="elb-inicb-pr-heading">'.wp_kses_post($settings['heading']).'</div><div class="elb-inicb-pr-subheading">'.wp_kses_post($settings['sub_heading']).'</div></div>';
                    $output .= '</div>';
                $output .= '</div>';

                //Secondary Area   
                $output .= '<div class="elb-inicb-secondary elb-inicb-area elb-tr-3 elb-hv2el-2">';
                    $output .= '<div class="elb-inicb-sc-text-ctn elb-fs"><div class="elb-inicb-sc-text elb-fs">'.wp_kses_post(nl2br($settings['short_text'])).'</div></div>';
                $output .= '</div>';
        
           $output .= '</div>';
           $output .= (!empty($settings['link'])) ? elb_render_elementor_link($settings['link'], '', true) : '';
        $output .= '</div>';

        echo apply_filters('elb_interactiveiconbox_output', $output, $settings);
    }
}                 