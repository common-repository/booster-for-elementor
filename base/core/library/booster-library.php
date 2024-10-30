<?php
namespace Elementor;
use Elementor\Api;
use Elementor\Plugin;
use Elementor\TemplateLibrary\Source_Base;

//Booster Addons Templates & Blocks Library
if (!defined('ABSPATH')) exit; 


class ELB_Templates_Library extends Source_Base{

	/**
	 * Booster library option key.
	 */
	const ELB_LIBRARY_OPTION_KEY = 'elb_library_info';

	/**
	 *Timestamp cache key to trigger library sync.
	 */
	const ELB_LIBRARY_TIMESTAMP_CACHE_KEY = 'elb_library_cache';


	/**
	 * Booster API info URL.
	 */
	const ELB_LIBRARY_INFO_URL = 'https://utils.booster-addons.com/booster-library/info';


	/**
	 * Booster API get template content URL.
	 */
	const ELB_LIBRARY_CONTENT_URL = 'https://utils.booster-addons.com/booster-library/content/';

	/**
	 * Booster API get thumbnail URL.
	 */
	const ELB_LIBRARY_THUMBNAIL_URL = 'https://utils.booster-addons.com/booster-library/thumbnails/';


	public function get_id(){
		return 'booster-library';
	}

	public function get_title(){
		return esc_html__('Booster Library', 'booster-addons');
	}

	public function register_data(){}

	public function get_items($args = []){
		$library_data = self::get_library_data();
		$templates = $tags = [];
		if (!empty($library_data['templates'])){
			foreach ($library_data['templates'] as $template_data) {
				$templates[] = $this->prepare_template($template_data);
			}
		}
		if (!empty($library_data['tags'])){
			$tags = $library_data['tags'];
		}
		return [
			"tags" => $tags,
			"templates" => $templates
		];
	}
	//*********************** GET TAGS


	public static function get_library_data($force_update = false) {
		self::get_info_data($force_update);
		$library_data = get_option(self::ELB_LIBRARY_TIMESTAMP_CACHE_KEY);
		if (empty($library_data)){
			return [];
		}
		return $library_data;
	}


	private static function get_info_data($force_update = false) {
		$library_data = get_option(self::ELB_LIBRARY_TIMESTAMP_CACHE_KEY);
		if ( $force_update || false === $library_data) {			
			$timeout = ( $force_update ) ? 25 : 8;
			$response = wp_remote_get( self::ELB_LIBRARY_INFO_URL, [
				'timeout' => $timeout
			]);

			if (is_wp_error($response) || 200 !== (int) wp_remote_retrieve_response_code($response)){
				update_option(self::ELB_LIBRARY_TIMESTAMP_CACHE_KEY, []);
				return false;
			}
			$library_data = json_decode(wp_remote_retrieve_body($response), true);
			if (empty($library_data) || ! is_array($library_data)) {
				update_option(self::ELB_LIBRARY_TIMESTAMP_CACHE_KEY, []);
				return false;
			}

			if (isset($library_data)) {
				update_option(self::ELB_LIBRARY_TIMESTAMP_CACHE_KEY, $library_data, 'no');
			}
		}
		return $library_data;
	}

	public function get_item($template_id) {
		$templates = $this->get_items();
		return $templates[ $template_id ];
	}
	public function save_item( $template_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot save template to a remote source' );
	}
	public function update_item( $new_data ) {
		return new \WP_Error( 'invalid_request', 'Cannot update template to a remote source' );
	}
	public function delete_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot delete template from a remote source' );
	}
	public function export_template( $template_id ) {
		return new \WP_Error( 'invalid_request', 'Cannot export template from a remote source' );
	}



	public function get_data( array $args, $context = 'display' ) {
		$data = self::get_template_content($args['template_id']);
		if (is_wp_error($data)) {
			return $data;
		}
		$data['content'] = $this->replace_elements_ids($data['content']);
		$data['content'] = $this->process_export_import_content($data['content'], 'on_import');
		$post_id = $args['editor_post_id'];
		$document = Plugin::$instance->documents->get($post_id);
		if ( $document ) {
			$data['content'] = $document->get_elements_raw_data( $data['content'], true );
		}
		return $data;
	}

	public static function get_template_content($template_id) {
		$url = self::ELB_LIBRARY_CONTENT_URL.''.$template_id;
		$body_args = [
			'api_version' => BOOSTER_ADDONS_VERSION,
			'site_lang' => trailingslashit(home_url()),
		];
		$body_args = apply_filters('elementor/api/get_templates/body_args', $body_args );
		$response = wp_remote_get($url, [
			'timeout' => 40,
			'body' => $body_args,
		] );

		if (is_wp_error( $response)){
			return $response;
		}
		$response_code = (int) wp_remote_retrieve_response_code( $response );
		if ( 200 !== $response_code) {
			return new \WP_Error('response_code_error', sprintf( 'The request returned with a status code of %s.', $response_code));
		}
		$template_content = json_decode(wp_remote_retrieve_body($response), true);

		if ( isset( $template_content['error'])){
			return new \WP_Error( 'response_error', $template_content['error'] );
		}

		if ( empty( $template_content['data'] ) && empty( $template_content['content'] ) ) {
			return new \WP_Error( 'template_data_error', 'An invalid data was returned.' );
		}

		return $template_content;
	}


	private function prepare_template(array $template_data){
		return [
			'template_id' => $template_data['id'],
			'type' => $template_data['type'],
			'subtype' => $template_data['subtype'],
			'title' => $template_data['title'],
			'thumbnail' => self::ELB_LIBRARY_THUMBNAIL_URL.''.$template_data['id'].'.jpg',
			'date' => $template_data['tmpl_created'],
			'tags' => $template_data['tags'],
			'isPro' => $template_data['is_pro'],
			'url' => $template_data['url'],
		];
	}

}