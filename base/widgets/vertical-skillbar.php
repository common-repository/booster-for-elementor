<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_VerticalSkillBar_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-verticalskillbar-widget';
    }
    public function get_title() {
        return esc_html__('Vertical Skill Bar', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-skill-bar';
    }
    public function get_categories() {
        return array('booster-addons');
    }
    public function get_script_depends() {
        return [
            'elb-inview'
        ];
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        //Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );
        $this->add_control(
            'skill_name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Skill Name', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => 'Skill Name',
            ]
        );
        $this->add_control(
            'name_style',
            [
                'label' => esc_html__('Skill Name Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1'    =>  esc_html__('Style 1','booster-addons'), 
                    'style_2'    =>  esc_html__('Style 2','booster-addons'), 
                    'style_3'    =>  esc_html__('Style 3','booster-addons'), 
                    #'style_4'    =>  esc_html__('Style 4','booster-addons'), 
                    #'style_5'    =>  esc_html__('Style 5','booster-addons'), 
                ],
                'default' => 'style_1',
            ]
        );
        $this->add_control(
            'skill_value',
            [
                'label' => esc_html__('Skill Value', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0,'max' => 100,'step' => 1]],
                'default' => ['unit' => 'px','size' => 65],
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout Design', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1'    =>  esc_html__('Style 1','booster-addons'), 
                    'style_2'    =>  esc_html__('Style 2','booster-addons'), 
                    'style_3'    =>  esc_html__('Style 3','booster-addons'), 
                    'style_4'    =>  esc_html__('Style 4','booster-addons'), 
                ],
                'default' => 'style_4',
            ]
        );
        
        $this->add_control(
            'percent_position',
            [
                'label' => esc_html__('Percent Value Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'condition' => ['layout' => ['style_3','style_4']],                
                'label_block' => true,
                'options' => [
                    'left'    =>  esc_html__('Left','booster-addons'), 
                    'right'    =>  esc_html__('Right','booster-addons'), 
                ],
                'default' => 'right',
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'before',
                'options' => [
                    'flex-start' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'flex-end' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elb-vrskb-inner' => 'justify-content: {{align}};',
                ],
            ]
        );
        $this->add_control(
            'name_position',
            [
                'label' => esc_html__('Skill Name Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'top'    =>  esc_html__('Top','booster-addons'), 
                    'bottom'    =>  esc_html__('Bottom','booster-addons'), 
                ],
                'default' => 'bottom',
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
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'skill_name_font',
                'label' => esc_html__('Skill Name Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-vrskb-name',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'skill_name_color',
                'label' => esc_html__('Skill Name Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-vrskb-name',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'skill_name_shadow',
                'label' => esc_html__('Skill Name Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-vrskb-name',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'skill_value_font',
                'label' => esc_html__('Value Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-vrskb-vl-in',
            ]
        );
        $this->add_control(
            'skill_value_color',
            [
                'label' => esc_html__('Value Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .elb-vrskb-vl-in' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'skill_value_scheme',
            [
                'label' => esc_html__('Value Color Scheme', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'condition' => ['layout' => ['style_3','style_4']], 
                'selectors' => [
                    '{{WRAPPER}} .elb-vrskb-vl:before,{{WRAPPER}} .elb-vrskb-vl-in:before,{{WRAPPER}} .elb-vrskb-vl-in:after' => 'color: {{VALUE}};',
                ],
            ]
        );
                               

        $this->end_controls_section();

        //Container Styling
        $this->start_controls_section(
            'container_settings',
            [
                'label' => esc_html__('Container', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ctn_width',
            [
                'label' => esc_html__('Container Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '1', 
                'dynamic' => ['active' => true],
                'default' => '20',
                'selectors' => ['{{WRAPPER}} .elb-vrskb-bar-ctn' => 'width: {{VALUE}}px;',],
            ]
        );
        $this->add_control(
            'ctn_height',
            [
                'label' => esc_html__('Container Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '1', 
                'dynamic' => ['active' => true],
                'default' => '200',
                'selectors' => ['{{WRAPPER}} .elb-vrskb-bar-ctn' => 'height: {{VALUE}}px;',],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_bg',
                'label' => esc_html__( 'Container Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#f4f4f4'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-vrskb-bar-ctn',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-vrskb-bar-ctn',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-vrskb-bar-ctn',
            ]
        );
        $this->add_control(
            'ctn_radius',
            [
                'label' => esc_html__( 'Container Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-vrskb-bar-ctn,{{WRAPPER}} .elb-vrskb-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'name_margins',
            [
                'label' => esc_html__( 'Skill Name Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-vrskb-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->end_controls_section();
        
        //Bar Styling
        $this->start_controls_section(
            'bar_settings',
            [
                'label' => esc_html__('Bar', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'bar_bg',
                'label' => esc_html__( 'Bar Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-vrskb-bar',
            ]
        );
        $this->add_control(
            'bar_transition',
            [
                'label' => esc_html__('Duration (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '10',
                'step' => '0.1',
                'default' => '0.5',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-vrskb-filler' => '-webkit-transition-duration: {{VALUE}}s;transition-duration: {{VALUE}}s;'],
            ]
        );
        $this->add_control(
            'bar_transition_delay',
            [
                'label' => esc_html__('Delay (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '10',
                'step' => '0.1',
                'default' => '0',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-vrskb-filler' => '-webkit-transition-delay: {{VALUE}}s;transition-delay: {{VALUE}}s;'],
            ]
        );
        $this->add_control(
            'bar_timing',
            [
                'label' => esc_html__('Animation Timing', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_transition_timing_type(),
                'default' => 'ease-in-out',
                'selectors' => ['{{WRAPPER}} .elb-vrskb-filler' => '-webkit-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'stripes_settings',
            [
                'label' => esc_html__('Stripes Settings', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'stripes_enabled',
            [
                'label' => esc_html__( 'Enable Stripes', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'stripes_move_enabled',
            [
                'label' => esc_html__( 'Move Stripes', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['stripes_enabled' => ['yes']],                
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $ctn_attr = $percent_output = $name_output = '';
        $layout_34 = ['style_3','style_4'];

        #Container Attributes
        $ctn_attr = ' data-situation="inactive" data-align="'.esc_attr($settings['align']).'" data-layout="'.esc_attr($settings['layout']).'" data-name-layout="'.esc_attr($settings['name_style']).'" data-stripes="'.esc_attr($settings['stripes_enabled']).'"  data-stripes-move="'.esc_attr($settings['stripes_move_enabled']).'" ';
        $ctn_attr .= (in_array($settings['layout'], $layout_34)) ? ' data-percent-position="'.esc_attr($settings['percent_position']).'" ' : '';
        
        #Skill Name Output 
        $name_output = '<div class="elb-vrskb-name"><span>'.wp_kses_post($settings['skill_name']).'</span></div>';
        #Percent Output 
        $percent_output = '<div class="elb-vrskb-vl elb-vrskb-filler"><div class="elb-vrskb-vl-in"><span>'.wp_kses_post($settings['skill_value']['size']).'%</span></div></div>';

        $ctn_attr .= ' style="--skill-value: '.$settings['skill_value']['size'].'%;" ';


        $output .= '<div class="elb-vrskb-ctn elb-vp-sit elb-skb-elem" '.$ctn_attr.'>';
            $output .= '<div class="elb-vrskb-inner">';
                $output .= '<div class="elb-vrskb-insider">';
                    $output .= ($settings['name_position'] == 'top') ? $name_output : ''; 
                    $output .= '<div class="elb-vrskb-bar-ctn">';
                        $output .= $percent_output; 
                        $output .= '<div class="elb-vrskb-bar elb-vrskb-filler elb-skb-elem-bar"></div>';
                    $output .= '</div>'; 
                    $output .= ($settings['name_position'] == 'bottom') ? $name_output : ''; 
                $output .= '</div>'; 
            $output .= '</div>'; 
    
        $output .= '</div>'; 

        echo apply_filters('elb_verticalskillbar_output', $output, $settings);
    }

}        