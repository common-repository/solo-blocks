<?php

namespace SoloBlocks\Support;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use WP_Block_Supports;
use WP_Block_Type;
use WP_Block;

class Dimensions_Support {
	const name         = '_background';
	const support_name = 'sb_dimension';
	
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
			$support = soloblocks_block_get_support($block_type, array( static::support_name ));
			if(true === $support) {
				$support = array(
					'padding'    => true,
					'margin'     => true,
					'responsive' => true
				);
			}
			
			$support = array(
				'padding'    => true,
				'margin'     => true,
				'responsive' => true
			);
			
			extract($support);
			
			if($padding) {
				$block_type->attributes['_padding'] = array(
					'type' => 'object'
				);
				if(true === $responsive || (is_array($responsive) && key_exists('padding', $responsive) && true === $responsive['padding'])) {
					$block_type->attributes['_paddingTablet'] = array(
						'type' => 'object',
					);
					$block_type->attributes['_paddingMobile'] = array(
						'type' => 'object',
					);
				}
			}
			
			if($margin) {
				$block_type->attributes['_margin'] = array(
					'type' => 'object',
				);
				if(true === $responsive || (is_array($responsive) && key_exists('margin', $responsive) && true === $responsive['margin'])) {
					$block_type->attributes['_marginTablet'] = array(
						'type' => 'object',
					);
					$block_type->attributes['_marginMobile'] = array(
						'type' => 'object',
					);
				}
			}
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
			'class' => "",
		);
		
		if(block_has_support($block_type, array( static::support_name ))) {
			$uid        = UID_Support::get_block_style_uid($block_attributes);
			
			CSS_Vars::render_dimension_vars(array(
				'selector'        => $uid,
				'attributes'      => $block_attributes,
				'field'           => '_padding',
				'var'             => 'padding',
				'with_responsive' => true,
			));
			
			CSS_Vars::render_dimension_vars(array(
				'selector'        => $uid,
				'attributes'      => $block_attributes,
				'field'           => '_margin',
				'var'             => 'margin',
				'with_responsive' => true,
			));
		}
		
		
		return $attributes;
	}
}

new Dimensions_Support();
