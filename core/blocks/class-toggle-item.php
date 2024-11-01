<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\Icons;

class Toggle_Item extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *      initialOpen: bool,
	 * }
	 */
	protected array $attributes = array();
	
	
	protected function render(){
		
		$inner_blocks = $this->block->inner_blocks;
		
		$parent_attributes = array_merge(array(
			'titleSize' => 'h3',
			'_uid'      => ''
		), $this->block->context);
		
		$icon = array(
			"name"     => "angle-down",
			"category" => "solid"
		);
		
		$isOpen = $this->attributes['initialOpen'];
		
		if($isOpen) {
			$this->add_render_attribute('wrapper', 'class', 'sb-toggle-item-active');
		}
		
		$this->add_render_attribute('title_wrap', 'class', 'sb-toggle-title-wrap')
		
		?>

		<div <?php $this->print_render_attribute_string('wrapper') ?>>
			<div class="sb-toggle-item-title">
				<div class="sb-toggle-title-wrapper">
					<?php
					echo sprintf('<%1$s %2$s>%3$s</%1$s>',
							$parent_attributes['titleSize'],
							$this->get_render_attribute_string('title_wrap'),
							esc_html($this->attributes['title'])
					     ).'</a>';
					?>
					<div class="sb-toggle-icon">
						<?php echo Icons::getIcon($icon); ?>
					</div>
				</div>
			</div>
			<div class="sb-toggle-item-content" <?php echo(!$isOpen ? 'style="display: none"' : '') ?>>
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
