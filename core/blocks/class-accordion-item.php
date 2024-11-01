<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\Icons;

class Accordion_Item extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      title: string,
	 *      icon: array,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){
		$inner_blocks = $this->block->inner_blocks;
		
		$parent_attributes = array_merge(array(
			'initialOpen' => 0,
			'titleSize'   => 'h3',
			'_uid'        => ''
		), $this->block->context);
		
		$this->add_render_attribute('wrapper', 'data-index', Accordion::get_child_index());
		
		$icon = array(
			"name"     => "angle-down",
			"category" => "solid"
		);
		
		?>
		<div <?php $this->print_render_attribute_string() ?>>
			<div class="sb-accordion-item-title">
				<div class="sb-accordion-title-wrapper">
					<?php
					printf('<%1$s class="%2$s">%3$s</%1$s>',
						$parent_attributes['titleSize'],
						"sb-accordion-title-wrap",
						esc_html($this->attributes['title'])
					);
					?>
					<div class="sb-accordion-icon">
						<?php echo Icons::getIcon($icon); ?>
					</div>
				</div>
			</div>
			<div class="sb-accordion-item-content">
				<?php
				foreach($inner_blocks as $key => $block) {
					/** @var \WP_Block $block */
					$this->print_child_block($block);
				}
				?>
			</div>
		</div>
		<?php
	}
}
