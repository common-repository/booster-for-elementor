<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Testiomnial_Tab{

    public static function init($widget){
         //Layout
        $widget->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'booster-addons'),
            ]
        );
        $widget->add_control(
            'layout',
            [
                'label' => esc_html__('Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'normal' => esc_html__('Normal', 'booster-addons'),
                    'bubble' => esc_html__('Bubble', 'booster-addons'),
                ],
                'default' => 'normal',
            ]
        );
        $widget->add_control(
            'normal_style',
            [
                'label' => esc_html__('Normal Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['layout' => ['normal']],                
                'options' => [
                    'style_1' => esc_html__('Style 1', 'booster-addons'),
                    'style_2' => esc_html__('Style 2', 'booster-addons'),
                    'style_3' => esc_html__('Style 3', 'booster-addons'),
                    'style_4' => esc_html__('Style 4', 'booster-addons'),
                    'style_5' => esc_html__('Style 5', 'booster-addons'),
                ],
                'default' => 'style_1',
            ]
        );
        $widget->add_control(
            'bubble_style',
            [
                'label' => esc_html__('Bubble Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['layout' => ['bubble']],                
                'options' => [
                    'simple' => esc_html__('Simple', 'booster-addons'),
                    'modern' => esc_html__('Modern', 'booster-addons'),
                ],
                'default' => 'simple',
            ]
        );
        $widget->add_control(
            'text_align',
            [
                'label' => esc_html__('Text Align', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],                
                'default' => 'center',       
                 'selectors' => [
                    '{{WRAPPER}} .elb-testi-content-insider' => 'text-align: {{VALUE}};',
                ],      
            ]
        );
        $widget->add_control(
            'avatar_align',
            [
                'label' => esc_html__('Avatar Align', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],                
                'condition' => ['layout' => ['bubble']],                
                'default' => 'left',                
            ]
        );
        $widget->add_control(
            'avatar_position',
            [
                'label' => esc_html__('Avatar Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'bottom'    =>  esc_html__('Bottom','booster-addons'),                     
                    'top'  =>  esc_html__('Top','booster-addons'), 
                ],            
                'condition' => ['layout' => ['bubble']],                
                'default' => 'bottom',                
            ]
        );
        $widget->end_controls_section();
        /********************************************
                    STYLING SECTION       
        ********************************************/
        //****Typography            
        $widget->start_controls_section(
            'section_content_styling',
            [
                'label' => esc_html__('Typography', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Heading Fonts
        $widget->add_control(
            'name_settings',
            [
                'label' => esc_html__('Name Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING
            ]
        );
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_font',
                'label' => esc_html__('Name Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 17,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-testi-user-name',
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'name_color',
                'label' => esc_html__('Name Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],                
                'selector' => '{{WRAPPER}} .elb-testi-user-name',
            ]
        );
        //Position Fonts
        $widget->add_control(
            'position_settings',
            [
                'label' => esc_html__('Position Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING
            ]
        );
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_font',
                'label' => esc_html__('Position Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-testi-user-position',
            ]
        );
        $widget->add_control(
            'position_color',
            [
                'label' => esc_html__('Position Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#aaa',
                'selectors' => [
                    '{{WRAPPER}} .elb-testi-user-position' => 'color: {{VALUE}};',
                ],
            ]
        );
        //Text Fonts
        $widget->add_control(
            'text_settings',
            [
                'label' => esc_html__('Text Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING
            ]
        );
        $widget->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_font',
                'label' => esc_html__('Text Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.7,'unit' => 'em']],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-testi-content-insider',
            ]
        );
        $widget->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-testi-content-insider' => 'color: {{VALUE}};',
                ],
            ]
        );
        $widget->end_controls_section();
        
        //****Avatar Styling
        $widget->start_controls_section(
            'avatar_styling',
            [
                'label' => esc_html__('Avatar Styling', 'booster-addons'),
                'condition' => ['avatar_enabled' => ['yes']],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $widget->add_control(
            'avatar_size',
            [
                'label' => esc_html__('Avatar Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '200',
                'condition' => ['avatar_enabled' => ['yes']],
                'default' => '60',
                'selectors' => [
                    '{{WRAPPER}} .elb-testi-avt' => 'height: {{VALUE}}px;width: {{VALUE}}px;',
                    '{{WRAPPER}} .elb-testi-ctn[data-layout="bubble"] .elb-testi-bubble-content:before' => '--avatar-size: {{VALUE}}px;'
                ],
            ]
        );
        $widget->add_control(
            'avatar_radius',
            [
                'label' => esc_html__( 'Avatar Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'condition' => ['avatar_enabled' => ['yes']],
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-testi-avt' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $widget->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'avatar_br',
                'label' => esc_html__( 'Avatar Border', 'booster-addons' ),
                'condition' => ['avatar_enabled' => ['yes']],
                'selector' => '{{WRAPPER}} .elb-testi-avt',
            ]
        );
        $widget->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'avatar_bxs',
                'label' => esc_html__('Avatar Shadow', 'booster-addons'),
                'condition' => ['avatar_enabled' => ['yes']],
                'selector' => '{{WRAPPER}} .elb-testi-avt',
            ]
        );
        $widget->add_control(
            'avatar_margin',
            [
                'label' => esc_html__( 'Avatar Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'condition' => ['avatar_enabled' => ['yes']],
                'default' => ['left' => '0','top' => '4','right' => '0','bottom' => '10','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-testi-avt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],            
            ]
        );                 
        $widget->add_control(
            'avatar_deco_enabled',
            [
                'label' => esc_html__( 'Enable Avatar Decoration', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['avatar_enabled' => ['yes'],'layout' => 'normal'],
                'default' => 'no',
                'separator' => 'before',
                'frontend_available' => true
            ]
        );
        $widget->add_control(
            'avatar_deco_size',
            [
                'label' => esc_html__('Decoration Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'max' => '10',
                'condition' => ['avatar_enabled' => ['yes'],'avatar_deco_enabled' => ['yes'],'layout' => 'normal'],
                'default' => '1',
                'selectors' => ['{{WRAPPER}} .elb-testi-avt-ctn:before' => 'height: {{VALUE}}px;'],
            ]
        );
        $widget->add_control(
            'avatar_deco_width',
            [
                'label' => esc_html__('Decoration Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'max' => '100',
                'condition' => ['avatar_enabled' => ['yes'],'avatar_deco_enabled' => ['yes'],'layout' => 'normal'],
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-testi-avt-ctn:before' => 'width: {{VALUE}}%;'],
            ]
        );
        $widget->add_control(
            'avatar_deco_color',
            [
                'label' => esc_html__('Decoration Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['avatar_enabled' => ['yes'],'avatar_deco_enabled' => ['yes'],'layout' => 'normal'],                
                'default' => '#777',
                'selectors' => ['{{WRAPPER}} .elb-testi-avt-ctn:before' => 'background: {{VALUE}};'],
            ]
        );        
        $widget->end_controls_section();
        
        //****Icon Styling 
        $widget->start_controls_section(
            'icon_styling',
            [
                'label' => esc_html__('Icon Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $widget->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '15', 'max' => '200',
                'default' => '28',
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-imban-ctn' => 'min-height: {{VALUE}}px;'],
            ]
        );
        $widget->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'icon_color',
                'dynamic' => ['active' => true],
                'fields_options' => ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#999']],
                'label' => esc_html__('Icon Color', 'booster-addons')
            ]
        );
        $widget->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_icon_quote_chooser(),
                'default' => 'quote',
            ]
        );        
        $widget->add_control(
            'icon_position',
            [
                'label' => esc_html__('Icon  Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['layout' => ['bubble']],
                'options' => elb_icon_side_positions(),
                'default' => 'left-center',
            ]
        );
        $widget->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['top' => '0','left' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'allowed_dimensions' => ['top','left','right','bottom'],
                'selectors' => ['{{WRAPPER}} .elb-testi-icon-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $widget->add_control(
            'icon_2_enabled',
            [
                'label' => esc_html__( 'Enable Icon 2', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['layout' => ['bubble']],
                'separator' => 'before',
                'frontend_available' => true
            ]
        );
        $widget->add_control(
            'icon_2_type',
            [
                'label' => esc_html__('Icon Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['layout' => ['bubble'],'icon_2_enabled' => ['yes']],
                'options' => elb_icon_quote_chooser(),
                'default' => 'quote-right',
            ]
        );
        $widget->add_control(
            'icon_2_position',
            [
                'label' => esc_html__('Icon 2 Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_icon_side_positions(),
                'condition' => ['layout' => ['bubble'],'icon_2_enabled' => ['yes']],                
                'default' => 'right-center',
            ]
        );
        $widget->add_control(
            'icon_2_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['top' => '0','left' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'condition' => ['layout' => ['bubble'],'icon_2_enabled' => ['yes']],
                'allowed_dimensions' => ['top','left','right','bottom'],
                'selectors' => ['{{WRAPPER}} .elb-testi-icon-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $widget->end_controls_section();
        
        //****Container Styling 
        $widget->start_controls_section(
            'ctn_styling',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['layout' => ['bubble']],
            ]
        );
        $widget->add_control(
            'container_bg',
            [
                'label' => esc_html__('Container Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'condition' => ['layout' => ['bubble']],
                'default' => '#fafafa',
                'selectors' => [
                    '{{WRAPPER}} .elb-testi-bubble-content' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .elb-testi-bubble-content:before,{{WRAPPER}} .elb-testi-bubble-content:after' => 'color: {{VALUE}};',
                ],
            ]
        );
        $widget->add_control(
            'ctn_paddings',
            [
                'label' => esc_html__( 'Container Padding', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'condition' => ['layout' => ['bubble']],
                'default' => ['left' => '30','top' => '30','right' => '30','bottom' => '30','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-testi-bubble-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $widget->add_control(
            'name_margin',
            [
                'label' => esc_html__( 'Name Area Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'condition' => ['avatar_enabled' => ['yes']],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-testi-user-ctn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],            
            ]
        ); 
        
        $widget->end_controls_section();
    }

    public static function render($settings){
        $ctn_attr = $icon_output = $user_output = $content_output = $avatar_output = '';
        if($settings['avatar_enabled'] == 'yes' && $settings['avatar']['url']  != ''):
            $avatar_output = '<div class="elb-testi-avt-ctn" data-decoration="'.esc_attr($settings['avatar_deco_enabled']).'"><div class="elb-testi-avt"><img src="'.esc_url($settings['avatar']['url']).'" alt="'.esc_attr($settings['name']).'"></div></div>';
        endif;

        $user_output = '<div class="elb-testi-user-ctn"><div class="elb-testi-user-name">'.wp_kses_post($settings['name']).'</div><div class="elb-testi-user-position">'.wp_kses_post($settings['position']).'</div></div>';
        
        //Icon Output BEGIN +++++++
            $icon_color = [
                'color_one_pos'     => $settings['icon_color_color_one_pos'] , 
                'color_one'         => $settings['icon_color_color_one'] ,
                'color_two_pos'     => $settings['icon_color_color_two_pos'] ,
                'color_two'         => $settings['icon_color_color_two'] ,
                'gradient_enabled'  => $settings['icon_color_gradient_enabled'],
                'direction'         => $settings['icon_color_direction']

            ];
            $icon_attributes = ($settings['layout'] == 'bubble') ? ' data-icon1-pos="'.esc_attr($settings['icon_position']).'" data-icon2-pos="'.esc_attr($settings['icon_2_position']).'" ' : '';
            $icon_output = '<div class="elb-testi-icon-ctn" '.$icon_attributes.'><div class="elb-testi-icon elb-testi-icon-1">'.CertainDev_Icons::get_icon($settings['icon_type'], $icon_color, $settings['icon_size']).'</div>';
            $icon_output .= ($settings['layout'] == 'bubble' && $settings['icon_2_enabled'] == 'yes') ? '<div class="elb-testi-icon elb-testi-icon-2">'.CertainDev_Icons::get_icon($settings['icon_2_type'], $icon_color, $settings['icon_size']).'</div>' : '';
            $icon_output .= '</div>';
        //Icon Output END --------

        $content_output =  '<div class="elb-testi-content-ctn"><div class="elb-testi-content-insider">'.$settings['text'].'</div></div>';
        
        $ctn_attr = ($settings['layout'] == 'normal') ? ' data-style="'.esc_attr($settings['normal_style']).'" ' : ' data-style="'.esc_attr($settings['bubble_style']).'" data-avatar-align="'.esc_attr($settings['avatar_align']).'" data-avatar-position="'.esc_attr($settings['avatar_position']).'"';

        $output = '<div class="elb-testi-ctn elb-widget" data-layout="'.esc_attr($settings['layout']).'" '.$ctn_attr .'>';
            $output .= '<div class="elb-testi-insider">';
                if ($settings['layout'] == 'normal'):
                    switch ($settings['normal_style']) {
                        case 'style_1':// Icon + Content + Avatar + User
                            $output .=  $icon_output .' '. $content_output .' '. $avatar_output .' '. $user_output; 
                            break;
                        case 'style_2'://Avatar + User + Content + Icon 
                            $output .=  $avatar_output .' '. $user_output .' '. $content_output .' '. $icon_output; 
                            break;
                        case 'style_3'://Icon + User + Content + Avatar  
                            $output .=  $icon_output .' '. $user_output .' '. $content_output .' '. $avatar_output; 
                            break;
                        case 'style_4'://Avatar + Content + Icon + User   
                            $output .=  $avatar_output .' '. $content_output .' '. $icon_output .' '. $user_output; 
                            break;    
                        case 'style_5'://Icon + Content + Avatar  + User   (Icon Under Avatar)
                            $output .=  $icon_output .' '. $content_output .' '. $avatar_output .' '. $user_output; 
                            break;  
                    }                        
                elseif($settings['layout'] == 'bubble'):
                    $bubble_user = '<div class="elb-testi-bubble-user">'.$avatar_output.''.$user_output.'</div>';
                    $bubble_content = '<div class="elb-testi-bubble-content">'.$content_output.''.$icon_output.'</div>';
                    $output .= ($settings['avatar_position'] == 'top') ? $bubble_user.''.$bubble_content : $bubble_content.''.$bubble_user;
                endif;
            $output .= '</div>';
        $output .= '</div>';      
        return $output;
    }

}