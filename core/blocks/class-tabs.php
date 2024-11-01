<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Tabs extends Basic {

	/**
	 * Attributes
	 *
	 * @var array{

	 * }
	 */
	protected array $attributes = array();
	public static $child_index = 0;

	protected static array $titles = array();

	public static function get_child_index(){
		return self::$child_index;
	}

	public static function print_child_title($title){
		static::$titles[] = $title;
	}

	protected function render(){
		$inner_blocks        = $this->block->inner_blocks;
		static::$titles      = [];
		static::$child_index = 0;
		
		$className = array(
			'sb-title-alignment-'.$this->attributes['titleAlignment'],
		);

		if ($this->attributes['border'] !== 'none') {
			$className[] = "sb-disable-title-border-".(($this->attributes['disableTitleBorder']) ? "true" : "false");
			$className[] = "sb-disable-content-border-".(($this->attributes['disableContentBorder']) ? "true" : "false");
		}

		$this->add_render_attribute('wrapper', 'class', $className);

		$this->dataSettings = array(
			'initial' => 0
		);

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-tabs-item-title-wrapper',
			'typography' => $this->attributes['titleTypography']
		));

		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .wp-block-sb-tabs-item',
			'typography' => $this->attributes['contentTypography']
		));

		CSS_Vars::add(
			$this->selector.' a.sb-tabs-title-wrapper',
			array(
				'color'            => $this->attributes['titleColor'],
				'background-color' => $this->attributes['titleBgColor'],
			)
		);

		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-tabs-content',
			'name'     => 'color',
			'value'    => $this->attributes['contentColor']
		));

		CSS_Vars::add(
			$this->selector.' a.sb-tabs-title-wrapper.is-active-tab',
			array(
				'color'            => $this->attributes['titleColorActive'],
				'background-color' => $this->attributes['titleBgColorActive'],
			)
		);

		if ($this->attributes['border'] !== 'none') {
			CSS_Vars::add(
				$this->selector.' .sb-tabs-title-wrapper',
				array(
					'border-style' => $this->attributes['border'],
					'border-width' => $this->attributes['borderWidth'].'px',
					'border-color' => $this->attributes['borderColor'],
				)
			);
			CSS_Vars::add(
				$this->selector.' .sb-tabs-content',
				array(
					'border-style' => $this->attributes['border'],
					'border-width' => $this->attributes['borderWidth'].'px',
					'border-color' => $this->attributes['borderColor'],
				)
			);
			CSS_Vars::add(
				$this->selector.' .sb-tabs-title-wrapper',
				array(
					'border-top-left-radius' => $this->attributes['borderRadius'].'px',
					'border-top-right-radius' => $this->attributes['borderRadius'].'px',
				)
			);
			CSS_Vars::add(
				$this->selector.' .sb-tabs-content',
				array(
					'border-radius' => $this->attributes['borderRadius'].'px',
				)
			);
		}
		CSS_Vars::add(
			$this->selector.' .sb-tabs-title-wrapper',
			array(
				'margin-right' => $this->attributes['titleSpacing'].'px',
			)
		);

		ob_start();

		foreach($inner_blocks as $key => $block) {
			self::$child_index = $key;
			/** @var \WP_Block $block */
			$this->print_child_block($block);
		}

		$content = ob_get_clean();

		?>
		<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<div class="sb-tabs-items">
				<?php echo join('', static::$titles); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<div class="sb-tabs-content">
				<?php
				echo $content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</div>
		</div>
		<?php
	}
}
