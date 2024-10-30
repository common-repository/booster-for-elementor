<div id="elb-extensions-manager" class="elbd-dash-content elbd-fs">
	<?php ELB_Admin_Init::elb_dashboard_loading_render(); ?>
	<div class="elbd-dash-if-ctn elbd-fs">
		<div class="elbd-dash-if-inf">
			<div class="elbd-dash-if-title"><?php echo esc_html__('Extensions Manager','booster-addons'); ?></div>
			<div class="elbd-dash-if-info">
				<?php echo esc_html__('Enable the booster addons extensions to boost your elementor page builder experience.','booster-addons'); ?>				
			</div>
		</div>
		<div class="elbd-dash-btn elbd-2-bg elbd-dash-btn-fright" @click.prevent.default="saveChangesExtensions"><?php echo esc_html__('Save Changes','booster-addons') ?></div>
	</div>

	


	<div class="elbd-dash-extensions-list elbd-fs">

		<div class="elbd-exts-item" v-for="(extension, index) in shownExtensions">
			<div class="elbd-exts-item-name">{{extension.name}}</div>
			<div class="elbd-exts-item-act">
				<div class="elbd-exts-item-icons">
					<div class="elbd-exts-it-star elbd-tr-4" v-if="extension.type == 'premium'">
						<?php echo Elementor\CertainDev_Icons::get_icon('star','',12); ?>
					</div>				
					<div class="elbd-exts-it-link elbd-tr-2">
						<div class="elbd-exts-it-link-ic"><?php echo Elementor\CertainDev_Icons::get_icon('insert_link','',24); ?></div>
						<div class="elbd-exts-it-link-name elbd-tr-2"><?php echo esc_html__('Preview','booster-addons'); ?></div>
						<a :href="'<?php echo EB_ONLINE_URL ?>extensions/'+extension.id" class="elbd-fs-link" target="_blank"></a>
					</div>	
					<div class="elbd-exts-it-link elbd-tr-2">
						<div class="elbd-exts-it-link-ic"><?php echo Elementor\CertainDev_Icons::get_icon('book_closed1','',18); ?></div>
						<div class="elbd-exts-it-link-name elbd-tr-2"><?php echo esc_html__('Documentation','booster-addons'); ?></div>
						<a :href="'<?php echo EB_ONLINE_DOC_URL ?>extensions/'+extension.id" class="elbd-fs-link" target="_blank"></a>
					</div>	
				</div>
				<div class="elbd-exts-it-swit-ctn elbd-fs" v-if="extension.type == 'freemium'" :data-situation="checkExtension(extension.id)" @click.prevent.default="enableSingleExtension(extension.id)"></div>
				<div class="elbd-exts-it-swit-ctn elbd-fs" v-if="extension.type == 'premium'" data-situation="inactive" @click.prevent.default="purchaseElementorPopup()"></div>			
			</div>
			
			
		</div>




	

	</div>

<?php require_once('purchase-popup.php');?>
</div>
