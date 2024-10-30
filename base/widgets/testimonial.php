<?php 
namespace Elementor;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class ELB_Testimonial_Widget extends Widget_Base {
    public function get_name() {
        return 'elb-testimonial-widget';
    }
    public function get_title() {
        return esc_html__('Testimonial', 'booster-addons');
    }
    public function get_icon() {
        return 'elb-icon eicon-testimonial';
    }
    public function get_categories() {
        return array('booster-addons');
    }

    protected function _register_controls() {
        /********************************************
                    CONTENT SECTION       
        ********************************************/
        //Content
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'booster-addons'),
            ]
        );           
        $this->add_control(
            'name',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Name', 'booster-addons'),
                'separator' => 'before',
                'label_block' => true,
                'default' => esc_html__('John Doe', 'booster-addons'),               
            ]
        ); 
        $this->add_control(
            'position',
            [
                'type' => Controls_Manager::TEXT,
                'label' => esc_html__('Position', 'booster-addons'),
                'label_block' => true,
                'default' => esc_html__('Booster Customer', 'booster-addons'),               
            ]
        ); 
        $this->add_control(
            'text',
            [
                'type' => Controls_Manager::TEXTAREA ,
                'label' => esc_html__('Text ', 'booster-addons'),
                'label_block' => true,
                'default' => 'A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.',
            ]
        );    
        $this->end_controls_section();

        //Avatar
        $this->start_controls_section(
            'section_avatar',
            [
                'label' => esc_html__('Avatar', 'booster-addons'),
            ]
        );
        $this->add_control(
            'avatar_enabled',
            [
                'label' => esc_html__( 'Enable Avatar', 'booster-addons' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'frontend_available' => true
            ]
        );
        $this->add_control(
            'avatar',
            [
                'label' => esc_html__('Avatar', 'booster-addons'),
                'type' => Controls_Manager::MEDIA,
                'condition' => ['avatar_enabled' => ['yes']],
                'default' => [
                    'url' =>  BOOSTER_ADDONS_URL_IMAGES.'face-1.jpg',
                ],
            ]
        );  
        $this->end_controls_section();

        ELB_Testiomnial_Tab::init($this);

       
   }
   
    protected function render() {
        $settings = $this->get_settings_for_display();  
        $output = ELB_Testiomnial_Tab::render($settings);
        echo apply_filters('elb_testimonial_output', $output, $settings);
    }
}                 