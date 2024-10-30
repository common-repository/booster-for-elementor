<?php
//Booster Addons Templates Library VIEWS
if (!defined('ABSPATH')) exit; 
?>

<script type="text/template" id="tmpl-boosterAddonsLibrary-header-actions">
	<div id="boosterAddonsLibrary-header-sync" class="elementor-templates-modal__header__item">
		<i class="eicon-sync" aria-hidden="true" title="<?php esc_attr_e('Sync Library', 'booster-addons'); ?>"></i>
		<span class="elementor-screen-only"><?php echo __('Sync Library', 'booster-addons'); ?></span>
	</div>
</script>

<script type="text/template" id="tmpl-boosterAddonsLibrary-header-menu">
	<# jQuery.each( tabs, ( tab, args ) => { #>
		<div class="elementor-component-tab elementor-template-library-menu-item" data-tab="{{{ tab }}}">{{{ args.title }}}</div>
	<# } ); #>
</script>

<script type="text/template" id="tmpl-boosterAddonsLibrary-header-insert">
	<div id="elementor-template-library-header-preview-insert-wrapper" class="elementor-templates-modal__header__item">
		{{{ elb.library.getModal().printTemplateButton( obj ) }}}
	</div>
</script>

<script type="text/template" id="tmpl-boosterAddonsLibrary-header-back">
	<i class="eicon-" aria-hidden="true"></i>
	<span><?php echo __('Back to Library', 'booster-addons'); ?></span>
</script>

<script type="text/template" id="tmpl-boosterAddonsLibrary-loading">
	<div class="elementor-loader-wrapper">
		<div class="elementor-loader">
			<div class="elementor-loader-boxes">
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
				<div class="elementor-loader-box"></div>
			</div>
		</div>
		<div class="elementor-loading-title"><?php echo __('Loading', 'booster-addons'); ?></div>
	</div>
</script>


<script type="text/template" id="tmpl-boosterAddonsLibrary-insert-button">
	<a class="elementor-template-library-template-action boosterAddonsLibrary-insert-button elementor-button">
		<i class="eicon-file-download" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php echo __('Insert', 'booster-addons'); ?></span>
	</a>
</script>

<script type="text/template" id="tmpl-boosterAddonsLibrary-get-pro-button">
	<a class="elementor-template-library-template-action elementor-button boosterAddonsLibrary-elementor-go-pro" href="https://booster-addons.com/purchase/" target="_blank">
		<i class="eicon-bag-medium" aria-hidden="true"></i>
		<span class="elementor-button-title"><?php echo __('Go Pro', 'booster-addons'); ?></span>
	</a>
</script>

<script type="text/template" id="tmpl-boosterAddonsLibrary-preview">
	<iframe></iframe>
</script>

<!--
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
								NEEDS SOME CHANGES HERE
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
-->
<script type="text/template" id="tmpl-boosterAddonsLibrary-empty">
	<div class="elementor-template-library-blank-icon">
		<img src="<?php echo ELEMENTOR_ASSETS_URL . 'images/no-search-results.svg'; ?>" class="elementor-template-library-no-results" />
	</div>
	<div class="elementor-template-library-blank-title"></div>
	<div class="elementor-template-library-blank-message"></div>
	<div class="elementor-template-library-blank-footer">
		<?php echo __( 'Want to learn more about the Elementor library?', 'booster-addons' ); ?>
		<a class="elementor-template-library-blank-footer-link" href="https://go.elementor.com/docs-library/" target="_blank"><?php echo __( 'Click here', 'elementor' ); ?></a>
	</div>
</script>


<script type="text/template" id="tmpl-boosterAddonsLibrary-logo">
    <span class="boosterAddonsLibrary-logo-wrap">
		<img src="<?php echo BOOSTER_ADDONS_URL ?>admin/assets/css/controls/logo-svg.svg">
	</span>
    <span class="haTemplateLibrary__logo-title">{{{ title }}}</span>
</script>



<script type="text/template" id="tmpl-boosterAddonsLibrary-templates">
	<div id="boosterAddonsLibrary-toolbar">
		<div id="boosterAddonsLibrary-toolbar-filter" class="boosterAddonsLibrary-toolbar-filter">
			<# if ( elb.library.getTags() ) { var selectedTag = elb.library.getTag( 'tags' ); #>				
				<ul id="boosterAddonsLibrary-filter-tags" class="boosterAddonsLibrary-filter-tags">
					<li data-tag="">All</li>
					<# _.each( elb.library.getTags(), function( name, slug ) {
						var selected = selectedTag === slug ? 'active' : '';
						#>
						<li data-tag="{{ slug }}" class="{{ selected }}">{{{ name }}}</li>
					<# } ); #>
				</ul>
			<# } #>
		</div>

		<div id="boosterAddonsLibrary-toolbar-search">
			<label for="boosterAddonsLibrary-search" class="elementor-screen-only"><?php esc_html_e( 'Search Templates:', 'booster-addons'); ?></label>
			<input id="boosterAddonsLibrary-search" placeholder="<?php esc_attr_e( 'Search', 'booster-addons'); ?>">
			<i class="eicon-search"></i>
		</div>
	</div>

	<div class="boosterAddonsLibrary-window">
		<div id="boosterAddonsLibrary-list"></div>
	</div>
</script>


<script type="text/template" id="tmpl-boosterAddonsLibrary-template">
	<div class="boosterAddonsLibrary-body" id="boosterTemplate-{{ template_id }}">
		<div class="boosterAddonsLibrary-template-preview elementor-template-library-template-preview">
			<i class="eicon-zoom-in-bold" aria-hidden="true"></i>
		</div>
		<img class="boosterAddonsLibrary-thumbnail" src="{{ thumbnail }}">
		<# if ( obj.isPro ) { #>
		<span class="boosterAddonsLibrary-badge"><?php esc_html_e( 'Pro', 'booster-addons' ); ?></span>
		<# } #>
	</div>
	<div class="boosterAddonsLibrary-footer">
		{{{ elb.library.getModal().printTemplateButton( obj ) }}}		
	</div>
</script>
