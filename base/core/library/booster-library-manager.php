<?php
namespace Elementor;


use Elementor\Core\Common\Modules\Ajax\Module as ElementorAjax;


//Booster Addons Templates & Blocks Library MANAGER
if (!defined('ABSPATH')) exit; 

class ELB_Templates_Library_Manager{
	protected static $elb_library_source = null;
    private static $instance = null;
	public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
            self::$instance->init();
        }
        return self::$instance;
    }


	public static function init() {
		add_action( 'elementor/editor/footer', [__CLASS__, 'print_html_views']);
		add_action( 'elementor/ajax/register_actions', [__CLASS__, 'ajax_calls']);
		add_action( 'elementor/editor/after_enqueue_scripts', [ __CLASS__, 'enqueue_library_assets_js']);
	}

	public static function get_source() {
		if ( is_null( self::$elb_library_source ) ) {
			self::$elb_library_source = new ELB_Templates_Library();
		}
		return self::$elb_library_source;
	}


	public static function enqueue_library_assets_js() {
		wp_enqueue_script('booster-addons-library', BOOSTER_ADDONS_URL . 'admin/assets/js/booster-library.js',['elementor-editor','jquery-hover-intent'],BOOSTER_ADDONS_VERSION,true);
		$localize_script = [
			'noTemplateFoundTitle' => esc_html__('No Templates Found', 'booster-addons'),
			'noTemplateFoundMessage' => esc_html__('Try different category or sync for new templates.', 'booster-addons'),
			'noTemplateResultTitle' => esc_html__('No Results Found', 'booster-addons'),
			'noTemplateResultMessage' => esc_html__('Please make sure your search is spelled correctly or try a different words.', 'booster-addons'),
			'proBooster' => (elb_check_pro_version()) ? true : false,
			'ASSETS_URL' => BOOSTER_ADDONS_URL
		];
		wp_localize_script('booster-addons-library','boosterAddonsLocal',$localize_script);		
		wp_enqueue_style('booster-addons-library',BOOSTER_ADDONS_URL . 'admin/assets/css/booster-library.css',[],BOOSTER_ADDONS_VERSION);
	}




	public static function print_html_views() {
		include_once BOOSTER_ADDONS_PATH . 'base/core/library/views.php';
	}

	public static function ajax_calls(ElementorAjax $ajax){
		//Requet Library Data
		$ajax->register_ajax_action('get_booster_library_data', function( $data ) {
			if ( ! current_user_can( 'edit_posts' ) ) {
				throw new \Exception( 'Access Denied' );
			}
			if ( ! empty( $data['editor_post_id'] ) ) {
				$editor_post_id = absint( $data['editor_post_id'] );
				if ( ! get_post( $editor_post_id ) ) {
					throw new \Exception( __( 'Post not found.', 'booster-addons' ) );
				}
			}
			$result = self::get_library_data( $data );
			return $result;			
		});

		//Request Single Template Data
		$ajax->register_ajax_action('get_booster_single_template_data', function( $data ) {
			if (!current_user_can('edit_posts')) {
				throw new \Exception('Access Denied');
			}
			if ( ! empty( $data['editor_post_id'])) {
				$editor_post_id = absint( $data['editor_post_id'] );
				if (!get_post( $editor_post_id)) {
					throw new \Exception( __('Post not found', 'booster-addons'));
				}
			}
			if ( empty( $data['template_id'] ) ) {
				throw new \Exception( __( 'Template id missing', 'booster-addons' ) );
			}
			$result = self::get_single_template_data( $data );
			return $result;
		} );
	}

	public static function get_library_data( array $args ) {
		$source = self::get_source();

		if ( ! empty( $args['sync'] ) ) {
			ELB_Templates_Library::get_library_data( true );
		}
		$data = $source->get_items();
		return [
			'templates' => $data['templates'] ,
			'tags' => $data['tags']
		];
	}

	public static function get_single_template_data( array $args ) {
		$source = self::get_source();
		$data = $source->get_data( $args );
		return $data;
	}




}