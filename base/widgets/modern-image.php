<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_ModernImage_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-modernimage-widget';
    }
    public function get_title() {
        return esc_html__('Modern Image', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-image-rollover';
    }
    public function get_categories() {
        return array('booster-addons');
    }
    public function get_script_depends() {
        return [
            'elb-tilt',
        ];
    }
    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );
        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => ['url' => BOOSTER_ADDONS_URL_IMAGES.'pres1.jpg'],
            ]
        ); 
        $this->add_control(
            'heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Heading Title', 'booster-addons'),
                'label_block' => true,
                'default' => 'Booster Addons',
               
            ]
        );
        $this->add_control(
            'sub_heading',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Sub Heading', 'booster-addons'),
                'label_block' => true,
                'default' => 'Premium Addons',
            ]
        );        
        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'booster-addons'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => ''],
            ]
        );
        $this->end_controls_section();

        ELB_ModernImage_Tab::init($this);

    }   


    protected function render() {
        $settings = $this->get_settings_for_display();
        $image_settings = [
            '3d_enabled'            => $settings['3d_enabled'],
            'max_tilt'              => $settings['max_tilt'],
            'scale_tilt'            => $settings['scale_tilt'],
            'glare_tilt_enabled'    => $settings['glare_tilt_enabled'],
            'glare_tilt_value'      => $settings['glare_tilt_value'],
            'reset_tilt_enabled'    => $settings['reset_tilt_enabled'],
            'heading'               => $settings['heading'],
            'sub_heading'           => $settings['sub_heading'],
            'image'                 => $settings['image']['url'],
            'frame_enabled'         => $settings['frame_enabled'],
            'hrz_pos'               => $settings['hrz_pos'],
            'vrt_pos'               => $settings['vrt_pos'],
            'style'                 => $settings['style'],
            'show_ovl_effect'       => $settings['show_ovl_effect'],
            'show_content_effect'   => $settings['show_content_effect'],
            'link'                  => $settings['link'],
        ];
        $output = elb_modernimage_output($image_settings);
        echo apply_filters('elb_modernimage_output', $output, $settings);
    }

}