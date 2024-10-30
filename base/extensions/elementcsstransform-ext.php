<?php
namespace Elementor;
/*
	EXTENSIONS : Elements CSS Tranform 
*/
if (!defined('ABSPATH')) exit; 
new Elb_ElementCssTransform_Extension();
class Elb_ElementCssTransform_Extension{
	
	function __construct(){
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_controls'], 10);
        add_action('elementor/element/column/section_advanced/after_section_end', [$this, 'register_controls'], 10);
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_controls'], 10);
	}

	public function register_controls($element){
        ELB_CssTransform_Tab::init($element);		
    }


}