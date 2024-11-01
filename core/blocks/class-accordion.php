<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Accordion extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *    selectedItem: string,
	 *    initialOpen: string,
	 *    iconPosition: string,
	 *    titleSize: string,
	 *    titleTypography: array,
	 *    contentTypography: array,
	 *    titleColor: string,
	 *    titleBgColor: string,
	 *    titleColorActive: string,
	 *    titleBgColorActive: string,
	 *    contentColor: string,
	 *    border: string,
	 *    borderWidth: string,
	 *    borderColor: string,
	 *    borderRadius: string,
	 *    enableActive: bool,
	 * }
	 */
	protected array $attributes = array();
	
	public static $child_index = 0;

	public static function get_child_index(){
		return self::$child_index;
	}

	protected function render(){
		$inner_blocks = $this->block->inner_blocks;

		$className = array(
			'sb-icon-position-'.$this->attributes['iconPosition'],
		);
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-accordion-title-wrap',
			'typography' => $this->attributes['titleTypography']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-accordion-item-content',
			'typography' => $this->attributes['contentTypography']
		));

		CSS_Vars::add(
			$this->selector.' .sb-accordion-item-title',
			array(
				'color'            => $this->attributes['titleColor'],
				'background-color' => $this->attributes['titleBgColor'],
			)
		);

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-accordion-item-content',
			'name'     => 'color',
			'value'    => $this->attributes['contentColor']
		));

		CSS_Vars::add(
			$this->selector.' .wp-block-sb-accordion-item .sb-accordion-item-title.ui-accordion-header-active',
			array(
				'color'            => $this->attributes['titleColorActive'],
				'background-color' => $this->attributes['titleBgColorActive'],
			)
		);

		if ($this->attributes['border'] !== 'none') {
			CSS_Vars::add(
				$this->selector.' .wp-block-sb-accordion-item',
				array(
					'border-style' => $this->attributes['border'],
					'border-width' => $this->attributes['borderWidth'].'px',
					'border-color' => $this->attributes['borderColor'],
				)
			);
			CSS_Vars::add(
				$this->selector.' .wp-block-sb-accordion-item .sb-accordion-item-content',
				array(
					'border-top-style' => $this->attributes['border'],
					'border-top-width' => $this->attributes['borderWidth'].'px',
					'border-top-color' => $this->attributes['borderColor'],
				)
			);
			CSS_Vars::add(
				$this->selector.' .wp-block-sb-accordion-item:first-of-type',
				array(
					'border-top-left-radius' => $this->attributes['borderRadius'].'px',
					'border-top-right-radius' => $this->attributes['borderRadius'].'px',
				)
			);
			CSS_Vars::add(
				$this->selector.' .wp-block-sb-accordion-item:last-of-type',
				array(
					'border-bottom-right-radius' => $this->attributes['borderRadius'].'px',
					'border-bottom-left-radius' => $this->attributes['borderRadius'].'px',
				)
			);
		}

		$this->add_render_attribute('wrapper', 'class', $className);
		if ($this->attributes['enableActive']) {
			$this->add_render_attribute('wrapper', 'data-active-tab', $this->attributes['initialOpen']);
		}

		?>
		<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<div class="sb-accordion-items">
				<?php
				self::$child_index = 0;

				foreach($inner_blocks as $key => $block) {
					self::$child_index = $key;
					/** @var \WP_Block $block */
					$this->print_child_block($block);
				}
				?>
			</div>
		</div>
		<?php
	}
}
