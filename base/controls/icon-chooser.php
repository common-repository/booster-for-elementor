<?php 
namespace Elementor;

class ELB_Control_Icon_Chooser extends Base_Data_Control {
	
	public function get_type(){
		return 'elb_icon_chooser';
	}
	public function enqueue(){
		wp_register_style('elb-controls-style',BOOSTER_ADDONS_URL . 'admin/assets/css/controls/controls-style.css',array(),BOOSTER_ADDONS_VERSION);
		wp_enqueue_style('elb-controls-style');
		wp_register_script('elb-iconchooser-control-js',BOOSTER_ADDONS_URL . 'admin/assets/js/controls/icon-chooser.js', array(),BOOSTER_ADDONS_VERSION);
		wp_enqueue_script('elb-iconchooser-control-js');
		$plugin_uri_admin = array(
			'ajax_handler' 		=> 	admin_url('admin-ajax.php'), 
			'schemeEnabled'		=>	elb_get_option('booster_color_scheme')
		);
		wp_localize_script('elb-iconchooser-control-js', 'plugindir', $plugin_uri_admin);
	}

	protected function get_default_settings(){
		return [
			'label_block' => false
		];
	}

	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<div class="elementor-control-input-wrapper">
				<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
				<div class="elb-ichs-ctn" data-situation="hidden">
					<input id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area elb-ichs-inp elementor-input" type="hidden" data-setting="{{ data.name }}">
					<div class="elb-ichs-ctrl">
						<div class="elb-ichs-icon-real"></div>
						<div class="elb-ichs-toggler" onclick="elb_show_iconchooser(this)"></div>
					</div>
					<div class="elb-ichs-list-ctn">
						<div class="elb-ichs-search"><input type="text" onkeyup="elb_search_iconchooser(this)" placeholder="<?php echo esc_attr('Search for Icon','booster-addons') ?>"></div>
						<div class="elb-ichs-list">
							<?php //echo CertainDev_Icons::get_list_html(); ?>
						</div>		
					</div>
				</div>

			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}



}
