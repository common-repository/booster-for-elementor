<?php
namespace Elementor;
class CertainDev_ImageMaskShapes{
	public static $shapes;
	function __construct(){
	}

	public static function get_object($shapeId, $color = []){
		$svg = $fill = $gradient = '';
		$shapesArray = CertainDev_ImageMaskShapes::get_shapes_list_full();		
		if(array_key_exists($shapeId,$shapesArray)){
			
		}
		return $svg;
	}

	public static function get_shapes_list(){
		return elb_get_option('image_maskshapes');
	} 

	public static function get_shapes_list_default(){		
		$img_dir = BOOSTER_ADDONS_URL_IMAGES .'shapes/';
		$shapes_array = [];
		$pref = 'shape_';
		for ($i=1; $i <=47 ; $i++) { 
			$shapes_array[$pref.$i] = [
				'display_name' => ucwords($pref.' '.$i),
				'name' => $pref.''.$i,
				'url' => $img_dir.$pref.$i.'.svg',
			];
		}
		return $shapes_array;
	} 

	public static function get_shapes_list_full(){
		return array_merge(elb_get_option('image_maskshapes'), CertainDev_ImageMaskShapes::$shapes);
	} 
}

