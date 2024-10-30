<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ModernImage_Tab{

    public static function init($widget){
        //Settings
        $widget->start_controls_section(
            'mdrn_section_settings',
            [
                'label' => esc_html__('Modern Image Settings', 'booster-addons'),
            ]
        );
        $widget->add_control(
            'vrt_pos',
            [
                'label' => esc_html__('Vertical Aligment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'separator' => 'before',               
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],
                'default' => 'middle',
            ]
        );
        $widget->add_control(
            'hrz_pos',
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
        $widget->add_control(
            'style',
            [
                'label' => esc_html__('Hover Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_modern_images_styles(),
                'default' => 'mercury',
            ]
        );
        /*
        $widget->add_control(
            'image_size',
            [
                'label' => esc_html__('Image Custom Size', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_custom_images_sizes(),
                'default' => 'full',
            ]
        );
        */
        $widget->add_control(
            'show_content_effect',
            [
                'label' => esc_html__('Show Content Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_custom_images_show_effect(),
                'default' => 'fade',
            ]
        );
        $widget->add_control(
            'show_ovl_effect',
            [
                'label' => esc_html__('Show Overlay Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_custom_images_show_ovl_effect(),
                'default' => 'fade',
            ]
        );
        $widget->add_control(
            'frame_enabled',
            [
                'label' => esc_html__('Enable Frame', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'enabled',
            ]
        );
        $widget->end_controls_section();
        $widget->start_controls_section(
            'tilt_styling',
            [
                'label' => esc_html__('Tilt Hover', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $widget->add_control(
            '3d_enabled',
            [
                'label' => esc_html__('Enable 3D Hover', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'separator' => 'before',
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'enabled',
            ]
        );
        $widget->add_control(
            'max_tilt',
            [
                'label' => esc_html__('Movement Sensitivity', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '20', 
                'condition' => ['3d_enabled' => 'enabled'],
                'dynamic' => ['active' => true],
                'default' => '20'
            ]
        );
        $widget->add_control(
            'scale_tilt',
            [
                'label' => esc_html__('Scale Sensitivity', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '.7', 'max' => '2.5',  'step' => '.1',
                'condition' => ['3d_enabled' => 'enabled'],
                'dynamic' => ['active' => true],
                'default' => '1.05'
            ]
        );        
        $widget->add_control(
            'glare_tilt_enabled',
            [
                'label' => esc_html__('Enable Glare', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['3d_enabled' => 'enabled'],
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'disabled',
            ]
        );
        $widget->add_control(
            'glare_tilt_value',
            [
                'label' => esc_html__('Glare Value', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '.1', 'max' => '1',  'step' => '.1',
                'condition' => ['3d_enabled' => 'enabled','glare_tilt_enabled' => 'enabled'],
                'dynamic' => ['active' => true],
                'default' => '.5'
            ]
        );
        $widget->add_control(
            'reset_tilt_enabled',
            [
                'label' => esc_html__('Enable Reset', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['3d_enabled' => 'enabled'],
                'options' => [
                    'enabled' => esc_html__('Yes, Please', 'booster-addons'),
                    'disabled' => esc_html__('No', 'booster-addons'),
                ],
                'default' => 'enabled',
            ]
        );
        $widget->end_controls_section();
        /********************************************
                    STYLE SECTION       
        ********************************************/
        //Typography
        $widget->start_controls_section(
            'mdrn_section_typography',
            [
                'label' => esc_html__('Modern Image Typography', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $widget->add_control(
            'heading_styling',
            [
                'label' => esc_html__('Heading Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 20,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-lportf-title',
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
                'selector' => '{{WRAPPER}} .elb-lportf-title',
            ]
        );
        $widget->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'heading_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-lportf-title',
            ]
        );
        $widget->add_control(
            'subheading_styling',
            [
                'label' => esc_html__('Sub Heading Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-lportf-info',
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'subheading_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],                
                'selector' => '{{WRAPPER}} .elb-lportf-info',
            ]
        );
        $widget->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'subheading_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-lportf-info',
            ]
        );
        $widget->end_controls_section();

        //Styling
        $widget->start_controls_section(
            'mdrn_section_styling',
            [
                'label' => esc_html__('Modern Image  Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $widget->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'ctn_ovl',
                'label' => esc_html__( 'Overlay Background', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'rgba(0,0,0,0.7)'],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-hvimage-overlay',
            ]
        );
        $widget->add_control(
            'ctn_clr_scheme',
            [
                'label' => esc_html__('Color Scheme', 'booster-addons'),
                'description' => esc_html__('Only applied for some images style', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-lportf-border,.elb-hvimage-arrowctn' => 'color: {{VALUE}};'],
            ]
        );
        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'ctn_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-hvimage-insider',
            ]
        );
        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'ctn_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'separator' => 'before',
                'selector' => '{{WRAPPER}} .elb-hvimage-insider',
            ]
        );
       $widget->add_control(
            'frm_hrz_size',
            [
                'label' => __( 'Frame Horizontal Size', 'booster-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 5,
                    ],
                ],
                'condition' => ['frame_enabled' => 'enabled'],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-hvimage-overlay ' => 'width:calc(100% - {{SIZE}}px); --modern-image-x:{{SIZE}}',
                ],
            ]
        );
        $widget->add_control(
            'frm_vrt_size',
            [
                'label' => __( 'Frame Vertical Size', 'booster-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 300,
                        'step' => 5,
                    ],
                ],
                'condition' => ['frame_enabled' => 'enabled'],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-hvimage-overlay ' => 'height:calc(100% - {{SIZE}}px); --modern-image-y:{{SIZE}}',
                ],
            ]
        );
        $widget->add_control(
            'ctn_paddings',
            [
                'label' => esc_html__( 'Container Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'separator' => 'before',
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-lportf-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        
       


        $widget->end_controls_section();
    }

    public static function render($settings){
    }

}