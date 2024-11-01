<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\Icons;

class Tabs_Item extends Basic {

	/**
	 * Attributes
	 *
	 * @var array{

	 * }
	 */
	protected array $attributes = array();
	protected function render(){
		$inner_blocks = $this->block->inner_blocks;

		Tabs::print_child_title($this->render_title());
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

	protected function render_title(){
		$parent_attributes = array_merge(array(
			'titleSize' => 'h3',
		), $this->block->context);

		$this->add_render_attribute('title', 'class', 'sb-tabs-item-title-wrapper');

		return '<a href="javascript:void(0)" class="sb-tabs-title-wrapper" data-index="'.esc_attr($this->uid).'">'.
		       sprintf('<%1$s %2$s>%3$s</%1$s>',
			       $parent_attributes['titleSize'],
			       $this->get_render_attribute_string('title'),
			       esc_html($this->attributes['title'])
		       ).'</a>';
	}
}
