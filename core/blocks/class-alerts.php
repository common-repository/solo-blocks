<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Alerts extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      align: string,
	 *      content_alignment: string,
	 *      blockType: string,
	 *      textColor: string,
	 *      bgColor: string,
	 *      linkColor: string,
	 *      highlightColor: string,
	 *      blockTypography: array,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){
		$inner_blocks = $this->block->inner_blocks;
		
		$className = array(
			'align'.$this->attributes['align'],
			'sb-content_alignment-'.$this->attributes['content_alignment'],
			'sb-alert-type-'.$this->attributes['blockType'],
		);
		
		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}
		
		if((bool) $this->attributes['highlight']) {
			$className[] = "sb-alert-has-highlight";
		}
		
		CSS_Vars::add(
			$this->selector,
			array(
				'color'            => $this->attributes['textColor'],
				'background-color' => $this->attributes['bgColor'],
			)
		);
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' a',
			'name'     => 'color',
			'value'    => $this->attributes['linkColor']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.'.sb-alert-has-highlight:before',
			'name'     => 'background',
			'value'    => $this->attributes['highlightColor']
		));
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector,
			'typography' => $this->attributes['blockTypography']
		));
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		?>

		<div <?php $this->print_render_attribute_string() ?>>
			<?php
			foreach($inner_blocks as $key => $block) {
				/** @var \WP_Block $block */
				$this->print_child_block($block);
			}
			?>
		</div>
		<?php
	}
}
