<?php 
namespace Elementor;

class ELB_Control_Object_Chooser extends Base_Data_Control {
	
	public function get_type(){
		return 'elb_object_chooser';
	}
	public function enqueue(){
		wp_register_style('elb-controls-style',BOOSTER_ADDONS_URL . 'admin/assets/css/controls/controls-style.css',array(),BOOSTER_ADDONS_VERSION);
		wp_enqueue_style('elb-controls-style');
		wp_register_script('elb-objectchooser-control-js',BOOSTER_ADDONS_URL . 'admin/assets/js/controls/icon-chooser.js', array(),BOOSTER_ADDONS_VERSION);
		wp_enqueue_script('elb-objectchooser-control-js');
		$plugin_uri_admin = array(
			'ajax_handler' => admin_url('admin-ajax.php'),
			'schemeEnabled'		=>		elb_get_option('booster_color_scheme')
		);
		wp_localize_script('elb-objectchooser-control-js', 'plugindir', $plugin_uri_admin);
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
						<div class="elb-ichs-search"><input type="text" onkeyup="elb_search_iconchooser(this)" placeholder="<?php echo esc_attr('Search for Object','booster-addons') ?>"></div>
						<div class="elb-ichs-list elb-objchs-list">
							<div class="elb-ichs-icon" data-iconid=""></div>
							<?php 
								$objects_list = CertainDev_ObjectsDecoration::get_objects_list_full();
								if(!elb_check_pro_version())
									$objects_list = CertainDev_ObjectsDecoration::$objects;

								foreach ($objects_list as $objkey => $obj) {
							?>
								<div class="elb-ichs-icon" title="<?php echo $obj['name'] ?>" data-iconid="<?php echo $objkey; ?>" data-keywords="<?php echo $obj['name'] ?>">
									<?php echo $obj['icon']; ?>
								</div>
							<?php 
								}	
							?>
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
