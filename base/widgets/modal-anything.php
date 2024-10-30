<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ModalAnything_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-modalanything-widget';
    }
    public function get_title() {
        return esc_html__('Modal Anything', 'booster-addons');
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
            'template_content',
            [
                'label' => esc_html__('Choose Template', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_get_content_templates(),
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
            'cls_icon_pos',
            [
                'label' => esc_html__('Close Icon Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
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
                'default' => 'outside',
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
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-mdl-content',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-mdl-content',
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
       $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_bg',
                'label' => esc_html__( 'Container Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#fff'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-mdl-content',
            ]
        );
       $this->add_control(
            'ctn_padding',
            [
                'label' => esc_html__( 'Container Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-mdl-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();

        //-----------------Close Styling----------------             
        $this->start_controls_section(
            'close_styling',
            [
                'label' => esc_html__('Close Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Cls Icon Styling
        $this->add_control(
            'cls_icon_styling',
            [
                'label' => esc_html__('Close Icon Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,        
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
                'default' => 'round',
            ]
        );
        $this->start_controls_tabs( 'cls_icon_settings' );
        $this->start_controls_tab( 'normal_cls_icon',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'cls_icon_color',
            [
                'label' => esc_html__('Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
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
                'selectors' => [
                    '{{WRAPPER}} .elb-mdl-w-cls-icon' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'normal_cls_icon_h',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'cls_icon_color_h',
            [
                'label' => esc_html__('Icon Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
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
        $this->end_controls_section();

        //-----------------Trigger Button----------------             
        ELB_Button_Tab::init($this,'full');
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
        $content = '';
       
        if($settings['template_content'] != ''):
            $content = Plugin::$instance->frontend->get_builder_content_for_display($settings['template_content']);
        endif;
        $cls_icon = '<div class="elb-mdl-w-cls-icon elb-tr-2" data-layout="'.esc_attr($settings['cls_icon_layout'] ).'" onclick="elb_change_situation(this,\'inactive\', \'parent\', \'.elb-mdl-ctn\')" data-align="'.$settings['cls_icon_pos'].'" data-radius="'.esc_attr($settings['cls_icon_radius']).'"></div>'; 
        //Global output        
        $output .= elb_render_fulscreen_element($settings,$modal_id,$icon_colors,$content,$cls_icon);

        echo apply_filters('elb_modalanything_output', $output, $settings);
    }

    

}