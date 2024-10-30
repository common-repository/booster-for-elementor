<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_FullScreenContentSlider_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-fullscreencontentslider-widget';
    }
    public function get_title() {
        return esc_html__('FullScreen Content Slider', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-post-slider';
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
                'label' => esc_html__('Content', 'Element Booster'),
            ]
        );
        /*
        $this->add_control(
            'content_source',
            [
                'label' => esc_html__('Countent Source', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'manual'    =>  esc_html__('Manual','booster-addons'), 
                    'post_type'  =>  esc_html__('Post','booster-addons'), 
                ],
                'default' => 'manual',
            ]
        );
        */

        $repeater = new Repeater();
        $repeater->add_control(
            'itm_heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading', 'booster-addons'),
                'label_block' => true,
                'default' => '',               
            ]
        ); 
        $repeater->add_control(
            'itm_subheading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub-Heading', 'booster-addons'),
                'label_block' => true,
                'default' => '',               
            ]
        ); 
        $repeater->add_control(
            'itm_description',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label' => esc_html__('Description', 'booster-addons'),
                'label_block' => true,
                'default' => '',               
            ]
        ); 
        $repeater->add_control(
            'itm_link_text',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Link Text', 'booster-addons'),
                'label_block' => true,
                'default' => '',               
            ]
        );   
        $repeater->add_control(
            'itm_link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'itm_background_img',
                'label' => esc_html__( 'Background image', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic'],
                'fields_options' => ['background' => ['default' => 'classic'],'image' =>['default' =>['url' => '']], 'position' => ['default' =>'center center'],'size' =>['default' =>'cover'], 'color' => ['default' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );
        $repeater->add_control(
            'itm_ovl_clr',
            [
                'label' => esc_html__('Overlay Background Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'default' => 'transparent',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}:before' => 'background: {{VALUE}};'],                             
            ]
        );
        $repeater->add_control(
            'itm_thumbnail',
            [
                'label' => esc_html__('Choose Thumbnail', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => ['url' => Utils::get_placeholder_image_src()],
            ]
        );

        $this->add_control(
            'itm_list',
            [
                'label' => esc_html__('Content List', 'booster-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                #'condition' => ['content_source' => ['manual']],                 
                'title_field' => '{{{ itm_heading }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'global_section',
            [
                'label' => esc_html__('Global Settings', 'Element Booster'),        
            ]
        );

        $this->add_control(
            'nav_layout',
            [
                'label' => esc_html__('Navigation Layout', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'none'    =>  esc_html__('None','booster-addons'), 
                    'side'    =>  esc_html__('Side','booster-addons'), 
                    'bottom'  =>  esc_html__('Bottom','booster-addons'), 
                ],
                'default' => 'side',
            ]
        );
        $this->add_control(
            'nav_style',
            [
                'label' => esc_html__('Navigation Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1'    =>  esc_html__('Style 1','booster-addons'), 
                    'style_2'    =>  esc_html__('Style 2','booster-addons'), 
                    'style_3'    =>  esc_html__('Style 3','booster-addons'), 
                    'style_4'    =>  esc_html__('Style 4','booster-addons'), 
                    'style_5'    =>  esc_html__('Style 5','booster-addons'), 
                    'style_6'    =>  esc_html__('Style 6','booster-addons'), 
                ],
                'condition' => ['nav_layout!' => ['none']], 
                'default' => 'style_1',
            ]
        );
        $this->add_control(
            'autoplay_enabled',
            [
                'label' => esc_html__( 'Enable Auto Play', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Play Speed', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '1', 
                'dynamic' => ['active' => true],
                'condition' => ['autoplay_enabled' => ['yes']],
                'default' => '7'
            ]
        );
        $this->end_controls_section();
        /********************************************
                    STYLE SECTION       
        ********************************************/
        /*FONT*/
        $this->start_controls_section(
            'font_section',
            [
                'label' => esc_html__('Font Settings', 'Element Booster'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_font',
                'label' => esc_html__('Heading Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 46,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.2,'unit' => 'em']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-crtcsld-headings h3',
            ]
        ); 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subheading_font',
                'label' => esc_html__('Sub-Heading Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-crtcsld-sbhds',
            ]
        );  
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_font',
                'label' => esc_html__('Description Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 15,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.7,'unit' => 'em']],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-crtcsld-txts',
            ]
        ); 
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'link_font',
                'label' => esc_html__('Link Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-crtcsld-cnt-link',
            ]
        );
        $this->end_controls_section();

        /*FONT COLOR*/
        $this->start_controls_section(
            'font_color_section',
            [
                'label' => esc_html__('Text Color Settings', 'Element Booster'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'heading_color',
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],            
                'selector' => '{{WRAPPER}} .elb-crtcsld-headings h3'
            ]
        );
        $this->add_control(
            'subheading_color',
            [
                'label' => esc_html__('Sub-Heading Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-crtcsld-cnt-itm-subh' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-crtcsld-cnt-itm-txt' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'link_color',
            [
                'label' => esc_html__('Link Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-crtcsld-cnt-itm-more' => 'color: {{VALUE}};'],
            ]
        );
        $this->end_controls_section();

        /*NAVIGATION*/
        $this->start_controls_section(
            'styling_section_colors',
            [
                'label' => esc_html__('Colors', 'Element Booster'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
        $this->add_control(
            'nav_color',
            [
                'label' => esc_html__('Navigation Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7D66E2',
                'selectors' => ['{{WRAPPER}} .elb-crtcsld-nav' => 'color: {{VALUE}};'],
            ]
        );    
        $this->add_control(
            'bar_color',
            [
                'label' => esc_html__('Load Bar Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7D66E2',
                'condition' => ['autoplay_enabled' => ['yes']],
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-load-bar' => 'background: {{VALUE}};',
                ],
            ]
        );        
        $this->add_control(
            'navarrow_bg',
            [
                'label' => esc_html__('Arrows Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,.4)',
                'selectors' => ['{{WRAPPER}} .elb-crtcsld-btn' => 'background: {{VALUE}};'],
            ]
        ); 
        $this->add_control(
            'navarrow_color',
            [
                'label' => esc_html__('Arrows Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-crtcsld-btn' => 'color: {{VALUE}};'],
            ]
        ); 
        $this->end_controls_section();

        /*Distances*/
        $this->start_controls_section(
            'content_distances_styling',
            [
                'label' => esc_html__('Content Distances', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'content_width',
            [
                'type' => Controls_Manager::NUMBER,
                'label' => esc_html__('Content Width (%)', 'booster-addons'),
                'label_block' => true,
                'min' => 10,'max' => 100,
                'default' => 60,
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-cnt-itm-ins' => 'width: {{VALUE}}%;',
                ],
            ]
        );
        $this->add_control(
            'content_paddings',
            [
                'label' => esc_html__( 'Content Paddings (%)', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '2','top' => '0','right' => '2','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-cnt-itm-ins' => 'padding: {{TOP}}% {{RIGHT}}% {{BOTTOM}}% {{LEFT}}%;',
                ],
            ]
        );


        $this->add_control(
            'heading_margin',
            [
                'label' => esc_html__( 'Heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'dynamic' => ['active' => true],
                'separator' => 'after',
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-headings' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'subheading_margin',
            [
                'label' => esc_html__( 'Sub-Heading Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-sbhds' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'description_margin',
            [
                'label' => esc_html__( 'Description Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '20','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-txts' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->add_control(
            'link_margin',
            [
                'label' => esc_html__( 'Link Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '20','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-crtcsld-cnt-itm-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );     
     
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $navigations = $backgrounds = $headings = $subheadings = $descriptions = $links = $thumbnails = '';
            
        if($settings['itm_list']):
            foreach($settings['itm_list'] as $key => $sitem):
                $key = $key + 1;              
                $item_attr = ($key == 1) ?  ' data-situation="active" ' : ' data-situation="inactive" ';
                $thumb_attr = ($key == 1) ?  ' data-hidden="false" ' : ' data-hidden="true" ';
                $item_attr .= ' data-index="'.$key.'" ';
                
                $navigations .= '<div class="elb-crtcsld-nav-btn elb-crtcsld-itm" '.$item_attr.' onclick="elb_crtcsld_trigger(this,\'none\')"></div>';
                $backgrounds .= '<div class="elb-crtcsld-im-itm elb-tr-8 elb-crtcsld-itm elementor-repeater-item-'.$sitem['_id'].'" '.$item_attr.'></div>';
                $headings .= '<h3 class="elb-crtcsld-cnt-itm-heading elb-fs elb-crtcsld-itm-txtanm elb-crtcsld-itm elb-tr-3" '.$item_attr.'>'.$sitem['itm_heading'].'</h3>';
                $subheadings .= '<div class="elb-crtcsld-cnt-itm-subh elb-crtcsld-itm-txtanm elb-fs elb-crtcsld-itm elb-tr-3" '.$item_attr.'>'.$sitem['itm_subheading'].'</div>';
                $descriptions .= '<div class="elb-crtcsld-cnt-itm-txt elb-fs elb-crtcsld-itm-txtanm elb-crtcsld-itm elb-tr-3" '.$item_attr.'>'.$sitem['itm_description'].'</div>';
                $links .= ($sitem['itm_link']['url'] != '') ? elb_render_elementor_link($sitem['itm_link'], $sitem['itm_link_text'], false, "elb-crtcsld-cnt-itm-more-link elb-crtcsld-itm elb-tr-3", $item_attr) : '';
                $thumbnails .= '<div class="elb-crtcsld-cnt-itm-img elb-crtcsld-itm elb-tr-3" '.$item_attr.' '.$thumb_attr.' style="background-image: url('.$sitem['itm_thumbnail']['url'].')"></div>';
            endforeach;
        endif;
        
        $play_attr = ($settings['autoplay_enabled'] == 'yes') ? ' data-play="'.esc_attr($settings['autoplay_speed']).'" data-loading="done" ' : '';

        $output .= '<div class="elb-crtcsld-ctn" data-nav-pos="'.esc_attr($settings['nav_layout']).'" data-current="1" data-length="'.sizeof($settings['itm_list']).'" '.$play_attr.'>';
            $output .= ($settings['autoplay_enabled'] == 'yes') ? '<div class="elb-crtcsld-load-ctn"><div class="elb-crtcsld-load-bar" style="-webkit-animation-duration:'.$settings['autoplay_speed'].'s; animation-duration:'.$settings['autoplay_speed'].'s;"></div></div>' : '';
            $output .= '<div class="elb-crtcsld-nav" data-nav-style="'.esc_attr($settings['nav_style']).'">';
               $output .= $navigations;
            $output .= '</div>';

            $output .= '<div class="elb-crtcsld-images">';
               $output .= $backgrounds;            
            $output .= '</div>';

            $output .= '<div class="elb-crtcsld-content">';            
                $output .= '<div class="elb-crtcsld-cnt-itm">';
                    $output .= '<div class="elb-crtcsld-cnt-itm-ins">';
                        $output .= '<div class="elb-crtcsld-headings elb-crtcsld-txtanm-ctn elb-fs">';                        
                            $output .= $headings;            
                        $output .= '</div>';
                       $output .= '<div class="elb-crtcsld-cnt-itm-info elb-fs">';
                            $output .= '<div class="elb-crtcsld-cnt-itm-left">';
                                $output .= '<div class="elb-crtcsld-thumbs">';
                                    $output .= $thumbnails;            
                                $output .= '</div>';
                                $output .= '<div class="elb-crtcsld-cnt-itm-nav-btns elb-fs">';
                                    $output .= '<div class="elb-crtcsld-btn elb-crtcsld-btn-prv elb-tr-2" onclick="elb_crtcsld_trigger(this,\'previous\')"></div>';
                                    $output .= '<div class="elb-crtcsld-btn elb-crtcsld-btn-nxt elb-tr-2" onclick="elb_crtcsld_trigger(this,\'next\')"></div>';
                                $output .= '</div>';
                            $output .= '</div>';
                            $output .= '<div class="elb-crtcsld-cnt-itm-content">';
                                $output .= '<div class="elb-crtcsld-sbhds elb-crtcsld-txtanm-ctn elb-fs">';
                                    $output .= $subheadings;                                    
                                $output .= '</div>';
                                $output .= '<div class="elb-crtcsld-txts elb-crtcsld-txtanm-ctn elb-fs">';
                                    $output .= $descriptions;                                    
                                $output .= '</div>';
                                $output .= '<div class="elb-crtcsld-cnt-itm-more elb-fs">';
                                    $output .= '<div class="elb-crtcsld-cnt-link">';
                                        $output .= $links;                                    
                                    $output .= '</div>';
                                $output .= '</div>';
                            $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
        $output .= '</div>';


        echo apply_filters('elb_fullscreencontentslider_output', $output, $settings);
    }

}