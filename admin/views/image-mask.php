<div id="elb-image-mask" class="elbd-dash-content elbd-fs">
	<?php ELB_Admin_Init::elb_dashboard_loading_render(); ?>
	<?php ELB_Admin_Init::elb_dashboard_confirm_dialog_render(); ?>
	<div class="elbd-dash-if-ctn elbd-fs">
		<div class="elbd-dash-if-inf">
			<div class="elbd-dash-if-title"><?php echo esc_html__('Image Mask Shapes','booster-addons'); ?></div>
			<div class="elbd-dash-if-info">
				<?php echo esc_html__('Upload SVG shapes and objects to be used in all elements that implements the image mask shapes.','booster-addons'); ?>
			</div>
		</div>
	</div>
	<div class="elbd-dash-objdeco-list elbd-fs">
		<div class="elbd-objdeco-item elbd-objdeco-item-upload elbd-tr-2" @click.prevent.default="purchaseElementorPopup">
			<div class="elbd-objdeco-svg-ctn elbd-fs">
				<div class="elbd-icmng-up-btn-ctn elbd-fs">
					<div class="elbd-icmng-up-btn elbd-tr-2">
						<div class="elbd-icmng-up-btn-ic"></div>
						<div class="elbd-icmng-up-show-frm elbd-icmng-fs"></div>
					</div>
				</div>
			</div>	
			<div class="elbd-objdeco-bottom elbd-fs">
				<strong><?php echo esc_html__('Upload New SVG Mask','booster-addons'); ?></strong>
			</div>
		</div>

		
		<?php foreach (Elementor\CertainDev_ImageMaskShapes::$shapes as $key => $singleShape): ?>
		<div class="elbd-objdeco-item elbd-tr-2">
			<div class="elbd-objdeco-svg-ctn elbd-fs">
				<?php echo $singleShape['icon']; ?>
				<div class="elbd-objdeco-svg-default elbd-tr-2">Default</div>								
			</div>
			<div class="elbd-objdeco-bottom elbd-fs">
				<span><?php echo $singleShape['name']; ?></span>
				<!--<div class="elbd-objdeco-rm-ic"><?php echo Elementor\CertainDev_Icons::get_icon('trash-o','',20); ?></div>-->
			</div>
		</div>
		<?php  endforeach; ?>

	</div>
<?php require_once('purchase-popup.php');?>
</div>
