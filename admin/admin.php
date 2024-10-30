<?php
if(!elb_check_pro_version())://Check if Pro Exists

if(!defined( 'ABSPATH' )) exit(); 

class ELB_Admin_Init{	

    public function __construct(){
		add_action('admin_menu', [$this, 'elb_dashboard_menu']);
    }

    public function elb_enqueue_admin_scripts(){
        wp_enqueue_style('elb-admin-style', BOOSTER_ADDONS_URL . 'admin/assets/css/elb-admin.css', false, BOOSTER_ADDONS_VERSION);
        wp_enqueue_script('elb-admin-vue-script', BOOSTER_ADDONS_URL.'admin/assets/js/vue.js',null, true, true);        
        if(get_current_screen()):
	        $screen = get_current_screen();
	        switch ($screen->id) {
	        	case 'booster-addons_page_elb-widgets-manager':
		        	$widget_manager_data = array( 
						'ajax_handler'		=> 		admin_url( 'admin-ajax.php'),
						'widgetsBundle'		=>		ELB_Widgets_Bundle_Free::get_all_widgets(),
						'widgetsActive'		=>		elb_get_option('active_widgets'),
					);
			        wp_enqueue_script('elb-admin-widgets-manager', BOOSTER_ADDONS_URL.'admin/assets/js/widgets-manager.js',null, true, true);
					wp_localize_script('elb-admin-widgets-manager', 'elbbc_data', $widget_manager_data ); 
				break;	
				case 'booster-addons_page_elb-extensions-manager':
		        	$extensions_manager_data = array( 
						'ajax_handler'			=> 		admin_url( 'admin-ajax.php'),
						'extensionsBundle'		=>		ELB_Extensions_Bundle_Free::get_all_extensions(),
						'extensionsActive'		=>		elb_get_option('active_extensions'),
					);
			        wp_enqueue_script('elb-admin-extensions-manager', BOOSTER_ADDONS_URL.'admin/assets/js/extensions-manager.js',null, true, true);
					wp_localize_script('elb-admin-extensions-manager', 'elbbc_data', $extensions_manager_data ); 
				break;				
				case 'booster-addons_page_elb-icon-manager':
		        	$icon_manager_data = array( 
						'ajax_handler'		=> 		admin_url( 'admin-ajax.php'),
					);
			        wp_enqueue_script('elb-admin-icon-manager', BOOSTER_ADDONS_URL.'admin/assets/js/icon-manager.js',null, true, true);
					wp_localize_script('elb-admin-icon-manager', 'elbbc_data', $icon_manager_data ); 
				break;
				case 'booster-addons_page_elb-demo-importer':
		        	$demo_importer_data = array(
						'ajax_handler'		=> 	admin_url( 'admin-ajax.php'),
						'demos_file_json'	=> 	wp_remote_retrieve_body(wp_remote_get('https://utils.booster-addons.com/online-sites-content/home-demos/demos.json'))
					);
			        wp_enqueue_script('elb-admin-demo-importer', BOOSTER_ADDONS_URL.'admin/assets/js/demo-importer.js',null, true, true);
					wp_localize_script('elb-admin-demo-importer', 'elbbc_data', $demo_importer_data ); 
				break;
				case 'booster-addons_page_elb-about-plugin':
		        	$about_plugin_data = array( 
						'ajax_handler'		=> 	admin_url( 'admin-ajax.php'),
					);
			        wp_enqueue_script('elb-admin-about-plugin', BOOSTER_ADDONS_URL.'admin/assets/js/about-plugin.js',null, true, true);
					wp_localize_script('elb-admin-about-plugin', 'elbbc_data', $about_plugin_data ); 
				break;
				case 'booster-addons_page_elb-objects-decoration':
		        	$objects_decoration_data = array( 
						'ajax_handler'		=> 	admin_url( 'admin-ajax.php'),						
					);
			        wp_enqueue_script('elb-admin-objects-decoration', BOOSTER_ADDONS_URL.'admin/assets/js/objects-decoration.js',null, true, true);
					wp_localize_script('elb-admin-objects-decoration', 'elbbc_data', $objects_decoration_data ); 
				break;
				/*
				case 'booster-addons_page_elb-image-mask':
		        	$image_mask_data = array( 
						'ajax_handler'		=> 	admin_url( 'admin-ajax.php'),						
					);
			        wp_enqueue_script('elb-admin-image-mask', BOOSTER_ADDONS_URL.'admin/assets/js/image-mask.js',null, true, true);
					wp_localize_script('elb-admin-image-mask', 'elbbc_data', $image_mask_data ); 
				break;
				*/

	        }        	
        endif;
    }

    public static function elb_admin_menu_items(){
    	return [
	        'dashboard' => [
	            'id' => 'dashboard',
	            'name' => esc_html__('Welcome','booster-addons'),
	            'title' => esc_html__('Welcome','booster-addons'),
	            'description' => '',
	            'icon' => 'house2',
	            'link' => admin_url('admin.php?page=booster-addons'),                        
	        ],
	        'widgets' => [
	            'id' => 'widgets',
	            'name' => esc_html__('Widgets','booster-addons'),
	            'title' => esc_html__('Widgets Manager','booster-addons'),
	            'description' => esc_html__('Manage your booster addons widgets by enabling or disabling them.','booster-addons'),
	            'icon' => 'stack',
	            'link' => admin_url('admin.php?page=elb-widgets-manager'),                        
	        ],
	        'extensions' => [
	            'id' => 'extensions',
	            'name' => esc_html__('Extensions','booster-addons'),
	            'title' => esc_html__('Extensions Manager','booster-addons'),
	            'description' => esc_html__('Manage your booster addons extensions by enabling or disabling them.','booster-addons'),
	            'icon' => 'plugging_in',
	            'link' => admin_url('admin.php?page=elb-extensions-manager'),                        
	        ],
	        'icon_manager' => [
	            'id' => 'icon_manager',
	            'name' => esc_html__('Icons Manager','booster-addons'),
	            'title' => esc_html__('Icons Manager','booster-addons'),
	            'description' => esc_html__('Create new iconsets & add unlimited icons to be used in your widgets.','booster-addons'),
	            'icon' => 'puzzle',
	            'link' => admin_url('admin.php?page=elb-icon-manager'),                        
	        ],
	        'objects_decoration' => [
	            'id' => 'objects_decoration',
	            'name' => esc_html__('Objects Decoration','booster-addons'),
	            'title' => esc_html__('Objects Decoration','booster-addons'),
	            'description' => esc_html__('Add SVG shapes to be used as advanced section background decorations.','booster-addons'),
	            'icon' => 'design_tool1',
	            'link' => admin_url('admin.php?page=elb-objects-decoration'),                        
	        ],
	        /*
	        'image_mask' => [
	            'id' => 'image_mask',
	            'name' => esc_html__('Image Mask Shapes','booster-addons'),
	            'title' => esc_html__('Image Mask Shapes','booster-addons'),
	            'description' => esc_html__('Add SVG shapes to be used in elements as masking decoration.','booster-addons'),
	            'icon' => 'design_tool1',
	            'link' => admin_url('admin.php?page=elb-image-mask'),                        
	        ], 
	        */
	        'demo_importer' => [
	            'id' => 'demo_importer',
	            'name' => esc_html__('Demos Importer','booster-addons'),
	            'title' => esc_html__('Demo Importer','booster-addons'),
	            'description' => esc_html__('Import pre-made modern demos to your website with one click.','booster-addons'),
	            'icon' => 'browser',
	            'link' => admin_url('admin.php?page=elb-demo-importer'),                        
	        ], 	           
	        'about_plugin' => [
	            'id' => 'about_plugin',
	            'name' => esc_html__('About Booster Addons','booster-addons'),
	            'title' => esc_html__('About Us','booster-addons'),
	            'description' => esc_html__('Get to know the amazing team behind booster addons and our vision.','booster-addons'),
	            'icon' => 'mic3',
	            'link' => admin_url('admin.php?page=elb-about-plugin'),                        
	        ],   
	        'documentation' => [
	            'id' => 'documentation',
	            'name' => esc_html__('Documentation','booster-addons'),
	            'title' => esc_html__('Documentation','booster-addons'),
	            'description' => esc_html__('Access booster addons online docs to get started with plugin.','booster-addons'),
	            'icon' => 'notebook',
	            'link' => EB_ONLINE_DOC_URL
	        ],	        
	        'videos' => [
	            'id' => 'videos',
	            'name' => esc_html__('Video Tutorials','booster-addons'),
	            'title' => esc_html__('Video Tutorials','booster-addons'),
	            'description' => esc_html__('Watch our video tutorials for more in depth information about the plugin.','booster-addons'),
	            'icon' => 'video',
	            'link' => 'https://www.youtube.com/playlist?list=PL5YwApQRLWcYgwcfgT_rAzaMHdNMkXXxU'
	        ],
	        'support' => [
	            'id' => 'support',
	            'name' => esc_html__('Plugin Support','booster-addons'),
	            'title' => esc_html__('Plugin Support','booster-addons'),
	            'description' => esc_html__('Can\'t find what you are looking for, feel free to submit a support tickets.','booster-addons'),
	            'icon' => 'support',
	            'link' => EB_ONLINE_SUPPORT_URL
	        ],
	        'get_involved' => [
	            'id' => 'get_involved',
	            'name' => esc_html__('Get Involved','booster-addons'),
	            'title' => esc_html__('Get Involved','booster-addons'),
	            'description' => esc_html__('Get involved by submitting your feedback & suggestions to our team.','booster-addons'),
	            'icon' => 'users_talkroom',
	            'link' => EB_ONLINE_DOC_URL.'other/feedback'
	        ],
	        'blog' => [
	            'id' => 'blog',
	            'name' => esc_html__('Visit Blog','booster-addons'),
	            'title' => esc_html__('Visit Blog','booster-addons'),
	            'description' => esc_html__('Visit our plugin blog more for more amazing articles and news.','booster-addons'),
	            'icon' => 'newsletter',
	            'link' => EB_ONLINE_BLOG_URL
	        ],
	        'bug' => [
	            'id' => 'bug',
	            'name' => esc_html__('Bug Report','booster-addons'),
	            'title' => esc_html__('Bug Report','booster-addons'),
	            'description' => esc_html__('Report a bug and help us make booster addons better and bug free.','booster-addons'),
	            'icon' => 'bug2',
	            'link' => EB_ONLINE_DOC_URL.'other/bug-report'
	        ],
	        'design_submission' => [
	            'id' => 'design_submission',
	            'name' => esc_html__('Design Submission','booster-addons'),
	            'title' => esc_html__('Design Submission','booster-addons'),
	            'description' => esc_html__('Want to be featured in our website, submit your design createrd with booster addons.','booster-addons'),
	            'icon' => 'design_tool2',
	            'link' => EB_ONLINE_DOC_URL.'other/submit-design'
	        ],
		];
    }

    public function elb_dashboard_menu(){
    	//Add Admin Menu Page
	   $dashboard = add_menu_page(
	        esc_html__('Booster Addons','booster-addons'),     
	        esc_html__('Booster Addons','booster-addons'),     
	        'manage_options',  
	        'booster-addons',    
	        [$this, 'elb_dashboard_welcome_render'],
	        BOOSTER_ADDONS_URL_IMAGES_ADMIN.'logo-small.png'
	        
	    ); 
	    add_action( 'load-' . $dashboard, [$this,'elb_enqueue_admin_scripts']);
	    #Welcome Dashboard
	    $welcome = add_submenu_page(
	        'booster-addons',
	        esc_html__('Welcome Dashboard','booster-addons'),
	        esc_html__('Welcome Dashboard','booster-addons'),
	        'manage_options',
	        'booster-addons',
	        [$this, 'elb_dashboard_welcome_render']	        
	    );
	    add_action( 'load-' . $welcome, [$this,'elb_enqueue_admin_scripts']);

	    #Widgets Manager
	    $widgets_manager = add_submenu_page(
	        'booster-addons',
	        esc_html__('Widgets Manager','booster-addons'),
	        esc_html__('Widgets Manager','booster-addons'),
	        'manage_options',
	        'elb-widgets-manager',
	        [$this, 'elb_dashboard_widgets_render']	        
	    );
	    add_action( 'load-' . $widgets_manager, [$this,'elb_enqueue_admin_scripts']);

	    #Extensions Manager
	    $extensions_manager = add_submenu_page(
	        'booster-addons',
	        esc_html__('Extensions Manager','booster-addons'),
	        esc_html__('Extensions Manager','booster-addons'),
	        'manage_options',
	        'elb-extensions-manager',
	        [$this, 'elb_dashboard_extensions_render']	        
	    );
	    add_action( 'load-' . $extensions_manager, [$this,'elb_enqueue_admin_scripts']);

	    #Icon Manager
	    $icon_manager = add_submenu_page(
	        'booster-addons',
	        esc_html__('Icon Manager','booster-addons'),
	        esc_html__('Icon Manager','booster-addons'),
	        'manage_options',
	        'elb-icon-manager',
	        [$this, 'elb_dashboard_icon_manager_render']
	    );
	    add_action( 'load-' . $icon_manager, [$this,'elb_enqueue_admin_scripts']);

	    #Objects Decoration
	    $objects_decoration = add_submenu_page(
	        'booster-addons',
	        esc_html__('Objects Decoration','booster-addons'),
	        esc_html__('Objects Decoration','booster-addons'),
	        'manage_options',
	        'elb-objects-decoration',
	        [$this, 'elb_dashboard_objects_decoration_render']
	    );
	    add_action( 'load-' . $objects_decoration, [$this,'elb_enqueue_admin_scripts']);

	    /*
	    #Image Mask
	    $image_mask = add_submenu_page(
	        'booster-addons',
	        esc_html__('Image Mask','booster-addons'),
	        esc_html__('Image Mask','booster-addons'),
	        'manage_options',
	        'elb-image-mask',
	        [$this, 'elb_dashboard_image_mask_render']
	    );
	    add_action( 'load-' . $image_mask, [$this,'elb_enqueue_admin_scripts']);
	    */

	    #Demo Importer
	    $demo_importer = add_submenu_page(
	        'booster-addons',
	        esc_html__('Demo Importer','booster-addons'),
	        esc_html__('Demo Importer','booster-addons'),
	        'manage_options',
	        'elb-demo-importer',
	        [$this, 'elb_dashboard_demo_importer_render']
	    );	    
	    add_action( 'load-' . $demo_importer, [$this,'elb_enqueue_admin_scripts']);
	   
     	#About Page
	    $about_plugin = add_submenu_page(
	        'booster-addons',
	        esc_html__('About','booster-addons'),
	        esc_html__('About','booster-addons'),
	        'manage_options',
	        'elb-about-plugin',
	        [$this, 'elb_dashboard_about_plugin_render']
	    );
	    add_action( 'load-' . $about_plugin, [$this,'elb_enqueue_admin_scripts']);

    }

	public static function elb_dashboard_loading_render(){
		?>
		<div class="elbd-dash-load-ctn elbd-tr-3" :data-type="loading.type" :data-situation="loading.situation">
			<div class="elbd-dash-cls elbd-tr-2" @click.prevent.default="loadingBarClose"></div>
			<div class="elbd-dash-load-icon">
				<span v-if="loading.type == 'loading'"><?php echo Elementor\CertainDev_Icons::get_icon('stopwatch','',28); ?></span>
				<span v-if="loading.type == 'success'"><?php echo Elementor\CertainDev_Icons::get_icon('done_all','',28); ?></span>
			</div>
			<div class="elbd-dash-load-info" v-if="loading.type == 'loading'">
				<div class="elbd-dash-load-title"><?php echo esc_html__('Please Wait...','booster-addons'); ?></div>
				<div class="elbd-dash-load-description"><?php echo esc_html__('We are processing your request.','booster-addons'); ?></div>
			</div>
			<div class="elbd-dash-load-info" v-if="loading.type == 'success'">
				<div class="elbd-dash-load-title"><?php echo esc_html__('Operation Done !','booster-addons'); ?></div>
				<div class="elbd-dash-load-description"><?php echo esc_html__('All the changes have been saved.','booster-addons'); ?></div>
			</div>
			<div class="elbd-dash-load-bar"><div class="elbd-dash-load-bar-ins elbd-tr-2" :style="'width:'+loading.percent+'%'"></div></div>
		</div>
		<?php 
	}    

	public static function elb_dashboard_confirm_dialog_render(){
		?>
		<div class="elbd-dash-cfdialog-ctn" :data-situation="dialog.situation">
			<div class="elbd-dash-cfdialog-ins elbd-fs">
				<div class="elbd-dash-cfdialog-cls elbd-tr-2" @click.prevent.default="dialogSetAction('inactive',null,null)"></div>
				<div class="elbd-dash-cfdialog-icon"><?php echo Elementor\CertainDev_Icons::get_icon('warning','',32); ?></div>
				<div class="elbd-dash-cfdialog-txt">
					<div class="elbd-dash-cfdialog-title elbd-fs"><?php echo esc_html__('Please Wait!','booster-addons'); ?></div>
					<div class="elbd-dash-cfdialog-msg elbd-fs"><?php echo esc_html__('Howdy, are you sure you want to continue.','booster-addons'); ?></div>					
				</div>
			</div>
			<div class="elbd-dash-cfdialog-btns elbd-fs">
				<div class="elbd-dash-cfdialog-btn elbd-tr-2 elbd-3-bg" @click.prevent.default="dialogSetAction('inactive',null,null)"><?php echo esc_html__('Dismiss','booster-addons'); ?></div>
				<div class="elbd-dash-cfdialog-btn elbd-tr-2 elbd-2-bg" @click.prevent.default="dialogComfirm()"><?php echo esc_html__('Confirm','booster-addons'); ?></div>
			</div>
		</div>
		<?php 
	}   


    public function elb_dashboard_welcome_render(){
    	$active = 'dashboard';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/welcome.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }

    public function elb_dashboard_widgets_render(){
    	$active = 'widgets';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/widgets-manager.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }

    public function elb_dashboard_extensions_render(){
    	$active = 'extensions';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/extensions-manager.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }

 

    public function elb_dashboard_icon_manager_render(){
    	$active = 'icon_manager';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/icon-manager.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }


    public function elb_dashboard_demo_importer_render(){
    	$active = 'demo_importer';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/demo-importer.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }

    public function elb_dashboard_about_plugin_render(){
    	$active = 'about_plugin';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/about-plugin.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }
    
    public function elb_dashboard_objects_decoration_render(){
    	$active = 'objects_decoration';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/objects-decoration.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }

    public function elb_dashboard_image_mask_render(){
    	$active = 'image_mask';
        require_once(BOOSTER_ADDONS_PATH.'admin/views/header.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/image-mask.php');
        require_once(BOOSTER_ADDONS_PATH.'admin/views/footer.php');
    }


}

	new ELB_Admin_Init();
endif;	