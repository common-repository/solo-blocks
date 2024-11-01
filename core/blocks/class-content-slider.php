<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Content_Slider extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     align: string,
	 *     carouselPerView: string,
	 *     carouselPerViewTablet: string,
	 *     carouselPerViewMobile: string,
	 *     carouselFocusAt: string,
	 *     carouselGap: string,
	 *     carouselAutoplay: string,
	 *     carouselAnimationDuration: string,
	 *     carouselArrows: string,
	 *     carouselDots: string,
	 *     verticalAlignment: string,
	 *     animationEffect: string,
	 *     carouselHeight: string,
	 *     carouselHeightTablet: string,
	 *     carouselHeightMobile: string,
	 * }
	 */
	protected array $attributes = array();
	
	public static $child_index = 0;

	public static function get_child_index(){
		return self::$child_index;
	}

	protected function render(){
		$inner_blocks = $this->block->inner_blocks;

		if(!is_numeric($this->attributes['carouselAnimationDuration']) || $this->attributes['carouselAnimationDuration'] < 1000) {
			$this->attributes['carouselAnimationDuration'] = 400;
		}

		$this->dataSettings = array(
			'focusAt'           => 0,
			'perView'           => 1,
			'arrows'            => $this->attributes['carouselArrows'],
			'dots'              => $this->attributes['carouselDots'],
			'autoplay'          => $this->attributes['carouselAutoplay'] ? $this->attributes['carouselAutoplay']*1000 : false,
			'animationDuration' => $this->attributes['carouselAnimationDuration'],
			'uid'               => $this->attributes['_uid']
		);

	
		if($this->attributes['carouselDots']) {
			$this->add_render_attribute('wrapper', "class", 'sb-carousel-bullets');
		}
		$this->add_render_attribute('wrapper', "class", 'sb-image-vertical_alignment-'.$this->attributes['verticalAlignment']);
		$this->add_render_attribute('wrapper', "class", 'sb-carousel-effect-'.$this->attributes['animationEffect']);

		$dots = [];

		?>
		<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<div class="glide">
				<div class="glide__track" data-glide-el="track">
					<div class="glide__slides">
						<?php
						self::$child_index = 0;
						foreach($inner_blocks as $key => $block) {
							self::$child_index = $key;
							/** @var \WP_Block $block */
							$dots[] = '<button class="glide__bullet" data-glide-dir="='.esc_attr($key).'"/>';
							$this->print_child_block($block);
						}
						?>
					</div>
				</div>
				<?php
				if($this->attributes['carouselDots']) {
					?>
					<div class="glide__bullets" data-glide-el="controls[nav]">
						<?php echo join('', $dots) // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php
				}

				if($this->attributes['carouselArrows']) {
					?>
					<div class="glide__arrows" data-glide-el="controls">
						<button class="glide__arrow glide__arrow--left" data-glide-dir="&lt;">
							<svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
								<path d="M615.04 800.96L326.048 512l288.992-288.96 33.92 33.92L393.952 512l255.008 255.04z"></path>
							</svg>
						</button>
						<button class="glide__arrow glide__arrow--right" data-glide-dir="&gt;">
							<svg viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg">
								<path d="M408.96 800.96l-33.92-33.92L630.048 512 375.04 256.96l33.92-33.92L697.952 512z"></path>
							</svg>
						</button>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<?php
	}
}
