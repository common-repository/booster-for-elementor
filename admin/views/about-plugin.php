<div id="elb-about-plugin" class="elbd-dash-content elbd-fs">
	<?php ELB_Admin_Init::elb_dashboard_loading_render(); ?>
	<?php ELB_Admin_Init::elb_dashboard_confirm_dialog_render(); ?>	
	<div class="elbd-about-ctn">
		<div class="elbd-about-top elbd-fs">
			<div class="elbd-about-sections">
				<div class="elbd-about-txt elbd-about-sec">
					
					<!--About Section-->	
					<div class="elbd-about-txt-item" :data-situation="(activeSection == 'about') ? 'active' : 'inactive'" >
						<div class="elbd-about-txt-bg-nm">1.</div>
						<div class="elbd-about-txt-item-white">
							<?php echo esc_html__('Booster Addons is a premium widgets bundle for Elementor page builder. It comes with a versatile set of modern elements and features that will help you create any web page design you want.','booster-addons') ?>							
						</div>
						<div class="elbd-about-txt-item-btm">
							<?php echo esc_html__('Crafted with love by','booster-addons') ?> - <a href="https://themeforest.net/user/certaindevthemes/" target="_blank">CertainDev</a>
						</div>
					</div>

					<!--Mission-->	
					<div class="elbd-about-txt-item" :data-situation="(activeSection == 'mission') ? 'active' : 'inactive'" >
						<div class="elbd-about-txt-bg-nm">2.</div>
						<div class="elbd-about-txt-item-white">
							<?php echo esc_html__('Our main mission at CertainDev is to create products of great value that solves real web development & design problems. We encourage our clients to get envolved by sharing new suggestions & ideas.','booster-addons') ?>							
						</div>
						<div class="elbd-about-txt-item-btm">
							<?php echo esc_html__('Together we can make','booster-addons') ?> <span><?php echo esc_html__('better products!','booster-addons') ?></span>
						</div>
					</div>

					<!--Team-->	
					<div class="elbd-about-txt-item" :data-situation="(activeSection == 'team') ? 'active' : 'inactive'" >
						<div class="elbd-about-txt-bg-nm">3.</div>
						<div class="elbd-about-txt-item-white">
							<?php echo esc_html__('We are a young & enthusiastic team from Morocco. Always ready for new challenges, we strive to make unique web products and to provide our users & customers with the best services they always wanted.','booster-addons') ?>							
						</div>
						<div class="elbd-about-txt-item-btm">
							<?php echo esc_html__('Group of Gurus living in ','booster-addons') ?> <span><?php echo esc_html__('earth!','booster-addons') ?></span>
						</div>
					</div>

					<!--Why US-->	
					<div class="elbd-about-txt-item" :data-situation="(activeSection == 'why') ? 'active' : 'inactive'" >
						<div class="elbd-about-txt-bg-nm">4.</div>
						<div class="elbd-about-txt-item-white">
							<?php echo esc_html__('Choosing us means choosing the best, We always do things differently & efficiently, proposing and offering unique features that will make the process of creating your WordPress site a better experience.','booster-addons') ?>							
						</div>
						<div class="elbd-about-txt-item-btm">
							<?php echo esc_html__('different approach for a better ','booster-addons') ?> <span><?php echo esc_html__('experience!','booster-addons') ?></span>
						</div>
					</div>

					<!--Yes You -->	
					<div class="elbd-about-txt-item" :data-situation="(activeSection == 'you') ? 'active' : 'inactive'" >
						<div class="elbd-about-txt-bg-nm">5.</div>
						<div class="elbd-about-txt-item-white">
							<?php echo esc_html__('At CertainDev we always put our clients first, we do our best to solve their support tickets in a timely manner. We do listen to their suggestions & feedbacks that helps us imporving the quality of our products.','booster-addons') ?>							
						</div>
						<div class="elbd-about-txt-item-btm">
							<a href="" target="_blank"><?php echo esc_html__('get involved','booster-addons') ?></a>
							<?php echo esc_html__(' & help making better products!','booster-addons') ?> 
						</div>
					</div>

				</div>	
				<div class="elbd-about-prev elbd-about-sec">					
					<div class="elbd-about-prev-img elbd-tr-2" :data-situation="(activeSection == 'about') ? 'active' : 'inactive'" style="background-image: url('https://images.unsplash.com/photo-1496171367470-9ed9a91ea931?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80')"></div>
					<div class="elbd-about-prev-img elbd-tr-2" :data-situation="(activeSection == 'mission') ? 'active' : 'inactive'" style="background-image: url('https://images.unsplash.com/photo-1521316730702-829a8e30dfd0?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80')"></div>
					<div class="elbd-about-prev-img elbd-tr-2" :data-situation="(activeSection == 'team') ? 'active' : 'inactive'" style="background-image: url('https://images.unsplash.com/photo-1519309621146-2a47d1f7103a?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1353&q=80')"></div>
					<div class="elbd-about-prev-img elbd-tr-2" :data-situation="(activeSection == 'why') ? 'active' : 'inactive'" style="background-image: url('https://images.unsplash.com/photo-1523875194681-bedd468c58bf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1351&q=80')"></div>
					<div class="elbd-about-prev-img elbd-tr-2" :data-situation="(activeSection == 'you') ? 'active' : 'inactive'" style="background-image: url('https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1267&q=80')"></div>
				
				</div>	
			</div>
			
			<div class="elbd-about-nums">
				<div class="elbd-about-nums-ins">
					<div class="elbd-about-num elbd-tr-2" @click.prevent.default="changeSection('about')" :data-situation="(activeSection == 'about') ? 'active' : 'inactive'">01</div>
					<div class="elbd-about-num elbd-tr-2" @click.prevent.default="changeSection('mission')" :data-situation="(activeSection == 'mission') ? 'active' : 'inactive'">02</div>
					<div class="elbd-about-num elbd-tr-2" @click.prevent.default="changeSection('team')" :data-situation="(activeSection == 'team') ? 'active' : 'inactive'">03</div>
					<div class="elbd-about-num elbd-tr-2" @click.prevent.default="changeSection('why')" :data-situation="(activeSection == 'why') ? 'active' : 'inactive'">04</div>
					<div class="elbd-about-num elbd-tr-2" @click.prevent.default="changeSection('you')" :data-situation="(activeSection == 'you') ? 'active' : 'inactive'">05</div>
				</div>
			</div>			
		</div>
		<div class="elbd-about-bottom elbd-fs">
			<div class="elbd-about-bottom-navs">
				<div class="elbd-about-nav-item elbd-tr-2" @click.prevent.default="changeSection('about')" :data-situation="(activeSection == 'about') ? 'active' : 'inactive'"><span>About</span></div>
				<div class="elbd-about-nav-item elbd-tr-2" @click.prevent.default="changeSection('mission')" :data-situation="(activeSection == 'mission') ? 'active' : 'inactive'"><span>Our Mission</span></div>
				<div class="elbd-about-nav-item elbd-tr-2" @click.prevent.default="changeSection('team')" :data-situation="(activeSection == 'team') ? 'active' : 'inactive'"><span>The Team</span></div>
				<div class="elbd-about-nav-item elbd-tr-2" @click.prevent.default="changeSection('why')" :data-situation="(activeSection == 'why') ? 'active' : 'inactive'"><span>Why us</span></div>
				<div class="elbd-about-nav-item elbd-tr-2" @click.prevent.default="changeSection('you')" :data-situation="(activeSection == 'you') ? 'active' : 'inactive'"><span>Yes you!</span></div>
			</div>
		</div>	
	</div>
</div>
