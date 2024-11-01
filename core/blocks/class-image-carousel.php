<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Image_Carousel extends Basic {
	/**
	 * Attributes
	 *
	 * @var array{
	 *     align: string,
	 *     imageSize: string,
	 *     carouselPerView: string,
	 *     carouselPerViewTablet: string,
	 *     carouselPerViewMobile: string,
	 *     carouselCenterMode: string,
	 *     carouselFocusAt: string,
	 *     carouselGap: string,
	 *     carouselAutoplay: string,
	 *     carouselAnimationDuration: string,
	 *     carouselPeek: string,
	 *     carouselArrows: string,
	 *     carouselDots: string,
	 *     imgFit: string,
	 *     verticalAlignment: string,
	 *     animationEffect: string,
	 *     lightbox: string,
	 *     carouselHeight: string,
	 *     carouselHeightTablet: string,
	 *     carouselHeightMobile: string,
	 *
	 * }
	 */
	protected array $attributes = array();
	
	public static $child_index = 0;
	
	public static function get_child_index() {
		return self::$child_index;
	}
	
	private function compileCss(){
		$value = $this->attributes['carouselHeight'];
		if(!!intval($value)) {
			CSS_Vars::add($this->selector.' .glide__slides', 'height', $value);
		}
		$value = $this->attributes['carouselHeightTablet'];
		if(!!intval($value)) {
			CSS_Vars::add($this->selector.' .glide__slides', 'height', $value, 'tablet');
		}
		$value = $this->attributes['carouselHeightMobile'];
		if(!!intval($value)) {
			CSS_Vars::add($this->selector.' .glide__slides', 'height', $value, 'mobile');
		}
	}
	
	protected function render(){
		$inner_blocks = $this->block->inner_blocks;
		
		if($this->attributes['animationEffect'] === 'fade') {
			$this->attributes['carouselPerView'] = 1;
		}
		
		if(!is_numeric($this->attributes['carouselPerView']) || $this->attributes['carouselPerView'] < 1) {
			$this->attributes['carouselPerView'] = 3;
		}
		$this->attributes['carouselPerView'] = min($this->attributes['carouselPerView'], count($inner_blocks));
		if(!is_numeric($this->attributes['carouselPerViewTablet']) || $this->attributes['carouselPerViewTablet'] < 1) {
			$this->attributes['carouselPerViewTablet'] = $this->attributes['carouselPerView'];
		}
		$this->attributes['carouselPerViewTablet'] = min($this->attributes['carouselPerViewTablet'], count($inner_blocks));
		if(!is_numeric($this->attributes['carouselPerViewMobile']) || $this->attributes['carouselPerViewMobile'] < 1) {
			$this->attributes['carouselPerViewMobile'] = $this->attributes['carouselPerViewTablet'];
		}
		$this->attributes['carouselPerViewMobile'] = min($this->attributes['carouselPerViewMobile'], count($inner_blocks));
		
		if(!is_numeric($this->attributes['carouselGap']) || $this->attributes['carouselGap'] < 0) {
			$this->attributes['carouselGap'] = 10;
		}
		if(!is_numeric($this->attributes['carouselAnimationDuration']) || $this->attributes['carouselAnimationDuration'] < 1000) {
			$this->attributes['carouselAnimationDuration'] = 400;
		}
		if(!is_numeric($this->attributes['carouselPeek']) || $this->attributes['carouselPeek'] < 0) {
			$this->attributes['carouselPeek'] = 0;
		}
		
		$this->dataSettings = array(
			'lightbox'          => $this->attributes['lightbox'],
			'focusAt'           => $this->attributes['carouselCenterMode'] ? 'center' : 0,
			'arrows'            => $this->attributes['carouselArrows'],
			'dots'              => $this->attributes['carouselDots'],
			'perView'           => $this->attributes['carouselPerView'],
			'gap'               => $this->attributes['carouselGap'],
			'autoplay'          => $this->attributes['carouselAutoplay'] ? $this->attributes['carouselAutoplay']*1000 : false,
			'animationDuration' => $this->attributes['carouselAnimationDuration'],
			'peek'              => array(
				'after'  => $this->attributes['carouselPeek'],
				'before' => $this->attributes['carouselPeek']
			),
			'breakpoints'       => array(
				'1280' => array(
					'perView' => $this->attributes['carouselPerViewTablet'],
				),
				'640' => array(
					'perView' => $this->attributes['carouselPerViewMobile'],
				),
			),
			'uid'               => $this->attributes['_uid']
		);
		
		if($this->attributes['carouselDots']) {
			$this->add_render_attribute('wrapper', "class", 'sb-carousel-bullets');
		}
		if($this->attributes['imgFit'] !== 'cover') {
			$this->add_render_attribute('wrapper', "class", 'sb-image-vertical_alignment-'.$this->attributes['verticalAlignment']);
		}
		$this->add_render_attribute('wrapper', "class", 'sb-carousel-fit-'.$this->attributes['imgFit']);
		$this->add_render_attribute('wrapper', "class", 'sb-carousel-effect-'.$this->attributes['animationEffect']);
		
		$dots = [];
		
		$this->compileCss();
		
		?>
		<div <?php $this->print_render_attribute_string('wrapper');?>>
			<div class="glide">
				<div class="glide__track" data-glide-el="track">
					<div class="glide__slides">
						<?php
						self::$child_index = 0;
						foreach($inner_blocks as $key => $block) {
							/** @var \WP_Block $block */
							$dots[] = '<button class="glide__bullet" data-glide-dir="='.esc_attr($key).'"/>';
							$this->print_child_block($block);
							self::$child_index++;
						}
						?>
					</div>
				</div>
				<?php
				if($this->attributes['carouselDots']) {
					?>
					<div class="glide__bullets" data-glide-el="controls[nav]">
						<?php echo join('', $dots); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
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
