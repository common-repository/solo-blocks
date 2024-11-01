<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use WP_Block;
use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Delimiter extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      width: string,
	 *      height:  int ,
	 *      align: string,
	 *      color: string,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){
		
		CSS_Vars::add(array(
			'selector' => $this->selector,
			'name'     => 'height',
			'value'    => $this->attributes['height'].'px'
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector,
			'name'     => 'width',
			'value'    => ($this->attributes['width']).'px',
		));
		CSS_Vars::add(array(
			'selector' => $this->selector,
			'name'     => 'color',
			'value'    => ($this->attributes['color']),
		));
		$className = array( 'sb-delimiter', 'wp-block-sb-delimiter', 'align'.$this->attributes['align'] );
		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}
		
		$this->add_render_attribute('wrapper', 'class', $className);
		?>
		<div <?php $this->print_render_attribute_string('wrapper'); ?>></div>
		<?php
		
	}
}


