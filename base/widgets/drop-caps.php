<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_DropCaps_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-dropcaps-widget';
    }
    public function get_title() {
        return esc_html__('Drop Caps', 'booster-addons' );
    }
    public function get_icon() {
        return 'elb-icon eicon-editor-bold';
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
            'letter',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Drop Cap', 'booster-addons'),
                'label_block' => true,
                'default' => 'A',               
            ]
        );
        $this->add_control(
            'text',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => esc_html__('Your text', 'booster-addons'),
                'label_block' => true,
                'default' => 'Wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. and feel the charm of existence in this spot.  he found himself transformed in his bed into a horrible divided by arches into  vermin.',
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Letter Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'selectors' => ['{{WRAPPER}} .elb-drpcp-letter' => 'float: {{align}};'],
                'default' => 'left'
            ]
        );
        $this->end_controls_section();
        
        /********************************************
                    STYLE SECTION       
        ********************************************/

        //-----------------Title Styling Sub Content----------------             
        $this->start_controls_section(
            'section_typography_styling',
            [
                'label' => esc_html__('Typography', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'letter_font',
                'label' => esc_html__('Letter Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 30,'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-drpcp-letter',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_font',
                'label' => esc_html__('Text Font', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.7,'unit' => 'em']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-drpcp-text',
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-drpcp-text' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_styling',
            [
                'label' => esc_html__('Letter Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'letter_width',
            [
                'label' => esc_html__('Letter Background Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '200',
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-drpcp-letter' => 'width: {{SIZE}}px;'],
                'dynamic' => ['active' => true]
            ]
        );
        $this->add_control(
            'letter_height',
            [
                'label' => esc_html__('Letter Background Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '200',
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-drpcp-letter' => 'height: {{SIZE}}px;'],
                'dynamic' => ['active' => true]
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'letter_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-drpcp-letter span',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'letter_shadow',
                'label' => esc_html__('Letter Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-drpcp-letter span',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'letter_bg',
                'label' => esc_html__( 'Letter Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-drpcp-letter',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'letter_br',
                'label' => esc_html__( 'Letter Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-drpcp-letter',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'letter_bxs',
                'label' => esc_html__('Letter Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-drpcp-letter',
            ]
        );
        $this->add_control(
            'letter_radius',
            [
                'label' => esc_html__( 'Letter Background Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => [
                    '{{WRAPPER}} .elb-drpcp-letter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'letter_margin',
            [
                'label' => esc_html__( 'Letter Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '1','right' => '7','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-drpcp-letter' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();
        
    }
   
    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = '';
        $output .= '<div class="elb-drpcp-ctn">';
            $output .= '<div class="elb-drpcp-letter"><span>'.wp_kses_post($settings['letter']).'</span></div>';
            $output .= '<div class="elb-drpcp-text">'.$settings['text'].'</div>';
        $output .= '</div>';

        echo apply_filters('elb_dropcaps_output', $output, $settings);
    }

}        