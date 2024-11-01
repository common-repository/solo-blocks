<?php

namespace SoloBlocks\Support;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use WP_Block_Supports;
use WP_Block_Type;
use WP_Block;

class Typography_Support {
	const name         = '_typography';
	const support_name = 'sb_typography';
	
	public function __construct(){
		WP_Block_Supports::get_instance()->register(
			static::support_name,
			array(
				'register_attribute' => array( $this, 'register' ),
				'apply'              => array( $this, 'apply' ),
			)
		);
		
		add_filter( 'pre_render_block__DISABLED', array($this, 'pre_render_block'), 10, 3 );
		add_filter( 'render_block__DISABLED', array($this, 'pre_render_block'), 10, 3 );
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
			'class' => '',
		);

		if(block_has_support($block_type, array( static::support_name )) && array_key_exists(static::name, $block_attributes)) {
			$typography = $block_attributes[static::name];
			if (count($typography)) {
				$uid = UID_Support::get_block_style_uid($block_attributes);
				
				$attributes['class'] = 'has-custom-typography';
				
				CSS_Vars::render_typography(array(
					'selector'   => $uid,
					'typography' => $typography,
					'field'      => static::name,
				));
			}
		}
		
		return $attributes;
	}
	
	function pre_render_block( $pre_render, $parsed_block, $parent_block ) {
		if ($parsed_block['blockName'] === 'core/paragraph') {
		
		}
		
		return null;
	}
	
	function render_block( string $block_content, array $block, \WP_Block $instance  ) {
		if ($block['blockName'] === 'core/paragraph') {
		}
		
		return null;
	}
}

new Typography_Support();
