<?php

namespace SoloBlocks\Blocks\Basic;
defined('ABSPATH') or exit;

trait Attributes_Trait {
	protected $_render_attributes = array();
	
	public function add_render_attribute($element = 'wrapper', $key = null, $value = null, $overwrite = false){
		if(is_array($element)) {
			foreach($element as $element_key => $attributes) {
				$this->add_render_attribute($element_key, $attributes, null, $overwrite);
			}
			
			return $this;
		}
		
		if(is_array($key)) {
			foreach($key as $attribute_key => $attributes) {
				$this->add_render_attribute($element, $attribute_key, $attributes, $overwrite);
			}
			
			return $this;
		}
		
		if(empty($this->_render_attributes[$element][$key])) {
			$this->_render_attributes[$element][$key] = [];
		}
		
		settype($value, 'array');
		
		if($overwrite) {
			$this->_render_attributes[$element][$key] = $value;
		} else {
			$this->_render_attributes[$element][$key] = array_merge($this->_render_attributes[$element][$key], $value);
		}
		
		return $this;
	}
	
	public function set_render_attribute($element = 'wrapper', $key = null, $value = null){
		return $this->add_render_attribute($element, $key, $value, true);
	}
	
	public function get_render_attribute_string($element = 'wrapper'){
		if(empty($this->_render_attributes[$element])) {
			return '';
		}
		
		$render_attributes = $this->_render_attributes[$element];
		
		$attributes = [];
		
		foreach($render_attributes as $attribute_key => $attribute_values) {
			$attributes[] = sprintf('%1$s="%2$s"', esc_attr($attribute_key), esc_attr(implode(' ', array_filter($attribute_values, function($value){
				return !!strlen((string) $value);
			}))));
		}
		
		return implode(' ', $attributes);
	}
	
	public function print_render_attribute_string($element = 'wrapper'){
		echo $this->get_render_attribute_string($element); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
