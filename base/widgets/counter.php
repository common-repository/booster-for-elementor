<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Counter_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-counter-widget';
    }
    public function get_title() {
        return esc_html__('Counter', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-counter';
    }
    public function get_categories() {
        return array('booster-addons');
    }
    public function get_script_depends() {
        return [
            'elb-inview',
            'elb-counter',
            
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
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading', 'booster-addons'),
                'label_block' => true,
                'default' => esc_html__('Counter Heading', 'booster-addons'),       
            ]
        );
        $this->add_control(
            'value',
            [
                'label' => esc_html__('Counter Value', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'label_block' => true,
                'default' => '45',
                'dynamic' => ['active' => true]
            ]
        );
        $this->add_control(
            'prefix',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Prefix', 'booster-addons'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'suffix',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Suffix', 'booster-addons'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'separator',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Counter Separator', 'booster-addons'),
                'label_block' => true,
                'default' => ',',
            ]
        );
        $this->add_control(
            'decimal',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Counter Decimal', 'booster-addons'),
                'label_block' => true,
                'default' => '.',
            ]
        );
        //Icon Content
        $this->add_control(
            'icon_content',
            [
                'label' => esc_html__('Icon Content', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'icon' => esc_html__('Icon', 'booster-addons'),
                    'image' => esc_html__('Image', 'booster-addons'),
                    'none' => esc_html__('None', 'booster-addons'),
                ],
                'default' => 'icon',
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['icon_type' => ['image']],
                'default' => ['url' => ''],
            ]
        );
        $this->add_control(
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'condition' => ['icon_type' => ['icon']],
                'label_block' => true               
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
            'element_layout',
            [
                'label' => esc_html__('Element Layout', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
            ]
        );
        $this->add_control(
            'container_align',
            [
                'label' => esc_html__('Container Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
            ]
        );
        $this->add_control(
            'animation_spped',
            [
                'label' => esc_html__('Animation Speed', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0,'max' => 30,'step' => 1,]
                ],
                'default' => ['unit' => 'px','size' => 3],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-scim-insider' => 'height: {{SIZE}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'repeat_animtion',
            [
                'label' => esc_html__('Reapeat Animation', 'booster-addons'),
                'description' => esc_html__('The counter animation will be repeated each time the element is in the viewport', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'yes' => esc_html__('Yes, Please!', 'booster-addons'),
                    'no' => esc_html__('No', 'booster-addons'),
                    
                ],                
                'default' => 'no',
            ]
        );
        $this->end_controls_section();   
        /********************************************
                    STYLING SECTION       
        ********************************************/
        //-----------------Button Global Styling----------------             
        $this->start_controls_section(
            'typography_section',
            [
                'label' => esc_html__('Typography', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Heading Typography
        $this->add_control(
            'Headingstyling_settings',
            [
                'label' => esc_html__('Heading Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Heading Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-counter-heading',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color',
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-heading',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow',
                'label' => esc_html__('Heading Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-heading',
            ]
        );
        $this->add_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-counter-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        //Value Typography
        $this->add_control(
            'Valuestyling_settings',
            [
                'label' => esc_html__('Value Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'value_font',
                'label' => esc_html__('Value Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 46,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-counter-value',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'value_color',
                'label' => esc_html__('Value Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-value',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],                

            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'value_shadow',
                'label' => esc_html__('Value Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-value',
            ]
        );
        $this->add_control(
            'value_margin',
            [
                'label' => esc_html__( 'Value Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-counter-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        //Prefix Typography
        $this->add_control(
            'Prefixstyling_settings',
            [
                'label' => esc_html__('Prefix Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'prefix_font',
                'label' => esc_html__('Prefix Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-counter-prefix',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'prefix_color',
                'label' => esc_html__('Prefix Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-prefix',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'prefix_shadow',
                'label' => esc_html__('Prefix Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-prefix',
            ]
        );
        $this->add_control(
            'prefix_pos',
            [
                'label' => esc_html__('Prefix Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],                
                'default' => 'middle'
            ]
        );
        $this->add_control(
            'prefix_margin',
            [
                'label' => esc_html__( 'Prefix Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-counter-prefix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 


        //Suffix Typography
        $this->add_control(
            'Suffixstyling_settings',
            [
                'label' => esc_html__('Suffix Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'suffix_font',
                'label' => esc_html__('Suffix Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-counter-suffix',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'suffix_color',
                'label' => esc_html__('Suffix Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-suffix',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'suffix_shadow',
                'label' => esc_html__('Suffix Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-counter-suffix',
            ]
        );
        $this->add_control(
            'suffix_pos',
            [
                'label' => esc_html__('Suffix Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,                
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],                
                'default' => 'middle'
            ]
        );
        $this->add_control(
            'suffix_margin',
            [
                'label' => esc_html__( 'Suffix Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-counter-suffix' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $this->end_controls_section();   

        //ICON AREA STYLING
        ELB_IconHover_Tab::init($this);
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $icon_output = '';
        $icon_output  = ELB_IconHover_Tab::render($settings);

        $output .= '<div class="elb-counter-ctn elb-btn-item elb-icon-hvctn" data-layout="'.esc_attr($settings['element_layout']).'" data-align="'.esc_attr($settings['container_align']).'" data-hover="'.esc_attr($settings['icon_effect']).'">';
            $output .= '<div class="elb-counter-insider">';
                $output .= ($icon_output != '') ? '<div class="elb-counter-ic-ctn">'.$icon_output.'</div>' : '';
                $output .= '<div class="elb-counter-ct-leftright">';
    
                    $output .= '<div class="elb-counter-title-ct">';
                        $output .= '<div class="elb-counter-title-pp">';
                            $output .= ($settings['prefix'] != '') ? '<div class="elb-prsf-elm elb-counter-prefix" data-position="'.esc_attr($settings['prefix_pos']).'">'.$settings['prefix'].'</div>' : '';
                            $output .= '<div class="elb-counter-value" data-repeat="'.esc_attr($settings['repeat_animtion']).'" data-end-val="'.esc_attr($settings['value']).'" data-separator="'.esc_attr($settings['separator']).'" data-decimal="'.esc_attr($settings['decimal']).'" data-duration="'.esc_attr($settings['animation_spped']['size']).'">0</div>';
                            $output .= ($settings['suffix'] != '') ? '<div class="elb-prsf-elm elb-counter-suffix" data-position="'.esc_attr($settings['suffix_pos']).'">'.$settings['suffix'].'</div>' : '';
                        $output .= '</div>';    
                        $output .= '<div class="elb-counter-heading">'.$settings['heading'].' </div>';
                    $output .= '</div>';    
    
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';

        echo apply_filters('elb_counter_output', $output, $settings);
    }

}        