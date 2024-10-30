<?php
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Control_Icon_Gradient extends Control_Base_Multiple  {

	public function get_type() {
		return 'elb_icon_gradient';
	}

	public function get_default_value() {
		return [
			'gradient_enabled' => 'no',
			'color_one' => '#333333',
			'color_one_pos' => 30,
			'color_two' => '#333333',
			'color_two_pos' => 100,
			'direction' => 'to-right'
		];
	}
	public function content_template(){}



}

