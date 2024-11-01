<?php

namespace SoloBlocks\Blocks;

defined('ABSPATH') or exit;

use SoloBlocks\CSS_Vars;
use SoloBlocks\Image;
use SoloBlocks\Icons;

class Image_Carousel_Item extends Basic {
	
	/**
	 * Attributes
	 *
	 * @var array{
	 *      imageSize: string,
	 *      id: string,
	 *      url: string,
	 * }
	 */
	protected array $attributes = array();
	
	protected function render(){

		$parent_attributes = array_merge(array(
			'imageSize' => 'medium_large',
			'lightbox' => false,
			'_uid'      => ''
		), $this->block->context);
		
		$image = wp_get_attachment_image_src($this->attributes['id'], $parent_attributes['imageSize']);
		if($image) {
			$image_src  = $image[0];
			$image_size = '';
			
			$this->add_render_attribute('img', 'src', esc_url($image_src));
			$this->add_render_attribute('img', 'width',$image[1]);
			$this->add_render_attribute('img', 'height', $image[2]);
			if($parent_attributes['lightbox']) {
				$this->add_render_attribute('img', 'data-fancybox', $parent_attributes['_uid']);
			}
			
			$this->add_render_attribute('wrapper', 'class', 'glide__slide');
			$this->add_render_attribute('wrapper', 'data-index', Image_Carousel::get_child_index());
			
			
			?>
			<div <?php $this->print_render_attribute_string() ?>>
				<img <?php $this->print_render_attribute_string('img'); ?> />
			</div>
			<?php
		}
		
	}
}
