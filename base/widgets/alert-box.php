<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_AlertBox_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-alertbox-widget';
    }
    public function get_title() {
        return esc_html__('Alert Box', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-alert';
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
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'default' => 'warning',                
                'label_block' => true               
            ]
        );
        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Alert Title', 'booster-addons'),
                'label_block' => true,
                'default' => 'Warning!',
            ]
        );
        $this->add_control(
            'message',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Alert Message', 'booster-addons'),
                'label_block' => true,
                'default' => 'There was a problem with your network connection',
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left'
            ]
        );
        $this->end_controls_section();
        
        //Alert Box Actions    
        $this->start_controls_section(
            'section_actions',
            [
                'label' => esc_html__('Actions', 'booster-addons'),
            ]
        );
        $this->add_control(
            'close_enabled',
            [
                'label' => esc_html__('Enable Close Button', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'disabled',
            ]
        );
        $this->add_control(
            'close_color',
            [
                'label' => esc_html__('Close Button Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => ['close_enabled' => 'enabled'],
                'selectors' => [
                    '{{WRAPPER}} .elb-albx-close' => 'color: {{VALUE}};',
                ],
            ]
        );  

        $this->add_control(
            'show_enabled',
            [
                'label' => esc_html__('Show Timer', 'booster-addons'),
                'description' => esc_html__('When enabled the alert box will be hidden until the timer is done then it will be shown.', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'disabled',
            ]
        );
        $this->add_control(
            'show_timer_value',
            [
                'label' => esc_html__('Show Timer Value (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '60', 
                'condition' => ['show_enabled' => 'enabled'],
                'dynamic' => ['active' => true],
                'default' => '5'
            ]
        );


        $this->add_control(
            'hide_enabled',
            [
                'label' => esc_html__('Hide Timer', 'booster-addons'),
                'description' => esc_html__('When enabled the alert box will be shown only for the amount of time you define then it will be hidden.', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'disabled',
            ]
        );
        $this->add_control(
            'hide_timer_value',
            [
                'label' => esc_html__('Hide Timer Value (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '60', 
                'condition' => ['hide_enabled' => 'enabled'],
                'dynamic' => ['active' => true],
                'default' => '5'
            ]
        );

        $this->end_controls_section();

        /********************************************
                    STYLE SECTION       
        ********************************************/
        $this->start_controls_section(
            'typography_styling',
            [
                'label' => esc_html__('Typography Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_settings',
            [
                'label' => esc_html__('Title Typography', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_font',
                'label' => esc_html__('Title Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-albx-title',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elb-albx-title' => 'color: {{VALUE}};',
                ],
            ]
        );  
        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Title Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '5','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-albx-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'message_settings',
            [
                'label' => esc_html__('Message Typography', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'message_font',
                'label' => esc_html__('Message Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-albx-message',
            ]
        );
        $this->add_control(
            'message_color',
            [
                'label' => esc_html__('Message Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .elb-albx-message' => 'color: {{VALUE}};',
                ],
            ]
        ); 
        $this->add_control(
            'message_margin',
            [
                'label' => esc_html__( 'Message Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '5','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-albx-message' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();
        $this->start_controls_section(
            'container_styling',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );                
        $this->add_control(
            'ctn_height',
            [
                'label' => esc_html__('Min Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '20', 
                'dynamic' => ['active' => true],
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-albx-ctn' => 'min-height: {{VALUE}}px;'],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_bg',
                'label' => esc_html__( 'Container Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#F44336'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-albx-ctn',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-albx-ctn',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-albx-ctn',
            ]
        );
        $this->add_control(
            'ctn_radius',
            [
                'label' => esc_html__( 'Container Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-albx-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'ctn_padding',
            [
                'label' => esc_html__( 'Container Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-albx-ctn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();

        $this->start_controls_section(
            'icon_styling',
            [
                'label' => esc_html__('Icon Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );  
        $this->add_control(
            'icon_width',
            [
                'label' => esc_html__('Icon Background Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '200',
                'default' => '50',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-albx-icon' => 'width: {{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'icon_height',
            [
                'label' => esc_html__('Icon Background Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '200',
                'default' => '50',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-albx-icon' => 'height: {{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '300',
                'default' => '20',
                'dynamic' => ['active' => true]
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'icon_color',
                'dynamic' => ['active' => true],
                'fields_options' => ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
                'label' => esc_html__('Icon Color', 'booster-addons')
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-albx-icon',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_br',
                'label' => esc_html__( 'Icon Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-albx-icon',
            ]
        );
        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-albx-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = ''; 
        $icon_color = [
            'color_one_pos'     => $settings['icon_color_color_one_pos'] ,
            'color_one'         => $settings['icon_color_color_one'] ,
            'color_two_pos'     => $settings['icon_color_color_two_pos'] ,
            'color_two'         => $settings['icon_color_color_two'] ,
            'gradient_enabled'  => $settings['icon_color_gradient_enabled'],
            'direction'         => $settings['icon_color_direction'],
        ];


        $ctn_style = ($settings['show_enabled'] == 'enabled') ? '--albx-show-timer:'.esc_attr($settings['show_timer_value']).'s;' : '';
        
        if($settings['hide_enabled'] == 'enabled'):
            $hide_timer = ($settings['show_enabled'] == 'enabled') ? $settings['hide_timer_value'] + $settings['show_timer_value'] : $settings['hide_timer_value'];
            $ctn_style .= '--albx-hide-timer:'.esc_attr($hide_timer).'s;';
        endif;


        



        $output .= '<div class="elb-albx-ctn" style="'.$ctn_style.'" data-align="'.esc_attr($settings['align']).'" data-show="'.esc_attr($settings['show_enabled']).'" data-hide="'.esc_attr($settings['hide_enabled']).'">';
            
            if($settings['close_enabled'] == 'enabled')
                $output .= '<div class="elb-albx-close elb-tr-2" onclick="elb_close_alert_box(this)"></div>';


            if(!empty($settings['icon']))
                $output .= '<div class="elb-albx-icon">'.CertainDev_Icons::get_icon($settings['icon'], $icon_color, $settings['icon_size']).'</div>';
    
            if(!empty($settings['title']))
                $output .= '<div class="elb-albx-title">'.wp_kses_post($settings['title']).'</div>';
            
            if(!empty($settings['message']))
                $output .= '<div class="elb-albx-message">'.wp_kses_post($settings['message']).'</div>';
        
        $output .= '</div>'; 

        echo apply_filters('elb_alertbox_output', $output, $settings);
    }

}