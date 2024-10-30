<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_WooListProduct_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-woolistproduct-widget';
    }
    public function get_title() {
        return esc_html__('Woo List Products', 'booster-addons');
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
        ELB_WooItem_Tab::init($this);       

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout Settings', 'booster-addons'),
            ]
        );      
        $this->add_control(
            'wooitem_btn_txt',
            [
                'label' => esc_html__('Button Text', 'booster-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Add to Cart',
            ]
        );
        $this->add_control(
            'wooitem_cart_icon',
            [
                'label' => esc_html__('Cart Icon', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_woo_cart_icon(),
                'default' => 'shopping_cart',
            ]
        );
        $this->add_control(
            'wooitem_align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center'
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
                'name' => 'wooitem_name_font',
                'label' => esc_html__('Product Name Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wooitem_category_font',
                'label' => esc_html__('Product Categories Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 13,'unit' => 'px']],
                    'font_weight' => ['default' => '400'],
                    'typography' => ['default' => 'custom'],
                ],                               
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-category',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wooitem_price_font',
                'label' => esc_html__('Product Price Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 13,'unit' => 'px']],
                    'font_weight' => ['default' => '600'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-price',           
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wooitem_btn_font',
                'label' => esc_html__('Product Button Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 13,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-list-btn',
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
            'wooitem_name_color',
            [
                'label' => esc_html__('Name Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-title' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'wooitem_category_color',
            [
                'label' => esc_html__('Categories Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-category' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'wooitem_price_color',
            [
                'label' => esc_html__('Price Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-price' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'wooitem_stars_color',
            [
                'label' => esc_html__('Stars Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F6DF5D',
                'selectors' => [ '{{WRAPPER}} .elb-woo-rating .star-rating span::before, {{WRAPPER}} .elb-woo-rating .star-rating::before' => 'color: {{VALUE}};'],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab( 'hover_content',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'wooitem_name_color_hv',
            [
                'label' => esc_html__('Name Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-ctn:hover .elb-woo-list-pr-title' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'wooitem_category_color_hv',
            [
                'label' => esc_html__('Categories Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-ctn:hover .elb-woo-list-pr-category' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'wooitem_price_color_hv',
            [
                'label' => esc_html__('Price Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-ctn:hover .elb-woo-list-pr-price' => 'color: {{VALUE}};'],
            ]
        );
        $this->add_control(
            'wooitem_stars_color_hv',
            [
                'label' => esc_html__('Stars Color -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#F6DF5D',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-ctn:hover .elb-woo-rating .star-rating span::before, {{WRAPPER}} .elb-woo-list-pr-ctn:hover .elb-woo-rating .star-rating::before' => 'color: {{VALUE}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->add_control(
            'wooitem_icon_cart_color',
            [
                'label' => esc_html__('Cart Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'separator' => 'before',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-cart-icon' => 'color: {{VALUE}};'],            
            ]
        );
        $this->add_control(
            'wooitem_icon_preview_color',
            [
                'label' => esc_html__('Preview Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-icon-preview' => 'color: {{VALUE}};'],            
            ]
        );
        $this->add_control(
            'wooitem_btn_color',
            [
                'label' => esc_html__('Button Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-btn' => 'color: {{VALUE}};'],            
            ]
        );
        
        $this->add_control(
            'wooitem_cart_icon_size',
            [
                'label' => esc_html__('Cart Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '15',         
            ]
        );
        $this->add_control(
            'wooitem_preview_icon_size',
            [
                'label' => esc_html__('Preview Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '14',         
            ]
        );

        
        

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
            'wooitem_bg',
            [
                'label' => esc_html__('Container Bakcground', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-content' => 'background: {{VALUE}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wooitem_br',
                'label' => esc_html__( 'Container Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-ctn',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wooitem_bxs',
                'label' => esc_html__('Container Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-ctn',
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'hover_ctn',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_control(
            'wooitem_bg_hv',
            [
                'label' => esc_html__('Container Bakcground -Hover-', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [ '{{WRAPPER}} .elb-woo-list-pr-ctn:hover .elb-woo-list-pr-content' => 'background: {{VALUE}};'],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wooitem_br_hv',
                'label' => esc_html__( 'Container Border -Hover-', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-ctn:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wooitem_bxs_hv',
                'label' => esc_html__('Container Box Shadow -Hover-', 'booster-addons'),
                'fields_options' => ['box_shadow_type' => ['default' =>'yes'],'box_shadow' =>['default' => ['horizontal' => '0','vertical' => '0','blur' => '34','spread' => '5','color' => 'rgba(64, 84, 178, 0.11)']],'box_shadow_position' =>['default' => ' ']],
                'selector' => '{{WRAPPER}} .elb-woo-list-pr-ctn:hover',
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
            'wooitem_item_margin',
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
            'wooitem_ctn_padding',
            [
                'label' => esc_html__( 'Content Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '20', 'right' => '0', 'bottom' => '28', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-list-pr-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  

        $this->add_control(
            'wooitem_name_mrg',
            [
                'label' => esc_html__( 'Name Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '2', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-list-pr-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'wooitem_category_mrg',
            [
                'label' => esc_html__( 'Category Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '8', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-list-pr-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'wooitem_price_mrg',
            [
                'label' => esc_html__( 'Price Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '10', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-list-pr-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        ); 
        $this->add_control(
            'wooitem_star_mrg',
            [
                'label' => esc_html__( 'Rating Stars Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '15', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-list-pr-stars' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  
        $this->add_control(
            'wooitem_btn_mrg',
            [
                'label' => esc_html__( 'Button Margins', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0', 'top' => '0', 'right' => '0', 'bottom' => '0', 'isLinked' => false ],
                'selectors' => ['{{WRAPPER}} .elb-woo-list-pr-actions' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );  

        $this->end_controls_section();
    }
    
   protected function render() {
        $settings = $this->get_settings_for_display();
        $output = $ctn_attr = '';
        if($settings['wooitem_type'] == 'list'){
            $ctn_attr .= ' data-columns="'.esc_attr($settings['masonry_columns']).'" data-animation="'.esc_attr($settings['masonry_show_effect']).'" ';
            $ctn_attr .= ($settings['masonry_gutter_enabled'] == 'enabled') ? ' data-gutter-enabled="on" data-gutter="'.esc_attr($settings['masonry_gutter_value']['size']).'" ' : '';
        }else{
            $ctn_attr .= ' data-columns="1" data-animation="none" ';
        }

        $query_options = array('post_type'=> 'product','posts_per_page' => $settings['wooitem_number'] ,'orderby'=> $settings['wooitem_order_by'] , 'order' => $settings['wooitem_order_sort']);
        if($settings['wooitem_type'] == 'single'):
            $settings['masonry_columns'] = 1;
            $single_product_id = ($settings['wooitem_single_id'] != "") ? $settings['wooitem_single_id'] : 1;
            $query_options = array('p' => $single_product_id , 'post_type'=> 'product' );
        endif;
        
        #query_posts($query_options); 
        $products = new \WP_Query( $query_options );

        $output .= '<div class="elb-masonry-boss elb-filter-boss">';
            $output .= $this->elb_get_output_fs_slider($settings);
            $output .= '<div class="elb-ss-fk"></div>';
            $output .= '<div class="elb-masonry-list" '.$ctn_attr.'>';
                $key = 0;
                if ($products->have_posts()) : 
                    while ($products->have_posts()) : $products->the_post();
                        $product = new \WC_Product(get_the_ID());
                        $attachment_ids = $product->get_gallery_image_ids();
                        $categories_list = [];
                        foreach (get_the_terms($product->get_id(), 'product_cat') as $cat) {
                            array_push($categories_list, $cat->name) ;
                        }
                        $productContent = [
                            'transition_delay' => 'elb-and-'.(($key % $settings['masonry_columns']) + 1),
                            'id' => $product->get_id(),
                            'name' => $product->get_name(),
                            'price' => $product->get_price_html(),
                            'link' => '<a class="elb-fs-a" href="'.esc_url(get_the_permalink()).'"></a>',
                            'rating' => wc_get_rating_html($product->get_average_rating(), $product->get_rating_count()),                        
                            'image_1' => wp_get_attachment_url(get_post_thumbnail_id()),
                            'image_2' => ($attachment_ids) ? wp_get_attachment_url($attachment_ids[0]) : false,
                            'category' => implode("-", $categories_list),
                            'attachements' => ($attachment_ids) ? $attachment_ids : false,
                            'ajax_link' => apply_filters( 'woocommerce_loop_add_to_cart_link',
                                        sprintf( '<a  href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="ajax_add_to_cart elb-fs-add-cart elb-fs-a %s product_type_%s"></a>',
                                            $product->add_to_cart_url() , esc_attr( $product->get_id() ), esc_attr( $product->get_sku() ),    esc_attr( isset( $quantity ) ? $quantity : 1 ),
                                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',  esc_attr( $product->get_type() )
                                        ),
                                        $product )
                        ];
                        $key++; 
                        $output .= $this->elb_get_output_container($settings,$productContent);                          
                    endwhile;
                    wp_reset_postdata();
                endif;
        $output .= '</div>';    
        $output .= '</div>';    
        echo apply_filters('elb_woolistproduct_output', $output, $settings);
    }

    function elb_get_output_container($settings,$productContent){
        $output = '';
        $sld_attr = [];
        array_push($sld_attr, $productContent['image_1']);
        if(is_array($productContent['attachements'])){
            foreach($productContent['attachements'] as $img) {
                array_push($sld_attr, wp_get_attachment_url($img));
            }
        }

        $output .= '<div class="elb-woo-list-pr-ctn elb-masonry-item '.$productContent['transition_delay'].'" data-align="'.esc_attr($settings['wooitem_align']).'">';
            $output .= '<div class="elb-woo-list-pr-ins elb-tr-3 elb-masonry-item-insider">';
                $output .= '<div class="elb-woo-list-pr-img">'.$productContent['link'];
                    $output .= '<img class="elb-woo-list-img1" src="'.esc_url($productContent['image_1']).'">';
                    $output .= ($productContent['image_2']) ? '<img class="elb-woo-list-img2 elb-tr-3" src="'.esc_url($productContent['image_2']).'">' : '';
                $output .= '</div>';        
                $output .= '<div class="elb-woo-list-pr-content elb-fs">';
                    $output .= '<div class="elb-woo-list-pr-title elb-fs">'.$productContent['link'].''.$productContent['name'].'</div>';
                    $output .= '<div class="elb-woo-list-pr-category elb-fs">'.$productContent['category'].'</div>';
                    $output .= '<div class="elb-woo-list-pr-price elb-fs">'.$productContent['price'].'</div>';
                    $output .= '<div class="elb-woo-list-pr-stars elb-woo-rating elb-fs elb-flx-jstc">'.$productContent['rating'].'</div>';
                    $output .= '<div class="elb-woo-list-pr-actions elb-fs elb-flx-jstc">';
                        $output .= '<div class="elb-woo-list-pr-act-ins elb-tr-3">';
                            $output .= '<div class="elb-woo-list-pr-btn-link">'.$productContent['ajax_link'];
                                $output .= '<div class="elb-woo-list-icon elb-woo-list-cart-icon elb-tr-2">'.CertainDev_Icons::get_icon($settings['wooitem_cart_icon'],'',$settings['wooitem_cart_icon_size']).'</div>';
                                $output .= '<div class="elb-woo-list-btn elb-tr-2">'.$settings['wooitem_btn_txt'].'</div>';
                            $output .= '</div>';        
                            $output .= '<div class="elb-woo-list-icon elb-woo-list-icon-preview elb-tr-3" onclick="elb_woolist_slider_init(this)" data-slider="'.esc_attr(json_encode($sld_attr)).'">'.CertainDev_Icons::get_icon('eye2','',$settings['wooitem_preview_icon_size']).'</div>';
                        $output .= '</div>';        
                    $output .= '</div>';        
                $output .= '</div>';        
            $output .= '</div>';        
        $output .= '</div>'; 
        return $output;
    }



    function elb_get_output_fs_slider($settings){
        $output = '';
        $output .= '<div class="elb-woo-sld-ctn elb-fs-elem elb-tr-2" data-situation="inactive" data-slide="0">';
            $output .= '<div class="elb-woo-sld-ins">';
                $output .= '<div class="elb-woo-sld-wrp">';
                    $output .= '<div class="elb-woo-sld-content">';
                        $output .= '<div class="elb-woo-sld-cls elb-tr-2" onclick="elb_escape_clicked(event)"></div>';
                        $output .= '<div class="elb-woo-sld-nav elb-woo-sld-prev" data-situation="inactive" onclick="elb_woolist_slider_move(this,\'prev\')"><div class="elb-woo-sld-nav-btn"></div></div>';
                        $output .= '<div class="elb-woo-sld-thim"></div>';
                        $output .= '<div class="elb-woo-sld-nav elb-woo-sld-nxt" data-situation="inactive" onclick="elb_woolist_slider_move(this,\'next\')"><div class="elb-woo-sld-nav-btn"></div></div>';
                    $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="elb-woo-sld-imgs-list"></div>';                
            $output .= '</div>';
        $output .= '</div>';
        return $output;

    }

}