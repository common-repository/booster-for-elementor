<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_WooCategories_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-woocategories-widget';
    }
    public function get_title() {
        return esc_html__('Woo Categories', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-woocommerce';
    }
    public function get_categories() {
        return array('booster-addons');
    }
    public function get_script_depends() {
        return [
            'elb-inview',
            'elb-masonry'
        ];
    }
    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        ELB_WooItem_Tab::init_categories($this);       

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout Settings', 'booster-addons'),
            ]
        );
         $this->add_control(
            'woocat_item_height',
            [
                'label' => esc_html__('Item Height', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '50', 
                'dynamic' => ['active' => true],
                'default' => '320',
                'selectors' => ['{{WRAPPER}} .elb-woo-cat-ctn' => 'height: {{VALUE}}px;'],
            ]
        );    
        $this->add_control(
            'woocat_align',
            [
                'label' => esc_html__('Content Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left'
            ]
        );
        $this->add_control(
            'woocat_position',
            [
                'label' => esc_html__('Content Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],                
                'default' => 'middle'
            ]
        );
        $this->add_control(
            'wooitem_hover_effect',
            [
                'label' => esc_html__('Hover Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'zoomin_1'                      => esc_html__('Zoom In 1','booster-addons'),
                    'zoomin_2'                      => esc_html__('Zoom In 2','booster-addons'),
                    'zoomin_3'                      => esc_html__('Zoom In 3','booster-addons'),
                    'zoomout_1'                     => esc_html__('Zoom Out 1','booster-addons'),
                    'zoomout_2'                     => esc_html__('Zoom Out 2','booster-addons'),
                    'zoomout_3'                     => esc_html__('Zoom Out 3','booster-addons'),  
                    'blur_1'                        => esc_html__('Blur 1','booster-addons'),
                    'blur_2'                        => esc_html__('Blur 2','booster-addons'),                 
                ],
                'default' => 'zoomin_1',
            ]
        );
        $this->end_controls_section();
        

        /********************************************
                    STYLING SECTION       
        ********************************************/
        $this->start_controls_section(
            'font_settings',
            [
                'label' => esc_html__('Font Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );            
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'woocat_title_font',
                'label' => esc_html__('Category Title Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 17,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-cat-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'woocat_desc_font',
                'label' => esc_html__('Description Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 13,'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],                               
                'selector' => '{{WRAPPER}} .elb-woo-cat-desc',
            ]
        );
       
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'woocat_slug_font',
                'label' => esc_html__('Slug Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 16,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-cat-slug',
            ]
        );
        $this->end_controls_section();
        //COLOR SETTINGS
        $this->start_controls_section(
            'color_settings',
            [
                'label' => esc_html__('Color Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'content_settings_stylings' );
        $this->start_controls_tab( 'normal_content',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'woocat_title_color',
            [
                'label' => esc_html__('Name Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-title' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'woocat_desc_color',
            [
                'label' => esc_html__('Description Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-desc' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'woocat_slug_color',
            [
                'label' => esc_html__('Slug Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-slug' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'woocat_slug_bg',
            [
                'label' => esc_html__('Slug Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7D66E2',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-slug' => 'background: {{VALUE}};'],
            ]
        );


        

        $this->end_controls_tab();
        $this->start_controls_tab( 'hover_content',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'woocat_title_color_hv',
            [
                'label' => esc_html__('Name Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-ctn:hover .elb-woo-cat-title' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'woocat_desc_color_hv',
            [
                'label' => esc_html__('Description Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-ctn:hover .elb-woo-cat-desc' => 'color: {{VALUE}};'],
            ]
        );

        $this->add_control(
            'woocat_slug_color_hv',
            [
                'label' => esc_html__('Slug Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-slug' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'woocat_slug_bg_hv',
            [
                'label' => esc_html__('Slug Background -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7D66E2',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-slug' => 'background: {{VALUE}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
       

        $this->end_controls_section();

        //Container Styling
        $this->start_controls_section(
            'ctn_styling_settings',
            [
                'label' => esc_html__('Container Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'ctn_settings_stylings' );
        $this->start_controls_tab( 'normal_ctn',
            [
                'label' => esc_html__( 'Normal', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'woocat_ovl',
            [
                'label' => esc_html__('Overlay Bakcground', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-img-ovl' => 'background: {{VALUE}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'woocat_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-woo-cat-insider',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'woocat_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-woo-cat-insider',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'hover_ctn',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'woocat_ovl_hv',
            [
                'label' => esc_html__('Overlay Bakcground -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => 'rgba(0,0,0,0.2)',
                'selectors' => [ '{{WRAPPER}} .elb-woo-cat-ctn:hover .elb-woo-cat-img-ovl' => 'background: {{VALUE}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'woocat_br_hv',
                'label' => esc_html__( 'Container Border -Hover-', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-woo-cat-ctn:hover .elb-woo-cat-insider',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'woocat_bxs_hv',
                'label' => esc_html__('Container Box Shadow -Hover-', 'booster-addons'),
                'fields_options' => ['box_shadow_type' => ['default' =>'yes'],'box_shadow' =>['default' => ['horizontal' => '0','vertical' => '0','blur' => '34','spread' => '5','color' => 'rgba(64, 84, 178, 0.11)']],'box_shadow_position' =>['default' => ' ']],
                'selector' => '{{WRAPPER}} .elb-woo-cat-ctn:hover .elb-woo-cat-insider',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();

        $this->start_controls_section(
            'distances_settings',
            [
                'label' => esc_html__('Distances', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );        
        $this->add_control(
            'woocat_item_margin',
            [
                'label' => esc_html__('Item Margin Bottom', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 
                'dynamic' => ['active' => true],
                'default' => '50',
                'selectors' => ['{{WRAPPER}} .elb-albx-ctn' => 'margin-bottom: {{VALUE}}px;'],
            ]
        );
        $this->add_control(
            'woocat_ctn_padding',
            [
                'label' => esc_html__( 'Content Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '30', 'top' => '20', 'right' => '30', 'bottom' => '20', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-cat-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  

        $this->add_control(
            'woocat_title_mrg',
            [
                'label' => esc_html__( 'Title Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '10', 'right' => '0', 'bottom' => '25', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-cat-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'woocat_desc_mrg',
            [
                'label' => esc_html__( 'Description Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '0', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-cat-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'woocat_slug_mrg',
            [
                'label' => esc_html__( 'Slug Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '0', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-cat-slug' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 

        $this->add_control(
            'woocat_slug_pdg',
            [
                'label' => esc_html__( 'Slug Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '20', 'top' => '7', 'right' => '20', 'bottom' => '7', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-cat-slug' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
       
         

        $this->end_controls_section();
    }
    
   protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $ctn_attr = '';
        $args = array('taxonomy'   => "product_cat", 'order'      => $settings['woocat_order_sort']);
        $ctn_attr .= ' data-columns="'.esc_attr($settings['masonry_columns']).'" data-animation="'.esc_attr($settings['masonry_show_effect']).'" ';
        $ctn_attr .= ($settings['masonry_gutter_enabled'] == 'enabled') ? ' data-gutter-enabled="on" data-gutter="'.esc_attr($settings['masonry_gutter_value']['size']).'" ' : '';
        if($settings['woocat_type'] == 'latest'){
            $args['number'] = $settings['woocat_number'];
        }else{
            $ctn_attr .= ' data-columns="1" data-animation="none" ';
            $args['include'] = $settings['woocat_custom_list'];
        }

        #var_dump($settings['woocat_custom_list']);

        $categories = get_terms($args);
        $output .= '<div class="elb-masonry-boss elb-filter-boss">';
            $output .= '<div class="elb-ss-fk"></div>';
            $output .= '<div class="elb-masonry-list" '.$ctn_attr.'>';
            $key = 0;
            foreach ($categories as $categoryElem) {
                $transition_delay = 'elb-and-'.(($key % $settings['masonry_columns']) + 1);
                $output .= $this->elb_get_category($settings,$categoryElem,$transition_delay);
                #print_r($categoryElem);
                $key++; 
            }          
            $output .= '</div>';    
        $output .= '</div>'; 
        echo apply_filters('elb_woocategories_output', $output, $settings);
    }
    
    function elb_get_category($settings,$categoryElem,$transition_delay){
        $output = '';
        $thumbnail_id = get_term_meta($categoryElem->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        $output .= '<div class="elb-woo-cat-ctn elb-masonry-item '.$transition_delay.'" data-align="'.esc_attr($settings['woocat_align']).'" data-position="'.esc_attr($settings['woocat_position']).'" data-imhover-style="'.esc_attr($settings['wooitem_hover_effect']).'">';
            $output .= '<div class="elb-woo-cat-insider elb-tr-2 elb-masonry-item-insider">';
                $output .= '<div class="elb-woo-cat-img-ctn">';
                    $output .= '<div class="elb-woo-cat-img elb-tr-2 elb-hvim-bg" style="background-image:url('.esc_url($image).')"></div>';
                    $output .= '<div class="elb-woo-cat-img-ovl elb-tr-2"></div>';
                $output .= '</div>';
                $output .= '<div class="elb-woo-cat-content elb-flx-ch-pos">';
                    $output .= '<div class="elb-woo-cat-content-ins elb-fs">';
                       $output .= '<div class="elb-woo-cat-content-item elb-flx-ch-ali elb-fs">';
                            $output .= '<div class="elb-woo-cat-ct-it-ins elb-woo-cat-desc">'.$categoryElem->description.'</div>';
                        $output .= '</div>';
                        $output .= '<div class="elb-woo-cat-content-item elb-flx-ch-ali elb-fs">';
                            $output .= '<div class="elb-woo-cat-ct-it-ins elb-woo-cat-title">'.$categoryElem->name.'</div>';
                        $output .= '</div>';
                        $output .= '<div class="elb-woo-cat-content-item elb-flx-ch-ali elb-fs">';
                            $output .= '<div class="elb-woo-cat-ct-it-ins elb-woo-cat-slug">'.$categoryElem->slug.'</div>';
                        $output .= '</div>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';  
        $output .= '</div>';
        return $output;
    }


}