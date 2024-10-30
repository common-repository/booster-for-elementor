<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_SideNavigation_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-sidenavigation-widget';
    }
    public function get_title() {
        return esc_html__('Side Navigation', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-sidebar';
    }
    public function get_categories() {
        return array('booster-addons');
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        //Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'item_name', [
                'label' => esc_html__('Item Name', 'booster-addons'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        ); 
        $repeater->add_control(
            'item_link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'description' => esc_html__('For single page scroll navigation enter # plus the ID of the element you want to scroll to', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        ); 
        //Navigation Items
        $this->add_control(
            'navigation_items',
            [
                'label' => esc_html__('Navigation Itemes', 'booster-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['item_name'=> 'Navigation Item 1'],
                    ['item_name'=> 'Navigation Item 2'],
                    ['item_name'=> 'Navigation Item 3'],
                ],
                'title_field' => '{{{ item_name }}}',
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
            'text_align',
            [
                'label' => esc_html__('Text Align', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'left',
                'selectors' => ['{{WRAPPER}} .elb-navitem-row-ctn' => 'text-align: {{VALUE}};'],

            ]
        );
        $this->add_control(
            'row_padding',
            [
                'label' => esc_html__( 'Row Paddings', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px','%'],
                'default' => ['left' => '20','top' => '15','right' => '20','bottom' => '15','isLinked' => false],
                'selectors' => ['{{WRAPPER}} .elb-navitem-row-ctn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $this->add_control(
            'separator_settings',
            [
                'label' => esc_html__('Row Separator', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'enable_border',
            [
                'label' => esc_html__( 'Enable Row Border', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
         $this->add_control(
            'row_br_width',
            [
                'label' => esc_html__('Border Size', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'condition' => ['enable_border' => ['yes']],
                'size_units' => ['px'],
                'range' => ['px' => ['min' => 0,'max' => 10,'step' => 1]],
                'default' => ['unit' => 'px','size' => 1],
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}} .elb-navitem-row-ctn' => 'border-bottom-width: {{SIZE}}px;'],
            ]
        );
        $this->add_control(
            'row_br_style',
            [
                'label' => esc_html__('Border Style', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['enable_border' => ['yes']],
                'options' => [ 
                    'solid' => esc_html__('Solid', 'booster-addons'),
                    'dotted' => esc_html__('Dotted', 'booster-addons'),
                    'dashed' => esc_html__('Dashed', 'booster-addons'),
                ],
                'default' => 'solid',
                'selectors' => ['{{WRAPPER}} .elb-navitem-row-ctn' => 'border-bottom-style: {{VALUE}};'],
            ]
        );
       $this->add_control(
            'row_br_color',
            [
                'label' => esc_html__('Border Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'condition' => ['enable_border' => ['yes']],                
                'selectors' => [
                    '{{WRAPPER}} .elb-navitem-row-ctn' => 'border-bottom-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        //Typography and Colors
        $this->start_controls_section(
            'typo_clrsettings',
            [
                'label' => esc_html__('Typography & Color', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'item_st_settings',
            [
                'label' => esc_html__('Navigation Item Styling', 'booster-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item_font',
                'label' => esc_html__('Item Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '500'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-navitem-item_name',
            ]
        );
        $this->add_control(
            'item_color',
            [
                'label' => esc_html__('Item Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#444',
                'selectors' => ['{{WRAPPER}} .elb-navitem-item_name' => 'color:{{VALUE}}'],
            ]
        );
       
        $this->end_controls_section();

        //Active
        $this->start_controls_section(
            'active_settings',
            [
                'label' => esc_html__('Hover & Active Styling', 'booster-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );     
        $this->add_control(
            'active_item_color',
            [
                'label' => esc_html__('Item Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'selectors' => ['{{WRAPPER}} .elb-navitem-row-ctn:hover .elb-navitem-item_name,{{WRAPPER}} .elb-navitem-row-ctn[data-situation="active"] .elb-navitem-item_name' => 'color: {{VALUE}}!important;'],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'active_item_font',
                'label' => esc_html__('Item Font', 'booster-addons'),      
                'fields_options' => [
                    'font_size' => ['default' =>['size' => 14,'unit' => 'px']],
                    'font_weight' => ['default' => '700'],
                    'typography' => ['default' => 'custom'],
                ],          
                'selector' => '{{WRAPPER}} .elb-navitem-row-ctn:hover .elb-navitem-item_name,{{WRAPPER}} .elb-navitem-row-ctn[data-situation="active"] .elb-navitem-item_name',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'active_item_background',
                'label' => esc_html__( 'Item Background Color', 'booster-addons' ),
                'types' => [ 'classic', 'gradient'],
                'separator' => 'before',
                'fields_options' => ['background' => ['default' => 'classic'],'color' => ['default' => ''],'image' => ['type' => Controls_Manager::HIDDEN]],
                'selector' => '{{WRAPPER}} .elb-navitem-row-ctn:hover:before,{{WRAPPER}} .elb-navitem-row-ctn[data-situation="active"]:before',
            ]
        );
        $this->add_control(
            'active_item_deco_type',
            [
                'label' => esc_html__('Decoration', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'label_block' => true,
                'options' => [
                    'none'    =>  esc_html__('None','booster-addons'), 
                    'border'    =>  esc_html__('Border','booster-addons'), 
                    'bullet'    =>  esc_html__('Bullet','booster-addons'), 
                    'carret'    =>  esc_html__('Carret','booster-addons'), 
                    'arrow_1'    =>  esc_html__('Arrow 1','booster-addons'), 
                    'arrow_2'    =>  esc_html__('Arrow 2','booster-addons'), 
                ],
                'default' => 'border',
            ]
        );
        $this->add_control(
            'active_item_deco_pos',
            [
                'label' => esc_html__('Decoration Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'condition' => ['active_item_deco_type!' => [ 'none' ]],
                'default' => 'left'
            ]
        );
         $this->add_control(
            'active_item_deco_size',
            [
                'label' => esc_html__('Decoration Size', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'label_block' => true,
                'options' => [
                    'small'    =>  esc_html__('Small','booster-addons'), 
                    'medium'    =>  esc_html__('Medium','booster-addons'), 
                    'large'    =>  esc_html__('Large','booster-addons'),                    
                ],
                'default' => 'medium',
                'condition' => ['active_item_deco_type!' => [ 'none' ]],
            ]
        );
         $this->add_control(
            'active_item_deco_color',
            [
                'label' => esc_html__('Decoration Color', 'booster-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#7d66e2',
                'condition' => ['active_item_deco_type!' => [ 'none' ]],
                'selectors' => ['{{WRAPPER}} .elb-navitem-deco' => 'color: {{VALUE}};'],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $output = ''; 
        $deco_output = ($settings['active_item_deco_type'] != 'none') ? '<div class="elb-navitem-deco elb-elmrow-deco elb-tr-2" data-type="'.esc_attr($settings['active_item_deco_type']).'" data-size="'.esc_attr($settings['active_item_deco_size']).'" data-position="'.esc_attr($settings['active_item_deco_pos']).'"></div>' : '';
        $output .= '<div class="elb-navitem-ctn">';            
            if($settings['navigation_items']):
                foreach($settings['navigation_items'] as $item):                    
                    $output .= '<div class="elb-navitem-row-ctn elb-fs elementor-repeater-item-'.$item['_id'].'" data-nav-id="'.esc_attr($item['item_link']['url']).'" data-situation="inactive">';
                        $output .=  $deco_output;
                        $output .= '<div class="elb-navitem-row elb-fs">';
                            $output .= '<div class="elb-navitem-item_name elb-tr-2"><span>'.$item['item_name'].'</span></div>';
                        $output .= '</div>';
                        $output .= (!empty($item['item_link'])) ? elb_render_elementor_link($item['item_link'], '', true) : '';
                    $output .= '</div>';        
                endforeach;
            endif;

        $output .= '</div>';        

        echo apply_filters('elb_sidenavigation_output', $output, $settings);
    }

}        