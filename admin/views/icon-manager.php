<div id="elb-icon-manager" class="elbd-dash-content elbd-fs">
	<?php ELB_Admin_Init::elb_dashboard_loading_render(); ?>
	<?php ELB_Admin_Init::elb_dashboard_confirm_dialog_render(); ?>
	<div class="elbd-dash-if-ctn elbd-fs">
		<div class="elbd-dash-if-inf">
			<div class="elbd-dash-if-title"><?php echo esc_html__('Icons Manager','booster-addons'); ?></div>
			<div class="elbd-dash-if-info">
				<?php echo esc_html__('Create icons bundle and upload unlimited SVG icons to your Booster Addons so you can use theme in any of our elements.','booster-addons'); ?>
			</div>
		</div>
	</div>
	
	


	<div class="elbd-dash-icmng-list elbd-fs">

		<div class="elbd-icmng-item elbd-icmng-uploader">
			<div class="elbd-icmng-up-btn-ctn elbd-fs">
				<div class="elbd-icmng-up-btn elbd-tr-2">
					<div class="elbd-icmng-up-btn-ic"></div>
					<div class="elbd-icmng-up-show-frm elbd-icmng-fs"  @click.prevent.default="purchaseElementorPopup"></div>
				</div>
			</div>
			<div class="elbd-icmng-up-btm elbd-fs">
				<div class="elbd-icmng-up-title elbd-icmng-int-el elbd-fs elbd-tr-2">
					<?php echo esc_html__('Create new Iconset','booster-addons'); ?>
				</div>
				<div class="elbd-icmng-up-message elbd-icmng-int-el elbd-fs elbd-tr-2">
					<?php echo esc_html__('Click the add button to create a new iconset and to upload SVG icons.','booster-addons'); ?>
				</div>				
			</div>
		</div>

	</div>
	<?php require_once('purchase-popup.php');?>

</div>