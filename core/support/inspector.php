<?php

namespace SoloBlocks\Support;

defined('ABSPATH') or exit;

use WP_Block_Supports;
use WP_Block_Type;
use WP_Block;

class Inspector_Support {
	const name = 'uid';
	const support_name = 'sb_inspector';
	public function __construct(){
		WP_Block_Supports::get_instance()->register(
			static::name,
			array(
				'register_attribute' => array($this,'register'),
				'apply'              => array($this,'apply'),
			)
		);
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
		$attributes = array();
		return $attributes;
	}
}
