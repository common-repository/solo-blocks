<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\Blocks;
use WP_Block;
use SoloBlocks\Support\UID_Support;
use SoloBlocks\Blocks\Basic\Attributes_Trait;
use WP_Block_Supports;

/**
 * @property array    $attributes
 * @property WP_Block $block;
 */
class Basic {
	use Attributes_Trait;
	
	protected array    $attributes   = array();
	protected WP_Block $block;
	protected string   $block_name   = '';
	protected string   $uid          = '';
	protected string   $_uid         = '';
	protected array    $dataSettings = [];
	protected string   $selector;
	
	public function __construct(array $attributes, WP_Block $block, string $content = ''){
		$this->attributes        = $attributes;
		$this->block             = $block;
		$name                    = Blocks::get_name($block->name);
		$this->block_name        = $name;
		$this->block->block_name = $name;
		$this->block->uid        = md5(mt_rand(99999, 9999999).$name);
		$path                    = SOLOBLOCKS_FOLDER.'/dist/blocks/'.$name.'/block.json';
		if(file_exists($path)) {
			$this->attributes = array_merge(Blocks::load_default_attributes($path), $this->attributes);
			$id               = UID_Support::get_block_uid($this->attributes);
			$this->uid        = $id;
			$this->selector   = '#'.$id;
		}
	}
	
	
	/** @return string|void */
	protected function render(){
		return '';
	}
	
	public function render_block(){
		$this->add_render_attribute('wrapper', $this->get_block_wrapper_attributes([
			'data-sb-block' => $this->block_name,
			'id'            => $this->uid
		], true));
		
		ob_start();
		$content = $this->render();
		$content .= ob_get_clean();
		$content .= $this->print_data_settings();
		
		return $content;
	}
	
	public function get_block_wrapper_attributes($extra_attributes = array(), $as_array = false) : array|string{
		$new_attributes = WP_Block_Supports::get_instance()->apply_block_supports();
		
		if(empty($new_attributes) && empty($extra_attributes)) {
			return '';
		}
		$attributes = array();
		
		$keys = array_unique(array_merge(array_keys($extra_attributes), array_keys($new_attributes)));
		foreach($keys as $attribute_name) {
			if(empty($new_attributes[$attribute_name]) && empty($extra_attributes[$attribute_name])) {
				continue;
			}
			
			if(empty($new_attributes[$attribute_name])) {
				$attributes[$attribute_name] = $extra_attributes[$attribute_name];
				continue;
			}
			
			if(empty($extra_attributes[$attribute_name])) {
				$attributes[$attribute_name] = $new_attributes[$attribute_name];
				continue;
			}
			$extra_attributes[$attribute_name] = $this->prepare_attribute($attribute_name, $extra_attributes[$attribute_name]);
			$new_attributes[$attribute_name]   = $this->prepare_attribute($attribute_name, $new_attributes[$attribute_name]);
			
			$attributes[$attribute_name] = $extra_attributes[$attribute_name].' '.$new_attributes[$attribute_name];
		}
		
		foreach($extra_attributes as $attribute_name => $value) {
			if(!in_array($attribute_name, $keys, true)) {
				$attributes[$attribute_name] = $value;
			}
		}
		
		if(empty($attributes)) {
			return '';
		}
		
		if($as_array) {
			return $attributes;
		}
		
		$normalized_attributes = array();
		foreach($attributes as $key => $value) {
			$normalized_attributes[] = $key.'="'.esc_attr($value).'"';
		}
		
		return implode(' ', $normalized_attributes);
	}
	
	function prepare_attribute($attribute_name, $attribute_value){
		if(is_array($attribute_value)) {
			switch($attribute_name) {
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
	
	public function print_data_settings($dataSettings = false){
		if(!is_array($dataSettings)) {
			$dataSettings = $this->dataSettings;
		}
		
		if(is_array($dataSettings) && count($dataSettings)) {
			return '<script type="application/json" id="'.esc_attr('settings--'.$this->uid).'">'.wp_json_encode($dataSettings).'</script>';// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
		return '';
	}
	
	/** @param \WP_Block $block */
	protected function print_child_block(WP_Block $block) : void{
		echo $block->render(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}