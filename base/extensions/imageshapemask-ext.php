<?php
namespace Elementor;
/*
	EXTENSIONS : Image Shape Mask
*/
if (!defined('ABSPATH')) exit; 
new Elb_ImageShapeMask_Extension();
class Elb_ImageShapeMask_Extension{
	
	function __construct(){
       /*Default Elementor Widgets*/
        add_action('elementor/element/image/section_image/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/image-box/section_image/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/image-carousel/section_image_carousel/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/image-gallery/section_gallery/before_section_end', [$this, 'register_controls'], 10);		
       
       /*Booster Addons Widgets*/
        add_action('elementor/element/elb-iconbox-widget/section_content/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-imageswap-widget/section_content/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-modernimage-widget/mdrn_section_styling/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-imagecardslider-widget/images_content/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-simpleimagesslider-widget/section_images/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-showcaseimage-widget/container_styling/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-filtershowcaseimages-widget/container_styling/before_section_end', [$this, 'register_controls'], 10);		
        add_action('elementor/element/elb-filterimages-widget/mdrn_section_styling/before_section_end', [$this, 'register_controls'], 10);		
	
		
	}

	public static function register_controls(Widget_Base $element){
		$ctl_args = self::widget_args_injection($element->get_name());
		
		$element->start_injection([
			'type' => 'control',
			'at' => 'after',
			'of' => $ctl_args['of'],
		]);

		$selector = '{{WRAPPER}} '.$ctl_args['selector'];

		$element->add_control(
            'booster_image_mask_toggle',
            [
                'label' => esc_html__( 'Image Mask', 'Booster Addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => $ctl_args['condition'],
            ]
        );
        $element->start_popover();

        $element->add_control(
            'booster_image_mask_source',
            [
                'label' => esc_html__('Choose Shape', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'default' => ['title' => esc_html__('Default', 'booster-addons'), 'icon' => 'elbd-img-shape-bg'],
                    'custom' => ['title' => esc_html__('Custom', 'booster-addons'),'icon' => 'eicon-image'],
                ],                
                'default' => 'default',
            ]
        );
        $shapes_url = BOOSTER_ADDONS_URL_IMAGES .'shapes/';
        //Default Shape
        $element->add_control(
            'booster_image_mask_shape',
            [
                'type' => 'elb_imagemask_chooser',
                'label' => esc_html__('Choose Mask Shape', 'booster-addons'),
                'dynamic' => ['active' => true],
                'condition' => ['booster_image_mask_toggle' => 'yes','booster_image_mask_source' => 'default'],
                'multiple' => false,
                'selectors' => [$selector => '-webkit-mask-image: url('.$shapes_url.'{{VALUE}}.svg); mask-image: url('.$shapes_url.'{{VALUE}}.svg);']
            ]
        );
        //CUSTOM SHAPE TO BE DONE
        // ********************************
        $element->add_control(
            'booster_image_mask_shape_custom',
            [
                'label' => esc_html__('Custom SVG Image', 'booster-addons'),
                'description' => esc_html__('Please make sure yout have enabled the SVG upload on your Website', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
		    	'style_transfer' => true,
                'condition' => ['booster_image_mask_toggle' => 'yes','booster_image_mask_source' => 'custom'],
                'selectors' => [$selector => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});'],
            ]
        );


        $element->add_control(
            'booster_image_mask_shape_position',
            [
                'label' => esc_html__('Mask Shape Position', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
		    	'style_transfer' => true,
                'condition' => ['booster_image_mask_toggle' => 'yes'],
                'options' => elb_image_positions_map(),
                'selectors' => [$selector => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};'],
                'default' => 'center center',
            ]
        );
        $element->add_control(
            'booster_image_mask_shape_repeat',
            [
                'label' => esc_html__('Mask Shape Repeat', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
		    	'style_transfer' => true,
                'condition' => ['booster_image_mask_toggle' => 'yes'],
                'options' => elb_image_repeat_map(),
                'selectors' => [$selector => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};'],
                'default' => 'no-repeat',
            ]
        );

        $element->add_control(
            'booster_image_mask_shape_size',
            [
                'label' => esc_html__('Mask Shape Size', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
		   		 'style_transfer' => true,
                'condition' => ['booster_image_mask_toggle' => 'yes'],
                'options' => elb_image_size_map(),
                'selectors' => [$selector => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};'],
                'default' => 'contain',
            ]
        );

        $element->add_control(
            'booster_image_mask_shape_custom_size',
            [
                'label' => esc_html__('Mask Shape Custom Size', 'booster-addons'),
		    	'type' => Controls_Manager::SLIDER,
		    	'responsive' => true,
		   		'style_transfer' => true,
                'condition' => ['booster_image_mask_toggle' => 'yes','booster_image_mask_shape_size' => 'initial'],
		   		'size_units' => [ 'px', 'em', '%', 'vw' ],
               	'range' => [
			 	   'px' => ['min' => 0,'max' => 1500],
			   		'em' => ['min' => 0,'max' => 100],
			    	'%' => ['min' => 0,'max' => 100],
			    	'vw' => ['min' => 0,'max' => 100],
		    	],
		    	'default' => ['size' => 100,'unit' => '%'],
                'selectors' => [$selector => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};']               
            ]
        );

        $element->end_popover(); 
		$element->end_injection();
             
    }

	public static function widget_args_injection($element_name = '') {
		$args = [
			/*Default Elementor Widgets*/
			'image' => [
				'of' => 'image',
				'selector' => '.elementor-image img',
				'condition' => []
			],
			'image-box' => [
				'of' => 'image',
				'selector' => '.elementor-image-box-img img',
				'condition' => []
			],
			'image-carousel' => [
				'of' => 'caption_type',
				'selector' => '.swiper-slide-inner img',
				'condition' => []
			],
			'image-gallery' => [
				'of' => 'gallery_rand',
				'selector' => '.gallery-item img',
				'condition' => []
			],
			/*Booster Addons Widgets*/
			'image-gallery' => [
				'of' => 'gallery_rand',
				'selector' => '.gallery-item img',
				'condition' => []
			],
			'elb-iconbox-widget' => [
				'of' => 'image',
				'selector' => '.elb-iconarea-icon img',
				'condition' => ['icon_type' => ['image']]
			],
			'elb-imageswap-widget' => [
				'of' => 'image2',
				'selector' => '.elb-imgswp-ctn img',
				'condition' => []
			],
			'elb-modernimage-widget' => [
				'of' => 'ctn_paddings',
				'selector' => '.elb-hvimage-insider',
				'condition' => []
			],
			'elb-imagecardslider-widget' => [
				'of' => 'images',
				'selector' => '.elb-imcgal-ctn img',
				'condition' => []
			],
			'elb-simpleimagesslider-widget' => [
				'of' => 'images_list_massive',
				'selector' => '.elb-simple-img-ctn img',
				'condition' => []
			],
			'elb-showcaseimage-widget' => [
				'of' => 'ovl_bg',
				'selector' => '.elb-shocsim-imsec',
				'condition' => []
			],
			'elb-filtershowcaseimages-widget' => [
				'of' => 'ovl_bg',
				'selector' => '.elb-shocsim-imsec',
				'condition' => []
			],
			'elb-filterimages-widget' => [
				'of' => 'ctn_paddings',
				'selector' => '.elb-hvimage-insider',
				'condition' => []
			]

			
		];
    
		return $args[$element_name];

    }


}