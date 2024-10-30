<?php 
/*
	Plugin Name: Booster Addons For Elementor 
	Plugin URI: http://www.booster-addons.com/
	Description: Boost your Elementor page builder by using the advanced Booster Addons widgets bundle. [Free]
	Author: Certain Dev
	Version: 1.4.9
	Author URI: http://www.certaindev.com/
	Text Domain: booster-addons
*/

/*	-------------------------------------------------------------------- *\

		

\*	--------------------------------------------------------------------  */

define('BOOSTER_ADDONS_VERSION', '1.4.9');
define('BOOSTER_ADDONS_PATH', plugin_dir_path(__FILE__));
define('BOOSTER_ADDONS_URL', plugin_dir_url(__FILE__) );
define('BOOSTER_ADDONS_URL_IMAGES', plugin_dir_url(__FILE__).'/assets/img/');
define('BOOSTER_ADDONS_URL_IMAGES_ADMIN', plugin_dir_url(__FILE__).'/admin/assets/img/');

define('EB_ONLINE_URL', 'https://www.booster-addons.com/');
define('EB_ONLINE_PTYPES_URL', 'https://wptypes.booster-addons.com/');
define('EB_ONLINE_DOC_URL', 'https://docs.booster-addons.com/');
define('EB_ONLINE_BLOG_URL', 'https://blog.booster-addons.com/');
define('EB_ONLINE_SUPPORT_URL', 'https://wordpress.org/support/plugin/booster-for-elementor/');
define('EB_ONLINE_TEMPLATES_URL', 'https://templates.booster-addons.com/');




//Including All the needed files
function elb_plugins_loaded(){
    require_once(BOOSTER_ADDONS_PATH. 'base/core/booster-addons-core.php');
    require_once(BOOSTER_ADDONS_PATH. 'base/booster-addons-bundle.php');
    require_once(BOOSTER_ADDONS_PATH. 'admin/admin.php');
}
add_action('plugins_loaded', 'elb_plugins_loaded');



/*ADDING CUSTOM LINKS*/
function elb_plugin_action_links($links, $file) {
    static $this_plugin;
    if (!$this_plugin) 
        $this_plugin = plugin_basename(__FILE__);
    if ($file == $this_plugin) {
		$plugin_links['elb_settings'] = sprintf( '<a href="%1$s">%2$s</a>', admin_url('admin.php?page=booster-addons'), esc_html__('Settings', 'booster-addons'));
		$plugin_links['elb_online_purchase'] = sprintf( '<a href="%1$s" style="color:#39b54a; font-weight:900;" target="_blank">%2$s</a>', esc_url(EB_ONLINE_URL . '/purchase') , esc_html__('Go Pro', 'booster-addons'));
		foreach($plugin_links as $link) {
			array_unshift($links, $link);
		}
    }
    return array_reverse($links);
}
add_filter('plugin_action_links', 'elb_plugin_action_links', 10, 2);

function elb_plugin_row_meta( $links, $file ) {    
    if ( plugin_basename( __FILE__ ) == $file ) {
        $row_meta = array(
          'elb_docs'    => '<a href="' . esc_url(EB_ONLINE_DOC_URL) . '" target="_blank" >' . esc_html__( 'Docs & FAQs', 'booster-addons' ) . '</a>',
          'elb_videos'    => '<a href="' . esc_url('https://www.youtube.com/') . '" target="_blank" >' . esc_html__( 'Video Tutorials', 'booster-addons' ) . '</a>'
        );
        return array_merge( $links, $row_meta );
    }
    return (array) $links;
}
add_filter( 'plugin_row_meta', 'elb_plugin_row_meta', 10, 2 );