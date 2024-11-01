<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Icon_List extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     align: string,
	 *     contentAlignment: string,
	 *     verticalAlignment: string,
	 *     itemSpacing: string,
	 *     iconSpacing: string,
	 *     descriptionTypography: array,
	 * }
	 */
	protected array $attributes = array();
	public static $child_index = 0;

	public static function get_child_index(){
		return self::$child_index;
	}

	private function compileCss(){

	}

	protected function render(){
		$inner_blocks = $this->block->inner_blocks;

		$className = array(
			'align'.$this->attributes['align'],
			'sb-content_alignment-'.$this->attributes['contentAlignment'],
			'sb-vertical_alignment-'.$this->attributes['verticalAlignment'],
		);

		if($this->attributes['align'] !== 'none') {
			$className[] = "has-alignment";
		}

		CSS_Vars::add(
			$this->selector.' .wp-block-sb-icon-list-item',
			array(
				'margin-bottom'  => $this->attributes['itemSpacing'].'px',
			)
		);

		CSS_Vars::add(
			$this->selector.' .wp-block-sb-icon-list-item .sb-icon_container',
			array(
				'margin-right'  => $this->attributes['iconSpacing'].'px',
			)
		);

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-icon-list-description',
			'typography' => $this->attributes['descriptionTypography']
		));

		$this->add_render_attribute('wrapper', 'class', $className);

		?>
		<div <?php $this->print_render_attribute_string(); ?>>
			<div class="sb-icon-list-wrapper">
				<?php
				self::$child_index = 0;
				foreach($inner_blocks as $key => $block) {
					/** @var \WP_Block $block */
					$this->print_child_block($block);
					self::$child_index++;
				}
				?>
			</div>
		</div>
		<?php
	}
}
