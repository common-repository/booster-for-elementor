<?php 
if (!defined('ABSPATH')) exit();
	$menu_items = ELB_Admin_Init::elb_admin_menu_items();
	$shown_links = ['dashboard','widgets','extensions','icon_manager','objects_decoration','demo_importer','about_plugin','support','videos'];
?>
<style type="text/css">#wpcontent,#wpbody-content{padding-left: 0px!important; padding-bottom: 0px!important; height: 100%; overflow: visible;}#wpfooter{display: none;}</style>
<div class="elbd-dash-ctn" data-scheme="light">
	<div class="elbd-dash-menu-ctn">
		<div class="elbd-dash-menu-ins elbd-fs">
			<div class="elbd-dash-logo-ctn">
				<div class="elbd-dash-logo">
					<div class="elbd-dash-logo-ic">
						<img src="<?php echo BOOSTER_ADDONS_URL_IMAGES_ADMIN.'admin-logo.png' ?>">
					</div>
					<div class="elbd-dash-logo-txt">
						<div class="elbd-dash-logo-txt-top"><span>Booster</span> Addons</div>
						<div class="elbd-dash-logo-txt-bottom">Creative <span>Elementor</span> Bundle</div>
					</div>
				</div>
		        <div class="elbd-dash-nm"><div class="elbd-optpanel-vers"><?php echo BOOSTER_ADDONS_VERSION; ?></div></div>
			</div>
			<div class="elbd-dash-right">
				<div class="elbd-dash-title"><?php echo $menu_items[$active]['title'] ?>.</div>
				<div class="elbd-dash-menu">
					<?php foreach ($shown_links as $link): $menu_item = $menu_items[$link]; $dataActvive = 'none'; if($active == $menu_item['id'])  $dataActvive = 'active'; ?>
						<div class="elbd-dash-mitem" data-situation="<?php echo esc_attr($dataActvive); ?>"  data-id="<?php echo esc_attr($menu_item['id']); ?>">
							<div class="elbd-dash-mitem-icon">
		                        <?php echo Elementor\CertainDev_Icons::get_icon($menu_item['icon'],'',22); ?>
		                        <span class="elbd-dash-mitem-name elbd-tr-3"><?php echo $menu_item['name']; ?></span>
		                    </div>
							<a href="<?php echo esc_url($menu_item['link']); ?>"></a>
						</div>					
					<?php endforeach ?>	
				</div>
			</div>
			
		</div>
		<div class="elbd-dash-purchasehd-ctn elbd-fs">
			<div class="elbd-dash-purchasehd-txt"><?php echo esc_html__('Purchase Booster Addons today & unlock the most creative widgets & premium features.','booster-addons') ?></div>
			<div class="elbd-dash-purchasehd-btn elbd-tr-2">
				<?php echo Elementor\CertainDev_Icons::get_icon('medallion_prize4','',20); ?>
				<span><?php echo esc_html__('Purchase Now','booster-addons') ?></span>
				<a href="<?php echo esc_url(EB_ONLINE_URL.'purchase') ?>" target="_blank"></a>
			</div>
		</div>
	</div>
	<div class="elbd-dash-wrapper">
			
