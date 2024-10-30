<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ModalWindow_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-modalwindow-widget';
    }
    public function get_title() {
        return esc_html__('Modal Window', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-call-to-action';
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
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading', 'booster-addons'),
                'label_block' => true,
                'default' => 'Modal Window Heading'
               
            ]
        );
        $this->add_control(
            'text',
            [
                'type' => Controls_Manager::WYSIWYG ,
                'label' => esc_html__('Text Content', 'booster-addons'),
                'label_block' => true,
                'default' => 'Booster Addons is a premium elements and widgets bundle for the Elementor front end page builder, it comes with more than 60 unique and modern elements.'              
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
        $this->add_control(
            'content_vrt_pos',
            [
                'label' => esc_html__('Vertical Aligment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],
                'default' => 'middle',
            ]
        );
        $this->add_control(
            'content_hrz_pos',
            [
                'label' => esc_html__('Horizontal Aligment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],
                'default' => 'center',
            ]
        );        
        $this->add_control(
            'show_effect',
            [
                'label' => esc_html__('Show Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_modal_show_effects(),
                'default' => 'km-effect-1',
            ]
        );     
        $this->add_control(
            'heading_align',
            [
                'label' => esc_html__('Heading Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-heading' => 'text-align: {{VALUE}};'],

            ]
        );
        $this->add_control(
            'content_align',
            [
                'label' => esc_html__('Content Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-text' => 'text-align: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'close_layout',
            [
                'label' => esc_html__('Close Button', 'booster-addons'),
                'description' => esc_html__('Choose the close button for the modal window.', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'separator' => 'before',
                'options' => [
                    'none' => esc_html__('None', 'booster-addons'),
                    'only_icon' => esc_html__('Only Icon', 'booster-addons'),
                    'only_button' => esc_html__('Only Button', 'booster-addons'),
                    'both' => esc_html__('Icon & Button', 'booster-addons'),
                ],
                'default' => 'only_icon',
            ]
        );
        $this->add_control(
            'cls_icon_pos',
            [
                'label' => esc_html__('Close Icon Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'condition' => ['close_layout' => ['only_icon','both']],
                'default' => 'right'
            ]
        );
        $this->add_control(
            'cls_icon_layout',
            [
                'label' => esc_html__('Close Icon Layout', 'booster-addons'),
                'description' => esc_html__('Choose the where to place the close icon, insider the modal or outside the fullscreen container', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'inside' => esc_html__('Inside', 'booster-addons'),
                    'outside' => esc_html__('Outside', 'booster-addons'),
                ],
                'condition' => ['close_layout' => ['only_icon','both']],
                'default' => 'inside',
            ]
        );
        $this->add_control(
            'cls_btn_align',
            [
                'label' => esc_html__('Close Button Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'condition' => ['close_layout' => ['only_button','both']],
                'default' => 'center',
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-cls-ar' => 'text-align: {{VALUE}};'],

            ]
        );
        $this->add_control(
            'cls_btn_txt',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Close Button Alignment', 'booster-addons'),
                'label_block' => true,
                'condition' => ['close_layout' => ['only_button','both']],
                'default' => esc_html__('Close Me!', 'booster-addons'),
               
            ]
        );
        $this->end_controls_section();
        /********************************************
                    STYLE SECTION       
        ********************************************/

        //-----------------Container Styling----------------             
        $this->start_controls_section(
            'container_styling',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'fs_background',
            [
                'label' => esc_html__('Full Screen Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.5)',
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-bg' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'ctn_width',
            [
                'label' => esc_html__('Container Width', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => ['min' => 100,'max' => 1920,'step' => 10],
                    '%' => ['min' => 0,'max' => 100],
                ],
                'default' => ['unit' => 'px','size' => 550],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-mdl-content' => 'width: {{SIZE}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'ctn_height',
            [
                'label' => esc_html__('Container Height', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px','%'],
                'range' => [
                    'px' => ['min' => 100,'max' => 1080,'step' => 10],
                    '%' => ['min' => 0,'max' => 100],
                ],
                'default' => ['unit' => 'px','size' => 240],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-mdl-content' => 'min-height: {{SIZE}}{{UNIT}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_bg',
                'label' => esc_html__( 'Container Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-mdl-w-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-mdl-w-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-mdl-w-content',
            ]
        );
        $this->add_control(
            'ctn_mrg',
            [
                'label' => esc_html__( 'Container Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
            'ctn_radius',
            [
                'label' => esc_html__( 'Container Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'heading_paddings',
            [
                'label' => esc_html__( 'Heading Area Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'default' => ['left' => '20','top' => '20','right' => '20','bottom' => '20','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'content_paddings',
            [
                'label' => esc_html__( 'Content Area Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'default' => ['left' => '40','top' => '8','right' => '40','bottom' => '8','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'btn_area_paddings',
            [
                'label' => esc_html__( 'Close Button Area Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'condition' => ['close_layout' => ['only_button','both']],
                'default' => ['left' => '20','top' => '20','right' => '20','bottom' => '20','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-cls-ar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();

        //-----------------Typography Styling----------------             
        $this->start_controls_section(
            'typography_styling',
            [
                'label' => esc_html__('Typography Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_font_settings',
            [
                'label' => esc_html__('Heading Typography', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Heading Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-mdl-w-heading',
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_font_settings',
            [
                'label' => esc_html__('Content Typography', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_font',
                'label' => esc_html__('Text Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 17,'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-mdl-w-text',
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        //-----------------Close Styling----------------             
        $this->start_controls_section(
            'close_styling',
            [
                'label' => esc_html__('Close Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['close_layout!' => ['none']],
            ]
        );
        //Cls Icon Styling
        $this->add_control(
            'cls_icon_styling',
            [
                'label' => esc_html__('Close Icon Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,        
                'condition' => ['close_layout' => ['only_icon','both']],
            ]
        );
        $this->add_control(
            'cls_icon_radius',
            [
                'label' => esc_html__('Close Icon Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'round'    =>  esc_html__('Round','booster-addons'), 
                    'square'  =>  esc_html__('Square','booster-addons'), 
                ],
                'condition' => ['close_layout' => ['only_icon','both']],
                'default' => 'round',
            ]
        );
        $this->start_controls_tabs( 'cls_icon_settings' );
        $this->start_controls_tab( 'normal_cls_icon',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
                'condition' => ['close_layout' => ['only_icon','both']],
            ]
        );
        $this->add_control(
            'cls_icon_color',
            [
                'label' => esc_html__('Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'condition' => ['close_layout' => ['only_icon','both']],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'cls_icon_bg',
            [
                'label' => esc_html__('Background Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => ['close_layout' => ['only_icon','both']],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'normal_cls_icon_h',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
                'condition' => ['close_layout' => ['only_icon','both']],
            ]
        );
        $this->add_control(
            'cls_icon_color_h',
            [
                'label' => esc_html__('Icon Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => ['close_layout' => ['only_icon','both']],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-icon:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'cls_icon_bg_h',
            [
                'label' => esc_html__('Background Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'condition' => ['close_layout' => ['only_icon','both']],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-icon:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();    
        $this->end_controls_tabs();
         $this->add_control(
            'cls_icon_mrg',
            [
                'label' => esc_html__( 'Close Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'separator' => 'after',
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-mdl-w-cls-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        //Cls Button Styling
        $this->add_control(
            'cls_btn_styling',
            [
                'label' => esc_html__('Close Button Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,        
                'condition' => ['close_layout' => ['only_button','both']],
            ]
        );
        $this->add_control(
            'cls_btn_bg',
            [
                'label' => esc_html__('Background Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#222',
                'condition' => ['close_layout' => ['only_button','both']],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-btn' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'cls_btn_color',
            [
                'label' => esc_html__('Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => ['close_layout' => ['only_button','both']],
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'cls_btn_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'condition' => ['close_layout' => ['only_button','both']],
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-mdl-w-cls-btn',
            ]
        );
        $this->end_controls_section();
        
        //-----------------Trigger Button----------------             
        $buttonDefaults = [
            'btn_txt' => 'Open Modal'
        ];
        ELB_Button_Tab::init($this,'full',$buttonDefaults);
    }
   
    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = '';    
        $modal_id = $this->get_id_int();      

        //Trigger Button output
        $icon_colors = [
            'btn_icon_color' => [
                'color_one_pos'     => $settings['btn_icon_color_color_one_pos'] ,
                'color_one'         => $settings['btn_icon_color_color_one'] ,
                'color_two_pos'     => $settings['btn_icon_color_color_two_pos'] ,
                'color_two'         => $settings['btn_icon_color_color_two'] ,
                'gradient_enabled'  => $settings['btn_icon_color_gradient_enabled'],
                'direction'         => $settings['btn_icon_color_direction']                
            ],
            'btn_icon_color_hv' => [
                'color_one_pos'     => $settings['btn_icon_color_hv_color_one_pos'] ,
                'color_one'         => $settings['btn_icon_color_hv_color_one'] ,
                'color_two_pos'     => $settings['btn_icon_color_hv_color_two_pos'] ,
                'color_two'         => $settings['btn_icon_color_hv_color_two'] ,
                'gradient_enabled'  => $settings['btn_icon_color_hv_gradient_enabled'],
                'direction'         => $settings['btn_icon_color_hv_direction']
            ]
        ];
        
        $content = $this->modal_content_render($settings);
        //Global output    
        $output .= elb_render_fulscreen_element($settings,$modal_id,$icon_colors,$content);        
        echo apply_filters('elb_modalwindow_output', $output, $settings);
    }

    protected function modal_content_render($settings) {
        $content = '';
        $content .= '<div class="elb-mdl-w-content">';
            //Close Icon
            $content .= ($settings['cls_icon_layout'] == 'inside' && in_array($settings['close_layout'], ['only_icon','both'])) ? 
                        '<div class="elb-mdl-w-cls-icon elb-tr-2" data-layout="'.esc_attr($settings['cls_icon_layout'] ).'" onclick="elb_change_situation(this,\'inactive\', \'parent\', \'.elb-mdl-ctn\')" data-align="'.$settings['cls_icon_pos'].'" data-radius="'.esc_attr($settings['cls_icon_radius']).'"></div>' : ''; 
            
            $content .= '<div class="elb-mdl-w-heading">'.wp_kses_post($settings['heading']).'</div>'; 
            $content .= '<div class="elb-mdl-w-text">'.$settings['text'].'</div>'; 
            
            //Close Button
            $content .= (in_array($settings['close_layout'], ['only_button','both'])) ? 
                        '<div class="elb-mdl-w-cls-ar"> <div class="elb-mdl-w-cls-btn elb-tr-2" onclick="elb_change_situation(this,\'inactive\', \'parent\', \'.elb-mdl-ctn\')">'.wp_kses_post($settings['cls_btn_txt']).'</div></div>' : ''; 
        
        $content .= '</div>'; 
        return $content;
    }

}