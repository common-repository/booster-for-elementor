<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_PriceListing_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-pricelisting-widget';
    }
    public function get_title() {
        return esc_html__('Price Listing', 'booster-addons' );
    }
    public function get_icon() {
        return 'elb-icon eicon-price-list';
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
                'label' => esc_html__('List settings', 'booster-addons'),
            ]
        );
        
        $repeater = new Repeater();
        $repeater->add_control(
            'item_image_enabled',
            [
                'label' => esc_html__( 'Enable Image', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
        $repeater->add_control(
            'item_image', 
            [
                'label' => esc_html__( 'Item Image', 'booster-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => Utils::get_placeholder_image_src(),],
                'condition' => ['item_image_enabled' => [ 'yes' ]],
            ]
        );
        $repeater->add_control(
            'item_title', 
            [
                'label' => esc_html__( 'Item Title', 'booster-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Booster Addons',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Title Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        );
        $repeater->add_control(
            'item_content',
            [
                'label' => esc_html__( 'Item Info Content', 'booster-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'A wonderful serenity has taken possession of my entire soul.',
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            'item_price',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Item Price', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '50',
            ]
        ); 
        $repeater->add_control(
            'item_price_unit',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Item Price Unit', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => '$',
            ]
        ); 
        $repeater->add_control(
            'item_discount_enabled',
            [
                'label' => esc_html__( 'Enable Discount', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $repeater->add_control(
            'item_discount',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Original Discount Price', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'condition' => ['item_discount_enabled' => [ 'yes' ]],
                'default' => '10',
            ]
        ); 
        $repeater->add_control(
            'ribbon_enabled',
            [
                'label' => esc_html__( 'Enable Ribbon', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true
            ]
        );
        $repeater->add_control(
            'ribbon_text', 
            [
                'label' => esc_html__( 'Ribbon Text', 'booster-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'HOT',
                'label_block' => true,
                'condition' => ['ribbon_enabled' => [ 'yes' ]
                ],
            ]
        );
        
       $repeater->add_control(
            'ribbon_color',
            [
                'label' => esc_html__('Ribbon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'condition' => ['ribbon_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-prl-ribbon' => 'color: {{VALUE}};'],
            ]
        );
       $repeater->add_control(
            'ribbon_background_color',
            [
                'label' => esc_html__('Ribbon Background Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'condition' => ['ribbon_enabled' => ['yes']],
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-prl-ribbon' => 'background-color: {{VALUE}};'],
            ]
        );
       $repeater->add_control(
            'ribbon_border_radius',
            [
                'label' => esc_html__( 'Ribbon Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-prl-ribbon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        
        

        $this->add_control(
            'list',
            [
                'label' => esc_html__( 'Items List', 'booster-addons' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['item_image' => ['url' => BOOSTER_ADDONS_URL_IMAGES.'prc1.png'], 'item_title' => 'King Hamburger'],
                    ['item_image' => ['url' => BOOSTER_ADDONS_URL_IMAGES.'prc2.png'], 'item_title' => 'Cheese Burger'],                    
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();

        /********************************************
                    STYLING SECTION       
        ********************************************/
        //-----------------Image Styling----------------             
        $this->start_controls_section(
            'image_settings',
            [
                'label' => esc_html__('Image Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'image_width',
            [
                'label' => esc_html__('Image Width', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'dynamic' => ['active' => true],
                'min' => '30', 
                'default' => '60',
                'selectors' => ['{{WRAPPER}} .elb-prl-img img' => 'width: {{VALUE}}px;',
                ],
            ]
        );
        $this->end_controls_section();
        //-----------------Position Styling----------------  
        $this->start_controls_section(
            'positioning_settings',
            [
                'label' => esc_html__('Positioning Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'item_position',
            [
                'label' => esc_html__('Item Layouts', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'separator' => 'before',
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],
                'default' => 'left',
            ]
        );
        $this->add_control(
            'ribbon_position',
            [
                'label' => esc_html__('Ribbon Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => true,
                'separator' => 'before',
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],                   
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],
                'default' => 'right',
            ]
        );
        $this->end_controls_section();
        //-----------------Typography Styling---------------- 
        $this->start_controls_section(
            'typography_settings',
            [
                'label' => esc_html__('Typography', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_styling',
            [
                'label' => esc_html__('Title Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_font',
                'label' => esc_html__('Title Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prl-title span',
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'booster-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#dd3333',
                'selectors' => [
                    '{{WRAPPER}} .elb-prl-title span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'info_content_styling',
            [
                'label' => esc_html__('Info Content Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_content_font',
                'label' => esc_html__('Info Content Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'line_height' => ['default' =>['size' => 1.5,'unit' => 'em']],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prl-info',                
            ]
        ); 
        $this->add_control(
            'info_content_color',
            [
                'label' => esc_html__( 'Info Content Color', 'booster-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [
                    '{{WRAPPER}} .elb-prl-info' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'price_styling',
            [
                'label' => esc_html__('Price Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_font',
                'label' => esc_html__('Price Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prl-price',                
            ]
        ); 
        $this->add_control(
            'price_color',
            [
                'label' => esc_html__( 'Price Color', 'booster-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#dd3333',
                'selectors' => [
                    '{{WRAPPER}} .elb-prl-price' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'unit_styling',
            [
                'label' => esc_html__('Unit Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'unit_font',
                'label' => esc_html__('Unit Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prl-unit',                
            ]
        ); 
        $this->add_control(
            'unit_color',
            [
                'label' => esc_html__( 'Unit Color', 'booster-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#dd3333',
                'selectors' => [
                    '{{WRAPPER}} .elb-prl-unit' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'discount_styling',
            [
                'label' => esc_html__('Discount Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'discount_font',
                'label' => esc_html__('Discount Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prl-discount',                
            ]
        ); 
        $this->add_control(
            'discount_color',
            [
                'label' => esc_html__( 'Discount Color', 'booster-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#aaa',
                'selectors' => [
                    '{{WRAPPER}} .elb-prl-discount' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'line_styling',
            [
                'label' => esc_html__('Line Styling', 'booster-addons'),
                'separator' => 'before',
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'line_color',
            [
                'label' => esc_html__( 'Line color', 'booster-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#888',
                'selectors' => [
                    '{{WRAPPER}} .elb-prl-line' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'ribbon_styling',
            [
                'label' => esc_html__('Ribbon Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'ribbon_font',
                'label' => esc_html__('Ribbon Typography', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 12,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-prl-ribbon',
            ]
        );
        $this->end_controls_section();
        //-----------------Distances Styling---------------- 
        $this->start_controls_section(
            'distance_settings',
            [
                'label' => esc_html__('Distances Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'item_mrg',
            [
                'label' => esc_html__( 'Item Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '20','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prl-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'image_mrg',
            [
                'label' => esc_html__( 'Image Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '15','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prl-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'title_mrg',
            [
                'label' => esc_html__( 'Title Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prl-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'info_mrg',
            [
                'label' => esc_html__( 'Info Content Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prl-bottom' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'ribbon_mrg',
            [
                'label' => esc_html__( 'Ribbon Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '10','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prl-ribbon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'ribbon_padding',
            [
                'label' => esc_html__( 'Ribbon Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'default' => ['left' => '6','top' => '2','right' => '6','bottom' => '2','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-prl-ribbon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_section();
    }


    protected function render() {

    $settings = $this->get_settings_for_display();
    

    $output = '';
    if ( $settings['list'] ) :
            foreach ( $settings['list'] as $item ) :    
                    $title = $titleOutput = $imageSection = $ribbonOutput = $ribbonPosition = $discountOutput = '';
                    $title = wp_kses_post($item['item_title']);
                    $title = elb_render_elementor_link($item['link'],$title);
                    $titleOutput = '<div class="elb-prl-title"><span>'.$title.'</span></div>';
                    if($item['ribbon_enabled'] == 'yes'):
                        $ribbonOutput = '<div class="elb-prl-ribbon">'.wp_kses_post($item['ribbon_text']).'</div>';
                        $titleOutput = '<div class="elb-prl-title">';
                            $titleOutput .= ($settings['ribbon_position'] == 'left') ? $ribbonOutput : '';
                            $titleOutput .= '<span>'.$title.'</span>';
                            $titleOutput .= ($settings['ribbon_position'] == 'right') ? $ribbonOutput : '';
                        $titleOutput .= '</div>';
                    endif;
    
                    if($item['item_image_enabled'] == 'yes'):
                        $imageSection = '<div class="elb-prl-img"><img src="'.esc_url($item['item_image']['url']).'" /></div>';
                    endif;
                    
                    if($item['item_discount_enabled'] == 'yes'):
                        $discountOutput = '<div class="elb-prl-discount">'.wp_kses_post($item['item_discount']).''.wp_kses_post($item['item_price_unit']).'</div>';
                    endif;

                    
                

                    $output .= '<div class="elb-prl-list elementor-repeater-item-'.$item['_id'].'" data-image="'.esc_attr($item['item_image_enabled']).'" data-align="'.esc_attr($settings['item_position']).'">';
                        $output .= $imageSection;
                        $output .= '<div class="elb-prl-content elb-fs">';
                            $output .= '<div class="elb-prl-top">';
                                $output .= $titleOutput;
                                if ($settings['item_position'] != 'center'):
                                    $output .=  '<div class="elb-prl-line"></div>';
                                    $output .=  $discountOutput;
                                    $output .=  '<div class="elb-prl-price">'.wp_kses_post($item['item_price']).'</div>';
                                    $output .=  '<div class="elb-prl-unit">'.wp_kses_post($item['item_price_unit']).'</div>';
                                endif; 
                            $output .=  '</div>';
                            $output .=  '<div class="elb-prl-bottom">';
                                $output .= '<span class="elb-prl-info">'.wp_kses_post($item['item_content']).'</span>';
                            $output .= '</div>';
                            if ($settings['item_position'] == 'center'):
                                $output .= '<div class="elb-prl-price-center elb-fs">';
                                    $output .=  $discountOutput;
                                    $output .=  '<div class="elb-prl-price">'.wp_kses_post($item['item_price']).'</div>';
                                    $output .=  '<div class="elb-prl-unit">'.wp_kses_post($item['item_price_unit']).'</div>';
                                $output .=  '</div>';
                            endif; 
                        $output .= '</div>';
                    $output .= '</div>';
            endforeach;
    endif;
   
    echo apply_filters('elb_pricelisting_output', $output, $settings);

    }

}