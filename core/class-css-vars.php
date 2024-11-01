<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

class CSS_Vars {
	private static $instance     = null;
	private static $root_vars    = array();
	private static $desktop_vars = array();
	private static $tablet_vars  = array();
	private static $mobile_vars  = array();

	const DESKTOP = 'Desktop';
	const TABLET  = 'Tablet';
	const MOBILE  = 'Mobile';

	/** @return static */
	public static function instance() : CSS_Vars{
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
		add_action('wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ));
		add_action('wp_footer', array( $this, 'wp_enqueue_scripts_footer' ));
	}


	/**
	 * @param string|array $selector {
	 *
	 * @type string        $selector
	 * @type string        $value
	 * @type string        $name
	 * @type string        $media
	 *                               }
	 *
	 * @param string|array $name     Name
	 * @param string       $value    Value
	 * @param string       $media    Media (desktop|tablet|mobile)
	 */
	public static function add(string|array $selector, string|array $name = '', string $value = '', string $media = 'desktop') : void{
		self::instance();

		if(is_array($selector)) {
			if(key_exists('selector', $selector) && key_exists('name', $selector)) {
				// Single
				self::set($selector);
			} else {
				foreach($selector as $value) {
					self::set($value);
				}
			}
		}

		if(is_array($name)) {
			$media = in_array($value, array( 'desktop', 'tablet', 'mobile' )) ? $value : $media;

			foreach($name as $item => $value) {
				self::set($selector, $item, $value, $media);
			}
			return;
		}

		self::set($selector, $name, $value, $media);
	}

	/**
	 * @param string|array $selector {
	 *
	 * @type string        $selector
	 * @type string        $value
	 * @type string        $name
	 * @type string        $media
	 *                               }
	 *
	 * @param string       $name     Name
	 * @param string       $value    Value
	 * @param string       $media    Media (desktop|tablet|mobile)
	 */
	public static function set($selector, $name = false, $value = false, $media = 'desktop'){

		if(is_array($selector)) {
			$selector = array_merge(array(
				'selector' => '',
				'name'     => '',
				'value'    => '',
				'media'    => 'desktop',
			), $selector);

			extract($selector);
		}

		if(empty($value)) {
			return;
		}

		switch($media) {
			case 'desktop':
			case 'Desktop':
			case '':
				if(!key_exists($selector, self::$desktop_vars)) {
					self::$desktop_vars[$selector] = array();
				}
				self::$desktop_vars[$selector][$name] = $value;
				break;

			case 'tablet':
			case 'Tablet':
				if(!key_exists($selector, self::$tablet_vars)) {
					self::$tablet_vars[$selector] = array();
				}

				self::$tablet_vars[$selector][$name] = $value;
				break;

			case 'mobile':
			case 'Mobile':
				if(!key_exists($selector, self::$mobile_vars)) {
					self::$mobile_vars[$selector] = array();
				}

				self::$mobile_vars[$selector][$name] = $value;
				break;
		}

	}

	public static function render(){

	}


	public static function compile(){
		$compile = '';

		
		foreach(self::$desktop_vars as $selector => $desktop_var) {
			$compile .= $selector.'{';
			foreach($desktop_var as $name => $value) {
				$compile .= $name.':'.$value.';';
			}
			$compile .= '}';
		}
		if(count(self::$tablet_vars)) {
			$compile .= '@media only screen and (max-width: 1280px){';
			foreach(self::$tablet_vars as $selector => $tablet_var) {
				$compile .= $selector.'{';
				foreach($tablet_var as $name => $value) {
					$compile .= $name.':'.$value.';';
				}
				$compile .= '}';
			}
			$compile .= '}';
		}
		if(count(self::$mobile_vars)) {
			$compile .= '@media only screen and (max-width: 640px){';
			foreach(self::$mobile_vars as $selector => $mobile_var) {
				$compile .= $selector.'{';
				foreach($mobile_var as $name => $value) {
					$compile .= preg_replace('/^[-]+/', '', $name, -1).':'.$value.';';
				}
				$compile .= '}';
			}
			$compile .= '}';
		}

		self::$desktop_vars = array();
		self::$tablet_vars  = array();
		self::$mobile_vars  = array();

		return $compile;
	}

	public function wp_enqueue_scripts_footer(){
		wp_register_style('sb-dynamic-handle-footer', false);
		wp_enqueue_style('sb-dynamic-handle-footer');
		wp_add_inline_style('sb-dynamic-handle-footer', self::compile());
	}

	public function wp_enqueue_scripts(){
		wp_register_style('sb-dynamic-handle', false);
		wp_enqueue_style('sb-dynamic-handle');
		wp_add_inline_style('sb-dynamic-handle', self::compile());
	}


	/**
	 * Params
	 *
	 * @param array {
	 *  selector: string,
	 *  attributes: array,
	 *  field: string,
	 *  var:  string ,
	 *  device:  string ,
	 *  with_responsive: bool,
	 *  } $props
	 *
	 * @return void
	 */
	public static function render_background_vars(array $props) : void{
		$props = array_merge(
			array(
				'selector'        => false,
				'attributes'      => array(),
				'field'           => false,
				'device'          => '',
				'var'             => '',
				'with_responsive' => false,
			), $props
		);

		extract($props);
		$props['with_responsive'] = false;
		if(empty($var)) {
			$var = $field;
		}
		$field .= $device;

		if(!$field || !key_exists($field, $attributes) || empty($attributes[$field])) {
			return;
		}

		if(empty($var)) {
			$var = $field;
		}

		$background = array_merge(array(
			'color' => '',
			'media' => array()
		), $attributes[$field]);

		if(false === strpos($background['color'], 'gradient')) {
			$background['color'] && self::add($selector, 'background-color', $background['color']);
		}

		$_mediaValue = [];

		$mediaValue = array_merge(array(
			'mediaUrl'         => '',
			'focalPoint'       => false,
			'backgroundRepeat' => 'repeat',
			'backgroundSize'   => 'auto',
		), $background['media']);

		if($mediaValue['mediaUrl']) {
			$_mediaValue[] = "url(".$mediaValue['mediaUrl'].")";
		}
		if(false !== strpos($background['color'], 'gradient')) {
			$_mediaValue[] = $background['color'];
		}

		count($_mediaValue) && self::add($selector, 'background-image', join(', ', $_mediaValue), $device);
		$mediaValue['focalPoint'] && self::add($selector, 'background-position', Blocks::parse_focal_point($mediaValue['focalPoint']), $device);
		$mediaValue['backgroundRepeat'] && self::add($selector, 'background-repeat', $mediaValue['backgroundRepeat'], $device);
		$mediaValue['backgroundSize'] && self::add($selector, 'background-size', $mediaValue['backgroundSize'], $device);

		if($with_responsive) {
			foreach([ self::TABLET, self::MOBILE ] as $device) {
				$props['device'] = $device;
				self::render_background_vars($props);
			}
		}
	}

	/**
	 * Params
	 *
	 * @param array {
	 *  selector: string,
	 *  attributes: array,
	 *  field: string,
	 *  var:  string ,
	 *  device:  string ,
	 *  with_responsive: bool,
	 *  } $props
	 *
	 * @return void
	 */
	static function render_dimension_vars($props) : void{
		$props = array_merge(
			array(
				'selector'        => false,
				'attributes'      => array(),
				'field'           => false,
				'device'          => '',
				'var'             => '',
				'with_responsive' => false,
			), $props
		);

		extract($props);
		$props['with_responsive'] = false;
		if(empty($var)) {
			$var = $field;
		}
		$field .= $device;

		if(!$field || !key_exists($field, $attributes) || empty($attributes[$field])) {
			return;
		}

		if(empty($var)) {
			$var = $field;
		}

		$value = $attributes[$field];

		if(is_array($value)) {
			$value = array_merge(array(
				'top'    => '',
				'bottom' => '',
				'left'   => '',
				'right'  => '',
			), $value);

			foreach($value as $_key => $_value) {
				!empty($value[$_key]) && self::add($selector, $var.'-'.$_key, $_value, $device);
			}
		}

		if($with_responsive) {
			foreach([ 'Tablet', 'Mobile' ] as $device) {
				$props['device'] = $device;
				self::render_dimension_vars($props);
			}
		}
	}

	public static function render_typography(array $props) : void{
		$props = array_merge(
			array(
				'selector'        => false,
				'typography'      => array(),
				'with_responsive' => false,
			), $props
		);

		extract($props);
		if(is_string($typography)) {
			$_typography = json_decode($typography, true);
			if(json_last_error()) {
				$typography = array();
			}
		}
		if(!is_array($typography)) {
			$typography = array();
		}

		$typography = array_merge(array(
			"family" => "",

			"fontSize"       => "",
			"fontSizeMobile" => "",
			"fontSizeTablet" => "",

			"decoration"    => "",
			"fontWeight"    => "",
			"letterSpacing" => "",
			"lineHeight"    => "",
			"style"         => "",
			"transform"     => "",
		), $typography);

		self::add($selector, 'font-family', $typography['family']);
		self::add($selector, 'font-size', $typography['fontSize']);
		self::add($selector, 'font-size', $typography['fontSizeTablet'], 'tablet');
		self::add($selector, 'font-size', $typography['fontSizeMobile'], 'mobile');
		self::add($selector, 'text-decoration', $typography['decoration']);
		self::add($selector, 'font-weight', $typography['fontWeight']);
		self::add($selector, 'letter-spacing', $typography['letterSpacing']);
		self::add($selector, 'line-height', $typography['lineHeight']);
		self::add($selector, 'font-style', $typography['style']);
		self::add($selector, 'text-transform', $typography['transform']);

		Fonts::add_style($typography['family']);
	}


	/**
	 * @param string $selector
	 * @param array  $attributes
	 *
	 * @return void
	 */
	public static function render_wordpress_attributes(string $selector, array $attributes) : void{

		// textColor
		// style

	}

}
