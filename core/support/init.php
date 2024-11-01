<?php

defined('ABSPATH') or exit;

require_once __DIR__.'/uid.php';
require_once __DIR__.'/dimensions.php';
require_once __DIR__.'/backgrounds.php';
require_once __DIR__.'/typography.php';
require_once __DIR__.'/box-shadow.php';



function soloblocks_prepare_attribute($attribute_name, $attribute_value) {
	if (is_array($attribute_value)) {
		switch($attribute_name){
			case 'style':
				$attribute_value = implode(';', $attribute_value);
					break;
			case 'class':
				$attribute_value = implode(' ', $attribute_value);
				break;
			default:
				$attribute_value = json_encode($attribute_value);
		}
	}
	return $attribute_value;
}


function soloblocks_block_get_support( $block_type, $feature, $default = false ) {
	$block_support = $default;
	if ( $block_type && property_exists( $block_type, 'supports' ) ) {
		$block_support = _wp_array_get( $block_type->supports, $feature, $default );
	}
	
	return $block_support;
}
