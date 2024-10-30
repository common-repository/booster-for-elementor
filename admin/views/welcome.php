<div id="elb-welcome-dashboard" class="elbd-dash-content elbd-fs">
	<?php 
		$user = wp_get_current_user(); 
		$shown_sections = ['widgets','extensions','icon_manager','demo_importer','objects_decoration','about_plugin','documentation','support','videos','blog','get_involved','bug','design_submission'];
		$new_tab_sections = ['documentation','support','videos','blog','get_involved','bug','design_submission'];
		
	?>
	<!--
	<div class="elbd-welcome-logo-ctn elbd-fs">
		<div class="elbd-welcome-logo"></div>
	</div>
	-->
	<div class="elbd-welcome-top elbd-fs">
		<div class="elbd-welcome-title elbd-fs">
			<?php echo esc_html__('Welcome,','booster-addons'); ?>
			<span><?php echo $user->user_login; ?>!</span>
		</div>
		<div class="elbd-welcome-message elbd-fs">
			<?php echo esc_html__('Take your website design to the next level.','booster-addons'); ?>
		</div>
	</div>
	
	<div class="elbd-welcome-info elbd-fs">
		<div class="elbd-wlc-lk-row-ctn">			
			<div class="elbd-wlc-inf-area elbd-wlc-inf-text elbd-wlc-inf-text-left">				
				<div class="elbd-wlc-inf-row elbd-fs">
					<div class="elbd-wlc-inf-nm-ctn"><div class="elbd-wlc-inf-nm">1</div></div>
					<div class="elbd-wlc-inf-in">
						<div class="elbd-wlc-inf-title"><?php echo esc_html__('Premium Widgets','booster-addons'); ?></div>
						<div class="elbd-wlc-inf-desc"><?php echo esc_html__('Booster Addons comes bundled with most versatile group of modern widgets and elements, allowing you to create any type of design you want.','booster-addons'); ?></div>						
					</div>
				</div>

				<div class="elbd-wlc-inf-row elbd-fs">
					<div class="elbd-wlc-inf-nm-ctn"><div class="elbd-wlc-inf-nm">2</div></div>
					<div class="elbd-wlc-inf-in">
						<div class="elbd-wlc-inf-title"><?php echo esc_html__('Advanced Admin Panel','booster-addons'); ?></div>
						<div class="elbd-wlc-inf-desc"><?php echo esc_html__('We say it proudly, Booster Addons admin panel is the most advanced and complete panel on any elementor addons on the market, control everything!','booster-addons'); ?></div>						
					</div>
				</div>

				<div class="elbd-wlc-inf-row elbd-fs">
					<div class="elbd-wlc-inf-nm-ctn"><div class="elbd-wlc-inf-nm">3</div></div>
					<div class="elbd-wlc-inf-in">
						<div class="elbd-wlc-inf-title"><?php echo esc_html__('Icons Manager','booster-addons'); ?></div>
						<div class="elbd-wlc-inf-desc"><?php echo esc_html__('Create new iconsets and upload unlimited SVG icons to your booster addons so you can use them in your widgets, never worry about perfotmance! .','booster-addons'); ?></div>						
					</div>
				</div>
			</div>
			<div class="elbd-wlc-inf-area">
				<svg xmlns="http://www.w3.org/2000/svg" width="600" height="600" viewBox="0 0 600 600">
				  <g transform="translate(300,300)">
				    <path d="M120.5,-173.9C161.8,-161,204.6,-137,205.6,-103.2C206.5,-69.4,165.6,-25.7,161,24.9C156.5,75.5,188.2,133,179.6,171.6C171,210.2,122.1,229.8,78.8,220.9C35.4,212,-2.4,174.6,-47.8,161.8C-93.1,148.9,-145.9,160.6,-180.1,143.6C-214.3,126.6,-229.9,80.9,-222.6,40.5C-215.2,0,-184.9,-35.3,-166.7,-76.5C-148.5,-117.7,-142.4,-164.9,-116.6,-184.8C-90.8,-204.7,-45.4,-197.3,-2.9,-192.8C39.6,-188.4,79.3,-186.7,120.5,-173.9Z"/>
				  </g>
				</svg>
				<img class="elbd-wlc-im1" src="<?php echo BOOSTER_ADDONS_URL_IMAGES_ADMIN.'welcome-1.png' ?>">
				<img class="elbd-wlc-im2" src="<?php echo BOOSTER_ADDONS_URL_IMAGES_ADMIN.'welcome-2.png' ?>">
			</div>

			<div class="elbd-wlc-inf-area elbd-wlc-inf-text">
				<div class="elbd-wlc-inf-row elbd-fs">
					<div class="elbd-wlc-inf-nm-ctn"><div class="elbd-wlc-inf-nm">4</div></div>
					<div class="elbd-wlc-inf-in">
						<div class="elbd-wlc-inf-title"><?php echo esc_html__('Unlimited Possibilities','booster-addons'); ?></div>
						<div class="elbd-wlc-inf-desc"><?php echo esc_html__('All Booster Addons widgets were created to give you the total freedom to create any design you want with unlimited modern design possibilities.','booster-addons'); ?></div>						
					</div>
				</div>
				<div class="elbd-wlc-inf-row elbd-fs">
					<div class="elbd-wlc-inf-nm-ctn"><div class="elbd-wlc-inf-nm">5</div></div>
					<div class="elbd-wlc-inf-in">
						<div class="elbd-wlc-inf-title"><?php echo esc_html__('Home Demos','booster-addons'); ?></div>
						<div class="elbd-wlc-inf-desc"><?php echo esc_html__('Access a modern library of pre designed home pages, new unique pages will be added directly from our servers so youc an import them with just one click.','booster-addons'); ?></div>						
					</div>
				</div>

				<div class="elbd-wlc-inf-row elbd-fs">
					<div class="elbd-wlc-inf-nm-ctn"><div class="elbd-wlc-inf-nm">6</div></div>
					<div class="elbd-wlc-inf-in">
						<div class="elbd-wlc-inf-title"><?php echo esc_html__('Get Involved','booster-addons'); ?></div>
						<div class="elbd-wlc-inf-desc"><?php echo esc_html__('Booster Addons team is an open minded young team that like sharing and listening their customers, get involved to make booster addons better!','booster-addons'); ?></div>						
					</div>
				</div>				
			</div>
			
		</div>
	</div>

	<div class="elbd-welcome-links-ctn elbd-fs">
		<div class="elbd-wlc-lk-row-ctn-2">			
			<div class="elbd-wlc-lk-row elbd-fs">
				<?php foreach ($shown_sections as $item): $menu_item = $menu_items[$item]; ?>				
					<div class="elbd-wlc-lk-it-ctn">
						<a href="<?php echo esc_url($menu_item['link']) ?>" class="elbd-fs-link" <?php if(in_array($item,$new_tab_sections)): ?> target="_blank" <?php endif; ?> ></a>
						<div class="elbd-wlc-lk-it elbd-tr-2">
							<div class="elbd-wlc-lk-it-ic elbd-fs"><?php echo Elementor\CertainDev_Icons::get_icon($menu_item['icon'],'',57); ?></div>
							<div class="elbd-wlc-lk-it-name elbd-fs"><?php echo $menu_item['title']; ?></div>
							<div class="elbd-wlc-lk-it-info elbd-fs"><?php echo $menu_item['description']; ?></div>
						</div>					
					</div>
				<?php endforeach;  ?>

			</div>
		</div>
	</div>
</div>