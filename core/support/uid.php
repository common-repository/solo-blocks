<?php

namespace SoloBlocks\Support;

defined('ABSPATH') or exit;

use WP_Block_Supports;
use WP_Block_Type;
use WP_Block;

class UID_Support {
	const name = '_uid';
	const support_name = 'sb_uid';
	
	private static $uids = array();
	public function __construct(){
		WP_Block_Supports::get_instance()->register(
			static::support_name,
			array(
				'register_attribute' => array($this,'register'),
				'apply'              => array($this,'apply'),
			)
		);
		add_action('render_block_data', function($parsed_block, $source_block, $parent_block) {
			$blockName = $parsed_block['blockName'];
			$block_type = \WP_Block_Type_Registry::get_instance()->get_registered($blockName);
			
			if(block_has_support($block_type, array( static::support_name ))) {
				if (!array_key_exists(static::name, $parsed_block['attrs'])
				    || in_array($parsed_block['attrs'][static::name], static::$uids)) {
					$parsed_block['attrs'][self::name] = static::generate();
				}
				
				static::$uids[] = $parsed_block['attrs'][self::name];
			}
			
			return $parsed_block;
			
		},10, 3);
	}
	
	/**
	 * Registers the style attribute used by the border feature if needed for block
	 * types that support borders.
	 *
	 * @param WP_Block_Type $block_type Block Type.
	 */
	public function register($block_type) {
		if(!$block_type->attributes) {
			$block_type->attributes = array();
		}
		
		if(block_has_support($block_type, array( static::support_name )) && !array_key_exists(static::name, $block_type->attributes)) {
			$block_type->attributes[static::name] = array(
				'type' => 'string',
			);
		}
	}
	
	/**
	 * Adds CSS classes and inline styles for border styles to the incoming
	 * attributes array. This will be applied to the block markup in the front-end.
	 *
	 * @param WP_Block_Type $block_type       Block type.
	 * @param array         $block_attributes Block attributes.
	 *
	 * @return array Border CSS classes and inline styles.
	 */
	public function apply($block_type, $block_attributes) {
		return array();
	
		if(!block_has_support($block_type, [static::support_name] )) {
			return array();
		}
		
		return array(
			'id' => static::get_block_uid($block_attributes)
		);
	}
	
	/**
	 * @return string
	 */
	public static function generate(): string {
		return substr(md5(microtime(true).mt_rand(9999999999,999999999999)),-8);
	}
	
	public static function get_block_uid($block_attributes) {
		$uid = 'block_'.(array_key_exists(static::name, $block_attributes ) ? $block_attributes[static::name] : static::generate());
		return $uid;
	}
	
	public static function get_block_style_uid($block_attributes) {
		return '#'.self::get_block_uid($block_attributes);
	}
}

new UID_Support();

