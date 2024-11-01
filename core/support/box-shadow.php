<?php

namespace SoloBlocks\Support;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use WP_Block_Supports;
use WP_Block_Type;
use WP_Block;

class BoxShadow_Support {
	const name         = '_box_shadow';
	const support_name = 'sb_box_shadow';

	public function __construct(){
		WP_Block_Supports::get_instance()->register(
			static::support_name,
			array(
				'register_attribute' => array( $this, 'register' ),
				'apply'              => array( $this, 'apply' ),
			)
		);
	}

	/**
	 * Registers the style attribute used by the border feature if needed for block
	 * types that support borders.
	 *
	 * @param WP_Block_Type $block_type Block Type.
	 */
	public function register($block_type){
		if(!$block_type->attributes) {
			$block_type->attributes = array();
		}

		if(block_has_support($block_type, array( static::support_name )) && !array_key_exists(static::name, $block_type->attributes)) {
			$block_type->attributes[static::name] = array(
				'type' => 'object',
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
	public function apply($block_type, $block_attributes){
		$attributes = array(
			'style' => '',
		);

		if(block_has_support($block_type, array( static::support_name )) && array_key_exists(static::name, $block_attributes)) {
			$value = $block_attributes[static::name];

			$attributes['style'] = 'box-shadow: '.$this->value_to_css($value);
		}

		return $attributes;
	}

	function value_to_css($value){
		if(!count(array_keys($value))) {
			return false;
		}

		$value = array_merge(array(
			"color"      => '#00000080',
			"horizontal" => '0px',
			"vertical"   => '0px',
			"blur"       => '10px',
			"spread"     => '0px',
			"position"   => '',
		), $value);

		return $value['position'] . ' ' . $value['horizontal'] . ' ' . $value['vertical'] . ' ' . $value['blur'] . ' ' . $value['spread'] . ' ' . $value['color'];
		
	}
}

new BoxShadow_Support();
