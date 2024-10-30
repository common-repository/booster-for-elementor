<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_WooItem_Tab{

	public static function init($widget){
		$widget->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Global Settings', 'booster-addons'),
            ]
        );
        $widget->add_control(
            'wooitem_type',
            [
                'label' => esc_html__('Products Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'list' => esc_html__('List', 'booster-addons'),
                    'single' => esc_html__('Single', 'booster-addons'),
                ],
                'default' => 'list',
            ]
        );                
        $widget->add_control(
            'wooitem_single_id',
            [
                'label' => esc_html__('Product Name', 'booster-addons'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'condition' => ['wooitem_type' => ['single']],                
                'options' => elb_woo_products_list(),
                'default' => '',
            ]
        );
        $widget->add_control(
            'wooitem_number',
            [
                'label' => esc_html__('Number of Products to Show', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '2',
                'default' => '9',
                'condition' => ['wooitem_type' => ['list']],                
            ]
        );
        $widget->add_control(
            'wooitem_order_by',
            [
                'label' => esc_html__('Products Order By', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                	'date' => esc_html__('Date', 'booster-addons'),
                    'ID' => esc_html__('Order by product ID', 'booster-addons'),
                    'author' => esc_html__('Author', 'booster-addons'),
                    'title' => esc_html__('Name', 'booster-addons'),
                    'comment_count' => esc_html__('Number of comments', 'booster-addons')     
                ],
                'default' => 'date',
                'condition' => ['wooitem_type' => ['list']],                
            ]
        );
        $widget->add_control(
            'wooitem_order_sort',
            [
                'label' => esc_html__('Sort Order', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                	'ASC' => esc_html__('Ascending', 'booster-addons'),
                    'DESC' => esc_html__('Descending', 'booster-addons'),
                ],
                'default' => 'DESC',
                'condition' => ['wooitem_type' => ['list']],                
            ]
        );
        $widget->add_control(
            'masonry_columns',
            [
                'label' => esc_html__('Columns Number', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    '1'    =>  esc_html__('1 Column','booster-addons'), 
                    '2'    =>  esc_html__('2 Columns','booster-addons'), 
                    '3'    =>  esc_html__('3 Columns','booster-addons'), 
                    '4'    =>  esc_html__('4 Columns','booster-addons'), 
                    '5'    =>  esc_html__('5 Columns','booster-addons'), 
                ],
                'condition' => ['wooitem_type' => ['list']],                
                'default' => '3',
            ]
        );
        $widget->add_control(
            'masonry_gutter_enabled',
            [
                'label' => esc_html__('Enable Gutter', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'enabled'    =>  esc_html__('Yes, Please!','booster-addons'), 
                    'disabled'    =>  esc_html__('No','booster-addons'), 
                ],
                'condition' => ['wooitem_type' => ['list']],                
                'default' => 'enabled',
            ]
        );
        $widget->add_control(
            'masonry_gutter_value',
            [
                'label' => esc_html__('Gutter Value', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0,'max' => 100,'step' => 1]],
                'default' => ['unit' => 'px','size' => 25],
                'condition' => ['masonry_gutter_enabled' => ['enabled'],'wooitem_type' => ['list']],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-masonry-list' => '--gutter-value: {{SIZE}}px;'],
            ]
        );
        $widget->add_control(
            'masonry_show_effect',
            [
                'label' => esc_html__('Show Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_masonry_show_effects(),
                'condition' => ['wooitem_type' => ['list']],                
                'default' => 'fadeup',
            ]
        );
        $widget->end_controls_section();
	}

    public static function init_categories($widget){
        $widget->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Global Settings', 'booster-addons'),
            ]
        );
        $widget->add_control(
            'woocat_type',
            [
                'label' => esc_html__('Category Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'latest' => esc_html__('Latest', 'booster-addons'),
                    'custom_list' => esc_html__('Custom List', 'booster-addons'),
                ],
                'default' => 'latest',
            ]
        ); 
        $widget->add_control(
            'woocat_custom_list',
            [
                'label' => esc_html__('Custom List', 'booster-addons'),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'options' => elb_woo_categories_list(),
                'multiple' => true,
                'condition' => ['woocat_type' => ['custom_list']],                
            ]
        );

        $widget->add_control(
            'woocat_number',
            [
                'label' => esc_html__('Number of Categories to Show', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '2',
                'default' => '9',
                'condition' => ['woocat_type' => ['latest']],                
            ]
        );
       
        $widget->add_control(
            'woocat_order_sort',
            [
                'label' => esc_html__('Sort Order', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'ASC' => esc_html__('Ascending', 'booster-addons'),
                    'DESC' => esc_html__('Descending', 'booster-addons'),
                ],
                'default' => 'DESC',
            ]
        );
        $widget->add_control(
            'masonry_columns',
            [
                'label' => esc_html__('Columns Number', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    '1'    =>  esc_html__('1 Column','booster-addons'), 
                    '2'    =>  esc_html__('2 Columns','booster-addons'), 
                    '3'    =>  esc_html__('3 Columns','booster-addons'), 
                    '4'    =>  esc_html__('4 Columns','booster-addons'), 
                    '5'    =>  esc_html__('5 Columns','booster-addons'), 
                ],
                'default' => '3',
            ]
        );
        $widget->add_control(
            'masonry_gutter_enabled',
            [
                'label' => esc_html__('Enable Gutter', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    'enabled'    =>  esc_html__('Yes, Please!','booster-addons'), 
                    'disabled'    =>  esc_html__('No','booster-addons'), 
                ],
                'default' => 'enabled',
            ]
        );
        $widget->add_control(
            'masonry_gutter_value',
            [
                'label' => esc_html__('Gutter Value', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0,'max' => 100,'step' => 1]],
                'default' => ['unit' => 'px','size' => 25],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-masonry-list' => '--gutter-value: {{SIZE}}px;'],
            ]
        );
        $widget->add_control(
            'masonry_show_effect',
            [
                'label' => esc_html__('Show Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_masonry_show_effects(),
                'default' => 'fadeup',
            ]
        );
        $widget->end_controls_section();

    }

}