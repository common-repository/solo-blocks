<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use WP_Block;
use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Section extends Basic {
	protected function render(){
		
		$inner_blocks = $this->block->inner_blocks;
		
		$className = array();
		
		$this->add_render_attribute('wrapper','class',$className);
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
