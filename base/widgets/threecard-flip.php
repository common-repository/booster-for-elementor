<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ThreeCardFlip_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-threecardflip-widget';
    }
    public function get_title() {
        return esc_html__('3D Card Flip', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-flip-box';
    }
    public function get_categories() {
        return array('booster-addons');
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        //Front Content
        $this->start_controls_section(
            'section_front',
            [
                'label' => esc_html__('Front Area Content', 'booster-addons'),
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
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'condition' => ['icon_type' => ['icon']],
                'default' => 'stack',
                'label_block' => true               
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['icon_type' => ['image']],
                'default' => [
                    'url' => '',
                ],
            ]
        );
        $this->add_control(
            'title_front',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Front Title', 'booster-addons'),
                'label_block' => true,
                'default' => 'Premium Features',
               
            ]
        );
        $this->add_control(
            'subheading_front',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Front Sub Heading', 'booster-addons'),
                'label_block' => true,
                'default' => 'Created and crafted with love, the most advanced Elementor addons bundle plugin.',                           
            ]
        );
        $this->end_controls_section();

        //Back Content
        $this->start_controls_section(
            'section_back',
            [
                'label' => esc_html__('Back Area Content', 'booster-addons'),
            ]
        );
        $this->add_control(
            'title_back',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Back Title', 'booster-addons'),
                'label_block' => true,
                'default' => 'Premium Features',
               
            ]
        );
        $this->add_control(
            'content_back',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Back Content', 'booster-addons'),
                'default' => 'Created and crafted with love, the most advanced Elementor addons bundle plugin.',
                'label_block' => true               
            ]
        );
        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Settings', 'booster-addons'),
            ]
        );
        $this->add_control(
            'flip_to',
            [
                'label' => esc_html__('Flip To', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'toleft' => esc_html__('Left', 'booster-addons'),
                    'toright' => esc_html__('Right', 'booster-addons'),
                    #'totop' => esc_html__('Top', 'booster-addons'),
                    #'tobottom' => esc_html__('Bottom', 'booster-addons'),
                ],
                'default' => 'toleft',
            ]
        );
        $this->add_control(
            'smooth_enabled',
            [
                'label' => esc_html__( 'Enable Smooth Effect', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        );
        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
        //-----------------Container Styling Sub Content----------------             
        $this->start_controls_section(
            'section_container_styling',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'ctn_min_height',
            [
                'label' => esc_html__('Container Min Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '100', 'max' => '900',
                'default' => '300',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-cflp-ctn' => 'min-height: {{VALUE}}px;',],
            ]
        );
        $this->add_control(
            'ctn_radius',
            [
                'label' => esc_html__( 'Container Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-cflp-ctn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->end_controls_section();

        //-----------------Front Styling Sub Content----------------      
        $iconDefaults = [
            'icon_size' => '45',
        ];
        ELB_IconHover_Tab::init($this,false,$iconDefaults);           
        $this->start_controls_section(
            'section_front_styling',
            [
                'label' => esc_html__('Front Area Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'frontposition_settings',
            [
                'label' => esc_html__('Content Aligment', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'front_vrt_pos',
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
            'front_hrz_pos',
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
            'titlestyling_settings',
            [
                'label' => esc_html__('Title Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_front_font',
                'label' => esc_html__('Title Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-cflp-front-title',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_front_color',
                'label' => esc_html__('Title Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-cflp-front-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_front_shadow',
                'label' => esc_html__('Title Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-cflp-front-title',
            ]
        );
        $this->add_control(
            'title_front_margin',
            [
                'label' => esc_html__( 'Title Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-cflp-front-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $this->add_control(
            'subheadingstyling_settings',
            [
                'label' => esc_html__('Sub Heading Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'subheading_front_color',
            [
                'label' => esc_html__('Sub Heading Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-cflp-front-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_front_font',
                'label' => esc_html__('Sub heading Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-cflp-front-subtitle',
            ]
        );
        $this->add_control(
            'subheading_front_margin',
            [
                'label' => esc_html__( 'Sub heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-cflp-front-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        
        $this->end_controls_section();

        //-----------------Back Styling Sub Content----------------   
        $this->start_controls_section(
            'section_back_styling',
            [
                'label' => esc_html__('Back Area Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'backposition_settings',
            [
                'label' => esc_html__('Content Aligment', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'back_vrt_pos',
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
            'back_hrz_pos',
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
            'titlestylingback_settings',
            [
                'label' => esc_html__('Title Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_back_font',
                'label' => esc_html__('Title Typography', 'booster-addons'), 
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],                  
                'selector' => '{{WRAPPER}} .elb-cflp-back-title',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_back_color',
                'label' => esc_html__('Title Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
                'selector' => '{{WRAPPER}} .elb-cflp-back-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_back_shadow',
                'label' => esc_html__('Title Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-cflp-back-title',
            ]
        );
        $this->add_control(
            'title_back_margin',
            [
                'label' => esc_html__( 'Title Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-cflp-back-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $this->add_control(
            'contentstyling_settings',
            [
                'label' => esc_html__('Content Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'content_back_color',
            [
                'label' => esc_html__('Content Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fafafa',
                'selectors' => [
                    '{{WRAPPER}} .elb-cflp-back-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_back_font',
                'label' => esc_html__('Content Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-cflp-back-subtitle',
            ]
        );
        $this->add_control(
            'content_back_margin',
            [
                'label' => esc_html__( 'Content Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-cflp-back-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $this->end_controls_section();


        //-----------------Front Background Sub Content----------------             
        $this->start_controls_section(
            'section_front_background',
            [
                'label' => esc_html__('Front Backgrounds', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_bg',
                'label' => esc_html__( 'Front Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => [
                    'background' => ['default' => 'classic'],
                    'color' => ['default' => '#fafafa']
                ],
                'selector' => '{{WRAPPER}} .elb-cflp-front',
            ]
        );
        $this->add_control(
            'front_ovl_enabled',
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
                'name' => 'front_ovl',
                'label' => esc_html__( 'Front Background Overlay', 'booster-addons' ),
                'description' => esc_html__( 'Better if you apply a background image.', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['front_ovl_enabled' => ['yes']],                
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'rgba(0,0,0,0.7)'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-cflp-front:before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_br',
                'label' => esc_html__( 'Front Border', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-cflp-front',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_bxs',
                'label' => esc_html__('Front Box Shadow', 'booster-addons'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-cflp-front',
            ]
        );
        $this->add_control(
            'ctn_paddings_front',
            [
                'label' => esc_html__( 'Container Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'default' => ['left' => '60','top' => '30','right' => '60','bottom' => '30','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-cflp-front.elb-cflp-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();


        //-----------------back Background Sub Content----------------             
        $this->start_controls_section(
            'section_back_background',
            [
                'label' => esc_html__('Back Backgrounds', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_bg',
                'label' => esc_html__( 'Back Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => [
                    'background' => ['default' => 'classic'],
                    'color' => ['default' => '#7d66e2']
                ],
                'selector' => '{{WRAPPER}} .elb-cflp-back',
            ]
        );
         $this->add_control(
            'back_ovl_enabled',
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
                'name' => 'back_ovl',
                'label' => esc_html__( 'Back Background Overlay', 'booster-addons' ),
                'description' => esc_html__( 'Better if you apply a background image.', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'condition' => ['back_ovl_enabled' => ['yes']],                
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'rgba(0,0,0,0.7)'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-cflp-back:before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_br',
                'label' => esc_html__( 'Back Border', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-cflp-back',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_bxs',
                'label' => esc_html__('Back Box Shadow', 'booster-addons'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-cflp-back',
            ]
        );
        $this->add_control(
            'ctn_paddings_back',
            [
                'label' => esc_html__( 'Container Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'default' => ['left' => '60','top' => '30','right' => '60','bottom' => '30','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-cflp-back.elb-cflp-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();


        


    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $ctn_attr = '';
        $ctn_attr = ' data-front-hrz="'.esc_attr($settings['front_hrz_pos']).'" data-front-vrt="'.esc_attr($settings['front_vrt_pos']).'" data-back-hrz="'.esc_attr($settings['back_hrz_pos']).'" data-back-vrt="'.esc_attr($settings['back_vrt_pos']).'" data-layout="'.esc_attr($settings['flip_to']).'" data-smootheffect="'.esc_attr($settings['smooth_enabled']).'"';

        $output .= '<div class="elb-cflp-ctn elb-3cflp-ctn elb-flip-ctn" '.$ctn_attr.'>
                        <div class="elb-cflp-card">';
        
        //Begin Front Area                                            
            $output .= '<div class="elb-cflp-front elb-cflp-figure">
                            <div class="elb-cflp-insider elb-flip-insider">';
                            //Front Icon Area                
                            $output .= ELB_IconHover_Tab::render($settings);
                            $output .= ($settings['title_front'] != '') ? '<div class="elb-cflp-front-title">'.wp_kses_post($settings['title_front']).'</div>' : '';    
                            $output .= ($settings['subheading_front'] != '') ? '<div class="elb-cflp-front-subtitle">'.wp_kses_post($settings['subheading_front']).'</div>' : '';                    
            $output .= '</div>
                    </div>';                        
        //End Front Area         

        //Begin Back Area     
            $output .= '<div class="elb-cflp-back elb-cflp-figure">
                            <div class="elb-cflp-insider elb-flip-insider">';
                    
                    $output .= ($settings['title_back'] != '') ? '<div class="elb-cflp-back-title">'.wp_kses_post($settings['title_back']).'</div>' : '';    
                    $output .= ($settings['content_back'] != '') ? '<div class="elb-cflp-back-subtitle">'.wp_kses_post($settings['content_back']).'</div>' : ''; 

            $output .= '</div>
                    </div>';  
        //End Back Area                                            

       $output .= '    </div>';
        $output .= (!empty($settings['link'])) ? elb_render_elementor_link($settings['link'], '', true) : '';
        $output .= ' </div>';


        echo apply_filters('elb_threecardflip_output', $output, $settings);
    }

}