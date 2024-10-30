<?php 
namespace Elementor;

class ELB_Control_ImageMask_Chooser extends Base_Data_Control {
	
	public function get_type(){
		return 'elb_imagemask_chooser';
	}
	public function enqueue(){
		wp_register_style('elb-controls-style',BOOSTER_ADDONS_URL . 'admin/assets/css/controls/controls-style.css',array(),BOOSTER_ADDONS_VERSION);
		wp_enqueue_style('elb-controls-style');
		wp_register_script('elb-imagemask-control-js',BOOSTER_ADDONS_URL . 'admin/assets/js/controls/icon-chooser.js', array(),BOOSTER_ADDONS_VERSION);
		wp_enqueue_script('elb-imagemask-control-js');
		$plugin_uri_admin = array(
			'ajax_handler' 			=> admin_url('admin-ajax.php'),
			'schemeEnabled'			=>		elb_get_option('booster_color_scheme')
		);
		wp_localize_script('elb-imagemask-control-js', 'plugindir', $plugin_uri_admin);
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
				<div class="elb-ichs-ctn" data-situation="shown">
					<input id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area elb-ichs-inp elementor-input" type="hidden" data-setting="{{ data.name }}">					
					<div class="elb-ichs-list-ctn elb-ichsshapes-list-ctn">
						<div class="elb-ichs-list elb-shapchooser-list elb-csscrl">
							<?php 
								#$shapes_list = CertainDev_ImageMaskShapes::get_shapes_list_full();
								#if(!elb_check_pro_version())
								$shapes_list = CertainDev_ImageMaskShapes::get_shapes_list_default();
								foreach ($shapes_list as $hapekey => $shape) {
							?>
								<div class="elb-ichs-icon" data-situation="active" data-iconid="<?php echo $shape['name'] ?>" title="<?php echo $shape['display_name'] ?>" data-keywords="<?php echo $shape['name'] ?>">
									<img src="<?php echo $shape['url']; ?>">
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
