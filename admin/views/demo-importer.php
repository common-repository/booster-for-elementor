<div id="elb-demo-importer" class="elbd-dash-content elbd-fs">
	<?php ELB_Admin_Init::elb_dashboard_loading_render(); ?>
	<?php ELB_Admin_Init::elb_dashboard_confirm_dialog_render(); ?>
	<div class="elbd-dash-if-ctn elbd-fs">
		<div class="elbd-dash-if-inf">
			<div class="elbd-dash-if-title"><?php echo esc_html__('Demo Importer','booster-addons'); ?></div>
			<div class="elbd-dash-if-info">
				<?php echo esc_html__('Import clean and modern pre-designed home demos. We will be adding more demos constantly, Stay Tunned!','booster-addons'); ?>
			</div>
		</div>
	</div>
	<div class="elbd-dash-if-acts-ctn elbd-fs">
		<div class="elbd-dash-se-flt">		
			<div class="elbd-dash-se-ctn">
				<div class="elbd-dash-se-icon"><?php echo Elementor\CertainDev_Icons::get_icon('search5','',17); ?></div>
				<input type="text" v-model="searchDemo" class="elbd-dash-se-inp elbd-inp elbd-tr-2" placeholder="<?php echo esc_html__('Search Demos','booster-addons') ?>">
			</div>			
		</div>
		<div class="elbd-dash-ord-ic">
			<div class="elbd-dash-ord-ic-ic" v-if="orderType == 'asc'" @click.prevent.default="changeOrderBy('desc')"><?php echo Elementor\CertainDev_Icons::get_icon('sort-amount-asc','',20); ?></div>			
			<div class="elbd-dash-ord-ic-ic" v-if="orderType == 'desc'" @click.prevent.default="changeOrderBy('asc')"><?php echo Elementor\CertainDev_Icons::get_icon('sort-amount-desc','',20); ?></div>			
		</div>
		<div class="elbd-dash-dimp-flt-ctn">
			<div class="elbd-dash-dimp-item elbd-tr-2" v-for="(filter, index) in demosFilter" @click.prevent.default="changeFilter(filter)" :data-situation="(activeFilter == filter) ? 'active' : 'inactive'">{{displayKeywords(filter)}}</div>
		</div>
	</div>
	
	
	<div class="elbd-dash-demos-list elbd-fs">
		<div class="elbd-demo-item elbd-tr-2" v-for="(demo, index) in demosList" v-show="((searchDemo !== '' && searchDemo != null && demo.name.toLowerCase().includes(searchDemo.toLowerCase())) || (searchDemo == '' || searchDemo == null)) && (demo.keywords.includes(activeFilter))">
			<div class="elbd-demo-item-img elbd-fs elbd-tr-2">
				<img :src="demosURL+demo.id+'/thumbnail.jpg'">
			</div>
			<div class="elbd-demo-item-bottom elbd-fs elbd-tr-2">
				<div class="elbd-demo-item-ins elbd-fs elbd-tr-2">
					<div class="elbd-demo-item-info elbd-fs elbd-tr-2">
						<div class="elbd-demo-item-title elbd-fs">{{demo.name}}</div>
						<div class="elbd-demo-item-cats elbd-fs">
							<div class="elbd-demo-item-cat" v-for="(keyword, ind) in demo.keywords">{{displayKeywords(keyword)}}</div>						
						</div>
					</div>
					<div class="elbd-demo-item-acts elbd-fs elbd-tr-2">
						<div class="elbd-demo-item-btn elbd-tr-2 elbd-1-bg"><?php echo esc_html__('Preview','booster-addons') ?><a :href="demo.previewUrl" class="elbd-fs-link" target="_blank"></a></div>
						<div class="elbd-demo-item-btn elbd-tr-2 elbd-2-bg" @click.prevent.default="purchaseElementorPopup"><?php echo esc_html__('import','booster-addons') ?></div>
					</div>					
				</div>
			</div>

		</div>
	</div>
	<?php require_once('purchase-popup.php');?>
</div>