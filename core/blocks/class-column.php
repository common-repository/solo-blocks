<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use WP_Block;
use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Column extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     width: string,
	 *     verticalAlignment: string,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){
		
		
		$inner_blocks = $this->block->inner_blocks;
		
		CSS_Vars::set(array(
			'selector' => $this->selector,
			'name'     => '--width',
			'value'    => $this->attributes['width'].'%',
		));
		
		$className = array(
//			'wp-block-sb-column',
		);
		
		if($this->attributes['verticalAlignment']) {
			$className[] = 'is-vertically-aligned-'.$this->attributes['verticalAlignment'];
		}
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		?>
		<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<?php
			foreach($inner_blocks as $block) {
				$this->print_child_block($block);
			}
			?>
		</div>
		<?php
	}
}


