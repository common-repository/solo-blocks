<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use WP_Block;
use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Group extends Basic {
	protected function render(){
		$inner_blocks = $this->block->inner_blocks;
		?>
		<div <?php $this->print_render_attribute_string(); ?>>
			<?php
			foreach($inner_blocks as $block) {
				$this->print_child_block($block);
			}
			?>
		</div>
		<?php
	}
}


