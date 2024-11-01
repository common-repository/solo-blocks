<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

class Placeholder {
	private static $instance  = null;

	/** @return \SoloBlocks\Placeholder */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
	}

	static function getImage() {
		return '<img src="'.static::getImageSrc().'" alt="" />';
	}
	
	static function getImageSrc() {
		$image = __DIR__.'/img/placeholder.png';
		$imageData = base64_encode(file_get_contents($image));
		return 'data:image/png;base64,'.$imageData;
	}
}
