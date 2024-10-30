<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_SingleIcon_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-singleicon-widget';
    }
    public function get_title() {
        return esc_html__('Single Icon', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-hypster';
    }
    public function get_categories() {
        return array('booster-addons');
    }
   protected function _register_controls(){
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );    
        $this->add_control(
            'icon',
            [
                'type' => 'elb_icon_chooser',
                'label' => esc_html__('Choose Icon', 'booster-addons'),
                'dynamic' => ['active' => true],
                'label_block' => true,
                'default' => 'stack'   
            ]
        );
        $this->add_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'booster-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => ['title' => esc_html__('Left', 'booster-addons'), 'icon' => 'fa fa-align-left'],
                    'center' => ['title' => esc_html__('Center', 'booster-addons'),'icon' => 'fa fa-align-center'],
                    'flex-end' => ['title' => esc_html__('Right', 'booster-addons'),'icon' => 'fa fa-align-right'],
                ],                
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .elb-sgicn-ctn' => 'justify-content: {{align}};',
                ],
            ]
        );
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#'],
            ]
        );        
        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'booster-addons'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'icon'
            ]
        );
        $this->end_controls_section();
        ELB_IconHover_Tab::init($this,true);   
   }
    protected function render() {
        $settings = $this->get_settings_for_display();  
        $output = '<div class="elb-sgicn-ctn elb-widget">';
            $output .= ELB_IconHover_Tab::render($settings,'single'); 
        $output .= '</div>';
        echo apply_filters('elb_singleicon_output', $output, $settings);
    }
}                 