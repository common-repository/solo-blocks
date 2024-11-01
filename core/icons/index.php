<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

class Icons {
	private static $instance  = null;
	private static $icons  = array();
	
	/** @return \SoloBlocks\Icons */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}
		
		return static::$instance;
	}
	
	private function __construct(){
		$file  = file_get_contents(__DIR__.'/icons.json');
//		static::$icons = json_decode($file, true);
		static::$icons = array_merge(json_decode($file, true), apply_filters('sb/core/icons/get', array()));
	}

	static function getIcons() {
		static::instance();
		
		return static::$icons;
	}
	
	/**
	 * @param "array"|"path"|"svg" $return
	 */
	static function getIcon(array $icon = array(), $return = 'svg') {
		static::instance();
		
		if (!is_array($icon)) {
			$icon = array();
		}
		$icon = array_merge(array('name' => '', 'category' => '', 'custom' => '', 'media' => array()), $icon);
		extract($icon);
		
		switch($category) {
			case '_media':
				// Media
				
				$media = array_merge(array('id'=>0,'url'=>''), $media);
				$svg = wp_prepare_attachment_for_js($media['id']);
				if (!$svg) {
					return ;
				}
				
				return '<img src="'.esc_url($svg['url']).'" />';
			case '_custom':
				//Custom
				
				if (self::check($custom)) {
					return $custom;
				}
				return;
		}

		// Icon Library
		if ($name && $category && key_exists($category, static::$icons) && key_exists($name, static::$icons[$category])) {
			$icon = static::$icons[$category][$name];
		} else {
			return '';
		}
		$icon = array_merge(array("w"=>0,"h"=>0,"path"=>""), $icon);
		extract($icon);
		
		switch($return) {
			case 'array':
				return $icon;
			case 'path':
				return $path;
			case 'svg':
				return  '<svg width="'.$w.'" height="'.$h.'" viewBox="0 0 '.$w.' '.$h.'"><path d="'.$path.'" /></svg>';
		}
		
		return '';
	}
	
	static function check($string) {
		$start =strpos($string, '<');
		$end  =strrpos($string, '>',$start);
		
		$len=strlen($string);
		
		if ($end !== false) {
			$string = substr($string, $start);
		} else {
			$string = substr($string, $start, $len-$start);
		}
		libxml_use_internal_errors(true);
		libxml_clear_errors();
		$xml = simplexml_load_string($string);
		return count(libxml_get_errors())==0;
	}
}
