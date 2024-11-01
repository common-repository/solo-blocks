<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Content_Slider_Item extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{

	 * }
	 */
	protected array $attributes = array();
	protected function render(){
		$inner_blocks = $this->block->inner_blocks;
		
		$this->add_render_attribute('wrapper', 'class', 'glide__slide');
		$this->add_render_attribute('wrapper', 'data-index', Content_Slider::get_child_index());
		
		?>
		<div <?php $this->print_render_attribute_string('wrapper') ?> >
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
