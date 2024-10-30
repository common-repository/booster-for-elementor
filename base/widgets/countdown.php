<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_CountDown_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-countdown-widget';
    }
    public function get_title() {
        return esc_html__('Countdown', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-countdown';
    }
    public function get_categories() {
        return array('booster-addons');
    }
    public function get_script_depends() {
        return [
            'elb-countdown'
        ];
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        $this->start_controls_section(
            'section_general',
            [
                'label' => esc_html__('General', 'booster-addons'),
            ]
        );
        $this->add_control(
            'date',
            [
                'label' => esc_html__('Choose a Date', 'booster-addons'),
                'type' => Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'minDate' => current_time("Y-m-d H:i:s"),
                    'defaultDate' => date( 'Y-m-d H:i:s ', strtotime(current_time("Y-m-d H:i:s")) + 3600 ),

                ],
                
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style1' => esc_html__('Style 1', 'booster-addons'),
                    'style2' => esc_html__('Style 2', 'booster-addons'),
                    'style3' => esc_html__('Style 3', 'booster-addons'),
                ],
                'default' => 'style1',
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center'
            ]
        );
        $this->end_controls_section();
        #Dates
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );
        $names = ['year','month','week','day','hour','minute','second','millisecond'];
        $default_enabled = ['day','hour','minute','second'];
        foreach ($names as $name):
            $enabled = (in_array($name,$default_enabled)) ? 'yes' : 'no';
            $this->add_control(
                $name.'_enabled',
                [
                    'label' => esc_html__( 'Enable ', 'booster-addons'). ucfirst($name),
                    'type' => Controls_Manager::SWITCHER,
                    'separator' => 'before',
                    'default' => $enabled,
                    'frontend_available' => true
                ]
            );
            $this->add_control(
                $name.'_singular',
                [
                    'type' => Controls_Manager::TEXT,
                    'label' => ucfirst($name). esc_html__(' Singular', 'booster-addons'),
                    'dynamic' => ['active' => true],
                    'condition' => [$name.'_enabled' => ['yes']],
                    'label_block' => true,
                    'default' => ucfirst($name),
                ]
            );
            $this->add_control(
                $name.'_plural',
                [
                    'type' => Controls_Manager::TEXT,
                    'label' => ucfirst($name). esc_html__(' Plural', 'booster-addons'),
                    'dynamic' => ['active' => true],
                    'condition' => [$name.'_enabled' => ['yes']],
                    'label_block' => true,
                    'default' => ucfirst($name).'s',
                ]
            );
        endforeach;
        $this->end_controls_section();
        /********************************************
                    STYLE SECTION       
        ********************************************/
        //Element Styling
        $this->start_controls_section(
            'elem_styling',
            [
                'label' => esc_html__('Element Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );   
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'elem_bg',
                'label' => esc_html__( 'Element Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-countdown-elem',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'elem_br',
                'label' => esc_html__( 'Element Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-countdown-elem',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'elem_bxs',
                'label' => esc_html__('Element Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-elem',
            ]
        );
        $this->add_control(
            'elem_radius',
            [
                'label' => esc_html__( 'Element Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                
                'selectors' => ['{{WRAPPER}} .elb-countdown-elem' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'elem_margin',
            [
                'label' => esc_html__( 'Element Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-countdown-elem' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'elem_padding',
            [
                'label' => esc_html__( 'Element Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-percard-ctn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();
        //Digit Styling
        $this->start_controls_section(
            'digit_styling',
            [
                'label' => esc_html__('Digit Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'digit_font',
                'label' => esc_html__('Digit Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 26,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '800'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-countdown-digit',
            ]
        );
       
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'digit_color',
                'label' => esc_html__('Digit Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-digit span',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'digit_shadow',
                'label' => esc_html__('Digit Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-digit span',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'digit_bg',
                'label' => esc_html__( 'Digit Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-countdown-digit',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'digit_br',
                'label' => esc_html__( 'Digit Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-countdown-digit',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'digit_bxs',
                'label' => esc_html__('Digit Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-digit',
            ]
        );
        $this->add_control(
            'digit_radius',
            [
                'label' => esc_html__( 'Digit Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-countdown-digit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'digit_margin',
            [
                'label' => esc_html__( 'Digit Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-countdown-digit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'digit_padding',
            [
                'label' => esc_html__( 'Digit Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-countdown-digit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        
        $this->end_controls_section();


        //Unit Styling
        $this->start_controls_section(
            'unit_styling',
            [
                'label' => esc_html__('Unit Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'unit_font',
                'label' => esc_html__('Unit Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-countdown-unit',
            ]
        );      
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'unit_color',
                'label' => esc_html__('Unit Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-unit span',
            ]
        );
         $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'unit_shadow',
                'label' => esc_html__('Unit Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-unit span',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'unit_bg',
                'label' => esc_html__( 'Unit Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-countdown-unit',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'unit_br',
                'label' => esc_html__( 'Unit Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-countdown-unit',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'unit_bxs',
                'label' => esc_html__('Unit Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-countdown-unit',
            ]
        );
        $this->add_control(
            'unit_radius',
            [
                'label' => esc_html__( 'Unit Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                
                'selectors' => ['{{WRAPPER}} .elb-countdown-unit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'unit_margin',
            [
                'label' => esc_html__( 'Unit Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-countdown-unit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'unit_padding',
            [
                'label' => esc_html__( 'Unit Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-countdown-unit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();


        
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $elems_output = $ctn_attr = $date_settings = '';
        $count_elements = [];
        $names = ['year','month','week','day','hour','minute','second','millisecond'];
        foreach ($names as $name):
            if ($settings[$name.'_enabled'] == 'yes'):
                array_push($count_elements, $name.'s');
                $d_output = '<div class="elb-countdown-digit"><span></span></div>';
                $u_output = '<div class="elb-countdown-unit"><span></span></div>';
                $elems_output .= '<div class="elb-countdown-elem" data-type="'.$name.'s'.'" data-plural="'.esc_attr($settings[$name.'_plural']).'" data-singular="'.esc_attr($settings[$name.'_singular']).'">';
                    $elems_output .= ($settings['layout'] == 'style2') ? $u_output . $d_output : $d_output . $u_output;
                $elems_output .= '</div>';
            endif;                               
        endforeach;
        $count_elements = strtoupper(implode (",", $count_elements));

        #Container Attributes
        if($settings['date'] == '')
            $date_settings = date('Y-m-d H:i', strtotime(current_time("Y-m-d H:i")) + 3600);
        else
            $date_settings = $settings['date'];
        $date = \DateTime::createFromFormat('Y-m-d H:i', $date_settings);
        $ctd_deadline = $date->format('Y-m-d h:i a');
        $ctn_attr = ' data-countdown="'.esc_attr($count_elements).'" data-layout="'.esc_attr($settings['layout']).'" data-align="'.esc_attr($settings['align']).'" data-deadline="'.esc_attr($ctd_deadline).'" ';

        $output .= '<div class="elb-countdown-ctn" '.$ctn_attr.'>';
            $output .= $elems_output;
        $output .= '</div>';

        echo apply_filters('elb_countdown_output', $output, $settings);
    }

}