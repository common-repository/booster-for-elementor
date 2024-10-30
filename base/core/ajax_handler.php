<?php 
/*
	AJAX HANDLER 
*/
	
//Load New Icons Chooser
add_action('wp_ajax_elbLoadIconsChooser', 'elbfree_load_iconchooser_handler_callback' );
add_action('wp_ajax_nopriv_elbLoadIconsChooser', 'elbfree_load_iconchooser_handler_callback');
function elbfree_load_iconchooser_handler_callback(){	
	if(isset($_POST['action']) && trim($_POST['action']) == 'elbLoadIconsChooser'){ 	
		echo json_encode(\Elementor\CertainDev_Icons::get_icons_list());
	}
	die();
}

//Load Objects Chooser
add_action('wp_ajax_elbLoadObjectsChooser', 'elbfree_load_objectschooser_handler_callback' );
add_action('wp_ajax_nopriv_elbLoadObjectsChooser', 'elbfree_load_objectschooser_handler_callback');
function elbfree_load_objectschooser_handler_callback(){	
	if(isset($_POST['action']) && trim($_POST['action']) == 'elbLoadObjectsChooser'){ 	
		echo \Elementor\CertainDev_ObjectsDecoration::get_objects_list_final();
	}
	die();
}


//Save Changes for the enabled and disabled widgets
add_action('wp_ajax_elbSaveActiveWidgets', 'elbfree_save_enabled_widgets_handler_callback' );
add_action('wp_ajax_nopriv_elbSaveActiveWidgets', 'elbfree_save_enabled_widgets_handler_callback');
function elbfree_save_enabled_widgets_handler_callback(){
	if(isset($_POST['action']) && trim($_POST['action']) == 'elbSaveActiveWidgets'){
		$widgetsActive = (is_array($_POST['widgetsActive']) && sizeof($_POST['widgetsActive']) > 0) ? $_POST['widgetsActive'] : [null];
		elbfree_save_option('active_widgets',$widgetsActive);	
	}
	die();
}


//Save Changes for the enabled and disabled extensions
add_action('wp_ajax_elbSaveActiveExtensions', 'elbfree_save_enabled_extensions_handler_callback' );
add_action('wp_ajax_nopriv_elbSaveActiveExtensions', 'elbfree_save_enabled_extensions_handler_callback');
function elbfree_save_enabled_extensions_handler_callback(){
	if(isset($_POST['action']) && trim($_POST['action']) == 'elbSaveActiveExtensions'){
		$extensionsActive = (is_array($_POST['extensionsActive']) && sizeof($_POST['extensionsActive']) > 0) ? $_POST['extensionsActive'] : [null];
		elbfree_save_option('active_extensions',$extensionsActive);	
	}
	die();
}
