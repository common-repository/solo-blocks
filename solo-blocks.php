<?php
/**
 ** Plugin Name: Solo Blocks
 ** Plugin URI: https://soloblocks.com/
 ** Description: Custom Blocks for WordPress Block Editor. Build your website in minutes.
 ** Version: 1.0.1
 ** Requires at least: 6.0
 ** Requires PHP: 8.0
 ** Author: SoloBlocks
 ** Author URI: https://soloblocks.com/
 ** Text Domain: solo-blocks
 ** Domain Path:  /languages
 **/


defined('ABSPATH') OR exit;
global $wp_version;

if(!function_exists('get_plugin_data')) {
	require_once(ABSPATH.'wp-admin/includes/plugin.php');
}
$plugin_info = get_plugin_data(__FILE__);

define('SOLOBLOCKS_VERSION', $plugin_info['Version']);
define('SOLOBLOCKS_FILE', __FILE__);
define('SOLOBLOCKS_FOLDER', __DIR__);
define('SOLOBLOCKS_I18N', $plugin_info['TextDomain']);
define('SOLOBLOCKS_URL', plugin_dir_url(__FILE__));


if(!version_compare(PHP_VERSION, $plugin_info['RequiresPHP'], '>=')) {
	add_action('admin_notices', function() use ($plugin_info){
		$message      = sprintf('Solo Blocks requires PHP version %1$s+, plugin is currently NOT ACTIVE.', $plugin_info['RequiresPHP']);
		$html_message = sprintf('<div class="error">%s</div>', wpautop($message));
		echo wp_kses_post($html_message);
	});
} else if(!version_compare($wp_version, $plugin_info['RequiresWP'], '>=')) {
	add_action('admin_notices', function() use ($plugin_info){
		$message      = sprintf('Solo Blocks requires WordPress version %1$s+, plugin is currently NOT ACTIVE.', $plugin_info['RequiresWP']);
		$html_message = sprintf('<div class="error">%s</div>', wpautop($message));
		echo wp_kses_post($html_message);
	});
} else {
	add_action('plugins_loaded', function() use ($plugin_info){
		require_once __DIR__.'/core/autoload.php';
		require_once __DIR__.'/core/init.php';
		add_action('init', function() use ($plugin_info){
			load_plugin_textdomain($plugin_info['TextDomain'], false, __DIR__.'/language/');
		});
	});
}





