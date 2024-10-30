<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_SocialShare_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-socialshare-widget';
    }
    public function get_title() {
        return esc_html__('Social Share', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-share';
    }
    public function get_categories() {
        return array('booster-addons');
    }
    
    protected function _register_controls() {
        /********************************************
                    Social SECTION       
        ********************************************/
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Social Sites', 'booster-addons'),
            ]
        );
        $this->add_control(
            'social_list',
            [
                'label' => esc_html__('Social List', 'booster-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => [
                    'facebook'  => esc_html__('Facebook', 'booster-addons'),
                    'twitter'  => esc_html__('Twitter', 'booster-addons'),
                    'linkedin'  => esc_html__('LinkedIn', 'booster-addons'),
                    'pinterest'  => esc_html__('Pinterest', 'booster-addons'),
                    'reddit'  => esc_html__('Reddit', 'booster-addons'),
                    'tumblr'  => esc_html__('Tumblr', 'booster-addons'),
                    'xing'  => esc_html__('Xing', 'booster-addons'),
                    'vk'  => esc_html__('VK', 'booster-addons'),
                    'telegram'  => esc_html__('Telegram', 'booster-addons'),
                ],
                'default' => ['facebook','twitter','linkedin','pinterest'],                
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'layout_settings',
            [
                'label' => esc_html__('Layout', 'booster-addons'),
            ]
        );
        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__('Icon Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
                'selectors' => ['{{WRAPPER}} .elb-social-ctn' => 'text-align: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'open_in',
            [
                'label' => esc_html__('Open Share in', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'popup'    =>  esc_html__('Pop up','booster-addons'), 
                    'tab'  =>  esc_html__('New Tab','booster-addons'), 
                ],
                'default' => 'popup',
            ]
        );
        $this->add_control(
            'what_share',
            [
                'label' => esc_html__('What to Share', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'page'    =>  esc_html__('Actual Page','booster-addons'), 
                    'custom_link'  =>  esc_html__('Custom Link','booster-addons'), 
                ],
                'default' => 'page',
            ]
        );
        $this->add_control(
            'link_share', [
                'label' => esc_html__('Link to Share', 'booster-addons'),
                'default' => '#',
                'type' => Controls_Manager::TEXT,
                'condition' => ['what_share' => [ 'custom_link' ]],
                'label_block' => true,
            ]
        );
        $this->add_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Icon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '7','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-social-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
        //General Styling
        $this->start_controls_section(
            'ctn_settings',
            [
                'label' => esc_html__('Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 
                'dynamic' => ['active' => true],
                'default' => '21',
                'selectors' => ['{{WRAPPER}} .elb-social-item svg' => 'width: {{VALUE}}px; height:{{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'icon_bg_size',
            [
                'label' => esc_html__('Icon Background Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 
                'dynamic' => ['active' => true],
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-social-item' => 'width: {{VALUE}}px; height:{{VALUE}}px;'],
            ]
        );
        
        $this->start_controls_tabs( 'icon_sty_settings' );
        //Styling for Normal Icon               
         $this->start_controls_tab( 'normal_icon',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
            ]
        );

        $this->add_control(
            'clr_scheme_en',
            [
                'label' => esc_html__( 'Color Scheme', 'booster-addons' ),
                'description' => esc_html__( 'Enable the real social site color scheme', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'clr',
            [
                'label' => esc_html__('Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#666',
                'condition' => ['clr_scheme_en!' => [ 'yes' ]],
                'selectors' => [
                    '{{WRAPPER}} .elb-social-item .elb-btn-item-txt-r' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bg_scheme_en',
            [
                'label' => esc_html__( 'Background Scheme', 'booster-addons' ),
                'description' => esc_html__( 'Enable the real social site color scheme', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'bg',
            [
                'label' => esc_html__('Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fafafa',
                'condition' => ['bg_scheme_en!' => [ 'yes' ]],
                'selectors' => [
                    '{{WRAPPER}} .elb-social-item .elb-btn-item-back-r:after' => 'color: {{VALUE}}; background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'br_style',
            [
                'label' => esc_html__('Boder Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'none' => esc_html__('None', 'booster-addons'),
                    'solid' => esc_html__('Solid', 'booster-addons'),
                    'dotted' => esc_html__('Dotted', 'booster-addons'),
                    'dashed' => esc_html__('Dashed', 'booster-addons'),
                ],
                'selectors' => ['{{WRAPPER}} .elb-social-item .elb-btn-item-back-r:after' => 'border-style: {{VALUE}};'],
                'default' => 'none',
            ]
        );
        $this->add_control(
            'br_width',
            [
                'label' => esc_html__('Border Width', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0,'max' => 10,'step' => 1],
                ],
                'default' => ['unit' => 'px','size' => 1],
                'condition' => ['br_style!' => [ 'none' ]],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-social-item .elb-btn-item-back-r:after' => 'border-width: {{SIZE}}px;'],
            ]
        );
        $this->add_control(
            'br_scheme_en',
            [
                'label' => esc_html__( 'Bodrer Scheme', 'booster-addons' ),
                'description' => esc_html__( 'Enable the real social site color scheme', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['br_style!' => [ 'none' ]],
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'br_color',
            [
                'label' => esc_html__('Bodrer Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fafafa',
                'condition' => ['br_scheme_en!' => [ 'yes' ],'br_style!' => [ 'none' ]],
                'selectors' => [
                    '{{WRAPPER}} .elb-social-item .elb-btn-item-back-r:after' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_radius',
            [
                'label' => esc_html__( 'Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-social-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'icon_rotate_x',
            [
                'label' => esc_html__('Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'selectors' => ['{{WRAPPER}} .elb-social-item .elb-btn-item-txt svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'],
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'icon_bg_rotate_x',
            [
                'label' => esc_html__('Background Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'selectors' => ['{{WRAPPER}} .elb-social-item .elb-btn-item-back-r:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'],
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_tab();

        //Styling for Hover Icon        
        $this->start_controls_tab( 'hover_icon',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'hover_effect',
            [
                'label' => esc_html__('Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_icon_hover_effects(),
                'default' => 'tada',
            ]
        );
        $this->add_control(
            'clr_scheme_en_h',
            [
                'label' => esc_html__( 'Color Scheme', 'booster-addons' ),
                'description' => esc_html__( 'Enable the real social site color scheme', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['hover_effect!' => [ 'none' ]],
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'clr_h',
            [
                'label' => esc_html__('Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'condition' => ['clr_scheme_en_h!' => [ 'yes' ],'hover_effect!' => [ 'none' ]],
                'selectors' => [
                    '{{WRAPPER}} .elb-social-item .elb-btn-item-txt-h' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'bg_scheme_en_h',
            [
                'label' => esc_html__( 'Background Scheme', 'booster-addons' ),
                'description' => esc_html__( 'Enable the real social site color scheme', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'condition' => ['hover_effect!' => [ 'none' ]],
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'bg_h',
            [
                'label' => esc_html__('Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fafafa',
                'condition' => ['bg_scheme_en_h!' => [ 'yes' ],'hover_effect!' => [ 'none' ]],
                'selectors' => [
                    '{{WRAPPER}} .elb-social-item .elb-btn-item-back-h:after,{{WRAPPER}} .elb-social-item .tada-eff-insider,{{WRAPPER}} .elb-social-item .tada-eff-center-insider' => 'color: {{VALUE}}; background: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'br_style_h',
            [
                'label' => esc_html__('Boder Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['hover_effect!' => [ 'none' ]],
                'options' => [
                    'none' => esc_html__('None', 'booster-addons'),
                    'solid' => esc_html__('Solid', 'booster-addons'),
                    'dotted' => esc_html__('Dotted', 'booster-addons'),
                    'dashed' => esc_html__('Dashed', 'booster-addons'),
                ],
                'default' => 'none',
                'selectors' => ['{{WRAPPER}} .elb-social-item .elb-btn-item-back-h:after' => 'border-style: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'br_width_h',
            [
                'label' => esc_html__('Border Width', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => ['min' => 0,'max' => 10,'step' => 1],
                ],
                'default' => ['unit' => 'px','size' => 1],
                'condition' => ['br_style_h!' => [ 'none' ],'hover_effect!' => [ 'none' ]],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-social-item .elb-btn-item-back-h:after' => 'border-width: {{SIZE}}px;'],
            ]
        );
        $this->add_control(
            'br_scheme_en_h',
            [
                'label' => esc_html__( 'Bodrer Scheme', 'booster-addons' ),
                'description' => esc_html__( 'Enable the real social site color scheme', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['br_style_h!' => [ 'none' ],'hover_effect!' => [ 'none' ]],
                'frontend_available' => true,

            ]
        );
        $this->add_control(
            'br_color_h',
            [
                'label' => esc_html__('Bodrer Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fafafa',
                'condition' => ['br_scheme_en_h!' => [ 'yes' ],'br_style_h!' => [ 'none' ],'hover_effect!' => [ 'none' ]],
                'selectors' => [
                    '{{WRAPPER}} .elb-social-item .elb-btn-item-back-h:after' => 'border-color: {{VALUE}};',                    
                ],
            ]
        );

        $this->add_control(
            'icon_radius_h',
            [
                'label' => esc_html__( 'Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'condition' => ['hover_effect!' => [ 'none' ]],
                'default' => ['left' => '50','top' => '50','right' => '50','bottom' => '50','isLinked' => true],                
                'selectors' => ['{{WRAPPER}} .elb-social-item:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'icon_rotate_x_hv',
            [
                'label' => esc_html__('Hover Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'selectors' => ['{{WRAPPER}} .elb-social-item:hover  .elb-btn-item-txt svg' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'],
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'icon_bg_rotate_x_hv',
            [
                'label' => esc_html__('Hover Background Icon Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
                'selectors' => ['{{WRAPPER}} .elb-social-item:hover  .elb-btn-item-back-h:after' => 'transform:rotate({{VALUE}}deg);-webkit-transform:rotate({{VALUE}}deg);'],
                'dynamic' => ['active' => true],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        
    }
   
    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = '';
        if($settings['social_list']):
            $social_array = elb_social_array();
            $social_styling = [
                'open_in'           =>  $settings['open_in'],
                'what_share'        =>  $settings['what_share'],
                'link_share'        =>  $settings['link_share'],

                'clr_scheme_en'     =>  $settings['clr_scheme_en'],
                'bg_scheme_en'      =>  $settings['bg_scheme_en'],
                'br_scheme_en'      =>  $settings['br_scheme_en'],
                'hover_effect'      =>  $settings['hover_effect'],
                'clr_scheme_en_h'   =>  $settings['clr_scheme_en_h'],
                'bg_scheme_en_h'    =>  $settings['bg_scheme_en_h'],
                'br_scheme_en_h'    =>  $settings['br_scheme_en_h'],
            ];


            $output = '<div class="elb-social-ctn" data-icon-align="'.esc_attr($settings['icon_align']).'">';
                foreach($settings['social_list'] as $social):
                    $output .= elb_render_social_content('share',$social_array,$social,'',$social_styling);
                endforeach;
            $output .= '</div>';

        endif;

        echo apply_filters('elb_socialshare_output', $output, $settings);

    }

}