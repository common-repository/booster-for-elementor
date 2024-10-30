<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_WooModernProduct_Widget extends Widget_Base {
	public function get_name() {
        return 'elb-woomodernproduct-widget';
    }
    public function get_title() {
        return esc_html__('Woo Modern Products', 'booster-addons');
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
            'wooitem_style',
            [
                'label' => esc_html__('Layout Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'style_1' => esc_html__('Style 1', 'booster-addons'),
                    'style_2' => esc_html__('Style 2', 'booster-addons'),
                    'style_3' => esc_html__('Style 3', 'booster-addons'),
                ],
                'default' => 'style_1',
            ]
        );
        $this->add_control(
            'wooitem_style2_btn_txt',
            [
                'label' => esc_html__('Button Text', 'booster-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Add to Cart',
                'condition' => ['wooitem_style' => ['style_2']],                
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
                'condition' => ['wooitem_style' => ['style_1','style_2']],                
                'default' => 'center'
            ]
        );
        $this->add_control(
            'wooitem_cart_icon',
            [
                'label' => esc_html__('Cart Icon', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_woo_cart_icon(),
                'condition' => ['wooitem_style' => ['style_1','style_3']],                
                'default' => 'shop_n3',
            ]
        );
        $this->add_control(
            'wooitem_cart_icon_size',
            [
                'label' => esc_html__('Cart Icon Size', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '15',
                'default' => '18',
                'condition' => ['wooitem_style' => ['style_1','style_3']],                              
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
                    'font_size' => ['default' =>['size' => 18,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'condition' => ['wooitem_style' => ['style_2','style_3']],                
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-title',
            ]
        );
    	$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wooitem_name_font_sml',
                'label' => esc_html__('Product Name Typography (small)', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],                               
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-title-sml, {{WRAPPER}} .elb-woo-mdrn-content[data-style="style_1"] .elb-woo-mdrn-title',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wooitem_price_font',
                'label' => esc_html__('Product Price Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-price',           
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'wooitem_btn_font',
                'label' => esc_html__('Product Button Typography', 'booster-addons'),
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-btn',
                'condition' => ['wooitem_style' => ['style_2']],                
            ]
        );


        $this->end_controls_section();
    	
    	$this->start_controls_section(
            'color_settings',
            [
                'label' => esc_html__('Color Settings', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'wooitem_name_color',
                'label' => esc_html__('Name Color', 'booster-addons'),
                'condition' => ['wooitem_style' => ['style_2','style_3']],                
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-title',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],
            ]
        );
         $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'wooitem_name_color_sml',
                'label' => esc_html__('Name Color (small)', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-title-sml,{{WRAPPER}} [data-style="style_1"] .elb-woo-mdrn-title span',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],               	
            ]
        );
        $this->add_group_control(
            Group_Control_ELB_Text_Gradient::get_type(),
            [
                'name' => 'wooitem_price_color',
                'label' => esc_html__('Price Color', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-price,{{WRAPPER}} .elb-woo-mdrn-pr',
                'fields_options' => ['elb_text_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#fff']],   
            ]
        );
        $this->add_control(
            'wooitem_icon_color',
            [
                'label' => esc_html__('Icon Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [ '{{WRAPPER}} .elb-woo-mdrn-icon,{{WRAPPER}} .elb-woo-mdrn-ic' => 'color: {{VALUE}};'],
                'condition' => ['wooitem_style' => ['style_1','style_3']],                
            ]
        );
        $this->add_control(
            'wooitem_stars_color',
            [
                'label' => esc_html__('Stars Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'selectors' => [ '{{WRAPPER}} .elb-woo-rating .star-rating span::before, {{WRAPPER}} .elb-woo-rating .star-rating::before' => 'color: {{VALUE}};'],
                'condition' => ['wooitem_style' => ['style_1','style_3']],                
            ]
        );

        $this->add_control(
            'wooitem_btn_color',
            [
                'label' => esc_html__('Button Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [ '{{WRAPPER}} .elb-woo-mdrn-btn' => 'color: {{VALUE}};'],
                'condition' => ['wooitem_style' => ['style_2']],                
            ]
        );
        $this->add_control(
            'wooitem_btn_bg',
            [
                'label' => esc_html__('Button Background', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#232323',
                'selectors' => [ '{{WRAPPER}} .elb-woo-mdrn-btn' => 'background: {{VALUE}};'],
                'condition' => ['wooitem_style' => ['style_2']],                
            ]
        );
        $this->add_control(
            'wooitem_scheme_bg',
            [
                'label' => esc_html__('Background Scheme', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#232323',
                'selectors' => [ '{{WRAPPER}} .elb-woo-mdrn-info,{{WRAPPER}} .elb-woo-mdrn-content[data-style="style_1"] .elb-woo-mdrn-title' => 'background: {{VALUE}};'],
            ]
        );
        $this->end_controls_section();

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
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wooitem_ovl_bg',
                'label' => esc_html__( 'Overlay Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]],                
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-ovrl',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wooitem_br',
                'label' => esc_html__( 'Product Item Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-pr-ins',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wooitem_bxs',
                'label' => esc_html__('Product Item Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-pr-ins',
            ]
        );
        $this->add_control(
            'wooitem_radius',
            [
                'label' => esc_html__( 'Product Item Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-woo-mdrn-pr-ins' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab( 'hover_ctn',
            [
                'label' => esc_html__( 'Hover', 'booster-addons' ),
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'wooitem_ovl_bg_hv',
                'label' => esc_html__( 'Overlay Background', 'booster-addons' ),
                'dynamic' => ['active' => true],
                'types' => [ 'classic', 'gradient'],
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => 'rgba(0,0,0,0.3)'],'image' => ['type' => Controls_Manager::HIDDEN]],                
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-pr-ins:hover .elb-woo-mdrn-ovrl',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'wooitem_br_hv',
                'label' => esc_html__( 'Product Item Border', 'booster-addons' ),
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-pr-ins:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'wooitem_bxs_hv',
                'label' => esc_html__('Product Item Box Shadow', 'booster-addons'),
                'selector' => '{{WRAPPER}} .elb-woo-mdrn-pr-ins:hover',
            ]
        );
        $this->add_control(
            'wooitem_radius_hv',
            [
                'label' => esc_html__( 'Product Item Border Radius', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => true],
                'selectors' => ['{{WRAPPER}} .elb-woo-mdrn-pr-ins:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
    

        $this->end_controls_section();
    
    }
    
   protected function render() {
    	$settings = $this->get_settings_for_display();
    	$output = $ctn_attr = '';
    	if($settings['wooitem_type'] == 'list'){
    		$ctn_attr .= ' data-columns="'.esc_attr($settings['masonry_columns']).'" data-animation="'.esc_attr($settings['masonry_show_effect']).'" ';
        	$ctn_attr .= ($settings['masonry_gutter_enabled'] == 'enabled') ? ' data-gutter-enabled="on" data-gutter="'.esc_attr($settings['masonry_gutter_value']['size']).'" ' : '';
    	}else{
            $settings['masonry_columns'] = 1;
    		$ctn_attr .= ' data-columns="1" data-animation="none" ';
    	}

    	$query_options = array('post_type'=> 'product','posts_per_page' => $settings['wooitem_number'] ,'orderby'=> $settings['wooitem_order_by'] , 'order' => $settings['wooitem_order_sort']);
    	if($settings['wooitem_type'] == 'single'):
    		$single_product_id = ($settings['wooitem_single_id'] != "") ? $settings['wooitem_single_id'] : 1;
    		$query_options = array('p' => $single_product_id , 'post_type'=> 'product' );
    	endif;
    	
    	#query_posts($query_options); 
		$products = new \WP_Query( $query_options );
        $output .= '<div class="elb-masonry-boss elb-filter-boss">';
        	$output .= '<div class="elb-ss-fk"></div>';
	    	$output .= '<div class="elb-masonry-list" '.$ctn_attr.'>';
	    		$key = 0;
		    	if ($products->have_posts()) : 
			        while ($products->have_posts()) : $products->the_post();
		           		$product = new \WC_Product(get_the_ID());
		           		$attachment_ids = $product->get_gallery_image_ids();			           		
			        	$productContent = [
			        		'transition_delay' => 'elb-and-'.(($key % $settings['masonry_columns']) + 1),
			        		'id' => $product->get_id(),
			        		'name' => $product->get_name(),
			        		'price' => $product->get_price_html(),
			        		'link' => '<a class="elb-fs-a" href="'.esc_url(get_the_permalink()).'"></a>',
			        		'rating' => wc_get_rating_html($product->get_average_rating(), $product->get_rating_count()),			        	
			        		'image_1' => wp_get_attachment_url(get_post_thumbnail_id()),
			        		'image_2' => ($attachment_ids) ? wp_get_attachment_url($attachment_ids[0]) : false,
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
        echo apply_filters('elb_woomodernproduct_output', $output, $settings);
    }
    protected function elb_get_output_container($settings,$productContent) {
    	$output = '';
	    $output .= '<div class="elb-woo-mdrn-pr-ctn elb-masonry-item '.$productContent['transition_delay'].'">';
			$output .= '<div class="elb-woo-mdrn-pr-ins elb-tr-3 elb-masonry-item-insider">';				
				$output .= '<div class="elb-woo-mdrn-imgs">';
					$output .= '<img class="elb-woo-mdrn-img1" src="'.esc_url($productContent['image_1']).'">';
					$output .= ($productContent['image_2']) ? '<img class="elb-woo-mdrn-img2 elb-tr-3" src="'.esc_url($productContent['image_2']).'">' : '';
					$output .= '<div class="elb-woo-mdrn-ovrl">'.$productContent['link'].'</div>';
				$output .= '</div>';
				switch($settings['wooitem_style']){
					case 'style_1':
						$output .= $this->elb_get_output_style_1($settings,$productContent);
						break;
					case 'style_2':
						$output .= $this->elb_get_output_style_2($settings,$productContent);
						break;
					case 'style_3':
						$output .= $this->elb_get_output_style_3($settings,$productContent);
						break;		
				}
			$output .= '</div>';		
		$output .= '</div>';    		
    	return $output;
    }


    protected function elb_get_output_style_1($settings,$productContent){
    	$output = '';
   		$output .= '<div class="elb-woo-mdrn-content" data-style="style_1" data-alignment="'.esc_attr($settings['wooitem_align']).'">'.$productContent['link'];
			$output .= '<div class="elb-woo-mdrn-item elb-woo-mdrn-item-title elb-tr-3">';
				$output .= '<div class="elb-woo-mdrn-title"><span>'.$productContent['name'].'</span></div>';
			$output .= '</div>';
			$output .= '<div class="elb-woo-mdrn-item elb-woo-mdrn-item-info elb-tr-3">';
				$output .= '<div class="elb-woo-mdrn-info">';
					$output .= '<div class="elb-woo-mdrn-price">'.$productContent['price'].'</div>';
					$output .= '<div class="elb-woo-mdrn-stars elb-woo-rating">'.$productContent['rating'].'</div>';
					$output .= '<div class="elb-woo-mdrn-icon">'.$productContent['ajax_link'].''.CertainDev_Icons::get_icon($settings['wooitem_cart_icon'],'',$settings['wooitem_cart_icon_size']).'</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
    	return $output;
    }

    protected function elb_get_output_style_2($settings,$productContent){
    	$output = '';
   		$output .= '<div class="elb-woo-mdrn-content" data-style="style_2" data-alignment="'.esc_attr($settings['wooitem_align']).'">';
			$output .= '<div class="elb-woo-mdrn-item elb-woo-mdrn-item-center">';
				$output .= '<div class="elb-woo-mdrn-title elb-tr-3">'.$productContent['name'].''.$productContent['link'].'</div>';
				$output .= '<div class="elb-woo-mdrn-btn elb-tr-3 elb-trd-2">'.$productContent['ajax_link'].''.$settings['wooitem_style2_btn_txt'].'</div>';
			$output .= '</div>';
			$output .= '<div class="elb-woo-mdrn-item elb-woo-mdrn-item-info elb-tr-3">';
				$output .= '<div class="elb-woo-mdrn-info">';
					$output .= '<div class="elb-woo-mdrn-title-sml">'.$productContent['name'].'</div>';
					$output .= '<div class="elb-woo-mdrn-price">'.$productContent['price'].'</div>';
				$output .= '</div>';
			$output .= '</div>';	
		$output .= '</div>';
    	return $output;
    }

    protected function elb_get_output_style_3($settings,$productContent){
    	$output = '';
   		$output .= '<div class="elb-woo-mdrn-content" data-style="style_3">'.$productContent['link'];
			$output .= '<div class="elb-woo-mdrn-item elb-woo-mdrn-item-center">';
				$output .= '<div class="elb-woo-mdrn-title elb-tr-3  elb-trd-3">'.$productContent['name'].'</div>';
				$output .= '<div class="elb-woo-mdrn-pr elb-tr-3">'.$productContent['price'].'</div>';
			$output .= '</div>';
			$output .= '<div class="elb-woo-mdrn-item elb-woo-mdrn-item-info elb-tr-3">';
				$output .= '<div class="elb-woo-mdrn-info">';
					$output .= '<div class="elb-woo-mdrn-title-sml">'.$productContent['name'].'</div>';
					$output .= '<div class="elb-woo-mdrn-ic">'.CertainDev_Icons::get_icon($settings['wooitem_cart_icon'],'',$settings['wooitem_cart_icon_size']).'</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
    	return $output;
    }
}    