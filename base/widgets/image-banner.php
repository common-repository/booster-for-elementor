<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ImageBanner_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-imagebanner-widget';
    }
    public function get_title() {
        return esc_html__('Image Banner', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-image-rollover';
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
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Banner Heading', 'booster-addons'),
                'label_block' => true,
                'default' => 'Booster Addons',
               
            ]
        ); 
        $this->add_control(
            'short_text',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Short text ', 'booster-addons'),
                'label_block' => true,
                'default' => 'Premium Elementor Addons<br/> Modern & Unique Designs.',

            ]
        );       
        $this->add_control(
            'vrt_pos',
            [
                'label' => esc_html__('Vertical Alignement', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],
                'default' => 'middle',
            ]
        );
        $this->add_control(
            'hrz_pos',
            [
                'label' => esc_html__('Horizontal Alignement', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],
                'default' => 'left',
            ]
        );
        $this->end_controls_section();

        //Image Banner
        $this->start_controls_section(
            'banner_settings_content',
            [
                'label' => esc_html__('Image Banner', 'booster-addons'),
            ]
        );    
        $this->add_control(
            'banner_hover_style',
            [
                'label' => esc_html__('Banner Hover Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'none' => esc_html__( 'None','booster-addons'),
                    'scale' => esc_html__( 'Scale','booster-addons'),
                    'scalerotateleft' => esc_html__( 'Scale Rotate Left','booster-addons'),
                    'scalerotateright' => esc_html__( 'Scale Rotate Right','booster-addons'),
                    'moveleft' => esc_html__( 'Move Left','booster-addons'),
                    'moveright' => esc_html__( 'Move Right','booster-addons'),
                ],
                'default' => 'scale',
            ]
        );
        $this->add_control(
            'banner_min_height',
            [
                'label' => esc_html__('Banner Min Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '100', 'max' => '900',
                'default' => '300',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-imban-ctn' => 'min-height: {{VALUE}}px;',],
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_banner',
                'label' => esc_html__( 'Image Banner', 'booster-addons' ),
                'types' => [ 'classic'],
                'fields_options' => ['background' => ['default' => 'classic'],'image' =>['default' =>['url' => BOOSTER_ADDONS_URL_IMAGES.'img2.jpg']], 'position' => ['default' =>'center center'],'size' =>['default' =>'cover'], 'color' => ['default' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-imban-ctn:before',
            ]
        );

        $this->add_control(
            'ovl_enabled',
            [
                'label' => esc_html__( 'Enable Overlay', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'separator' => 'before',
                'frontend_available' => true
            ]
        );
        
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ovl',
                'label' => esc_html__( 'Background Overlay', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['ovl_enabled' => ['yes']],                
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'rgba(0,0,0,0.7)'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-imban-ctn:after',
            ]
        );
        $this->add_control(
            'ctn_paddings',
            [
                'label' => esc_html__( 'Container Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'default' => ['left' => '20','top' => '20','right' => '20','bottom' => '20','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-imban-ctn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
        $this->start_controls_section(
            'section_content_styling',
            [
                'label' => esc_html__('Content Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_settings',
            [
                'label' => esc_html__('Heading Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Heading Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 25,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-imban-title',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color',
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-imban-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow',
                'label' => esc_html__('Heading Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-imban-title',
            ]
        );        

        $this->add_control(
            'shorttext_styling_settings',
            [
                'label' => esc_html__('Short Text Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'short_text_color',
            [
                'label' => esc_html__('Short Text Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-imban-info' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_font',
                'label' => esc_html__('Short Text Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-imban-info',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 15,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.4,'unit' => 'em']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],    
            ]
        );        
        $this->end_controls_section();

        //-----------------BUTTON SETTINGS
        $buttonDefaults = [
            'btn_txt' => 'Purchase Now',
            'btn_width' => '120',
            'btn_height'    => '40',
            'btn_txt_font' => ['font_size' => ['default' =>['size' => 13,'unit' => 'px']],'font_weight' => ['default' => '700'],'typography' => ['default' => 'custom']],
        ];
        ELB_Button_Tab::init($this,'included',$buttonDefaults);

        $this->start_controls_section(
            'section_content_distance',
            [
                'label' => esc_html__('Content Distance', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
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
                'selectors' => ['{{WRAPPER}} .elb-imban-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'short_text_margin',
            [
                'label' => esc_html__( 'Short Text Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '5','right' => '0','bottom' => '15','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-imban-info' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__( 'Button Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-btn-ctn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();
   }
   
    protected function render() {
        $settings = $this->get_settings_for_display();  
        $output = '<div class="elb-imban-ctn"  data-hover-style="'.esc_attr($settings['banner_hover_style']).'" data-hrz-pos="'.esc_attr($settings['hrz_pos']).'" data-vrt-pos="'.esc_attr($settings['vrt_pos']).'">';
            $output .= '<div class="elb-imban-insider">'; 
                $output .=  ($settings['heading'] != '') ? '<div class="elb-imban-title">'.wp_kses_post($settings['heading']).'</div>' : '';
                $output .=  ($settings['short_text'] != '') ? '<div class="elb-imban-info">'.wp_kses_post($settings['short_text']).'</div>' : '';
                if($settings['btn_enabled'] == 'yes'):
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
                    $output .= elb_render_button($settings,$icon_colors,'included',$settings['hrz_pos']);
                endif;
            $output .= '</div>';
        $output .= '</div>';


        echo apply_filters('elb_imagebanner_output', $output, $settings);

    }

}                 