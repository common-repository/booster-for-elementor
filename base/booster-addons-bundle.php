<?php 
/*
	Create Global Booster Addons Class
	Registering All the widgets
*/

final class Booster_Addons_Free {
    use \Booster_Addons\Traits\Elb_Global;
	const VERSION = BOOSTER_ADDONS_VERSION;
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
	const MINIMUM_PHP_VERSION = '5.6';
    private static $instance;
    public static $elb_controls_map = [
        [
            'name' => 'elb_text_gradient',
            'path' => 'text-gradient',
            'class_name' => 'ELB_Control_Text_Gradient',
            'type' => 'normal'
        ],
        [
            'name' => 'elb-text-gradient',
            'path' => 'text-gradient',
            'class_name' => 'Group_Control_ELB_Text_Gradient',
            'type' => 'group'
        ],
        [
            'name' => 'elb_icon_gradient',
            'path' => 'icon-gradient',
            'class_name' => 'ELB_Control_Icon_Gradient',
            'type' => 'normal'
        ],
        [
            'name' => 'elb-icon-gradient',
            'path' => 'icon-gradient',
            'class_name' => 'Group_Control_ELB_Icon_Gradient',
            'type' => 'group'
        ],
        [
            'name' => 'elb_icon_chooser',
            'path' => 'icon-chooser',
            'class_name' => 'ELB_Control_Icon_Chooser',
            'type' => 'normal'
        ],
        [
            'name' => 'elb_object_chooser',
            'path' => 'object-chooser',
            'class_name' => 'ELB_Control_Object_Chooser',
            'type' => 'normal'
        ],
        [
            'name' => 'elb_imagemask_chooser',
            'path' => 'imagemask-chooser',
            'class_name' => 'ELB_Control_ImageMask_Chooser',
            'type' => 'normal'
        ]
    ];



	public static function instance() {
		if ( !isset( self::$instance ) && !self::$instance instanceof Booster_Addons_Free ) {
			self::$instance = new Booster_Addons_Free();
            self::$instance->apply_hooks();            
		}
        self::register_extensions();
		return self::$instance;
	}

    public static function register_extensions(){
        //Include The Extensions
        $active_extensions = elb_get_option('active_extensions');
        if(is_array($active_extensions)){
            foreach (ELB_Extensions_Bundle_Free::get_all_extensions() as $extensions) {
                $filePath =  __DIR__ . '/extensions/'.$extensions['id'].'-ext.php';
                if(in_array($extensions['id'],$active_extensions) && file_exists($filePath)):
                    require_once($filePath);
                endif;
            }            
        }
        
    }

    public function register_widgets() {
        $instance_manager = \Elementor\Plugin::instance()->widgets_manager;
        $elementor_namespace = str_replace('.','', addcslashes('Elementor.','E.'));
        $active_widgets = elb_get_option('active_widgets');
        foreach (ELB_Widgets_Bundle_Free::get_all_widgets() as $widget) {
            $filePath =  __DIR__ . '/widgets/'.$widget['id'].'.php';
            if(!isset($widget['woocommerce']) || (isset($widget['woocommerce']) && class_exists('WooCommerce'))):
                if(in_array($widget['id'],$active_widgets) && file_exists($filePath)):
                    require_once($filePath);
                    $cls_name = $elementor_namespace.$widget['class_name'];
                    $instance_manager->register_widget_type(new $cls_name());
                endif;
            endif;
        }        
    }

    public function register_controls() {
        $controls_manager = \Elementor\Plugin::$instance->controls_manager;
        $elementor_namespace = str_replace('.','', addcslashes('Elementor.','E.'));
        foreach (self::$elb_controls_map as $control) {
            $path = ($control['type'] == 'group') ? '/controls/groups/' : '/controls/';
            require_once( __DIR__ . $path.$control['path'].'.php' );
            $cls_name = $elementor_namespace.$control['class_name'];
            if($control['type'] == 'group')
                $controls_manager->add_group_control($control['name'], new $cls_name());
            else                
                $controls_manager->register_control($control['name'], new $cls_name());
        }
    }

    public function register_schemes() {
        require_once( __DIR__ .'/schemes/font-schemes.php' );
        \Elementor\Plugin::instance()->schemes_manager->register_scheme(new \Elementor\ELB_Scheme_Typography());
    }

    private function apply_hooks(){
        add_action( 'plugins_loaded', array( self::$instance, 'elb_load_plugin_textdomain') );    
        add_action('elementor/editor/after_save', array($this, 'elb_save_global_settings'), 10, 2);        

        add_action( 'elementor/frontend/after_register_scripts', [$this, 'register_frontend_scripts'] );
        add_action( 'elementor/frontend/after_register_styles', [$this, 'register_frontend_styles'], 10 );
        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'enqueue_frontend_styles'], 10 );
        add_action( 'elementor/widgets/widgets_registered', [$this,'register_widgets']);
        add_action( 'elementor/controls/controls_registered', [$this, 'register_controls']);
        add_action( 'elementor/init', [$this, 'add_booster_addons_categories']);
        if(!elb_check_pro_version())://Check if Pro Exists
            add_action('elementor/frontend/before_enqueue_scripts', function() {
                $devModeActiveMinifier =   (get_option('elb_dev_mode') == 'yes') ? '' : '.min';
                wp_enqueue_script('elb-app-script',BOOSTER_ADDONS_URL . 'assets/js/app'.$devModeActiveMinifier.'.js',['elementor-frontend','jquery'],BOOSTER_ADDONS_VERSION,true);

                $background_data = array( 
                    'extensions'      =>   elb_get_option('active_extensions'),                
                    'elbObjects'      =>   \Elementor\CertainDev_ObjectsDecoration::get_objects_list_JS(),                
                );
                wp_enqueue_script('elb-background-script',BOOSTER_ADDONS_URL . 'assets/js/background.js',['elementor-frontend','jquery'],BOOSTER_ADDONS_VERSION,true);
                wp_localize_script('elb-background-script', 'elbbc_data', $background_data ); 
            });
        endif;
        
        add_action('wp_footer', array($this, 'elb_render_global_html'));

    }
    
    public function register_frontend_scripts(){
       wp_register_script('elb-counter',BOOSTER_ADDONS_URL . 'assets/js/counter.js', ['jquery'],BOOSTER_ADDONS_VERSION,true);
       wp_register_script('elb-countdown',BOOSTER_ADDONS_URL . 'assets/js/countdown.js', ['jquery'],BOOSTER_ADDONS_VERSION,true);
       wp_register_script('elb-advanced-heading',BOOSTER_ADDONS_URL . 'assets/js/advanced-heading.js', ['jquery'],BOOSTER_ADDONS_VERSION,true);       
       if(!elb_check_pro_version())://Check if Pro Exists
            wp_register_script('elb-inview',BOOSTER_ADDONS_URL . 'assets/js/inview.js', ['jquery'],BOOSTER_ADDONS_VERSION,true);
            wp_register_script('elb-tilt',BOOSTER_ADDONS_URL . 'assets/js/tilt.js', ['jquery'],BOOSTER_ADDONS_VERSION,true);  
            wp_register_script('elb-masonry',BOOSTER_ADDONS_URL . 'assets/js/masonry.js', ['jquery'],BOOSTER_ADDONS_VERSION,true);
        endif;
    }

    public function register_frontend_styles(){
        $devModeActiveMinifier =   (get_option('elb_dev_mode') == 'yes') ? '' : '.min';
        wp_register_style('elb-global-styles',BOOSTER_ADDONS_URL . 'assets/css/global'.$devModeActiveMinifier.'.css',array(),BOOSTER_ADDONS_VERSION);
    }

    public function enqueue_frontend_styles(){
        wp_enqueue_style( 'elb-global-styles' );
    }


   public function add_booster_addons_categories() {
        \Elementor\Plugin::instance()->elements_manager->add_category('booster-addons',[
            'title' => __( 'Booster Addons', 'booster-addons' ),
            'icon' => 'fa fa-plug',
        ]);
    } 

    public function elb_load_plugin_textdomain(){
        $languages_dir = apply_filters('elb_lang_dir', trailingslashit(BOOSTER_ADDONS_PATH . 'languages'));
        $locale = apply_filters('plugin_locale', get_locale(), 'booster-addons');
        $mofile = sprintf('%1$s-%2$s.mo', 'booster-addons', $locale);
        $mofile_local = $languages_dir . $mofile;
        if (file_exists($mofile_local))
            load_textdomain('booster-addons', $mofile_local);
        else
            load_plugin_textdomain( 'booster-addons', false, $languages_dir );
        return false;
    }



  
}

function run_elemetor_booster_free(){
    return Booster_Addons_Free::instance();
}
run_elemetor_booster_free();