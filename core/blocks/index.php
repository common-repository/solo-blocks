<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

use SoloBlocks\Blocks\Basic;
use WP_Error;

class Blocks {
	private static $instance = null;

	private $blocks = array(
		"section",
		"column",
		"group",
		"delimiter",
//		"logo",
//		"login",
//		"burger-sidebar",
		"counter",
		"button",
		"image-box",
		"icon-box",
		"image-carousel",
		"image-carousel-item",
		"testimonial",
		"icon",
		"alerts",
		"content-slider",
		"content-slider-item",
		"accordion",
		"accordion-item",
		"toggle",
		"toggle-item",
		"icon-list",
		"icon-list-item",
		"recent-posts",
		"tabs",
		"tabs-item",
		"pricing-box",
		"countdown",
		"typed",
	);


	/** @return \SoloBlocks\Blocks */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
		add_action('init', array( $this, 'blocks_init' ));
		add_filter('block_categories_all', array( $this, 'sb_block_categories' ));

		add_action('enqueue_block_editor_assets', array( $this, 'sb_enqueue_block_editor_assets' ));
		add_action('enqueue_block_assets', array( $this, 'sb_enqueue_block_assets' ));
	}

	public static function get_name($name) {
		if(false !== str_contains($name, '/')) {
			list ($slug, $name) = explode('/', $name);
		}
		return $name;
	}

	public static function get_block_path($name){
		if(!file_exists($name)) {
			$name = self::get_name($name);
			$name = SOLOBLOCKS_FOLDER.'/dist/blocks/'.$name.'/block.json';
		}
		if(file_exists($name)) {
			return $name;
		}

		return false;
	}

	public static function get_block_meta($name, $meta = false, $default = false){
		$path = self::get_block_path($name);
		if($path) {
			$block = file_get_contents($path);
			try {
				$block = json_decode($block, true);
				if(json_last_error()) {
					$block = array();
				}
			} catch(\Exception $exception) {
				$block = array();
			}

			if ($meta) {
				if (key_exists($meta, $block)) {
					return $block[$meta];
				} else {
					return $default;
				}
			}

			return $block;
		} else {
			if ($meta) {
				return $default;
			}
		}

		return array();
	}


	function blocks_init() : void{
		$this->register_assets();
		
		foreach($this->blocks as $block) {
			$path = self::get_block_path($block);
			if ($path) {
				$args = array();
				$name = self::get_block_meta($path, 'name', false);
				$name = self::camelize(self::get_name($name));
				$class = 'SoloBlocks\Blocks\\'.$name;

				if (class_exists($class)) {
					$args =array(
						'render_callback' => array($this, 'sb_render_block')
					);
				}
				register_block_type($path, $args);
			}
		}

		if(class_exists('WooCommerce')) {
			//register_block_type(stream_resolve_include_path(SOLOBLOCKS_FOLDER.'/dist/blocks/cart'));
		}
	}


	function sb_block_categories($categories){
		array_splice($categories, 3, 0, array(
			array(
				'slug'  => 'sb-blocks',
				'title' => __('Solo Blocks','solo-blocks'),
			)
		));

		return $categories;
	}

	public static function camelize($input, $separator = '-'){
		return ucfirst(str_replace($separator, '_', ucwords($input, $separator)));
	}

	/**
	 * @param array     $attributes
	 * @param string    $content
	 * @param \WP_Block $block
	 *
	 */
	function sb_render_block($attributes, $content, $block){
		/**
		 * @var string $name Block name
		 * @var string|Basic $class
		 */

		$name = self::camelize(self::get_name($block->name));
		$class = 'SoloBlocks\Blocks\\'.$name;


		if (class_exists($class)) {
			$class = new $class($attributes,$block, $content);
			return $class->render_block();
		}
		return '';
	}


	/**
	 * @param string $file Absolute file path.
	 *
	 * @return array Defaults attributes
	 */
	public static function load_default_attributes(string $file) : array{
		if(!file_exists($file) || !is_readable($file)) {
			return array();
		}

		$block = file_get_contents($file);
		$block = json_decode($block, true);

		$block_attributes = array();
		foreach($block['attributes'] as $key => $data) {
			if(array_key_exists('default', $data)) {
				$block_attributes[$key] = $data['default'];
			} else {
				$default = null;
				switch($data['type']) {
					case 'string':
						$default = '';
						break;
					case 'object':
					case 'array':
						$default = array();
						break;
					case "number":
					case "num":
						$default = 0;
						break;
					case "boolean":
					case "bool":
						$default = false;
						break;
				}
				$block_attributes[$key] = $default;
			}
		}

		return $block_attributes;
	}

	/**
	 * @param string|array $point {
	 *                            x: string,
	 *                            y: string,
	 *                            }
	 *
	 * @return string
	 */
	public static function parse_focal_point(mixed $point) : string{
		if(is_string($point) && strlen($point)) {
			list ($x, $y) = explode(' ', $point);
			if(floatval($x) >= 0 && floatval($y) >= 0) {
				$point = array( 'x' => floatval($x), 'y' => floatval($y) );
			}
		}
		if(!is_array($point)) {
			$point = array( 'x' => 0.5, 'y' => 0.5 );
		}

		$point = array_merge(array( 'x' => 0.5, 'y' => 0.5 ), $point);

		return round($point['x']*100).'% '.round($point['y']*100).'%';
	}

	function register_assets() {
		$data = include(SOLOBLOCKS_FOLDER.'/dist/components.asset.php');
		wp_register_script('wp-sb-components', SOLOBLOCKS_URL.'dist/components.js', $data['dependencies'], $data['version']);
		wp_set_script_translations('wp-sb-components', SOLOBLOCKS_I18N, SOLOBLOCKS_FOLDER.'/language');
		$data = include(SOLOBLOCKS_FOLDER.'/dist/support.asset.php');
		wp_register_script('wp-sb-support', SOLOBLOCKS_URL.'dist/support.js', $data['dependencies'], $data['version']);
		wp_register_style('wp-sb-components', SOLOBLOCKS_URL.'dist/components.css');

		$data = include(SOLOBLOCKS_FOLDER.'/dist/frontend.asset.php');
		wp_register_script('wp-sb-frontend', SOLOBLOCKS_URL.'dist/frontend.js', $data['dependencies'], $data['version']);
		wp_register_style('wp-sb-frontend', SOLOBLOCKS_URL.'dist/frontend.css');
	}

	function sb_enqueue_block_editor_assets(){
		wp_enqueue_script('wp-sb-support');
		wp_enqueue_script('wp-sb-components');
		wp_enqueue_style('wp-sb-components');

	}

	function sb_enqueue_block_assets(){
		wp_enqueue_style('wp-sb-frontend');
	}
}
