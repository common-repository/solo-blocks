<?php

namespace SoloBlocks\Support;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use WP_Block_Supports;
use WP_Block_Type;
use WP_Block;

class Background_Support {
	const name         = '_background';
	const support_name = 'sb_background';
	
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
			'class' => [],
		);
		
		if(block_has_support($block_type, array( static::support_name )) &&
		   (array_key_exists(static::name, $block_attributes) || array_key_exists(static::name.'Hover', $block_attributes))) {
			$background      = array_key_exists(static::name, $block_attributes) && is_array($block_attributes[static::name])? $block_attributes[static::name] : array();
			$backgroundHover = array_key_exists(static::name.'Hover', $block_attributes) && is_array($block_attributes[static::name.'Hover']) ? $block_attributes[static::name.'Hover'] : array();
			$uid             = UID_Support::get_block_style_uid($block_attributes);
			
			CSS_Vars::render_background_vars(array(
				'selector'   => $uid,
				'attributes' => $block_attributes,
				'field'      => static::name,
			));
			
			CSS_Vars::render_background_vars(array(
				'selector'   => $uid.':hover',
				'attributes' => $block_attributes,
				'field'      => static::name.'Hover',
			));
			
			$background = array_merge(array(
				'color' => '',
				'media' => array()
			), $background);
			
			$mediaValue = array_merge(array(
				'mediaUrl'         => '',
				'focalPoint'       => false,
				'backgroundRepeat' => 'repeat',
				'backgroundSize'   => 'auto',
			), $background['media']);
			
			if(false === strpos($background['color'], 'gradient') && strlen($background['color'])) {
				$attributes['class'][] = 'has-color-background';
			}
			
			if(false !== strpos($background['color'], 'gradient') && strlen($background['color'])) {
				$attributes['class'][] = 'has-gradient-background';
			}
			
			if($mediaValue['mediaUrl'] && strlen($mediaValue['mediaUrl'])) {
				$attributes['class'][] = 'has-media-background';
			}
			/** */
			$backgroundHover = array_merge(array(
				'color' => '',
				'media' => array()
			), $backgroundHover);
			
			$mediaValue = array_merge(array(
				'mediaUrl'         => '',
				'focalPoint'       => false,
				'backgroundRepeat' => 'repeat',
				'backgroundSize'   => 'auto',
			), $backgroundHover['media']);
			
			if(false === strpos($background['color'], 'gradient') && strlen($backgroundHover['color'])) {
				$attributes['class'][] = 'has-color-background-hover';
			}
			
			if(false !== strpos($background['color'], 'gradient') && strlen($backgroundHover['color'])) {
				$attributes['class'][] = 'has-gradient-background-hover';
			}
			
			if($mediaValue['mediaUrl'] && strlen($mediaValue['mediaUrl'])) {
				$attributes['class'][] = 'has-media-background-hover';
			}
		}
		
		$attributes['class'] = implode(' ', $attributes['class']);
		
		return $attributes;
	}
}

new Background_Support();
