<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_IconBox_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-iconbox-widget';
    }
    public function get_title() {
        return esc_html__('Icon Box', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-icon-box';
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
            'icon_content',
            [
                'label' => esc_html__('Content display', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon or Image', 'booster-addons'),
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
                'default' => 'fire',
                'label_block' => true               
            ]
        );
        $this->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Title', 'booster-addons'),
                'label_block' => true,
                'separator' => 'before',
                'default' => 'Booster Addons',               
            ]
        );
        $this->add_control(
            'sub_heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub Heading', 'booster-addons'),
                'label_block' => true,
                'default' => 'Premium Addons',
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'short_text',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => esc_html__('Short text', 'booster-addons'),
                'label_block' => true,
                'default' => 'One of the best elementor widgets addons available on the market with unique and modern elements.',
                'dynamic' => ['active' => true],
            ]
        );
        //-----------------Settings Sub Content----------------
        $this->add_control(
            'settings_subcontent',
            [
                'label' => esc_html__('Settings', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
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
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'h1' => esc_html__('H1', 'booster-addons'),
                    'h2' => esc_html__('H2', 'booster-addons'),
                    'h3' => esc_html__('H3', 'booster-addons'),
                    'h4' => esc_html__('H4', 'booster-addons'),
                    'h5' => esc_html__('H5', 'booster-addons'),
                    'h6' => esc_html__('H6', 'booster-addons'),
                    'div' => esc_html__('div', 'booster-addons'),
                ],
                'default' => 'h2',
            ]
        );
        $this->add_control(
            'sub_heading_tag',
            [
                'label' => esc_html__('Sub Heading HTML Tag', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'h1' => esc_html__('H1', 'booster-addons'),
                    'h2' => esc_html__('H2', 'booster-addons'),
                    'h3' => esc_html__('H3', 'booster-addons'),
                    'h4' => esc_html__('H4', 'booster-addons'),
                    'h5' => esc_html__('H5', 'booster-addons'),
                    'h6' => esc_html__('H6', 'booster-addons'),
                    'div' => esc_html__('div', 'booster-addons'),
                ],
                'default' => 'h4',
            ]
        );
        $this->end_controls_section();

        //SECTION LAYOUT
        $this->start_controls_section(
            'section_layout_styling',
            [
                'label' => esc_html__('Layout', 'booster-addons'),
            ]
        );
        $this->add_control(
            'layout',
            [
                'label' => esc_html__('Choose Layout', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [                     
                     'icontop'=> esc_html__('Icon Top','booster-addons'),                     
                     'iconleft'=> esc_html__('Icon Left Side','booster-addons'),                     
                     'iconright'=> esc_html__('Icon Right Side','booster-addons'),                     
                     'iconheadingleft'=> esc_html__('Icon Left Heading','booster-addons'),                     
                     'iconheadingright'=> esc_html__('Icon Right Heading','booster-addons') ,
                 ],
                'default' => 'icontop',
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'dynamic' => ['active' => true],
                'condition' => ['layout' => [ 'icontop' ]],
                'options' => [                
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
            ]
        );
        $this->end_controls_section();
        /********************************************
                    STYLE SECTION       
        ********************************************/

		//-----------------Icon Styling Sub Content----------------   
        $iconDefaults = [
            'icon_margin' => ['left' => '0','top' => '0','right' => '0','bottom' => '10','isLinked' => false],
            'icon_effect' => 'fade',
        ];
        ELB_IconHover_Tab::init($this,true,$iconDefaults);
                    



                    
		//-----------------Title Styling Sub Content----------------             
        $this->start_controls_section(
            'section_title_styling',
            [
                'label' => esc_html__('Title Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-title',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#7d66e2']],                

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-title',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-title',
            ]
        );
        $this->add_control(
            'title_color_hover_enabled',
            [
                'label' => esc_html__( 'Title Hover Color', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_color_hover',
                'label' => esc_html__('Hover Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-title:hover,{{WRAPPER}}:hover .elb-icb-title',
                'condition' => ['title_color_hover_enabled' => [ 'yes' ]]
            ]
        );     
        $this->end_controls_section();


         //-----------------Sub Heading Styling Sub Content----------------             
        $this->start_controls_section(
            'section_sub_heading_styling',
            [
                'label' => esc_html__('Sub Heading Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'sub_heading_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-subheading',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#888']],                
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-subheading',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 13,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1,'unit' => 'em']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sub_heading_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-subheading',
            ]
        );    
        $this->end_controls_section();


        //-----------------Short Text Styling Sub Content----------------             
        $this->start_controls_section(
            'section_short_text_styling',
            [
                'label' => esc_html__('Short text Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'short_text_color',
            [
                'label' => esc_html__('Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [
                    '{{WRAPPER}} .elb-icb-shorttext' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-icb-shorttext',
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 15,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.5,'unit' => 'em']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],
            ]
        );
          
        $this->end_controls_section();


        //-----------------Distances Styling Sub Content----------------        
        $this->start_controls_section(
            'section_distances_styling',
            [
                'label' => esc_html__('Content Distances', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );    
       
        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Heading Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '10',
                    'right' => '0',
                    'bottom' => '5',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icb-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );   
        $this->add_control(
            'sub_heading_margin',
            [
                'label' => esc_html__( 'Sub Heading Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '15',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icb-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );    
        $this->add_control(
            'short_text_margin',
            [
                'label' => esc_html__( 'Short Text Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => [
                    'left' => '0',
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '25',
                    'isLinked' => false
                ],
                'selectors' => [
                    '{{WRAPPER}} .elb-icb-shorttext' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );     
        $this->end_controls_section();


	}


	protected function render() {
        $settings = $this->get_settings_for_display();
        $output = '';        
        $icon_area = ELB_IconHover_Tab::render($settings);
        
        $sides = ['iconleft','iconright'];    
        $sidesIn = ['iconheadingleft','iconheadingright'];    
        $output .= '<div class="elb-icb elb-widget elb-btn-item elb-icon-hvctn" data-layout="'.esc_attr($settings['layout']).'" data-hover="'.esc_attr($settings['icon_effect']).'" data-align="'.esc_attr($settings['align']).'">';
            if(in_array($settings['layout'], $sidesIn)) $output .= '<div class="elb-icb-top elb-fs">';
            $output .= '<div class="elb-icb-icon-ctn elb-fs">'.$icon_area.'</div>';            
            
            if(in_array($settings['layout'], $sides)) $output .= '<div class="elb-icb-txt-ctn">';
                if(in_array($settings['layout'], $sidesIn)) $output .= '<div class="elb-icb-top-txt elb-fs">';

                $title = '<' . esc_html($settings['title_tag']) . ' class="elb-icb-title elb-tr-3">' . wp_kses_post($settings['title']) . '</' . esc_html($settings['title_tag']) . '>';

                $output .= elb_render_elementor_link($settings['link'], $title);
                if(!empty($settings['sub_heading']))
                    $output .= '<' . esc_html($settings['sub_heading_tag']) . ' class="elb-icb-subheading">' . wp_kses_post($settings['sub_heading']) . '</' . esc_html($settings['sub_heading_tag']) . '>';
                
                if(in_array($settings['layout'], $sidesIn)) $output .= '</div>';
            if(in_array($settings['layout'], $sidesIn)) $output .= '</div>';

                if(!empty($settings['short_text']))
                    $output .= '<div class="elb-icb-shorttext">' . $settings['short_text'] . '</div>';
                            
            if(in_array($settings['layout'], $sides)) $output .= '</div>';


         $output .= '</div>';

        echo apply_filters('elb_iconbox_output', $output, $settings);
    }

}