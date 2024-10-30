<?php

namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_AnimatedHeading_Widget extends Widget_Base {
	public function get_name() {
		return 'elb-animatedheading-widget';
	}
	public function get_title() {
		return esc_html__('Animated Heading', 'booster-addons' );
	}
	public function get_icon() {
		return 'elb-icon eicon-animated-headline';
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
		$this->start_controls_section(
        	'section_content',
        	[
        		'label' => esc_html__('Content', 'Element Booster'),
        	]
        );
        $this->add_control(
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading', 'booster-addons'),
                'label_block' => true,
                'default' => esc_html__('Your Heading', 'booster-addons'),
               
            ]
        );
        $this->add_control(
            'heading_align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
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
            'anim_type',
            [
                'label' => esc_html__('Animation Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'normal'    =>  esc_html__('Normal','booster-addons'), 
                    'reveal'  =>  esc_html__('Reveal','booster-addons'), 
                    'line-reveal'  =>  esc_html__('Line Reveal','booster-addons'), 
                ],
                'default' => 'reveal',
            ]
        );
        $this->add_control(
            'anim_direction',
            [
                'label' => esc_html__('Animation Direction', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => [
                     'anim_type' => [ 'normal', 'reveal'],
                 ],
                'options' => [
                    'left'    =>  esc_html__('Left','booster-addons'), 
                    'top'    =>  esc_html__('Top','booster-addons'), 
                    'right'    =>  esc_html__('Right','booster-addons'), 
                    'bottom'    =>  esc_html__('Bottom','booster-addons'), 
                ],
                'default' => 'left',
            ]
        );
        $this->add_control(
            'line_anim_direction',
            [
                'label' => esc_html__('Animation Direction', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['anim_type' => 'line-reveal'],
                'options' => [
                    'top'    =>  esc_html__('Top','booster-addons'), 
                    'bottom'    =>  esc_html__('Bottom','booster-addons'), 
                ],
                'default' => 'bottom',
            ]
        );
		$this->add_control(
            'anim_transition',
            [
                'label' => esc_html__('Duration (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '10',
                'step' => '0.1',
                'dynamic' => ['active' => true],
                'default' => '1',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-hd-ctn' => '-webkit-transition-duration: {{VALUE}}s !important;transition-duration: {{VALUE}}s !important; transition-property:transform;',   
                    '{{WRAPPER}} .elb-animh-heading' => '--trans-duration:{{VALUE}};',   
                    '{{WRAPPER}} .elb-animh-hd-ovl' => '-webkit-animation-duration: calc(({{VALUE}} * 0.9) * 1s) !important;animation-duration: calc(({{VALUE}} * 0.9) * 1s) !important;',
                    '{{WRAPPER}} .elb-animh-elm::before' => '-webkit-animation-duration: {{VALUE}}s !important;animation-duration: {{VALUE}}s !important;',
                    '{{WRAPPER}} .elb-animh-elm::after' => '-webkit-animation-duration: {{VALUE}}s !important;animation-duration: {{VALUE}}s !important;',   

                ],
            ]
        );
        $this->add_control(
            'anim_timing',
            [
                'label' => esc_html__('Animation Timing', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_transition_timing_type(),
                'dynamic' => ['active' => true],
                'default' => 'ease-in-out',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-hd-ctn' => '-webkit-transition-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .elb-animh-heading' => '-webkit-transition-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .elb-animh-hd-ovl' => '-webkit-transition-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .elb-animh-elm::before' => '-webkit-transition-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};',
                    '{{WRAPPER}} .elb-animh-elm::after' => '-webkit-transition-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'anim_delay',
            [
                'label' => esc_html__('Delay (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '10',
                'step' => '0.1',
                'dynamic' => ['active' => true],
                'default' => '0',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-heading' => '--trans-delay:{{VALUE}}s;',
                    '{{WRAPPER}} .elb-animh-animated' => '--trans-delay:{{VALUE}}s;',
                    '{{WRAPPER}} .elb-animh-hd-ovl' => '-webkit-animation-delay: {{VALUE}}s !important;animation-delay: {{VALUE}}s !important;',
                    '{{WRAPPER}} .elb-animh-elm::before' => '-webkit-animation-delay: {{VALUE}}s !important;animation-delay: {{VALUE}}s !important;',
                    '{{WRAPPER}} .elb-animh-elm::after' => '-webkit-animation-delay: {{VALUE}}s !important;animation-delay: {{VALUE}}s !important;',
                ],
            ]
        );

        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
		$this->start_controls_section(
            'styling_settings',
            [
                'label' => esc_html__('Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-animh-heading',
            ]
        );	
        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-heading' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'heading_paddings',
            [
                'label' => esc_html__( 'Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '12','top' => '5','right' => '12','bottom' => '5','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  
        $this->add_control(
            'color_scheme',
            [
                'label' => esc_html__('Background Color Scheme', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7c66e2',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-scheme' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'line_size',
            [
                'label' => esc_html__('Line Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 
                'condition' => ['anim_type' => 'line-reveal'],
                'dynamic' => ['active' => true],
                'default' => '5',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-elm::before' => 'border-width: {{VALUE}}px;',
                    '{{WRAPPER}} .elb-animh-elm::after' => 'border-width: {{VALUE}}px;',
                ],
            ]
        );
        $this->add_control(
            'line_color',
            [
                'label' => esc_html__('Line Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'red',
                'condition' => ['anim_type' => 'line-reveal'],
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-elm::before' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .elb-animh-elm::after' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'txt_btm_padding',
            [
                'label' => esc_html__('Text Bottom Padding', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 
                'condition' => ['anim_type' => 'line-reveal'],
                'dynamic' => ['active' => true],
                'default' => '10',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-ln-span' => 'padding-bottom: {{VALUE}}px;',
                ],
            ]
        ); 
        $this->add_control(
            'txt_top_padding',
            [
                'label' => esc_html__('Text Top Padding', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 
                'condition' => ['anim_type' => 'line-reveal'],
                'dynamic' => ['active' => true],
                'default' => '10',
                'selectors' => [
                    '{{WRAPPER}} .elb-animh-ln-span' => 'padding-top: {{VALUE}}px;',
                ],
            ]
        );

        $this->end_controls_section();
	}
        
    protected function render() {
    	$settings = $this->get_settings_for_display();
    	$output = '';
        $heading_text = wp_kses_post($settings['heading']);
        $anim_direction = esc_attr($settings['anim_direction']);
        if($settings['anim_type'] == 'line-reveal') {
            $letters = str_split($heading_text);
            $anim_delay = esc_attr($settings['anim_delay']);
            $anim_duration = esc_attr($settings['anim_transition']);
            $anim_direction = esc_attr($settings['line_anim_direction']);
            $i = $anim_delay + $anim_duration;
            $heading_text = '';
            foreach ($letters as $letter) {
                
                if($letter != ' ') {
                    $i += 0.05;
                    $animation_delay = ' style="-webkit-animation-delay:'.strval($i).'s;animation-delay:'.strval($i).'s;"';
                }else
                    $animation_delay = '';
                    
                $heading_text .= '<span class="elb-animh-ln-span"'.$animation_delay.'>'.$letter.'</span>';
            }

        }
    	$output .= '<div class="elb-animh-ctn elb-vp-sit" data-align="'.esc_attr($settings['heading_align']).'" data-direction="'.$anim_direction .'" data-style="'.esc_attr($settings['anim_type']).'" data-situation="inactive">';
    		$output .= '<div class="elb-animh-insider">';
	    		$output .= '<div class="elb-animh-hd-ctn elb-animh-animated elb-animh-scheme">';
    				$output .= '<div class="elb-animh-heading elb-animh-elm elb-animh-animated">'.$heading_text.'</div>';
    				if($settings['anim_type'] == 'reveal') $output .= '<div class="elb-animh-hd-ovl elb-animh-scheme"></div>';
    			$output .= '</div>';
    		$output .= '</div>';
    	$output .= '</div>';
        echo apply_filters('elb_animatedheading_output', $output, $settings);
    }

}