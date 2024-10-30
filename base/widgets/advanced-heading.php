<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Heading_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-heading-widget';
    }
    public function get_title() {
        return esc_html__('Advanced Heading', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-heading';
    }

    public function get_categories() {
        return array('booster-addons');
    }
   
    public function get_script_depends() {
        return [
            'elb-advanced-heading'
        ];
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
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading Title', 'booster-addons'),
                'label_block' => true,
                'default' => esc_html__('Heading Title', 'booster-addons'),
               
            ]
        );
        $this->add_control(
            'sub_heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub Heading', 'booster-addons'),
                'label_block' => true,
                'default' => '',
                'dynamic' => ['active' => true],
            ]
        );
        $this->add_control(
            'short_text',
            [
                'type' => Controls_Manager::WYSIWYG,
                'label' => esc_html__('Short Text', 'booster-addons'),
                'label_block' => true,
                'default' => '',
                'dynamic' => ['active' => true],
            ]
        );
        //-----------------Settings Sub Content----------------
        $this->add_control(
            'heading_settings',
            [
                'label' => esc_html__('Settings', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Title Link', 'booster-addons'),
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
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{align}};',
                ],
            ]
        );
       

        $this->end_controls_section();

        /********************************************
                    STYLE SECTION       
        ********************************************/

        //-----------------Title Styling Sub Content----------------             
        $this->start_controls_section(
            'section_title_styling',
            [
                'label' => esc_html__('Title Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 50,'unit' => 'px']],
                    'font_weight' => ['default' => '800'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-heading-title',
            ]
        );

        //New Title Styling Colors
        $this->add_control(
            'heading_styling',
            [
                'label' => esc_html__('Heading Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'default' => esc_html__('Default Color', 'booster-addons'),
                    'bg_img' => esc_html__('Background Image', 'booster-addons'),
                    'blurred' => esc_html__('Blurred Style', 'booster-addons'),
                    #'dashed_shadow' => esc_html__('Dashed Shadow', 'booster-addons'),
                    'shining' => esc_html__('Shining', 'booster-addons'),
                    'opening_type' => esc_html__('Opening Letter Type', 'booster-addons'),
                ],
                'default' => 'default',
            ]
        );
        $this->add_control(
            'heading_blurred_type',
            [
                'label' => esc_html__('Blurred Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['heading_styling' => ['blurred']],
                'options' => [
                    'animation_blurred' => esc_html__('Animation Blur', 'booster-addons'),                    
                    'hover_blurred' => esc_html__('Hover to Blur', 'booster-addons'),                    
                    'random_blurred' => esc_html__('Random Blur', 'booster-addons'),                    
                ],
                'default' => 'animation_blurred',
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'title_color',
                'label' => esc_html__('Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-heading-title',
                'condition' => ['heading_styling' => ['default']]
            ]
        );        
        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin', 'booster-addons' ),
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
                    '{{WRAPPER}} .elb-heading-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );        
        $this->end_controls_section();
        
        //**********Heading Image Background
        $this->start_controls_section(
            'heading_bg_img',
            [
                'label' => esc_html__('Heading Text Image', 'booster-addons'),
                'condition' => ['heading_styling' => ['bg_img']],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'heading_bg_img',
                'label' => esc_html__( 'Heading Background Image', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'condition' => ['heading_styling' => ['bg_img']],
                'types' => [ 'classic'],
                'fields_options' => ['background' => ['default' => 'classic'],'image' =>['default' =>['url' => BOOSTER_ADDONS_URL_IMAGES.'inter3.jpg']], 'position' => ['default' =>'center center'],'size' =>['default' =>'cover'], 'color' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-heading-title',
            ]
        );
        $this->end_controls_section();
        

        //**********Heading Blurred
        $this->start_controls_section(
            'heading_blurred_style',
            [
                'label' => esc_html__('Heading Blurred', 'booster-addons'),
                'condition' => ['heading_styling' => ['blurred']],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_blurred_txt_color',
            [
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['blurred']],
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => ['{{WRAPPER}} .elb-heading-title' => 'color: {{VALUE}}; --current-color: {{VALUE}};']
            ]
        );
        $this->add_control(
            'heading_blur_color',
            [
                'label' => esc_html__('Blur Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['blurred'],'heading_blurred_type!' => 'random_blurred'],
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => ['{{WRAPPER}} .elb-heading-title' => '--shadow-color: {{VALUE}};']
            ]
        );
        $this->add_control(
            'heading_blur_shadow_value',
            [
                'label' => esc_html__('Blur Shadow Value', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '10', 'max' => '500',  'step' => '10', 
                'condition' => ['heading_styling' => ['blurred']],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-heading-title' => '--shadow-value: {{VALUE}}px;'],
                'default' => '72'
            ]
        );
        $this->add_control(
            'heading_blurred_holdtime',
            [
                'label' => esc_html__('Animation Wait Time (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '3', 'max' => '30',  'step' => '1', 
                'condition' => ['heading_styling' => ['blurred'],'heading_blurred_type' => ['animation_blurred']],
                'dynamic' => ['active' => true],
                'default' => '5'
            ]
        );
        $this->add_control(
            'heading_blurred_holdtime_random',
            [
                'label' => esc_html__('Animation Wait Time (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '.1', 'max' => '10',  'step' => '.11', 
                'condition' => ['heading_styling' => ['blurred'],'heading_blurred_type' => ['random_blurred']],
                'dynamic' => ['active' => true],
                'default' => '.2'
            ]
        );


        
        $this->end_controls_section();


        //**********Heading Shining
        $this->start_controls_section(
            'heading_shining_style',
            [
                'label' => esc_html__('Heading Shining', 'booster-addons'),
                'condition' => ['heading_styling' => ['shining']],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_shining_txt_color',
            [
                'label' => esc_html__('Heading Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['shining']],
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
            ]
        );
        $this->add_control(
            'heading_shining_color',
            [
                'label' => esc_html__('Shining Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['shining']],
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
            ]
        );
        $this->add_control(
            'heading_shining_speed',
            [
                'label' => esc_html__('Animation Shining Speed', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '.2', 'max' => '30',  'step' => '1', 
                'condition' => ['heading_styling' => ['shining']],
                'dynamic' => ['active' => true],
                'default' => '2'
            ]
        );
        $this->add_control(
            'heading_shining_delay',
            [
                'label' => esc_html__('Animation Shining Delay', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'description' => esc_html__('This delay is only for the start of the animation and not for each iteration.'),
                'min' => '.2', 'max' => '30',  'step' => '1', 
                'condition' => ['heading_styling' => ['shining']],
                'dynamic' => ['active' => true],
                'default' => '1'
            ]
        );
        $this->end_controls_section();


        //**********Heading Opening Type
        $this->start_controls_section(
            'heading_openingtype_style',
            [
                'label' => esc_html__('Opening Type', 'booster-addons'),
                'condition' => ['heading_styling' => ['opening_type']],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_opening_type_color',
            [
                'label' => esc_html__('Heading Letter Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['opening_type']],
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => ['{{WRAPPER}} .elb-hd-letter:before' => 'color: {{VALUE}};'],

            ]
        );
        $this->add_control(
            'heading_opening_type_shadow_color',
            [
                'label' => esc_html__('Heading Shadow Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['opening_type']],
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(12,12,12,0.23)',
                'selectors' => ['{{WRAPPER}} .elb-hd-letter:after' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'heading_opening_type_base_color',
            [
                'label' => esc_html__('Heading Base Color', 'booster-addons'),
                'condition' => ['heading_styling' => ['opening_type']],
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'selectors' => ['{{WRAPPER}} .elb-hd-letter' => 'color: {{VALUE}};'],
            ]
        );

        $this->end_controls_section();

        


        //**********Heading Shadow
        $this->start_controls_section(
            'heading_shadow_section',
            [
                'label' => esc_html__('Heading Shadow', 'booster-addons'),
                'condition' => ['heading_styling' => ['default','shining']],
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_shadow_type',
            [
                'label' => esc_html__('Heading Shadow Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['heading_styling' => ['default','shining']],
                'options' => [
                    'default' => esc_html__('Normal', 'booster-addons'),
                    'advanced' => esc_html__('Advanced Long Shadow', 'booster-addons'),
                ],
                'default' => 'default',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-heading-title',
                'condition' => ['heading_shadow_type' => 'default','heading_styling' => ['default','shining']],
            ]
        );
        $repeater = new Repeater();   
        $repeater->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow_item',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
                'selector' => '{{WRAPPER}} .elb-heading-title',
            ]
        ); 
        $this->add_control(
            'shadows_list',
            [
                'label' => esc_html__('Shadows List', 'booster-addons'),
                'type' => Controls_Manager::REPEATER,
                'condition' => ['heading_shadow_type' => 'advanced','heading_styling' => ['default','shining']],
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['title_shadow_item' => []]
                ],
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
                'selector' => '{{WRAPPER}} .elb-heading-subheading',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_heading_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-heading-subheading',
            ]
        );
        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'sub_heading_shadow',
                'label' => esc_html__('Text Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-heading-subheading',
            ]
        );

        $this->add_control(
            'sub_heading_margin',
            [
                'label' => esc_html__( 'Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '15','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-heading-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',],
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
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-heading-shorttext' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'short_text_font',
                'label' => esc_html__('Typography', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-heading-shorttext',
            ]
        );
        $this->add_control(
            'short_text_margin',
            [
                'label' => esc_html__( 'Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '25','isLinked' => false],
                'selectors' => [
                    '{{WRAPPER}} .elb-heading-shorttext' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );        
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $heading_style = $title_ctn_attrs = '';        
        
        //Long Shadow Heading        
        if($settings['shadows_list'] && $settings['heading_shadow_type'] == 'advanced' && in_array($settings['heading_styling'] , ['default','shining'])):
            $shadows_array = [];
            foreach($settings['shadows_list'] as $shadow):
                $the_shadow = $shadow['title_shadow_item_text_shadow'];
                $shadow_val = $the_shadow['horizontal'].'px '.$the_shadow['vertical'].'px '.$the_shadow['blur'].'px '.$the_shadow ['color'];
                array_push($shadows_array, $shadow_val);
            endforeach;
           $heading_style .=  'text-shadow:'.implode(', ', $shadows_array).';'; 
        endif;

        //Shining Heading Type
        if($settings['heading_styling'] == 'shining'):
           $txt_clr = $settings['heading_shining_txt_color']; 
           $shn_clr = $settings['heading_shining_color']; 
           $heading_style .=  '--animation-speed:'.$settings['heading_shining_speed'].'s;--animation-delay:'.$settings['heading_shining_delay'].'s; background: '.$txt_clr.' -webkit-gradient(linear, left top, right top, from('.$txt_clr.'), to('.$txt_clr.'), color-stop(0.5, '.$shn_clr.')) 0 0 no-repeat;'; 
        endif;

        $the_title = $settings['title'];
        
        //Opening Letter Type
        if(in_array($settings['heading_styling'],['opening_type','blurred'])):
            $title_ctn_attrs .= ($settings['heading_styling'] == 'blurred') ? ' data-blur-holdtime ="'.esc_attr($settings['heading_blurred_type'] == 'random_blurred' ? $settings['heading_blurred_holdtime_random'] : $settings['heading_blurred_holdtime']).'" data-blur-type="'.esc_attr($settings['heading_blurred_type']).'" ' : '';
            $letters_html = '';   
            $title_array = str_split($settings['title']);
            foreach ($title_array as $key => $letter):    
                $key = $key+1;                
                $letters_html .='<span class="elb-hd-letter" data-letter-index="'.esc_attr($key+1).'" data-letter="'.esc_attr($letter).'">'.$letter.'</span>';
            endforeach;
            $the_title = $letters_html;
        endif;

        $output .= '<div class="elb-heading elb-widget">';


            $title = '<' . esc_html($settings['title_tag']) . ' class="elb-heading-title elb-tr-3" '.$title_ctn_attrs.' style="'.$heading_style.'" data-heading-styling="'.esc_attr($settings['heading_styling']).'">' . wp_kses_post($the_title) . '</' . esc_html($settings['title_tag']) . '>';
            $output .= elb_render_elementor_link($settings['link'], $title);

            if(!empty($settings['sub_heading']))
                $output .= '<' . esc_html($settings['sub_heading_tag']) . ' class="elb-heading-subheading">' . wp_kses_post($settings['sub_heading']) . '</' . esc_html($settings['sub_heading_tag']) . '>';
            
            if(!empty($settings['short_text']))
                $output .= '<div class="elb-heading-shorttext">' . $settings['short_text'] . '</div>';
                        
        $output .= '</div>';

        echo apply_filters('elb_heading_output', $output, $settings);
    }

}