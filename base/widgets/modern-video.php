<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ModernVideo_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-modernvideo-widget';
    }
    public function get_title() {
        return esc_html__('Modern Video', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-play';
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
            'video_link',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Video Link', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => 'https://www.youtube.com/watch?v=43dpMXL29xY',
                'description' => esc_html__('Enter the video link from website like YouTube, Vimeo or Metacafe...', 'booster-addons'),               
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Layout Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'simple'    =>  esc_html__('Simple','booster-addons'), 
                    'modern'  =>  esc_html__('Modern','booster-addons'), 
                ],
                'default' => 'modern',
            ]
        );
        $this->add_control(
            'videothumbnail_settings',
            [
                'label' => esc_html__('Video Thumbnail', 'booster-addons'),
                'condition' => ['layout' => ['modern']],  
                'type' => Controls_Manager::HEADING,
            ]
        );
       $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'image_thumbnail',
                'label' => esc_html__( 'Thumbnail Image', 'booster-addons' ),
                'types' => [ 'classic'],
                'condition' => ['layout' => ['modern']],  
                'fields_options' => ['background' => [],'color' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-mdrv-thumbnail',
            ]
        );

        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
        $this->start_controls_section(
            'ctn_settings',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-mdrv-video',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-mdrv-video',
            ]
        );
        //Only if Modern 
        $this->add_control(
            'ovrl_settings',
            [
                'label' => esc_html__('Overlay Background', 'booster-addons'),
                'separator' => 'before',
                'condition' => ['layout' => ['modern']],                
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ov_bg',
                'label' => esc_html__( 'Overlay Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'rgba(0,0,0,0.6)'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'condition' => ['layout' => ['modern']],                
                'selector' => '{{WRAPPER}} .elb-mdrv-thumbnail:before',
            ]
        );
        $this->end_controls_section();

        //Play Button Styling
        $this->start_controls_section(
            'btn_settings',
            [
                'label' => esc_html__('Play Button Styling', 'booster-addons'),
                'condition' => ['layout' => ['modern']],                
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'btn_hrz_pos',
            [
                'label' => esc_html__('Button Horizontal Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'condition' => ['layout' => ['modern']],                
                'options' => [ 
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],
                'default' => 'center'
            ]
        );
        $this->add_control(
            'btn_vrt_pos',
            [
                'label' => esc_html__('Button Vertical Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'condition' => ['layout' => ['modern']],                
                'options' => [
                    'flex-start' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'center' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'flex-end' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],
                'default' => 'center',
                'selectors' => ['{{WRAPPER}} .elb-mdrv-thumbnail' => 'align-items: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'btn_size',
            [
                'label' => esc_html__('Button Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 
                'condition' => ['layout' => ['modern']],                
                'dynamic' => ['active' => true],
                'default' => '75',
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'width: {{VALUE}}px; height: {{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'btn_icon_size',
            [
                'label' => esc_html__('Play Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 
                'condition' => ['layout' => ['modern']],                
                'dynamic' => ['active' => true],
                'default' => '30'
            ]
        );
        $this->add_control(
            'btn_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'separator' => 'after',
                'condition' => ['layout' => ['modern']],                
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        

        $this->start_controls_tabs( 'btn_settings_tabs' );
        //Normal Button
        $this->start_controls_tab( 'normal_btn',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
                'condition' => ['layout' => ['modern']],                
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'btn_icon_color',
                'condition' => ['layout' => ['modern']],                
                'dynamic' => ['active' => true],
                'label' => esc_html__('Icon Color', 'booster-addons')
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg',
                'label' => esc_html__( 'Button Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#fff'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'condition' => ['layout' => ['modern']],                
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'condition' => ['layout' => ['modern']],                
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'condition' => ['layout' => ['modern']],                
                'selector' => '{{WRAPPER}} .elb-btn-bg-r',
            ]
        );
        $this->add_control(
            'btn_radius',
            [
                'label' => esc_html__( 'Button Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  

        $this->end_controls_tab();
        //Hover Button
        $this->start_controls_tab( 'hover_btn',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
                'condition' => ['layout' => ['modern']],                
            ]
        );
        $this->add_control(
            'btn_hover_effect',
            [
                'label' => esc_html__('Button Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_button_hover_effects(),
                'condition' => ['layout' => ['modern']],                
                'default' => 'scaleup',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'btn_icon_color_hv',
                'condition' => ['layout' => ['modern'],'btn_hover_effect!' => ['none']],                
                'dynamic' => ['active' => true],
                'fields_options' => ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
                'label' => esc_html__('Icon Color', 'booster-addons')
            ]
        ); 
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_hv',
                'label' => esc_html__( 'Button Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => '#7d66e2'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'condition' => ['layout' => ['modern'],'btn_hover_effect!' => ['none']],                              
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'btn_br_hv',
                'label' => esc_html__( 'Button Border', 'booster-addons' ),
                'condition' => ['layout' => ['modern'],'btn_hover_effect!' => ['none']],                           
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'btn_bxs_hv',
                'label' => esc_html__('Button Box Shadow', 'booster-addons'),
                'condition' => ['layout' => ['modern'],'btn_hover_effect!' => ['none']],                                
                'selector' => '{{WRAPPER}} .elb-btn-bg-h',
            ]
        );
        $this->add_control(
            'btn_radius_hv',
            [
                'label' => esc_html__( 'Button Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-btn-insider:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();  
        global $wp_embed;
        $output = ''; 
        $output .= '<div class="elb-mdrv-boss">';
            $output .= '<div class="elb-mdrv-ctn elb-video-el-ctn">';
                if(is_object($wp_embed)):
                    $output .= '<div class="elb-mdrv-video elb-video-if-ctn">'.$wp_embed->run_shortcode('[embed]'.$settings['video_link'].'[/embed]').'</div>';
                endif;
                if($settings['layout'] == 'modern'):
                    $settings['btn_layout'] = 'justicon';
                    $settings['btn_icon'] = 'play_arrow';
                    $settings['btn_txt_align'] = 'center';
                    $settings['btn_icon_align'] = 'center';
                    $settings['btn_txt'] = '';
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
                    $output .= '<div class="elb-mdrv-thumbnail elb-tr-4 elb-video-thumbnail" data-btn-hrz="'.esc_attr($settings['btn_hrz_pos']).'" data-btn-vrt="'.esc_attr($settings['btn_vrt_pos']).'">'.elb_render_button($settings,$icon_colors,'included',$settings['btn_hrz_pos'], ' onclick="elb_play_video(this)" ').'</div>';
                endif;   
            $output .= '</div>'; 
        $output .= '</div>'; 
        
        echo apply_filters('elb_modernvideo_output', $output, $settings);
    }
}                 