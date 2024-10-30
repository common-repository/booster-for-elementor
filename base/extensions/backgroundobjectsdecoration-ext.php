<?php
namespace Elementor;
/*
	EXTENSIONS : Background Objects  Decoration
*/
if (!defined('ABSPATH')) exit; 
new Elb_BackgroundObjectsDecoration_Extension();
class Elb_BackgroundObjectsDecoration_Extension{
	function __construct(){
        add_action('elementor/element/section/section_layout/after_section_end', [$this, 'register_controls'], 10);
        add_action('elementor/frontend/section/after_render', [$this, 'render_output'], 10);
	}


	function register_controls($element){
		$element->start_controls_section(
			'elb_bgobjdeco_ext_section',
			[
				'label' => esc_html__('Booster BG Objects Decoration', 'booster-addons'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);	
		$element->add_control(
            'elb_bgobjdeco_ext_enabled',
            [
                'label' => esc_html__('Background Objects Decoration', 'booster-addons'),
                'description' => esc_html__('Add advanced background objects and shapes with custom animations and settings.', 'booster-addons'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'frontend_available' => true,
                'prefix_class' => 'elb-parallax-section-',
                
            ]
        );
        $repeater = new Repeater();
        /*
		****************************** Object Chooser
        */
        $repeater->add_control(
            'elb_bgobjdeco_obj',
            [
                'type' => 'elb_object_chooser',
                'label' => esc_html__('Choose Object Decoration', 'booster-addons'),
                'dynamic' => ['active' => true],
                'default' => 'g7O1ENqQAk4NqOaB',
                'label_block' => true               
            ]
        );


        $repeater->add_responsive_control(
            'elb_bgobjdeco_elm_size',
            [
                'label' => esc_html__('Object Size', 'booster-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => ['px' => ['min' => 1, 'max' => 10000],'%' => ['min' => 1, 'max' => 300]],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => ['size' => 32,'unit' => 'px'],
                'tablet_default' => ['size' => 32,'unit' => 'px'],
                'mobile_default' => ['size' => 32,'unit' => 'px'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} svg' => 'width: {{SIZE}}{{UNIT}}!important;',
                ],
            ]
        );
        

		$repeater->add_group_control(
            Group_Control_ELB_Icon_Gradient::get_type(),
            [
                'name' => 'elb_bgobjdeco_obj_color',
                'dynamic' => ['active' => true],
                'label' => esc_html__('Object Color', 'booster-addons'),
                'fields_options' => ['elb_icon_gradient_type' => ['default' =>'yes'], 'color_one' => ['default' => '#333']],                
            ]
        );
        
        $repeater->add_control(
            'elb_bgobjdeco_elm_align',
            [
                'name' => 'elb_bgobjdeco_elm_align',
                'label' => esc_html__('Object Aligment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'right' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right']
                ],
                'default' => 'center',
            ]
        );  	
        $repeater->add_control(
            'elb_bgobjdeco_elm_pos',
            [
                'name' => 'elb_bgobjdeco_elm_pos',
                'label' => esc_html__('Object Position', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => ['title' => esc_html__('Top', 'booster-addons'), 'icon' => 'eicon-v-align-top'],
                    'middle' => ['title' => esc_html__('Middle', 'booster-addons'),'icon' => 'eicon-v-align-middle'],
                    'bottom' => ['title' => esc_html__('Bottom', 'booster-addons'),'icon' => 'eicon-v-align-bottom'],
                ],
                'default' => 'middle',
            ]
        );
        $repeater->add_control(
            'elb_bgobjdeco_elm_rotate',
            [
                'label' => esc_html__('Object Rotate', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
				'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} svg' => '-webkit-transform:rotate({{VALUE}}deg);transform:rotate({{VALUE}}deg);'],
                'dynamic' => ['active' => true],
            ]
        );
        $repeater->add_responsive_control(
            'elb_bgobjdeco_elm_mrg',
            [
                'label' => esc_html__( 'Object Margin', 'booster-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%'],
                'dynamic' => ['active' => true],
                'default' => ['left' => '0','top' => '0','right' => '0','bottom' => '0','isLinked' => false],
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
            ]
        );
        $repeater->add_control(
            'elb_bgobjdeco_elm_show_effect',
            [
                'label' => esc_html__('Show Effect', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'separator' => 'before',
                'options' => elb_masonry_show_effects(),
                'default' => 'none',
            ]
        );
        $repeater->add_control(
            'elb_bgobjdeco_elm_trs_speed',
            [
                'label' => esc_html__('Show Effect Speed', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '2','step' => '.1',
				'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-masonry-item' => '-webkit-transition-duration:{{VALUE}}s;transition-duration:{{VALUE}}s;-webkit-animation-duration:{{VALUE}}s;animation-duration:{{VALUE}}s;'],
                'condition' => ['elb_bgobjdeco_elm_show_effect!' => ['none']],          		
                'dynamic' => ['active' => true],
            ]
        );
        $repeater->add_control(
            'elb_bgobjdeco_elm_trs_del',
            [
                'label' => esc_html__('Show Effect Delay', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0', 'step' => '.1',
				'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} .elb-masonry-item' => '-webkit-animation-delay:{{VALUE}}s;animation-delay:{{VALUE}}s;'],
                'condition' => ['elb_bgobjdeco_elm_show_effect!' => ['none']],          		
                'dynamic' => ['active' => true],
            ]
        );

        //INFINITE ROTATE
        $repeater->add_control(
            'elb_bgobjdeco_elm_infrotate_en',
            [
                'name' => 'elb_bgobjdeco_elm_infrotate_en',
                'label' => esc_html__('Enable Infinite Rotate', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'label_block' => true,
                'options' => [
                	'none'	=> esc_html__('None', 'booster-addons'),
                	'right'	=> esc_html__('To Right', 'booster-addons'),
                	'left'	=> esc_html__('To Left', 'booster-addons'),
                ],
                'default' => 'none',
            ]
        );
        $repeater->add_control(
            'elb_bgobjdeco_elm_infrotate_speed',
            [
                'label' => esc_html__('Infinite Rotate Speed', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => '2','step' => '.1',
				'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}} svg' => '-webkit-animation-duration:{{VALUE}}s;animation-duration:{{VALUE}}s;'],
                'condition' => ['elb_bgobjdeco_elm_infrotate_en!' => ['none']],          		
                'dynamic' => ['active' => true],
            ]
        );


        $repeater->add_control(
            'elb_bgobjdeco_elm_anim_type',
            [
                'name' => 'elb_bgobjdeco_elm_anim_type',
                'label' => esc_html__('Animation Type', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'separator' => 'before',
                'label_block' => true,
                'options' => [
                	'none' 				=> esc_html__('None', 'booster-addons'),
                	'parallax_hover' 	=> esc_html__('Parallax Hover', 'booster-addons'),
                	'parallax_onscroll'	=> esc_html__('Parallax onScroll', 'booster-addons'),
                	'move_around' 		=> esc_html__('Move Around', 'booster-addons'),            	
                ],
                'default' => 'none',
            ]
        );
        //Move Around Styles
        $repeater->add_control(
            'elb_bgobjdeco_elm_mvard_style',
            [
                'name' => 'elb_bgobjdeco_elm_mvard_style',
                'label' => esc_html__('Move Around Styles', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'condition' => ['elb_bgobjdeco_elm_anim_type' => ['move_around']],
                'options' => [
                	'style_1' 	=> esc_html__('Style 1', 'booster-addons'),
                	'style_2' 	=> esc_html__('Style 2', 'booster-addons'),
                	'style_3' 	=> esc_html__('Style 3', 'booster-addons'),
                	'style_4' 	=> esc_html__('Style 4', 'booster-addons')
                ],
                'default' => 'style_1',
            ]
        );

        
        $repeater->add_control(
            'elb_bgobjdeco_elm_prlx_stv',
            [
                'label' => esc_html__('Parallax Sensitivity', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0', 'step' => '1', 'max' => '5', 
                'label_block' => true,
                'dynamic' => ['active' => true],
                'condition' => ['elb_bgobjdeco_elm_anim_type' => ['parallax_hover']],
                'default' => '1',
            ]
        );

        $repeater->add_control(
            'elb_bgobjdeco_elm_parallax_scroll_vrt_value',
            [
                'label' => esc_html__('Parallax Vertical Sensitivity', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                 'step' => '1', 'min' => '-100','max' => '100', 
                'label_block' => true,
                'dynamic' => ['active' => true],
                'condition' => ['elb_bgobjdeco_elm_anim_type' => ['parallax_onscroll']],
                'default' => '2',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => '--elb-section-vertical-parallax: {{VALUE}};'],
            ]
        );
        $repeater->add_control(
            'elb_bgobjdeco_elm_parallax_scroll_hrz_value',
            [
                'label' => esc_html__('Parallax Horizontal Sensitivity', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                 'step' => '1', 'min' => '-100','max' => '100', 
                'label_block' => true,
                'dynamic' => ['active' => true],
                'condition' => ['elb_bgobjdeco_elm_anim_type' => ['parallax_onscroll']],
                'default' => '0',
                'selectors' => ['{{WRAPPER}} {{CURRENT_ITEM}}' => '--elb-section-horizontal-parallax: {{VALUE}};'],
            ]
        );
        
        $repeater->add_control(
            'hide_desktop',
            [
                'label' => esc_html__( 'Hide On Desktop', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => 'Hide',
                'label_off' => 'Show',
                'return_value' => 'hidden-desktop',
            ]
        );

        $repeater->add_control(
            'hide_tablet',
            [
                'label' => esc_html__( 'Hide On Tablet', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => 'Hide',
                'label_off' => 'Show',
                'return_value' => 'hidden-tablet',
            ]
        );

        $repeater->add_control(
            'hide_mobile',
            [
                'label' => esc_html__( 'Hide On Mobile', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => 'Hide',
                'label_off' => 'Show',
                'return_value' => 'hidden-phone',
            ]
        );

        //ENDS REPEATER
        $element->add_control(
            'elb_bgobjdeco_list',
            [
                'label' => esc_html__('Objects List', 'booster-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
              	'condition' => ['elb_bgobjdeco_ext_enabled' => ['yes']],                
                'default' => [],
            ]
        );

		$element->end_controls_section();		
	}
	
	function render_output($element){
    	$data 		= $element->get_data();
    	$type     	= $data['elType'];
		$settings 	= $data['settings'];
        $objOutput 	= '';
		if('section' === $type && 'yes' === $element->get_settings('elb_bgobjdeco_ext_enabled')){
			if(isset($settings['elb_bgobjdeco_list'])){
				$objOutput .= '<div class="elb-bgobjdeco-ctn">';
				foreach ($element->get_settings('elb_bgobjdeco_list') as $singleObject) {


					$sObjAttr = 'data-position="'.$singleObject['elb_bgobjdeco_elm_pos'].'" data-align="'.esc_attr($singleObject['elb_bgobjdeco_elm_align']).'" data-animation="'.$singleObject['elb_bgobjdeco_elm_show_effect'].'" data-infinite-rotate="'.$singleObject['elb_bgobjdeco_elm_infrotate_en'].'"  ';
					$sObjAttr .= ($singleObject['elb_bgobjdeco_elm_anim_type'] == 'move_around') ? ' data-move-around="'.esc_attr($singleObject['elb_bgobjdeco_elm_mvard_style']).'" ' : '';

					$customClass = '';
					$customClass .= ($singleObject['elb_bgobjdeco_elm_anim_type'] == 'parallax_onscroll') ? ' elb-parallax-section-elem ' : '';
					$customClass .= ($singleObject['elb_bgobjdeco_elm_anim_type'] == 'parallax_hover') ? ' elb-parallaxf-ctn' : '';
					
                    $elb_bgobjdeco_obj_color = ['color_one_pos'=> $singleObject['elb_bgobjdeco_obj_color_color_one_pos'] ,'color_one'=> $singleObject['elb_bgobjdeco_obj_color_color_one'] ,'color_two_pos'=> $singleObject['elb_bgobjdeco_obj_color_color_two_pos'] ,'color_two'=> $singleObject['elb_bgobjdeco_obj_color_color_two'] ,'gradient_enabled'=> $singleObject['elb_bgobjdeco_obj_color_gradient_enabled'],'direction' => $singleObject['elb_bgobjdeco_obj_color_direction']];        
                    

                    $customClass .= ($singleObject['hide_desktop'] == 'hidden-desktop') ? ' elementor-hidden-desktop ' : '';
                    $customClass .= ($singleObject['hide_tablet'] == 'hidden-tablet') ? ' elementor-hidden-tablet ' : '';
                    $customClass .= ($singleObject['hide_mobile'] == 'hidden-phone') ? ' elementor-hidden-phone ' : '';
				
					$objOutput .= '<div class="elb-bgobjdeco-item elb-masonry-list elementor-repeater-item-'.$singleObject['_id'].' '.$customClass.' " '.$sObjAttr.'>';
						$objOutput .= '<div class="elb-bgobjdeco-item-insider elb-masonry-item" data-isotope-situation="hidden">';
							$objOutput .= ($singleObject['elb_bgobjdeco_elm_anim_type'] == 'parallax_hover') ? '<div class="elb-bgobjdeco-item-insider elb-parallaxf-item" data-parallax-move="enabled"  data-parallax-sensitive="'.esc_attr($singleObject['elb_bgobjdeco_elm_prlx_stv']).'">' : '';
								$objOutput .= CertainDev_ObjectsDecoration::get_object($singleObject['elb_bgobjdeco_obj'],$elb_bgobjdeco_obj_color);
							$objOutput .= ($singleObject['elb_bgobjdeco_elm_anim_type'] == 'parallax_hover') ? '</div>' : '';
						$objOutput .= '</div>';
					$objOutput .= '</div>';
				}
				$objOutput .= '</div>';
                ?>
                <script>
                    (function($){
                        "use strict";
                        var section = $('.elementor-element-<?php echo $element->get_id(); ?>');
                        $(window).on('elementor/frontend/init', function(){ 
                            $('<?php echo $objOutput ?>').prependTo(section);
                        });
                    }(jQuery));     
                </script>
                <?php			
			}
		}

    }
}