<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Group_Control_ELB_Text_Gradient extends Group_Control_Base {

	protected static $fields;

    public static function get_type() {
        return 'elb-text-gradient';
    }

	protected function init_fields() {
		$controls = [];
        $controls['gradient_enabled'] =  [
            'label' => esc_html__( 'Enable Gradient', 'booster-addons' ),
            'type' => Controls_Manager::SWITCHER,
            'default' => 'no',
            'frontend_available' => true,
        ];


        $controls['color_one'] =  [
            'label' => esc_html__( 'Color 1', 'booster-addons' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#333333',
            'selectors' => [
                #'{{SELECTOR}}' => 'background:unset!important; -webkit-background-clip: unset!important;-webkit-text-fill-color: unset!important;background-clip: unset!important;text-fill-color: unset!important; color: {{color_one.VALUE}};'
                '{{SELECTOR}}' => 'background:unset!important; -webkit-background-clip: unset!important;-webkit-text-fill-color: {{color_one.VALUE}}!important;background-clip: unset!important;text-fill-color: {{color_one.VALUE}}!important; color: {{color_one.VALUE}};',
                '{{SELECTOR}} *' => '-webkit-text-fill-color:currentColor;text-fill-color:currentColor;'
            ],
            'frontend_available' => true,
        ];
        $controls['color_two'] =  [
            'label' => esc_html__( 'Color 2', 'booster-addons' ),
            'type' => Controls_Manager::COLOR,
            'frontend_available' => true,
            'default' => '#333333',
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ]
        ];
        $controls['color_one_pos'] = [
            'label' => _x( 'Color 1 Position', 'Background Control', 'booster-addons' ),
            'type' => Controls_Manager::NUMBER,
            'min' => '0', 'max' => '100',
            'default' => '0',
            'dynamic' => ['active' => true],
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ]
        ];
        $controls['color_two_pos'] = [
            'label' => esc_html__( 'Color 2 Position', 'booster-addons' ),
            'type' => Controls_Manager::NUMBER,
            'min' => '0', 'max' => '100',
            'default' => '100',
            'dynamic' => ['active' => true],
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ]
        ];

        $controls['direction'] = [
            'label' => esc_html__( 'Gradient Direction', 'booster-addons' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'to right' => esc_html__( 'To Right', 'booster-addons' ),
                'to left' => esc_html__( 'To Left', 'booster-addons' ),
                'to top' => esc_html__( 'To Top', 'booster-addons' ),
                'to top right' => esc_html__( 'To Top Right', 'booster-addons' ),
                'to top left' => esc_html__( 'To Top Left', 'booster-addons' ),
                'to bottom' => esc_html__( 'To Bottom', 'booster-addons' ),
                'to bottom right' => esc_html__( 'To Bottom Right', 'booster-addons' ),
                'to bottom left' => esc_html__( 'To Bottom Left', 'booster-addons' ),

            ],
            'default' => 'to right',
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ],
        ];
        $controls['elb_text_gradient'] = [
            'label' => _x( 'Text Gradient', 'Text Gradient Control', 'booster-addons' ),
            'type' => 'elb_text_gradient',
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ],
            'selectors' => [
                '{{SELECTOR}}' => 'background: linear-gradient({{direction.VALUE}},{{color_one.VALUE}} {{color_one_pos.VALUE}}%,{{color_two.VALUE}} {{color_two_pos.VALUE}}%)!important;-webkit-background-clip: text!important;-webkit-text-fill-color: transparent!important;background-clip: text!important;text-fill-color: transparent!important;',
            ],
        ];

        return $controls;
	}

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_title' => _x( 'Text Gradient', 'Text Gradient Control', 'booster-addons' ),
				'starter_name' => 'elb_text_gradient_type',
				'starter_value' => 'yes',
				'settings' => [
					'render_type' => 'ui',
				],
			],
		];
	}



}