<div id="elb-widgets-manager" class="elbd-dash-content elbd-fs">
	<?php ELB_Admin_Init::elb_dashboard_loading_render(); ?>
	<div class="elbd-dash-if-ctn elbd-fs">
		<div class="elbd-dash-if-inf">
			<div class="elbd-dash-if-title"><?php echo esc_html__('Widgets Manager','booster-addons'); ?></div>
			<div class="elbd-dash-if-info">
				<?php echo esc_html__('You are using ','booster-addons'); ?>
				<span class="elbd-dash-num">{{widgetsActive.length}}</span> out of <strong>{{widgetsBundle.length}}</strong>
				<?php echo esc_html__('widgets. Consider deactivating all the elements that you are not using for a better performance!','booster-addons'); ?>
			</div>
		</div>
	</div>

	<div class="elbd-dash-if-acts-ctn elbd-fs">
		<div class="elbd-dash-se-flt">
			<div class="elbd-dash-se-ctn">
				<div class="elbd-dash-se-icon"><?php echo Elementor\CertainDev_Icons::get_icon('search5','',17); ?></div>
				<input type="text" @keyup="searchWidget" class="elbd-dash-se-inp elbd-inp elbd-tr-2" placeholder="<?php echo esc_html__('Search Widgets','booster-addons') ?>">
			</div>
			
			<div class="elbd-dash-flt-ctn elbd-dash-pp-ctn" data-situation="inactive">
				<div class="elbd-dash-ins-btn" @click.prevent.default="changeSituation('parent')">
					<div class="elbd-dash-flt-icon elbd-dash-pp-icon"><?php echo Elementor\CertainDev_Icons::get_icon('filter_new','',24); ?></div>
					<div class="elbd-dash-flt-txt elbd-tr-2"><?php echo esc_html__('Filter','booster-addons') ?></div>					
				</div>
				<div class="elbd-dash-flt-pp elbd-dash-pp elbd-tr-2">
					<div class="elbd-dash-flt-item elbd-dash-pp-item" v-for="(flt, index) in filter.categories" :data-situation="(filter.categoryActive == index) ? 'active' : 'inactive'" @click.prevent.default="filterChange('category',index)">{{flt}}</div>					
				</div>
			</div>
			<div class="elbd-dash-type-ctn">
				<div class="elbd-dash-type-item elbd-tr-2" v-for="(typewidget, index) in filter.typesWidgets" :data-situation="(filter.typeActive == index) ? 'active' : 'inactive'" @click.prevent.default="filterChange('typewidget',index)">{{typewidget}}</div>
			</div>
			<div class="elbd-dash-flt-ctn elbd-dash-pp-ctn" data-situation="inactive">
				<div class="elbd-dash-ins-btn" @click.prevent.default="changeSituation('parent')">
					<div class="elbd-dash-flt-icon elbd-dash-pp-icon"><?php echo Elementor\CertainDev_Icons::get_icon('photo_filter','',24); ?></div>
					<div class="elbd-dash-flt-txt elbd-tr-2"><?php echo esc_html__('Group','booster-addons') ?></div>					
				</div>
				<div class="elbd-dash-pp elbd-dash-sit-pp elbd-tr-2">
					<div class="elbd-dash-flt-item elbd-dash-pp-item" v-for="(flt, index) in filter.situationWidgets" :data-situation="(filter.situationActive == index) ? 'active' : 'inactive'" @click.prevent.default="filterChange('situation',index)">{{flt}}</div>					
				</div>
			</div>

			
		</div>
		<div class="elbd-dash-acts elbd-dash-btns" data-align="right">
			<div class="elbd-dash-gpr-ac elbd-dash-pp-ctn" data-situation="inactive">
				<div class="elbd-dash-gpr-btn elbd-tr-2 elbd-dash-pp-icon" @click.prevent.default="changeSituation('parent')"><?php echo Elementor\CertainDev_Icons::get_icon('apps','',21); ?></div>
				<div class="elbd-dash-gpr-pp elbd-dash-pp elbd-tr-2">
					<div class="elbd-dash-pp-item elbd-tr-2" @click.prevent.default="shownListSituation('enable')"><?php echo esc_html__('Enable Current List','booster-addons') ?></div>
					<div class="elbd-dash-pp-item elbd-tr-2" @click.prevent.default="shownListSituation('disable')"><?php echo esc_html__('Disable Current List','booster-addons') ?></div>
				</div>
			</div>
			<div class="elbd-dash-btn elbd-2-bg" @click.prevent.default="saveChangesWidgets"><?php echo esc_html__('Save Changes','booster-addons') ?></div>
		</div>
	</div>
	
	<div class="elbd-dash-btn-fxdbtm">
		<div class="elbd-dash-btn elbd-2-bg" @click.prevent.default="saveChangesWidgets"><?php echo esc_html__('Save Changes','booster-addons') ?></div>
	</div>


	<div class="elbd-dash-widgets-list elbd-fs">

		<div class="elbd-widg-item" v-for="(widget, index) in shownWidgets">
			
			<div class="elbd-widg-ic-tp elbd-fs">
				<div class="elbd-wd-it-star elbd-tr-4" v-if="widget.type == 'premium'">
					<?php echo Elementor\CertainDev_Icons::get_icon('star','',20); ?>
					<div  class="elbd-wd-it-tooltip elbd-tr-2"><?php echo esc_html__('Premium Widget','booster-addons'); ?></div>
				</div>				
				<div class="elbd-wd-it-link elbd-wd-it-prev elbd-tr-2">
					<div class="elbd-wd-it-link-ic"><?php echo Elementor\CertainDev_Icons::get_icon('insert_link','',19); ?></div>
					<div class="elbd-wd-it-link-name"><?php echo esc_html__('Preview','booster-addons'); ?></div>
					<a v-if="widget.widget_type != 'undefined' && widget.widget_type == 'ptypes' " :href="'<?php echo EB_ONLINE_PTYPES_URL ?>widgets/'+widget.id" class="elbd-fs-link" target="_blank"></a>
					<a v-if="typeof widget['widget_type']==='undefined'" :href="'<?php echo EB_ONLINE_URL ?>widgets/'+widget.id" class="elbd-fs-link" target="_blank"></a>
				</div>	
				<div class="elbd-wd-it-link elbd-wd-it-doc elbd-tr-2">
					<div class="elbd-wd-it-link-ic"><?php echo Elementor\CertainDev_Icons::get_icon('book_closed1','',16); ?></div>
					<div class="elbd-wd-it-link-name"><?php echo esc_html__('Documentation','booster-addons'); ?></div>
					<a :href="'<?php echo EB_ONLINE_DOC_URL ?>widgets/'+widget.id" class="elbd-fs-link" target="_blank"></a>
				</div>				
			</div>

			<div class="elbd-wd-it-icon elbd-fs">
				<div class="elbd-wd-it-ic-ctn">
					<i :class="widget.icon"></i>
				</div>
			</div>
			<div class="elbd-wd-it-info elbd-fs">
				<div class="elbd-wd-it-name elbd-fs">{{widget.name}}</div>
				<div class="elbd-wd-it-desc elbd-fs">{{widget.description}}</div>
			</div>
			<div class="elbd-wd-it-swit-ctn elbd-fs" v-if="widget.type == 'freemium'" :data-situation="checkWidget(widget.id)" @click.prevent.default="enableSingleWidget(widget.id)"><div class="elbd-wd-it-swit"></div></div>
			<div class="elbd-wd-it-swit-ctn elbd-fs" v-if="widget.type == 'premium'" data-situation="inactive" @click.prevent.default="purchaseElementorPopup()"><div class="elbd-wd-it-swit"></div></div>
		</div>




	

	</div>

<?php require_once('purchase-popup.php');?>
</div>
