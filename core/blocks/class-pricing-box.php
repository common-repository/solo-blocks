<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;

class Pricing_Box extends Basic {
	
	/**
	 * Attributes
	 *
	 * @var array{
	 *    align: string,
	 *    contentAlignment: string,
	 *    verticalAlignment: string,
	 *    titleTypography: array,
	 *    titleColor: string,
	 *    pricePrefixTypography: array,
	 *    pricePrefixColor: string,
	 *    priceCountTypography: array,
	 *    priceCountColor: string,
	 *    priceSuffixTypography: array,
	 *    priceSuffixColor: string,
	 *    featuredTypography: array,
	 *    featuredBg: string,
	 *    borderRadius: string,
	 *    border: bool,
	 *    borderWidth: numeric,
	 *    borderColor: string,
	 *    titleText: string,
	 *    featured: string,
	 *    pricePrefix: string,
	 *    priceCount: string,
	 *    priceSuffix: string,
	 * }
	 */
	protected array $attributes = array();
	
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
		
		$this->add_render_attribute('wrapper', 'class', $className);
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-pricing-title',
			'typography' => $this->attributes['titleTypography']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-pricing-title',
			'name'     => 'color',
			'value'    => $this->attributes['titleColor']
		));
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-price-prefix',
			'typography' => $this->attributes['pricePrefixTypography']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-price-prefix',
			'name'     => 'color',
			'value'    => $this->attributes['pricePrefixColor']
		));
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-price-count',
			'typography' => $this->attributes['priceCountTypography']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-price-count',
			'name'     => 'color',
			'value'    => $this->attributes['priceCountColor']
		));
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-price-suffix',
			'typography' => $this->attributes['priceSuffixTypography']
		));
		
		CSS_Vars::add(array(
			'selector' => $this->selector.' .sb-price-suffix',
			'name'     => 'color',
			'value'    => $this->attributes['priceSuffixColor']
		));
		
		CSS_Vars::render_typography(array(
			'selector'   => $this->selector.' .sb-pricing-featured',
			'typography' => $this->attributes['featuredTypography']
		));
		
		CSS_Vars::add(
			$this->selector.' .sb-pricing-featured',
			array(
				'color'            => $this->attributes['featuredColor'],
				'background-color' => $this->attributes['featuredBg'],
			)
		);
		
		CSS_Vars::add(
			$this->selector,
			array(
				'border-radius' => $this->attributes['borderRadius'].'px',
			)
		);
		
		if($this->attributes['border'] !== 'none') {
			CSS_Vars::add(
				$this->selector,
				array(
					'border-style' => $this->attributes['border'],
					'border-width' => $this->attributes['borderWidth'].'px',
					'border-color' => $this->attributes['borderColor'],
				)
			);
		}
		$this->add_render_attribute('title', 'class', 'sb-pricing-title');
		
		$title = (!empty($this->attributes['titleText'])) ? sprintf('<%1$s %2$s>%3$s</%1$s>',
			$this->attributes['titleSize'],
			$this->get_render_attribute_string('title'),
			wp_kses_post($this->attributes['titleText'])
		) : '';
		
		$featured = ((bool) ($this->attributes['featured'])) ?
			'<div class="sb-pricing-featured">'.wp_kses_post($this->attributes['featuredText']).'</div>' : '';
		
		$pricePrefix = (!empty($this->attributes['pricePrefix'])) ?
			'<div class="sb-price-prefix">'.wp_kses_post($this->attributes['pricePrefix']).'</div>' : '';
		
		$priceCount = (!empty($this->attributes['priceCount'])) ?
			'<div class="sb-price-count">'.wp_kses_post($this->attributes['priceCount']).'</div>' : '';
		
		$priceSuffix = (!empty($this->attributes['priceSuffix'])) ?
			'<div class="sb-price-suffix">'.wp_kses_post($this->attributes['priceSuffix']).'</div>' : '';
		
		$price = $pricePrefix.$priceCount.$priceSuffix;
		
		?>
		<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<?php echo $featured; ?>
			<div class="sb-pricing-box-wrapper">
				<?php
				echo $title.(!empty($price) ? ('<div class="sb-price-block-wrap">'.$price.'</div>') : ""); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				
				foreach($inner_blocks as $key => $block) {
					$this->print_child_block($block);
				}
				?>
			</div>
		</div>
		<?php
	}
}
