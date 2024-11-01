<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

class Fonts {
	private static $instance = null;
	private static $gfonts    = array();
	private static $fonts    = array();

	/** @return \SoloBlocks\Fonts */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
		$file          = file_get_contents(__DIR__.'/fonts.json');
		static::$gfonts = json_decode($file, true);

		add_action('wp_enqueue_scripts', array( $this, 'print_google_fonts' ));
		add_action('wp_print_footer_scripts', array( $this, 'print_google_fonts' ), 9);

	}

	static function getFonts() {
		static::instance();

		return static::$gfonts;
	}

	public static function add_style($font_family){
		self::instance();
		if(!empty($font_family) && !in_array($font_family, self::$fonts)) {
			self::$fonts[] = $font_family;
		}
	}

	public function print_google_fonts(){
		if (!count(self::$fonts)) return;
		$fonts_url = $this->get_stable_google_fonts_url();
		$slug = 'sb-google-fonts'.(doing_action('wp_print_footer_scripts') ? '-footer' : '');
		wp_enqueue_style($slug, $fonts_url, array(), md5(json_encode(self::$fonts))); // phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		self::$fonts = array();
	}

	public function get_stable_google_fonts_url(array|false $fonts = false) : string{
		if(false === $fonts) {
			$fonts = self::$fonts;
		}
		//var_dump($fonts);
		foreach($fonts as &$font) {
			$font = str_replace(' ', '+', $font).':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
		}

		// Defining a font-display type to google fonts.
		$font_display_url_str = '&display=auto';

		$fonts_url = sprintf('https://fonts.googleapis.com/css?family=%1$s%2$s', implode(rawurlencode('|'), $fonts), $font_display_url_str);

		$subsets = [
			'ru_RU' => 'cyrillic',
			'bg_BG' => 'cyrillic',
			'he_IL' => 'hebrew',
			'el'    => 'greek',
			'vi'    => 'vietnamese',
			'uk'    => 'cyrillic',
			'cs_CZ' => 'latin-ext',
			'ro_RO' => 'latin-ext',
			'pl_PL' => 'latin-ext',
			'hr_HR' => 'latin-ext',
			'hu_HU' => 'latin-ext',
			'sk_SK' => 'latin-ext',
			'tr_TR' => 'latin-ext',
			'lt_LT' => 'latin-ext',
		];

		/**
		 * Google font subsets.
		 *
		 * Filters the list of Google font subsets from which locale will be enqueued in frontend.
		 *
		 * @param array $subsets A list of font subsets.
		 *
		 * @since 1.0.0
		 *
		 */
		$subsets = apply_filters('elementor/frontend/google_font_subsets', $subsets);

		$locale = get_locale();

		if(isset($subsets[$locale])) {
			$fonts_url .= '&subset='.$subsets[$locale];
		}

		return $fonts_url;
	}

}
