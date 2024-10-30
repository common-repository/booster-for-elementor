<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_CssTransform_Tab{

    public static function init($element){
        $element->start_controls_section(
            'booster_section_css_transform',
            [
                'label' => esc_html__('Booster CSS Transform', 'booster-addons'),
                'tab' => Controls_Manager::TAB_ADVANCED,

            ]
        ); 
        $element->add_control(
            'elb_transform',
            [
                'label' => esc_html__( 'Enable CSS Transform', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'frontend_available' => true
            ]
        );
        $element->add_control(
            'elb_css_transform_hover_enabled',
            [
                'label' => esc_html__( 'Enable Hover CSS Transform', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'condition' => ['elb_transform' => ['yes']],                
                'return_value' => 'yes',
                'frontend_available' => true
            ]
        );

        $element->start_controls_tabs('elb_css_transform');
        $element->start_controls_tab('elb_css_transform_normal_tab',
            [
                'label' => esc_html__('Normal', 'booster-addons'),
                'condition' => ['elb_transform' => ['yes']],                
            ]
        );       
       
        self::elb_css_transform($element);
        $element->end_controls_tab();
        $element->start_controls_tab('elb_css_transform_hover_tab',
            [
                'label' => esc_html__('Hover', 'booster-addons'),
                'condition' => ['elb_transform' => ['yes'],'elb_css_transform_hover_enabled' => ['yes']],                
            ]
        );
      
        self::elb_css_transform($element,true);

        $element->end_controls_tab();
        $element->end_controls_tabs();
        $element->add_control(
            'elb_css_transform_transition',
            [
                'label' => esc_html__('Duration (s)', 'booster-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => '0.1', 'max' => '10',
                'step' => '0.1',
                'default' => '0',
                'condition' => ['elb_transform' => ['yes'],'elb_css_transform_hover_enabled' => ['yes']],                
                'dynamic' => ['active' => true],
                'selectors' => ['{{WRAPPER}}' => '-webkit-transition-duration: {{VALUE}}s;transition-duration: {{VALUE}}s;'],
            ]
        );
        $element->add_control(
            'elb_css_transform_timing',
            [
                'label' => esc_html__('Animation Timing', 'booster-addons'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => elb_transition_timing_type(),
                'condition' => ['elb_transform' => ['yes'],'elb_css_transform_hover_enabled' => ['yes']],                
                'default' => 'ease-in-out',
                'selectors' => ['{{WRAPPER}}' => '-webkit-timing-function: {{VALUE}};transition-timing-function: {{VALUE}};'],
            ]
        );


        $element->end_controls_section();
    }

   

    public static function elb_css_transform($element, $is_hover = false) {        
    	$hv_pref = $is_hover ? 'hv_' : '';
        $hv_selec = $is_hover ? '{{WRAPPER}}:hover' : '{{WRAPPER}}';
        $cl_el_name_scale = $hv_pref.'elb_transform_scale';
        $cl_el_name_translate = $hv_pref.'elb_transform_translate';
        $cl_el_name_rotate = $hv_pref.'elb_transform_rotate';
        $cl_el_name_skew = $hv_pref.'elb_transform_skew';

        $hoverCondition  = ($is_hover) ? ['yes'] : ['shady'];
        $hoverConditionName  = ($is_hover) ? "elb_css_transform_hover_enabled" : "elb_css_transform_hover_enabled!";

        $element->add_control(
            $cl_el_name_translate.'_toggle',
            [
                'label' => esc_html__( 'Translate', 'Booster Addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'elb_transform' => 'yes',
                    $hoverConditionName => $hoverCondition
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            $cl_el_name_translate.'_x',
            [
                'label' => esc_html__( 'Translate X', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => -1000,'max' => 1000]],
                'condition' => [$cl_el_name_translate.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
            ]
        );

        $element->add_responsive_control(
            $cl_el_name_translate.'_y',
            [
                'label' => esc_html__( 'Translate Y', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => -1000,'max' => 1000]],
                'condition' => [$cl_el_name_translate.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
                'selectors' => [
                    '(desktop)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px);',
                    '(tablet)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px);',
                    '(mobile)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px);',
                ]
            ]
        );

        $element->end_popover();

        $element->add_control(
            $cl_el_name_rotate.'_toggle',
            [
                'label' => esc_html__( 'Rotate', 'Booster Addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'condition' => [
                    'elb_transform' => 'yes',$hoverConditionName => $hoverCondition
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            $cl_el_name_rotate.'_x',
            [
                'label' => esc_html__( 'Rotate X', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => -180,'max' => 180]],
                'condition' => [$cl_el_name_rotate.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
            ]
        );

        $element->add_responsive_control(
            $cl_el_name_rotate.'_y',
            [
                'label' => esc_html__( 'Rotate Y', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => -180,'max' => 180]],
                'condition' => [$cl_el_name_rotate.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
            ]
        );

        $element->add_responsive_control(
            $cl_el_name_rotate.'_z',
            [
                'label' => esc_html__( 'Rotate Z', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => ['px' => ['min' => -180,'max' => 180]],
                'condition' => [$cl_el_name_rotate.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
                'selectors' => [
                    '(desktop)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z.SIZE || 0}}deg);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z.SIZE || 0}}deg);',
                    '(tablet)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_tablet.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_tablet.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_tablet.SIZE || 0}}deg);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_tablet.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_tablet.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_tablet.SIZE || 0}}deg);',
                    '(mobile)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_mobile.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_mobile.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_mobile.SIZE || 0}}deg);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_mobile.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_mobile.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_mobile.SIZE || 0}}deg);'
                ]
            ]
        );

        $element->end_popover();

        $element->add_control(
            $cl_el_name_scale.'_toggle',
            [
                'label' => esc_html__( 'Scale', 'Booster Addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'elb_transform' => 'yes',$hoverConditionName => $hoverCondition
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            $cl_el_name_scale.'_x',
            [
                'label' => esc_html__( 'Scale X', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => 1],
                'range' => ['px' => ['min' => 0,'max' => 5,'step' => .1]],
                'condition' => [$cl_el_name_scale.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
            ]
        );

        $element->add_responsive_control(
            $cl_el_name_scale.'_y',
            [
                'label' => esc_html__( 'Scale Y', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'default' => ['size' => 1],
                'range' => ['px' => ['min' => 0,'max' => 5,'step' => .1]],
                'condition' => [$cl_el_name_scale.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
                'selectors' => [
                    '(desktop)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y.SIZE || 1}});'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y.SIZE || 1}});',
                    '(tablet)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_tablet.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_tablet.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_tablet.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_tablet.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_tablet.SIZE || 1}});'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_tablet.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_tablet.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_tablet.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_tablet.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_tablet.SIZE || 1}});',
                    '(mobile)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_mobile.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_mobile.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_mobile.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_mobile.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_mobile.SIZE || 1}});'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_mobile.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_mobile.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_mobile.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_mobile.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_mobile.SIZE || 1}});'
                ]
            ]
        );

        $element->end_popover();

        $element->add_control(
            $cl_el_name_skew.'_toggle',
            [
                'label' => esc_html__( 'Skew', 'Booster Addons' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition' => [
                    'elb_transform' => 'yes',$hoverConditionName => $hoverCondition
                ],
            ]
        );

        $element->start_popover();

        $element->add_responsive_control(
            $cl_el_name_skew.'_x',
            [
                'label' => esc_html__( 'Skew X', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => ['px' => ['min' => -180,'max' => 180]],
                'condition' => [$cl_el_name_skew.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
            ]
        );

        $element->add_responsive_control(
            $cl_el_name_skew.'_y',
            [
                'label' => esc_html__( 'Skew Y', 'Booster Addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['deg'],
                'range' => ['px' => ['min' => -180,'max' => 180]],
                'condition' => [$cl_el_name_skew.'_toggle' => 'yes','elb_transform' => 'yes',$hoverConditionName => $hoverCondition],
                'selectors' => [
                    '(desktop)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y.SIZE || 1}}) '
                            . 'skew({{'.$cl_el_name_skew.'_x.SIZE || 0}}deg, {{'.$cl_el_name_skew.'_y.SIZE || 0}}deg);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y.SIZE || 1}}) '
                            . 'skew({{'.$cl_el_name_skew.'_x.SIZE || 0}}deg, {{'.$cl_el_name_skew.'_y.SIZE || 0}}deg);',
                    '(tablet)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_tablet.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_tablet.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_tablet.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_tablet.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_tablet.SIZE || 1}}) '
                            . 'skew({{'.$cl_el_name_skew.'_x_tablet.SIZE || 0}}deg, {{'.$cl_el_name_skew.'_y_tablet.SIZE || 0}}deg);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_tablet.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_tablet.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_tablet.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_tablet.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_tablet.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_tablet.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_tablet.SIZE || 1}}) '
                            . 'skew({{'.$cl_el_name_skew.'_x_tablet.SIZE || 0}}deg, {{'.$cl_el_name_skew.'_y_tablet.SIZE || 0}}deg);',
                    '(mobile)'.$hv_selec =>
                        '-webkit-transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_mobile.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_mobile.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_mobile.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_mobile.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_mobile.SIZE || 1}}) '
                            . 'skew({{'.$cl_el_name_skew.'_x_mobile.SIZE || 0}}deg, {{'.$cl_el_name_skew.'_y_mobile.SIZE || 0}}deg);'
                        . 'transform:'
                            . 'translate({{'.$cl_el_name_translate.'_x_mobile.SIZE || 0}}px, {{'.$cl_el_name_translate.'_y_mobile.SIZE || 0}}px) '
                            . 'rotateX({{'.$cl_el_name_rotate.'_x_mobile.SIZE || 0}}deg) rotateY({{'.$cl_el_name_rotate.'_y_mobile.SIZE || 0}}deg) rotateZ({{'.$cl_el_name_rotate.'_z_mobile.SIZE || 0}}deg) '
                            . 'scaleX({{'.$cl_el_name_scale.'_x_mobile.SIZE || 1}}) scaleY({{'.$cl_el_name_scale.'_y_mobile.SIZE || 1}}) '
                            . 'skew({{'.$cl_el_name_skew.'_x_mobile.SIZE || 0}}deg, {{'.$cl_el_name_skew.'_y_mobile.SIZE || 0}}deg);'
                ]
            ]
        );

        $element->end_popover();
    }
}