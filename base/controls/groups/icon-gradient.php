<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Group_Control_ELB_Icon_Gradient extends Group_Control_Base {

    public static $fields;    

    public static function get_type() {
        return 'elb-icon-gradient';
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
            'label' => esc_html__( 'Color 1 Position', 'booster-addons' ),
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
            'dynamic' => ['active' => true],
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ],
        ];
        $controls['elb_icon_gradient'] = [
            'label' => _x( 'Icon Gradient', 'Icon Gradient Control', 'booster-addons' ),
            'type' => 'elb_icon_gradient',
            'condition' => [
                'gradient_enabled' => [ 'yes' ],
            ]
        ];

        return $controls;
	}

	protected function get_default_options() {
		return [
			'popover' => [
				'starter_title' => _x( 'Icon Gradient', 'Icon Gradient Control', 'booster-addons' ),
				'starter_name' => 'elb_icon_gradient_type',
				'starter_value' => 'yes',
				'settings' => [
					'render_type' => 'ui',
				],
			],
		];
	}



}