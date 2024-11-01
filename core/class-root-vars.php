<?php

namespace SoloBlocks;

defined('ABSPATH') or exit;

class Root_Vars {
	private static $instance = null;
	private static $vars = array();

	/** @return \SoloBlocks\Root_Vars */
	public static function instance(){
		if(is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	private function __construct(){
	}


	public static function add($name, $value = false, $owerride = false){
		if(is_array($name)) {
			$names    = $name;
			$owerride = $value;
			foreach($names as $name => $value) {
				self::add($name, $value, $owerride);
			}

			return;
		}
		$value = trim($value);
		if(in_array($value, array( '', false )) || empty($value)) {
			return;
		}
		if(key_exists($name, static::$vars)) {
			if($owerride) {
				self::set($name, $value);
			}
		} else {
			self::set($name, $value);
		}
	}

	public static function set($name, $value){
		static::$vars[$name] = $value;
	}

	public static function remove($name, $value){
		if(key_exists($name, static::$vars)) {
			unset (static::$vars[$name]);
		}
	}

	public static function render(){
		echo static::compile();
	}

	public static function compile(){
		$compile = array();
		foreach(static::$vars as $name => $value) {
			$compile[] = $name.': '.$value;
		}

		return ':root{'.implode(';', $compile).'}';
	}

}
