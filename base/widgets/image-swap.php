<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ImageSwap_Widget extends Widget_Base {
	public function get_name() {
		return 'elb-imageswap-widget';
	}
	public function get_title() {
		return esc_html__('Image Swap', 'booster-addons' );
	}
	public function get_icon() {
		return 'elb-icon eicon-image-rollover';
	} 
	public function get_categories() {
		return array('booster-addons');
	}

	protected function _register_controls() {
		/********************************************
			CONTENT SECTION       
		********************************************/
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'Element Booster'),
			]
		);
		$this->add_control(
			'image1',
			[
				'label' => esc_html__( 'First Image', 'booster-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => BOOSTER_ADDONS_URL_IMAGES.'swap1.jpg',
				],
			]
		);
		$this->add_control(
			'image2',
			[
				'label' => esc_html__( 'Second Image', 'booster-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => BOOSTER_ADDONS_URL_IMAGES.'swap2.jpg',					
				],
			]
		);
		$this->add_control(
			'swap_trigger',
			[
				'label' => esc_html__( 'Swap Trigger', 'booster-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'hover' => esc_html__('Hover', 'booster-addons'),
                    'click' => esc_html__('Click', 'booster-addons'),
                ],
				'default' => 'hover',
                'label_block' => true               
			]
		);
		$this->add_control(
			'hover_style',
			[
				'label' => esc_html__( 'Hover Style', 'booster-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => elb_two_elements_hover_effects(),
				'default' => 'fade',
                'label_block' => true               
			]
		);
		$this->add_control(
                'transition_speed',
                [
                    'label' => esc_html__('Transition Speed', 'booster-addons'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => '0', 'max' => '10',  'step' => '.1',
                    'dynamic' => ['active' => true],
                    'default' => '0.4',
                    'selectors' => ['{{WRAPPER}} .elb-hv2el-insider img' => '-webkit-transition: {{VALUE}}s; transition: {{VALUE}}s;'],
                ]
            );
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$data_trigger = '';
		if($settings['swap_trigger'] === 'hover' )
			$data_trigger='data-hover="';
		if($settings['swap_trigger'] === 'click' ) {
			$on_click = 'onclick="elb_change_situation(this,\'toogle\', \'none\', \'.elb-imgswp-ctn\')" ';
			$data_trigger=$on_click . 'data-click="';
		}
		$output = '';
		$output .= '<div class="elb-imgswp-ctn elb-hv2el-ctn" '.$data_trigger.esc_attr($settings['hover_style']).'">';
			$output .= '<img class="elb-imgswp-fake-image elb-fs" src="'.esc_url($settings['image1']['url']).'">' ;
			$output .= '<div class="elb-hv2el-insider">';
				$output .= '<img class="elb-imgswp-img1 elb-hv2el-1" src="'.esc_url($settings['image1']['url']).'">' ;
				$output .= '<img class="elb-imgswp-img2 elb-hv2el-2" src="'.esc_url($settings['image2']['url']).'">' ;
			$output .= '</div>';
		$output .= '</div>';
        echo apply_filters('elb_imageswap_output', $output, $settings);

	}

}